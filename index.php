<?php
include('db/connect.php');
$aantalWedstrijden = $database->selectValue("SELECT COUNT(*) FROM wedstrijd");
$stand = $database->selectRows("SELECT club, gewonnen, gelijkgespeeld, verloren, doelpunten_voor, doelpunten_tegen FROM stand ORDER BY punten DESC LIMIT 6");
$programma = $database->selectRows("SELECT datum, thuisclub, uitclub FROM programma ORDER BY datum ASC LIMIT 4");
?><!DOCTYPE html>
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
            <button class="hamburger" onclick="toggleNav()" aria-label="Menu">&#9776;</button>
            <a href="index.php" class="logo-wrapper">
                <img src="img/logo.png" alt="Telstar logo" class="logo-img">
                <div class="clubnaam">Telstar<small>IJmuiden &middot; 1963</small></div>
            </a>
            <div class="zoekbalk">
                <form action="resultaten.php" method="get">
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
                    <?php foreach($programma as $wed) { ?>
                    <div class="programma-item">
                        <span class="datum"><?=$wed['datum']?></span>
                        <span><?=$wed['thuisclub']?> – <?=$wed['uitclub']?></span>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </main>

        <footer>
            <p>&copy; 2025 Telstar IJmuiden &nbsp;|&nbsp; Polderweg 1, IJmuiden</p>
        </footer>
    </body>
</html>