<?php
$pdo = new PDO("sqlite:top2000.sqlite");    #opties: bibliotheek.db, eredivisie.sqlite, fastfood.s3db, top2000.sqlite
$result = $pdo->query("SELECT duur, taal FROM song LIMIT 10");
$items = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <title>DB Examples</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Items</h1>

    <?php foreach ($items as $song): ?>
    <p><?=$song['duur']?><br><?=$song['taal']?></p>
    <?php endforeach; ?>
                                 
</body>
</html>
