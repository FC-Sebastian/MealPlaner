<?php
/**
 * @var $controller \Controller\EditIngredient
 */
?>
<h2 class="text-center mb-3"> Zutat hinzufügen</h2>
<form class="form" action="<?= $controller->getUrl('?controller=EditIngredient&action=save') ?>">
    <div class="row w-50 mx-auto form-floating mb-4">
        <input class="col-12 form-control" type="text" placeholder="">
        <label>Bezeichnung</label>
    </div>
    <h6 class="text-center mb-2">Wie kann die Zutat gekauft werden?</h6>
    <div id="amount2ingredient">
        <div class="">
            <div class="row w-50 mx-auto form-floating mb-2">
                <input class="col-12 form-control" type="text" placeholder="">
                <label>Preis</label>
            </div>
            <div class="row w-50 mx-auto form-floating mb-2">
                <input class="col-12 form-control" type="text" placeholder="">
                <label>Menge</label>
            </div>
            <div class="row w-50 mx-auto mb-2">
                <select class="form-select">
                    <option>Einheit</option>
                    <?php foreach ($controller->getUnits() as $unit) { ?>
                        <option value="<?= $unit->getId() ?>"><?= $unit->getName() ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div>
        <div class="mx-auto w-50">
            <button id="addBuy" class="btn btn-outline-success" type="button">Kaufoption hinzufügen</button>
        </div>
    </div>
</form>