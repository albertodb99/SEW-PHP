<!DOCTYPE HTML>

<html lang="es">

<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8">
    <meta name="author" content="Alberto Díez Bajo" />
    <meta name="copyright" content="Alberto Díez Bajo" />
    <meta name="description" content="Página web para ver y realizar operaciones sobre una base de datos" />
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <title>Operaciones en MySQL</title>
    <link rel="stylesheet" type="text/css" href="Ejercicio6.css" />
</head>

<body>
    <header>
        <!-- Datos con el contenidos que aparece en el navegador -->
        <h1>Operaciones en MySQL</h1>
    </header>
    <article>
        <h2>Realiza aquí tus operaciones con una base de datos en MySQL</h2>
        <p>
            Aquí podrás realizar una serie de operaciones en MySQL, tales como crear una tabla,
            o incluso exportar los resultados a una hoja de cálculo.
        </p>
    </article>
    <article>
        <h2>
            Menú de operaciones.
        </h2>
        <?php
        echo"
        <ul>
            <li><a href='CrearBaseDeDatos.php' title='Crear Base de Datos'>Crear Base de Datos</a></li>
            <li><a href='CrearTabla.php' title='Crear Tabla'>Crear una Tabla </a></li>
            <li><a href='InsertarDatos.php' title='Insertar Datos en una Tabla'>Insertar Datos en una tabla</a></li>
            <li><a href='BuscarDatos.php' title='Buscar Datos de la Tabla'>Buscar Datos de una tabla </a></li>
            <li><a href='ModificarDatos.php' title='ModificarDatos'>Modificar Datos en una tabla</a></li>
            <li><a href='EliminarDatos.php' title='Eliminar Datos de una Tabla'>Eliminar Datos en una tabla </a></li>
            <li><a href='GenerarInforme.php' title='Generar Informe'>Generar Informe</a></li>
            <li><a href='ImportarDatos.php' title='importarDatosTabla'>Cargar datos desde un archivo en una tabla de la
                    Base de Datos</a></li>
            <li><a href='ExportarDatos.php' title='Exportar los Datos de la Tabla'>Exportar datos a un archivo los datos desde una
                    tabla de la Base de Datos</a></li>
        </ul>";
        ?>
    </article>
    <footer>
        <p>Web HTML y CSS válida</p>
    </footer>
</body>

</html>