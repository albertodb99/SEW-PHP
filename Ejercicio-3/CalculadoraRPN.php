<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head lang="es">
        <meta charset="UTF-8">
        <meta name="author" content="Alberto Díez Bajo" />
        <meta name="copyright" content="Alberto Díez Bajo"/>
        <meta name="description" content="Página en la que puedes realizar tus cálculos con una calculadora ciéntifica"/>
        <meta name="viewport" content="width=device-width, user-scalable=yes">
        <title>Calculadora Ciéntifica</title>
        <link rel = "stylesheet" href = "CalculadoraRPN.css"/>
    </head>
    <body>
        <header>
            <h1>Calculadora Ciéntifica</h1>
        </header>
        <article>
            <h2>Calcule todo lo que quiera!</h2>
            <p>
                Calculadora desarrollada por el UO266536, para el ejercicio 2 de la asignatura Software y Estándares
                para la Web, del tercer curso del grado en Ingeniería Informática de la Universidad de Oviedo.
            </p>
        </article>
    <?php
    class PilaLIFO{
        protected $nombre;
        protected $pila;

        public function __construct($nombre){
            $this->nombre = $nombre;
            $this->pila = array();
        }

        public function apilar($valor){
            array_unshift($this->pila, $valor);
        }

        public function desapilar(){
            return array_shift($this->pila);
        }

        public function reiniciarPila(){
            $this->pila = array();
        }

        public function mostrar(){
            $stringPila = "Pila de la Calculadora RPN: ";
            $tmp = array_values($this->pila);
            for($i = count($this->pila) - 1; $i >= 0 ; $i--) 
            {
                $indexReal = $i+1;
                $elemento = $this->pila[$i];
                $stringPila .= "\nElemento   $indexReal   : $elemento";
            }
            return $stringPila;
        }
        
}
class BotoneraRPN {
    protected $mensaje;
    protected $memoria;
    protected $pila;

    public function __construct(){
        $this->mensaje = "";
        $this->memoria = "";
        $this->stack = new PilaLIFO("Pila de la calculadora RPN: ");
    }
    
    public function getMensaje(){
         //devuelve el mensaje
         return $this->mensaje;   
    }

    public function añadirAPila(){
        $this->stack->apilar($this->mensaje);
        $this->mensaje = "";
    }

    public function reiniciarPila(){
        $this->stack->reiniciarPila();
    }

    public function mostrarPila(){
        $this->stack->mostrar();
    }

    public function realizarOperacion($operacion){
        $resultadoOperacion = 0;
        switch($operacion){
            case '+':
                $operando1 = floatval($this->stack->desapilar());
                $operando2 = floatval($this->stack->desapilar());
                $resultadoOperacion =  $operando2 + $operando1;
                $this->stack->apilar($resultadoOperacion);
                break;
            case '-':
                $operando1 = floatval($this->stack->desapilar());
                $operando2 = floatval($this->stack->desapilar());
                $resultadoOperacion =  $operando2 - $operando1;
                $this->stack->apilar($resultadoOperacion);
                break;
            case '/':
                $operando1 = floatval($this->stack->desapilar());
                $operando2 = floatval($this->stack->desapilar());
                $resultadoOperacion =  $operando2 / $operando1;
                $this->stack->apilar($resultadoOperacion);
                break;
            case '*':
                $operando1 = floatval($this->stack->desapilar());
                $operando2 = floatval($this->stack->desapilar());
                $resultadoOperacion =  $operando2 * $operando1;
                $this->stack->apilar($resultadoOperacion);
                break;
            case 'sin':
                $operando1 = floatval($this->stack->desapilar());
                $resultadoOperacion =  sin($operando1);
                $this->stack->apilar($resultadoOperacion);
                break;
            case 'cos':
                $operando1 = floatval($this->stack->desapilar());
                $resultadoOperacion =  cos($operando1);
                $this->stack->apilar($resultadoOperacion);
                break;
            case 'tan':
                $operando1 = floatval($this->stack->desapilar());
                $resultadoOperacion =  tan($operando1);
                $this->stack->apilar($resultadoOperacion);
                break;
            case 'log10':
                $operando1 = floatval($this->stack->desapilar());
                $resultadoOperacion =  log($operando1, 10);
                $this->stack->apilar($resultadoOperacion);
                break;
            case 'log2':
                $operando1 = floatval($this->stack->desapilar());
                $resultadoOperacion =  log($operando1, 2);
                $this->stack->apilar($resultadoOperacion);
                break;
            case 'exp':
                $operando1 = floatval($this->stack->desapilar());
                $resultadoOperacion =  exp($operando1);
                $this->stack->apilar($resultadoOperacion);
                break;
            case 'sqrt':
                $operando1 = floatval($this->stack->desapilar());
                $resultadoOperacion =  sqrt($operando1);
                $this->stack->apilar($resultadoOperacion);
                break;
            case 'cambioSigno':
                $operando1 = floatval($this->stack->desapilar());
                $resultadoOperacion =  (-1) * $operando1;
                $this->stack->apilar($resultadoOperacion);
                break;
            case 'cuadrado':
                $operando1 = floatval($this->stack->desapilar());
                $resultadoOperacion =  pow($operando1,2);
                $this->stack->apilar($resultadoOperacion);
                break;
            case 'elevarXaY':
                $operando1 = floatval($this->stack->desapilar());
                $operando2 = floatval($this->stack->desapilar());
                $resultadoOperacion =  pow($operando2, $operando1);
                $this->stack->apilar($resultadoOperacion);
                break;
            case 'elevarA10':
                $operando1 = floatval($this->stack->desapilar());
                $resultadoOperacion =  pow(10, $operando1);
                $this->stack->apilar($resultadoOperacion);
                break;
            case 'factorial':
                $operando1 = floatval($this->stack->desapilar());
                $resultadoOperacion =  $this->factorialAux($operando1);
                $this->stack->apilar($resultadoOperacion);
                break;
        }
    }

