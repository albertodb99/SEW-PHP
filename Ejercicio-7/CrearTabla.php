<!DOCTYPE html>

<html lang="es">

<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8">
    <meta name="author" content="Alberto Díez Bajo" />
    <meta name="copyright" content="Alberto Díez Bajo" />
    <meta name="description" content="En esta sección, podrás crear las tablas pertinentes del gimnasio" />
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <title>Operaciones en MySQL: Crear Tabla de Pruebas de Usabilidad</title>
    <link rel="stylesheet" type="text/css" href="Ejercicio7.css" />
</head>

<body>
    <header>
        <!-- Datos con el contenidos que aparece en el navegador -->
        <h1>Operaciones en MySQL</h1>
    </header>
    <article>
        <h2>Crear Tablas del Gimnasio</h2>
        <ul>
            <li><a href="Ejercicio7.php" title="Volver al menú principal">Volver al menú principal</a></li>
        </ul>
        <p>
            Pinchando en el botón de abajo, podrás crear las tablas necesarias para poder realizar gestiones con los datos!
        </p>
        <?php
        if (count($_POST) > 0) {
            include("BaseDatos.php");
            $baseDatos = new BaseDatos();
            if (isset($_POST['crearTabla'])) $baseDatos->crearTabla();
        }
        echo   "<form action='#' method='post'>
                <input type = 'submit' class='button' name = 'crearTabla' value = 'Crear Tablas del Gimnasio'/>
                </form>";
        ?>
    </article>
    <footer>
        <p>Web HTML y CSS válida</p>
    </footer>
</body>

</html>