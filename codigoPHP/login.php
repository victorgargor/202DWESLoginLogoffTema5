<?php
/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 25/11/2024
 */
if (isset($_REQUEST['volver'])) {
    header('location:../indexProyectoLoginLogoffTema5.php'); // Redirige a la página principal
    exit;
}

// Si se ha enviado la solicitud 'iniciarsesion', intenta autenticar al usuario.
if (isset($_REQUEST['iniciarsesion'])) {
    // Incluye el archivo de configuración de la base de datos.
    require_once('../config/ConfDBPDO.php');
    try {
        // Conexión a la BD.
        $miDB = new PDO(DSN, USER, PASSWORD);

        // Prepara la consulta para obtener la contraseña del usuario usando un parámetro
        $sql = $miDB->prepare("SELECT T01_Password FROM T01_Usuario WHERE T01_CodUsuario = ?");
        $sql->execute([$_REQUEST['usuario']]); // Vincula el parámetro y ejecuta la consulta
        // Obtiene el resultado de la consulta como un objeto.
        $usuario = $sql->fetchObject();

        // Verifica si la contraseña de la base de datos coincide con la contraseña proporcionada por el usuario.
        if (isset($usuario->T01_Password) && hash('sha256', $_REQUEST['usuario'] . $_REQUEST['password']) == $usuario->T01_Password) {
            // Si la autenticación es correcta, actualiza el número de conexiones y la fecha de la última conexión.
            $sql2 = $miDB->prepare("UPDATE T01_Usuario SET T01_NumConexiones = T01_NumConexiones + 1, T01_FechaHoraUltimaConexion = now() WHERE T01_CodUsuario = ?");
            $sql2->execute([$_REQUEST['usuario']]); // Ejecuta la actualización
            // Redirige al usuario a la página 'programa.php' después de un inicio de sesión exitoso.
            header('location:programa.php');
        } else {
            // Si la autenticación falla, redirige al usuario de nuevo a la página de login.
            header('location:login.php');
        }
    } catch (PDOException $exception) {
        // Si ocurre un error al intentar conectar a la base de datos, muestra el mensaje de error.
        echo($exception->getMessage());
    } finally {
        unset($miDB); // Cerramos la conexión a la BD.
    }
    exit;
}
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
