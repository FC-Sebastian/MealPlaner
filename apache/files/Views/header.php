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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $url;?>">
        <script src="<?= $controller->getUrl("js/jquery-3.6.3.js") ?>"></script>
        <script src="<?= $controller->getUrl("js/base.js") ?>"></script>
        <script type="text/javascript">
            const url = '<?= $controller->getUrl() ?>';
        </script>
    </head>
    <body class="bg-primary bg-opacity-10" onload="<?php echo $controller->getOnload()?>">
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
        <div class="container  min-vh-100 shadow bg-white pt-3">

