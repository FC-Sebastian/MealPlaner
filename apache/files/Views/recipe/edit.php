<?php
/**
 * @var $controller \Controller\EditRecipe
 */
?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded">

                <h2 class="text-center mb-3 pt-3"> Rezept hinzufügen</h2>
                <form class="form" action="<?= $controller->getUrl('?controller=EditRecipe&action=save') ?>" enctype="multipart/form-data" method="post">
                    <?php if (isset($controller->edit)) {?>
                        <input type="hidden" name="id" value="<?= $controller->edit->getId() ?>">
                    <?php } ?>
                    <div class="row w-50 mx-auto form-floating mb-2">
                        <input class="col-12 form-control" name="title" type="text" placeholder="" value="<?= isset($controller->edit) ? $controller->edit->getTitle() : '' ?>" required>
                        <label>Titel</label>
                    </div>
                    <div class="row w-50 mx-auto form-floating mb-2">
                        <textarea class="col-12 form-control" name="recipe"  placeholder="" required><?= isset($controller->edit) ? $controller->edit->getRecipe() : '' ?></textarea>
                        <label>Rezept</label>
                    </div>
                    <div class="row w-50 mx-auto form-floating mb-2">
                        <input class="col-12 form-control" name="portions" type="number" placeholder="" value="<?= isset($controller->edit) ? $controller->edit->getPortions() : '' ?>" required>
                        <label>Portionen</label>
                    </div>
                    <div class="row w-50 mx-auto gx-0 mb-2">
                        <div class="col-2 rounded align-middle my-auto">
                            <label class="" for="image">Bild</label>
                        </div>
                        <div class="col-10">
                            <input id="image" class="col-12 form-control bg-dark" name="image" type="file" required>
                        </div>
                    </div>
                    <div id="recipe2ingredient">
                        <?php if (isset($controller->edit)) {?>
                            <?php $ingredients = $controller->edit->getIngredients() ?>
                            <?php for ($i = 0; $i < count($ingredients); $i++) { ?>
                                <div id="ingredient<?= $ingredients[$i]->getId() ?>" class="card card-body bg-dark w-50 mx-auto mb-2">
                                    <input type="hidden" name="ingredient[<?= $i ?>][id]" value="<?= $ingredients[$i]->getId() ?>">
                                    <div class="row w-50 mx-auto mb-2">
                                        <div class="col-12 d-flex justify-content-around bg-secondary rounded overflow-auto">
                                            <?php $selectIngredients = $controller->getIngredients() ?>
                                            <?php for ($o = 0; $o < count($selectIngredients); $o++) { ?>
                                                <div class="bg-dark text-center rounded my-2 mx-1 p-2">
                                                    <img class="rounded h-6rem d-block mb-2" src="<?= $controller->getUrl('img/giphy.gif') ?>">
                                                    <input class="btn-check" type="radio" name="ingredient[<?= $i ?>][ingredient]" id="ingredient[<?= $i ?>][ingredient]<?= $o ?>" value="<?= $selectIngredients[$o]->getId() ?>" <?= $ingredients[$i]->getIngredient_id() === $selectIngredients[$o]->getId() ? 'checked' : ''?>>
                                                    <label class="btn btn-outline-primary" for="ingredient[<?= $i ?>][ingredient]<?= $o ?>"><?= $selectIngredients[$o]->getIngredient() ?></label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row w-50 mx-auto form-floating mb-2">
                                        <input class="col-12 form-control" name="ingredient[<?= $i ?>][amount]" type="text" placeholder="" value="<?= $ingredients[$i]->getAmount() ?>" required>
                                        <label>Menge</label>
                                    </div>
                                    <div class="row w-50 mx-auto">
                                        <select class="form-select bg-secondary" name="ingredient[<?= $i ?>][unit]" required>
                                            <option value="0" <?= $ingredients[$i]->getUnit() == '0' ? 'selected' : ''?>>Keine Einheit</option>
                                            <?php foreach ($controller->getUnits() as $unit) { ?>
                                                <option value="<?= $unit->getId() ?>" <?= $ingredients[$i]->getUnit() === $unit->getId() ? 'selected' : ''?>><?= $unit->getName() ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php if ($i > 0) { ?>
                                        <div class="row w-50 mx-auto mt-2">
                                            <button class="btn btn-danger" type="button" onclick="deleteIngredient(<?= $ingredients[$i]->getId() ?>)">Löschen</button>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="card card-body bg-dark w-50 mx-auto mb-2">
                                <div class="row w-50 mx-auto mb-2">
                                    <div class="col-12 d-flex justify-content-around bg-secondary rounded overflow-auto">
                                        <?php $electIngredients = $controller->getIngredients() ?>
                                        <?php for ($i = 0; $i < count($electIngredients); $i++) { ?>
                                            <div class="bg-dark text-center rounded my-2 mx-1 p-2">
                                                <img class="rounded h-6rem d-block mb-2" src="<?= $controller->getUrl('img/giphy.gif') ?>">
                                                <input class="btn-check" type="radio" name="ingredient[0][ingredient]" id="ingredient[0][ingredient]<?= $i ?>" value="<?= $electIngredients[$i]->getId() ?>">
                                                <label class="btn btn-outline-primary" for="ingredient[0][ingredient]<?= $i ?>"><?= $electIngredients[$i]->getIngredient() ?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row w-50 mx-auto form-floating mb-2">
                                    <input class="col-12 form-control bg-secondary" name="ingredient[0][amount]" type="text" placeholder="" required>
                                    <label>Menge</label>
                                </div>
                                <div class="row w-50 mx-auto">
                                    <select class="form-select bg-secondary" name="ingredient[0][unit]" required>
                                        <option value="" selected disabled>Einheit</option>
                                        <option value="0">Keine Einheit</option>
                                        <?php foreach ($controller->getUnits() as $unit) { ?>
                                            <option value="<?= $unit->getId() ?>"><?= $unit->getName() ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div>
                        <div class="mx-auto w-50 d-flex justify-content-between">
                            <button id="addIngredient" class="btn btn-primary mb-2" type="button">Zutat hinzufügen</button>
                            <button id="save" class="btn btn-success mb-2" type="submit">Speichern</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="<?= $controller->getUrl('js/editRecipe.js') ?>" defer></script>