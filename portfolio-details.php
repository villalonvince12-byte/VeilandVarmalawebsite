<?php
include 'db_connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT bride_name, groom_name, location, cover_photo, message FROM weddings WHERE id = $id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $bride = htmlspecialchars($row['bride_name']);
    $groom = htmlspecialchars($row['groom_name']);
    $location = htmlspecialchars($row['location']);
    $cover_photo = htmlspecialchars($row['cover_photo']);
    $message = $row['message'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | Details</title>
    <?php include 'icon.php'; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/modernline-personal-use" rel="stylesheet">
    <style>
        /* ============================================================
           CSS CUSTOM PROPERTIES
        ============================================================ */
        :root {
            --primary: #ffffff;
            --secondary: #C3B8AC;
            --tertiary: #323538;
            --textcolor: #333333;
            --dusty-rose: #C7A8A3;
            --sage: #A3B8A7;
        }

        @font-face {
            font-family: 'NewYork';
            src: url('assets/fonts/numea-demo/NewYork PERSONAL USE.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        /* ============================================================
           RESET & BASE
        ============================================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            overflow-x: clip;
        }

        body {
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            color: var(--textcolor);
            background: var(--primary);
            line-height: 1.6;
            overflow-x: clip;
            width: 100%;
            max-width: 100%;
        }

        h1, h2, h3, h4 {
            font-weight: 400;
            letter-spacing: 0.03em;
            line-height: 1.2;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        /* ============================================================
           HERO HEADER — matches index.php exactly
        ============================================================ */
        .hero-header {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(248, 245, 242, 0.95);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 1000;
            padding: 0.6rem 2%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .nav-group-left,
        .nav-group-right {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-group-left a,
        .nav-group-right a {
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 0.10em;
            text-transform: uppercase;
            font-size: 0.9rem;
            font-weight: 300;
            position: relative;
        }

        .nav-group-left a::after,
        .nav-group-right a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: var(--textcolor);
            transition: width 0.3s ease;
        }

        .nav-group-left a:hover::after,
        .nav-group-right a:hover::after {
            width: 100%;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-container .logotitle {
            width: auto;
            height: 55px;
            object-fit: contain;
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--textcolor);
            font-size: 1.8rem;
            cursor: pointer;
            z-index: 1001;
            padding: 0.2rem 0.5rem;
        }

        /* ── Desktop (1024px+) */
        @media (min-width: 1024px) {
            .hero-header { padding: 0.6rem 15%; }
            .nav-group-left, .nav-group-right { gap: 6rem; }
            .logo-container .logotitle { height: 70px; }
        }

        /* ── Tablets & Mobile (1023px and below) */
        @media (max-width: 1023px) {
            .mobile-menu-btn { display: block; }
            .nav-group-left, .nav-group-right { display: none; }
        }

        /* ── Mobile (768px and below) */
        @media (max-width: 768px) {
            .logo-container .logotitle { height: 42px; }
        }

        /* ── Small Mobile (480px and below) */
        @media (max-width: 480px) {
            .logo-container .logotitle { height: 36px; }
        }

        /* ============================================================
           PAGE OFFSET — push content below fixed header
        ============================================================ */
        .page-offset {
            height: 75px;
        }

        @media (max-width: 768px) {
            .page-offset { height: 60px; }
        }

        /* ============================================================
           HERO SECTION
        ============================================================ */
        .hero {
            position: relative;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            width: 100%;
        }

        .hero-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.8);
            display: block;
            z-index: -1;
        }

        /* ============================================================
           INFO SECTION
        ============================================================ */
        .info-section {
            padding: 4rem 0;
            background-color: var(--primary);
            margin-bottom: -40px;
        }

        .info-wrapper {
            display: flex;
            align-items: stretch;
            max-width: 1200px;
            margin: 0 auto;
        }

        .info-left {
            transform: translateX(-100px);
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .info-name {
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            font-weight: 700;
            line-height: 0.8;
            margin-bottom: 1rem;
        }

        .info-name .bride_name {
            font-weight: 400;
            font-size: 4rem;
            margin: 0;
        }

        .info-name .groom_name {
            font-weight: 400;
            font-size: 3.5rem;
            margin: 0;
        }

        .info-name .full-name {
            display: none;
        }

        .info-location {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .info-logo img {
            max-width: 125px;
            height: auto;
        }

        .vertical-divider {
            height: 350px;
            transform: translate(-10rem, -1rem);
            width: 2px;
            background-color: var(--textcolor);
            margin: 0 2rem;
        }

        .info-right {
            font-family: 'Montserrat', sans-serif;
            transform: translate(-10rem, -0.3rem);
            flex: 2;
            padding: 2rem 0 2rem 0.5rem;
            font-size: 1.1rem;
            line-height: 1.6;
            text-align: justify;
        }

        /* ============================================================
           GALLERY SECTION
        ============================================================ */
        .gallery-section {
            padding: 3rem;
            background-color: var(--primary);
            color: var(--textcolor);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            position: relative;
        }

        .gallery-section::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(to top, white, transparent);
            z-index: -1;
            pointer-events: none;
        }

        .gallery-grid {
            margin-top: -50px;
            margin-left: 15px;
            column-count: 3;
            column-gap: 10px;
        }

        .gallery-item {
            display: inline-block;
            width: 100%;
            margin-bottom: 5px;
            overflow: hidden;
            transition: transform 0.5s ease, filter 0.5s ease;
            will-change: transform, filter;
            backface-visibility: hidden;
        }

        .gallery-img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
            will-change: transform;
            backface-visibility: hidden;
        }

        .gallery-item:hover .gallery-img {
            transform: scale(1.05);
        }

        @keyframes fadeInOnScroll {
            from { opacity: 0; transform: scale(1.03); }
            to   { opacity: 1; transform: scale(1); }
        }

        .gallery-item.visible {
            animation: fadeInOnScroll 0.8s ease forwards;
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 2rem;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay { opacity: 1; }

        .gallery-overlay h3 {
            color: white;
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .gallery-overlay p {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.8);
        }

        /* ============================================================
           SECTION HEADER
        ============================================================ */
        .section-header {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 1rem;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .section-header.active {
            opacity: 1;
            transform: translateY(0);
        }

        .section-header h2.section-title {
            font-family: 'modernline - Personal Use', sans-serif;
            font-size: 1.5rem;
            margin: 0;
            white-space: nowrap;
            top: -80px;
            position: relative;
            z-index: 1;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
            left: 15px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            margin: 0;
            white-space: nowrap;
            top: -80px;
            position: relative;
            z-index: 1;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .section-header-line {
            height: 1px;
            background-color: var(--textcolor);
            flex-grow: 1;
            top: -80px;
            position: relative;
            opacity: 0;
            transform: scaleX(0);
            transform-origin: left;
            transition: opacity 0.8s ease 0.3s, transform 0.8s ease 0.3s;
        }

        .section-header.active h2 { opacity: 1; transform: translateY(0); }
        .section-header.active .section-header-line { opacity: 1; transform: scaleX(1); }

        /* ============================================================
           LIGHTBOX
        ============================================================ */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 9999;
            padding-top: 60px;
            left: 0; top: 0;
            width: 100%; height: 100%;
            overflow: auto;
            background-color: var(--primary);
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .lightbox.show { display: block; opacity: 1; }

        .lightbox-content {
            display: block;
            max-width: 90%;
            max-height: 80vh;
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
        }

        .lightbox-content.show {
            opacity: 1;
            animation: fadeIn 0.5s forwards;
        }

        .lightbox-caption {
            text-align: center;
            color: var(--textcolor);
            padding: 10px 0;
            font-size: 18px;
        }

        .lightbox-close {
            position: absolute;
            top: 30px; right: 45px;
            color: var(--textcolor);
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        .lightbox-nav {
            cursor: pointer;
            position: absolute;
            top: 50%;
            color: var(--dusty-rose);
            font-size: 30px;
            font-weight: bold;
            background: none;
            border: none;
            padding: 0;
            transform: translateY(-50%);
            user-select: none;
            transition: color 0.3s;
        }

        .lightbox-nav:hover,
        .lightbox-nav.simulated-hover { color: var(--textcolor); }
        .lightbox-nav.prev { left: 20px; }
        .lightbox-nav.next { right: 20px; }

        @keyframes fadeIn {
            from { opacity: 0; } to { opacity: 1; }
        }

        @keyframes swipeLeft {
            0%   { transform: translate(-50%, -50%) translateX(100%); opacity: 0; }
            100% { transform: translate(-50%, -50%) translateX(0); opacity: 1; }
        }

        @keyframes swipeRight {
            0%   { transform: translate(-50%, -50%) translateX(-100%); opacity: 0; }
            100% { transform: translate(-50%, -50%) translateX(0); opacity: 1; }
        }

        .animate-left  { animation: swipeLeft  0.5s forwards; }
        .animate-right { animation: swipeRight 0.5s forwards; }

        /* ============================================================
           MEDIA QUERIES
        ============================================================ */
        @media (max-width: 956px) {
            .hero { height: 45vh; }

            .section-header h2      { font-size: 2rem; top: -60px; }
            .section-header h2.section-title { font-size: 1.2rem; top: -60px; }
            .section-header-line    { top: -60px; }

            .lightbox-content { max-width: 95vw; max-height: 70vh; }
            .lightbox-caption { position: fixed; bottom: 10px; left: 0; right: 0; text-align: center; font-size: 1rem; }
            .lightbox-nav     { position: fixed; top: 50%; transform: translateY(-50%); font-size: 2rem; }
            .lightbox-close   { position: fixed; top: 15px; right: 15px; font-size: 30px; }
        }

        @media (max-width: 600px) {
            .info-section { margin-top: 0; padding: 2rem 1rem; }

            .info-wrapper {
                margin-top: -50px;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .info-left {
                transform: translateX(0);
                padding: 1.5rem 1rem;
                margin-bottom: 3.5rem;
            }

            .info-name .bride_name,
            .info-name .groom_name { display: none; }

            .info-name .full-name {
                margin-left: -10px;
                display: inline;
                font-size: 3rem;
                border-bottom: 1px solid var(--textcolor);
                transform: translateY(-1rem);
                margin-top: -20px;
            }

            .info-location { margin-left: 0; font-size: 2.5rem; }

            .info-logo img {
                margin-left: 0;
                max-width: 60px;
                margin-top: -1rem;
                margin-bottom: 10px;
            }

            .vertical-divider { display: none; }

            .info-right {
                margin-top: -80px;
                transform: none;
                padding: 1rem;
            }

            .info-section .info-right p {
                font-size: 1rem;
                text-align: justify;
                text-indent: 2em;
                letter-spacing: 0.8px;
            }

            .gallery-section {
                margin-left: 5px !important;
                margin-right: 5px !important;
                padding-left: 5px !important;
                padding-right: 5px !important;
            }

            .gallery-section .gallery-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 0.4rem;
                padding: 0; margin: 0;
            }

            .gallery-section .gallery-grid > * {
                width: 100%;
                height: 200px;
                overflow: hidden;
                position: relative;
            }

            .gallery-section .gallery-grid .gallery-item { width: 100%; height: 100%; }

            .gallery-section .gallery-grid .gallery-item img {
                width: 100%; height: 100%;
                object-fit: cover; display: block;
            }

            .gallery-overlay {
                position: static;
                width: 100%;
                padding: 0.5rem 0;
                background: none;
                opacity: 1 !important;
                transition: none;
                text-align: center;
            }

            .gallery-grid .gallery-overlay h3 {
                width: 200px;
                color: var(--primary);
                margin: 0;
                font-size: 0.75rem;
                transform: translateY(20px);
                letter-spacing: 0.1rem;
            }

            .gallery-grid .gallery-overlay p {
                font-family: 'Montserrat', sans-serif;
                font-size: 0.5rem;
                color: var(--primary);
                transform: translateY(15px);
                margin: 0.2rem 0 0;
                width: 200px;
                letter-spacing: 1px;
            }
        }
    </style>
</head>
<body>

<?php include 'nav-mobile.php'; ?>

<!-- Fixed Header — matches index.php -->
<div class="hero-header">
    <div class="nav-group-left">
        <a href="about.php">ABOUT</a>
        <a href="portfolio.php">GALLERIES</a>
    </div>
    <div class="logo-container">
        <a href="index.php">
            <img src="assets/image/logo2.png" alt="Veil & Varmala Logo" class="logotitle">
        </a>
    </div>
    <div class="nav-group-right">
        <a href="veil&varmalaexperience.php">EXPERIENCE</a>
        <a href="inquire.php">INQUIRE</a>
    </div>
    <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>
</div>

<!-- Spacer so fixed header doesn't overlap content -->
<div class="page-offset"></div>

<!-- Hero Section -->
<section class="hero" id="home">
    <img src="assets/image/<?= htmlspecialchars($cover_photo) ?>" alt="Wedding Cover Photo" class="hero-image">
</section>

<!-- Info Section -->
<section class="info-section">
    <div class="info-wrapper">

        <div class="info-left">
            <div class="info-name">
                <span class="bride_name"><?= $bride ?></span><br/>
                <span class="groom_name"><?= $groom ?></span>
                <span class="full-name"><?= $bride ?> + <?= $groom ?></span>
            </div>
            <div class="info-location"><?= $location ?></div>
            <div class="info-logo">
                <img src="assets/image/logo.png" alt="Logo" />
            </div>
        </div>

        <div class="vertical-divider"></div>

        <div class="info-right">
            <?php
            $paragraphs = preg_split("/(\r?\n){2,}/", $message);
            foreach ($paragraphs as $p) {
                $p = trim($p);
                if ($p !== '') {
                    echo '<p>' . nl2br(htmlspecialchars($p)) . '</p>';
                }
            }
            ?>
        </div>

    </div>
</section>

<?php
} else {
    echo "<p>Wedding information not found.</p>";
}
$conn->close();
?>

<!-- Gallery Section -->
<section class="gallery-section" id="gallery">
    <div class="gallery-grid">
    <?php
    include 'db_connect.php';

    $wedding_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($wedding_id > 0) {
        $stmt = $conn->prepare("SELECT filename FROM wedding_gallery WHERE wedding_id = ? ORDER BY display_order ASC");
        $stmt->bind_param("i", $wedding_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $filename = htmlspecialchars($row['filename']);
                echo '<div class="gallery-item">';
                echo '<img src="assets/gallery/' . $filename . '" alt="Gallery Image" class="gallery-img">';
                echo '<div class="gallery-overlay"></div>';
                echo '</div>';
            }
        } else {
            echo '<p>No photos uploaded for this wedding yet.</p>';
        }

        $stmt->close();
    } else {
        echo '<p>Invalid wedding ID.</p>';
    }

    $conn->close();
    ?>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="lightbox">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <img class="lightbox-content" id="lightbox-img">
    <div class="lightbox-caption" id="lightbox-caption"></div>
    <button class="lightbox-nav prev" onclick="changeImage(-1)">&#10094;</button>
    <button class="lightbox-nav next" onclick="changeImage(1)">&#10095;</button>
</div>

<?php include 'footer.php'; ?>

<script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu    = document.getElementById('mobileMenu');
    const overlay       = document.getElementById('overlay');

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function () {
            if (mobileMenu) mobileMenu.classList.toggle('active');
            if (overlay)    overlay.classList.toggle('active');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', function () {
            if (mobileMenu) mobileMenu.classList.remove('active');
            overlay.classList.remove('active');
        });
    }

    document.querySelectorAll('.mobile-nav-links a').forEach(link => {
        link.addEventListener('click', function () {
            if (mobileMenu) mobileMenu.classList.remove('active');
            if (overlay)    overlay.classList.remove('active');
        });
    });

    // Mouse-zone arrow highlight
    document.addEventListener('mousemove', function (e) {
        const nextArrow = document.querySelector('.lightbox-nav.next');
        const prevArrow = document.querySelector('.lightbox-nav.prev');
        const windowWidth = window.innerWidth;
        const x = e.clientX;

        nextArrow.classList.remove('simulated-hover');
        prevArrow.classList.remove('simulated-hover');

        if (x < windowWidth * 0.3) {
            prevArrow.classList.add('simulated-hover');
        } else if (x > windowWidth * 0.7) {
            nextArrow.classList.add('simulated-hover');
        }
    });

    // Lightbox
    const images = document.querySelectorAll('.gallery-img');
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');

    let currentIndex = 0;
    let galleryImages = [];

    images.forEach((img, index) => {
        galleryImages.push({ src: img.src });
        img.addEventListener('click', () => {
            currentIndex = index;
            openLightbox();
        });
    });

    function openLightbox() {
        lightbox.style.display = 'block';
        setTimeout(() => {
            lightbox.classList.add('show');
            updateLightbox('fade');
        }, 10);
    }

    function closeLightbox() {
        lightbox.classList.remove('show');
        setTimeout(() => {
            lightbox.style.display = 'none';
            lightboxImg.classList.remove('show');
        }, 500);
    }

    function changeImage(direction) {
        const swipeDir = direction > 0 ? 'left' : 'right';
        currentIndex += direction;
        if (currentIndex < 0) currentIndex = galleryImages.length - 1;
        if (currentIndex >= galleryImages.length) currentIndex = 0;
        updateLightbox(swipeDir);
    }

    function updateLightbox(animation = 'fade') {
        lightboxImg.className = 'lightbox-content';
        const img = new Image();
        img.src = galleryImages[currentIndex].src;
        img.onload = () => {
            lightboxImg.src = img.src;
            lightboxCaption.textContent = galleryImages[currentIndex].alt || '';
            if (animation === 'left')       lightboxImg.classList.add('animate-left');
            else if (animation === 'right') lightboxImg.classList.add('animate-right');
            else                            lightboxImg.classList.add('show');
        };
    }

    // Keyboard support
    document.addEventListener('keydown', (e) => {
        if (lightbox.classList.contains('show')) {
            if (e.key === 'Escape')      closeLightbox();
            if (e.key === 'ArrowRight')  changeImage(1);
            if (e.key === 'ArrowLeft')   changeImage(-1);
        }
    });

    // Touch swipe
    let startX = 0;
    lightbox.addEventListener('touchstart', e => { startX = e.changedTouches[0].screenX; }, { passive: true });
    lightbox.addEventListener('touchend', e => {
        const diff = startX - e.changedTouches[0].screenX;
        if (Math.abs(diff) > 50) changeImage(diff > 0 ? 1 : -1);
    }, { passive: true });

    // Gallery scroll-in animation
    document.addEventListener('DOMContentLoaded', () => {
        const galleryItems = document.querySelectorAll('.gallery-item');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = (Math.random() * 1).toFixed(2);
                    entry.target.style.animationDelay = `${delay}s`;
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        galleryItems.forEach(item => observer.observe(item));
    });
</script>

</body>
</html>