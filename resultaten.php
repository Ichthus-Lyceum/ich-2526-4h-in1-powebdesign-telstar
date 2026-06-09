<?php
$db = new PDO('sqlite:eredivisie.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$clubNaam = 'Telstar';
$stmt = $db->prepare("SELECT clubid FROM clubs WHERE naam = ?");
$stmt->execute([$clubNaam]);
$clubId = $stmt->fetchColumn();

$sql = "
SELECT w.*, thuis.naam AS thuisnaam, uit.naam AS uitnaam
FROM wedstrijden w
JOIN clubs thuis ON thuis.clubid = w.thuisclub
JOIN clubs uit ON uit.clubid = w.uitclub
WHERE w.thuisclub = :clubid OR w.uitclub = :clubid
ORDER BY w.yyyy DESC, w.mm DESC, w.dd DESC
LIMIT 10
";
$stmt = $db->prepare($sql);
$stmt->execute(['clubid' => $clubId]);
$wedstrijden = $stmt->fetchAll(PDO::FETCH_ASSOC);

function getLogo($club) {
    $logos = [
        'Telstar'         => 'img/logo.png',
        'Ajax'            => 'https://upload.wikimedia.org/wikipedia/sco/thumb/7/79/Ajax_Amsterdam.svg/3840px-Ajax_Amsterdam.svg.png',
        'PSV'             => 'https://upload.wikimedia.org/wikipedia/sco/thumb/0/05/PSV_Eindhoven.svg/1280px-PSV_Eindhoven.svg.png',
        'Feyenoord'       => 'https://upload.wikimedia.org/wikipedia/sco/thumb/e/e3/Feyenoord_logo.svg/1280px-Feyenoord_logo.svg.png',
        'AZ'              => 'https://images.seeklogo.com/logo-png/1/2/az-logo-png_seeklogo-14935.png',
        "AZ `67"          => 'https://images.seeklogo.com/logo-png/27/1/az-67-alkmaar-logo-png_seeklogo-275285.png',
        'FC Utrecht'      => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Logo_FC_Utrecht.svg/1920px-Logo_FC_Utrecht.svg.png',
        'FC Twente'       => 'https://cdn.worldvectorlogo.com/logos/fc-twente.svg',
        "FC Twente `65"   => 'https://images.seeklogo.com/logo-png/5/2/fc-twente-65-logo-png_seeklogo-53071.png',
        'Roda JC'         => 'https://images.seeklogo.com/logo-png/53/2/roda-jc-kerkrade-logo-png_seeklogo-536640.png',
        'NAC'             => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Logo_NAC_Breda.svg/960px-Logo_NAC_Breda.svg.png',
        'Vitesse'         => 'https://cdn.worldvectorlogo.com/logos/vitesse-2.svg',
        'Go Ahead Eagles' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Go_Ahead_Eagles_logo.svg/330px-Go_Ahead_Eagles_logo.svg.png',
        'FC Volendam'     => 'https://upload.wikimedia.org/wikipedia/en/thumb/0/0e/FC_Volendam_logo.svg/1280px-FC_Volendam_logo.svg.png',
    ];
    return $logos[$club] ?? 'https://cdn-icons-png.flaticon.com/512/53/53283.png';
}
?><!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Resultaten - Telstar</title>
        <meta charset="utf-8">
        <meta name="author" content="Telstar Webteam">
        <meta name="keywords" content="telstar, resultaten, uitslagen, wedstrijden">
        <meta name="description" content="Laatste wedstrijden van Telstar">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <button class="menu-knop" onclick="toggleNav()" aria-label="Menu">&#9776;</button>
            <a href="index.php" class="logo-wrapper">
                <img src="img/telstarlogo.png" alt="Telstar logo" class="logo-img">
                <div class="clubnaam">Telstar<small>IJmuiden &middot; 1963</small></div>
            </a>
            <div class="zoekbalk">
                <form action="zoeken.php" method="get">
                    <input type="text" name="q" placeholder="Zoeken...">
                    <button type="submit">&#128269;</button>
                </form>
            </div>
        </header>

        <div class="sidenav" id="sidenav">
            <button class="sidenav-sluit" onclick="toggleNav()" aria-label="Sluiten">&times;</button>
            <div class="sidenav-logo">
                <img src="img/logo.png" alt="Telstar logo">
                <div class="sidenav-clubnaam">Telstar<span>IJmuiden &middot; 1963</span></div>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">&#127968; Home</a></li>
                    <li><a href="mannen.php">&#128085; Mannen</a></li>
                    <li><a href="resultaten.php" class="actief">&#9917; Resultaten</a></li>
                    <li><a href="webshop.php">&#128722; Webshop</a></li>
                    <li><a href="declub.php">&#127942; De Club</a></li>
                </ul>
            </nav>
        </div>
        <div class="overlay" id="overlay" onclick="toggleNav()"></div>

        <script>
        function toggleNav() {
            document.getElementById('sidenav').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('open');
        }
        </script>

        <main>
            <section class="pagina-header">
                <div>
                    <h1>Resultaten</h1>
                    <p>Laatste 10 wedstrijden van Telstar</p>
                </div>
            </section>

            <section class="resultaten-lijst">
                <?php foreach($wedstrijden as $wed):
                    $isThuisploeg = ($wed['thuisnaam'] == 'Telstar');
                    $eigen = $isThuisploeg ? $wed['thuisscore'] : $wed['uitscore'];
                    $tegen = $isThuisploeg ? $wed['uitscore'] : $wed['thuisscore'];
                    if($eigen > $tegen) $uitslag = 'winst';
                    elseif($eigen == $tegen) $uitslag = 'gelijk';
                    else $uitslag = 'verlies';
                ?>
                <article class="wedstrijd-kaart <?=$uitslag?>">
                    <div class="wedstrijd-datum">
                        <span class="dag"><?=$wed['dag']?></span>
                        <span class="datum"><?=sprintf('%02d-%02d-%04d', $wed['dd'], $wed['mm'], $wed['yyyy'])?></span>
                    </div>
                    <div class="wedstrijd-teams">
                        <div class="team thuis <?=$isThuisploeg ? 'is-telstar' : ''?>">
                            <img src="<?=getLogo($wed['thuisnaam'])?>" alt="<?=htmlspecialchars($wed['thuisnaam'])?>">
                            <span><?=htmlspecialchars($wed['thuisnaam'])?></span>
                        </div>
                        <div class="wedstrijd-score">
                            <span class="score-getal"><?=$wed['thuisscore']?></span>
                            <span class="score-streep">-</span>
                            <span class="score-getal"><?=$wed['uitscore']?></span>
                        </div>
                        <div class="team uit <?=!$isThuisploeg ? 'is-telstar' : ''?>">
                            <span><?=htmlspecialchars($wed['uitnaam'])?></span>
                            <img src="<?=getLogo($wed['uitnaam'])?>" alt="<?=htmlspecialchars($wed['uitnaam'])?>">
                        </div>
                    </div>
                    <div class="wedstrijd-badge <?=$uitslag?>">
                        <?=($uitslag=='winst') ? 'W' : (($uitslag=='gelijk') ? 'G' : 'V')?>
                    </div>
                </article>
                <?php endforeach; ?>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Telstar IJmuiden &nbsp;|&nbsp; Polderweg 1, IJmuiden</p>
        </footer>
    </body>
</html>