<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meet the Artists | Veil & Varmala</title>
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

        @font-face {
            font-family: 'Numea';
            src: url('assets/fonts/numea-demo/Numea DEMO.otf') format('opentype');
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
           HERO HEADER (desktop nav)
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
            height: 55px;
            width: auto;
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

        /* ============================================================
           MOBILE MENU
        ============================================================ */
        .mobile-menu {
            position: fixed;
            top: 0;
            left: -100%;
            width: 70%;
            height: 100vh;
            background: var(--primary);
            z-index: 999;
            transition: 0.3s ease;
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .mobile-menu.active {
            left: 0;
        }

        .mobile-nav-links {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .mobile-nav-links a {
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            font-weight: 300;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(51,51,51,0.1);
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.6);
            z-index: 998;
        }

        .overlay.active {
            display: block;
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
            padding: 0 50px;
            margin-top: 70px;
            width: 100%;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 10px;
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
            transform: translate(-55%, -45%);
            text-align: center;
            color: white;
            padding: 0 2rem;
            max-width: 800px;
        }

        .hero-content h2 {
            margin-top: -40px;
            margin-left: 60px;
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            font-size: 4rem;
            margin-bottom: 35px;
        }

        .hero-logo-about {
            margin-top: -30px;
            margin-left: 60px;
            width: 600px;
            height: auto;
            margin-bottom: 1rem;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 300;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            font-weight: 300;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            margin-bottom: 3rem;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        }

        /* ============================================================
           TEAM SECTION
        ============================================================ */
        .team-modern {
            background-color: var(--tertiary);
            padding: 4rem 5%;
            position: relative;
            z-index: 1;
            overflow: hidden;
            height: auto;
            margin-top: 0;
            padding-top: 200px;
        }

        .team-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .team-subtitle {
            font-family: 'modernline - Personal Use', sans-serif;
            font-size: 1.3rem;
            color: var(--secondary);
            margin-bottom: 0.2rem;
            font-weight: 300;
        }

        .team-title {
            font-size: 2rem;
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            font-weight: 400;
            color: var(--primary);
            letter-spacing: 4px;
        }

        .team-container {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: center;
            max-width: 2000px;
            margin: 0 auto;
            gap: 100px;
        }

        .team-card {
            flex: 0 0 420px;
            width: 420px;
        }

        .team-image {
            position: relative;
            width: 100%;
            height: 560px;
        }

        .team-image img {
            position: absolute;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .team-image img:hover {
            transform: scale(1.02);
        }

        .ejandsarah-img {
            width: 100%;
            height: 55%;
            left: -20%;
            top: 20%;
            z-index: 2;
            object-position: center top;
        }

        .ej-img {
            width: 45%;
            height: 100%;
            right: -1%;
            top: -5%;
            z-index: 1;
            object-position: center top;
        }

        .sarah-img {
            width: 100%;
            height: 40%;
            right: -30%;
            bottom: -5%;
            z-index: 3;
            object-position: center top;
        }

        .team-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 16px;
            color: var(--primary);
            padding-top: 1rem;
        }

        .team-title-row h3 {
            font-size: 2rem;
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            font-weight: 300;
            color: var(--primary);
            line-height: 1.2;
            margin: 0;
        }

        .x-symbol {
            font-family: 'Numea', sans-serif;
            text-transform: lowercase;
            font-size: 1.8rem;
            margin: 0 0.4rem;
            position: relative;
            top: -0.2rem;
        }

        .team-name-row p {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--secondary);
            margin: 0;
        }

        .team-divider {
            width: 50px;
            height: 1px;
            background-color: var(--secondary);
            margin: 0;
        }

        .team-bio-row p {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.82rem;
            line-height: 1.85;
            color: rgba(255,255,255,0.78);
            margin: 0;
            text-align: left;
        }

        .team-bio-individual {
            border-left: 2px solid var(--secondary);
            padding-left: 1rem;
        }

        .team-bio-individual h4 {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.72rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--secondary);
            margin: 0 0 6px 0;
            font-weight: 500;
        }

        .team-button-row {
            margin-top: 8px;
        }

        .team-btn {
            display: inline-block;
            padding: 0.7rem 2rem;
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--secondary);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.78rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0;
        }

        .team-btn:hover {
            background-color: var(--secondary);
            color: var(--tertiary);
        }

        /* ============================================================
           THREE ROW SECTION
        ============================================================ */
        .three-row-section {
            background-color: var(--secondary);
            padding: 4rem 5%;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            height: auto;
            margin: 0;
        }

        .row { width: 100%; }

        .title-row h2 {
            font-family: 'NewYork', serif;
            font-weight: 100;
            text-align: center;
            font-size: 3rem;
            color: var(--tertiary);
            letter-spacing: 4px;
        }

        .image-row { text-align: center; }

        .image-row img {
            width: 100%;
            max-width: 800px;
            height: 300px;
            object-fit: cover;
            object-position: center;
        }

        .description-row p {
            font-size: 1rem;
            line-height: 1.8;
            letter-spacing: 0.5px;
            text-align: center;
            font-family: 'Montserrat', sans-serif;
            color: var(--tertiary);
            max-width: 800px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* ============================================================
           CTA SECTION
        ============================================================ */
        .cta-section {
            text-align: center;
            padding: 5rem 3rem;
            background-color: var(--primary);
            margin: 0;
        }

        .cta-button {
            display: inline-block;
            padding: 1rem 2.5rem;
            background-color: var(--tertiary);
            color: var(--primary);
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 2rem;
            transition: all 0.3s ease;
        }

        .cta-button:hover { background-color: var(--sage); }

        /* ============================================================
           MEDIA QUERIES
        ============================================================ */

        /* ── Desktop (1024px+) ── */
        @media (min-width: 1024px) {
            .hero-header { padding: 0.6rem 15%; }
            .nav-group-left, .nav-group-right { gap: 6rem; }
            .logo-container .logotitle { height: 70px; }
        }

        /* ── Tablets & Mobile (1023px and below) ── */
        @media (max-width: 1023px) {

            /* Show hamburger, hide nav links */
            .mobile-menu-btn { display: block; }
            .nav-group-left, .nav-group-right { display: none; }

            /* Hero */
            .hero {
                height: 70vh;
                padding: 0 15px;
                margin: 70px auto 20px auto;
            }

            .hero-image {
                filter: brightness(0.7);
                height: 100%;
                width: 100%;
            }

            .hero-content {
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 0 1rem;
                max-width: 90%;
                text-align: center;
            }

            .hero-content h2 {
                font-weight: 500;
                font-size: 2.5rem;
                margin: 0 0 1rem 0;
                font-family: 'modernline - Personal Use', sans-serif;
                text-transform: capitalize;
            }

            .hero-logo-about { display: none; }

            /* Team section */
            .team-modern {
                padding: 3rem 1.25rem;
                margin-top: 0;
                padding-top: 3rem;
            }

            .team-header { margin-bottom: 2rem; }
            .team-subtitle { font-size: 1.1rem; }
            .team-title { font-size: 1.6rem; letter-spacing: 3px; }

            .team-container {
                flex-direction: column;
                align-items: center;
                gap: 2rem;
            }

            .team-card {
                flex: none;
                width: 100%;
                max-width: 360px;
            }

            .team-image { height: 360px; }

            .ejandsarah-img {
                width: 55%;
                height: 78%;
                left: -5%;
                top: 20%;
                z-index: 2;
            }

            .ej-img {
                width: 48%;
                height: 46%;
                right: 9%;
                top: 0;
                z-index: 1;
            }

            .sarah-img {
                width: 45%;
                height: 42%;
                right: 10%;
                bottom: 0;
                z-index: 3;
            }

            .team-details {
                width: 100%;
                align-items: center;
                text-align: center;
                gap: 14px;
                padding-top: 0;
            }

            .team-title-row h3 { font-size: 1.8rem; text-align: center; }
            .team-name-row p { text-align: center; font-size: 0.72rem; }
            .team-divider { width: 40px; margin: 0 auto; }
            .team-bio-row { width: 100%; }
            .team-bio-row p { font-size: 0.84rem; text-align: center; line-height: 1.75; }

            .team-bio-individual {
                border-left: none;
                border-top: 1px solid var(--secondary);
                padding-left: 0;
                padding-top: 0.75rem;
                text-align: center;
            }

            .team-bio-individual h4 { text-align: center; font-size: 0.68rem; }
            .team-button-row { text-align: center; width: 100%; }
            .team-btn { display: block; max-width: 260px; text-align: center; margin: 0 auto; }

            /* Three row section */
            .three-row-section { padding: 3rem 1.25rem; gap: 1.5rem; }
            .title-row h2 { font-size: 2rem; letter-spacing: 3px; }
            .image-row img { height: 200px; }
            .description-row p { font-size: 0.88rem; text-align: center; padding: 0 0.5rem; }

            /* CTA */
            .cta-section { padding: 3rem 1.25rem; }
            .cta-button { display: block; width: 100%; text-align: center; padding: 1rem; }

            /* Gallery section */
            .gallery-section { transform: translateY(0); }

            .gallery-section .gallery-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 0.4rem;
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }

            .gallery-section .gallery-grid > * {
                width: 100%;
                height: 200px;
                overflow: hidden;
                position: relative;
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                display: block;
            }

            .gallery-section .gallery-grid .gallery-item {
                width: 100%;
                height: 100%;
                position: relative;
            }

            .gallery-section .gallery-grid .gallery-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .gallery-section {
                margin-left: 5px !important;
                margin-right: 5px !important;
                padding-left: 5px !important;
                padding-right: 5px !important;
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

        /* ── Small Mobile (480px and below) ── */
        @media (max-width: 480px) {
            .hero { height: 55vh; }
            .hero-content h2 { font-size: 2rem; }
            .team-image { height: 300px; }
            .team-title-row h3 { font-size: 1.6rem; }
            .title-row h2 { font-size: 1.75rem; }
            .logo-container .logotitle { height: 36px; }
        }

    </style>
</head>
<body>

    <?php include 'nav-mobile.php'; ?>

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

    <!-- Team Section -->
    <section class="team-modern" id="meet-the-team">
        <div class="team-header">
            <h2 class="team-title">THE ARTISTS</h2>
        </div>

        <div class="team-container">
            <div class="team-card">
                <div class="team-image">
                    <img src="assets/image/ej.jpg" alt="EJ" class="ej-img">
                    <img src="assets/image/teampicture.jpg" alt="EJ and Sarah" class="ejandsarah-img">
                    <img src="assets/image/sarah.jpg" alt="Sarah" class="sarah-img">
                </div>
            </div>

            <div class="team-details">

                <div class="team-title-row">
                    <h3>EJ <span class="x-symbol" style="font-family:'Numea',sans-serif;text-transform:lowercase;font-size:2rem;margin-right:.5rem;position:relative;top:-.2rem;">x</span> SARAH</h3>
                </div>

                <div class="team-name-row">
                    <p>The storytellers behind the lens</p>
                </div>

                <div class="team-divider"></div>

                <div class="team-bio-row">
                    <p>Every love story deserves to be preserved with beauty, intention, and quiet sophistication. For us, wedding photography is more than a craft—it is a calling rooted in purpose. We are drawn to the harmony of refined elegance and honest emotion—the grandeur of tradition, the in-between moments, and the rich cultural rituals that define South Asian weddings—the quiet beauty revealed when two lives become one. Through Veil & Varmala, our promise is to honor your story with imagery that is both timeless and enduring—photographs that feel artfully composed, yet remain deeply authentic.</p>
                </div>

                <div class="team-bio-row team-bio-individual">
                    <h4>EJ</h4>
                    <p>With nearly six years behind the lens, I have had the privilege of documenting weddings across the globe—from the iconic streets of New York, Italy, Cancun, Cabo, Paris, and Iceland. Wherever love leads, I follow with intention and purpose. As lead photographer, I am devoted to capturing each couple's story with an editorial sensibility and timeless elegance. Every image is crafted to reveal authentic emotion, fleeting details, and the quiet moments that make a wedding truly unforgettable, photographs that feel both artful and enduring, worthy of your most cherished memories.</p>
                </div>

                <div class="team-bio-row team-bio-individual">
                    <h4>Sarah</h4>
                    <p>Sarah brings a thoughtful, detail-driven approach to every wedding she documents. With a deep passion for documentary storytelling, she is drawn to the subtle, meaningful moments the quiet glances, intricate details, and genuine emotions that often unfold in between. Beyond her artistry, Sarah is known for the care and intention she brings to each couple's experience. She is deeply committed to serving not only the couple, but their families as well, ensuring everyone feels seen, comfortable, and supported throughout the day. Always going above and beyond, Sarah's presence is both calming and attentive—allowing moments to unfold naturally while preserving them with honesty and grace.</p>
                </div>

                <div class="team-button-row">
                    <a href="inquire.php" class="team-btn">Contact Us →</a>
                </div>

            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="three-row-section">
        <div class="row title-row">
            <h2>OUR STORIES</h2>
        </div>
        <div class="row image-row">
            <img src="assets/image/img_68c3f21af0e1d3.28261813.jpg" alt="About us image">
        </div>
        <div class="row description-row">
            <p>
                Every frame is a love letter. Every love letter, eternal.

                At Veil & Vermala, we believe your wedding is more than a day, it is a living story, woven from
                moments of intimacy, tradition, and unspoken emotion.
                We do not simply take photographs; we capture the soul of your love. The way your fingers
                instinctively find each other. The laughter that bursts between vows. The tears you didn't expect
                to fall.

                Whether framed by the delicate lace of a veil or the sacred garland of a vermala, your story is
                told with devotion, intention, and an artist's eye. Every image becomes a chapter in your legacy,
                allowing you to step back into the golden light, hear the echoes of your vows, and feel it all over
                again.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script>
        // Mobile menu
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('overlay');

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

        document.querySelectorAll('.mobile-nav-links a').forEach(link => {
            link.addEventListener('click', function() {
                if (mobileMenu) mobileMenu.classList.remove('active');
                if (overlay) overlay.classList.remove('active');
            });
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>

</body>
</html>