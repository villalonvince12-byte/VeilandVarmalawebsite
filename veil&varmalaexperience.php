<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Experience</title>
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

        /* Desktop enhancement */
        @media (min-width: 1024px) {
            .hero-header { padding: 0.6rem 15%; }
            .nav-group-left,
            .nav-group-right { gap: 6rem; }
            .logo-container .logotitle { height: 70px; }
        }

        /* Tablets & Mobile (≤1023px) */
        @media (max-width: 1023px) {
            .mobile-menu-btn { display: block; }
            .nav-group-left,
            .nav-group-right { display: none; }
        }

        @media (max-width: 600px) {
            .logo-container .logotitle { height: 36px; }
        }

        /* ── HERO SECTION ── */
        .hero {
            position: relative;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 0 50px;
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
            transform: translate(-55%, -55%);
            text-align: center;
            color: white;
            padding: 0 2rem;
            max-width: 800px;
        }

        .hero-content h2 {
            margin-left: 60px;
            font-family: 'Montserrat', sans-serif;
            font-size: 4rem;
            margin-bottom: 5px;
            transform: translateY(20px);
        }

        .hero-logo {
            margin-top: 20px;
            margin-left: 60px;
            width: 60px;
            height: auto;
            margin-bottom: 1rem;
        }

        .hero-logo-about {
            margin-top: -30px;
            margin-left: 60px;
            width: 600px;
            height: auto;
            margin-bottom: 1rem;
            transform: translateY(25px);
        }

        .hero-content .subtext {
            font-family: 'Montserrat', sans-serif;
            font-size: 4em;
            font-weight: 300;
            transform: translateY(-20px);
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

        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .scroll-text {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            margin-bottom: 0.5rem;
            color: white;
        }

        .scroll-line {
            width: 1px;
            height: 50px;
            background: white;
            animation: scrollPulse 2s infinite;
        }

        @keyframes scrollPulse {
            0% { height: 50px; opacity: 1; }
            50% { height: 70px; opacity: 0.5; }
            100% { height: 50px; opacity: 1; }
        }

        /* Mobile hero */
        @media (max-width: 1023px) {
            .hero {
                height: 35vh;
                padding: 0;
                margin-top: 70px;
                margin-bottom: 0;
            }

            .hero-image {
                height: 100%;
                object-fit: cover;
                position: absolute;
            }

            .hero-content {
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 0 1rem;
                max-width: 100%;
            }

            .hero-content h2 {
                font-size: 2.8rem;
                margin-left: -10px;
            }

            .hero-logo {
                width: 40px;
                margin-left: -10px;
            }
        }

        @media (max-width: 480px) {
            .hero {
                height: 25vh;
                margin-top: 60px;
            }
        }

        /* ── THREE ROW SECTION ── */
        .three-row-section {
            background-color: var(--tertiary);
            margin: 10rem auto;
            padding: 3rem 5%;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            height: auto;
        }

        .row { width: 100%; }

        .title-row h2 {
            text-align: center;
            font-size: 2rem;
            font-family: 'Montserrat', sans-serif;
            color: var(--primary);
            letter-spacing: 4px;
            word-spacing: 5px;
        }

        .image-row { text-align: center; }

        .image-row img {
            width: 100%;
            max-width: 800px;
            height: 300px;
            object-fit: cover;
            object-position: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .description-row p {
            font-size: .9rem;
            line-height: 1.7;
            letter-spacing: 1px;
            text-align: center;
            font-family: 'Montserrat', sans-serif;
            color: var(--secondary);
            max-width: 900px;
            margin: 0 auto;
            padding: 0 4rem;
        }

        /* ── JOURNEY SECTION ── */
        .journey-section {
            max-width: 1400px;
            margin: 6rem auto;
            padding: 0 3rem;
        }

        .journey-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .journey-header h2 {
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            font-weight: 100;
            font-size: 3rem;
            transform: translate(-250px, -50px);
            position: relative;
            display: inline-block;
        }

        .journey-header h2::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 100%;
            margin-left: 1rem;
            width: 0;
            height: 1px;
            background-color: black;
            transform: translateY(-50%);
            animation: lineGrow 3s ease-out forwards;
        }

        @keyframes lineGrow {
            from { width: 0; }
            to { width: 500px; }
        }

        .journey-header .cursived-text {
            font-family: 'modernline - Personal Use', sans-serif;
            font-size: 3.2rem;
            transform: translateY(-100px);
            text-transform: lowercase;
            margin-top: -20px;
        }

        .journey-header .divider {
            width: 600px;
            height: 1px;
            background-color: var(--textcolor);
            margin: 0 auto;
        }

        .journey-intro {
            font-family: 'Montserrat', sans-serif;
            text-align: center;
            max-width: 1400px;
            margin: 0 auto 4rem;
            font-size: 1.1rem;
            line-height: 1.7;
            transform: translate(0px, -60px);
            border: 1px solid var(--tertiary);
            padding: 2rem;
            background-color: var(--primary);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .journey-steps {
            transform: translateY(10px);
            display: flex;
            flex-direction: column;
            gap: 4rem;
        }

        .journey-step {
            display: flex;
            align-items: center;
            gap: 4rem;
            opacity: 0;
            animation: slideInLeft 1s ease forwards;
        }

        .journey-step.reverse {
            flex-direction: row-reverse;
            animation: slideInRight 1s ease forwards;
        }

        .journey-image { flex: 1; }

        .journey-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            object-position: center;
        }

        .journey-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .journey-title {
            font-family: 'NewYork', serif;
            line-height: 1.2;
            font-size: 42px;
            color: var(--tertiary);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .journey-description {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            font-size: 16px;
        }

        @keyframes slideInLeft {
            0%   { opacity: 0; transform: translateX(-100px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInRight {
            0%   { opacity: 0; transform: translateX(100px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        .journey-image,
        .journey-content {
            opacity: 0;
            animation-duration: 1s;
            animation-fill-mode: forwards;
            animation-play-state: paused;
        }

        .journey-step .journey-image    { animation-name: slideInLeft; }
        .journey-step .journey-content  { animation-name: slideInRight; animation-delay: 0.3s; }
        .journey-step.reverse .journey-image   { animation-name: slideInRight; }
        .journey-step.reverse .journey-content { animation-name: slideInLeft; animation-delay: 0.3s; }

        @media (max-width: 1024px) {
            .journey-step,
            .journey-step.reverse {
                flex-direction: column;
                gap: 2rem;
            }
            .journey-image,
            .journey-content {
                flex: none;
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .journey-section {
                padding: 0 1.2rem;
                margin: 2rem auto;
            }
            .journey-header { overflow: hidden; padding: 0 1rem; }
            .journey-header h2 {
                transform: none !important;
                position: static !important;
                display: block !important;
                font-size: 1.3rem !important;
                text-align: center !important;
                width: 100% !important;
                white-space: normal;
                word-break: break-word;
            }
            .journey-header h2::after { display: none !important; }
            .journey-header .cursived-text {
                display: inline !important;
                font-size: 1.6rem !important;
                transform: none !important;
                margin-top: 0 !important;
            }
            .journey-intro {
                transform: none !important;
                font-size: 0.9rem;
                padding: 1.2rem;
                margin: 0 0 2rem 0;
            }
            .journey-section:first-of-type { margin-top: 1rem; }
        }

        /* ── FAQ SECTION ── */
        .faq-section {
            padding: 5rem 2rem;
            max-width: 1000px;
            margin: 0 auto;
            margin-top: -5rem;
        }

        .faq-title h2 {
            font-family: 'NewYork', serif;
            font-size: 2.5rem;
            color: var(--tertiary);
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .faq-item { margin-bottom: 1rem; }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            padding: 1rem 0;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            font-size: 1rem;
            color: var(--textcolor);
            text-transform: uppercase;
            letter-spacing: 2px;
            word-spacing: 1px;
        }

        .faq-toggle {
            font-size: 1.5rem;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .faq-answer {
            display: none;
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            color: var(--textcolor);
            max-width: 800px;
            margin: 0.5rem 0 1rem 0;
            line-height: 1.6;
            animation: fadeIn 0.3s ease-in-out;
        }

        .faq-divider {
            height: 1px;
            background: #ccc;
            margin-top: 0.5rem;
            transition: opacity 0.3s ease;
        }

        .faq-item.active .faq-answer  { display: block; }
        .faq-item.active .faq-toggle  { transform: rotate(180deg); }
        .faq-item.active .faq-divider { opacity: 0; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── VALUES SECTION ── */
        .values-section {
            max-width: 1400px;
            margin: 6rem auto;
            padding: 0 3rem;
        }

        .values-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .values-header h2 {
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            font-weight: 100;
            font-size: 3rem;
            display: inline-block;
        }

        .values-cursive {
            font-family: 'modernline - Personal Use', sans-serif;
            font-size: 3.2rem;
            text-transform: lowercase;
        }

        .values-steps {
            display: flex;
            flex-direction: column;
            gap: 6rem;
        }

        .values-step {
            display: flex;
            align-items: center;
            gap: 5rem;
            opacity: 0;
            animation: valuesSlideLeft 1s ease forwards;
            animation-play-state: paused;
        }

        .values-step.reverse {
            flex-direction: row-reverse;
            animation-name: valuesSlideRight;
        }

        .values-image {
            flex: 0 0 380px;
            width: 380px;
        }

        .values-image img {
            width: 100%;
            height: 560px;
            object-fit: cover;
            object-position: center top;
            display: block;
        }

        .values-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            opacity: 0;
            animation-duration: 1s;
            animation-fill-mode: forwards;
            animation-play-state: paused;
        }

        .values-step .values-content          { animation-name: valuesSlideRight; animation-delay: 0.3s; }
        .values-step.reverse .values-content  { animation-name: valuesSlideLeft;  animation-delay: 0.3s; }

        .values-title {
            font-family: 'NewYork', serif;
            font-size: 2.8rem;
            font-weight: 400;
            color: var(--tertiary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            line-height: 1.1;
            margin-bottom: 0.5rem;
        }

        .values-description {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.95rem;
            line-height: 1.8;
            color: var(--textcolor);
        }

        @keyframes valuesSlideLeft {
            0%   { opacity: 0; transform: translateX(-60px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        @keyframes valuesSlideRight {
            0%   { opacity: 0; transform: translateX(60px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        @media (max-width: 1024px) {
            .values-step,
            .values-step.reverse {
                flex-direction: column;
                align-items: center;
                gap: 2rem;
            }
            .values-image {
                flex: none;
                width: 100%;
                max-width: 480px;
                margin: 0 auto;
            }
            .values-image img { height: 520px; width: 100%; }
            .values-content { width: 100%; text-align: left; }
        }

        @media (max-width: 768px) {
            .values-section { padding: 0 1.2rem; margin: 2rem auto; }
            .values-header h2 { font-size: 1.8rem; }
            .values-cursive { font-size: 2rem; }
            .values-steps { gap: 3.5rem; }
            .values-step,
            .values-step.reverse {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.2rem;
            }
            .values-image { width: 100%; max-width: 100%; }
            .values-image img {
                width: 100%;
                height: 460px;
                object-fit: contain;
                object-position: center top;
            }
            .values-title { font-size: 1.8rem; }
            .values-description { font-size: 0.9rem; line-height: 1.7; }
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
        <img src="assets/image/img_68c3ee92073b13.38270232.jpg" alt="Photography" class="hero-image">
    </section>

    <!-- Values Section -->
    <section class="journey-section">
        <div class="journey-header">
            <h2>THE VEIL AND VARMALA <span class="cursived-text">services</span></h2>
        </div>

        <div class="values-steps">

            <div class="values-step">
                <div class="values-image">
                    <img src="assets/image/img_68c3f1270e3269.69480699.jpg" alt="Connection">
                </div>
                <div class="values-content">
                    <h3 class="values-title">Connection</h3>
                    <p class="values-description">CONNECTION is at the heart of everything we do. From scouting locations to refining your wedding day timeline, we collaborate closely with you, your planner, and your venue to ensure every detail is thoughtfully curated. By working hand in hand during the planning process, we create the perfect conditions for stunning imagery, selecting ideal locations and crafting a seamless flow for your day. Our role goes beyond photography; we guide and support you so you can be fully present, savoring every moment. Through intentional collaboration and clear communication, we capture your celebration with authenticity and elegance, preserving memories that feel natural, timeless, and uniquely yours.</p>
                </div>
            </div>

            <div class="values-step reverse">
                <div class="values-image">
                    <img src="assets/image/img_68c3f127126928.26974028.jpg" alt="Authenticity">
                </div>
                <div class="values-content">
                    <h3 class="values-title">Authenticity</h3>
                    <p class="values-description">We approach every moment with intention, capturing the natural beauty and emotion of your wedding day as it unfolds. Our focus is on creating a visual story that is true to you — blending heartfelt, unscripted moments with a modern, editorial sensibility. Beyond crafting stunning imagery, we aim to provide an experience that allows you to be fully present, celebrating your love without distraction. By documenting your day as it naturally happens — without staging or interference — we capture genuine emotions and intimate connections from the perspective of a guest. For couples who value honesty, emotion, and timeless storytelling, we are committed to preserving your wedding day with elegance, care, and heart.</p>
                </div>
            </div>

            <div class="values-step">
                <div class="values-image">
                    <img src="assets/image/img_68c3f1270fb943.75208667.jpg" alt="Quality">
                </div>
                <div class="values-content">
                    <h3 class="values-title">Quality</h3>
                    <p class="values-description">As a husband-and-wife duo, we prioritize quality over quantity in our approach to wedding photography. We are devoted to crafting visual legacies for couples who connect deeply with our vision. By intentionally limiting the number of weddings we accept each season, we ensure our full attention, care, and creative energy are dedicated to capturing each love story with intention. Every moment we photograph is thoughtfully considered — we don't capture randomly, but with purpose, framing each detail and emotion to reflect the true essence of your celebration. Our experience spans a wide range of weddings worldwide, from grand multi-day events to intimate ceremonies at private estates.</p>
                </div>
            </div>

            <div class="values-step reverse">
                <div class="values-image">
                    <img src="assets/image/img_68c3f127197f45.46339112.jpg" alt="Legacy">
                </div>
                <div class="values-content">
                    <h3 class="values-title">Legacy</h3>
                    <p class="values-description">We believe wedding photographs should be more than a collection of images — they should embody the essence of your love and become a lasting part of your family's legacy. Each image is crafted with intention and care, preserving the emotion and beauty of your day so it can be cherished not only by you, but by generations to come.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- The Veil & Varmala Experience Section -->
    <section class="journey-section">
        <div class="journey-header">
            <h2>THE VEIL AND VARMALA <span class="cursived-text">EXPERIENCE</span></h2>
        </div>

        <div class="journey-intro">
            <p>At Veil and Varmala, we don't just document your wedding—we craft a bespoke experience that captures the essence of your love story.</p>
            <p>From your first inquiry to the moment you view your gallery, every detail is handled with care and precision.</p>
            <p>We specialize in preserving the raw emotions and intimate moments of your celebration, creating timeless, artfully composed imagery.</p>
            <p>Our mission is simple: to deliver exceptional photos that not only reflect your love but become a cherished part of your legacy. By blending the elegance of Western traditions with the richness of South Asian culture, we create a sophisticated, editorial narrative that is as timeless as your love.</p>
        </div>
    </section>

    <!-- Pricing & Packages Section -->
    <section class="pricing-section">
        <div class="pricing-parallax" style="background-image: url('assets/image/img_68c2746e0d3285.85603573.jpg');"></div>
        <div class="pricing-card">
            <div class="pricing-title">
                <h2>THE INVESTMENT</h2>
            </div>
            <div class="pricing-subtitle">
                <h3>Tailored Photography Experiences</h3>
            </div>
            <div class="pricing-description">
                <p>Each package is carefully crafted to preserve your unique love story with the artistry and attention it deserves. From intimate elopements to grand celebrations, we offer options to suit every vision and budget.</p>
            </div>
            <div class="pricing-image">
                <img src="assets/image/img_68c2746e0a4de2.90219469.jpg" alt="Wedding Photography Package Example">
            </div>
            <div class="pricing-sub-description">
                <p>Our Package starts at <span style="font-style: italic; color: #74A12E; font-weight: 400">$5,000</span></p>
            </div>
        </div>
    </section>

    <style>
        .pricing-section {
            position: relative;
            min-height: 100vh;
            padding: 6rem 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 4rem 0;
        }
        .pricing-parallax {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            z-index: -1;
            filter: brightness(0.7);
        }
        .pricing-parallax::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(255,255,255,0.4);
        }
        .pricing-card {
            background: var(--primary);
            width: 100%;
            max-width: 1000px;
            padding: 4rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .pricing-title { text-align: center; margin-bottom: 2rem; }
        .pricing-title h2 {
            font-family: 'NewYork', serif;
            font-size: 2.5rem;
            font-weight: 400;
            color: var(--tertiary);
            margin-bottom: 1rem;
        }
        .pricing-subtitle { text-align: center; margin-bottom: 2rem; }
        .pricing-subtitle h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.2rem;
            font-weight: 300;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--textcolor);
        }
        .pricing-description {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 3rem;
        }
        .pricing-description p {
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            line-height: 1.7;
            color: var(--textcolor);
        }
        .pricing-sub-description {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 3rem;
        }
        .pricing-sub-description p {
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            line-height: 1.7;
            color: var(--textcolor);
            text-transform: uppercase;
            margin-bottom: -50px;
        }
        .pricing-image { margin: 0 auto 3rem; max-width: 800px; }
        .pricing-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            object-position: center;
        }
        @media (max-width: 768px) {
            .pricing-section { padding: 4rem 1rem; }
            .pricing-card { padding: 2rem; }
            .pricing-title h2 { font-size: 2rem; }
            .pricing-image img { height: 300px; }
        }
        @media (max-width: 480px) {
            .pricing-title h2 { font-size: 1.8rem; }
            .pricing-subtitle h3 { font-size: 1rem; }
            .pricing-description p { font-size: 0.9rem; }
        }
    </style>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="faq-title">
            <h2>FREQUENTLY ASKED QUESTIONS</h2>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>DO YOU TRAVEL?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">Absolutely. We specialize in destination weddings worldwide and are honored to follow your story wherever it unfolds. All travel expenses will be thoughtfully outlined in your proposal, ensuring a seamless and transparent experience from the very beginning.</div>
            <div class="faq-divider"></div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>DO YOU OFFER DESTINATION DISCOUNTS?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">Yes. We offer exclusive rates for weddings in Italy, Greece, Hawaii, Bora Bora, Spain, Canada and locations we are especially passionate about photographing.</div>
            <div class="faq-divider"></div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>DO YOU PROVIDE PRINTS OR ALBUMS?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">Yes! We offer heirloom-quality albums and fine art prints to preserve your memories beautifully. An album gallery will be a separate add-on on top your collection.</div>
            <div class="faq-divider"></div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>DO YOU HELP IN THE PLANNING PROCESS?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">Absolutely! We have done many weddings, so we know the industry very well. Let us know what you need help with if you need recommendations, and if there is anything we can do to make the process easier for you.</div>
            <div class="faq-divider"></div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>DO YOU DELIVER RAW PHOTOS?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">We do not provide RAW images. Every photograph delivered is carefully edited to ensure consistency in color, lighting, and tone, reflecting the signature style and quality of our work.</div>
            <div class="faq-divider"></div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>DO YOU PHOTOSHOP YOUR CLIENTS?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">Our photography celebrates love, authenticity, and the beauty of being yourself. We believe in honoring who you truly are, which means we do not alter appearances beyond minor touch-ups such as temporary blemishes or acne. We don't use Photoshop to change what makes you uniquely you. If there's something you feel self-conscious about, we encourage you to share it with us, we'll approach it with sensitivity and care while ensuring you feel confident and comfortable in front of the camera.</div>
            <div class="faq-divider"></div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>HOW DO WE BOOK YOU?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">Once the agreement is signed, a 50% retainer is required to secure your wedding date and events. The remaining balance will be due one month prior to your first day of the event.</div>
            <div class="faq-divider"></div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>HOW DO WE RECEIVE OUR PHOTOS?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">Once your images are fully edited, they will be delivered through a private, password-protected online gallery. You'll receive the link via email, allowing you to easily share it with family and friends. From your gallery, you can view, download, print, and enjoy your photographs in full resolution. Your images will remain available online for one year, and we'll also provide a USB copy as a secure, lasting backup.</div>
            <div class="faq-divider"></div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>WHERE ARE YOU LOCATED?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">We are based in San Francisco, California, though our work takes us across the globe. From intimate local gatherings to grand destination celebrations, we photograph wherever love calls.</div>
            <div class="faq-divider"></div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>WHEN WILL WE RECEIVE OUR PHOTOS?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">We edit several sneak peek photos to post on social media and your full gallery will be delivered within 6 weeks after the wedding.</div>
            <div class="faq-divider"></div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>WHAT RIGHTS DO WE HAVE?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">You have all rights to download, print, and use your images for personal purposes.</div>
            <div class="faq-divider"></div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>WHAT IF WE NEED TO CANCEL/RESCHEDULE OUR WEDDING?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">The retainer is a non-refundable payment required, along with a signed agreement, to officially secure your date and our services. Once received, your wedding date is exclusively reserved for you. In the event of a cancellation, the retainer will be forfeited. Please note that retainers are non-transferable to other dates or clients.</div>
            <div class="faq-divider"></div>
        </div>

        <div class="faq-item">
            <div class="faq-question"><span>I HAVE DOWNTIME BETWEEN EVENTS ON MY WEDDING DAY. WILL I BE CHARGED FOR THAT DOWNTIME?</span><span class="faq-toggle">+</span></div>
            <div class="faq-answer">For many reasons, we have to charge for the time in between events. The fact is, we're never truly resting during the day, whether we're backing up images, setting up for the second venue, traveling to the second location, taking venue shots, or making up for lost photo time because of unforeseen wedding day delays. In many cases, we use that "downtime" to take you and your significant other out for a photo session or more family portraits.</div>
            <div class="faq-divider"></div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script>
        // FAQ toggle
        document.querySelectorAll(".faq-question").forEach(question => {
            question.addEventListener("click", () => {
                const faqItem = question.parentElement;
                faqItem.classList.toggle("active");
                const toggle = faqItem.querySelector(".faq-toggle");
                toggle.textContent = faqItem.classList.contains("active") ? "-" : "+";
            });
        });

        // Mobile menu
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
                if (mobileMenu) mobileMenu.classList.remove('active');
                if (overlay) overlay.classList.remove('active');
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Values step animations
            const valueSteps = document.querySelectorAll('.values-step');
            const valuesObserver = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const image   = entry.target.querySelector('.values-image');
                        const content = entry.target.querySelector('.values-content');
                        if (image)   image.style.animationPlayState   = 'running';
                        if (content) content.style.animationPlayState = 'running';
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, { threshold: 0.2 });
            valueSteps.forEach(step => valuesObserver.observe(step));

            // Journey step animations
            const journeySteps = document.querySelectorAll('.journey-step');
            const journeyObserver = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const image   = entry.target.querySelector('.journey-image');
                        const content = entry.target.querySelector('.journey-content');
                        if (image)   image.style.animationPlayState   = 'running';
                        if (content) content.style.animationPlayState = 'running';
                        entry.target.style.opacity = 1;
                    }
                });
            }, { threshold: 0.2 });
            journeySteps.forEach(step => journeyObserver.observe(step));
        });
    </script>

</body>
</html>