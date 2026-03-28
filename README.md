# Parkhotel Horst — Vergaderen & Bijeenkomst Landingspagina

Volledige implementatie van de "Vergaderen en Bijeenkomst" detailpagina.
Gebouwd als custom WordPress template + ACF Pro velden.

---

## 📁 Bestandsstructuur

```
phh-landingspagina/
├── index.html                        ← GitHub Pages preview (statisch)
├── style.css                         ← Alle CSS
├── script.js                         ← Alle JS (sliders, filters, animaties)
├── wordpress/
│   ├── page-vergaderen.php           ← WordPress page template
│   ├── acf-group-vergaderen.json     ← ACF field group (importeerbaar)
│   └── functions-snippet.php        ← Toe te voegen aan functions.php
└── README.md
```

---

## 🖥️ Stap 1: Preview op GitHub Pages

1. Maak een nieuwe GitHub repository aan (bijv. `phh-vergaderen-preview`)
2. Upload alle bestanden uit deze map (niet de `wordpress/` submap)
3. Ga naar Settings → Pages → Branch: `main` → Folder: `/ (root)`
4. De preview is live op: `https://[jouw-naam].github.io/phh-vergaderen-preview/`

---

## 🔧 Stap 2: WordPress installatie

### A. Bestanden uploaden

1. Log in op je server via FTP of cPanel
2. Navigeer naar: `/wp-content/themes/parkhotel/`
3. Maak een nieuwe map aan: `vergaderen/`
4. Upload hierin:
   - `style.css`
   - `script.js`
5. Upload `page-vergaderen.php` direct in de thema-root:
   `/wp-content/themes/parkhotel/page-vergaderen.php`

### B. functions.php aanpassen

Open `/wp-content/themes/parkhotel/functions.php` en plak de inhoud van `functions-snippet.php` onderaan (vóór de sluitende `?>` tag als die er is).

### C. ACF field group importeren

1. Ga in WordPress naar **ACF → Field Groups → Tools → Import**
2. Upload `acf-group-vergaderen.json`
3. Klik op **Import**

### D. Pagina aanmaken

1. Ga naar **Pagina's → Nieuwe pagina**
2. Geef de pagina een naam (bijv. "Vergaderen en Bijeenkomst")
3. Stel het permalink in op `/vergaderen` (of `/vergaderen-en-bijeenkomst`)
4. Kies rechts onder **Paginasjabloon**: `Vergaderen Detail`
5. Publiceer de pagina
6. Scroll naar beneden — je ziet nu alle ACF velden om content in te vullen

---

## ✏️ Stap 3: Content invullen via ACF

Na het instellen van de template zie je de volgende veldgroepen:

| Veldgroep | Wat je invult |
|-----------|---------------|
| Hero | Titel, achtergrondafbeelding, 3 USP's |
| Scenario Kaarten | 4 pakketten met prijs en bullets |
| Intro sectie | Tekst + foto + CTA knop |
| Vergaderzalen | Foto's, capaciteiten, faciliteiten tags |
| Breaks & Faciliteiten | Activiteiten met categorie (actief/cultuur/seizoen) |
| Andere Arrangementen | 5 kaarten met foto en link |
| Outro sectie | Restaurant BØFF tekst + foto |
| Reviews | Zoover score + individuele reviews |
| Contact CTA | Telefoon, e-mail, adres, foto |

**Tip:** Alle velden hebben standaardwaarden — de pagina werkt ook als je niets invult.

---

## 🎨 Design details

- **Kleuren:** `#1c1c1c` (donker) / `#f5f0e8` (crème) / `#c8a96e` (goud)
- **Fonts:** Playfair Display (koppen) + Lato (tekst) via Google Fonts
- **Achtergrond textuur:** Hexagon patroon via SVG CSS
- **Animaties:** IntersectionObserver fade-in bij scrollen
- **Sliders:** CSS scroll-snap + vanilla JS navigatie
- **Filter:** Vanilla JS categorie-filter voor Breaks sectie

## 📱 Responsive breakpoints

- Desktop: 1200px+
- Tablet: 768px
- Mobiel: 375px (hamburger menu, single column)

---

## ❓ Veelgestelde vragen

**Q: Elementor doet raar op de pagina**  
A: De template bypassed Elementor automatisch. Als je nog Elementor output ziet, verwijder dan eventuele Elementor content die al op de pagina stond.

**Q: Google Fonts laden niet**  
A: Controleer of het thema Google Fonts blokkeert in functions.php. Het `functions-snippet.php` snippet laadt ze apart.

**Q: Afbeeldingen tonen placeholders**  
A: Vervang de picsum.photos URL's in de ACF velden door echte foto's.
