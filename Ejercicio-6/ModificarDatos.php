<!DOCTYPE html>

<html lang="es">

<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8">
    <meta name="author" content="Alberto Díez Bajo" />
    <meta name="copyright" content="Alberto Díez Bajo" />
    <meta name="description" content="En esta sección, podrás modificar un registro" />
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <title>Operaciones en MySQL: Modificar un registro</title>
    <link rel="stylesheet" type="text/css" href="Ejercicio6.css" />
</head>

<body>
    <header>
        <!-- Datos con el contenidos que aparece en el navegador -->
        <h1>Operaciones en MySQL</h1>
    </header>
    <article>
        <h2>Modificar un registro</h2>
        <ul>
            <li><a href="Ejercicio6.php" title="Volver al menú principal">Volver al menú principal</a></li>
        </ul>
        <p>
            Introduce aquí los datos para modificar un registro.
            El DNI debe de ser el mismo. Puedes dejar en blanco los campos que no quieres modificar.
            Los datos inconsistentes con respecto a los anteriores se mantendrán.
        </p>
        <?php
        if (count($_POST) > 0) {
            include("BaseDatos.php");
            $baseDatos = new BaseDatos();
            if (isset($_POST['modificarRegistro'])) {
                $dni = $_POST['dni'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $edad = $_POST['edad'];
                $sexo = $_POST['sexo'];
                $nivel = $_POST['nivel'];
                $tiempo = $_POST['tiempo'];
                $correcta = $_POST['correcta'];
                $comentarios = $_POST['comentarios'];
                $propuestas = $_POST['propuestas'];
                $valoracion = $_POST['valoracion'];

                $baseDatos->modificarRegistro(
                    $dni,
                    $nombre,
                    $apellidos,
                    $email,
                    $telefono,
                    $edad,
                    $sexo,
                    $nivel,
                    $tiempo,
                    $correcta,
                    $comentarios,
                    $propuestas,
                    $valoracion
                );
            }
        }
        echo   "<form action='#' method='post'>
                <label for = 'dni'>DNI:</label>
                <input type = 'text' id = 'dni' name = 'dni'/>
                <label for = 'nombre'>Nombre:</label>
                <input type = 'text' id = 'nombre' name = 'nombre'/>
                <label for = 'apellidos'>Apellidos:</label>
                <input type = 'text' id = 'apellidos' name = 'apellidos'/>
                <label for = 'email'>Email:</label>
                <input type = 'text' id = 'email' name = 'email'/>
                <label for = 'telefono'>Telefono:</label>
                <input type = 'text' id = 'telefono' name = 'telefono'/>
                <label for = 'edad'>Edad:</label>
                <input type = 'number' id = 'edad' name = 'edad'/>
                <label for = 'sexo'>Sexo:</label>
                <input type = 'text' id = 'sexo' name = 'sexo'/>
                <label for = 'nivel'>Nivel(0 al 10):</label>
                <input type = 'number' id = 'nivel' name = 'nivel'/>
                <label for = 'tiempo'>Tiempo(s):</label>
                <input type = 'number' id = 'tiempo' name = 'tiempo'/>
                <label for = 'correcta'>¿Es correcta?:</label>
                <input type = 'text' id = 'correcta' name = 'correcta'/>
                <label for = 'comentarios'>Comentarios:</label>
                <input type = 'text' id = 'comentarios' name = 'comentarios'/>
                <label for = 'propuestas'>Propuestas:</label>
                <input type = 'text' id = 'propuestas' name = 'propuestas'/>
                <label for = 'valoracion'>Valoración(0 al 10):</label>
                <input type = 'number' id = 'valoracion' name = 'valoracion'/>
                <p><p>
                <input type = 'submit' class='button' name = 'modificarRegistro' value = 'Modificar registro'/>
                </form>";
        ?>
    </article>
    <footer>
        <p>Web HTML y CSS válida</p>
    </footer>
</body>

</html>