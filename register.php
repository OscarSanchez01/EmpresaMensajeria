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
    <!-- AQUI ESTA EL FORM -->
    <form class="form">
        
        
        <!-- NOMBRE -->
        <div class="flex-column">
            <label>Name </label>
        </div>
        <div class="inputForm">
            <i class="ri-user-5-fill"></i>

            <!-- INPUT NOMBRE -->
            <input type="text" class="input" placeholder="Nuevo usuario" />
        </div>


        <!-- EMAIL -->
        <div class="flex-column">
            <label>Email </label>
        </div>
        <div class="inputForm">
            <i class="ri-mail-fill"></i>
            <!-- INPUT EMAIL -->
            <input type="text" class="input" placeholder="Introduce tu email" />
        </div>


        <!-- DIRECCIÓN -->
        <div class="flex-column">
            <label>Dirección </label>
        </div>
        <div class="inputForm">
            <i class="ri-compass-3-fill"></i>
            <!-- INPUT DIRECCIÓN -->
            <input type="text" class="input" placeholder="Introduce tu Dirección" />
        </div>




        <!-- CONTRASEÑA -->
        <div class="flex-column">
            <label>Password </label>
        </div>
        <div class="inputForm">
            <i class="ri-lock-2-fill"></i>
            <!-- INPUT CONTRASEÑA -->
            <input type="password" class="input" placeholder="Introduce tu contraseña" />
        </div>

        <button class="button-submit">Sign Up</button>

        <p class="p">¿Tienes una cuenta? <a href="./index.html" class="span">Inicia sesion</a></p>

    </form>



</body>

</html>