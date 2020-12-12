<?php
class BaseDatos
{
    private $usuario;
    private $host;
    private $contraseña;

    public function __construct()
    {
        $this->usuario = "DBUSER2020";
        $this->host = "localhost";
        $this->contraseña = "DBPSWD2020";
    }

    public function crearBaseDeDatos()
    {
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña);
        $nombreBase = "BaseDatos";
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consulta = "CREATE DATABASE IF NOT EXISTS $nombreBase";
        if ($connection->query($consulta)) {
            echo "<p>$nombreBase creada correctamente</p>";
        } else {
            echo "<p>ERROR: $nombreBase. No se ha podido crear correctamente: $connection->connect_error</p>";
            exit();
        }
        $connection->close();
    }

    public function crearTabla()
    {
        $nombreBase = "BaseDatos";
        $nombreTabla = "PruebasUsabilidad";
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña, $nombreBase);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consulta = "CREATE TABLE IF NOT EXISTS $nombreTabla (
            dni VARCHAR(9) NOT NULL,
            nombre VARCHAR(30) NOT NULL,
            apellidos VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL,
            telefono VARCHAR(20) NOT NULL,
            edad INT NOT NULL,
            sexo VARCHAR(20) NOT NULL,
            nivel INT NOT NULL,
            tiempo INT NOT NULL,
            correcta VARCHAR(15) NOT NULL,
            comentarios VARCHAR(255) NOT NULL,
            propuestas VARCHAR(255) NOT NULL, 
            valoracion INT NOT NULL,
            PRIMARY KEY (dni)
        )";
        if ($connection->query($consulta)) {
            echo "<p>$nombreBase - $nombreTabla creada correctamente</p>";
        } else {
            echo "<p>ERROR: $nombreBase - $nombreTabla. No se ha podido crear correctamente la tabla: $connection->connect_error</p>";
            exit();
        }
        $connection->close();
    }

    public function añadirRegistros(
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
        $consulta = $connection->prepare("INSERT INTO $nombreTabla (dni, nombre, apellidos, email
        , telefono, edad, sexo, nivel, tiempo, correcta, comentarios, propuestas, valoracion)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $consulta->bind_param(
            'sssssisiisssi',
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
        $consulta->execute();

        echo "<p>Datos añadidos:  $consulta->affected_rows </p>";

        $consulta->close();
        $connection->close();
    }

    public function eliminarRegistro($dni)
    {
        $nombreBase = "BaseDatos";
        $nombreTabla = "PruebasUsabilidad";
        $connection = new mysqli($this->host, $this->usuario, $this->contraseña, $nombreBase);
        if ($connection->connect_error) {
            exit("<p>ERROR:" . $connection->connect_error . "</p>");
        }
        $consulta = $connection->prepare("DELETE FROM $nombreTabla WHERE dni = ?");
        $consulta->bind_param(
            's',
            $dni
        );
        $consulta->execute();

        if ($consulta->affected_rows === 0) {
            echo "<p>No se ha eliminado ningún registro porque no se ha encontrado el DNI. </p>";
        }

        echo "<p>Datos eliminados:  $consulta->affected_rows </p>";

        $consulta->close();
        $connection->close();
    }

    public function mostrarRegistro($dni)
    {
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
        echo "<div class = 'table'>
            <table>
                <thead>
                        <tr>
                            <th><strong>DNI</strong></th>
                            <th><strong>Nombre</strong></th>
                            <th><strong>Apellidos</strong></th>
                            <th><strong>Email</strong></th>
                            <th><strong>Teléfono</strong></th>
                            <th><strong>Edad</strong></th>
                            <th><strong>Sexo</strong></th>
                            <th><strong>Nivel</strong></th>
                            <th><strong>Tiempo</strong></th>
                            <th><strong>Correcta</strong></th>
                            <th><strong>Comentarios</strong></th>
                            <th><strong>Propuestas</strong></th>
                            <th><strong>Valoracion</strong></th>
                        </tr>
                </thead>
                <tbody>";


        while ($row = mysqli_fetch_array($result)) {
            echo
                "<tr>
                <td>{$row['dni']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['apellidos']}</td>
                <td>{$row['email']}</td>
                <td>{$row['telefono']}</td>
                <td>{$row['edad']}</td>
                <td>{$row['sexo']}</td>
                <td>{$row['nivel']}</td>
                <td>{$row['tiempo']}</td>
                <td>{$row['correcta']}</td>
                <td>{$row['comentarios']}</td>
                <td>{$row['propuestas']}</td>
                <td>{$row['valoracion']}</td>
                </tr>";
        }

        echo "</tbody>
            </table>
            </div>";

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

        
        $connection -> close();
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
        $consulta -> close();
        $connection -> close();
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
            if($consulta -> affected_rows > 0){
                echo "<p>Importación correcta del registro $nFilas.</p>";
            }
            $consulta->close();
        }
        $connection -> close();
    }
}
