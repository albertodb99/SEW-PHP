<!DOCTYPE html>

<html lang="es">

<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8">
    <meta name="author" content="Alberto Díez Bajo" />
    <meta name="copyright" content="Alberto Díez Bajo" />
    <meta name="description" content="En esta sección, podrás buscar los recursos que contiene una instalacion" />
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <title>Gestion de Instalaciones: Recursos por instalacion</title>
    <link rel="stylesheet" type="text/css" href="Ejercicio7.css" />
</head>

<body>
    <header>
        <!-- Datos con el contenidos que aparece en el navegador -->
        <h1>Gestion de Instalaciones</h1>
    </header>
    <article>
        <h2>Recursos por instalacion</h2>
        <ul>
            <li><a href="Ejercicio7.php" title="Volver al menú principal">Volver al menú principal</a></li>
        </ul>
        <p>
            Introduce aquí los datos para buscar un registro:
        </p>
        <?php
        if (count($_POST) > 0) {
            include("BaseDatos.php");
            $baseDatos = new BaseDatos();
            if (isset($_POST['consultaRecursos'])) {
                $nombreInstalacion = $_POST['instalaciones'];

                    $baseDatos->mostrarRecursosPorInstalacion($nombreInstalacion);
            }
        }
        echo   "<form action='#' method='post'>
                <label for='instalaciones'>Escoge una instalacion:</label>

                <select name='instalaciones' id='instalaciones'>
                <option value='1'>Gimnasio Central</option>
                <option value='2'>Piscina</option>
                <option value='3'>Sala Polivalente</option>
                <option value='4'>Sauna</option>
                <option value='5'>Sala Exterior</option>
                </select>
                <p><p>
                <input type = 'submit' class='button' name = 'consultaRecursos' value = 'Consulta los recursos'/>
                </form>";
        ?>
    </article>
    <footer>
        <p>Web HTML y CSS válida</p>
    </footer>
</body>

</html>