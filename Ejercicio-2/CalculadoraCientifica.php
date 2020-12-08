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
        <link rel = "stylesheet" href = "CalculadoraCientifica.css"/>
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
class Botonera {
    protected $mensaje;
    protected $memoria;

    public function __construct(){
        $this->mensaje = "";
        $this->memoria = "";
    }
    
    public function getMensaje(){
         //devuelve el mensaje
         return $this->mensaje;   
    }

    public function digitos($boton){
        $this->mensaje .= $boton;  
    }

    public function punto(){
        $this->mensaje .= '.';  
    }

    public function multiplicacion(){
        $this->mensaje .= '*';  
    }

    public function division(){
        $this->mensaje .= '/';  
    }

    public function resta(){
        $this->mensaje .= '-';  
    }

    public function suma(){
        $this->mensaje .= '+';  
    }

    public function borrar(){       
        $this->mensaje = "";  
    }

    public function igual(){  
        try {      
        $this->mensaje = eval("return $this->mensaje ;");  
        }
        catch (Exception $e) {
            $this->mensaje = "Error: " .$e->getMessage();
        }
            
    }

    public function mrc(){        
        $this->mensaje = $this->memoria;  
        $this->memoria="";
    }

    public function mMenos(){
        
        try {      
            $this->memoria = eval("return $this->memoria-$this->mensaje ;");  
            }
            catch (Exception $e) {
                $this->mensaje = "Error: " .$e->getMessage();
            }
    }

    public function mMas(){
        
        try {      
            $this->memoria = eval("return $this->memoria+$this->mensaje ;");  
            }
            catch (Exception $e) {
                $this->mensaje = "Error: " .$e->getMessage();
            }  
    }


}

class BotoneraCientifica extends Botonera{
    protected $shift;

    public function __construct(){
        $this->shitf = false;
    }

    public function factorial(){
        $this->mensaje = $this->factorialAux(floatval($this->mensaje));  
    }

    public function raizCuadrada(){
        $this->mensaje .= "sqrt(";  
    }

    public function logaritmo(){
        $this->mensaje .= "log10(";  
    }

    public function changeShift(){
        $this->shift = true;
    }

    public function calculateSeno(){
        if($this->shift == true){
            $this->arcoseno();
            $this->shift = false;
        }else{
            $this->seno();
        }
    }

    public function arcoseno(){
        $this->mensaje .= "sinh(";
    }

    public function seno(){
        $this->mensaje .= "sin(";
    }

    public function calculateCoseno(){
        if($this->shift == true){
            $this->arcocoseno();
            $this->shift = false;
        }else{
            $this->coseno();
        }
    }

    public function arcocoseno(){
        $this->mensaje .= "cosh(";
    }

    public function coseno(){
        $this->mensaje .= "cos(";
    }

    public function calculateTangente(){
        if($this->shift == true){
            $this->arcotangente();
            $this->shift = false;
        }else{
            $this->tangente();
        }
    }

    public function arcotangente(){
        $this->mensaje .= "tanh(";
    }

    public function tangente(){
        $this->mensaje .= "tan(";
    }

    public function elevarAlCuadrado(){
        $this->mensaje = pow(eval("return $this->mensaje ;"),2);
    }

    public function exponencial(){
        $this->mensaje .= "exp(";
    }

    public function diezElevadoA(){
        $this->mensaje .= "pow(10,";
    }

    public function cambiarSigno(){
        eval("return $this->mensaje * (-1) ;");
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
        while(strpos('/[0-9]*/', $this->mensaje)){
            $this->borrarUltimoCaracter();
        }
    }

    public function doNothing(){
    }

    public function factorialAux($num){
        if ($num === 0) { 
            return 1; 
        }
        else { 
            return $num * $this->factorialAux($num - 1); 
        }
    }
}

