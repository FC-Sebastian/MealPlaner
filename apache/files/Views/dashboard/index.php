<?php
/**
 * @var $controller \Controller\Dashboard
 */
?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-8">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="row">
                    <div class="col-12 d-flex justify-content-around">
                        <div class="flex-fill border border-top-0 border-start-0 position-relative h-2rem"><span class="position-absolute top-0 start-0">Mo</span></div>
                        <div class="flex-fill border border-top-0 position-relative h-2rem"><span class="position-absolute top-0 start-0">Di</span></div>
                        <div class="flex-fill border border-top-0 position-relative h-2rem"><span class="position-absolute top-0 start-0">Mi</span></div>
                        <div class="flex-fill border border-top-0 position-relative h-2rem"><span class="position-absolute top-0 start-0">Do</span></div>
                        <div class="flex-fill border border-top-0 position-relative h-2rem"><span class="position-absolute top-0 start-0">Fr</span></div>
                        <div class="flex-fill border border-top-0 position-relative h-2rem"><span class="position-absolute top-0 start-0">Sa</span></div>
                        <div class="flex-fill border border-top-0 border-end-0 position-relative h-2rem"><span class="position-absolute top-0 start-0">So</span></div>
                    </div>
                    <?= $controller->getDays() ?>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="bg-secondary rounded p-4">

                <h5>Einkaufszettel:</h5>
                <table class="table table-fixed">
                    <thead>
                    <tr>
                        <th>Menge</th>
                        <th>Enheit</th>
                        <th>Zutat</th>
                        <th>Preis</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <div class="h-10rem overflow-auto">
                    <table class="table table-fixed">
                    </table>
                </div>

                <table class="table table-fixed">
                    <thead><tr><td colspan="4"></td></tr></thead>
                    <tbody>
                        <tr>
                            <td colspan="3">Insgesamt:</td>
                            <td>0,00 €</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="col-12">
            <div class="row justify-content-around">

                    <div class="col-8">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div class="row">
                                <div>
                                    <div class="">Rezepte</div>
                                </div>

                                <div class="overflow-auto d-flex h-20rem">
                                    <?php foreach ($controller->getRecipes() as $recipe) { ?>
                                        <div class="me-2 p-2 text-center bg-dark rounded">
                                            <img class="rounded h-75" src="<?= $controller->getUrl('img/giphy.gif') ?>">
                                            <div class="w-100 text-wrap mx-auto"><?= $recipe->getTitle() ?></div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div class="row justify-content-around">
                                <div>
                                    <span>Rezeptvorschläge</span>
                                </div>
                                <div class="overflow-auto text-nowrap">
                                    <div class="col-12 d-flex flex-column h-20rem">
                                        <?php if (false) { ?>
                                            <div class="mb-1 p-2 text-center bg-dark rounded">
                                                <img class="rounded w-100" src="<?= $controller->getUrl('img/giphy.gif') ?>">
                                                <div class="w-100 text-wrap mx-auto">Ente</div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>

    </div>
</div>
