<?php
// Iniciamos la sesión o reanudamos la existente mediante esta función
session_start();

// Verificamos si el usuario está autenticado
if (empty($_SESSION['usuarioDAW202AppLoginLogoffTema5'])) {
    header("Location: login.php");
    exit();
}

// Obtener el idioma de la cookie, si no está establecida, se usa 'es' como predeterminado
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';

// Obtener el objeto completo del usuario desde la sesión
$oUsuarioActivo = $_SESSION['usuarioDAW202AppLoginLogoffTema5'];

// Mostrar información del usuario
$nombreUsuario = $oUsuarioActivo->T01_DescUsuario;
$numConexiones = $oUsuarioActivo->T01_NumConexiones + 1;
$fechaUltimaConexion = $oUsuarioActivo->T01_FechaHoraUltimaConexion;

// Formatear la fecha de la última conexión
$fechaUltimaConexionFormateada = date("d/m/Y H:i:s", strtotime($fechaUltimaConexion));

// Definir los mensajes de bienvenida en los distintos idiomas
$mensajesBienvenida = [
    'es' => [
        'primera_vez' => "¡Bienvenido <b> &nbsp;{nombre} </b>! Esta es la primera vez que te conectas.",
        'vuelta' => "¡Bienvenido de nuevo <b>&nbsp;{nombre}</b>! Esta es la <b>&nbsp;{numConexiones}&nbsp;</b> vez que te conectas y te conectaste por última vez el <b>&nbsp;{fechaUltimaConexion}&nbsp;</b>"
    ],
    'en' => [
        'primera_vez' => "Welcome <b> &nbsp;{nombre} </b>! This is the first time you have logged in.",
        'vuelta' => "Welcome back <b>&nbsp;{nombre}</b>! This is the <b>&nbsp;{numConexiones}&nbsp;</b> time you have logged in, and you last logged in on <b>&nbsp;{fechaUltimaConexion}&nbsp;</b>"
    ],
    'pt' => [
        'primera_vez' => "Bem-vindo <b> &nbsp;{nombre} </b>! Esta é a primeira vez que você se conecta.",
        'vuelta' => "Bem-vindo de volta <b>&nbsp;{nombre}</b>! Esta é a <b>&nbsp;{numConexiones}&nbsp;</b> vez que você se conecta, e você se conectou pela última vez em <b>&nbsp;{fechaUltimaConexion}&nbsp;</b>"
    ]
];

// Determinar el mensaje a mostrar en función del número de conexiones
if ($numConexiones == 1) {
    // Primera vez que el usuario se conecta
    $mensaje = $mensajesBienvenida[$idioma]['primera_vez'];
} else {
    // No es la primera vez
    $mensaje = $mensajesBienvenida[$idioma]['vuelta'];
}

// Reemplazar los marcadores de posición en el mensaje con los valores reales
$mensaje = str_replace(
    ['{nombre}', '{numConexiones}', '{fechaUltimaConexion}'],
    [$nombreUsuario, $numConexiones, $fechaUltimaConexionFormateada],
    $mensaje
);

echo "<p id = 'mensaje-bienvenida'>" . $mensaje . "</p>";

if (isset($_REQUEST['editarperfil'])) {
    // Redirige a la página de editarPerfil
    header("Location: editarPerfil.php");
    exit();
}

if (isset($_REQUEST['detalle'])) {
    // Redirige a la página de detalle
    header("Location: detalle.php");
    exit();
}

if (isset($_REQUEST['mtodepartamentos'])) {
    // Redirige a la página de detalle
    header("Location: MtoDepartamentos.php");
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
        <link rel="stylesheet" href="../webroot/css/aplicacion.css" type="text/css">
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
                <input type="submit" name="mtodepartamentos" value="Mto. Departamentos">
            </form>
            <form>
                <input type="submit" name="editarperfil" value="Editar Perfil">
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

