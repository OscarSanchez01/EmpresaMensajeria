<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="./assets/favicon.png" type="image/x-icon" />
    <title>Toom Nook´s Delivery</title>
</head>

<body>
    <div class="container">
    <header class="header">
        <div class="logo">

        </div>

    </header>

    <?php
    session_start();
    ?>

    <div class="subcontainer">
        <aside class="aside">
            <div class="info">
                <img src="./assets/icon.png" width="100px">
                <?php
               echo "<p>¡Bienvenido, " . $_SESSION['username'] . "!</p> ";
                ?>
                <button><a href="perfil.php">Editar Perfil</a></button>

            </div>

            <div class="info_select">
                 <ul>
                <li>hola</li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            </div>
           

        </aside> 
        
        <div class="content">
           
        </div>
    </div>

    

    

    </div>
</body>

</html>