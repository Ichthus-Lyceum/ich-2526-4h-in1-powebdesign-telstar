<?php include('db/connect.php'); ?><!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Mannen - Telstar</title>
        <meta charset="utf-8">
        <meta name="author" content="Telstar Webteam">
        <meta name="keywords" content="telstar, selectie, spelers, mannen, eredivisie">
        <meta name="description" content="De officiële selectie van Telstar seizoen 2025/2026">
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
                    <li><a href="mannen.php" class="actief">&#128085; Mannen</a></li>
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
                    <h1>Mannen</h1>
                    <p>Officiële selectie seizoen 2025/2026 · Eredivisie</p>
                </div>
            </section>

            <?php
            $tm = 'https://img.a.transfermarkt.technology/portrait/medium/';

            $selectie = [
                'Keepers' => [
                    ['nr'=>1,  'naam'=>'Ronald Koeman Jr.',          'nat'=>'🇳🇱', 'foto'=>$tm.'271549-1768294767.JPG?lm=1'],
                    ['nr'=>13, 'naam'=>'Tyrick Bodak',               'nat'=>'🇳🇱', 'foto'=>$tm.'663961-1768295206.JPG?lm=1'],
                    ['nr'=>20, 'naam'=>'Daan Reiziger',              'nat'=>'🇳🇱', 'foto'=>$tm.'412946-1768295385.JPG?lm=1'],
                ],
                'Verdedigers' => [
                    ['nr'=>2,  'naam'=>'Jeff Hardeveld',             'nat'=>'🇳🇱', 'foto'=>$tm.'412946-1768295385.JPG?lm=1'],
                    ['nr'=>3,  'naam'=>'Gerald Alders',              'nat'=>'🇳🇦', 'foto'=>$tm.'891854-1738694528.jpg?lm=1'],
                    ['nr'=>4,  'naam'=>'Guus Offerhaus',             'nat'=>'🇳🇱', 'foto'=>$tm.'590777-1768294845.JPG?lm=1'],
                    ['nr'=>5,  'naam'=>'Nigel Ogidi Nwankwo',        'nat'=>'🇳🇱', 'foto'=>$tm.'399350-1768294928.JPG?lm=1'],
                    ['nr'=>6,  'naam'=>'Danny Bakker',               'nat'=>'🇳🇱', 'foto'=>$tm.'250440-1768294965.JPG?lm=1', 'captain'=>true],
                    ['nr'=>14, 'naam'=>'Neville Ogidi Nwankwo',      'nat'=>'🇳🇱', 'foto'=>$tm.'951398-1768294891.JPG?lm=1'],
                    ['nr'=>15, 'naam'=>'Adil Lechkar',               'nat'=>'🇳🇱', 'foto'=>$tm.'1006923-1768295243.JPG?lm=1'],
                    ['nr'=>21, 'naam'=>'Devon Koswal',               'nat'=>'🇸🇷', 'foto'=>$tm.'748604-1768295424.JPG?lm=1'],
                    ['nr'=>29, 'naam'=>'Dion Malone',                'nat'=>'🇸🇷', 'foto'=>$tm.'84405-1768295568.jpg?lm=1'],
                ],
                'Middenvelders' => [
                    ['nr'=>8,  'naam'=>'Tyrone Owusu',               'nat'=>'🇳🇱', 'foto'=>$tm.'461644-1768295043.JPG?lm=1'],
                    ['nr'=>16, 'naam'=>'Dylan Mertens',              'nat'=>'🇳🇱', 'foto'=>$tm.'322616-1768295277.jpg?lm=1'],
                    ['nr'=>17, 'naam'=>'Nils Rossen',                'nat'=>'🇳🇱', 'foto'=>$tm.'694039-1768295313.JPG?lm=1'],
                    ['nr'=>23, 'naam'=>'Cedric Hatenboer',           'nat'=>'🇧🇪', 'foto'=>$tm.'682568-1768295695.png?lm=1'],
                    ['nr'=>39, 'naam'=>'Jochem Ritmeester v/d Kamp', 'nat'=>'🇳🇱', 'foto'=>$tm.'865281-1768295609.JPG?lm=1'],
                ],
                'Aanvallers' => [
                    ['nr'=>7,  'naam'=>'Soufiane Hetli',             'nat'=>'🇳🇱', 'foto'=>$tm.'779752-1768295005.JPG?lm=1'],
                    ['nr'=>9,  'naam'=>'Jelani Seedorf',             'nat'=>'🇳🇱', 'foto'=>$tm.'1092384-1738073614.jpg?lm=1'],
                    ['nr'=>11, 'naam'=>'Tyrese Noslin',              'nat'=>'🇨🇼', 'foto'=>$tm.'708005-1768295165.JPG?lm=1'],
                    ['nr'=>19, 'naam'=>'Nökkvi Þeyr Þórisson',       'nat'=>'🇮🇸', 'foto'=>$tm.'381349-1753439100.jpg?lm=1'],
                    ['nr'=>27, 'naam'=>'Patrick Brouwer',            'nat'=>'🇳🇱', 'foto'=>$tm.'593824-1768295464.JPG?lm=1'],
                    ['nr'=>30, 'naam'=>'Kay Tejan',                  'nat'=>'🇳🇱', 'foto'=>$tm.'442885-1768295652.jpg?lm=1'],
                    ['nr'=>37, 'naam'=>'Sem van Duijn',              'nat'=>'🇳🇱', 'foto'=>$tm.'926491-1744829339.jpg?lm=1'],
                ],
            ];

            foreach($selectie as $positie => $spelers) {
                echo '<section class="selectie-sectie">';
                echo '<h2 class="positie-titel">' . $positie . '</h2>';
                echo '<div class="selectie-grid">';
                foreach($spelers as $s) {
                    $captain = isset($s['captain']) ? '<span class="captain-badge">C</span>' : '';
                    echo '
                    <article class="speler-kaart-foto">
                        <img class="speler-foto" src="' . $s['foto'] . '" alt="' . htmlspecialchars($s['naam']) . '" onerror="this.src=\'https://img.a.transfermarkt.technology/portrait/medium/default.jpg\'">
                        <div class="speler-rugnr">' . $s['nr'] . '</div>
                        <div class="speler-details">
                            <div class="speler-naam-groot">' . htmlspecialchars($s['naam']) . ' ' . $captain . '</div>
                            <div class="speler-meta">' . $s['nat'] . ' &nbsp; <span class="speler-pos">' . $positie . '</span></div>
                        </div>
                    </article>';
                }
                echo '</div></section>';
            }
            ?>
        </main>

        <footer>
            <p>&copy; 2025 Telstar IJmuiden &nbsp;|&nbsp; Polderweg 1, IJmuiden</p>
        </footer>
    </body>
</html>