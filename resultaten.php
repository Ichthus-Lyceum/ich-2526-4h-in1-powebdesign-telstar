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
ORDER BY w.yyyy ASC, w.mm DESC, w.dd DESC
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
        'PSV' => 'https://upload.wikimedia.org/wikipedia/sco/thumb/0/05/PSV_Eindhoven.svg/1280px-PSV_Eindhoven.svg.png',
        'Feijenoord' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Feyenoord_logo_since_2024.svg/1280px-Feyenoord_logo_since_2024.svg.png',
        'AZ' => 'https://upload.wikimedia.org/wikipedia/en/e/e7/AZ_Alkmaar.svg',
        'AZ `67' => 'https://upload.wikimedia.org/wikipedia/en/e/e7/AZ_Alkmaar.svg',
        'Sittardia' => 'https://iconape.com/wp-content/png_logo_vector/rksv-sittardia-sittard-logo.png',
        'GVAV' => 'https://iconape.com/wp-content/files/vn/305979/png/305979.png',
        'Heracles' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVN52DD0Atpo1meQtKsPcBzTkr-bMLKvdExg&s',
        'Fortuna `54' => 'https://iconape.com/wp-content/png_logo_vector/fortuna-54-geleen-logo-2.png',
        'Go Ahead' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Go_Ahead_Eagles_logo.svg/330px-Go_Ahead_Eagles_logo.svg.png?_=20220713225430',
        'SC Enschede' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwWVbSM-jNX31OZVqdifGm9USq8tQuvcpTgw&s',
        ];


    return $logos[$club]
        ?? 'https://cdn-icons-png.flaticon.com/512/53/53283.png';
}

?>

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

<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Telstar - Officiële Website</title>
        <meta charset="utf-8">
        <meta name="author" content="Telstar Webteam">
        <meta name="keywords" content="telstar, voetbal, IJmuiden, eerste divisie">
        <meta name="description" content="De officiële website van voetbalclub Telstar uit IJmuiden">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <a href="index.php" class="logo-wrapper">
                <img src="img/logo.png" alt="Telstar logo" class="logo-img">
                <div class="clubnaam">Telstar<small>IJmuiden · 1963</small></div>
            </a>
            <div class="zoekbalk">
                <form action="resultaten.php" method="get">
                    <input type="text" name="q" placeholder="Zoeken...">
                    <button type="submit">&#128269;</button>
                </form>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php" class="actief">Home</a></li>
                    <li><a href="mannen.php">Mannen</a></li>
                    <li><a href="resultaten.php">Resultaten</a></li>
                    <li><a href="webshop.php">Webshop</a></li>
                    <li><a href="declub.php">De Club</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <section class="hero">
                <div class="hero-welkom">
                    <h1>Welkom bij<br>Telstar</h1>
                    <p>De Witte Leeuwen van IJmuiden</p>
                </div>

                <div class="score-widget">
                    <h3>Laatste uitslag</h3>
                    <div class="score-groot">7 - 0</div>
                    <div class="score-teams">Telstar &nbsp;vs&nbsp; Jong AZ</div>
                </div>

                <div class="stand-widget">
                    <h3>Stand</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Club</th>
                                <th>G</th>
                                <th>W</th>
                                <th>V</th>
                                <th>Ptn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($stand as $rij) {
                                $punten = ($rij['gewonnen'] * 3) + $rij['gelijkgespeeld'];
                                $klasse = (strtolower($rij['club']) == 'telstar') ? 'telstar-rij' : '';
                            ?>
                            <tr class="<?=$klasse?>">
                                <td><?=$rij['club']?></td>
                                <td><?=$rij['gewonnen']?></td>
                                <td><?=$rij['gelijkgespeeld']?></td>
                                <td><?=$rij['verloren']?></td>
                                <td><?=$punten?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <div class="programma-balk">
                <span class="programma-label">Programma</span>
                <div class="programma-items">
                
                </div>
            </div>
                
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

        </main>

        <footer>
            <p>&copy; 2025 Telstar IJmuiden &nbsp;|&nbsp; Polderweg 1, IJmuiden</p>
        </footer>
    </body>
</html>