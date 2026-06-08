<?php require_once 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Telstar - Eindstand</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="header">
        <img src="/img/telstar.png" alt="Telstar">
        <div><h1>TELSTAR</h1><p>IJMUIDEN · 1963 | DE WITTE LEEUWEN</p></div>
    </div>
    
    <div class="nav">
        <a href="index.php">🏠 HOME</a>
        <a href="resultaten.php">⚽ RESULTATEN</a>
        <a href="stand.php" class="active">🏆 STAND</a>
        <a href="mannen.php">👨‍🦱 MANNEN</a>
        <a href="webshop.php">🛒 WEBSHOP</a>
    </div>
    
    <div class="card fullwidth">
        <h2>🏆 EINDSTAND EREDIVISIE 1977/1978</h2>
        <table>
            <thead>
                <tr><th>#</th><th>Club</th><th>GE</th><th>WI</th><th>GL</th><th>VE</th><th>PT</th></tr>
            </thead>
            <tbody>
            <?php foreach ($stand as $row): ?>
            <tr>
                <td><?= $row[0] ?></td>
                <td class="clubcell"><img src="<?= getLogo($row[1]) ?>"> <?= htmlspecialchars($row[1]) ?></td>
                <td><?= $row[2] ?></td><td><?= $row[3] ?></td><td><?= $row[4] ?></td><td><?= $row[5] ?></td>
                <td><strong><?= $row[6] ?></strong></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>