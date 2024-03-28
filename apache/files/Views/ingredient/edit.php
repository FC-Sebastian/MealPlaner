<?php
/**
 * @var $controller \Controller\EditIngredient
 */
?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded">

                <h2 class="text-center mb-3"> Zutat hinzufügen</h2>
                <form class="form" action="<?= $controller->getUrl('?controller=EditIngredient&action=save') ?>" enctype="multipart/form-data" method="post">
                    <?php if (isset($controller->edit)) {?>
                        <input type="hidden" name="id" value="<?= $controller->edit->getId() ?>">
                    <?php } ?>
                    <div class="row w-50 mx-auto form-floating mb-4">
                        <input class="col-12 form-control" name="ingredient" type="text" placeholder="" value="<?= isset($controller->edit) ? $controller->edit->getIngredient() : '' ?>" required>
                        <label>Bezeichnung</label>
                    </div>
                    <h6 class="text-center mb-2">Wie kann die Zutat gekauft werden?</h6>
                    <div id="amount2ingredient">
                        <?php if (isset($controller->edit)) {?>
                            <?php $buyOptions = $controller->edit->getBuyOptions() ?>
                            <?php for ($i = 0; $i < count($buyOptions); $i++) { ?>
                                <div id="buyOption<?= $buyOptions[$i]->getId() ?>" class="card card-body w-50 mx-auto mb-2">
                                    <input type="hidden" name="buyOption[<?= $i ?>][id]" value="<?= $buyOptions[$i]->getId() ?>">
                                    <div class="row w-50 mx-auto form-floating mb-2">
                                        <input class="col-12 form-control" name="buyOption[<?= $i ?>][price]" type="text" placeholder="" value="<?= $buyOptions[$i]->getPrice() ?>" required>
                                        <label>Preis</label>
                                    </div>
                                    <div class="row w-50 mx-auto form-floating mb-2">
                                        <input class="col-12 form-control" name="buyOption[<?= $i ?>][amount]" type="text" placeholder="" value="<?= $buyOptions[$i]->getAmount() ?>" required>
                                        <label>Menge</label>
                                    </div>
                                    <div class="row w-50 mx-auto">
                                        <select class="form-select" name="buyOption[<?= $i ?>][unit]" required>
                                            <option value="0" <?= $buyOptions[$i]->getUnit() == 0 ? 'selected' : ''?>>Keine Einheit</option>
                                            <?php foreach ($controller->getUnits() as $unit) { ?>
                                                <option value="<?= $unit->getId() ?>" <?= $buyOptions[$i]->getUnit() == $unit->getId() ? 'selected' : ''?>><?= $unit->getName() ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php if ($i > 0) { ?>
                                        <div class="row w-50 mx-auto mt-2">
                                            <button class="btn btn-danger" type="button" onclick="deleteBuyOption(<?= $buyOptions[$i]->getId() ?>)">Löschen</button>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="card card-body bg-dark w-50 mx-auto mb-2">
                                <div class="row w-50 mx-auto form-floating mb-2">
                                    <input class="col-12 form-control bg-secondary" name="buyOption[0][price]" type="text" placeholder="" required>
                                    <label>Preis</label>
                                </div>
                                <div class="row w-50 mx-auto form-floating mb-2">
                                    <input class="col-12 form-control bg-secondary" name="buyOption[0][amount]" type="text" placeholder="" required>
                                    <label>Menge</label>
                                </div>
                                <div class="row w-50 mx-auto">
                                    <select class="form-select bg-secondary" name="buyOption[0][unit]" required>
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
                            <button id="addBuy" class="btn btn-primary mb-2" type="button">Kaufoption hinzufügen</button>
                            <button id="save" class="btn btn-success mb-2" type="submit">Speichern</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="<?= $controller->getUrl('js/editIngredient.js') ?>" defer></script>