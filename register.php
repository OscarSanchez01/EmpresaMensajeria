
<?php
session_start();
$error = false;
$msg_err = '';

function conexionBD()
{
    global $pdo;
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=sistemaenvios', 'paquetes', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');
    } catch (PDOException $e) {
        die("Error en la conexión: " . $e->getMessage());
    }
}

conexionBD();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if (empty($user) || empty($email) || empty($address) || empty($pass)) {
        $msg_err = 'Completa todos los campos.';
        $error = true;
    } else {
        try {
            // Verificar si el usuario o email ya existen
            $query = "SELECT * FROM USUARIOS WHERE username = :username OR mail = :email";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':username', $user);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $msg_err = 'El usuario o el email ya existen. Por favor, elige otro.';
                $error = true;
            } else {
                // Insertar el nuevo usuario con contraseña
                $hashedPass = password_hash($pass, PASSWORD_BCRYPT);

                $query = "INSERT INTO USUARIOS (username, password, rol, mail, direccion) 
                          VALUES (:username, :password, 'R', :email, :address)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':username', $user);
                $stmt->bindParam(':password', $pass);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':address', $address);

                if ($stmt->execute()) {
                    $_SESSION['username'] = $user;
                    header("Location: ./index.php");
                    exit;
                } else {
                    $msg_err = 'Error en la inserción, por favor intenta más tarde.';
                    $error = true;
                }
            }
        } catch (PDOException $e) {
            $msg_err = 'Error: ' . $e->getMessage();
            $error = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./assets/remixicon/remixicon.css" />
</head>
<body>
    <div class="page">
        <div class="container">
            <div class="left">
                <div class="login">Registro</div>
                <div class="eula">
                    ¿Ya tienes una cuenta?
                    <p><a href="./index.php" class="span">Inicia sesión</a></p>
                </div>
            </div>
            <div class="right">
                <form class="form" method="POST">
                    <label for="username">Nombre de Usuario</label>
                    <input type="text" name="username" id="username" placeholder="Nuevo usuario"  />

                    <label for="email">Correo Electrónico</label>
                    <input type="text" name="email" id="email" placeholder="Introduce tu email"  />

                    <label for="address">Dirección</label>
                    <input type="text" name="address" id="address" placeholder="Introduce tu Dirección"  />

                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Introduce tu contraseña"  />

                    <?php if ($error && $msg_err): ?>
                        <p style="color: red"><?= $msg_err; ?></p>
                    <?php endif; ?>

                    <button class="button-submit" type="submit">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>