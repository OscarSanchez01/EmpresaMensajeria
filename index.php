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
    
        <p class="p">¿No tienes una cuenta? <span class="span">Registrate</span></p>
    </form>

</body>

</html>