<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8" />
    <title>Calculadora</title>

    <!-- Autor -->
    <meta name ="author" content ="Laura Gómez" />

    <!-- Descripción -->
    <meta name ="description" content ="Calculadora Científica" />

    <!-- Definir la ventana gráfica -->
    <meta name ="viewport" content ="width=device-width, initial-scale=1.0" />

    <!-- añadir el elemento link de enlace a la hoja de estilo dentro del <head> del documento html -->
    <link rel="stylesheet" type="text/css" href="CalculadoraCientifica.css" />
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

    class CalculadoraCientifica extends CalculadoraMilan {

        /*Números*/
        public function digitos($x){
            $this->pantalla .= $x;
        }

        /* MS (Memory Storage): Almacena en memoria el número mostrado */
        public function ms(){
            $aux = $this->getPantalla();
            $this->memoria = $aux;
        }

        /* Número PI */
        public function pi(){
            $this->pantalla .= eval("return M_PI ;");
        }

        /* Borrar último introducido */
        public function delete(){
            $this->pantalla = substr($this->pantalla, 0, -1);
        }

        /* Elevar a 2 */
        public function potenciaDeDos(){
            $this->pantalla .= "**2";
            $this->pantalla = eval("return $this->pantalla ;");
        }

        /* Exponente */
        public function exponente(){
            $this->pantalla .= "*10**";
        }

        /* Módulo */
        public function modulo(){
            $this->pantalla .= "%";
        }

        /* Abrir paréntesis */
        public function abrirParentesis(){
            $this->pantalla .= "(";
        }

        /* Cerrar paréntesis */
        public function cerrarParentesis(){
            $this->pantalla .= ")";
        }

        /* Factorial */
        public function factorial(){
            $aux = 1; 
            for ($i = 1; $i <= $this->pantalla; $i++) {
                $aux = $aux * $i; 
            }    
            $this->pantalla = $aux;
        }

        /* Elevar un número a otro  */
        public function potenciaDeY(){
            $this->pantalla .= "**";
        }

        /* Elevar 10 a cualquier número*/
        public function elevar10(){
            $aux = $this->pantalla;
            $aux2 = "10** $aux";
            $this->pantalla = eval("return $aux2 ;");
        }

        /* Logaritmo de base 10 */
        public function logaritmoBase10(){
            $aux = $this->pantalla;
            $this->pantalla = eval("return log($aux) ;");
        }

        /* Seno */
        public function sin(){
            $aux = $this->pantalla;
            $this->pantalla = eval("return sin($aux) ;");
        }

        /* Cos */
        public function cos(){
            $aux = $this->pantalla;
            $this->pantalla = eval("return cos($aux) ;");
        }

        /* Tan */
        public function tan(){
            $aux = $this->pantalla;
            $this->pantalla = eval("return tan($aux) ;");
        }

        /* Memory clear: elimina cualquier numero guardado en memoria*/
        public function mc(){
            $this->memoria = 0;
        }

        /*Mostrar el resultado*/
        public function igual(){
            $this->pantalla = eval("return $this->pantalla ;");  
            $this->operator="";
        }

        public function suma(){
            $this->pantalla .= "+";
        }

        public function resta(){
            $this->pantalla .= "-";
        }

        public function division(){
            $this->pantalla .= "/";
        }

        public function multiplicacion(){
            $this->pantalla .= "*";
        }

        public function getMemoria(){
            return $this->memoria;
        }
    }

    if (!isset($_SESSION["calculadoraCientifica"])) {
        $calculadoraCientifica = new CalculadoraCientifica();
        $_SESSION["calculadoraCientifica"] = $calculadoraCientifica;
    }

    $calculadoraCientifica = $_SESSION["calculadoraCientifica"];

    if (count($_POST) > 0) {
        $c = $_SESSION["calculadoraCientifica"];

        if (isset($_POST["Mc"]))
            $c->mc();
        if (isset($_POST["Mr"]))
            $c->mrc();
        if (isset($_POST["M-"]))
            $c->mMenos();
        if (isset($_POST["M+"]))
            $c->mMas();
        if (isset($_POST["MS"]))
            $c->ms();

        if (isset($_POST["x^2"]))
            $c->potenciaDeDos();
        if (isset($_POST["x^y"]))
            $c->potenciaDeY();
        if (isset($_POST["sin"]))
            $c->sin();
        if (isset($_POST["cos"]))
            $c->cos();
        if (isset($_POST["tan"]))
            $c->tan();

        if (isset($_POST["√"]))
            $c->raiz();
        if (isset($_POST["10^x"]))
            $c->elevar10();
        if (isset($_POST["log"]))
            $c->logaritmoBase10();
        if (isset($_POST["exp"]))
            $c->exponente();
        if (isset($_POST["mod"]))
            $c->modulo();

        if (isset($_POST["C"]))
            $c->borrar(); 
        if (isset($_POST["CE"]))
            $c->ce();
        if (isset($_POST["DEL"]))
            $c->delete();
        if (isset($_POST["/"]))
            $c->division();

        if (isset($_POST["π"]))
            $c->pi();
        if (isset($_POST["7"]))
            $c->digitos("7");
        if (isset($_POST["8"]))
            $c->digitos("8");
        if (isset($_POST["9"]))
            $c->digitos("9");
        if (isset($_POST["*"]))
            $c->multiplicacion();

        if (isset($_POST["n!"]))
            $c->factorial();
        if (isset($_POST["4"]))
            $c->digitos("4");
        if (isset($_POST["5"]))
            $c->digitos("5");
        if (isset($_POST["6"]))
            $c->digitos("6");
        if (isset($_POST["-"]))
            $c->resta();

        if (isset($_POST["+/-"]))
            $c->cambioSigno();
        if (isset($_POST["1"]))
            $c->digitos("1");
        if (isset($_POST["2"]))
            $c->digitos("2");
        if (isset($_POST["3"]))
            $c->digitos("3");
        if (isset($_POST["+"]))
            $c->suma();

        if (isset($_POST["("]))
            $c->abrirParentesis();
        if (isset($_POST[")"]))
            $c->cerrarParentesis();
        if (isset($_POST["0"]))
            $c->digitos("0");
        if (isset($_POST["decimal"]))
            $c->decimal();
        if (isset($_POST["="]))
            $c->igual();

        $_SESSION["calculadoraCientifica"] = $calculadoraCientifica;
    }

    $pantalla = $calculadoraCientifica->getPantalla();

    echo '
    <main>
    <h1>Calculadora Científica</h1>
    <form  method="post" name="CalculadoraCientifica">
        <label for="pantalla">Calculadora Científica</label>
        <input type="text" name="pantalla" id="pantalla" value="'; 
            echo $_SESSION['calculadoraCientifica']->getPantalla();
            echo'" lang="es" disabled/>

        <input type="submit" value="DEG"   name="DEG" />
        <input type="submit" value="HYP"   name="HYP" />
        <input type="submit" value="F-E"   name="F-E" />
        <label for="memoria">Memoria</label>
        <input type="text" name="memoria" id="memoria" value="'; 
            echo $_SESSION['calculadoraCientifica']->getMemoria();
            echo'" lang="es" disabled/>

        <input type="submit" value="Mc"  name="Mc" />
        <input type="submit" value="Mr"  name="Mr" />
        <input type="submit" value="M-"  name="M-" />
        <input type="submit" value="M+"  name="M+" />
        <input type="submit" value="MS"  name="MS" />

        <input type="submit" value="x^2"   name="x^2" />
        <input type="submit" value="x^y"   name="x^y" />
        <input type="submit" value="sin"   name="sin" />
        <input type="submit" value="cos"   name="cos" />
        <input type="submit" value="tan"   name="tan" />

        <input type="submit" value="√"      name="√" />
        <input type="submit" value="10^x"   name="10^x" />
        <input type="submit" value="log"    name="log" />
        <input type="submit" value="exp"    name="exp" />
        <input type="submit" value="mod"    name="mod" />

        <input type="submit" value="↑"    name="↑" />
        <input type="submit" value="C"    name="C" />
        <input type="submit" value="CE"    name="CE" />
        <input type="submit" value="DEL"  name="DEL" />
        <input type="submit" value="/"    name="/" />

        <input type="submit" value="π"    name="π" />
        <input type="submit" value="7"    name="7" />
        <input type="submit" value="8"    name="8" />
        <input type="submit" value="9"    name="9" />
        <input type="submit" value="*"    name="*" />

        <input type="submit" value="n!"   name="n!" />
        <input type="submit" value="4"    name="4" />
        <input type="submit" value="5"    name="5" />
        <input type="submit" value="6"    name="6" />
        <input type="submit" value="-"    name="-" />

        <input type="submit" value="+/-"  name="+/-" />
        <input type="submit" value="1"    name="1" />
        <input type="submit" value="2"    name="2" />
        <input type="submit" value="3"    name="3" />
        <input type="submit" value="+"    name="+" />

        <input type="submit" value="("    name="(" />
        <input type="submit" value=")"    name=")" />
        <input type="submit" value="0"    name="0" />
        <input type="submit" value="."    name="decimal" />
        <input type="submit" value="="    name="=" />

    </form>
    </main>
    '?>
</body>
</html>