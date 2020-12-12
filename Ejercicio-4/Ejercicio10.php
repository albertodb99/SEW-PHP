<!DOCTYPE HTML>

<html lang="es">

<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8">
    <meta name="author" content="Alberto Díez Bajo" />
    <meta name="copyright" content="Alberto Díez Bajo" />
    <meta name="description" content="Página web de traducción de contenido" />
    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <title>Traduccion de contenido</title>
    <link rel="stylesheet" type="text/css" href="Ejercicio10.css" />
</head>

<body>
    <header>
        <!-- Datos con el contenidos que aparece en el navegador -->
        <h1>Traduccion de contenido</h1>
    </header>
    <article>
        <h2>
            Aquí podrás traducir tu contenido!
        </h2>
        <p>
            Aquí podrás traducir lo que desees del español a uno de los idiomas disponibles de la lista!
        </p>
        <?php
        class Traductor
        {
            protected $traduccion;

            public function __construct()
            {
                $this->traduccion = "";
            }
            public function traducir($idioma, $aTraducir)
            {
                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://google-translate1.p.rapidapi.com/language/translate/v2",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "q=$aTraducir&source=es&target=$idioma",
                    CURLOPT_HTTPHEADER => [
                        "accept-encoding: application/gzip",
                        "content-type: application/x-www-form-urlencoded",
                        "x-rapidapi-host: google-translate1.p.rapidapi.com",
                        "x-rapidapi-key: 5289b00dbdmsh674d1964f2bede8p1f8f34jsnb803636246b9"
                    ],
                ]);

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $this->traduccion = $response;
                    $stringJSON = mb_convert_encoding($response, "UTF-8");
                    $this -> traduccion = json_decode($stringJSON) -> data -> translations[0] -> translatedText;
                }
            }

            public function getTraduccion()
            {
                return $this->traduccion;
            }
        }
        $traduccion = "";
        if (count($_POST) > 0) {
            $traductor = new Traductor();
            if (isset($_POST['btnTraducir'])) {
                $aTraducir = $_POST['aTraducir'];
                $idioma = $_POST['idiomas'];
                $traductor->traducir($idioma, $aTraducir);
                $traduccion = $traductor->getTraduccion();
            }
        }
        echo "
            <form action='#' method='post'>
                <label for='idiomas'>Escoge un idioma:</label>

                <select name='idiomas' id='idiomas'>
                <option value='en'>Inglés</option>
                <option value='it'>Italiano</option>
                <option value='fr'>Francés</option>
                </select>
                <label for = 'aTraducir' lang = 'es'>
                    Escribe aquí el texto que quieres traducir:
                </label>
                <textarea id = 'aTraducir' name = 'aTraducir'>

                </textarea>
                <label for = 'traducido' lang = 'es'>
                    Texto traducido:
                </label>
                <textarea id = 'traducido' name = 'traducido' disabled>$traduccion</textarea>
                <p>Click aquí para traducir:</p>
                <input type = 'submit' class='button' name = 'btnTraducir' value = 'Toca aquí para traducir'/>
                </form>"
        ?>
    </article>
</body>

</html>