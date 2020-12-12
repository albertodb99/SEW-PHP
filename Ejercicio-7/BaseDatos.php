<?php
class BaseDatos
{
    private $usuario;
    private $host;
    private $contraseña;
    private $nombreBase;

    public function __construct()
    {
        $this->usuario = "DBUSER2020";
        $this->host = "localhost";
        $this->contraseña = "DBPSWD2020";
        $this->nombreBase = "BaseGimnasio";
    }

    public function crearBaseDeDatos()
    {
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consulta = "CREATE DATABASE IF NOT EXISTS $this->nombreBase";
        if ($connection->query($consulta)) {
            echo "<p>$this->nombreBase creada correctamente</p>";
        } else {
            echo "<p>ERROR: $this->nombreBase. No se ha podido crear correctamente: $connection->connect_error</p>";
            exit();
        }
        $connection->close();
    }

    public function crearTabla()
    {
        $nombreTabla1 = "Instalacion";
        $nombreTabla2 = "Recurso";
        $nombreTabla3 = "Tiene";

        $connection = new mysqli($this->host, $this->usuario, $this->contraseña, $this->nombreBase);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consulta1 = "CREATE TABLE IF NOT EXISTS $nombreTabla1 (
            idInstalacion INT,
            nombre VARCHAR(20) not null,
            precioH INT,
            estado VARCHAR(20),
            PRIMARY KEY (idInstalacion)
        )";
        if ($connection->query($consulta1)) {
            echo "<p>$this->nombreBase - $nombreTabla1 creada correctamente</p>";
        } else {
            echo "<p>ERROR: $this->nombreBase - $nombreTabla1. No se ha podido crear correctamente la tabla: $connection->connect_error</p>";
            exit();
        }
        $consulta2 = "CREATE TABLE IF NOT EXISTS $nombreTabla2 (
            idRecurso INT,
            nombre VARCHAR(30) not null,
            PRIMARY KEY (idRecurso)
        )";
        if ($connection->query($consulta2)) {
            echo "<p>$this->nombreBase - $nombreTabla2 creada correctamente</p>";
        } else {
            echo "<p>ERROR: $this->nombreBase - $nombreTabla2. No se ha podido crear correctamente la tabla: $connection->connect_error</p>";
            exit();
        }
        $consulta3 = "CREATE TABLE IF NOT EXISTS $nombreTabla3 (
            idInstalacion INT,
	        idRecurso INT,
	        cantidad INT,
	        PRIMARY KEY(idInstalacion, idRecurso),
            FOREIGN KEY(idRecurso) REFERENCES Recurso(idRecurso),
            FOREIGN KEY(idInstalacion) REFERENCES Instalacion(idInstalacion)
        )";
        if ($connection->query($consulta3)) {
            echo "<p>$this->nombreBase - $nombreTabla3 creada correctamente</p>";
        } else {
            echo "<p>ERROR: $this->nombreBase - $nombreTabla3. No se ha podido crear correctamente la tabla: $connection->connect_error</p>";
            exit();
        }
        $this->añadirInstalaciones();
        $this->añadirRecursos();
        $this->añadirTienes();
        $connection->close();
    }

    public function añadirInstalaciones()
    {
        $this->añadirInstalacion(1, "Gimnasio Central", 30, "CERRADO");
        $this->añadirInstalacion(2, 'Piscina', 50, 'ABIERTO');
        $this->añadirInstalacion(3, 'Sala Polivalente', 25, 'ABIERTO');
        $this->añadirInstalacion(4, 'Sauna', 20, 'ABIERTO');
        $this->añadirInstalacion(5, 'Sala Exterior', 60, 'ABIERTO');
    }

    public function añadirRecursos()
    {
        $this->añadirRecurso(1, 'Mancuernas');
        $this->añadirRecurso(2, 'Discos de 5kg');
        $this->añadirRecurso(3, 'Pesas');
        $this->añadirRecurso(4, 'Bicicletas');
        $this->añadirRecurso(5, 'Cintas de correr');
        $this->añadirRecurso(6, 'Colchonetas');
        $this->añadirRecurso(7, 'Remos');
        $this->añadirRecurso(8, 'Churros de flotación');
    }

    public function añadirTienes()
    {
        $this->añadirTiene(1, 1, 5);
        $this->añadirTiene(1, 2, 10);
        $this->añadirTiene(1, 3, 7);
        $this->añadirTiene(1, 6, 2);
        $this->añadirTiene(2, 7, 8);
        $this->añadirTiene(2, 8, 25);
        $this->añadirTiene(3, 4, 12);
        $this->añadirTiene(3, 5, 8);
        $this->añadirTiene(5, 1, 12);
        $this->añadirTiene(5, 2, 20);
    }

    public function añadirInstalacion(
        $idInstalacion,
        $nombre,
        $precioH,
        $estado
    ) {
        $nombreTabla = "Instalacion";
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña, $this->nombreBase);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consulta = $connection->prepare("REPLACE INTO $nombreTabla (idInstalacion, nombre, precioH, estado)
        VALUES (?,?,?,?)");
        $consulta->bind_param(
            'isis',
            $idInstalacion,
            $nombre,
            $precioH,
            $estado
        );
        $consulta->execute();

        if ($consulta->affected_rows > 0) {
            echo "<p>Instalación:  $nombre añadida correctamente </p>";
        }

        $consulta->close();
        $connection->close();
    }

    public function añadirRecurso(
        $idRecurso,
        $nombre
    ) {
        $nombreTabla = "Recurso";
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña, $this->nombreBase);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consulta = $connection->prepare("REPLACE INTO $nombreTabla (idRecurso, nombre)
        VALUES (?,?)");
        $consulta->bind_param(
            'is',
            $idRecurso,
            $nombre,
        );
        $consulta->execute();

        if ($consulta->affected_rows > 0) {
            echo "<p>Recurso:  $nombre añadida correctamente </p>";
        }

        $consulta->close();
        $connection->close();
    }

    public function añadirTiene(
        $idInstalacion,
        $idRecurso,
        $cantidad
    ) {
        $nombreTabla = "Tiene";
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña, $this->nombreBase);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consulta = $connection->prepare("REPLACE INTO $nombreTabla (idInstalacion ,idRecurso, cantidad)
        VALUES (?,?,?)");
        $consulta->bind_param(
            'iii',
            $idInstalacion,
            $idRecurso,
            $cantidad
        );
        $consulta->execute();

        if ($consulta->affected_rows > 0) {
            echo "<p>Tiene: Relacion añadida correctamente </p>";
        }

        $consulta->close();
        $connection->close();
    }



    public function mostrarRecursosPorInstalacion($nombreInstalacion)
    {
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña, $this->nombreBase);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consulta = $connection->prepare("SELECT i.nombre as nombreInstalacion , r.idRecurso, r.nombre as nombreRecurso
        FROM recurso r, tiene t, instalacion i
        WHERE r.idRecurso = t.idRecurso
        AND t.idInstalacion = i.idInstalacion
        AND i.idInstalacion = ?");
        $consulta->bind_param(
            'i',
            $nombreInstalacion
        );
        $consulta->execute();
        $result = $consulta->get_result();
        if(mysqli_num_rows($result) > 0){
        echo "<div class = 'table'>
            <table>
                <thead>
                        <tr>
                            <th><strong>nombreInstalacion</strong></th>
                            <th><strong>idRecurso</strong></th>
                            <th><strong>nombreRecurso</strong></th>
                        </tr>
                </thead>
                <tbody>";


        while ($row = mysqli_fetch_array($result)) {
            echo
                "<tr>
                <td>{$row['nombreInstalacion']}</td>
                <td>{$row['idRecurso']}</td>
                <td>{$row['nombreRecurso']}</td>
                </tr>";
        }

        echo "</tbody>
            </table>
            </div>";
    }else{
        echo "<p>Esta instalación no tiene recursos</p>";
    }

        $consulta->close();
        $connection->close();
    }

    public function mostrarInstalacionesPorRecurso($idRecurso)
    {
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña, $this->nombreBase);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consulta = $connection->prepare("SELECT i.nombre as nombreInstalacion , r.idRecurso, r.nombre as nombreRecurso, t.cantidad
        FROM recurso r, tiene t, instalacion i
        WHERE r.idRecurso = t.idRecurso
        AND t.idInstalacion = i.idInstalacion
        AND r.idRecurso = ?");
        $consulta->bind_param(
            'i',
            $idRecurso
        );
        $consulta->execute();
        $result = $consulta->get_result();
        if(mysqli_num_rows($result) > 0){
        echo "<div class = 'table'>
            <table>
                <thead>
                        <tr>
                            <th><strong>idRecurso</strong></th>
                            <th><strong>nombreRecurso</strong></th>
                            <th><strong>nombreInstalacion</strong></th>
                            <th><strong>cantidad</strong></th>
                        </tr>
                </thead>
                <tbody>";


        while ($row = mysqli_fetch_array($result)) {
            echo
                "<tr>
                <td>{$row['idRecurso']}</td>
                <td>{$row['nombreRecurso']}</td>
                <td>{$row['nombreInstalacion']}</td>
                <td>{$row['cantidad']}</td>
                </tr>";
        }

        echo "</tbody>
            </table>
            </div>";
    }else{
        echo "<p>Este recurso no esta en ninguna instalación</p>";
    }

        $consulta->close();
        $connection->close();
    }

    public function modificarRegistro(
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
    ) {
        $nombreBase = "BaseDatos";
        $nombreTabla = "PruebasUsabilidad";
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña, $nombreBase);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consulta = $connection->prepare("SELECT * FROM $nombreTabla WHERE dni = ?");
        $consulta->bind_param(
            's',
            $dni
        );
        $consulta->execute();
        $result = $consulta->get_result();
        $num_rows = mysqli_num_rows($result);
        $flag = true;
        if ($num_rows === 0) {
            echo "No se encuentra al usuario en la base de datos. Introduzca de nuevo el DNI.";
            $flag = false;
        }

        $dni_og = "";
        $nombre_og = "";
        $apellidos_og = "";
        $email_og = "";
        $telefono_og = "";
        $edad_og = "";
        $sexo_og = "";
        $nivel_og = "";
        $tiempo_og = "";
        $correcta_og = "";
        $comentarios_og = "";
        $propuestas_og = "";
        $valoracion_og = "";
        while ($row = mysqli_fetch_array($result)) {
            $dni_og = $row['dni'];
            $nombre_og = $row['nombre'];
            $apellidos_og = $row['apellidos'];
            $email_og = $row['email'];
            $telefono_og = $row['telefono'];
            $edad_og = $row['edad'];
            $sexo_og = $row['sexo'];
            $nivel_og = $row['nivel'];
            $tiempo_og = $row['tiempo'];
            $correcta_og = $row['correcta'];
            $comentarios_og = $row['comentarios'];
            $propuestas_og = $row['propuestas'];
            $valoracion_og = $row['valoracion'];
        }
        if ($dni === '') {
            $dni = $dni_og;
        }

        if ($nombre === '') {
            $nombre = $nombre_og;
        }

        if ($apellidos === '') {
            $apellidos = $apellidos_og;
        }

        if ($email === '') {
            $email = $email_og;
        }

        if ($telefono === '') {
            $telefono = $telefono_og;
        }

        if ($edad === '') {
            $edad = $edad_og;
        }

        if ($sexo === '') {
            $fsexo = $sexo_og;
        }

        if ($nivel === '' || $nivel < 0 || $nivel > 10) {
            $nivel = $nivel_og;
        }

        if ($tiempo === '') {
            $tiempo = $tiempo_og;
        }

        if ($correcta === ''  || $correcta !== "Si" || $correcta != "No") {
            $correcta = $correcta_og;
        }

        if ($comentarios === '') {
            $comentarios = $comentarios_og;
        }

        if ($propuestas === '') {
            $propuestas = $propuestas_og;
        }

        if ($valoracion === '' || $valoracion < 0 || $valoracion > 10) {
            $valoracion = $valoracion_og;
        }

        if ($flag) {
            $consultaMod = $connection->prepare("UPDATE $nombreTabla set nombre = ?, apellidos = ?, email = ?
        , telefono = ?, edad = ?, sexo = ?, nivel = ?, tiempo = ?, correcta = ?, comentarios = ?, propuestas = ?, valoracion = ?
        WHERE dni = ?");
            $consultaMod->bind_param(
                'ssssisiisssis',
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
                $valoracion,
                $dni
            );
            $consultaMod->execute();

            $consultaMod->close();
        }
        $consulta->close();
        $connection->close();
    }

    public function generarInforme()
    {
        $nombreBase = "BaseDatos";
        $nombreTabla = "PruebasUsabilidad";
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña, $nombreBase);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consultaMediaEdad = $connection->query("SELECT avg(edad) as mediaEdad FROM $nombreTabla");
        if (mysqli_num_rows($consultaMediaEdad) > 0) {
            $valorMediaEdad = $consultaMediaEdad->fetch_assoc();
            echo "<p>La media de edad es :" . $valorMediaEdad['mediaEdad'] . "</p>";
        } else {
            echo "No hay información sobre personas en la base de datos.";
        }

        $numeroHombres = 0;
        $numeroMujeres = 0;
        $consultaNumeroMujeres =  $connection->query('SELECT count(*) as mujeres FROM PruebasUsabilidad WHERE sexo="Femenino" or sexo="femenino"');
        if ($consultaNumeroMujeres->num_rows > 0) {
            while ($row = $consultaNumeroMujeres->fetch_assoc()) {
                $numeroMujeres = $row['mujeres'];
                echo "<p>Hay $numeroMujeres mujer/es en la base de datos</p>";
            }
        } else {
            echo "<p>Hay $numeroHombres mujer/es en la base de datos</p>";
        }
        $consultaNumeroHombres =  $connection->query('SELECT count(*) as hombres FROM PruebasUsabilidad WHERE sexo="Masculino" or sexo="masculino"');
        if ($consultaNumeroHombres->num_rows > 0) {
            while ($row = $consultaNumeroHombres->fetch_assoc()) {
                $numeroHombres = $row['hombres'];
                echo "<p>Hay $numeroHombres hombre/s en la base de datos</p>";
            }
        } else {
            echo "<p>Hay $numeroHombres hombre/s en la base de datos</p>";
        }
        $porcentajeHombres = ($numeroHombres / ($numeroHombres + $numeroMujeres)) * 100;
        $porcentajeMujeres = ($numeroMujeres / ($numeroHombres + $numeroMujeres)) * 100;
        echo "<p>El porcentaje de mujeres en la base de datos es del $porcentajeMujeres%</p>";
        echo "<p>El porcentaje de hombres en la base de datos es del $porcentajeHombres%</p>";

        $consultaMediaNivel = $connection->query("SELECT avg(nivel) as mediaNivel FROM $nombreTabla");
        if (mysqli_num_rows($consultaMediaNivel) > 0) {
            $valorMediaNivel = $consultaMediaNivel->fetch_assoc();
            echo "<p>La media de nivel es :" . $valorMediaNivel['mediaNivel'] . "</p>";
        } else {
            echo "No hay información sobre personas en la base de datos.";
        }

        $consultaMediaTiempo = $connection->query("SELECT avg(tiempo) as mediaTiempo FROM $nombreTabla");
        if (mysqli_num_rows($consultaMediaTiempo) > 0) {
            $valorMediaTiempo = $consultaMediaTiempo->fetch_assoc();
            echo "<p>La media de tiempo es :" . $valorMediaTiempo['mediaTiempo'] . "</p>";
        } else {
            echo "No hay información sobre personas en la base de datos.";
        }

        $numeroSies = 0;
        $numeroNoes = 0;
        $consultaNumeroSies =  $connection->query('SELECT count(*) as sies FROM PruebasUsabilidad WHERE correcta="Si" or correcta="si"');
        if ($consultaNumeroSies->num_rows > 0) {
            while ($row = $consultaNumeroSies->fetch_assoc()) {
                $numeroSies = $row['sies'];
                echo "<p>Hay $numeroSies si/es en la base de datos</p>";
            }
        } else {
            echo "<p>Hay $numeroSies si/es en la base de datos</p>";
        }
        $consultaNumeroNoes =  $connection->query('SELECT count(*) as noes FROM PruebasUsabilidad WHERE correcta="No" or correcta="no"');
        if ($consultaNumeroNoes->num_rows > 0) {
            while ($row = $consultaNumeroNoes->fetch_assoc()) {
                $numeroNoes = $row['noes'];
                echo "<p>Hay $numeroNoes no/es en la base de datos</p>";
            }
        } else {
            echo "<p>Hay $numeroNoes no/es en la base de datos</p>";
        }
        $porcentajeSi = ($numeroSies / ($numeroSies + $numeroNoes)) * 100;
        $porcentajeNo = ($numeroNoes / ($numeroSies + $numeroNoes)) * 100;
        echo "<p>El porcentaje de sies en la base de datos es del $porcentajeSi%</p>";
        echo "<p>El porcentaje de noes en la base de datos es del $porcentajeNo%</p>";


        $consultaMediaPuntuacion = $connection->query("SELECT avg(valoracion) as mediaPuntuacion FROM $nombreTabla");
        if (mysqli_num_rows($consultaMediaPuntuacion) > 0) {
            $valorMediaPuntuacion = $consultaMediaPuntuacion->fetch_assoc();
            echo "<p>La media de la puntuacion es :" . $valorMediaPuntuacion['mediaPuntuacion'] . "</p>";
        } else {
            echo "No hay información sobre personas en la base de datos.";
        }


        $connection->close();
    }

    public function exportarResultados()
    {
        $nombreBase = "BaseDatos";
        $nombreTabla = "PruebasUsabilidad";
        $nombreFichero = "pruebasUsabilidad.csv";
        $separador = ";";
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña, $nombreBase);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consulta = $connection->query("SELECT * FROM $nombreTabla");
        if (mysqli_num_rows($consulta) > 0) {
            ob_clean();
            ob_start();
            $pointer = fopen('php://output', 'w');
            $campos = array('dni', 'nombre', 'apellidos', 'email', 'telefono', 'edad', 'sexo', 'nivel', 'tiempo', 'correcta', 'comentarios', 'propuestas', 'valoracion');
            fputcsv($pointer, $campos, $separador);
            while ($row = $consulta->fetch_assoc()) {
                $datos = array(
                    $row['dni'],
                    $row['nombre'],
                    $row['apellidos'],
                    $row['email'],
                    $row['telefono'],
                    $row['edad'],
                    $row['sexo'],
                    $row['nivel'],
                    $row['tiempo'],
                    $row['correcta'],
                    $row['comentarios'],
                    $row['propuestas'],
                    $row['valoracion']
                );
                fputcsv($pointer, $datos, $separador);
            }
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $nombreFichero . '";');

            fpassthru($pointer);
        }
        exit;
        $consulta->close();
        $connection->close();
    }

    public function importarDatos()
    {
        $nombreBase = "BaseDatos";
        $nombreTabla = "PruebasUsabilidad";
        $nombreFichero = "pruebasUsabilidad.csv";
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña, $nombreBase);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $csv = array_map(function ($v) {
            return str_getcsv($v, ";");
        }, file('pruebasUsabilidad.csv'));
        $nFilas = 0;
        for ($i = 1; $i < count($csv); $i++) {
            $nFilas++;
            $consulta = $connection->prepare("REPLACE INTO $nombreTabla (dni, nombre, apellidos, email
            , telefono, edad, sexo, nivel, tiempo, correcta, comentarios, propuestas, valoracion)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $consulta->bind_param(
                'sssssisiisssi',
                $csv[$i][0],
                $csv[$i][1],
                $csv[$i][2],
                $csv[$i][3],
                $csv[$i][4],
                $csv[$i][5],
                $csv[$i][6],
                $csv[$i][7],
                $csv[$i][8],
                $csv[$i][9],
                $csv[$i][10],
                $csv[$i][11],
                $csv[$i][12],
            );
            $consulta->execute();
            if ($consulta->affected_rows > 0) {
                echo "<p>Importación correcta del registro $nFilas.</p>";
            }
            $consulta->close();
        }
        $connection->close();
    }
}
