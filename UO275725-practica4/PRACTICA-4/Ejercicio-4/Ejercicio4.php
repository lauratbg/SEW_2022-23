<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Datos que describen el documento -->
    <meta charset="UTF-8" />
    <title>Ejercicio 4</title>

    <!-- Autor -->
    <meta name ="author" content ="Laura Gómez" />

    <!-- Descripción -->
    <meta name ="description" content ="Ejercicio 4" />

    <!-- Definir la ventana gráfica -->
    <meta name ="viewport" content ="width=device-width, initial-scale=1.0" />

    <!-- añadir el elemento link de enlace a la hoja de estilo dentro del <head> del documento html -->
    <link rel="stylesheet" type="text/css" href="Ejercicio4.css" />
</head>

<body>
    <?php session_start();

    echo '
        <header>
            <h1>Precio internacional del gas natural</h1>
        </header>
        <main>
            <h2>Precio Gas Natural</h2>
            
        </main>
    ';
    
    class Cliente {

        function call() {
            $apikey = ""; 
            $hoy = date('Y-m-d');
            $url = "https://commodities-api.com/api/" . $hoy . "?access_key=" . $apikey .
            "&base=EUR&symbols=NG";
        
            $json = file_get_contents($url);
            $this->datos = json_decode($json);
        }

        function getNG() {
            return "<section><h3>Precio en euros</h3><p>Precio hoy: " . $this->datos->data->rates->NG . "€</p></section>";
        }


    }

    $cliente = new Cliente();
    $cliente->call();

    echo $cliente->getNG();

    
    ?>
</body>
</html>