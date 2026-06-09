<?php
// db/connect.php
try {
    // Maakt verbinding met de SQLite database in de hoofdmap
    $db = new PDO('sqlite:eredivisie.sqlite');
    // Zorg dat foutmeldingen van de database getoond worden tijdens het ontwikkelen
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Databaseverbinding mislukt: " . $e->getMessage();
    die();
}
?>