$miBotonera;
if (isset($_SESSION['calculadora'])){ 
    $miBotonera=$_SESSION['calculadora']; 
} else { 
    $miBotonera=new BotoneraCientifica(); 
    $_SESSION['calculadora']=$miBotonera; 
} 

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
        if(isset($_POST['botonPrtI'])) $miBotonera->digitos("(");
        if(isset($_POST['botonPrtD'])) $miBotonera->digitos(")");
        if(isset($_POST['botonPI'])) $miBotonera->digitos("pi");
        if(isset($_POST['botonMod'])) $miBotonera->digitos("%");
        if(isset($_POST['botonLog'])) $miBotonera->logaritmo();
        if(isset($_POST['botonExp'])) $miBotonera->exponencial();
        if(isset($_POST['botonDiezElevadoA'])) $miBotonera->diezElevadoA();
        if(isset($_POST['botonCambiaSigno'])) $miBotonera->cambiarSigno();
        if(isset($_POST['botonFactorial'])) $miBotonera->factorial();
        if(isset($_POST['botonAlCuadrado'])) $miBotonera->elevarAlCuadrado();
        if(isset($_POST['botonRaiz'])) $miBotonera->raizCuadrada();
        if(isset($_POST['botonElevar'])) $miBotonera->digitos("**");
        if(isset($_POST['botonShift'])) $miBotonera->changeShift();
        if(isset($_POST['botonSeno'])) $miBotonera->calculateSeno();
        if(isset($_POST['botonCoseno'])) $miBotonera->calculateCoseno();
        if(isset($_POST['botonTangente'])) $miBotonera->calculateTangente();

        if(isset($_POST['botonNada'])) $miBotonera->doNothing();


        if(isset($_POST['igual'])) $miBotonera->igual();
        if(isset($_POST['borrar'])) $miBotonera->borrar();
        if(isset($_POST['borrarUltimoNumero'])) $miBotonera->borrarUltimoNumero();
        if(isset($_POST['borrarUltimoCaracter'])) $miBotonera->borrarUltimoCaracter();


        if(isset($_POST['division'])) $miBotonera->division();
        if(isset($_POST['multiplicacion'])) $miBotonera->multiplicacion();
        if(isset($_POST['suma'])) $miBotonera->suma();
        if(isset($_POST['resta'])) $miBotonera->resta();

        if(isset($_POST['punto'])) $miBotonera->punto();

        if(isset($_POST['mrc'])) $miBotonera->mrc();
        if(isset($_POST['mmas'])) $miBotonera->mSuma();
        if(isset($_POST['mmenos'])) $miBotonera->mMenos();

    }
echo "<div>";
echo "<p>".$miBotonera->getMensaje()."</p>";


// Interfaz con el usuario. En el interior de comillas dobles se deben usar comillas simples
echo "  
        <div class = 'calculadora'>
            
        <form action='#' method='post' name='botones' class = 'calculadora'>
            
            <input type = 'submit' class='memoria' name = 'botonNada' value = ''/>
            <input type = 'submit' class='memoria' name = 'botonNada' value = ''/>
            <input type = 'submit' class='memoria' name = 'mrc' value = 'mrc'/>
            <input type = 'submit' class='memoria' name = 'mmas' value = 'm+'/>
            <input type = 'submit' class='memoria' name = 'mmenos' value = 'm-'/>  
            
            <input type = 'submit' class='operando' name = 'botonAlCuadrado' value = 'x^2'/>
            <input type = 'submit' class='operando' name = 'botonElevar' value = 'x^y'/>
            <input type = 'submit' class='operando' name = 'botonSeno' value = 'sin'/>
            <input type = 'submit' class='operando' name = 'botonCoseno' value = 'cos'/>
            <input type = 'submit' class='operando' name = 'botonTan' value = 'tan'/> 

            <input type = 'submit' class='operando' name = 'botonRaiz' value = '√'/>
            <input type = 'submit' class='operando' name = 'botonDiezElevadoA' value = '10^X'/>
            <input type = 'submit' class='operando' name = 'botonLog' value = 'log'/>
            <input type = 'submit' class='operando' name = 'botonExp' value = 'Exp'/>
            <input type = 'submit' class='operando' name = 'botonMod' value = 'Mod'/> 
        
            <input type = 'submit' class='operando' name = 'botonShift' value = '↑'/>
            <input type = 'submit' class='operando' name = 'borrarUltimoNumero' value = 'CE'/>
            <input type = 'submit' class='operando' name = 'borrar' value = 'C'/>
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
    
            <input type = 'submit' class='operando' name = 'botonPrtI' value = '('/>
            <input type = 'submit' class='operando' name = 'botonPrtD' value = ')'/>
            <input type = 'submit' class='button' name = 'boton0' value = '0'/>
            <input type = 'submit' class='button' name = 'punto' value = '.'/>
            <input type = 'submit' class='operando' name = 'igual' value = '='/>
                     
        </form>
                             
        </div>
        </div>
    ";
    
?>
</body>
</html>
