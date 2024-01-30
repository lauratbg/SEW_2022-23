<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8" />
    <title>Ejercicio 6</title>

    <!-- Autor -->
    <meta name ="author" content ="Laura Gómez" />

    <!-- Descripción -->
    <meta name ="description" content ="Ejercicio 6" />

    <!-- Definir la ventana gráfica -->
    <meta name ="viewport" content ="width=device-width, initial-scale=1.0" />

    <!-- añadir el elemento link de enlace a la hoja de estilo dentro del <head> del documento html -->
    <link rel="stylesheet" type="text/css" href="Ejercicio6.css" />
</head>

<body>
    <?php 

echo '
        <h1>Ejercicio 6</h1>
        <nav>
            <ul>
                <li><a title="Crear bd" tabindex=
                    "1" accesskey="B" href="#CrearBD">Crear Base de Datos</a></li>
                <li><a title="Crear tabla" tabindex=
                    "2" accesskey="T" href="#CrearT">Crear una tabla</a></li>
                <li><a title="Insertar datos" tabindex=
                    "3" accesskey="I" href="#Ins">Insertar datos en una tabla</a></li>
                <li><a title="Buscar datos" tabindex=
                    "4" accesskey="B" href="#Bus">Buscar datos en una tabla</a></li>
                <li><a title="Modificar" tabindex=
                    "5" accesskey="M" href="#Mod">Modificar datos en una tabla</a></li>
                <li><a title="Eliminar datos" tabindex=
                    "6" accesskey="E" href="#El">Eliminar datos en una tabla</a></li>
                <li><a title="Generar" tabindex=
                    "7" accesskey="G" href="#Gen">Generar informe</a></li>
                <li><a title="Cargar" tabindex=
                    "8" accesskey="C" href="#Carg">Cargar datos desde un archivo CSV en una tabla de la Base de Datos</a></li>
                <li><a title="Exportar" tabindex="9" accesskey="X" href="#Expo">Exportar datos a un archivo en formato CSV los datos desde una tabla de la Base de
                    Datos</a></li>
            </ul>

        </nav>

        <section>
            <a id="CrearBD"></a>
            <h2>Crear Base de Datos</h2>
                <form  method="post" name="Menu1">
                    <input type="submit" value="Crear Base de Datos" name="CrearBase" />
                </form>
        </section>

        <section>
            <a id="CrearT"></a>
            <h2>Crear una tabla</h2>
                <form  method="post" name="Menu2">
                    <input type="submit" value="Crear una tabla"   name="CrearTabla" />
                </form>
        </section>

        <section>
            <a id="Ins"></a>
            <h2>Insertar datos en una tabla</h2>
                <form  method="post" name="Menu3">
                    <label for="insdni">DNI:
                        <input type="text" id="insdni" name="insdni"/>
                    </label>
                    <label for="insnombre">Nombre:
                        <input type="text" id="insnombre" name="insnombre"/>
                    </label>
                    <label for="insapellidos">Apellidos:
                        <input type="text" id="insapellidos" name="insapellidos"/>
                    </label>
                    <label for="insemail">E-mail:
                        <input type="text" id="insemail" name="insemail"/>
                    </label>
                    <label for="instel">Teléfono:
                        <input type="text" id="instel" name="instel"/>
                    </label>
                    <label for="insedad">Edad:
                        <input type="text" id="insedad" name="insedad"/>
                    </label>
                    <label for="insgen">Género (Hombre/Mujer):
                        <input type="text" id="insgen" name="insgen"/>
                    </label>
                    <label for="insnivel">Nivel informático:
                        <input type="text" id="insnivel" name="insnivel"/>
                    </label>
                    <label for="inst">Tiempo en segundos:
                        <input type="text" id="inst" name="inst"/>
                    </label>
                    <label for="instarea">¿Finalizó la tarea correctamente? (sí/no):
                        <input type="text" id="instarea" name="instarea"/>
                    </label>
                    <label for="insc">Comentarios:
                        <input type="text" id="insc" name="insc"/>
                    </label>
                    <label for="insp">Propuestas:
                        <input type="text" id="insp" name="insp"/>
                    </label>
                    <label for="insv">Valoración del 1 al 10:
                        <input type="text" id="insv" name="insv"/>
                    </label>
                    <input type="submit" value="Insertar datos en una tabla"  name="Insertar" />
                </form>
        </section>

        <section>
            <a id="Bus"></a>
            <h2>Buscar datos en una tabla</h2>
                <form  method="post" name="Menu4">
                    <label for="d">Introduce el dni:
                        <input type="text" id="d" name="d"/>
                    </label>
                    <input type="submit" value="Buscar"  name="Buscar" />
                </form>
        </section>

        <section>
            <a id="Mod"></a>
            <h2>Modificar datos en una tabla</h2>
                <form  method="post" name="Menu5">
                    <label for="dn">Introduce el dni:
                        <input type="text" id="dn" name="dn"/>
                    </label>
                    <label for="n">Introduce el nuevo comentario:
                        <input type="text" id="n" name="n"/>
                    </label>
                    <input type="submit" value="Modificar nivel de Laura"  name="Modificar" />
                </form>
        </section>

        <section>
            <a id="El"></a>
            <h2>Eliminar datos en una tabla</h2>
                <form  method="post" name="Menu6">
                    <input type="submit" value="Eliminar datos en una tabla"  name="Eliminar" />
                </form>
        </section>

        <section>
            <a id="Gen"></a>
            <h2>Generar informe</h2>
                <form  method="post" name="Menu7">
                    <input type="submit" value="Generar informe"  name="GenerarInforme" />
                </form>
        </section>

        <section>
            <a id="Carg"></a>
            <h2>Cargar datos desde un archivo CSV en una tabla de la Base de Datos</h2>
                <form name="importarDatos" action="#" method="post" enctype="multipart/form-data">
                    <label for="file">Selecciona el archivo .csv
                        <input type="file" id="file" name="file"/>
                    </label>
                    <input type="submit" value="Cargar" name="Cargar" />
                </form>
        </section>

        <section>
            <a id="Expo"></a>
            <h2>Exportar datos a un archivo en formato CSV los datos desde una tabla de la Base de
            Datos</h2>
                    <form  method="post" name="Menu">
                    <input type="submit" value="Exportar datos a un archivo en formato CSV los datos desde una tabla de la Base de
                Datos"    name="Exportar" />
                </form>
        </section>

        ';

    class DB {

        
        function __construct(){
        }

        function crearBaseDeDatos() {
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");
            //Query
            $query = "CREATE DATABASE IF NOT EXISTS bd6 COLLATE utf8_spanish_ci";
            $baseDatos->query($query);

            if($baseDatos->query($query) === FALSE){
                echo "<section>
                <h3> Log </h3>
            <p>Error creando la base de datos</p></section>";
                exit();
            }
            else{
                echo "<section>
                <h3> Log </h3><p>Base de datos creada</p></section>";
            }
            
        }

        function crearTablas(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");

            $baseDatos->select_db("bd6");

            $tabla = "CREATE TABLE IF NOT EXISTS PruebasUsabilidad(
                id varchar(9) NOT NULL,
                nombre varchar(20) NOT NULL, 
                apellidos varchar(255) NOT NULL,
                email varchar(255) NOT NULL,
                telefono varchar(9) NOT NULL,
                edad int(10) NOT NULL, 
                sexo varchar(20) NOT NULL,
                nivel int(10) NOT NULL, 
                tiempo int(10) NOT NULL,
                correctamente varchar(10) NOT NULL,  
                comentarios varchar(255) NOT NULL,
                propuestas varchar(255) NOT NULL,
                valoracion int(10) NOT NULL)";
            
            if($baseDatos->query($tabla) === FALSE){
                echo "<p><section>
                <h3> Log </h3>Error creando la tabla</p></section>";
                exit();
            }
            else{
                echo "<p><section>
                <h3> Log </h3>Tabla creada</p></section>";
            }


        }

        function insertar(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");

            $baseDatos->select_db("bd6");

            $query = $baseDatos->prepare("INSERT INTO PruebasUsabilidad (id, nombre, apellidos, email, telefono, edad, sexo, nivel, tiempo, correctamente, comentarios, propuestas, valoracion) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");  
            $query->bind_param("sssssisiisssi", 
                        $_POST["insdni"],$_POST["insnombre"], $_POST["insapellidos"],$_POST["insemail"],$_POST["instel"],$_POST["insedad"],$_POST["insgen"],$_POST["insnivel"],$_POST["inst"],$_POST["instarea"],$_POST["insc"],$_POST["insp"],$_POST["insv"]);   

           
           
            $query->execute();

            //Filas añadidas
            echo "<section>
            <h3> Log </h3><p>Se añadieron datos</p></section>";
        }

        function buscar(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");
            $baseDatos->select_db("bd6");

            $query = $baseDatos->prepare("SELECT * FROM PruebasUsabilidad WHERE id = ?");

            $query->bind_param('s', $_POST["d"]);  

            $query->execute();
            $aux = $query->get_result();

            echo"<section>
            <h3> Log </h3>";
            while($i = $aux->fetch_array()){
                echo "<p>" . $i['nombre'] . " " . $i['apellidos'] . ", " . $i['edad'] . " años</p>";
                
            }
            echo"</section>";
        }

        function modificar(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");
            $baseDatos->select_db("bd6");

            $query = $baseDatos->prepare("UPDATE PruebasUsabilidad SET comentarios = ? WHERE id = ?");
            $query->bind_param('ss', $_POST["n"], $_POST["dn"]);  

            $query->execute();

            echo"<section>
            <h3> Log </h3><p>Modificado el nivel informático</p></section>";

    
        }

        function eliminar(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");
            $baseDatos->select_db("bd6");

            $baseDatos->query("DELETE FROM PruebasUsabilidad");

            echo "<section>
            <h3> Log </h3><p>Datos borrados</p></section>";

        }

        function generarInforme(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");
            $baseDatos->select_db("bd6");

            $personas = $baseDatos->query("SELECT COUNT(*) AS personas FROM PruebasUsabilidad");

            $nPersonas = 0;

            if($personas->num_rows> 0){
                while($i = $personas->fetch_assoc()) {
                    $nPersonas = $i['personas'];
                }
            }
                
            $edad = 0;
            $nmujer = 0;
            $nhombre = 0;
            $nivel = 0;
            $tiempo = 0;
            $correctamente = 0;
            $puntuacion = 0;

            $aux = $baseDatos->query("SELECT * FROM PruebasUsabilidad");

            if($aux){
                while($i = $aux->fetch_array()){
                    $edad = $edad + $i['edad'];

                    $nivel = $nivel + $i['nivel'];

                    $tiempo = $tiempo + $i['tiempo'];

                    $puntuacion = $puntuacion + $i['valoracion'];

                    if($i["sexo"] === 'mujer'){
                        $nmujer = $nmujer + 1;
                    }

                    if($i["sexo"] === 'hombre'){
                        $nhombre = $nhombre + 1;
                    }

                    if($i["correctamente"] === 'sí'){
                        $correctamente = $correctamente + 1;
                    }
                }
            }
            
            if($nPersonas>0){
                $edadMedia = $edad / $nPersonas;
                $nivelMedio = $nivel / $nPersonas;
                $tiempoMedio = $tiempo / $nPersonas;
                $puntuacionMedia = $puntuacion / $nPersonas;
                $frecuenciaMujeres = ($nmujer / $nPersonas) *100;
                $frecuenciaHombres = ($nhombre / $nPersonas) *100;
                $porcentajeTareasCorrectas = ($correctamente / $nPersonas) *100;
    
                echo "
                <section>
                <h3>Log</h3>
                <ul>
                    <li>Edad media: $edadMedia años</li>
                    <li>Frecuencia de mujeres: $frecuenciaMujeres%</li>
                    <li>Frecuencia de hombres: $frecuenciaHombres%</li>
                    <li>Nivel informático medio: $nivelMedio </li>
                    <li>Tiempo medio: $tiempoMedio segundos</li>
                    <li>Porcentaje de tareas realizadas correctamente: $porcentajeTareasCorrectas%</li>
                    <li>Puntuación media: $puntuacionMedia</li>
                </ul>
                </section>
                ";
            }
            else{
                echo "<section>
                <h3>Log</h3><p>No hay datos añadidos</p></section>";
            }
            
        }

        function cargar(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");
            $baseDatos->select_db("bd6");

            $archivo = fopen($_FILES['file']['tmp_name'], "rb");
            $line = fgetcsv($archivo);

            while($line){
                $query = $baseDatos->prepare("
                    INSERT INTO PruebasUsabilidad (id, nombre, apellidos, email, telefono, edad, sexo, nivel, tiempo, correctamente, comentarios, propuestas, valoracion) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)"
                );

                $query->bind_param("sssssisiisssi", $line[0], $line[1], $line[2], $line[3], $line[4], $line[5], $line[6], $line[7], $line[8], $line[9], $line[10], $line[11], $line[12]);

                $line = fgetcsv($archivo);
                $query->execute();
            }

            echo"<section><h3>Log</h3><p>Archivo cargado</p></section>";
            
        }

        function exportar(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");
            $baseDatos->select_db("bd6");

            $query = $baseDatos->query("SELECT * FROM PruebasUsabilidad");

            $aux = "";
            if($query->num_rows>0) {
                while($i = $query->fetch_assoc()){
                    $aux .= $i["id"] . "," . $i["nombre"] . "," . $i["apellidos"] . "," . $i["email"] . "," . $i["telefono"] . "," . $i["edad"] . "," . $i["sexo"] . "," . $i["nivel"] . "," . $i["tiempo"] . "," . $i["correctamente"] . "," . $i["comentarios"] . "," . $i["propuestas"] . "," . $i["valoracion"] . "\n";
                }
            }

            file_put_contents("pruebasUsabilidad.csv", $aux);

            echo "<section><h3>Log</h3><p>Archivo exportado</p></section>";

        }

    }

    $db = new DB();
    
    if (count($_POST) > 0) {
        if (isset($_POST["CrearBase"])) {
            $db->crearBaseDeDatos();
        }
        if (isset($_POST["CrearTabla"])) {
            $db->crearTablas();
        }
        if (isset($_POST["Insertar"])) {
            $db->insertar();
        }
        if (isset($_POST["Buscar"])) {
            $db->buscar();
        }
        if (isset($_POST["Modificar"])) {
            $db->modificar();
        }
        if (isset($_POST["Eliminar"])) {
            $db->eliminar();
        }
        if (isset($_POST["GenerarInforme"])) {
            $db->generarInforme();
        }
        if (isset($_POST["Cargar"])) {
            $db->cargar();
        }
        if (isset($_POST["Exportar"])) {
            $db->exportar();
        }
        
    }

   
    
    ?>
</body>
</html>