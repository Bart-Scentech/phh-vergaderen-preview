<?php
/**
 * Template Name: Vergaderen Detail
 *
 * Standalone pagina-template voor de Vergaderen & Bijeenkomst landingspagina.
 * Bypassed Elementor volledig — laadt eigen CSS/JS.
 *
 * Installatie: kopieer dit bestand naar /wp-content/themes/parkhotel/
 * Wijs het toe in WordPress > Pagina's > [pagina] > Template: "Vergaderen Detail"
 */

// Laad WordPress header (inclusief <head> en navigatie)
get_header();

// ACF velden ophalen (met fallbacks voor als velden leeg zijn)
$hero_bg        = get_field('hero_background_image') ?: 'https://picsum.photos/seed/hotel-aerial/1920/900';
$hero_title     = get_field('hero_title') ?: 'Vergaderen en bijeenkomst';
$hero_subtitle  = get_field('hero_subtitle') ?: 'Unieke locatie voor al uw evenementen';
$hero_label     = get_field('hero_label') ?: 'Vergaderen & Bijeenkomst';
$usps           = get_field('hero_usps') ?: [];
$scenarios      = get_field('scenario_cards') ?: [];
$intro_title    = get_field('intro_title') ?: 'De perfecte setting voor uw vergadering';
$intro_text     = get_field('intro_text') ?: '';
$intro_image    = get_field('intro_image') ?: 'https://picsum.photos/seed/hotel-garden/900/700';
$intro_cta      = get_field('intro_cta_text') ?: 'Vraag offerte aan';
$intro_cta_url  = get_field('intro_cta_url') ?: '#contact';
$zalen          = get_field('vergaderzalen') ?: [];
$breaks         = get_field('breaks_faciliteiten') ?: [];
$arrangementen  = get_field('andere_arrangementen') ?: [];
$outro_title    = get_field('outro_title') ?: 'Genieten na een productieve dag';
$outro_text     = get_field('outro_text') ?: '';
$outro_image    = get_field('outro_image') ?: 'https://picsum.photos/seed/hotel-restaurant/900/700';
$outro_cta      = get_field('outro_cta_text') ?: 'Meer over Restaurant BØFF';
$outro_cta_url  = get_field('outro_cta_url') ?: '#';
$reviews        = get_field('reviews') ?: [];
$review_score   = get_field('review_score') ?: '4.1';
$review_count   = get_field('review_count') ?: '1.596';
$contact_title  = get_field('contact_title') ?: 'Wilt u meer weten?';
$contact_text   = get_field('contact_text') ?: '';
$contact_image  = get_field('contact_image') ?: 'https://picsum.photos/seed/hotel-entrance/900/600';
$contact_phone  = get_field('contact_phone') ?: '077 464 1000';
$contact_email  = get_field('contact_email') ?: 'info@parkhotelhorst.nl';
$contact_addr   = get_field('contact_address') ?: 'Terpseweg 2, 5961 NH Horst';

// Default USPs als ACF leeg is
if (empty($usps)) {
    $usps = [
        ['icon' => '🌿', 'title' => 'Unieke locatie', 'description' => 'Verscholen in het landelijk groen aan het water'],
        ['icon' => '🤝', 'title' => 'Professionele begeleiding', 'description' => 'Ervaren eventteam voor elk type bijeenkomst'],
        ['icon' => '⚙️', 'title' => 'Uitstekende faciliteiten', 'description' => '12 multifunctionele zalen voor 4 tot 200 personen'],
    ];
}

// Default scenario cards als ACF leeg is
if (empty($scenarios)) {
    $scenarios = [
        ['title' => 'Dagdeel', 'price' => '€19,50', 'unit' => 'p.p.',
         'image' => 'https://picsum.photos/seed/meeting1/600/360',
         'features' => ['Gebruik zaal (ochtend of middag)', 'Koffie, thee & frisdrank', '1x lunch of diner', 'Flip-over & beamer', 'Gratis parkeren']],
        ['title' => 'Hele dag', 'price' => '€37,50', 'unit' => 'p.p.',
         'image' => 'https://picsum.photos/seed/meeting2/600/360',
         'features' => ['Gebruik zaal (hele dag)', 'Onbeperkt koffie & thee', '2x pauze met gebak', 'Lunch & 2-gangen diner', 'AV-apparatuur']],
        ['title' => '24-uur arrangement', 'price' => '€189,-', 'unit' => 'p.p.',
         'image' => 'https://picsum.photos/seed/hotel-room1/600/360',
         'features' => ['Vergaderzaal (hele dag)', 'Alle maaltijden', 'Overnachting standaardkamer', 'AV-apparatuur', 'Wellness toegang']],
        ['title' => '2-daags arrangement', 'price' => '€210,-', 'unit' => 'p.p.',
         'image' => 'https://picsum.photos/seed/hotel-suite/600/360',
         'features' => ['Vergaderzaal (2 dagen)', 'Alle maaltijden inbegrepen', '1x overnachting', 'AV-apparatuur & flip-overs', 'Teambuilding activiteit']],
    ];
}
?>

