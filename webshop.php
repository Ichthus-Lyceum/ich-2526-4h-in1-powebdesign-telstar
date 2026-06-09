<?php include('db/connect.php'); ?><!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Webshop - Telstar</title>
        <meta charset="utf-8">
        <meta name="author" content="Telstar Webteam">
        <meta name="keywords" content="telstar, webshop, shirt, kleding, merchandise, tickets">
        <meta name="description" content="De officiële fanshop van Telstar IJmuiden">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <button class="menu-knop" onclick="toggleNav()" aria-label="Menu">&#9776;</button>
            <a href="index.php" class="logo-wrapper">
                <img src="https://images.seeklogo.com/logo-png/29/2/sc-telstar-logo-png_seeklogo-294997.png" alt="Telstar logo" class="logo-img">
                <div class="clubnaam">Telstar<small>IJmuiden &middot; 1963</small></div>
            </a>
            <div class="header-rechts">
                <div class="zoekbalk">
                    <form action="zoeken.php" method="get">
                        <input type="text" name="q" placeholder="Zoeken...">
                        <button type="submit">&#128269;</button>
                    </form>
                </div>
                <button class="winkelwagen-knop" onclick="toggleWinkelwagen()" aria-label="Winkelwagen">
                    &#128722;
                    <span class="ww-aantal" id="ww-aantal">0</span>
                </button>
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
                    <li><a href="index.php">&#127968; Home</a></li>
                    <li><a href="mannen.php">&#128085; Mannen</a></li>
                    <li><a href="resultaten.php">&#9917; Resultaten</a></li>
                    <li><a href="webshop.php" class="actief">&#128722; Webshop</a></li>
                    <li><a href="declub.php">&#127942; De Club</a></li>
                </ul>
            </nav>
        </div>
        <div class="overlay" id="overlay" onclick="toggleNav()"></div>

        <div class="ww-panel" id="ww-panel">
            <div class="ww-header">
                <h3>&#128722; Winkelwagen</h3>
                <button onclick="toggleWinkelwagen()">&times;</button>
            </div>
            <div class="ww-items" id="ww-items">
                <p class="ww-leeg">Je winkelwagen is leeg.</p>
            </div>
            <div class="ww-footer ww-footer-verborgen" id="ww-footer">
                <div class="ww-totaal">Totaal: <strong id="ww-totaal">&euro;0,00</strong></div>
                <a href="afrekenen.php" class="knop" onclick="slaWinkelwarenOp()">Afrekenen</a>
            </div>
        </div>
        <div class="overlay" id="ww-overlay" onclick="toggleWinkelwagen()"></div>

        <script>
        function toggleNav() {
            document.getElementById('sidenav').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('open');
        }
        var winkelwagen = [];
        function toggleWinkelwagen() {
            document.getElementById('ww-panel').classList.toggle('open');
            document.getElementById('ww-overlay').classList.toggle('open');
        }
        function voegToe(naam, prijs, img) {
            var bestaand = winkelwagen.find(function(i){ return i.naam === naam; });
            if(bestaand) { bestaand.aantal++; } else { winkelwagen.push({ naam: naam, prijs: prijs, img: img, aantal: 1 }); }
            updateWinkelwagen();
            toggleWinkelwagen();
        }
        function verwijder(naam) {
            winkelwagen = winkelwagen.filter(function(i){ return i.naam !== naam; });
            updateWinkelwagen();
        }
        function updateWinkelwagen() {
            var totaal = 0;
            var html = '';
            winkelwagen.forEach(function(item) {
                totaal += item.prijs * item.aantal;
                html += '<div class="ww-item">' +
                    (item.img ? '<img src="' + item.img + '" alt="' + item.naam + '">' : '<div class="ww-item-placeholder">&#128722;</div>') +
                    '<div class="ww-item-info"><span class="ww-item-naam">' + item.naam + '</span><span class="ww-item-prijs">&euro;' + item.prijs.toFixed(2).replace('.',',') + ' &times; ' + item.aantal + '</span></div>' +
                    '<button class="ww-verwijder" onclick="verwijder(\'' + item.naam.replace(/'/g,"\\'") + '\')">&times;</button></div>';
            });
            document.getElementById('ww-items').innerHTML = html || '<p class="ww-leeg">Je winkelwagen is leeg.</p>';
            document.getElementById('ww-aantal').textContent = winkelwagen.reduce(function(s,i){ return s+i.aantal; }, 0);
            document.getElementById('ww-totaal').innerHTML = '&euro;' + totaal.toFixed(2).replace('.',',');
            var footer = document.getElementById('ww-footer');
            if(winkelwagen.length) { footer.classList.remove('ww-footer-verborgen'); } else { footer.classList.add('ww-footer-verborgen'); }
        }
        function slaWinkelwarenOp() {
            try { sessionStorage.setItem('telstar_winkelwagen', JSON.stringify(winkelwagen)); } catch(e) {}
        }
        </script>

        <main>
            <section class="shop-hero">
                <div class="shop-hero-tekst">
                    <p class="shop-hero-sub">Officiële fanshop van</p>
                    <h1>TELSTAR</h1>
                    <p class="shop-hero-aanbieding">&#127381; 50% korting op alle wedstrijdkleding! Gebruik code: <strong>TELSTAR50</strong></p>
                    <a href="#producten" class="knop">Shop nu</a>
                </div>
            </section>

            <section class="shop-categorieen">
                <a href="#thuistenue" class="categorie-kaart"><div class="categorie-icoon">&#128085;</div><h3>Thuistenue</h3><p>Officiële thuiskleding</p></a>
                <a href="#uittenue" class="categorie-kaart"><div class="categorie-icoon">&#128084;</div><h3>Uittenue</h3><p>Officiële uitkleding</p></a>
                <a href="#derdetenue" class="categorie-kaart"><div class="categorie-icoon">&#127943;</div><h3>Derde tenue</h3><p>Officiële derde kleding</p></a>
                <a href="#fanitems" class="categorie-kaart"><div class="categorie-icoon">&#127881;</div><h3>Fan items</h3><p>Sjaals, vlaggen & meer</p></a>
            </section>

            <?php
            $shop = [
                'Thuistenue' => [
                    ['naam'=>'Telstar Thuisshirt 25/26',   'prijs'=>69.95, 'foto'=>'img/thuisshirt.jpeg',  'badge'=>'Nieuw'],
                    ['naam'=>'Telstar Thuisbroek 25/26',   'prijs'=>39.95, 'foto'=>'img/thuisbroek.jpeg'],
                    ['naam'=>'Telstar Thuissokken 25/26',  'prijs'=>14.95, 'foto'=>'img/sokkenthuis.jpeg'],
                ],
                'Uittenue' => [
                    ['naam'=>'Telstar Uitshirt 25/26',     'prijs'=>69.95, 'foto'=>'img/uitshirt.jpeg'],
                    ['naam'=>'Telstar Uitbroek 25/26',     'prijs'=>39.95, 'foto'=>'img/uitbroekje.jpeg'],
                    ['naam'=>'Telstar Uitsokken 25/26',    'prijs'=>14.95, 'foto'=>'img/uitsokken.jpeg'],
                ],
                'Derde tenue' => [
                    ['naam'=>'Telstar Derde Shirt 25/26',  'prijs'=>69.95, 'foto'=>'img/derdeshirt.jpeg'],
                    ['naam'=>'Telstar Derde Broek 25/26',  'prijs'=>39.95, 'foto'=>'img/derdebroekje.jpeg'],
                    ['naam'=>'Telstar Derde Sokken 25/26', 'prijs'=>14.95, 'foto'=>'img/derdesokken.jpeg'],
                ],
                'Fan items' => [
                    ['naam'=>'Telstar Retro Sjaal',  'prijs'=>14.95, 'foto'=>'https://telstar.robey-clubs.com/cdn/shop/files/TEL50027-100_Product_01_telstar-retro-sjaal.jpg?v=1780814094&width=5000'],
                    ['naam'=>'Telstar Vlag (groot)', 'prijs'=>19.95, 'foto'=>'https://telstar.robey-clubs.com/cdn/shop/files/TEL50025-100_Product_01_telstar-vlag-telstar.jpg?v=1780814093&width=5000'],
                    ['naam'=>'Telstar Vlag (klein)', 'prijs'=>19.95, 'foto'=>'https://telstar.robey-clubs.com/cdn/shop/files/TEL50026-100_Product_01_telstar-vlag-logo.jpg?v=1780814094&width=5000'],
                    ['naam'=>'Telstar Sluban Bus',   'prijs'=>34.95, 'foto'=>'https://telstar.robey-clubs.com/cdn/shop/files/TEL50024-900_Product_01_telstar-bus.jpg?v=1780814093&width=5000'],
                ],
            ];

            $anker = ['Thuistenue'=>'thuistenue','Uittenue'=>'uittenue','Derde tenue'=>'derdetenue','Fan items'=>'fanitems'];

            echo '<section class="producten-sectie" id="producten">';
            foreach($shop as $categorie => $producten) {
                echo '<h2 class="sectie-titel" id="' . $anker[$categorie] . '">' . $categorie . '</h2>';
                echo '<div class="producten-grid">';
                foreach($producten as $p) {
                    $badge = isset($p['badge']) ? '<div class="product-badge">' . $p['badge'] . '</div>' : '';
                    $uitverkocht = isset($p['uitverkocht']) && $p['uitverkocht'];
                    $prijs_fmt = number_format($p['prijs'], 2, ',', '.');
                    $foto = $p['foto'];
                    echo '
                    <article class="product-kaart">
                        ' . $badge . '
                        <div class="product-afbeelding">
                            <img src="' . $foto . '" alt="' . htmlspecialchars($p['naam']) . '">
                        </div>
                        <div class="product-info">
                            <h4>' . htmlspecialchars($p['naam']) . '</h4>
                            <div class="product-prijs">&euro;' . $prijs_fmt . '</div>
                            ' . ($uitverkocht
                                ? '<button class="knop-klein" disabled>Uitverkocht</button>'
                                : '<button class="knop-klein" onclick="voegToe(\'' . addslashes($p['naam']) . '\', ' . $p['prijs'] . ', \'' . addslashes($foto) . '\')">&#128722; In winkelwagen</button>'
                            ) . '
                        </div>
                    </article>';
                }
                echo '</div>';
            }
            echo '</section>';
            ?>

            <section class="shop-aanbieding-balk">
                <p>&#10003; Seizoenskaarthouders 10% korting &nbsp;&nbsp; &#10003; Gratis verzending vanaf &euro;99,95</p>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Telstar IJmuiden &nbsp;|&nbsp; Polderweg 1, IJmuiden</p>
        </footer>
    </body>
</html>