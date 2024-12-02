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
    if (empty($user) || empty($email) || empty($address) || empty($pass)) {
        echo "<p class='error'>Por favor, completa todos los campos.</p>";
    } else {
        // Validación del formato de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p class='error'>El correo electrónico no es válido.</p>";
        } else {
            // Verificar si el usuario o email ya existen
            $query = "SELECT * FROM USUARIOS WHERE username = :username OR mail = :email";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':username', $user);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Verificar si ya existe el usuario o el email
            if ($stmt->rowCount() > 0) {
                echo "<p class='error'>El usuario o el email ya están registrados.</p>";
            } else {
                // Cifrar la contraseña
                $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

                // Obtener el siguiente ID de usuario
                $query = "SELECT MAX(id_usuario) AS max_id FROM USUARIOS";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $newId = $result['max_id'] ? $result['max_id'] + 1 : 1;

                // Insertar el nuevo usuario
                $query = "INSERT INTO USUARIOS (id_usuario, username, password, rol, mail, direccion) 
                        VALUES (:id, :username, :password, 'R', :email, :address)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id', $newId);
                $stmt->bindParam(':username', $user);
                $stmt->bindParam(':password', $hashedPass);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':address', $address);

                if ($stmt->execute()) {
                    // Redirigir a la página de login o éxito
                    header("Location: ./index.php");
                    exit; 
                } else {
                    echo "<p class='error'>Error al registrar el usuario. Inténtalo de nuevo más tarde.</p>";
                }
            }
        }
    }
}

?> 

    <!-- Formulario de registro -->

    <div class="page">
        <div class="container">
          <div class="left">
            <div class="login">Register</div>
            <div class="eula">

                ¿Ya tienes una cuenta? 
                <p><a href= "./index.php" class="span">Inicia sesión</a></p>
            
            </div>
          </div>
          <div class="right">
            <div class="form">
              <label for="username" >Nombre de Usuario</label>
              <input type="text" name="username" id="username"  placeholder="Nuevo usuario" required />

              <label for="email">Correo Electrónico</label>
              <input type="text" name="email" id="email"  placeholder="Introduce tu email" required />

              <label for="address" >Dirección</label>
              <input type="text" name="address" id="address" placeholder="Introduce tu Dirección" required />

              <label for="password">Contraseña</label>
              <input type="password" name="password" id="password" placeholder="Introduce tu contraseña" required />

              <button class="button-submit" name="submit" type="submit">Registar</button>
            </div>
          </div>
        </div>
      </div>

  
</body>

</html>