<!-- Eigen CSS laden (bypassed Elementor) -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/vergaderen/style.css">

<!-- Elementor output verbergen voor deze template -->
<style>
  .elementor-section, .elementor-widget-wrap { display: none !important; }
  .phh-vergaderen { display: block !important; }
</style>

<div class="phh-vergaderen">

<!-- ============================================================
     HERO
     ============================================================ -->
<section class="hero" id="vergaderen">
  <div class="hero-img" style="background-image: url('<?php echo esc_url(is_array($hero_bg) ? $hero_bg['url'] : $hero_bg); ?>');"></div>
  <div class="hero-content">
    <div class="container">
      <div class="hero-label fade-in"><?php echo esc_html($hero_label); ?></div>
      <h1 class="fade-in"><?php echo wp_kses_post($hero_title); ?></h1>
    </div>
  </div>
</section>

<div class="hero-usps">
  <div class="container">
    <?php foreach ($usps as $usp) : ?>
    <div class="usp-item fade-in">
      <div class="usp-icon"><?php echo esc_html($usp['icon']); ?></div>
      <div class="usp-text">
        <strong><?php echo esc_html($usp['title']); ?></strong>
        <span><?php echo esc_html($usp['description']); ?></span>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- ============================================================
     SCENARIO CARDS
     ============================================================ -->
<section class="scenarios" id="scenarios">
  <div class="section-header fade-in">
    <div class="section-label">Onze pakketten</div>
    <h2 class="section-title">Kies uw scenario</h2>
  </div>
  <div class="scenarios-slider-wrap">
    <div class="scenarios-slider" id="scenarios-slider">
      <?php foreach ($scenarios as $i => $card) :
        $img = is_array($card['image']) ? $card['image']['url'] : $card['image'];
        $features = is_array($card['features']) ? $card['features'] : explode("\n", $card['features']);
      ?>
      <div class="scenario-card fade-in" style="transition-delay: <?php echo $i * 0.08; ?>s;">
        <div class="scenario-card-img">
          <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($card['title']); ?>" loading="lazy">
        </div>
        <div class="scenario-card-body">
          <div class="scenario-card-title"><?php echo esc_html($card['title']); ?></div>
          <div class="scenario-price"><?php echo esc_html($card['price']); ?> <span><?php echo esc_html($card['unit'] ?? 'p.p.'); ?></span></div>
          <ul class="scenario-features">
            <?php foreach ($features as $f) : if (empty(trim(is_array($f) ? $f['feature'] : $f))) continue; ?>
            <li><?php echo esc_html(is_array($f) ? $f['feature'] : $f); ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="#contact" class="btn btn-outline-dark">Vraag offerte aan</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="slider-nav">
    <button class="slider-btn" id="scenarios-prev" aria-label="Vorige">&#8592;</button>
    <div class="slider-dots" id="scenarios-dots"></div>
    <button class="slider-btn" id="scenarios-next" aria-label="Volgende">&#8594;</button>
  </div>
</section>

<!-- ============================================================
     INTRO TEXT + PHOTO
     ============================================================ -->
