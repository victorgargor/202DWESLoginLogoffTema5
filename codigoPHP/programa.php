<?php
// Iniciamos la sesión o reanudamos la existente mediante esta función
session_start();

// Verificamos si el usuario está autenticado
if (empty($_SESSION['usuarioDAW202AppLoginLogoffTema5'])) {
    header("Location: login.php");
    exit();
}

// Obtener el objeto completo del usuario desde la sesión
$oUsuarioActivo = $_SESSION['usuarioDAW202AppLoginLogoffTema5'];

// Mostrar información del usuario
$nombreUsuario = $oUsuarioActivo->T01_DescUsuario;
$numConexiones = $oUsuarioActivo->T01_NumConexiones+1;
$fechaUltimaConexion = $oUsuarioActivo->T01_FechaHoraUltimaConexion;

// Formatear la fecha de la última conexión
$fechaUltimaConexionFormateada = date("d/m/Y H:i:s", strtotime($fechaUltimaConexion));

// Mostramos el mensaje de bienvenida dependiendo de si es la primera vez o no
if ($numConexiones == 1) {
    echo "<p>¡Bienvenido <b> &nbsp". $nombreUsuario." </b>! Esta es la primera vez que te conectas.</p>";
} else {
    echo "<p>¡Bienvenido de nuevo <b>&nbsp;". $nombreUsuario ."</b>! Esta es la <b>&nbsp;". $numConexiones. "&nbsp;</b> vez que te conectas y te conectaste por última vez el <b>&nbsp;" .$fechaUltimaConexionFormateada. "&nbsp;</b></p>";
}

if (isset($_REQUEST['detalle'])) {
    // Redirige a la página de detalle
    header("Location: detalle.php");
    exit();
}

// Cerramos la sesión
if (isset($_REQUEST['cerrarsesion'])) {
    session_destroy();
    header("Location: ../indexProyectoLoginLogoffTema5.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../webroot/css/programa.css" type="text/css">
        <title>Víctor García Gordón</title>
    </head>
    <body>
        <img class="aplicacion" src="../doc/aplicacion.png" alt="aplicacion">
        <header>      
            <h1 id="inicio">PROGRAMA</h1>
        </header>
        <main>
            <div class="descripcion-usuario">
                <?php
                    // Muestra el nombre del usuario en mayúsculas
                    echo strtoupper($nombreUsuario);
                ?>
            </div>
            <form>
                <input type="submit" name="detalle" value="Detalle">
            </form>
            <form>
                <input type="submit" name="cerrarsesion" value="Cerrar Sesión">
            </form>
        </main>
        <footer>
            <div>
                <a href="/index.html">Víctor García Gordón</a>
                <a target="blank" href="../doc/curriculum.pdf"><img src="../doc/curriculum.jpg" alt="curriculum"></a>
                <a target="blank" href="https://github.com/victorgargor/202DWESLoginLogoffTema5"><img src="../doc/github.png" alt="github"></a>
                <a target="blank" href="https://github.com">Web Imitada</a>
            </div>
        </footer>
    </body>
</html>
