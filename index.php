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
    <div class="page">
        <div class="container">
          <div class="left">
            <div class="login">Login</div>
            <div class="eula">

                ¿No tienes una cuenta? 
                <p><a href= "./register.php" class="span">Registrate</a></p>
            
            </div>
          </div>
          <div class="right">
            <form class="form" action="index.php" method="POST">
              <label for="username">Usuario</label>
              <input type="text" name="username" id="email" required>
              <label for="password">Contraseña</label>
              <input type="password" name="password" id="password" required>

              <button class="button-submit" name="submit" type="submit">Sign Up</button>
</form>
          </div>
        </div>
      </div>

      

 
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