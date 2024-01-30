<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8" />
    <title>Calculadora</title>

    <!-- Autor -->
    <meta name ="author" content ="Laura Gómez" />

    <!-- Descripción -->
    <meta name ="description" content ="Calculadora Milan" />

    <!-- Definir la ventana gráfica -->
    <meta name ="viewport" content ="width=device-width, initial-scale=1.0" />

    <!-- añadir el elemento link de enlace a la hoja de estilo dentro del <head> del documento html -->
    <link rel="stylesheet" type="text/css" href="CalculadoraMilan.css" />
</head>

<body>
    <?php session_start();

    class CalculadoraMilan {
        protected $pantalla;
        protected $memoria;
        protected $operator;
        protected $izq;
        protected $der;
        protected $pantallaaux;


        public function __construct(){
            $this->pantalla = "";
            $this->pantallaaux = "";
            $this->memoria = 0;
            $this->operator = "";
            $this->izq = "";
            $this->der ="";

        }

        /*Borrar */
        public function borrar(){
            $this->pantalla = "";
            $this->memoria = "";
            $this->pantallaaux = "";
            $this->operator = "";

        }

        /*Se utiliza para cuando se comete un error en el ingreso de datos pero sin eliminar todo el calculo que se encuentra realizando*/ 
        public function ce(){
            $this->pantalla = "";
            $this->pantallaaux = "";
            $this->operator = "";

        }

        /*Cambiar el signo al distinto número que lo necesiten para realizar correctamente la operación */
        public function cambioSigno(){
            $aux = $this->getPantalla();
            $this->pantalla = eval("return - $aux ;");
        
        }

        /*Calcula la raíz cuadrada*/
        public function raiz(){
            $aux = $this->getPantalla();
            $this->pantalla = eval("return sqrt($aux);");
        }

        /*Calcula el porcentaje */
        public function porcentaje(){
            $array = str_split($this->pantalla,1);
            $aux = 0;
            for($i =0; $i < count($array); $i++){
                if($array[$i]==$this->operator){
                    $aux = $i;
                }
            }

            $this->pantalla = $array[$aux];
            if($this->operator === "+" ){
                $x = $this->der . "*" . $this->izq;
                $y = $x . "/" . 100;

                $this->pantalla = eval("return $this->izq + $y ;");
            }
            if($this->operator === "-"){
                $x = $this->der . "*" . $this->izq;
                $y = $x . "/" . 100;

                $this->pantalla = eval("return $this->izq - $y ;");
            }
            if($this->operator === "*" ){
                $x = $this->izq . "*" . $this->der;
                $this->pantalla = eval("return $x / 100 ;");

            }
            if($this->operator === "/"){
                $x = $this->izq . "*" . 100;
                $this->pantalla = eval("return $x / $this->der ;");
            }
        
        }

        /*Números*/
        public function digitos($x){
            if($this->operator == ""){
                $this->pantalla .= $x;
                $this->pantallaaux .=  $x;
                $this->izq = $x;                
            }
            else {
                $this->pantalla .= $x;
                $this->pantallaaux .=  $x;
                
                $this->der = $this->pantalla;
          }
            
        }

        /*Punto de los decimales*/
        public function decimal() {
            $this->pantalla .= ".";
            $this->pantallaaux .= ".";

        }

        /*Multiplicación */
        public function multiplicacion(){
            $this->izq = $this->pantalla;
            $this->pantallaaux .= "*";
            $this->operator = "*";
            $this->pantalla = "";

        }

        /*División */
        public function division(){
            $this->izq = $this->pantalla;
            $this->pantallaaux .= "/";
            $this->operator = "/";
            $this->pantalla = "";


        }

        /*Resta */
        public function resta(){
            $this->izq = $this->pantalla;
            $this->pantallaaux .= "-";
            $this->operator = "-";
            $this->pantalla = "";
        }

        /*Recupera de memoria*/
        public function mrc(){
            $this->pantalla = eval("return $this->memoria;");
        }

        /*Suma */
        public function suma(){
            $this->izq = $this->pantalla;
            $this->pantallaaux .= "+";
            $this->pantalla = "";
            $this->operator = "+";

        }

        /*Resta el número mostrado a otro número que se encuentre en memoria pero no muestra la resta de estos números.*/
        public function mMenos(){
            $this->memoria = eval("return $this->memoria-($this->pantalla) ;");
        }

        /*Mostrar el resultado*/
        public function igual(){
            $this->pantalla = eval("return $this->pantallaaux ;");  
            $this->operator="";
        }
    
        /*Suma el número mostrado a otro número que se encuentre en memoria pero no muestra la suma de estos números.*/
        public function mMas(){
            $this->memoria = eval("return $this->memoria+($this->pantalla) ;");
        }
        
        public function getPantalla(){
            return $this->pantalla;
        }

    }

    if (!isset($_SESSION["calculadoraMilan"])) {
        $calculadoraMilan = new CalculadoraMilan();
        $_SESSION["calculadoraMilan"] = $calculadoraMilan;
    }

    $calculadoraMilan = $_SESSION["calculadoraMilan"];

    if (count($_POST) > 0) {
        $c = $_SESSION["calculadoraMilan"];

        if (isset($_POST["on/C"]))
            $c->borrar();
        if (isset($_POST["CE"]))
            $c->ce();
        if (isset($_POST["+/-"]))
            $c->cambioSigno();
        if (isset($_POST["√"]))
            $c->raiz();
        if (isset($_POST["%"]))
            $c->porcentaje();

        if (isset($_POST["7"]))
            $c->digitos("7");
        if (isset($_POST["8"]))
            $c->digitos("8");
        if (isset($_POST["9"]))
            $c->digitos("9");
        if (isset($_POST["*"]))
            $c->multiplicacion();
        if (isset($_POST["/"]))
            $c->division();

        if (isset($_POST["4"]))
            $c->digitos("4");
        if (isset($_POST["5"]))
            $c->digitos("5");
        if (isset($_POST["6"]))
            $c->digitos("6");
        if (isset($_POST["-"]))
            $c->resta();
        if (isset($_POST["Mrc"]))
            $c->mrc();

        if (isset($_POST["1"]))
            $c->digitos("1");
        if (isset($_POST["2"]))
            $c->digitos("2");
        if (isset($_POST["3"]))
            $c->digitos("3");
        if (isset($_POST["+"]))
            $c->suma();
        if (isset($_POST["M-"]))
            $c->mMenos();

        if (isset($_POST["0"]))
            $c->digitos("0");
        if (isset($_POST["decimal"]))
            $c->decimal();
        if (isset($_POST["="]))
            $c->igual();
        if (isset($_POST["M+"]))
            $c->mMas();


        $_SESSION["calculadoraMilan"] = $calculadoraMilan;
    }

    $pantalla = $calculadoraMilan->getPantalla();

    echo '
    <main>
    <h1>Calculadora Milán</h1>
    <form  method="post" name="CalculadoraMilan">
        <label for="pantalla">Calculadora Milán</label>
        <input type="text" name="pantalla" id="pantalla" value="'; 
            echo $_SESSION['calculadoraMilan']->getPantalla();
            echo'" lang="es" disabled/>

        <input type="submit" value="on/C" name="on/C" />
        <input type="submit" value="CE"   name="CE" />
        <input type="submit" value="+/-"  name="+/-" />
        <input type="submit" value="√"    name="√" />
        <input type="submit" value="%"    name="%" />
        <input type="submit" value="7"    name="7" />
        <input type="submit" value="8"    name="8" />
        <input type="submit" value="9"    name="9" />
        <input type="submit" value="*"    name="*" />
        <input type="submit" value="/"    name="/" />
        <input type="submit" value="4"    name="4" />
        <input type="submit" value="5"    name="5" />
        <input type="submit" value="6"    name="6" />
        <input type="submit" value="-"    name="-" />
        <input type="submit" value="Mrc"  name="Mrc" />
        <input type="submit" value="1"    name="1" />
        <input type="submit" value="2"    name="2" />
        <input type="submit" value="3"    name="3" />
        <input type="submit" value="+"    name="+" />
        <input type="submit" value="M-"   name="M-" />
        <input type="submit" value="0"    name="0" />
        <input type="submit" value="."    name="decimal" />
        <input type="submit" value="="    name="=" />
        <input type="submit" value="M+"   name="M+" />

    </form>
    </main>
    '?>
</body>
</html>