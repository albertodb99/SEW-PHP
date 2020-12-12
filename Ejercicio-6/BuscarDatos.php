<!DOCTYPE html>

<html lang="es">

<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8">
    <meta name="author" content="Alberto Díez Bajo" />
    <meta name="copyright" content="Alberto Díez Bajo" />
    <meta name="description" content="En esta sección, podrás buscar un registro" />
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <title>Operaciones en MySQL: Buscar un registro</title>
    <link rel="stylesheet" type="text/css" href="Ejercicio6.css" />
</head>

<body>
    <header>
        <!-- Datos con el contenidos que aparece en el navegador -->
        <h1>Operaciones en MySQL</h1>
    </header>
    <article>
        <h2>Buscar un registro</h2>
        <ul>
            <li><a href="Ejercicio6.php" title="Volver al menú principal">Volver al menú principal</a></li>
        </ul>
        <p>
            Introduce aquí los datos para buscar un registro:
        </p>
        <?php
        if (count($_POST) > 0) {
            include("BaseDatos.php");
            $baseDatos = new BaseDatos();
            if (isset($_POST['buscarRegistro'])) {
                $flag = true;
                $dni = $_POST['dni'];

                if ($dni === '') {
                    $flag = false;
                }

                if ($flag) {
                    $baseDatos->mostrarRegistro(
                        $dni
                    );
                } else {
                    echo "<p>Ha habido datos inconsistentes, inténtelo otra vez</p>";
                }
            }
        }
        echo   "<form action='#' method='post'>
                <label for = 'dni'>DNI:</label>
                <input type = 'text' id = 'dni' name = 'dni'/>
                <p><p>
                <input type = 'submit' class='button' name = 'buscarRegistro' value = 'Buscar registro'/>
                </form>";
        ?>
    </article>
    <footer>
        <p>Web HTML y CSS válida</p>
    </footer>
</body>

</html>