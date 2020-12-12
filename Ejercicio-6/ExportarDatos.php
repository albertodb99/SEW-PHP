<!DOCTYPE html>

<html lang="es">

<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8">
    <meta name="author" content="Alberto Díez Bajo" />
    <meta name="copyright" content="Alberto Díez Bajo" />
    <meta name="description" content="En esta sección, podrás exportar los datos de la tabla en una hoja de cálculo" />
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <title>Operaciones en MySQL: Exportar Datos</title>
    <link rel="stylesheet" type="text/css" href="Ejercicio6.css" />
</head>

<body>
    <header>
        <!-- Datos con el contenidos que aparece en el navegador -->
        <h1>Operaciones en MySQL</h1>
    </header>
    <article>
        <h2>Exportar Datos</h2>
        <ul>
            <li><a href="Ejercicio6.php" title="Volver al menú principal">Volver al menú principal</a></li>
        </ul>
        <p>
            Pinchando en el botón de abajo, podrás exportar los datos de la tabla!
        </p>
        <?php
        if (count($_POST) > 0) {
            include("BaseDatos.php");
            $baseDatos = new BaseDatos();
            if (isset($_POST['exportarDatos'])) $baseDatos->exportarResultados();
        }
        echo   "<form action='#' method='post'>
                <input type = 'submit' class='button' name = 'exportarDatos' value = 'Exportar Datos'/>
                </form>";
        ?>
    </article>
    <footer>
        <p>Web HTML y CSS válida</p>
    </footer>
</body>

</html>