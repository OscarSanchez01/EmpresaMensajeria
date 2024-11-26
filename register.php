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

function conexionBD() {
    global $pdo;
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=sistemaenvios', 'paquetes', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');
    } catch (PDOException $e) {
        die("Error en la conexión: " . $e->getMessage());
    }
}

conexionBD(); // Inicia la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Validar que los campos no estén vacíos
    if (!$user || !$email || !$address || !$pass) {
        echo "<p style='color:red;'>Por favor, completa todos los campos.</p>";
    } else {
        // Verificar si el usuario o email ya existen
        $query = "SELECT * FROM USUARIOS WHERE username = '$user' OR mail = '$email'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        // Verificar si ya existe el usuario o el email
        if ($stmt->rowCount() > 0) {
            echo "<p style='color:red;'>El usuario o el email ya están registrados.</p>";
        } else {

            // Id usuario
            $query = "SELECT MAX(id_usuario) AS max_id FROM USUARIOS";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $newId = $result['max_id'] ? $result['max_id'] + 1 : 1;


            //Isert
            $query = "INSERT INTO USUARIOS (id_usuario, username, password, rol, mail, direccion) 
                      VALUES ('$newId', '$user', '$pass', 'R', '$email', '$address')";
            $stmt = $pdo->prepare($query);

            if ($stmt->execute()) {
               
                header("Location: ./index.php");
                exit; 
                echo "<p style='color:red;'>Error al registrar el usuario. Inténtalo de nuevo más tarde.</p>";
            }
        }
    }
}

?>
    <!-- AQUI ESTA EL FORM -->
    <form class="form" action="register.php" method="POST">
        
        
        <!-- NOMBRE -->
        <div class="flex-column">
            <label>Name </label>
        </div>
        <div class="inputForm">
            <i class="ri-user-5-fill"></i>

            <!-- INPUT NOMBRE -->
            <input type="text" name="username" class="input" placeholder="Nuevo usuario" />
        </div>


        <!-- EMAIL -->
        <div class="flex-column">
            <label>Email </label>
        </div>
        <div class="inputForm">
            <i class="ri-mail-fill"></i>
            <!-- INPUT EMAIL -->
            <input type="text" class="input" name="email" placeholder="Introduce tu email" />
        </div>


        <!-- DIRECCIÓN -->
        <div class="flex-column">
            <label>Dirección </label>
        </div>
        <div class="inputForm">
            <i class="ri-compass-3-fill"></i>
            <!-- INPUT DIRECCIÓN -->
            <input type="text" class="input" name="address" placeholder="Introduce tu Dirección" />
        </div>




        <!-- CONTRASEÑA -->
        <div class="flex-column">
            <label>Password </label>
        </div>
        <div class="inputForm">
            <i class="ri-lock-2-fill"></i>
            <!-- INPUT CONTRASEÑA -->
            <input type="password" class="input" name="password" placeholder="Introduce tu contraseña" />
        </div>

        <button class="button-submit">Sign Up</button>

        <p class="p">¿Tienes una cuenta? <a href="./index.php" class="span">Inicia sesion</a></p>

    </form>

    <?php


    ?>



</body>

</html>