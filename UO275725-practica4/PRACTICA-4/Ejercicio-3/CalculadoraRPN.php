<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8" />
    <title>Calculadora</title>

    <!-- Autor -->
    <meta name ="author" content ="Laura Gómez" />

    <!-- Descripción -->
    <meta name ="description" content ="Calculadora RPN" />

    <!-- Definir la ventana gráfica -->
    <meta name ="viewport" content ="width=device-width, initial-scale=1.0" />

    <!-- añadir el elemento link de enlace a la hoja de estilo dentro del <head> del documento html -->
    <link rel="stylesheet" type="text/css" href="CalculadoraRPN.css" />
</head>

<body>
    <?php session_start();

    class Pila {
        protected $size;
        protected $datosPila;

        public function __construct() {
            $this->size = 0;
            $this->datosPila = [];
        }

        public function push($valor) {
            $this->datosPila[$this->size] = $valor;
            $this->size = $this->size + 1;
        }

        public function pop() {
            if(!$this->isEmpty()){
                $this->size =  $this->size - 1;
                return $this->datosPila[$this->size];
            }
        }

        public function isEmpty(){
            return $this->size < 0;
        }

        public function print() {
            $res = "";
        
            for ($i = $this->size - 1; $i >= 0 ; $i--) {
                $res .= "[". ($i) . "] = " . $this->datosPila[$i] . "\n" ;
            } 

            return $res;
        }

        public function getSize(){
            return $this->size;
        }

        public function get($x){
            if($x >= ($this->getSize() - 1))
                return $this->datosPila[$x];
        }

        public function clear(){
            $this->datosPila = [];
            $this->size = 0;
        }

    }

    class CalculadoraRPN {
        protected $pantalla;
        protected $numero;

        public function __construct(){
            $this->pila = new Pila();
            $this->numero = "";
        }

        public function getNumero(){
            return $this->numero;
        }

        /*Borrar todo*/
        public function borrar(){
            $this->pila->clear();
            $this->numero="";
        }

        /*Borrar último número introducido*/
        public function ce(){
            $this->numero="";
        }

        /* Seno */
        public function sin(){
            if($this->pila->getSize() >= 1){
                $aux = $this->pila->pop();
                $this->pila->push(sin($aux));
            }
        }

        /* Coseno */
        public function cos(){
            if($this->pila->getSize() >= 1){
                $aux = $this->pila->pop();
                $this->pila->push(cos($aux));
            }
        }

        /* Tangente */
        public function tan(){
            if($this->pila->getSize() >= 1){
                $aux = $this->pila->pop();
                $this->pila->push(tan($aux));
            }
        }

        /* ArcoSeno */
        public function asin(){
            if($this->pila->getSize() >= 1){
                $aux = $this->pila->pop();
                $this->pila->push(asin($aux));
            }
        }

        /* arcoCoseno */
        public function acos(){
            if($this->pila->getSize() >= 1){
                $aux = $this->pila->pop();
                $this->pila->push(acos($aux));
            }
        }

        /* Arcotangente */
        public function atan(){
            if($this->pila->getSize() >= 1){
                $aux = $this->pila->pop();
                $this->pila->push(atan($aux));
            }
        }

        /*Números*/
        public function digitos($x){
            $this->numero .= $x;
        }

        /*Punto de los decimales*/
        public function decimal() {
            $this->numero .= ".";
        }

        public function suma(){
            if($this->pila->getSize() >= 2){
                $this->pila->push($this->pila->pop() + $this->pila->pop());
            }
        }

        public function resta(){
            if($this->pila->getSize() >= 2){
                $this->pila->push($this->pila->pop() - $this->pila->pop());
            }
        }

        public function multiplicacion(){
            if($this->pila->getSize() >= 2){
                $this->pila->push($this->pila->pop() * $this->pila->pop());
            }
        }

        public function division(){
            if($this->pila->getSize() >= 2){
                $this->pila->push($this->pila->pop() / $this->pila->pop());
            }
        }

        /*Mostrar el resultado*/
        public function enter(){
            $aux = $this->numero;
            $this->pila->push($aux);
            $this->numero = "";
        }

        public function mostrar(){
            return $this->pila->print();
        }
    }

    if (!isset($_SESSION["calculadoraRPN"])) {
        $calculadoraRPN = new CalculadoraRPN();
        $_SESSION["calculadoraRPN"] = $calculadoraRPN;
    }

    $calculadoraRPN = $_SESSION["calculadoraRPN"];

    if (count($_POST) > 0) {
        $c = $_SESSION["calculadoraRPN"];

        if (isset($_POST["sin"]))
            $c->sin();
        if (isset($_POST["cos"]))
            $c->cos();
        if (isset($_POST["tan"]))
            $c->tan();
        if (isset($_POST["asin"]))
            $c->asin();
        if (isset($_POST["acos"]))
            $c->acos();
        if (isset($_POST["atan"]))
            $c->atan();

        if (isset($_POST["C"]))
            $c->borrar(); 
        if (isset($_POST["CE"]))
            $c->ce();

        if (isset($_POST["/"]))
            $c->division();

        if (isset($_POST["7"]))
            $c->digitos("7");
        if (isset($_POST["8"]))
            $c->digitos("8");
        if (isset($_POST["9"]))
            $c->digitos("9");
        if (isset($_POST["*"]))
            $c->multiplicacion();

        if (isset($_POST["4"]))
            $c->digitos("4");
        if (isset($_POST["5"]))
            $c->digitos("5");
        if (isset($_POST["6"]))
            $c->digitos("6");
        if (isset($_POST["-"]))
            $c->resta();

        if (isset($_POST["1"]))
            $c->digitos("1");
        if (isset($_POST["2"]))
            $c->digitos("2");
        if (isset($_POST["3"]))
            $c->digitos("3");
        if (isset($_POST["+"]))
            $c->suma();

    
        if (isset($_POST["0"]))
            $c->digitos("0");
        if (isset($_POST["."]))
            $c->decimal();
        if (isset($_POST["ENTER"]))
            $c->enter();

        $_SESSION["calculadoraRPN"] = $calculadoraRPN;
    }


    echo '
    <main><h1>Calculadora RPN</h1>
    <form method="post" name="calculadoraRPN">
        <label for="pantalla">Calculadora RPN</label>
        <textarea rows="5"  id="pantalla"name="pantalla" lang="es" disabled>"' ;
            echo $_SESSION["calculadoraRPN"]->mostrar();
            echo'"</textarea>

        <label for="numero">Número introducido</label>
        <input type="text" name="numero" id="numero" value="'; 
            echo $_SESSION['calculadoraRPN']->getNumero();
            echo'" lang="es" disabled/>

        <!--Primera fila-->
        <input type="submit" value="C"      name="C" />
        <input type="submit" value="sin"    name="sin" />
        <input type="submit" value="cos"    name="cos" />
        <input type="submit" value="tan"    name="tan"/>

        <!--Segunda fila-->
        <input type="submit" value="CE"      name="CE" />
        <input type="submit" value="asin"    name="asin" />
        <input type="submit" value="acos"    name="acos" />
        <input type="submit" value="atan"    name="atan"/>

        <!--Tercera fila-->
        <input type="submit" value="7"    name="7" />
        <input type="submit" value="8"    name="8" />
        <input type="submit" value="9"    name="9" />
        <input type="submit" value="-"    name="-" />

        <!--Cuarta fila-->
        <input type="submit" value="4"    name="4" />
        <input type="submit" value="5"    name="5" />
        <input type="submit" value="6"    name="6" />
        <input type="submit" value="x"    name="x" /> 

        <!--Quinta fila--> 
        <input type="submit" value="1"    name="1" />
        <input type="submit" value="2"    name="2" />
        <input type="submit" value="3"    name="3" />
        <input type="submit" value="+"    name="+" />

        <!--Sexta fila-->
        <input type="submit" value="ENTER"    name="ENTER" />        
        <input type="submit" value="0"        name="0" />
        <input type="submit" value="."        name="." />
        <input type="submit" value="/"        name="/" />

    </form>
    </main>
    '?>
</body>
</html>