<section class="text-photo">
  <div class="text-photo-inner">
    <div class="text-photo-img">
      <?php $intro_img_url = is_array($intro_image) ? $intro_image['url'] : $intro_image; ?>
      <img src="<?php echo esc_url($intro_img_url); ?>" alt="<?php echo esc_attr($intro_title); ?>" loading="lazy">
    </div>
    <div class="text-photo-content">
      <div class="section-label">Over ons</div>
      <h2 class="fade-in"><?php echo esc_html($intro_title); ?></h2>
      <div class="fade-in"><?php echo wp_kses_post(wpautop($intro_text ?: 'Verscholen in het landelijk groen van Noord-Limburg biedt Parkhotel Horst een unieke combinatie van rust en professionaliteit. Met 12 multifunctionele zalen en een professioneel eventteam is elke bijeenkomst bij ons een succes.')); ?></div>
      <a href="<?php echo esc_url($intro_cta_url); ?>" class="btn btn-gold fade-in"><?php echo esc_html($intro_cta); ?></a>
    </div>
  </div>
</section>

<!-- ============================================================
     VERGADERZALEN
     ============================================================ -->
<section class="vergaderzalen hex-bg" id="zalen">
  <div class="section-header fade-in">
    <div class="section-label" style="color: var(--gold);">Onze ruimtes</div>
    <h2 class="section-title">Onze vergaderzalen</h2>
  </div>
  <div class="rooms-slider-wrap">
    <div class="rooms-slider" id="rooms-slider">
      <?php
      $default_zalen = empty($zalen) ? [
        ['title' => 'Heer van Myrlaer', 'image' => 'https://picsum.photos/seed/room-heer/900/500',
         'cap_theater' => 120, 'cap_u' => 40, 'cap_diner' => 80,
         'tags' => ['Daglicht','Beamer','Flip-over','Airconditioning','WiFi','Geluidsinstallatie']],
        ['title' => 'Huys ter Horst', 'image' => 'https://picsum.photos/seed/room-huys/900/500',
         'cap_theater' => 200, 'cap_u' => 60, 'cap_diner' => 150,
         'tags' => ['Panoramisch uitzicht','Beamer HD','Videoconferentie','Podium','WiFi','Breakout ruimtes']],
      ] : $zalen;
      foreach ($default_zalen as $i => $room) :
        $room_img = is_array($room['image']) ? $room['image']['url'] : $room['image'];
        $tags = $room['tags'] ?? [];
      ?>
      <div class="room-card fade-in" style="transition-delay: <?php echo $i * 0.1; ?>s;">
        <div class="room-card-img">
          <img src="<?php echo esc_url($room_img); ?>" alt="<?php echo esc_attr($room['title']); ?>" loading="lazy">
        </div>
        <div class="room-card-body">
          <h3 class="room-card-title"><?php echo esc_html($room['title']); ?></h3>
          <div class="room-specs">
            <div class="room-spec">
              <span class="room-spec-val"><?php echo esc_html($room['cap_theater'] ?? '—'); ?></span>
              <span class="room-spec-label">Theater</span>
            </div>
            <div class="room-spec">
              <span class="room-spec-val"><?php echo esc_html($room['cap_u'] ?? '—'); ?></span>
              <span class="room-spec-label">U-opstelling</span>
            </div>
            <div class="room-spec">
              <span class="room-spec-val"><?php echo esc_html($room['cap_diner'] ?? '—'); ?></span>
              <span class="room-spec-label">Diner</span>
            </div>
          </div>
          <?php if (!empty($tags)) : ?>
          <div class="room-setups">
            <?php foreach ($tags as $tag) : ?>
            <span class="room-setup-tag"><?php echo esc_html(is_array($tag) ? $tag['tag'] : $tag); ?></span>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
          <div class="room-card-actions">
            <a href="#contact" class="btn btn-gold">Vraag offerte aan</a>
            <a href="#contact" class="btn btn-outline">Meer info</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="slider-nav">
    <button class="slider-btn" id="rooms-prev" aria-label="Vorige">&#8592;</button>
    <div class="slider-dots" id="rooms-dots"></div>
    <button class="slider-btn" id="rooms-next" aria-label="Volgende">&#8594;</button>
  </div>
</section>

<!-- ============================================================
     BREAKS & FACILITEITEN
     ============================================================ -->
