<?php
/**
 * @var $controller \Controller\EditRecipe
 */
?>
<h2 class="text-center mb-3"> Rezept hinzufügen</h2>
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
    <div id="recipe2ingredient">
        <?php if (isset($controller->edit)) {?>
            <?php $ingredients = $controller->edit->getIngredients() ?>
            <?php for ($i = 0; $i < count($ingredients); $i++) { ?>
                <div id="ingredient<?= $ingredients[$i]->getId() ?>" class="card card-body w-50 mx-auto mb-2">
                    <input type="hidden" name="ingredient[<?= $i ?>][id]" value="<?= $ingredients[$i]->getId() ?>">
                    <div class="row w-50 mx-auto mb-2">
                        <select class="form-select" name="ingredient[<?= $i ?>][ingredient]" required>
                            <option value="" selected disabled>Zutat</option>
                            <?php foreach ($controller->getIngredients() as $ingredient) { ?>
                                <option value="<?= $ingredient->getId() ?>"><?= $ingredient->getIngredient() ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="row w-50 mx-auto form-floating mb-2">
                        <input class="col-12 form-control" name="ingredient[<?= $i ?>][amount]" type="text" placeholder="" required>
                        <label>Menge</label>
                    </div>
                    <div class="row w-50 mx-auto">
                        <select class="form-select" name="ingredient[<?= $i ?>][unit]" required>
                            <option value="" selected disabled>Einheit</option>
                            <option value="0">Keine Einheit</option>
                            <?php foreach ($controller->getUnits() as $unit) { ?>
                                <option value="<?= $unit->getId() ?>"><?= $unit->getName() ?></option>
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
            <div class="card card-body w-50 mx-auto mb-2">
                <div class="row w-50 mx-auto mb-2">
                    <select class="form-select" name="ingredient[0][ingredient]" required>
                        <option value="" selected disabled>Zutat</option>
                        <?php foreach ($controller->getIngredients() as $ingredient) { ?>
                            <option value="<?= $ingredient->getId() ?>"><?= $ingredient->getIngredient() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="row w-50 mx-auto form-floating mb-2">
                    <input class="col-12 form-control" name="ingredient[0][amount]" type="text" placeholder="" required>
                    <label>Menge</label>
                </div>
                <div class="row w-50 mx-auto">
                    <select class="form-select"name="ingredient[0][unit]" required>
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
            <button id="addIngredient" class="btn btn-primary" type="button">Zutat hinzufügen</button>
            <button id="save" class="btn btn-success" type="submit">Speichern</button>
        </div>
    </div>
</form>

<script src="<?= $controller->getUrl('js/EditRecipe.js') ?>"></script>