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
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="icon" href="./assets/favicon.png" type="image/x-icon" />
    <title>Toom Nook´s Delivery</title>
</head>

<body>
    <div class="container">
        <header class="header">
            <div class="logo">
                <h1>Mensajería Albacete
                </h1>
            </div>
        </header>

        <div class="subcontainer">
            <aside class="aside">
                <div class="info">
                    <img src="./assets/profile/admin.png" alt="Admin Icon" width="100px">
                    <div class="info_user">
                        <p>Bienvenido,

                            Paco</p>
                        <p class="role">Administrador</p>
                    </div>

                </div>

                <div class="info_select">
                    <ul>
                        <li><a href="./panel_admin.php">Panel de Control</a></li>
                        <li><a href="./gestion_pedidos.php">Gestión de Pedidos</a></li>
                        <li><a href="#">Usuarios</a>
                            <ul class="submenu">
                                <li><a href="#">Lista de Usuarios</a></li>
                                <li><a href="#">Añadir Nuevo Usuario</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Configuraciones</a></li>
                        <li><a href="./logout.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </aside>

            <div class="content">
                <h2>Panel de Control</h2>
                <p>Desde aquí puedes gestionar todos los aspectos de Toom Nook's Delivery.</p>

                <div class="stats-container">
                    <div class="stats-card">
                        <h3>Total Pedidos</h3>
                        <p><?php
                            conexionBD();
                            $stmt = $pdo->prepare("SELECT COUNT(*) as total_pedidos FROM envios");
                            $stmt->execute();
                            $total_pedidos = $stmt->fetch();
                            echo $total_pedidos['total_pedidos']; ?></p>
                    </div>
                    <div class="stats-card">
                        <h3>Usuarios Activos</h3>
                        <p><?php
                            conexionBD();
                            $stmt = $pdo->prepare("SELECT COUNT(*) as total_usuarios FROM usuarios");
                            $stmt->execute();
                            $total_usuarios = $stmt->fetch();
                            echo $total_usuarios['total_usuarios']; ?></p>
                    </div>
                    <div class="stats-card">
                        <h3>Empresas Disponibles</h3>
                        <p><?php
                            conexionBD();
                            $stmt = $pdo->prepare("SELECT COUNT(*) as total_empresas FROM empresas_reparto");
                            $stmt->execute();
                            $total_empresas = $stmt->fetch();
                            echo $total_empresas['total_empresas']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>