<!doctype html>
<html>
    <head>
        <title><?php echo $titulo; ?></title>
    </head>
    <body>
        <h1>Prueba RUDA</h1>
        <?php
        foreach ($carreras as $item):
            ?>
            <h2><?php echo $item->denominacion; ?></h2>
            <hr>
            <?php
        endforeach;
        ?>
    </body>
</html>
