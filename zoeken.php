<?php
$db = new PDO('sqlite:eredivisie.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

$club_resultaten = [];
$wedstrijd_resultaten = [];
$product_resultaten = [];
$speler_resultaten = [];

if($q !== '') {

    // Clubs zoeken
    $stmt = $db->prepare("SELECT naam, plaats, prov FROM clubs WHERE naam LIKE ? ORDER BY naam ASC LIMIT 10");
    $stmt->execute(['%' . $q . '%']);
    $club_resultaten = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Wedstrijden zoeken (op clubnaam)
    $stmt = $db->prepare("
        SELECT w.dd, w.mm, w.yyyy, w.dag, t.naam AS thuisnaam, u.naam AS uitnaam, w.thuisscore, w.uitscore
        FROM wedstrijden w
        JOIN clubs t ON t.clubid = w.thuisclub
        JOIN clubs u ON u.clubid = w.uitclub
        WHERE t.naam LIKE ? OR u.naam LIKE ?
        ORDER BY w.yyyy DESC, w.mm DESC, w.dd DESC
        LIMIT 8
    ");
    $stmt->execute(['%' . $q . '%', '%' . $q . '%']);
    $wedstrijd_resultaten = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Producten zoeken
    $producten = [
        ['naam'=>'Telstar Thuisshirt 25/26',   'prijs'=>69.95, 'foto'=>'img/thuisshirt.jpeg',   'cat'=>'Thuistenue'],
        ['naam'=>'Telstar Thuisbroek 25/26',   'prijs'=>39.95, 'foto'=>'img/thuisbroek.jpeg',   'cat'=>'Thuistenue'],
        ['naam'=>'Telstar Thuissokken 25/26',  'prijs'=>14.95, 'foto'=>'img/sokkenthuis.jpeg',  'cat'=>'Thuistenue'],
        ['naam'=>'Telstar Uitshirt 25/26',     'prijs'=>69.95, 'foto'=>'img/uitshirt.jpeg',     'cat'=>'Uittenue'],
        ['naam'=>'Telstar Uitbroek 25/26',     'prijs'=>39.95, 'foto'=>'img/uitbroekje.jpeg',   'cat'=>'Uittenue'],
        ['naam'=>'Telstar Uitsokken 25/26',    'prijs'=>14.95, 'foto'=>'img/uitsokken.jpeg',    'cat'=>'Uittenue'],
        ['naam'=>'Telstar Derde Shirt 25/26',  'prijs'=>69.95, 'foto'=>'img/derdeshirt.jpeg',   'cat'=>'Derde tenue'],
        ['naam'=>'Telstar Derde Broek 25/26',  'prijs'=>39.95, 'foto'=>'img/derdebroekje.jpeg', 'cat'=>'Derde tenue'],
        ['naam'=>'Telstar Derde Sokken 25/26', 'prijs'=>14.95, 'foto'=>'img/derdesokken.jpeg',  'cat'=>'Derde tenue'],
        ['naam'=>'Telstar Retro Sjaal',        'prijs'=>14.95, 'foto'=>'img/retrosjaal.jpeg',   'cat'=>'Fan items'],
        ['naam'=>'Telstar Vlag (groot)',        'prijs'=>19.95, 'foto'=>'img/telstarvlag.jpeg',  'cat'=>'Fan items'],
        ['naam'=>'Telstar Vlag (klein)',        'prijs'=>19.95, 'foto'=>'img/telstarvlag.jpeg',  'cat'=>'Fan items'],
        ['naam'=>'Telstar Sluban Bus',          'prijs'=>34.95, 'foto'=>'img/slubanbus.jpeg',    'cat'=>'Fan items'],
    ];
    foreach($producten as $p) {
        if(stripos($p['naam'], $q) !== false || stripos($p['cat'], $q) !== false) {
            $product_resultaten[] = $p;
        }
    }

    // Spelers zoeken
    $spelers = [
        ['nr'=>1,  'naam'=>'Ronald Koeman Jr.',          'pos'=>'Keeper'],
        ['nr'=>13, 'naam'=>'Tyrick Bodak',               'pos'=>'Keeper'],
        ['nr'=>20, 'naam'=>'Daan Reiziger',              'pos'=>'Keeper'],
        ['nr'=>2,  'naam'=>'Jeff Hardeveld',             'pos'=>'Verdediger'],
        ['nr'=>3,  'naam'=>'Gerald Alders',              'pos'=>'Verdediger'],
        ['nr'=>4,  'naam'=>'Guus Offerhaus',             'pos'=>'Verdediger'],
        ['nr'=>5,  'naam'=>'Nigel Ogidi Nwankwo',        'pos'=>'Verdediger'],
        ['nr'=>6,  'naam'=>'Danny Bakker',               'pos'=>'Verdediger'],
        ['nr'=>14, 'naam'=>'Neville Ogidi Nwankwo',      'pos'=>'Verdediger'],
        ['nr'=>15, 'naam'=>'Adil Lechkar',               'pos'=>'Verdediger'],
        ['nr'=>21, 'naam'=>'Devon Koswal',               'pos'=>'Verdediger'],
        ['nr'=>29, 'naam'=>'Dion Malone',                'pos'=>'Verdediger'],
        ['nr'=>8,  'naam'=>'Tyrone Owusu',               'pos'=>'Middenvelder'],
        ['nr'=>16, 'naam'=>'Dylan Mertens',              'pos'=>'Middenvelder'],
        ['nr'=>17, 'naam'=>'Nils Rossen',                'pos'=>'Middenvelder'],
        ['nr'=>23, 'naam'=>'Cedric Hatenboer',           'pos'=>'Middenvelder'],
        ['nr'=>39, 'naam'=>'Jochem Ritmeester v/d Kamp', 'pos'=>'Middenvelder'],
        ['nr'=>7,  'naam'=>'Soufiane Hetli',             'pos'=>'Aanvaller'],
        ['nr'=>9,  'naam'=>'Jelani Seedorf',             'pos'=>'Aanvaller'],
        ['nr'=>11, 'naam'=>'Tyrese Noslin',              'pos'=>'Aanvaller'],
        ['nr'=>19, 'naam'=>'Nökkvi Þeyr Þórisson',       'pos'=>'Aanvaller'],
        ['nr'=>27, 'naam'=>'Patrick Brouwer',            'pos'=>'Aanvaller'],
        ['nr'=>30, 'naam'=>'Kay Tejan',                  'pos'=>'Aanvaller'],
        ['nr'=>37, 'naam'=>'Sem van Duijn',              'pos'=>'Aanvaller'],
    ];
    foreach($spelers as $s) {
        if(stripos($s['naam'], $q) !== false || stripos($s['pos'], $q) !== false) {
            $speler_resultaten[] = $s;
        }
    }
}

$totaal = count($club_resultaten) + count($wedstrijd_resultaten) + count($product_resultaten) + count($speler_resultaten);
?><!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Zoeken<?= $q ? ' - ' . htmlspecialchars($q) : '' ?> - Telstar</title>
        <meta charset="utf-8">
        <meta name="author" content="Telstar Webteam">
        <meta name="keywords" content="telstar, zoeken, spelers, producten, clubs">
        <meta name="description" content="Zoek op de Telstar website">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <button class="menu-knop" onclick="toggleNav()" aria-label="Menu">&#9776;</button>
            <a href="index.php" class="logo-wrapper">
                <img src="img/logo.png" alt="Telstar logo" class="logo-img">
                <div class="clubnaam">Telstar<small>IJmuiden &middot; 1963</small></div>
            </a>
            <div class="zoekbalk">
                <form action="zoeken.php" method="get">
                    <input type="text" name="q" placeholder="Zoeken..." value="<?=htmlspecialchars($q)?>">
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
            <section class="pagina-header">
                <div>
                    <h1>Zoeken</h1>
                    <p><?= $q ? $totaal . ' resultaten voor &ldquo;' . htmlspecialchars($q) . '&rdquo;' : 'Zoek naar spelers, producten, clubs en wedstrijden' ?></p>
                </div>
            </section>

            <section class="zoek-sectie">
                <form class="zoek-groot" action="zoeken.php" method="get">
                    <input type="text" name="q" placeholder="Zoek naar spelers, producten, clubs..." value="<?=htmlspecialchars($q)?>" autofocus>
                    <button type="submit">&#128269; Zoeken</button>
                </form>

                <?php if($q === ''): ?>
                <p class="zoek-hint">Typ een zoekterm om te beginnen. Je kunt zoeken op spelersnaam, clubnaam, productnaam of positie.</p>

                <?php elseif($totaal === 0): ?>
                <div class="zoek-geen">
                    <p>Geen resultaten gevonden voor <strong><?=htmlspecialchars($q)?></strong>.</p>
                    <p>Probeer een andere zoekterm.</p>
                </div>

                <?php else: ?>

                    <?php if(!empty($speler_resultaten)): ?>
                    <div class="zoek-groep">
                        <h2 class="sectie-titel">&#128085; Spelers (<?=count($speler_resultaten)?>)</h2>
                        <div class="zoek-spelers-grid">
                            <?php foreach($speler_resultaten as $s): ?>
                            <a href="mannen.php" class="zoek-speler-kaart">
                                <div class="zoek-rugnr"><?=$s['nr']?></div>
                                <div>
                                    <div class="zoek-naam"><?=htmlspecialchars($s['naam'])?></div>
                                    <div class="zoek-sub"><?=$s['pos']?></div>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($product_resultaten)): ?>
                    <div class="zoek-groep">
                        <h2 class="sectie-titel">&#128722; Producten (<?=count($product_resultaten)?>)</h2>
                        <div class="zoek-producten-grid">
                            <?php foreach($product_resultaten as $p): ?>
                            <a href="webshop.php" class="zoek-product-kaart">
                                <img src="<?=$p['foto']?>" alt="<?=htmlspecialchars($p['naam'])?>">
                                <div class="zoek-product-info">
                                    <div class="zoek-naam"><?=htmlspecialchars($p['naam'])?></div>
                                    <div class="zoek-prijs">&euro;<?=number_format($p['prijs'],2,',','.')?></div>
                                    <div class="zoek-sub"><?=$p['cat']?></div>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($wedstrijd_resultaten)): ?>
                    <div class="zoek-groep">
                        <h2 class="sectie-titel">&#9917; Wedstrijden (<?=count($wedstrijd_resultaten)?>)</h2>
                        <div class="zoek-wedstrijden">
                            <?php foreach($wedstrijd_resultaten as $wed): ?>
                            <a href="resultaten.php" class="zoek-wedstrijd-kaart">
                                <span class="zoek-datum"><?=sprintf('%02d-%02d-%04d', $wed['dd'], $wed['mm'], $wed['yyyy'])?></span>
                                <span class="zoek-teams"><?=htmlspecialchars($wed['thuisnaam'])?> <strong><?=$wed['thuisscore']?> - <?=$wed['uitscore']?></strong> <?=htmlspecialchars($wed['uitnaam'])?></span>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($club_resultaten)): ?>
                    <div class="zoek-groep">
                        <h2 class="sectie-titel">&#127942; Clubs (<?=count($club_resultaten)?>)</h2>
                        <div class="zoek-clubs">
                            <?php foreach($club_resultaten as $club): ?>
                            <div class="zoek-club-kaart">
                                <div class="zoek-naam"><?=htmlspecialchars($club['naam'])?></div>
                                <div class="zoek-sub"><?=htmlspecialchars($club['plaats'])?>, <?=htmlspecialchars($club['prov'])?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                <?php endif; ?>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Telstar IJmuiden &nbsp;|&nbsp; Polderweg 1, IJmuiden</p>
        </footer>
    </body>
</html>