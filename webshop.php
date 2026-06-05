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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="mannen.php">Mannen</a></li>
                    <li><a href="resultaten.php">Resultaten</a></li>
                    <li><a href="webshop.php" class="actief">Webshop</a></li>
                    <li><a href="declub.php">De Club</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <section class="shop-hero">
                <div class="shop-hero-tekst">
                    <p class="shop-hero-sub">Officiële fanshop van</p>
                    <h1>TELSTAR</h1>
                    <p class="shop-hero-aanbieding">&#127381; 50% korting op alle wedstrijdkleding! Gebruik code: <strong>TELSTAR50</strong></p>
                    <a href="#wedstrijd" class="knop">Shop nu</a>
                </div>
            </section>

            <section class="shop-categorieen">
                <a href="#wedstrijd" class="categorie-kaart">
                    <div class="categorie-icoon">&#128085;</div>
                    <h3>Wedstrijd</h3>
                    <p>Officiële shirts & tenues</p>
                </a>
                <a href="#training" class="categorie-kaart">
                    <div class="categorie-icoon">&#127943;</div>
                    <h3>Training</h3>
                    <p>Trainingskleding & sportswear</p>
                </a>
                <a href="#fanitems" class="categorie-kaart">
                    <div class="categorie-icoon">&#127881;</div>
                    <h3>Fan items</h3>
                    <p>Sjaals, vlaggen & meer</p>
                </a>
                <a href="#tickets" class="categorie-kaart">
                    <div class="categorie-icoon">&#127915;</div>
                    <h3>Tickets</h3>
                    <p>Thuiswedstrijden Telstar</p>
                </a>
            </section>

            <section class="producten-sectie">

                <h2 class="sectie-titel" id="wedstrijd">Wedstrijd — Thuistenue</h2>
                <div class="producten-grid">
                    <article class="product-kaart">
                        <div class="product-badge">Nieuw</div>
                        <div class="product-afbeelding">
                            <img src="img/thuisshirt.jpeg" alt="Telstar Thuisshirt 25/26">
                        </div>
                        <div class="product-info">
                            <h4>Telstar Thuisshirt 25/26</h4>
                            <div class="product-prijs">&euro;69,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                    <article class="product-kaart">
                        <div class="product-afbeelding">
                            <img src="img/thuisbroek.jpeg" alt="Telstar Thuisbroek 25/26">
                        </div>
                        <div class="product-info">
                            <h4>Telstar Thuisbroek 25/26</h4>
                            <div class="product-prijs">&euro;39,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                    <article class="product-kaart">
                        <div class="product-afbeelding">
                            <img src="img/sokkenthuis.jpeg" alt="Telstar Thuissokken 25/26">
                        </div>
                        <div class="product-info">
                            <h4>Telstar Thuissokken 25/26</h4>
                            <div class="product-prijs">&euro;14,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                </div>

                <h2 class="sectie-titel">Wedstrijd — Uittenue</h2>
                <div class="producten-grid">
                    <article class="product-kaart">
                        <div class="product-afbeelding">
                            <img src="img/uitshirt.jpeg" alt="Telstar Uitshirt 25/26">
                        </div>
                        <div class="product-info">
                            <h4>Telstar Uitshirt 25/26</h4>
                            <div class="product-prijs">&euro;69,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                    <article class="product-kaart">
                        <div class="product-afbeelding">
                            <img src="img/uitbroekje.jpeg" alt="Telstar Uitbroek 25/26">
                        </div>
                        <div class="product-info">
                            <h4>Telstar Uitbroek 25/26</h4>
                            <div class="product-prijs">&euro;39,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                    <article class="product-kaart">
                        <div class="product-afbeelding">
                            <img src="img/uitsokken.jpeg" alt="Telstar Uitsokken 25/26">
                        </div>
                        <div class="product-info">
                            <h4>Telstar Uitsokken 25/26</h4>
                            <div class="product-prijs">&euro;14,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                </div>

                <h2 class="sectie-titel">Wedstrijd — Derde tenue</h2>
                <div class="producten-grid">
                    <article class="product-kaart">
                        <div class="product-afbeelding">
                            <img src="img/derdeshirt.jpeg" alt="Telstar Derde Shirt 25/26">
                        </div>
                        <div class="product-info">
                            <h4>Telstar Derde Shirt 25/26</h4>
                            <div class="product-prijs">&euro;69,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                    <article class="product-kaart">
                        <div class="product-afbeelding">
                            <img src="img/derdebroekje.jpeg" alt="Telstar Derde Broek 25/26">
                        </div>
                        <div class="product-info">
                            <h4>Telstar Derde Broek 25/26</h4>
                            <div class="product-prijs">&euro;39,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                    <article class="product-kaart">
                        <div class="product-afbeelding">
                            <img src="img/derdesokken.jpeg" alt="Telstar Derde Sokken 25/26">
                        </div>
                        <div class="product-info">
                            <h4>Telstar Derde Sokken 25/26</h4>
                            <div class="product-prijs">&euro;14,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                </div>

                <h2 class="sectie-titel" id="fanitems">Fan items</h2>
                <div class="producten-grid">
                    <article class="product-kaart">
                        <div class="product-afbeelding">&#127881;</div>
                        <div class="product-info">
                            <h4>Telstar Retro Sjaal</h4>
                            <div class="product-prijs">&euro;14,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                    <article class="product-kaart">
                        <div class="product-badge uitverkocht">Uitverkocht</div>
                        <div class="product-afbeelding">&#127988;</div>
                        <div class="product-info">
                            <h4>Telstar Vlag (groot)</h4>
                            <div class="product-prijs">&euro;19,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                    <article class="product-kaart">
                        <div class="product-afbeelding">&#127988;</div>
                        <div class="product-info">
                            <h4>Telstar Vlag (klein)</h4>
                            <div class="product-prijs">&euro;19,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                    <article class="product-kaart">
                        <div class="product-afbeelding">&#127914;</div>
                        <div class="product-info">
                            <h4>Telstar Sluban Bus</h4>
                            <div class="product-prijs">&euro;34,95</div>
                            <a href="#" class="knop-klein">Bekijk</a>
                        </div>
                    </article>
                </div>

                <h2 class="sectie-titel" id="tickets">Tickets</h2>
                <div class="tickets-grid">
                    <article class="ticket-kaart">
                        <div class="ticket-links">
                            <h4>Telstar - Jong AZ</h4>
                            <p class="ticket-datum">Zaterdag 14 juni 2025 · 20:00</p>
                            <p class="ticket-stadion">Boogerd Sport Stadion, IJmuiden</p>
                        </div>
                        <div class="ticket-rechts">
                            <div class="ticket-prijs">Vanaf &euro;12,50</div>
                            <a href="#" class="knop">Kopen</a>
                        </div>
                    </article>
                    <article class="ticket-kaart">
                        <div class="ticket-links">
                            <h4>Telstar - FC Volendam</h4>
                            <p class="ticket-datum">Vrijdag 21 juni 2025 · 20:00</p>
                            <p class="ticket-stadion">Boogerd Sport Stadion, IJmuiden</p>
                        </div>
                        <div class="ticket-rechts">
                            <div class="ticket-prijs">Vanaf &euro;12,50</div>
                            <a href="#" class="knop">Kopen</a>
                        </div>
                    </article>
                </div>
            </section>

            <section class="shop-aanbieding-balk">
                <p>&#10003; Seizoenskaarthouders 10% korting &nbsp;&nbsp; &#10003; Gratis verzending vanaf &euro;99,95</p>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Telstar IJmuiden &nbsp;|&nbsp; Polderweg 1, IJmuiden</p>
        </footer>
    </body>
</html>