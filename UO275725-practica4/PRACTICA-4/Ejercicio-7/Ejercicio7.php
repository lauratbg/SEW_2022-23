<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8" />
    <title>Ejercicio 7</title>

    <!-- Autor -->
    <meta name ="author" content ="Laura Gómez" />

    <!-- Descripción -->
    <meta name ="description" content ="Ejercicio 7" />

    <!-- Definir la ventana gráfica -->
    <meta name ="viewport" content ="width=device-width, initial-scale=1.0" />

    <!-- añadir el elemento link de enlace a la hoja de estilo dentro del <head> del documento html -->
    <link rel="stylesheet" type="text/css" href="Ejercicio7.css" />
</head>

<body>
    <?php 

echo '
        <h1>Ejercicio 7</h1>
        <nav>
            <ul>
                <li><a title="Insertar" tabindex=
                    "1" accesskey="I" href="#Ins">Insertar producto</a></li>
                <li><a title="Eliminar producto" tabindex=
                    "2" accesskey="E" href="#El">Borrar producto</a></li>
                <li><a title="Buscar dirección tienda" tabindex=
                    "3" accesskey="B" href="#Bu">Buscar dirección de una tienda</a></li>
                <li><a title="Cargar productos" tabindex=
                    "4" accesskey="C" href="#Car">Cargar productos desde un .csv</a></li>
                <li><a title="Buscar cantidad" tabindex=
                    "5" accesskey="X" href="#Bu2">Buscar cantidad de un producto</a></li>
                <li><a title="Informe de factura" tabindex=
                    "6" accesskey="F" href="#Bu3">Informe de factura de un cliente</a></li>
            </ul>
        </nav>
        <section>
            <a id="Ins"></a>
            <h2>Insertar producto</h2>
                <form  method="post" name="Menu1">
                    <label for="idp">Introduce la ID del producto
                        <input type="text" id="idp" name="idp"/>
                    </label>
                    <label for="np">Introduce el nombre producto
                        <input type="text" id="np" name="np"/>
                    </label>
                    <label for="dp">Introduce la descripción del producto
                        <input type="text" id="dp" name="dp"/>
                    </label>
                    <input type="submit" value="Insertar datos en una tabla"  name="Insertar" />
                </form>
        </section>
        <section>
            <a id="El"></a>
            <h2>Borrar producto</h2>
                    <form  method="post" name="Menu2">
                        <label for="bidp">Introduce la ID del producto
                            <input type="text" id="bidp" name="bidp"/>
                        </label>
                        <input type="submit" value="Borrar datos"  name="Borrar" />
                    </form>
        </section>
        <section>
            <a id="Bu"></a>
            <h2>Buscar dirección de una tienda</h2>
                    <form  method="post" name="Menu2">
                        <label for="idt">Introduce la ID de la tienda
                            <input type="text" id="idt" name="idt"/>
                        </label>
                        <input type="submit" value="Buscar"  name="Buscar" />
                    </form>
        </section>
        <section>
            <a id="Car"></a>
            <h2>Cargar productos desde un .csv</h2>
                <form name="importarDatos" action="#" method="post" enctype="multipart/form-data">
                    <label for="file">Selecciona el archivo .csv
                        <input type="file" id="file" name="file"/>
                    </label>
                    <input type="submit" value="Cargar" name="Cargar" />
                </form>
        </section>
        <section>
            <a id="Bu2"></a>
            <h2>Buscar cantidad de un producto</h2>
                    <form  method="post" name="Menu2">
                        <label for="pc">Introduce la ID del producto
                            <input type="text" id="pc" name="pc"/>
                        </label>
                        <input type="submit" value="Buscar Cantidad"  name="BuscarCantidad" />
                    </form>
        </section>
        <section>
            <a id="Bu3"></a>
            <h2>Informe de factura de un cliente</h2>
                    <form  method="post" name="Menu2">
                        <label for="f">Introduce la ID del cliente
                            <input type="text" id="f" name="f"/>
                        </label>
                        <input type="submit" value="Generar Factura"  name="GenerarFactura" />
                    </form>
        </section>
        ';

    class DB {

        
        function __construct(){
        }

        function insertar(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");

            $baseDatos->select_db("bd7");

            $query = $baseDatos->prepare("INSERT INTO PRODUCTO (id_producto, nombre_producto, descripcion_producto) VALUES (?,?,?)");   
            
            $query->bind_param('sss', 
                        $_POST["idp"],$_POST["np"], $_POST["dp"]);    
    
            $query->execute();
        
            //Filas añadidas
            echo "<section><h3>Log</h3>
            <p>Se ha añadido una fila</p></section>";
        }

        function buscarDireccionTienda(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");
            $baseDatos->select_db("bd7");

            $query = $baseDatos->prepare("SELECT direccion_tienda FROM TIENDA WHERE id_tienda = ?");

            
            $query->bind_param('s', 
                        $_POST["idt"]);    
    
            $query->execute();

            $aux = $query->get_result();

            while($i = $aux->fetch_array()){
                echo "<section><h3>Log</h3>
                <p> Dirección: " . $i['direccion_tienda'] ."</p></section>";
            }
        }

        function buscarCantidad(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");
            $baseDatos->select_db("bd7");

            $query = $baseDatos->prepare("SELECT cantidad_producto FROM FACTURA_PRODUCTO WHERE id_producto = ?");

            
            $query->bind_param('s', 
                        $_POST["pc"]);    
    
            $query->execute();

            $aux = $query->get_result();

            $contador = 0;
            while($i = $aux->fetch_array()){
                $contador = $contador + 1;
                echo "<section><h3>Log</h3>
                <p> Cantidad: " . $i['cantidad_producto'] ."</p></section>";
            }
            if($contador===0){
                echo"<section><h3>Log</h3>
                <p>Fuera de stock</p></section>";
            }
        }

        function eliminar(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");
            $baseDatos->select_db("bd7");

            $query = $baseDatos->prepare("DELETE FROM PRODUCTO WHERE id_producto = ?");

            $query->bind_param('s', $_POST["bidp"]);    
    
            $query->execute();

            echo "<section><h3>Log</h3><p>Producto borrados</p></section>";

        }

        function GenerarFactura(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");
            $baseDatos->select_db("bd7");

            $query = $baseDatos->prepare("SELECT * FROM FACTURA WHERE id_cliente = ?");

            $query->bind_param('s', $_POST["f"]);    
    
            $query->execute();

            $aux = $query->get_result();

            while($i = $aux->fetch_array()){
                echo "<section><h3>Log</h3>
                    <ul>
                        <li>Identificación de la factura: " . $i['id_factura'] . "</li>
                        <li>Identificación de la tienda:  " . $i['id_tienda'] . "</li>
                        <li>Cantidad de la factura: " . $i['cantidad_factura'] . "€</li>
                        <li>Descripción: " . $i['descripcion_factura'] . "</li>
                    </ul></section>";
            }
        }

        function cargarProductos(){
            //Crear conexion
            $baseDatos = new mysqli("localhost", "", "");
            $baseDatos->select_db("bd7");

            $archivo = fopen($_FILES['file']['tmp_name'], "rb");
            $line = fgetcsv($archivo);

            while($line){
                $query = $baseDatos->prepare("
                    INSERT INTO PRODUCTO (id_producto, nombre_producto, descripcion_producto) 
                    VALUES (?,?,?)"
                );

                $query->bind_param("sss", $line[0], $line[1], $line[2]);

                $line = fgetcsv($archivo);
                $query->execute();
            }

            echo"<section><h3>Log</h3><p>Archivo cargado</p></section>";
            
        }

    }

    $db = new DB();
    
    if (count($_POST) > 0) {
        if (isset($_POST["Insertar"])) {
            $db->insertar();
        }
        if (isset($_POST["Buscar"])) {
            $db->buscarDireccionTienda();
        }
        if (isset($_POST["BuscarCantidad"])) {
            $db->buscarCantidad();
        }
        if (isset($_POST["Borrar"])) {
            $db->eliminar();
        }
        if (isset($_POST["GenerarFactura"])) {
            $db->GenerarFactura();
        }
        if (isset($_POST["Cargar"])) {
            $db->cargarProductos();
        }

        
    }
    
    ?>
</body>
</html>