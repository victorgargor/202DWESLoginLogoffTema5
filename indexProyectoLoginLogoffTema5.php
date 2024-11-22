<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 21/11/2024
 */

// Redirige a la página de login si se pulsa el botón
if (isset($_REQUEST['login'])) {
    header("Location:codigoPHP/login.php");
    exit();
}

// Cargar el contenido del archivo README.md
$readmeFile = "README.md";
$readmeContent = file_exists($readmeFile) ? file_get_contents($readmeFile) : "Archivo README.md no encontrado.";

// Incluir Parsedown para convertir Markdown a HTML
require_once "core/Parsedown.php";
$Parsedown = new Parsedown();
$readmeHTML = $Parsedown->text($readmeContent);
?> new Parsedown();
$readmeHTML = $Pars
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="webroot/css/index.css" type="text/css">
        <title>Víctor García Gordón</title>
    </head>
    <body>
        <header>      
            <h1 id="inicio">APLICACIÓN LOGIN LOGOFF TEMA 5</h1>
        </header>
        <main>
            <form>
                <input type="submit" name="login" value="LOGIN">
            </form>
            <section>
                <div id="readme-content">
                    <?= $readmeHTML; ?>
                </div>
            </section>
        </main>
        <footer>
            <div>
                <a href="/index.html">Víctor García Gordón</a>
                <a href="/202DWESProyectoDWES/indexProyectoDWES.php">DWES</a>
                <a target="blank" href="doc/curriculum.pdf"><img src="doc/curriculum.jpg" alt="curriculum"></a>
                <a target="blank" href="https://github.com/victorgargor/202DWESLoginLogoffTema5"><img src="doc/github.png" alt="github"></a>
                <a target="blank" href="https://github.com">Web Imitada</a>
            </div>
        </footer>
    </body>
</html>

