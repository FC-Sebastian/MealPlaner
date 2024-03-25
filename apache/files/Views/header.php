<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?php if (isset($title)) {echo $title;}?>
        </title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?= $controller->getUrl("css/bootstrap.min.css");?>" rel="stylesheet">
        <link href="<?= $controller->getUrl("css/style.css");?>" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <script type="text/javascript">
            const url = '<?= $controller->getUrl() ?>';
        </script>
    </head>

    <body onload="<?php echo $controller->getOnload()?>">
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4">
                    <h3 class="text-primary">MealPlaner</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="<?= $controller->getUrl() ?>" class="nav-item nav-link <?= $controller->isActiveHeader('dash') ? 'active' : '' ?>"><i class="fa fa-calendar-alt me-2"></i>Wochenplan</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?= $controller->isActiveHeader('recipe') ? 'active' : '' ?>" data-bs-toggle="dropdown"><i class="fa fa-newspaper me-2"></i>Rezepte</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?= $controller->getUrl() ?>" class="dropdown-item <?= $controller->isActiveHeader('recipe') && $controller->isActiveSubHeader('show') ? 'active' : '' ?>">Anzeigen</a>
                            <a href="<?= $controller->getUrl('?controller=EditRecipe') ?>" class="dropdown-item <?= $controller->isActiveHeader('recipe') && $controller->isActiveSubHeader('edit') ? 'active' : '' ?>">Bearbeiten</a>
                        </div>
                    </div><div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?= $controller->isActiveHeader('ingredient') ? 'active' : '' ?>" data-bs-toggle="dropdown"><i class="fa fa-seedling me-2"></i>Zutaten</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="<?= $controller->getUrl() ?>" class="dropdown-item <?= $controller->isActiveHeader('ingredient') && $controller->isActiveSubHeader('show') ? 'active' : '' ?>">Anzeigen</a>
                            <a href="<?= $controller->getUrl('?controller=EditIngredient') ?>" class="dropdown-item <?=  $controller->isActiveHeader('ingredient') && $controller->isActiveSubHeader('edit') ? 'active' : '' ?>">Bearbeiten</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-2 py-2">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
            </nav>
            <!-- Navbar End -->

            <?php if ($controller->getError() !== false):?>
                <div class="bg-danger bg-opacity-25 border border-5 border-danger border-end-0 border-start-0">
                    <div class="w-50 m-auto">
                        <h1 class="fw-bold fs-2">Error:</h1>
                        <p class="fs-5">
                            <?php echo $controller->getError()?>
                        </p>
                    </div>
                </div>
            <?php endif;?>

