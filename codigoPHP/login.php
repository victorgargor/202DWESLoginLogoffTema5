<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 26/11/2024
 */
// Iniciamos la sesión o reanudamos la existente mediante esta función
session_start();

// Si el usuario ya se ha autenticado previamente y no ha cerrado el navegador, se entra a la aplicación directamente
if (isset($_SESSION["usuarioDAW202AppLoginLogoffTema5"])) {
    header("Location: programa.php");
    exit();
}

// Comprobar si se ha presionado el botón de cancelar, redirigir al login
if (!empty($_REQUEST['volver'])) {
    header("Location: ../indexProyectoLoginLogoffTema5.php");
    exit();
}

// Incluir archivos necesarios para la validación y la conexión a la base de datos
require_once('../core/231018libreriaValidacion.php');
require_once('../config/ConfDBPDO.php');

// Variable que indica si las respuestas son correctas
$entradaOK = true;

// Array para almacenar los errores de validación
$aErrores = [
    'usuario' => '',
    'password' => ''
];

// Verificar si el formulario ha sido enviado
if (isset($_REQUEST['iniciarsesion'])) {

    // Validar los campos de usuario y contraseña
    $aErrores['usuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['usuario'], 256, 4, 0);
    $aErrores['password'] = validacionFormularios::validarPassword($_REQUEST['password'], 256, 4, 1, 0);

    try {
        // Conectar a la base de datos utilizando PDO
        $miDB = new PDO(DSN, USER, PASSWORD);

        // Variable que contiene el hash del usuario + password
        $hashedPassword = hash("sha256", $_REQUEST['usuario'] . $_REQUEST['password']);

        // Preparar la consulta para verificar las credenciales del usuario
        $sql = $miDB->prepare('SELECT * FROM T01_Usuario WHERE T01_CodUsuario = :usuario AND T01_Password = :password');
        $sql->bindParam(':usuario', $_REQUEST['usuario']);
        $sql->bindParam(':password', $hashedPassword);
        $sql->execute();

        // Obtener el resultado de la consulta
        $oUsuarioActivo = $sql->fetchObject();

        // Verificar si hay errores en los campos de entrada
        foreach ($aErrores as $campo => $valor) {
            if ($valor != null) {
                $entradaOK = false;
                $_REQUEST[$campo] = '';  // Limpiar campos con errores
            }
        }
    } catch (PDOException $exception) {
        // Capturar cualquier error de la base de datos y mostrarlo
        echo "<p>Error: " . $exception->getMessage() . "</p>";
        echo "<p>Código de error: " . $exception->getCode() . "</p><br/>";
    }
} else {
    $entradaOK = false;
}

// Si los datos son correctos, actualizar la información del usuario
if ($entradaOK) {
    try {
        // Incrementar el número de conexiones y actualizar la fecha de última conexión
        $numConexionActual = $oUsuarioActivo->T01_NumConexiones + 1;
        $fechaHoraUltimaConexionAnterior = $oUsuarioActivo->T01_FechaHoraUltimaConexion;

        // Guardar el objeto completo del usuario en la sesión
        $_SESSION['usuarioDAW202AppLoginLogoffTema5'] = $oUsuarioActivo;

        // Actualizar los datos del usuario en la base de datos
        $sql2 = $miDB->prepare('UPDATE T01_Usuario SET T01_NumConexiones = :numConexiones, T01_FechaHoraUltimaConexion = NOW() WHERE T01_CodUsuario = :usuario');
        $sql2->bindParam(':numConexiones', $numConexionActual);
        $sql2->bindParam(':usuario', $_REQUEST['usuario']);
        $sql2->execute();

        // Redirigir al programa principal
        header("Location: programa.php");
        exit();
    } catch (PDOException $exception) {
        // Si ocurre un error en la conexión con la base de datos, mostrarlo
        echo "<p>Error: " . $exception->getMessage() . "</p>";
        echo "<p>Código de error: " . $exception->getCode() . "</p><br/>";
    } finally {
        // Cerrar la conexión a la base de datos
        unset($miDB);
    }
} else {
    // Si los datos no son correctos, mostrar el formulario de login
    ?>
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../webroot/css/login.css" type="text/css">
            <title>Login</title>
        </head>
        <body>
            <header>
                <h1>LOGIN</h1>
            </header>
            <main>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" style="background-color: lightyellow" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" style="background-color: lightyellow" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="iniciarsesion" value="Iniciar Sesión">
                    </div>
                </form>
                <form>
                    <input type="submit" name="volver" value="Volver">
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
    <?php
}

