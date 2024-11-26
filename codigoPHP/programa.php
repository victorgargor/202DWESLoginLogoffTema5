<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 21/11/2024
 */
// Iniciamos la sesión o reanudamos la existente mediante esta función
session_start();

if (empty($_SESSION['usuarioDAW202AppLoginLogoffTema5']) || empty($_SESSION['numConexiones']) || empty($_SESSION['ultimaConexion'])) {
    header("Location:login.php");
    exit();
}

if (isset($_REQUEST['detalle'])) {
    // Redirige a la página de detalle
    header("Location:detalle.php");
    exit();
}
if (isset($_REQUEST['cerrarsesion'])) {
    // Redirige a la página de login
    session_unset();
    session_destroy();
    header("Location:../indexProyectoLoginLogoffTema5.php");
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
        <header>      
            <h1 id="inicio">PROGRAMA</h1>
        </header>
        <main>
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
