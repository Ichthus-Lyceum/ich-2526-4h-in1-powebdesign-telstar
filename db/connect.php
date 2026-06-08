* { margin: 0; padding: 0; box-sizing: border-box; }

body { font-family: 'Inter', Arial, sans-serif; background: #eef2f5; padding: 30px; }

.container { max-width: 1100px; margin: 0 auto; }

/* Header */
.header { background: white; border-radius: 20px; padding: 20px; margin-bottom: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
.header img { height: 80px; }
.header h1 { font-size: 32px; color: #111; }
.header p { color: #666; margin-top: 5px; }

/* Navigatie */
.nav { display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap; }
.nav a { background: white; text-decoration: none; color: #111; padding: 12px 30px; border-radius: 50px; font-size: 16px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.1); transition: 0.2s; display: inline-block; }
.nav a:hover { background: #0044aa; color: white; }
.nav a.active { background: #0044aa; color: white; }

/* Grid */
.grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
.card { background: white; border-radius: 20px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
.fullwidth { grid-column: span 2; }

/* Laatste uitslag */
.uitslag { display: flex; justify-content: space-between; align-items: center; margin-top: 15px; flex-wrap: wrap; gap: 15px; }
.team { display: flex; align-items: center; gap: 10px; font-weight: bold; }
.team img { width: 50px; height: 50px; object-fit: contain; }
.score { font-size: 32px; font-weight: bold; background: #eef2f5; padding: 10px 25px; border-radius: 50px; }

/* Cijfers */
.cijfers { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-top: 15px; }
.cijfer { background: #f5f7fa; padding: 12px; border-radius: 12px; text-align: center; }
.cijfer strong { display: block; font-size: 18px; color: #0044aa; margin-bottom: 5px; }

/* Spelers (voor mannen.php) */
.spelers { margin-top: 15px; }
.speler { display: flex; justify-content: space-between; align-items: center; background: #f5f7fa; padding: 15px; border-radius: 12px; margin-bottom: 10px; }
.speler-positie { font-size: 12px; color: #666; }
.speler-nr { background: #0044aa; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 18px; }

/* Webshop (voor webshop.php) */
.shop-items { display: flex; gap: 20px; margin-top: 15px; flex-wrap: wrap; justify-content: center; }
.shirt { text-align: center; flex: 1; background: #f5f7fa; padding: 20px; border-radius: 16px; min-width: 200px; }
.shirt img { width: 120px; height: 120px; object-fit: contain; margin-bottom: 15px; }
.shirt-naam { font-weight: bold; font-size: 18px; margin-bottom: 8px; }
.shirt-prijs { color: #0044aa; font-weight: bold; font-size: 20px; margin-bottom: 15px; }
.shirt-btn { background: #0044aa; color: white; border: none; padding: 10px 25px; border-radius: 30px; cursor: pointer; font-size: 16px; transition: 0.2s; }
.shirt-btn:hover { background: #002266; }

/* Tabellen */
table { width: 100%; border-collapse: collapse; margin-top: 15px; }
th { background: #1a1a2e; color: white; padding: 12px; }
td { padding: 10px; border-bottom: 1px solid #ddd; text-align: center; }
.clubcell { display: flex; align-items: center; gap: 10px; }
.clubcell img { width: 25px; height: 25px; object-fit: contain; }

/* Wedstrijd lijst */
.match { background: #f5f7fa; padding: 15px; border-radius: 12px; margin-bottom: 10px; }
.match-date { font-size: 12px; color: #666; margin-bottom: 8px; }
.match-teams { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }
.match-team { display: flex; align-items: center; gap: 10px; font-weight: bold; }
.match-score { font-weight: bold; font-size: 20px; background: white; padding: 5px 15px; border-radius: 30px; }

/* Knoppen */
.btn { background: #0044aa; color: white; border: none; padding: 12px 25px; border-radius: 30px; cursor: pointer; text-decoration: none; display: inline-block; margin-top: 15px; text-align: center; transition: 0.2s; font-size: 16px; }
.btn:hover { background: #002266; }
.btn-block { display: block; text-align: center; width: 100%; }

h2 { color: #1a1a2e; margin-bottom: 15px; border-left: 4px solid #0044aa; padding-left: 15px; }
h3 { color: #1a1a2e; margin-bottom: 10px; }
