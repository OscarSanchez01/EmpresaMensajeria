<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/logins.css">
    <link rel="stylesheet" href="./assets/remixicon/remixicon.css" />
</head>

<body>

<?php
    session_start();

function conexionBD() {
    global $pdo;
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=sistemaenvios', 'paquetes', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');

        echo "Conexión establecida";
    } catch (PDOException $e) {
        echo "Error en la conexión";
    }
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $user = $_POST['username'];
//     $pass = $_POST['password'];
// }

?>
    <form class="form" action="index.php" method="POST">
        <!-- NOMBRE -->
        <div class="flex-column">
            <label>Name </label>
        </div>
        <div class="inputForm">
            <i class="ri-user-5-fill"></i>
            <!-- INPUT NOMBRE -->
            <input type="text" class="input" name="username" placeholder="Introduce tu usuario" required />
        </div>
    
        <!-- CONTRASEÑA -->
        <div class="flex-column">
            <label>Password </label>
        </div>
        <div class="inputForm">
            <i class="ri-lock-2-fill"></i>
            <!-- INPUT CONTRASEÑA -->
            <input type="password" class="input" name="password" placeholder="Introduce tu contraseña" required />
        </div>
    
        <button class="button-submit" type="submit">Sign Up</button>
    
        <p class="p">¿No tienes una cuenta? <a href= "./register.php" class="span">Registrate</a></p>
    </form>


    <?php
    conexionBD();
    $query = "SELECT * FROM USUARIOS";
$stmt = $pdo->prepare($query);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach ($resultado as $fila) {
//     echo "Usuario: " . $fila['username'] . ", Rol: " . $fila['rol'] . "<br>";
// }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Inicia conexión
    conexionBD();

    // Verifica usuario y contraseña
    $query = "SELECT * FROM USUARIOS WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':password', $pass);
    $stmt->execute();
    


    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // $_SESSION['username'] = $user;   ALMACENAMOS LOS DATOS DEL USUARIO
            $_SESSION['username'] = $row['username'];
            // $_SESSION['address'] = $row['direccion'];
            // $_SESSION['email'] = $row['mail'];
        
        if ($row['rol'] == 'A') {
            header("Location: panel_admin.php");

        } else {
            header("Location: panel.php");
        }
        exit;
    } else {
        echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
    }
}
    ?>

    



</body>

</html>