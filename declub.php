<?php include('db/connect.php'); ?><!DOCTYPE html>
<html lang="nl">
<head>
    <title>De Club - Telstar</title>
    <meta charset="utf-8">
    <meta name="author" content="Telstar Webteam">
    <meta name="keywords" content="telstar, club, over ons, contact, stadion">
    <meta name="description" content="Alles over voetbalclub Telstar uit IJmuiden">
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
                <li><a href="mannen.php">&#128085; Mannen</a></li>
                <li><a href="resultaten.php">&#9917; Resultaten</a></li>
                <li><a href="webshop.php">&#128722; Webshop</a></li>
                <li><a href="declub.php" class="actief">&#127942; De Club</a></li>
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
            <div><h1>De Club</h1><p>Over Telstar IJmuiden</p></div>
        </section>

        <section class="club-grid">
            <article class="info-blok"><h2>Over ons</h2><p>SC Telstar is een Nederlandse profvoetbalclub uit IJmuiden, opgericht in 1963. De club speelt in het Boogerd Sport Stadion en staat bekend als de Witte Leeuwen.</p></article>
            <article class="info-blok"><h2>Contact</h2><ul><li><strong>Adres:</strong> Polderweg 1, IJmuiden</li><li><strong>E-mail:</strong> info@telstar.nl</li><li><strong>Telefoon:</strong> 0255 - 51 23 45</li></ul></article>
            <article class="info-blok"><h2>Stadion</h2><ul><li><strong>Naam:</strong> Boogerd Sport Stadion</li><li><strong>Capaciteit:</strong> 6.000 toeschouwers</li><li><strong>Geopend:</strong> 1993</li></ul></article>
            <article class="info-blok"><h2>Bereikbaarheid</h2><ul><li><strong>Auto:</strong> Afrit IJmuiden via de A9</li><li><strong>Bus:</strong> Lijn 74 richting IJmuiden Centrum</li><li><strong>Trein:</strong> Station Beverwijk, daarna bus 74</li></ul></article>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Telstar IJmuiden &nbsp;|&nbsp; Polderweg 1, IJmuiden</p>
    </footer>
</body>
</html>