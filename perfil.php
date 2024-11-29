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
    $query = 'SELECT mail, direccion FROM USUARIOS WHERE username = :username';
    $stmt = $pdo->prepare($query);
    //hay que igualar, si no no funciona
    $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
    $stmt->execute();


    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['mail'] = $row['mail'];
        $_SESSION['address'] = $row['direccion'];
    } else {
        echo "No se encontró información para el usuario.";
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
        // Actualizar username 
        if (isset($_POST['username']) && !empty($_POST['username'])) {
            $query = 'UPDATE USUARIOS SET username = :new_username WHERE username = :current_username';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':current_username', $_SESSION['username'], PDO::PARAM_STR);
            $stmt->bindParam(':new_username', $_POST['username'], PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $_SESSION['username'] = $_POST['username']; // Actualizar sesión
                echo "El nombre de usuario se ha actualizado correctamente.<br>";
            } else {
                echo "No se realizaron cambios en el nombre de usuario.<br>";
            }
        }
    
        // Actualizar email si 
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $query = 'UPDATE USUARIOS SET mail = :new_email WHERE username = :current_username';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':current_username', $_SESSION['username'], PDO::PARAM_STR);
            $stmt->bindParam(':new_email', $_POST['email'], PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $_SESSION['mail'] = $_POST['email']; // Actualizar sesión
                echo "El correo electrónico se ha actualizado correctamente.<br>";
            } else {
                echo "No se realizaron cambios en el correo electrónico.<br>";
            }
        }
    
        // Actualizar dirección 
        if (isset($_POST['address']) && !empty($_POST['address'])) {
            $query = 'UPDATE USUARIOS SET direccion = :new_address WHERE username = :current_username';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':current_username', $_SESSION['username'], PDO::PARAM_STR);
            $stmt->bindParam(':new_address', $_POST['address'], PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $_SESSION['address'] = $_POST['address']; // Actualizar sesión
                echo "La dirección se ha actualizado correctamente.<br>";
            } else {
                echo "No se realizaron cambios en la dirección.<br>";
            }
        }
    }

    ?>

    <div class="container">
        <h2>Perfil</h2>
        <form method="POST" action="perfil.php">
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" placeholder="<?php echo $_SESSION['username']; ?>" ><br>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder=" <?php echo $_SESSION['mail']; ?>" ><br>
            </div>

            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" id="address" name="address" placeholder="<?php echo $_SESSION['address']; ?>" ><br>
            </div>

            <div class="form-group">
                <button type="submit">Actualizar Perfil</button>
            </div>
        </form>

        <div class="link-container">
            <p><a href="panel.php">Volver al Panel</a></p>
        </div>
    </div>
</body>

</html>