<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 01/12/2024
 */
// Si la cookie está vacia se crea y se le pone un valor por defecto
if (!isset($_COOKIE['idioma'])) {
    setcookie("idioma", "es", time() + 3600, "/");
}

// Si el idioma enviado está vacio o es null
if (isset($_REQUEST['idioma'])) {
    setcookie("idioma", $_REQUEST['idioma'], time() + 60, "/");
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

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
        <link rel="stylesheet" href="webroot/css/aplicacion.css" type="text/css">
        <title>Víctor García Gordón</title>
    </head>
    <body>
        <header>      
            <h1 id="inicio">APLICACIÓN LOGIN LOGOFF TEMA 5</h1>
        </header>
        <main>
            <form>
                <input type="submit" name="login" value="Login">
            </form>
            <section>
                <div id="readme-content">
                    <?= $readmeHTML; ?>
                </div>
                <div>
                    <a class="españa" href="?idioma=es">
                        <img src="doc/españa.png" alt="es">
                    </a>
                    <a class="inglaterra" href="?idioma=en">
                        <img src="doc/inglaterra.png" alt="en">
                    </a>
                    <a class="portugal" href="?idioma=pt">
                        <img src="doc/portugal.png" alt="pt">
                    </a>
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
         <script>
            // Función para restaurar el tamaño original de las banderas
            function restaurarTamanoOriginal() {
                const banderas = ['españa', 'inglaterra', 'portugal'];
                banderas.forEach(bandera => {
                    const imagenBandera = document.querySelector(`.${bandera} img`);
                    if (imagenBandera) {
                        imagenBandera.style.transform = 'scale(1)'; // Restauramos el tamaño original
                    }
                });
            }

            // Función para reducir el tamaño de las demás banderas
            function reducirOtrasBanderas(claseBandera) {
                const banderas = ['españa', 'inglaterra', 'portugal'];
                banderas.forEach(bandera => {
                    if (bandera !== claseBandera) {
                        const imagenBandera = document.querySelector(`.${bandera} img`);
                        if (imagenBandera) {
                            imagenBandera.style.transform = 'scale(0.5)'; // Reducir otras banderas
                        }
                    }
                });
            }

            // Función para obtener el idioma desde la cookie
            function obtenerIdiomaCookie() {
                const cookies = document.cookie.split(';');
                for (let cookie of cookies) {
                    cookie = cookie.trim();
                    if (cookie.startsWith('idioma=')) {
                        return cookie.substring('idioma='.length);
                    }
                }
                return 'es'; // Valor predeterminado si no hay cookie
            }

            // Recuperar el idioma guardado al cargar la página
            window.onload = function () {
                const idiomaGuardado = obtenerIdiomaCookie();
                
                // Restaurar tamaño de las banderas y reducir las otras según el idioma
                restaurarTamanoOriginal(); // Restauramos el tamaño de todas las banderas

                if (idiomaGuardado === 'es') {
                    reducirOtrasBanderas('españa');
                } else if (idiomaGuardado === 'en') {
                    reducirOtrasBanderas('inglaterra');
                } else if (idiomaGuardado === 'pt') {
                    reducirOtrasBanderas('portugal');
                }
            };

            // Event listeners para cambiar el tamaño de la bandera y restaurar el tamaño de las otras
            document.querySelector('.españa').addEventListener('click', function () {
                restaurarTamanoOriginal(); // Restaurar tamaño de todas las banderas
                reducirOtrasBanderas('españa');
            });

            document.querySelector('.inglaterra').addEventListener('click', function () {
                restaurarTamanoOriginal(); // Restaurar tamaño de todas las banderas
                reducirOtrasBanderas('inglaterra');
            });

            document.querySelector('.portugal').addEventListener('click', function () {
                restaurarTamanoOriginal(); // Restaurar tamaño de todas las banderas
                reducirOtrasBanderas('portugal');
            });
        </script>
    </body>
</html>

