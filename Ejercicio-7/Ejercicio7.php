<!DOCTYPE HTML>

<html lang="es">

<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8">
    <meta name="author" content="Alberto Díez Bajo" />
    <meta name="copyright" content="Alberto Díez Bajo" />
    <meta name="description" content="Realiza gestiones sobre instalaciones de un gimnasio" />
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <title>Gestion de instalaciones</title>
    <link rel="stylesheet" type="text/css" href="Ejercicio7.css" />
</head>

<body>
    <header>
        <!-- Datos con el contenidos que aparece en el navegador -->
        <h1>Gestion de instalaciones</h1>
    </header>
    <article>
        <h2>Realiza gestiones sobre instalaciones de un gimnasio</h2>
        <p>
            Aquí podrás realizar gestiones sobre instalaciones de un gimnasio, y sus recursos.
            Primero de todo, deberás de crear la base de datos y las tablas!
        </p>
    </article>
    <article>
        <h2>
            Menú de operaciones.
        </h2>
        <?php
        echo"
        <ul>
            <li><a href='CrearBaseDeDatos.php' title='Crear Base de Datos Del Gimnasio'>Crear Base de Datos Del Gimnasio</a></li>
            <li><a href='CrearTabla.php' title='Crear Tabla'>Crear las Tablas del Gimnasio</a></li>
            <li><a href='ConsultaRecursoInstalacion.php' title='Consulta los recursos que tiene una instalacion'>Consulta los recursos que tiene una instalación</a></li>
            <li><a href='ConsultaInstalacionRecurso.php' title='Consulta los instalaciones en las que hay un recurso determinado'>Consulta los instalaciones en las que hay un recurso determinado</a></li>
        </ul>";
        ?>
    </article>
    <footer>
        <p>Web HTML y CSS válida</p>
    </footer>
</body>

</html>