<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Afrekenen - Telstar</title>
        <meta charset="utf-8">
        <meta name="author" content="Telstar Webteam">
        <meta name="keywords" content="telstar, afrekenen, betalen, winkelwagen">
        <meta name="description" content="Afrekenen bij Telstar webshop">
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
                    <li><a href="index.php">&#127968; Home</a></li>
                    <li><a href="mannen.php">&#128085; Mannen</a></li>
                    <li><a href="resultaten.php">&#9917; Resultaten</a></li>
                    <li><a href="webshop.php" class="actief">&#128722; Webshop</a></li>
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
                    <h1>Afrekenen</h1>
                    <p>Vul je gegevens in en rond je bestelling af</p>
                </div>
            </section>

            <section class="checkout-grid">

                <!-- LINKER KOLOM: FORMULIER -->
                <div class="checkout-formulier">

                    <div class="checkout-blok">
                        <h2>&#128100; Persoonlijke gegevens</h2>
                        <div class="form-rij-2">
                            <div class="form-veld">
                                <label>Voornaam</label>
                                <input type="text" placeholder="Jan">
                            </div>
                            <div class="form-veld">
                                <label>Achternaam</label>
                                <input type="text" placeholder="de Vries">
                            </div>
                        </div>
                        <div class="form-veld">
                            <label>E-mailadres</label>
                            <input type="email" placeholder="jan@voorbeeld.nl">
                        </div>
                        <div class="form-veld">
                            <label>Telefoonnummer</label>
                            <input type="tel" placeholder="+31 6 12345678">
                        </div>
                    </div>

                    <div class="checkout-blok">
                        <h2>&#128230; Bezorgadres</h2>
                        <div class="form-veld">
                            <label>Straat en huisnummer</label>
                            <input type="text" placeholder="Polderweg 1">
                        </div>
                        <div class="form-rij-2">
                            <div class="form-veld">
                                <label>Postcode</label>
                                <input type="text" placeholder="1971 AA">
                            </div>
                            <div class="form-veld">
                                <label>Stad</label>
                                <input type="text" placeholder="IJmuiden">
                            </div>
                        </div>
                        <div class="form-veld">
                            <label>Land</label>
                            <select>
                                <option>Nederland</option>
                                <option>Belgi&euml;</option>
                                <option>Duitsland</option>
                            </select>
                        </div>
                    </div>

                    <div class="checkout-blok">
                        <h2>&#128179; Betaalmethode</h2>
                        <div class="betaal-opties">
                            <label class="betaal-optie">
                                <input type="radio" name="betaal" value="ideal" checked>
                                <span class="betaal-label">
                                    <span class="betaal-icoon">&#127988;</span>
                                    iDEAL
                                </span>
                            </label>
                            <label class="betaal-optie">
                                <input type="radio" name="betaal" value="creditcard">
                                <span class="betaal-label">
                                    <span class="betaal-icoon">&#128179;</span>
                                    Creditcard
                                </span>
                            </label>
                            <label class="betaal-optie">
                                <input type="radio" name="betaal" value="paypal">
                                <span class="betaal-label">
                                    <span class="betaal-icoon">&#128184;</span>
                                    PayPal
                                </span>
                            </label>
                            <label class="betaal-optie">
                                <input type="radio" name="betaal" value="klarna">
                                <span class="betaal-label">
                                    <span class="betaal-icoon">&#128181;</span>
                                    Klarna
                                </span>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- RECHTER KOLOM: BESTELLING OVERZICHT -->
                <div class="checkout-overzicht">

                    <div class="checkout-blok">
                        <h2>&#128722; Jouw bestelling</h2>
                        <div id="co-items">
                            <p class="ww-leeg">Je winkelwagen is leeg. <a href="webshop.php">Terug naar de webshop</a></p>
                        </div>
                    </div>

                    <div class="checkout-blok korting-blok">
                        <h2>&#127381; Kortingscode</h2>
                        <div class="korting-invoer">
                            <input type="text" id="korting-input" placeholder="Bijv. TELSTAR50" maxlength="20">
                            <button onclick="pasKortingToe()" class="knop-klein">Toepassen</button>
                        </div>
                        <div id="korting-melding" class="korting-melding verborgen"></div>
                    </div>

                    <div class="checkout-blok checkout-totaal-blok">
                        <div class="co-totaal-rij">
                            <span>Subtotaal</span>
                            <span id="co-subtotaal">&euro;0,00</span>
                        </div>
                        <div class="co-totaal-rij korting-rij verborgen" id="co-korting-rij">
                            <span id="co-korting-label">Korting</span>
                            <span id="co-korting-bedrag" class="korting-bedrag">&minus;&euro;0,00</span>
                        </div>
                        <div class="co-totaal-rij">
                            <span>Verzendkosten</span>
                            <span id="co-verzend">Gratis</span>
                        </div>
                        <div class="co-totaal-rij totaal-finaal">
                            <span><strong>Totaal</strong></span>
                            <span id="co-totaal"><strong>&euro;0,00</strong></span>
                        </div>
                        <button class="knop checkout-knop" onclick="bevestigBestelling()">
                            &#9989; Bestelling bevestigen
                        </button>
                        <a href="webshop.php" class="checkout-terug">&#8592; Terug naar de webshop</a>
                    </div>

                </div>
            </section>

            <!-- BEVESTIGING POPUP -->
            <div class="bevestiging-overlay verborgen" id="bevestiging-overlay">
                <div class="bevestiging-popup">
                    <div class="bevestiging-icoon">&#9989;</div>
                    <h2>Bestelling geplaatst!</h2>
                    <p>Bedankt voor je bestelling bij Telstar. Je ontvangt een bevestiging per e-mail.</p>
                    <p class="bevestiging-sub">Ordernummer: <strong id="ordernummer"></strong></p>
                    <a href="index.php" class="knop knop-popup">&#127968; Terug naar home</a>
                </div>
            </div>
        </main>

        <footer>
            <p>&copy; 2025 Telstar IJmuiden &nbsp;|&nbsp; Polderweg 1, IJmuiden</p>
        </footer>

        <script>
        // Haal winkelwagen op uit sessionStorage (doorgegeven vanuit webshop)
        var winkelwagen = [];
        var kortingPercentage = 0;
        var kortingCode = '';

        try {
            var opgeslagen = sessionStorage.getItem('telstar_winkelwagen');
            if (opgeslagen) winkelwagen = JSON.parse(opgeslagen);
        } catch(e) {}

        function fmtPrijs(bedrag) {
            return '&euro;' + bedrag.toFixed(2).replace('.', ',');
        }

        function berekenSubtotaal() {
            return winkelwagen.reduce(function(s, i) { return s + i.prijs * i.aantal; }, 0);
        }

        function renderOverzicht() {
            var subtotaal = berekenSubtotaal();
            var korting = subtotaal * (kortingPercentage / 100);
            var totaal = subtotaal - korting;
            var gratis = totaal >= 99.95;

            var html = '';
            if (winkelwagen.length === 0) {
                html = '<p class="ww-leeg">Je winkelwagen is leeg. <a href="webshop.php">Terug naar de webshop</a></p>';
            } else {
                winkelwagen.forEach(function(item) {
                    html += '<div class="co-item">' +
                        (item.img ? '<img src="' + item.img + '" alt="' + item.naam + '">' : '<div class="co-item-placeholder">&#128722;</div>') +
                        '<div class="co-item-info">' +
                            '<span class="co-item-naam">' + item.naam + '</span>' +
                            '<span class="co-item-meta">' + fmtPrijs(item.prijs) + ' &times; ' + item.aantal + '</span>' +
                        '</div>' +
                        '<span class="co-item-totaal">' + fmtPrijs(item.prijs * item.aantal) + '</span>' +
                    '</div>';
                });
            }

            document.getElementById('co-items').innerHTML = html;
            document.getElementById('co-subtotaal').innerHTML = fmtPrijs(subtotaal);

            if (kortingPercentage > 0) {
                document.getElementById('co-korting-rij').classList.remove('verborgen');
                document.getElementById('co-korting-label').textContent = 'Korting (' + kortingCode + ' \u2212' + kortingPercentage + '%)';
                document.getElementById('co-korting-bedrag').innerHTML = '\u2212' + fmtPrijs(korting);
            } else {
                document.getElementById('co-korting-rij').classList.add('verborgen');
            }

            document.getElementById('co-verzend').textContent = gratis || totaal === 0 ? 'Gratis' : '\u20AC4,95';
            var verzend = (gratis || totaal === 0) ? 0 : (totaal > 0 ? 4.95 : 0);
            document.getElementById('co-totaal').innerHTML = '<strong>' + fmtPrijs(totaal + verzend) + '</strong>';
        }

        function pasKortingToe() {
            var code = document.getElementById('korting-input').value.trim().toUpperCase();
            var melding = document.getElementById('korting-melding');

            var codes = {
                'TELSTAR50': 50
            };

            if (codes[code] !== undefined) {
                kortingPercentage = codes[code];
                kortingCode = code;
                melding.classList.remove('verborgen');
                melding.className = 'korting-melding geldig';
                melding.innerHTML = '&#10003; Code <strong>' + code + '</strong> toegepast &mdash; ' + kortingPercentage + '% korting!';
            } else {
                kortingPercentage = 0;
                kortingCode = '';
                melding.classList.remove('verborgen');
                melding.className = 'korting-melding ongeldig';
                melding.innerHTML = '&#10007; Ongeldige kortingscode.';
            }
            renderOverzicht();
        }

        // Toepassen met Enter
        document.getElementById('korting-input').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') pasKortingToe();
        });

        function bevestigBestelling() {
            if (winkelwagen.length === 0) {
                alert('Je winkelwagen is leeg.');
                return;
            }
            var nr = 'TST-' + Math.floor(100000 + Math.random() * 900000);
            document.getElementById('ordernummer').textContent = nr;
            document.getElementById('bevestiging-overlay').classList.remove('verborgen');
            sessionStorage.removeItem('telstar_winkelwagen');
        }

        renderOverzicht();
        </script>

    </body>
</html>