    public function factorialAux($num){
        if ($num === 0) { 
            return 1; 
        }
        else { 
            return $num * $this->factorialAux($num - 1); 
        }
    }

    public function digitos($boton){
        $this->mensaje .= $boton;  
    }

    public function punto(){
        $this->mensaje .= '.';  
    }


    public function borrar(){       
        $this->mensaje = "";  
    }

    public function borrarUltimoCaracter(){
        try{
            $this->mensaje = substr($this->mensaje, 0, strlen($this->mensaje) - 1);
        }catch(Exception $e){
            $this->mensaje .= "";
            $this->borrarUltimoCaracter();
        }
    }

    public function borrarUltimoNumero(){
        $this->pila->desapilar();
    }

    public function doNothing(){
    }

}


$miBotonera;
if (isset($_SESSION['calculadoraRPN'])){ 
    $miBotonera=$_SESSION['calculadoraRPN']; 
} else { 
    $miBotonera=new BotoneraRPN(); 
    $_SESSION['calculadoraRPN']=$miBotonera; 
} 

$mostrarPila = "Pila de la calculadora RPN: ";
$pantalla = "";

//Solo se ejecutará si se ha pulsado un botón
if (count($_POST)>0) 
    {   
       
        if(isset($_POST['boton0'])) $miBotonera->digitos("0");
        if(isset($_POST['boton1'])) $miBotonera->digitos("1");
        if(isset($_POST['boton2'])) $miBotonera->digitos("2");
        if(isset($_POST['boton3'])) $miBotonera->digitos("3");
        if(isset($_POST['boton4'])) $miBotonera->digitos("4");
        if(isset($_POST['boton5'])) $miBotonera->digitos("5");
        if(isset($_POST['boton6'])) $miBotonera->digitos("6");
        if(isset($_POST['boton7'])) $miBotonera->digitos("7");
        if(isset($_POST['boton8'])) $miBotonera->digitos("8");
        if(isset($_POST['boton9'])) $miBotonera->digitos("9");
        if(isset($_POST['botonPI'])) $miBotonera->digitos("pi()");
        if(isset($_POST['botonLog10'])) $miBotonera->realizarOperacion('log10');
        if(isset($_POST['botonLog2'])) $miBotonera->realizarOperacion('log2');
        if(isset($_POST['botonExp'])) $miBotonera->realizarOperacion('exp');
        if(isset($_POST['botonDiezElevadoA'])) $miBotonera->realizarOperacion('elevarA10');
        if(isset($_POST['botonCambiaSigno'])) $miBotonera->realizarOperacion('cambiaSigno');
        if(isset($_POST['botonFactorial'])) $miBotonera->realizarOperacion('factorial');
        if(isset($_POST['botonAlCuadrado'])) $miBotonera->realizarOperacion('cuadrado');
        if(isset($_POST['botonRaiz'])) $miBotonera->realizarOperacion('sqrt');
        if(isset($_POST['botonElevar'])) $miBotonera->realizarOperacion('elevarXaY');
        if(isset($_POST['botonSeno'])) $miBotonera->realizarOperacion('sin');
        if(isset($_POST['botonCoseno'])) $miBotonera->realizarOperacion('cos');
        if(isset($_POST['botonTangente'])) $miBotonera->realizarOperacion('tan');

        if(isset($_POST['botonNada'])) $miBotonera->doNothing();


        if(isset($_POST['enter'])) $miBotonera->añadirAPila();
        if(isset($_POST['borrar'])) $miBotonera->borrar();
        if(isset($_POST['reiniciarPila'])) $miBotonera->reiniciarPila();
        if(isset($_POST['borrarUltimoNumero'])) $miBotonera->borrarUltimoNumero();
        if(isset($_POST['borrarUltimoCaracter'])) $miBotonera->borrarUltimoCaracter();


        if(isset($_POST['division'])) $miBotonera->realizarOperacion('/');
        if(isset($_POST['multiplicacion'])) $miBotonera->realizarOperacion('*');
        if(isset($_POST['suma'])) $miBotonera->realizarOperacion('+');
        if(isset($_POST['resta'])) $miBotonera->realizarOperacion('-');

        if(isset($_POST['punto'])) $miBotonera->punto();

        $pantalla = $miBotonera->getMensaje();
        $mostrarPila = $miBotonera->mostrarPila();
    }
