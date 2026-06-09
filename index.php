<?php.
$db = new PDO('sqlite:eredivisie.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$clubNaam = 'Telstar';
$stmt = $db->prepare("SELECT clubid FROM clubs WHERE naam = ?");
$stmt->execute([$clubNaam]);
$clubId = $stmt->fetchColumn();

// Laatste uitslag
$stmt = $db->prepare("
    SELECT w.*, thuis.naam AS thuisnaam, uit.naam AS uitnaam
    FROM wedstrijden w
    JOIN clubs thuis ON thuis.clubid = w.thuisclub
    JOIN clubs uit ON uit.clubid = w.uitclub
    WHERE w.thuisclub = :clubid OR w.uitclub = :clubid
    ORDER BY w.yyyy DESC, w.mm DESC, w.dd DESC
    LIMIT 1
");
$stmt->execute(['clubid' => $clubId]);
$laatste = $stmt->fetch(PDO::FETCH_ASSOC);

// Seizoen stats Telstar
$stmt = $db->prepare("
    SELECT
        COUNT(*) as gespeeld,
        SUM(CASE WHEN (thuisclub = :id AND thuisscore > uitscore) OR (uitclub = :id AND uitscore > thuisscore) THEN 1 ELSE 0 END) as gewonnen,
        SUM(CASE WHEN thuisscore = uitscore THEN 1 ELSE 0 END) as gelijk,
        SUM(CASE WHEN (thuisclub = :id AND thuisscore < uitscore) OR (uitclub = :id AND uitscore < thuisscore) THEN 1 ELSE 0 END) as verloren
    FROM wedstrijden
    WHERE (thuisclub = :id OR uitclub = :id) AND seizoen = 66
");
$stmt->execute(['id' => $clubId]);
$stats = $stmt->fetch(PDO::FETCH_ASSOC);

// Stand seizoen 77/78 (hard-coded uit screenshot)
$stand = [
    ['pos'=>1,  'club'=>'PSV',              'ge'=>34,'wi'=>21,'gl'=>11,'ve'=>2, 'pt'=>53, 'logo'=>'https://upload.wikimedia.org/wikipedia/sco/thumb/0/05/PSV_Eindhoven.svg/1280px-PSV_Eindhoven.svg.png'],
    ['pos'=>2,  'club'=>'Ajax',             'ge'=>34,'wi'=>20,'gl'=>9, 've'=>5, 'pt'=>49, 'logo'=>'https://upload.wikimedia.org/wikipedia/sco/thumb/7/79/Ajax_Amsterdam.svg/3840px-Ajax_Amsterdam.svg.png'],
    ['pos'=>3,  'club'=>"AZ '67",           'ge'=>34,'wi'=>19,'gl'=>9, 've'=>6, 'pt'=>47, 'logo'=>'https://images.seeklogo.com/logo-png/27/1/az-67-alkmaar-logo-png_seeklogo-275285.png'],
    ['pos'=>4,  'club'=>'FC Twente',        'ge'=>34,'wi'=>18,'gl'=>9, 've'=>7, 'pt'=>45, 'logo'=>'https://cdn.worldvectorlogo.com/logos/fc-twente.svg'],
    ['pos'=>5,  'club'=>'Sparta',           'ge'=>34,'wi'=>14,'gl'=>12,'ve'=>8, 'pt'=>40, 'logo'=>'https://cdn-icons-png.flaticon.com/512/53/53283.png'],
    ['pos'=>6,  'club'=>'Roda JC',          'ge'=>34,'wi'=>12,'gl'=>12,'ve'=>10,'pt'=>36, 'logo'=>'https://images.seeklogo.com/logo-png/53/2/roda-jc-kerkrade-logo-png_seeklogo-536640.png'],
    ['pos'=>7,  'club'=>'FC Volendam',      'ge'=>34,'wi'=>13,'gl'=>8, 've'=>13,'pt'=>34, 'logo'=>'https://upload.wikimedia.org/wikipedia/en/thumb/0/0e/FC_Volendam_logo.svg/1280px-FC_Volendam_logo.svg.png'],
    ['pos'=>8,  'club'=>'FC Utrecht',       'ge'=>34,'wi'=>11,'gl'=>11,'ve'=>12,'pt'=>33, 'logo'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Logo_FC_Utrecht.svg/1920px-Logo_FC_Utrecht.svg.png'],
    ['pos'=>9,  'club'=>'Vitesse',          'ge'=>34,'wi'=>10,'gl'=>13,'ve'=>11,'pt'=>33, 'logo'=>'https://cdn.worldvectorlogo.com/logos/vitesse-2.svg'],
    ['pos'=>10, 'club'=>'Feyenoord',        'ge'=>34,'wi'=>10,'gl'=>12,'ve'=>12,'pt'=>32, 'logo'=>'https://upload.wikimedia.org/wikipedia/sco/thumb/e/e3/Feyenoord_logo.svg/1280px-Feyenoord_logo.svg.png'],
    ['pos'=>11, 'club'=>'NAC',              'ge'=>34,'wi'=>10,'gl'=>11,'ve'=>13,'pt'=>31, 'logo'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Logo_NAC_Breda.svg/960px-Logo_NAC_Breda.svg.png'],
    ['pos'=>12, 'club'=>'FC Den Haag',      'ge'=>34,'wi'=>11,'gl'=>6, 've'=>17,'pt'=>28, 'logo'=>'https://upload.wikimedia.org/wikipedia/de/1/17/FC_Den_Haag.svg'],
    ['pos'=>13, 'club'=>'Haarlem',          'ge'=>34,'wi'=>8, 'gl'=>12,'ve'=>14,'pt'=>28, 'logo'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/FC_Haarlem_%28logo%29.svg/500px-FC_Haarlem_%28logo%29.svg.png'],
    ['pos'=>14, 'club'=>'FC VVV',           'ge'=>34,'wi'=>9, 'gl'=>10,'ve'=>15,'pt'=>28, 'logo'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT31n8N3aUX7o1424SvlHGIcmuTehtS22f2yQ&s'],
    ['pos'=>15, 'club'=>'NEC',              'ge'=>34,'wi'=>10,'gl'=>8, 've'=>16,'pt'=>28, 'logo'=>'https://images.seeklogo.com/logo-png/9/1/nec-nijmegen-logo-png_seeklogo-97892.png'],
    ['pos'=>16, 'club'=>'Go Ahead Eagles',  'ge'=>34,'wi'=>11,'gl'=>5, 've'=>18,'pt'=>27, 'logo'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Go_Ahead_Eagles_logo.svg/330px-Go_Ahead_Eagles_logo.svg.png'],
    ['pos'=>17, 'club'=>'FC Amsterdam',     'ge'=>34,'wi'=>9, 'gl'=>8, 've'=>17,'pt'=>26, 'logo'=>'https://iconape.com/wp-content/files/jy/313949/png/313949.png'],
    ['pos'=>18, 'club'=>'Telstar',          'ge'=>34,'wi'=>3, 'gl'=>8, 've'=>23,'pt'=>14, 'logo'=>'https://images.seeklogo.com/logo-png/29/2/sc-telstar-logo-png_seeklogo-294997.png'],
];

function getLogo($club) {
    $logos = [
        'Telstar'         => 'https://images.seeklogo.com/logo-png/29/2/sc-telstar-logo-png_seeklogo-294997.png',
        'Ajax'            => 'https://upload.wikimedia.org/wikipedia/sco/thumb/7/79/Ajax_Amsterdam.svg/3840px-Ajax_Amsterdam.svg.png',
        'PSV'             => 'https://upload.wikimedia.org/wikipedia/sco/thumb/0/05/PSV_Eindhoven.svg/1280px-PSV_Eindhoven.svg.png',
        'Feyenoord'       => 'https://upload.wikimedia.org/wikipedia/sco/thumb/e/e3/Feyenoord_logo.svg/1280px-Feyenoord_logo.svg.png',
        'Go Ahead Eagles' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Go_Ahead_Eagles_logo.svg/330px-Go_Ahead_Eagles_logo.svg.png',
        'FC Volendam'     => 'https://upload.wikimedia.org/wikipedia/en/thumb/0/0e/FC_Volendam_logo.svg/1280px-FC_Volendam_logo.svg.png',
    ];
    return $logos[$club] ?? 'https://cdn-icons-png.flaticon.com/512/53/53283.png';
}

// Spelers preview
$tm = 'https://img.a.transfermarkt.technology/portrait/medium/';
$uitgelicht = [
    ['nr'=>6,  'naam'=>'Danny Bakker',    'pos'=>'Aanvoerder', 'foto'=>$tm.'250440-1768294965.JPG?lm=1'],
    ['nr'=>30, 'naam'=>'Kay Tejan',        'pos'=>'Aanvaller',  'foto'=>'https://images.fotmob.com/image_resources/playerimages/919739.png'],
    ['nr'=>17, 'naam'=>'Nils Rossen',     'pos'=>'Middenvelder','foto'=>$tm.'694039-1768295313.JPG?lm=1'],
];
?><!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Telstar - Officiële Website</title>
        <meta charset="utf-8">
        <meta name="author" content="Telstar Webteam">
        <meta name="keywords" content="telstar, voetbal, IJmuiden, eredivisie">
        <meta name="description" content="De officiële website van voetbalclub Telstar uit IJmuiden">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <button class="menu-knop" onclick="toggleNav()" aria-label="Menu">&#9776;</button>
            <a href="index.php" class="logo-wrapper">
                <img src="https://images.seeklogo.com/logo-png/29/2/sc-telstar-logo-png_seeklogo-294997.png" alt="Telstar logo" class="logo-img">
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
                <img src="https://images.seeklogo.com/logo-png/29/2/sc-telstar-logo-png_seeklogo-294997.png" alt="Telstar logo">
                <div class="sidenav-clubnaam">Telstar<span>IJmuiden &middot; 1963</span></div>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php" class="actief">&#127968; Home</a></li>
                    <li><a href="mannen.php">&#128085; Mannen</a></li>
                    <li><a href="resultaten.php">&#9917; Resultaten</a></li>
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
            <!-- HERO -->
            <section class="hero">
                <div class="hero-welkom">
                    <img src="https://images.seeklogo.com/logo-png/29/2/sc-telstar-logo-png_seeklogo-294997.png" alt="Telstar logo" class="hero-logo">
                    <h1>Welkom bij<br>Telstar</h1>
                    <p>De Witte Leeuwen van IJmuiden &mdash; opgericht 1963</p>
                    <div class="hero-knoppen">
                        <a href="mannen.php" class="knop">&#128085; Selectie</a>
                        <a href="resultaten.php" class="knop knop-outline">&#9917; Resultaten</a>
                        <a href="webshop.php" class="knop knop-goud">&#128722; Webshop</a>
                    </div>
                </div>
                <?php if($laatste): ?>
                <div class="score-widget">
                    <h3>Laatste uitslag</h3>
                    <div class="score-widget-teams">
                        <div class="score-widget-club">
                            <img src="<?=getLogo($laatste['thuisnaam'])?>" alt="<?=$laatste['thuisnaam']?>">
                            <span><?=$laatste['thuisnaam']?></span>
                        </div>
                        <div class="score-groot"><?=$laatste['thuisscore']?> - <?=$laatste['uitscore']?></div>
                        <div class="score-widget-club">
                            <img src="<?=getLogo($laatste['uitnaam'])?>" alt="<?=$laatste['uitnaam']?>">
                            <span><?=$laatste['uitnaam']?></span>
                        </div>
                    </div>
                    <div class="score-datum"><?=sprintf('%02d-%02d-%04d', $laatste['dd'], $laatste['mm'], $laatste['yyyy'])?></div>
                </div>
                <?php endif; ?>
                <div class="hero-info-widget">
                    <h3>&#127942; Telstar in cijfers</h3>
                    <ul class="hero-feiten">
                        <li><span class="feit-label">Stadion</span><span class="feit-waarde">Boogerd Sport</span></li>
                        <li><span class="feit-label">Capaciteit</span><span class="feit-waarde">6.000</span></li>
                        <li><span class="feit-label">Opgericht</span><span class="feit-waarde">1963</span></li>
                        <li><span class="feit-label">Bijnaam</span><span class="feit-waarde">Witte Leeuwen</span></li>
                        <li><span class="feit-label">Stad</span><span class="feit-waarde">IJmuiden</span></li>
                    </ul>
                    <a href="declub.php" class="knop knop-outline knop-blok">Meer over de club</a>
                </div>
            </section>

            <!-- STATS BALK -->
            <section class="stats-balk">
                <div class="stat">
                    <span class="stat-nummer"><?=$stats['gespeeld']?></span>
                    <span class="stat-label">Gespeeld</span>
                </div>
                <div class="stat">
                    <span class="stat-nummer"><?=$stats['gewonnen']?></span>
                    <span class="stat-label">Gewonnen</span>
                </div>
                <div class="stat">
                    <span class="stat-nummer"><?=$stats['gelijk']?></span>
                    <span class="stat-label">Gelijk</span>
                </div>
                <div class="stat">
                    <span class="stat-nummer"><?=$stats['verloren']?></span>
                    <span class="stat-label">Verloren</span>
                </div>
                <div class="stat">
                    <span class="stat-nummer"><?=$stats['gewonnen']*3 + $stats['gelijk']?></span>
                    <span class="stat-label">Punten</span>
                </div>
            </section>

            <!-- HOME GRID: STAND + SPELERS -->
            <section class="home-grid">

                <!-- STAND -->
                <article class="home-blok">
                    <h2 class="sectie-titel">&#127942; Eindstand Eredivisie 77/78</h2>
                    <table class="stand-tabel">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Club</th>
                                <th>Ge</th>
                                <th>Wi</th>
                                <th>Gl</th>
                                <th>Ve</th>
                                <th>Pt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($stand as $rij):
                                $klasse = ($rij['club'] === 'Telstar') ? 'telstar-rij' : '';
                            ?>
                            <tr class="<?=$klasse?>">
                                <td><?=$rij['pos']?></td>
                                <td class="stand-club">
                                    <img src="<?=$rij['logo']?>" alt="<?=$rij['club']?>">
                                    <?=$rij['club']?>
                                </td>
                                <td><?=$rij['ge']?></td>
                                <td><?=$rij['wi']?></td>
                                <td><?=$rij['gl']?></td>
                                <td><?=$rij['ve']?></td>
                                <td><strong><?=$rij['pt']?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </article>

                <!-- UITGELICHTE SPELERS -->
                <div class="home-zijbalk">
                    <article class="home-blok">
                        <h2 class="sectie-titel">&#128085; Uitgelichte spelers</h2>
                        <div class="home-spelers">
                            <?php foreach($uitgelicht as $s): ?>
                            <a href="mannen.php" class="home-speler">
                                <img src="<?=$s['foto']?>" alt="<?=$s['naam']?>" onerror="this.src='https://img.a.transfermarkt.technology/portrait/medium/default.jpg'">
                                <div class="home-speler-info">
                                    <span class="home-speler-nr"><?=$s['nr']?></span>
                                    <div>
                                        <div class="home-speler-naam"><?=$s['naam']?></div>
                                        <div class="home-speler-pos"><?=$s['pos']?></div>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; ?>
                            <a href="mannen.php" class="knop knop-midden">Bekijk alle spelers</a>
                        </div>
                    </article>

                    <!-- SHOP PREVIEW -->
                    <article class="home-blok">
                        <h2 class="sectie-titel">&#128722; Webshop</h2>
                        <div class="home-shop-preview">
                            <a href="webshop.php" class="home-shop-item">
                                <img src="img/thuisshirt.jpeg" alt="Thuisshirt">
                                <span>Thuisshirt 25/26</span>
                                <span class="home-shop-prijs">&euro;69,95</span>
                            </a>
                            <a href="webshop.php" class="home-shop-item">
                                <img src="img/uitshirt.jpeg" alt="Uitshirt">
                                <span>Uitshirt 25/26</span>
                                <span class="home-shop-prijs">&euro;69,95</span>
                            </a>
                            <a href="webshop.php" class="home-shop-item">
                                <img src="img/derdeshirt.jpeg" alt="Derde shirt">
                                <span>Derde shirt 25/26</span>
                                <span class="home-shop-prijs">&euro;69,95</span>
                            </a>
                        </div>
                        <a href="webshop.php" class="knop knop-blok">Naar de webshop</a>
                    </article>
                </div>

            </section>
        </main>

        <footer>
            <p>&copy; 2025 Telstar IJmuiden &nbsp;|&nbsp; Polderweg 1, IJmuiden</p>
        </footer>
    </body>
</html>