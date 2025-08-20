<?php

require_once 'app/controller/DatabaseController.php';

$controller = new DatabaseController();
$availability = $controller->checkDatabaseAvailability();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pemeriksaan Basis Data</title>
</head>
<body>
    <h1>Pemeriksaan Basis Data</h1>
    
    <h3>Ketersediaan Basis Data:</h3>
    <ul>
        <?php foreach ($availability as $db => $isAvailable) : ?>
            <li><?= $db ?>: <?= $isAvailable ? 'Tersedia' : 'Tidak Tersedia' ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>