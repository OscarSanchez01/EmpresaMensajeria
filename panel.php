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
                <h1>Mensajería Albacete</h1>
            </div>
        </header>

        <div class="subcontainer">
            <aside class="aside">
                <div class="info">
                    <img src="./assets/profile/OIP.jpg" alt="Admin Icon" width="100px">
                    <div class="info_user">
                        <?php
                        echo "<p>¡Bienvenido, " . $_SESSION['username'] . "!</p> ";
                        ?>
                        <p class="role">Usuario</p>
                    </div>

                </div>

                <div class="info_select">
                    <ul>
                        <li><a href="#">Gestión de Pedidos</a></li>
                        <li><a href="./perfil.php">Perfil</a></li>
                        <li><a href="./logout.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </aside>

            <div class="content">
                <h2>Panel de Control del usuario</h2>
                <p>Desde aquí puedes gestionar todos tus paquetes de Toom Nook's Delivery.</p>

                <div class="stats-container">
                    <div class="stats-card">
                        <h3>Total Pedidos</h3>
                        <p>
                            <?php
                            conexionBD();
                            $stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE username = :username");
                            $stmt->bindParam(':username', $_SESSION['username']);
                            $stmt->execute();
                            $id_usuario = $stmt->fetch();
                            $id_usuario = $id_usuario['id_usuario'];

                            $stmt = $pdo->prepare("SELECT COUNT(*) as user_pedidos FROM envios WHERE id_usuario = :id_usuario");
                            $stmt->bindParam(':id_usuario', $id_usuario);
                            $stmt->execute();
                            $total_pedidos = $stmt->fetch();
                            echo $total_pedidos['user_pedidos'];
                            ?>
                        </p>
                    </div>
                </div>
                <table class="table table-striped table-bordered">
                    <tr class="table-header">
                        <th class="table-header-cell">ID Pedido</th>
                        <th class="table-header-cell">Cliente</th>
                        <th class="table-header-cell">Empresa</th>
                        <th class="table-header-cell">Estado</th>
                        <th class="table-header-cell">Fecha de Envio</th>
                    </tr>
                    <?php
                    conexionBD();
                    $stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE username = :username");
                    $stmt->bindParam(':username', $_SESSION['username']);
                    $stmt->execute();
                    $id_usuario = $stmt->fetch();
                    $id_usuario = $id_usuario['id_usuario'];

                    $stmt = $pdo->prepare("SELECT * FROM envios WHERE id_usuario = :id_usuario");
                    $stmt->bindParam(':id_usuario', $id_usuario);
                    $stmt->execute();
                    $envios = $stmt->fetchAll();
                    foreach ($envios as $envio) {
                        conexionBD();
                        $stmt = $pdo->prepare("SELECT username FROM usuarios WHERE id_usuario = ?");
                        $stmt->execute([$envio['id_usuario']]);
                        $nombre_cliente = $stmt->fetch();

                        $stmt = $pdo->prepare("SELECT nombre_empresa FROM empresas_reparto WHERE id_empresa = ?");
                        $stmt->execute([$envio['id_empresa']]);
                        $nombre_empresa = $stmt->fetch();

                        echo "<tr class='table-row'>";
                        echo "<td class='table-cell'>" . $envio['cod_seguimiento'] . "</td>";
                        echo "<td class='table-cell'>" . $nombre_cliente['username'] . "</td>";
                        echo "<td class='table-cell'>" . $nombre_empresa['nombre_empresa'] . "</td>";
                        echo "<td class='table-cell'>" . $envio['estado_envio'] . "</td>";
                        echo "<td class='table-cell'>" . $envio['fecha_envio'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    </div>
</body>

<style>
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .table-striped {
        background-color: #ecf0f1;
    }

    .table-striped tr:nth-child(even) {
        background-color: #f4f4f9;
    }

    .table-bordered {
        border: 1px solid #ddd;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ddd;
    }

    .table-header {
        background-color: #2c3e50;
        color: white;
    }

    .table-header-cell {
        padding: 10px;
        font-size: 1.1rem;
        font-weight: bold;
    }

    .table-row {
        padding: 10px;
    }

    .table-cell {
        padding: 10px;
        font-size: 1rem;
        color: #7f8c8d;
    }
</style>

</html>