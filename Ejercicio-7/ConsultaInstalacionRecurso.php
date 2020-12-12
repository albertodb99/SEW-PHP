<!DOCTYPE html>

<html lang="es">

<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8">
    <meta name="author" content="Alberto Díez Bajo" />
    <meta name="copyright" content="Alberto Díez Bajo" />
    <meta name="description" content="En esta sección, podrás buscar las instalaciones que tienen un recurso determinado" />
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <title>Gestion de Instalaciones: Instalaciones por recurso</title>
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
                $idRecurso = $_POST['recursos'];

                    $baseDatos->mostrarInstalacionesPorRecurso($idRecurso);
            }
        }
        echo   "<form action='#' method='post'>
                <label for='recursos'>Escoge un recurso:</label>

                <select name='recursos' id='recursos'>
                <option value='1'>Mancuernas</option>
                <option value='2'>Discos de 5kg</option>
                <option value='3'>Pesas</option>
                <option value='4'>Bicicletas</option>
                <option value='5'>Cintas de Correr</option>
                <option value='6'>Colchonetas</option>
                <option value='7'>Remos</option>
                <option value='8'>Churros de Flotación</option>
                </select>
                <p><p>
                <input type = 'submit' class='button' name = 'consultaRecursos' value = 'Consulta las instalaciones'/>
                </form>";
        ?>
    </article>
    <footer>
        <p>Web HTML y CSS válida</p>
    </footer>
</body>

</html>