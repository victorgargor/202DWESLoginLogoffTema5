<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 01/12/2024
 */
// Iniciamos la sesión o reanudamos la existente mediante esta función
session_start();

// Comprobar si se ha presionado el botón de cancelar, redirigir al programa
if (!empty($_REQUEST['cancelar'])) {
    header("Location: programa.php");
    exit();
}

if (!empty($_REQUEST['cambiarpassword'])) {
    header("Location: cambiarPassword.php");
    exit();
}
    ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../webroot/css/editarperfil.css" type="text/css">
        <title>EDITAR PERFIL</title>
    </head>
    <body>
        <header>
            <h1>EDITAR PERFIL</h1>
        </header>
        <main>
            <form>
                <input type="submit" name="cambiarpassword" value="Cambiar password">
            </form>
            <form>
                <input type="submit" name="cancelar" value="Cancelar">
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