<!DOCTYPE html>

<html lang="es">

<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8">
    <meta name="author" content="Alberto Díez Bajo" />
    <meta name="copyright" content="Alberto Díez Bajo" />
    <meta name="description" content="En esta sección, podrás crear la base de datos si no está creada aún" />
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <title>Operaciones en MySQL: Crear Base de Datos</title>
    <link rel="stylesheet" type="text/css" href="Ejercicio7.css" />
</head>

<body>
    <header>
        <!-- Datos con el contenidos que aparece en el navegador -->
        <h1>Gestion de instalaciones</h1>
    </header>
    <article>
        <h2>Crear Base de Datos</h2>
        <ul>
            <li><a href="Ejercicio7.php" title="Volver al menú principal">Volver al menú principal</a></li>
        </ul>
        <p>
            Pinchando en el botón de abajo, podrás generar la base de datos del gimnasio!
        </p>
        <?php
        if (count($_POST) > 0) {
            include("BaseDatos.php");
            $baseDatos = new BaseDatos();
            if (isset($_POST['crear'])) $baseDatos->crearBaseDeDatos();
        }
        echo   "<form action='#' method='post'>
                <input type = 'submit' class='button' name = 'crear' value = 'Crear Base de Datos'/>
                </form>";
        ?>
    </article>
    <footer>
        <p>Web HTML y CSS válida</p>
    </footer>
</body>

</html>