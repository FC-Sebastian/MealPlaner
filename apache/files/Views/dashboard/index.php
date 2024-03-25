<?php
/**
 * @var $controller \Controller\Dashboard
 */
?>

<div class="row mt-3">
    <div class="col-9">
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th>Mo</th>
                    <th>Di</th>
                    <th>Mi</th>
                    <th>Do</th>
                    <th>Fr</th>
                    <th>Sa</th>
                    <th>So</th>
                </tr>
            </thead>
            <tbody>
                <?= $controller->getDays() ?>
            </tbody>
        </table>
    </div>
    <div class="col-3">
        <table class="table table-bordered w-100">
            <tr>
                <th>Rezepte</th>
            </tr>
            <?php foreach ($controller->getRecipes() as $recipe) { ?>
                <tr>
                    <td><?= $recipe->getTitle() ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table table-bordered w-100">
            <tr>
                <th>Rezeptvorschläge</th>
            </tr>
        </table>
    </div>
</div>