echo "<div>";
//echo "<p>".$miBotonera->getMensaje()."</p>";

echo "
        <label for = 'mostrarPila' class = 'pila' lang = 'es'>
        Subir a Pila:
        </label>
        <textarea id = 'mostrarPila' disabled>
            $mostrarPila
        </textarea>

        <label for = 'pantalla' class = 'pantalla' lang = 'es'>
        Subir a Pila:
        </label>

        <input type='text' id='pantalla' class = 'subir' value='$pantalla' name = 'pantalla' lang = 'es' disabled />
";


// Interfaz con el usuario. En el interior de comillas dobles se deben usar comillas simples
echo "  
        <div class = 'calculadora'>
            
        <form action='#' method='post' name='botones' class = 'calculadora'>
            
            <input type = 'submit' class='operando' name = 'botonAlCuadrado' value = 'x^2'/>
            <input type = 'submit' class='operando' name = 'botonElevar' value = 'x^y'/>
            <input type = 'submit' class='operando' name = 'botonSeno' value = 'sin'/>
            <input type = 'submit' class='operando' name = 'botonCoseno' value = 'cos'/>
            <input type = 'submit' class='operando' name = 'botonTan' value = 'tan'/> 

            <input type = 'submit' class='operando' name = 'botonRaiz' value = '√'/>
            <input type = 'submit' class='operando' name = 'botonDiezElevadoA' value = '10^X'/>
            <input type = 'submit' class='operando' name = 'botonLog10' value = 'log10'/>
            <input type = 'submit' class='operando' name = 'botonLog2' value = 'log2'/>
            <input type = 'submit' class='operando' name = 'botonExp' value = 'Exp'/> 
        
            <input type = 'submit' class='operando' name = 'borrar' value = 'CP'/>
            <input type = 'submit' class='operando' name = 'borrarUltimoNumero' value = 'CE'/>
            <input type = 'submit' class='operando' name = 'reiniciarPila' value = 'C'/>
            <input type = 'submit' class='operando' name = 'borrarUltimoCaracter' value = '←'/>
            <input type = 'submit' class='operando' name = 'division' value = '/'/> 

            <input type = 'submit' class='operando' name = 'botonPI' value = '兀'/>
            <input type = 'submit' class='button' name = 'boton7' value = '7'/>
            <input type = 'submit' class='button' name = 'boton8' value = '8'/>
            <input type = 'submit' class='button' name = 'boton9' value = '9'/>
            <input type = 'submit' class='operando' name = 'multiplicacion' value = '*'/>
        
    
            <input type = 'submit' class='operando' name = 'botonFactorial' value = 'n!'/>
            <input type = 'submit' class='button' name = 'boton4' value = '4'/>
            <input type = 'submit' class='button' name = 'boton5' value = '5'/>
            <input type = 'submit' class='button' name = 'boton6' value = '6'/>
            <input type = 'submit' class='operando' name = 'resta' value = '-'/>
            
            <input type = 'submit' class='operando' name = 'botonCambiaSigno' value = '±'/>
            <input type = 'submit' class='button' name = 'boton1' value = '1'/>
            <input type = 'submit' class='button' name = 'boton2' value = '2'/>
            <input type = 'submit' class='button' name = 'boton3' value = '3'/>
            <input type = 'submit' class='operando' name = 'suma' value = '+'/>
    
            <input type = 'submit' class='operando' name = 'botonNada' value = ''/>
            <input type = 'submit' class='operando' name = 'botonNada' value = ''/>
            <input type = 'submit' class='button' name = 'boton0' value = '0'/>
            <input type = 'submit' class='button' name = 'punto' value = '.'/>
            <input type = 'submit' class='operando' name = 'enter' value = 'Enter'/>
                     
        </form>
                             
        </div>
        </div>
    ";
    
?>
</body>
</html>
