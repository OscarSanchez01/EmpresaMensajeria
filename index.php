<?php
    session_start();
    $msg_err = "";

    // Crear el token
    if (!isset($_SESSION['token'])) {
        $hora = date('H:i');
        $session_id = session_id();
        $token = hash('sha256', $hora . $session_id);
        $_SESSION['token'] = $token;
    }

    // Conexión a la base de datos
    function conexionBD() {
        global $pdo;
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=sistemaenvios', 'paquetes', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec('SET NAMES "utf8"');
        } catch (PDOException $e) {
            echo "Error en la conexión";
            exit();
        }
    }

    // Procesar formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $token = $_POST['token'];

        if ($_SESSION['token'] !== $token) {
            $msg_err = 'Intento de entrada sin token';
        } else {
            // Iniciar conexión
            conexionBD();

            // Verificar usuario y contraseña
            $query = "SELECT * FROM USUARIOS WHERE username = :username AND password = :password";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':username', $user);
            $stmt->bindParam(':password', $pass);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['username'] = $row['username'];
                
                /* //guardamos la contraseña */
                $_SESSION['password'] = $_POST['password'];

                if ($row['rol'] == 'A') {
                    header("Location: panel_admin.php");
                } else {
                    header("Location: panel.php");
                }
                exit;
            } else {
                $msg_err = 'Usuario o contraseña incorrectos';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/remixicon/remixicon.css" />
    <link rel="stylesheet" href="./css/login.css" />
</head>

<body>
    <div class="page">
        <div class="container">
            <div class="left">
                <div class="login">Login</div>
                <div class="eula">
                    ¿No tienes una cuenta?
                    <p><a href="./register.php" class="span">Regístrate</a></p>
                </div>
            </div>
            <div class="right">
                <form class="form" action="index.php" method="POST">
                    <label for="username">Usuario</label>
                    <input type="text" name="username" id="email" required>

                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" required>

                    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

                    <?php if (!empty($msg_err)) : ?>
                        <p style="color: red;"><?php echo $msg_err; ?></p>
                    <?php endif; ?>

                    <button class="button-submit" name="submit" type="submit">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