<section class="breaks" id="breaks">
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label">Activiteiten</div>
      <h2 class="section-title dark">Breaks &amp; Faciliteiten</h2>
    </div>
    <div class="filter-tabs fade-in">
      <button class="filter-tab active" data-filter="alle">Alle</button>
      <button class="filter-tab" data-filter="actief">Actief</button>
      <button class="filter-tab" data-filter="cultuur">Cultuur</button>
      <button class="filter-tab" data-filter="seizoen">Seizoen</button>
    </div>
    <div class="breaks-grid">
      <?php
      $default_breaks = empty($breaks) ? [
        ['title' => 'Outdoor teambuilding', 'category' => 'actief', 'description' => 'Geef uw team een energieboost met onze outdoor activiteiten.',
         'image' => 'https://picsum.photos/seed/teambuilding1/600/400'],
        ['title' => 'Zwembad & Wellness', 'category' => 'actief', 'description' => 'Ontspan in ons verwarmde zwembad of de sauna.',
         'image' => 'https://picsum.photos/seed/wellness-pool/600/400'],
        ['title' => 'Wijnproeverij', 'category' => 'cultuur', 'description' => 'Verfijn uw paleis met een begeleide wijnproeverij.',
         'image' => 'https://picsum.photos/seed/winery-tour/600/400'],
        ['title' => 'Kookworkshop', 'category' => 'cultuur', 'description' => 'Samen koken, samen lachen. Onze chef begeleidt uw team.',
         'image' => 'https://picsum.photos/seed/cooking-class/600/400'],
        ['title' => 'Begeleide fietstocht', 'category' => 'seizoen', 'description' => 'Verken de prachtige Limburgse omgeving per fiets.',
         'image' => 'https://picsum.photos/seed/cycling-limburg/600/400'],
        ['title' => 'Natuur & Wandeling', 'category' => 'seizoen', 'description' => 'Kom tot rust tijdens een geleide wandeling.',
         'image' => 'https://picsum.photos/seed/garden-walk/600/400'],
      ] : $breaks;
      foreach ($default_breaks as $i => $b) :
        $b_img = is_array($b['image']) ? $b['image']['url'] : $b['image'];
      ?>
      <div class="break-card fade-in" style="transition-delay: <?php echo $i * 0.06; ?>s;" data-cat="<?php echo esc_attr($b['category']); ?>">
        <div class="break-card-img">
          <img src="<?php echo esc_url($b_img); ?>" alt="<?php echo esc_attr($b['title']); ?>" loading="lazy">
        </div>
        <div class="break-card-body">
          <div class="break-card-cat"><?php echo esc_html(ucfirst($b['category'])); ?></div>
          <div class="break-card-title"><?php echo esc_html($b['title']); ?></div>
          <p class="break-card-desc"><?php echo esc_html($b['description']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     ANDERE ARRANGEMENTEN
     ============================================================ -->
<section class="arrangementen" id="arrangementen">
  <div class="section-header fade-in">
    <div class="section-label" style="color: var(--gold);">Meer bij Parkhotel</div>
    <h2 class="section-title">Andere arrangementen</h2>
  </div>
  <div class="arr-slider">
    <?php
    $default_arr = empty($arrangementen) ? [
      ['title' => 'Feesten & Partijen', 'image' => 'https://picsum.photos/seed/feest-party/400/600', 'url' => '#'],
      ['title' => 'Bruiloften', 'image' => 'https://picsum.photos/seed/wedding-flowers/400/600', 'url' => '#'],
      ['title' => 'Condoleances', 'image' => 'https://picsum.photos/seed/condolences-quiet/400/600', 'url' => '#'],
      ['title' => 'Bijeenkomsten', 'image' => 'https://picsum.photos/seed/bijeenkomst-hall/400/600', 'url' => '#'],
      ['title' => 'Trainingskamp', 'image' => 'https://picsum.photos/seed/sports-training/400/600', 'url' => '#'],
    ] : $arrangementen;
    foreach ($default_arr as $i => $arr) :
      $arr_img = is_array($arr['image']) ? $arr['image']['url'] : $arr['image'];
    ?>
    <a href="<?php echo esc_url($arr['url'] ?? '#'); ?>" class="arr-card fade-in" style="transition-delay: <?php echo $i * 0.08; ?>s;">
      <img src="<?php echo esc_url($arr_img); ?>" alt="<?php echo esc_attr($arr['title']); ?>" loading="lazy">
      <div class="arr-card-title"><?php echo esc_html($arr['title']); ?></div>
    </a>
    <?php endforeach; ?>
  </div>
</section>

<!-- ============================================================
     OUTRO TEXT + PHOTO (reversed)
     ============================================================ -->
<section class="text-photo">
  <div class="text-photo-inner reverse">
    <div class="text-photo-img">
      <?php $outro_img_url = is_array($outro_image) ? $outro_image['url'] : $outro_image; ?>
      <img src="<?php echo esc_url($outro_img_url); ?>" alt="<?php echo esc_attr($outro_title); ?>" loading="lazy">
    </div>
    <div class="text-photo-content dark-bg">
      <div class="section-label">Culinair</div>
      <h2 class="fade-in"><?php echo esc_html($outro_title); ?></h2>
      <div class="fade-in"><?php echo wp_kses_post(wpautop($outro_text ?: 'Na een intensieve vergaderdag verdient uw team een heerlijk diner. Restaurant BØFF staat garant voor smakelijke gerechten met lokale ingrediënten.')); ?></div>
      <a href="<?php echo esc_url($outro_cta_url); ?>" class="btn btn-gold fade-in"><?php echo esc_html($outro_cta); ?></a>
    </div>
  </div>
</section>

<!-- ============================================================
     REVIEWS
     ============================================================ -->
<section class="reviews hex-bg" id="reviews">
  <div class="container">
    <div class="reviews-inner">
      <div class="reviews-score-block fade-in">
        <div class="reviews-source">Zoover</div>
        <div class="reviews-badge">
          <div class="reviews-score-num"><?php echo esc_html($review_score); ?></div>
          <div>
            <div class="reviews-stars">★★★★☆</div>
            <div class="reviews-count"><?php echo esc_html($review_count); ?> beoordelingen</div>
          </div>
        </div>
        <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 24px;">Onze gasten waarderen onze locatie, service en faciliteiten al jaren consistent hoog.</p>
        <a href="#" class="btn btn-outline">Alle reviews lezen</a>
      </div>
      <div class="reviews-cards fade-in" style="transition-delay: 0.15s;">
        <?php
        $default_reviews = empty($reviews) ? [
          ['author' => 'Familie Janssen', 'date' => 'Maart 2025', 'rating' => 5, 'text' => '"Fantastische vergaderdag! De zaal was perfect ingericht, de catering was heerlijk en het team was uiterst professioneel."'],
          ['author' => 'Mark de Vries — Sales Director', 'date' => 'Februari 2025', 'rating' => 5, 'text' => '"Perfecte locatie voor ons jaarlijkse directie-overleg. Rust, ruimte en uitstekende faciliteiten. De accommodatie was top."'],
        ] : $reviews;
        foreach ($default_reviews as $rev) :
        ?>
        <div class="review-card">
          <div class="review-meta">
            <span class="review-author"><?php echo esc_html($rev['author']); ?></span>
            <span class="review-date"><?php echo esc_html($rev['date']); ?></span>
          </div>
          <div class="review-stars"><?php echo str_repeat('★', intval($rev['rating'] ?? 5)); ?></div>
          <p class="review-text"><?php echo esc_html($rev['text']); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     CONTACT CTA
     ============================================================ -->
<section class="contact-cta" id="contact">
  <div class="contact-cta-inner">
    <div class="contact-cta-img">
      <?php $contact_img_url = is_array($contact_image) ? $contact_image['url'] : $contact_image; ?>
      <img src="<?php echo esc_url($contact_img_url); ?>" alt="Contact" loading="lazy">
    </div>
    <div class="contact-cta-content">
      <div class="section-label">Contact</div>
      <h2 class="fade-in"><?php echo esc_html($contact_title); ?></h2>
      <p class="fade-in"><?php echo wp_kses_post($contact_text ?: 'Neem contact op met ons eventteam voor een vrijblijvende offerte. Wij denken graag met u mee over de perfecte invulling van uw bijeenkomst.'); ?></p>
      <div class="contact-links fade-in">
        <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $contact_phone)); ?>" class="contact-link">
          <div class="contact-link-icon">📞</div>
          <?php echo esc_html($contact_phone); ?>
        </a>
        <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="contact-link">
          <div class="contact-link-icon">✉️</div>
          <?php echo esc_html($contact_email); ?>
        </a>
        <div class="contact-link">
          <div class="contact-link-icon">📍</div>
          <?php echo esc_html($contact_addr); ?>
        </div>
      </div>
    </div>
  </div>
</section>

</div><!-- .phh-vergaderen -->

<!-- Eigen JS laden -->
<script src="<?php echo get_template_directory_uri(); ?>/vergaderen/script.js"></script>

<?php get_footer(); ?>
