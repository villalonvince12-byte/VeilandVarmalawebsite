<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <?php include 'icon.php'; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/modernline-personal-use" rel="stylesheet">
    <style>
        /* Base Styles */
        :root {
            --primary: #ffffff;
            --secondary: #C3B8AC;
            --tertiary: #323538;
            --textcolor: #333333;
            --dusty-rose: #C7A8A3;
            --sage: #A3B8A7;
        }
        
        @font-face {
            font-family: 'Numea';
            src: url('assets/fonts/numea-demo/Numea DEMO.otf') format('opentype');
        }

        @font-face {
            font-family: 'NewYork';
            src: url('assets/fonts/numea-demo/NewYork PERSONAL USE.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
            overflow-x: clip;
        }
        
        html, body {
            margin: 0;
            padding: 0;
            max-width: 100%;
        }

        body {
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            color: var(--textcolor);
            background: var(--primary);
            line-height: 1.6;
            overflow-x: clip;
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
           HERO HEADER (matches index.php)
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

        /* ── HERO SECTION ── */
        .hero {
            position: relative;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 0;
            width: 100%;
            max-width: 1700px;
            margin: 80px auto 10px;
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

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-55%, -50%);
            text-align: center;
            color: white;
            padding: 0 2rem;
            max-width: 800px;
        }

        .hero-content h2 {
            margin-top: -40px;
            margin-left: 60px;
            font-family: 'Montserrat', sans-serif;
            font-size: 3rem;
        }

        .hero-content .subtext {
            text-transform: capitalize;
            transform: translateY(16rem);
            margin-left: 40px;
            font-family: 'modernline - Personal Use', sans-serif;
            font-size: 2rem;
            width: 700px;
            font-weight: 600;
            line-height: 4rem;
        }

        .hero-logo {
            transform: translateY(-3.5rem);
            margin-top: 30px;
            margin-left: 50px;
            width: 210px;
            height: auto;
            margin-bottom: 1rem;
        }

        /* ── GALLERY SECTION ── */
        .gallery-section {
            padding: 5rem 3rem;
            background-color: var(--primary);
            color: var(--textcolor);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            margin: 0 auto;
            max-width: 1400px;
        }

        .section-header {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 1rem;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
            margin-bottom: 3rem;
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
            z-index: 1;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .section-header h2 {
            font-size: 2.5rem;
            margin: 0;
            white-space: nowrap;
            z-index: 1;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .section-header-line {
            height: 1px;
            background-color: var(--textcolor);
            flex-grow: 1;
            opacity: 0;
            transform: scaleX(0);
            transform-origin: left;
            transition: opacity 0.8s ease 0.3s, transform 0.8s ease 0.3s;
        }

        .section-header.active h2 {
            opacity: 1;
            transform: translateY(0);
        }

        .section-header.active .section-header-line {
            opacity: 1;
            transform: scaleX(1);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0;
            max-width: 1500px;
            margin: 0 auto;
            width: 100%;
        }

        .gallery-grid a {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--textcolor);
            padding: 2rem 1rem;
            border-bottom: 1px solid #cccccc;
        }

        .gallery-grid a:nth-child(3n+1) {
            border-right: 1px solid #cccccc;
        }

        .gallery-grid a:nth-child(3n+2) {
            border-right: 1px solid #cccccc;
        }

        .gallery-grid a:nth-child(1),
        .gallery-grid a:nth-child(2),
        .gallery-grid a:nth-child(3) {
            border-top: 1px solid #cccccc;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            height: 400px;
            width: 75%;
        }

        .gallery-grid a:hover .gallery-item {
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            transition: transform 0.6s ease, filter 0.6s ease;
            filter: brightness(0.95) contrast(1.05);
            display: block;
        }

        .gallery-grid a:hover .gallery-img {
            transform: scale(1.04);
            filter: brightness(1);
        }

        .gallery-overlay {
           display: none;
        }

        .gallery-overlay h3 {
            color: var(--textcolor);
            font-size: 0.82rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            line-height: 1.5;
            font-weight: 400;
        }

        .gallery-overlay p {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.72rem;
            color: #888;
            margin-top: 2px;
            letter-spacing: 0.05em;
        }

        /* ── HOVER OVERLAY EFFECT ── */
        .gallery-item .hover-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 2;
        }

        .gallery-item.style-1 .hover-overlay {
            background: rgba(255, 255, 255, 0.92);
        }

        .gallery-item.style-2 .hover-overlay {
            background: radial-gradient(ellipse at center,
                rgba(255,255,255,0.97) 40%,
                rgba(255,255,255,0.6) 100%
            );
            backdrop-filter: blur(4px);
        }

        .gallery-grid a:hover .hover-overlay {
            opacity: 1;
        }

        .hover-overlay-content {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 1rem;
            width: 100%;
            justify-content: center;
        }

        .hover-overlay-content .couple-name {
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            font-size: 0.85rem;
            font-weight: 300;
            color: #2a2a2a;
            letter-spacing: 0.05em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .hover-overlay-content .divider {
            width: 1px;
            height: 40px;
            background-color: #aaa;
            flex-shrink: 0;
        }

        .hover-overlay-content .location-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.8rem;
            font-style: italic;
            color: #555;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .hover-overlay-content .location-text::before {
            content: "✈ ";
            font-style: normal;
            font-size: 0.8rem;
        }

        /* ============================================================
           MEDIA QUERIES
        ============================================================ */

        /* Desktop (1024px+) */
        @media (min-width: 1024px) {
            .hero-header {
                padding: 0.6rem 15%;
            }
            .nav-group-left,
            .nav-group-right {
                gap: 6rem;
            }
            .logo-container .logotitle {
                height: 70px;
            }
        }

        /* Tablets & Mobile (1023px and below) */
        @media (max-width: 1023px) {
            .mobile-menu-btn { display: block; }
            .nav-group-left,
            .nav-group-right { display: none; }

            .hero {
                height: 35vh;
                margin-top: 70px;
                margin-bottom: 0;
            }

            .hero-content {
                display: none;
            }

            .gallery-section {
                padding: 3rem 1.5rem;
                margin-top: 0;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0;
                border-top: 1px solid #cccccc;
                border-left: 1px solid #cccccc;
            }

            .gallery-grid a {
                padding: 1rem 0.5rem;
                border-bottom: 1px solid #cccccc;
                border-right: 1px solid #cccccc;
                border-top: none !important;
                border-left: none !important;
            }

            .gallery-grid a:nth-child(3n+1),
            .gallery-grid a:nth-child(3n+2),
            .gallery-grid a:nth-child(1),
            .gallery-grid a:nth-child(2),
            .gallery-grid a:nth-child(3) {
                border-top: none !important;
                border-left: none !important;
                border-right: 1px solid #cccccc !important;
                border-bottom: 1px solid #cccccc !important;
            }

            .gallery-item {
                height: 300px;
                width: 100%;
            }

            .gallery-overlay {
                display: block;
                width: 100%;
                padding: 0.5rem 0;
            }

            .gallery-overlay h3 {
                font-size: 0.68rem;
                letter-spacing: 0.08em;
                color: var(--textcolor);
                text-transform: uppercase;
                font-family: 'NewYork', 'Cormorant Garamond', serif;
            }

            .gallery-overlay p {
                font-family: 'Montserrat', sans-serif;
                font-size: 0.58rem;
                color: #888;
                margin-top: 2px;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .section-header h2.section-title {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 600px) {
            .gallery-section {
                padding: 2rem 1rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0;
            }

            .gallery-item {
                height: 300px;
                width: 90%;
            }

            .gallery-overlay h3 {
                font-size: 0.65rem;
                letter-spacing: 0.08em;
            }

            .gallery-overlay p {
                font-size: 0.55rem;
            }

            .section-header h2 {
                font-size: 1.5rem;
            }

            .section-header h2.section-title {
                font-size: 1.1rem;
            }

            .logo-container .logotitle {
                height: 36px;
            }
        }
    </style>
</head>
<body>

    <?php include 'nav-mobile.php'; ?>

    <!-- Fixed Header (matches index.php) -->
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
        <button class="mobile-menu-btn" id="mobileMenuBtn">&#9776;</button>
    </div>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <img src="assets/image/portfolio-background.jpeg" alt="Photography" class="hero-image">
        <div class="hero-content">
            <h2 class="subtext">Authenticity, Timeless, Elegance</h2>
            <img src="assets/image/VV-White-color.png" alt="Centered Logo" class="hero-logo">
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section" id="gallery">
        <div class="section-header">
            <h2 class="section-title">the</h2>
            <h2>PORTFOLIO</h2>
            <div class="section-header-line"></div>
        </div>
        
        <div class="gallery-grid">
            <?php
include 'db_connect.php';

$sql = "SELECT id, bride_name, groom_name, location, feature_photo FROM weddings";
$result = $conn->query($sql);

$i = 1;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id       = $row['id'];
        $bride    = htmlspecialchars($row['bride_name']);
        $groom    = htmlspecialchars($row['groom_name']);
        $location = htmlspecialchars($row['location']);
        $photo    = htmlspecialchars($row['feature_photo']);
        $style    = ($i % 2 == 1) ? 'style-1' : 'style-2';
        $i++;
        ?>
        <a href="portfolio-details.php?id=<?= $id ?>">
            <div class="gallery-item <?= $style ?>">
                <img src="assets/image/<?= $photo ?>" alt="<?= $bride ?> + <?= $groom ?>" class="gallery-img">
                <div class="hover-overlay">
                    <div class="hover-overlay-content">
                        <span class="couple-name"><?= strtolower($bride) ?> + <?= strtolower($groom) ?></span>
                        <div class="divider"></div>
                        <span class="location-text"><?= $location ?></span>
                    </div>
                </div>
            </div>
            <div class="gallery-overlay">
                <h3><?= strtolower($bride) ?> + <?= strtolower($groom) ?></h3>
                <p><?= $location ?></p>
            </div>
        </a>
        <?php
    }
} else {
    echo "<p>No weddings found.</p>";
}
$conn->close();
?>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script>
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.hero-header');
            if (header) {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
        });

        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu    = document.getElementById('mobileMenu');
        const overlay       = document.getElementById('overlay');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
                overlay.classList.toggle('active');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                overlay.classList.remove('active');
            });
        }

        if (document.querySelectorAll('.mobile-nav-links a')) {
            document.querySelectorAll('.mobile-nav-links a').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.remove('active');
                    overlay.classList.remove('active');
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('.section-header');
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) header.classList.add('active');
                });
            }, { threshold: 0.3 });
            if (header) observer.observe(header);
        });
    </script>
</body>
</html>