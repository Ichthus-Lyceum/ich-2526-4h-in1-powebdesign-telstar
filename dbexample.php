<?php

$db = new PDO('sqlite:eredivisie.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$clubNaam = 'Telstar';

// Zoek Telstar ID
$stmt = $db->prepare("SELECT clubid FROM clubs WHERE naam = ?");
$stmt->execute([$clubNaam]);
$clubId = $stmt->fetchColumn();

$sql = "
SELECT
    w.*,
    thuis.naam AS thuisnaam,
    uit.naam AS uitnaam
FROM wedstrijden w
JOIN clubs thuis ON thuis.clubid = w.thuisclub
JOIN clubs uit   ON uit.clubid = w.uitclub
WHERE w.thuisclub = :clubid
   OR w.uitclub = :clubid
ORDER BY w.yyyy DESC, w.mm DESC, w.dd DESC
LIMIT 10
";

$stmt = $db->prepare($sql);
$stmt->execute(['clubid' => $clubId]);

$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);

function getLogo($club)
{
    $logos = [
        'Telstar' => 'https://upload.wikimedia.org/wikipedia/en/thumb/4/4d/SC_Telstar_logo.svg/1280px-SC_Telstar_logo.svg.png',
        'Ajax' => 'https://upload.wikimedia.org/wikipedia/en/7/79/Ajax_Amsterdam.svg',
        'PSV' => 'https://upload.wikimedia.org/wikipedia/en/e/e3/PSV_Eindhoven.svg',
        'Feyenoord' => 'https://upload.wikimedia.org/wikipedia/en/d/d3/Feyenoord_logo.svg',
        'AZ' => 'https://upload.wikimedia.org/wikipedia/en/e/e7/AZ_Alkmaar.svg',
        'AZ `67' => 'https://upload.wikimedia.org/wikipedia/en/e/e7/AZ_Alkmaar.svg',
        ];

    return $logos[$club]
        ?? 'https://cdn-icons-png.flaticon.com/512/53/53283.png';
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Laatste wedstrijden Telstar</title>

<style>
body{
    font-family:Inter,Arial,sans-serif;
    background:#f4f6f9;
    padding:40px;
}

.container{
    max-width:900px;
    margin:auto;
}

h1{
    margin-bottom:25px;
}

.match{
    background:white;
    border-radius:16px;
    padding:20px;
    margin-bottom:15px;
    box-shadow:0 4px 15px rgba(0,0,0,.08);
}

.date{
    color:#666;
    font-size:14px;
    margin-bottom:15px;
}

.teams{
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.team{
    width:35%;
    display:flex;
    align-items:center;
    gap:12px;
}

.team.away{
    justify-content:flex-end;
    text-align:right;
}

.team img{
    width:42px;
    height:42px;
    object-fit:contain;
}

.score{
    font-size:30px;
    font-weight:bold;
    color:#111827;
    min-width:120px;
    text-align:center;
}

.club{
    font-weight:600;
}
</style>

</head>
<body>

<div class="container">

<h1>Laatste wedstrijden van Telstar</h1>

<?php foreach($matches as $match): ?>

<div class="match">

    <div class="date">
        <?= sprintf(
            '%02d-%02d-%04d',
            $match['dd'],
            $match['mm'],
            $match['yyyy']
        ) ?>
    </div>

    <div class="teams">

        <div class="team">
            <img src="<?= getLogo($match['thuisnaam']) ?>">
            <div class="club">
                <?= htmlspecialchars($match['thuisnaam']) ?>
            </div>
        </div>

        <div class="score">
            <?= $match['thuisscore'] ?>
            -
            <?= $match['uitscore'] ?>
        </div>

        <div class="team away">
            <div class="club">
                <?= htmlspecialchars($match['uitnaam']) ?>
            </div>
            <img src="<?= getLogo($match['uitnaam']) ?>">
        </div>

    </div>

</div>

<?php endforeach; ?>

</div>

</body>
</html>