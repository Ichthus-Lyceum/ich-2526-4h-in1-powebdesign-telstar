<?php
// Database verbinding
$db = new PDO('sqlite:eredivisie.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Database aanmaken als die nog niet bestaat
$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND (name='clubs' OR name='wedstrijden')")->fetchAll();
if (count($tables) < 2) {
    $db->exec("
        CREATE TABLE clubs (clubid INTEGER PRIMARY KEY, naam TEXT);
        CREATE TABLE wedstrijden (thuisclub INTEGER, uitclub INTEGER, thuisscore INTEGER, uitscore INTEGER, yyyy INTEGER, mm INTEGER, dd INTEGER);
    ");
    
    // Clubs invoegen
    $clubs = ['PSV','Ajax','AZ \'67','FC Twente','Sparta','Roda JC','FC Volendam','FC Utrecht','Vitesse','Feyenoord','NAC','FC Den Haag','Haarlem','FC VVV','NEC','Go Ahead Eagles','FC Amsterdam','Telstar'];
    foreach ($clubs as $i => $club) {
        $db->exec("INSERT OR IGNORE INTO clubs (clubid, naam) VALUES (".($i+1).", '$club')");
    }
    
    // Wedstrijden invoegen
    $db->exec("INSERT INTO wedstrijden VALUES (7, 18, 1, 0, 1978, 4, 30)");  // Volendam - Telstar
    $db->exec("INSERT INTO wedstrijden VALUES (18, 14, 2, 2, 1978, 3, 15)"); // Telstar - VVV
    $db->exec("INSERT INTO wedstrijden VALUES (2, 18, 4, 0, 1978, 2, 20)");  // Ajax - Telstar
    $db->exec("INSERT INTO wedstrijden VALUES (18, 1, 1, 3, 1978, 1, 10)");  // Telstar - PSV
}

// Telstar ID ophalen
$clubNaam = 'Telstar';
$stmt = $db->prepare("SELECT clubid FROM clubs WHERE naam = ?");
$stmt->execute([$clubNaam]);
$clubId = $stmt->fetchColumn();

// Laatste wedstrijden ophalen
$sql = "
SELECT w.*, thuis.naam AS thuisnaam, uit.naam AS uitnaam
FROM wedstrijden w
JOIN clubs thuis ON thuis.clubid = w.thuisclub
JOIN clubs uit ON uit.clubid = w.uitclub
WHERE w.thuisclub = $clubId OR w.uitclub = $clubId
ORDER BY w.yyyy DESC, w.mm DESC, w.dd DESC
LIMIT 10
";
$matches = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$lastMatch = $matches[0] ?? null;

// Eindstand (hardcoded)
$stand = [
    [1,'PSV',34,21,11,2,53], [2,'Ajax',34,20,9,5,49], [3,'AZ \'67',34,19,9,6,47],
    [4,'FC Twente',34,18,9,7,45], [5,'Sparta',34,14,12,8,40], [6,'Roda JC',34,12,12,10,36],
    [7,'FC Volendam',34,13,8,13,34], [8,'FC Utrecht',34,11,11,12,33], [9,'Vitesse',34,10,13,11,33],
    [10,'Feyenoord',34,10,12,12,32], [11,'NAC',34,10,11,13,31], [12,'FC Den Haag',34,11,6,17,28],
    [13,'Haarlem',34,8,12,14,28], [14,'FC VVV',34,9,10,15,28], [15,'NEC',34,10,8,16,28],
    [16,'Go Ahead Eagles',34,11,5,18,27], [17,'FC Amsterdam',34,9,8,17,26], [18,'Telstar',34,3,8,23,14]
];

// Helper functie voor logo pad
function logo($club) {
    $map = '/img/';
    $clubClean = str_replace([' ', '`', "'", '-'], '', $club);
    $clubClean = strtolower($clubClean);
    
    // Specifieke mapping
    $mapping = [
        'telstar' => 'telstar.png',
        'fcvolendam' => 'volendam.png',
        'fcvvv' => 'vvv.png',
        'vvv' => 'vvv.png',
        'ajax' => 'ajax.png',
        'psv' => 'psv.png',
        'feyenoord' => 'feyenoord.png',
    ];
    
    $file = $mapping[$clubClean] ?? $clubClean . '.png';
    return $map . $file;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Telstar - Supporterssite</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family: Arial, sans-serif; background: #eef2f5; padding: 30px; }
.container { max-width: 1100px; margin: 0 auto; }

/* Header */
.header { background: white; border-radius: 20px; padding: 20px; margin-bottom: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
.header img { height: 80px; }
.header h1 { font-size: 32px; }
.header p { color: #666; margin-top: 5px; }

/* Navigatie */
.nav { display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap; }
.nav button { background: white; border: none; padding: 12px 30px; border-radius: 50px; font-size: 16px; font-weight: bold; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
.nav button:hover { background: #0044aa; color: white; }

/* Grid */
.grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
.card { background: white; border-radius: 20px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
.fullwidth { grid-column: span 2; }

/* Laatste uitslag */
.uitslag { display: flex; justify-content: space-between; align-items: center; margin-top: 15px; }
.team { display: flex; align-items: center; gap: 10px; font-weight: bold; }
.team img { width: 50px; height: 50px; object-fit: contain; }
.score { font-size: 32px; font-weight: bold; background: #eef2f5; padding: 10px 25px; border-radius: 50px; }

/* Cijfers */
.cijfers { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-top: 15px; }
.cijfer { background: #f5f7fa; padding: 10px; border-radius: 12px; text-align: center; }
.cijfer strong { display: block; font-size: 18px; color: #0044aa; }

/* Spelers */
.spelers { margin-top: 15px; }
.speler { display: flex; justify-content: space-between; align-items: center; background: #f5f7fa; padding: 12px; border-radius: 12px; margin-bottom: 10px; }
.speler-nr { background: #0044aa; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }

/* Webshop */
.shop-items { display: flex; gap: 15px; margin-top: 15px; }
.shirt { text-align: center; flex: 1; background: #f5f7fa; padding: 15px; border-radius: 12px; }
.shirt img { width: 80px; height: 80px; object-fit: contain; }
.shirt button { background: #0044aa; color: white; border: none; padding: 8px 20px; border-radius: 25px; margin-top: 10px; cursor: pointer; }

/* Tabel */
table { width: 100%; border-collapse: collapse; margin-top: 15px; }
th { background: #1a1a2e; color: white; padding: 10px; }
td { padding: 8px; border-bottom: 1px solid #ddd; text-align: center; }
.clubcell { display: flex; align-items: center; gap: 8px; }
.clubcell img { width: 25px; height: 25px; object-fit: contain; }

/* Wedstrijd lijst */
.match { background: #f5f7fa; padding: 12px; border-radius: 12px; margin-bottom: 8px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
.match-date { font-size: 12px; color: #666; width: 100%; margin-bottom: 5px; }
.match-teams { display: flex; justify-content: space-between; align-items: center; width: 100%; }
.match-team { display: flex; align-items: center; gap: 8px; }
.match-score { font-weight: bold; font-size: 18px; }
</style>
</head>
<body>
<div class="container">

    <!-- Header -->
    <div class="header">
        <img src="/img/telstar.png" alt="Telstar" onerror="this.style.display='none'">
        <div>
            <h1>TELSTAR</h1>
            <p>IJMUIDEN · 1963 | DE WITTE LEEUWEN</p>
        </div>
    </div>

    <!-- Navigatie -->
    <div class="nav">
        <button>SELECTIE</button>
        <button>RESULTATEN</button>
        <button>WEBSHOP</button>
    </div>

    <div class="grid">
        <!-- Laatste uitslag -->
        <div class="card">
            <h3>📋 LAATSTE UITSLAG</h3>
            <?php if ($lastMatch): ?>
            <div class="uitslag">
                <div class="team">
                    <img src="<?= logo($lastMatch['thuisnaam']) ?>" onerror="this.src='/img/placeholder.png'">
                    <span><?= htmlspecialchars($lastMatch['thuisnaam']) ?></span>
                </div>
                <div class="score"><?= $lastMatch['thuisscore'] ?> - <?= $lastMatch['uitscore'] ?></div>
                <div class="team">
                    <span><?= htmlspecialchars($lastMatch['uitnaam']) ?></span>
                    <img src="<?= logo($lastMatch['uitnaam']) ?>" onerror="this.src='/img/placeholder.png'">
                </div>
            </div>
            <div style="text-align:center; margin-top:10px; color:#666;">
                <?= sprintf('%02d-%02d-%04d', $lastMatch['dd'], $lastMatch['mm'], $lastMatch['yyyy']) ?>
            </div>
            <?php else: ?>
            <p>Geen wedstrijdgegevens</p>
            <?php endif; ?>
        </div>

        <!-- Telstar in cijfers -->
        <div class="card">
            <h3>📊 TELSTAR IN CIJFERS</h3>
            <div class="cijfers">
                <div class="cijfer"><strong>Boogerd Sport</strong>STADION</div>
                <div class="cijfer"><strong>6.000</strong>CAPACITEIT</div>
                <div class="cijfer"><strong>1963</strong>OPGERICHT</div>
                <div class="cijfer"><strong>Witte Leeuwen</strong>BIJNAAM</div>
                <div class="cijfer"><strong>IJmuiden</strong>STAD</div>
            </div>
        </div>

        <!-- Uitgelichte spelers -->
        <div class="card">
            <h3>⭐ UITGELICHTE SPELERS</h3>
            <div class="spelers">
                <div class="speler"><div><strong>Danny Bakker</strong><br><span style="font-size:12px;">AANVOERDER</span></div><div class="speler-nr">6</div></div>
                <div class="speler"><div><strong>Kay Tejan</strong><br><span style="font-size:12px;">AANVALLER</span></div><div class="speler-nr">30</div></div>
                <div class="speler"><div><strong>Nils Rossen</strong><br><span style="font-size:12px;">MIDDENVELDER</span></div><div class="speler-nr">17</div></div>
            </div>
            <button style="margin-top:15px; background:#0044aa; color:white; border:none; padding:8px 20px; border-radius:25px;">BEKIJK ALLE SPELERS</button>
        </div>

        <!-- Webshop -->
        <div class="card">
            <h3>🛒 WEBSHOP</h3>
            <div class="shop-items">
                <div class="shirt"><img src="/img/thuisshirt.png" onerror="this.src='/img/placeholder.png'"><div>Thuisshirt 25/26</div><div><strong>€69,95</strong></div><button>28</button></div>
                <div class="shirt"><img src="/img/uitshirt.png" onerror="this.src='/img/placeholder.png'"><div>Uitshirt 25/26</div><div><strong>€69,95</strong></div><button>28</button></div>
                <div class="shirt"><img src="/img/derdeshirt.png" onerror="this.src='/img/placeholder.png'"><div>Derde shirt 25/26</div><div><strong>€69,95</strong></div><button>28</button></div>
            </div>
            <button style="margin-top:15px; width:100%; background:#0044aa; color:white; border:none; padding:10px; border-radius:25px;">NAAR DE WEBSHOP</button>
        </div>
    </div>

    <!-- Eindstand -->
    <div class="card fullwidth">
        <h3>🏆 EINDSTAND EREDIVISIE 77/78</h3>
        <table>
            <thead><tr><th>#</th><th>Club</th><th>GE</th><th>WI</th><th>GL</th><th>VE</th><th>PT</th></tr></thead>
            <tbody>
            <?php foreach ($stand as $row): ?>
            <tr>
                <td><?= $row[0] ?></td>
                <td class="clubcell"><img src="<?= logo($row[1]) ?>" onerror="this.style.display='none'"> <?= htmlspecialchars($row[1]) ?></td>
                <td><?= $row[2] ?></td><td><?= $row[3] ?></td><td><?= $row[4] ?></td><td><?= $row[5] ?></td>
                <td><strong><?= $row[6] ?></strong></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Laatste 10 wedstrijden -->
    <div class="card fullwidth" style="margin-top:20px;">
        <h3>⚽ LAATSTE 10 WEDSTRIJDEN</h3>
        <?php foreach ($matches as $match): ?>
        <div class="match">
            <div class="match-date"><?= sprintf('%02d-%02d-%04d', $match['dd'], $match['mm'], $match['yyyy']) ?></div>
            <div class="match-teams">
                <div class="match-team"><img src="<?= logo($match['thuisnaam']) ?>" width="25" onerror="this.style.display='none'"> <?= htmlspecialchars($match['thuisnaam']) ?></div>
                <div class="match-score"><?= $match['thuisscore'] ?> - <?= $match['uitscore'] ?></div>
                <div class="match-team"><?= htmlspecialchars($match['uitnaam']) ?> <img src="<?= logo($match['uitnaam']) ?>" width="25" onerror="this.style.display='none'"></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>
</body>
</html>