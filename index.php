<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veil and Varmala</title>
    <?php include 'icon.php'; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/modernline-personal-use" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

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
           NAVIGATION (Legacy — kept for backward compat)
        ============================================================ */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 2rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            transition: all 0.5s ease;
        }

        nav.scrolled {
            background-color: rgba(248, 245, 242, 0.9);
            padding: 1rem 3rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 500;
            letter-spacing: 0.1em;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
        }

        .nav-links a {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8rem;
            font-weight: 300;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: var(--textcolor);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
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
            height: 80vh;
            min-height: 650px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .hero-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .hero-container .image-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.35);
            z-index: 1;
        }

        .hero-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .hero-container img.active {
            opacity: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            padding: 0 2rem;
            max-width: 1400px;
            width: 100%;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero-logo {
            max-width: 500px;
            width: 80%;
            height: auto;
            margin-bottom: 0.5rem;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.4));
        }

        .hero-logo-v {
            max-width: 60px;
            width: 10%;
            height: auto;
            margin-bottom: 0.5rem;
        }

        .estd-container {
            text-align: center;
            margin-bottom: 1rem;
        }

        .estd-text {
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            color: #fff;
            font-weight: 500;
            letter-spacing: 3px;
        }

        .hero h2 {
            font-size: 2.8rem;
            font-weight: 300;
            margin: 0.8rem 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            letter-spacing: 0.1em;
        }

        .hero p {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            margin-top: 0.3rem;
            position: relative;
            display: inline-block;
            padding: 0 1rem;
        }

        .hero p::before,
        .hero p::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 60px;
            height: 1px;
            background: #ccc;
        }

        .hero p::before { left: -66px; }
        .hero p::after  { right: -64px; }

        .timeless {
            font-family: 'modernline - Personal Use', sans-serif;
            text-transform: lowercase;
            font-weight: lighter;
            font-size: 1.2rem;
            margin-right: 4px;
            margin-left: 4px;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 4;
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
            0%   { height: 50px; opacity: 1; }
            50%  { height: 70px; opacity: 0.5; }
            100% { height: 50px; opacity: 1; }
        }

        /* ============================================================
           BUTTON
        ============================================================ */
        .primary-button {
            font-family: 'Ropa Sans', sans-serif;
            color: var(--textcolor);
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 0.05rem;
            border: 1px solid #0E1822;
            padding: 0.8rem 2.1rem;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 531.28 200'%3E%3Cdefs%3E%3Cstyle%3E .shape %7B fill: %23333333 %7D %3C/style%3E%3C/defs%3E%3Cg id='Layer_2' data-name='Layer 2'%3E%3Cg id='Layer_1-2' data-name='Layer 1'%3E%3Cpolygon class='shape' points='415.81 200 0 200 115.47 0 531.28 0 415.81 200' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E%0A");
            background-color: #A4BAA1;
            background-size: 200%;
            background-position: 200%;
            background-repeat: no-repeat;
            transition: 0.3s ease-in-out;
            transition-property: background-position, border, color;
            position: relative;
            z-index: 1;
        }

        .primary-button:hover {
            border: 1px solid #A4BAA1;
            color: white;
            background-position: 40%;
        }

        .primary-button::before {
            content: "";
            position: absolute;
            background-color: #0E1822;
            width: 0.2rem;
            height: 0.2rem;
            top: -1px;
            left: -1px;
            transition: background-color 0.15s ease-in-out;
        }

        .primary-button:hover::before,
        .primary-button:hover::after {
            background-color: white;
        }

        .primary-button::after {
            content: "";
            position: absolute;
            background-color: #C7A8A3;
            width: 0.3rem;
            height: 0.3rem;
            bottom: -1px;
            right: -1px;
            transition: background-color 0.15s ease-in-out;
        }

        .button-borders {
            position: relative;
            width: fit-content;
            height: fit-content;
            margin: 0 auto;
            display: flex;
            justify-content: center;
        }

        .button-borders::before {
            content: "";
            position: absolute;
            width: calc(100% + 0.5em);
            height: 50%;
            left: -0.3em;
            top: -0.3em;
            border: 1px solid #0E1822;
            border-bottom: 0;
        }

        .button-borders::after {
            content: "";
            position: absolute;
            width: calc(100% + 0.5em);
            height: 50%;
            left: -0.3em;
            bottom: -0.3em;
            border: 1px solid #0E1822;
            border-top: 0;
            z-index: 0;
        }

        .shape { fill: #0E1822; }

        /* ============================================================
           ABOUT SECTION
        ============================================================ */
        .about {
            background-color: var(--secondary);
            background-repeat: repeat;
            background-blend-mode: overlay;
            padding: 8rem 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            position: relative;
        }

        .about-heading {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
        }

        .about-heading h2 {
            font-size: 2rem;
            margin: 0;
            white-space: nowrap;
            top: -160px;
            position: relative;
            z-index: 1;
        }

        .heading-line {
            height: 1px;
            background-color: var(--textcolor);
            flex-grow: 1;
            top: -155px;
            position: relative;
        }

        .about-content {
            max-width: 1200px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .about-text {
            text-align: center;
        }

        .about-text p {
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            line-height: 1.8;
            text-align: justify;
        }

        .about-image {
            position: relative;
            height: 500px;
        }

        .about-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(20%) contrast(0.9);
        }

        .img-border {
            position: absolute;
            width: calc(100% - 30px);
            height: calc(100% - 30px);
            border: 1px solid var(--taupe);
            top: 15px;
            left: 15px;
            z-index: -1;
        }

        /* ============================================================
           GALLERY SECTION
        ============================================================ */
        .gallery-section {
            padding: 8rem 3rem;
            background-color: var(--primary);
            color: var(--textcolor);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            position: relative;
        }

        .gallery-section::before,
        .gallery-section::after {
            content: "";
            position: absolute;
            left: 0;
            width: 100%;
            height: 100px;
            z-index: 1;
            pointer-events: none;
        }

        .gallery-section::before {
            top: 0;
            background: linear-gradient(to bottom, white, transparent);
        }

        .gallery-section::after {
            bottom: 0;
            background: linear-gradient(to top, white, transparent);
        }

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

        .section-header.active h2 {
            opacity: 1;
            transform: translateY(0);
        }

        .section-header.active .section-header-line {
            opacity: 1;
            transform: scaleX(1);
        }

        .gallery-cards {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 5rem;
            margin-top: 5rem;
        }

        .category {
            position: relative;
            width: 350px;
            height: 450px;
            cursor: pointer;
            text-align: center;
        }

        .category .card {
            width: 350px;
            height: 450px;
            position: absolute;
            transition: transform 0.6s cubic-bezier(0.25, 0.1, 0.25, 1);
            box-shadow: 0px 0px 30px -10px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border-radius: 0;
        }

        .card {
            transition: transform 0.4s ease, opacity 0.4s ease;
            cursor: pointer;
        }

        .card.moving { opacity: 0.6; }
        .card.swap   { z-index: 1; }

        .category .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
        }

        .category-title {
            position: absolute;
            bottom: -40px;
            width: 100%;
            font-size: 1.4rem;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .category-title a {
            position: relative;
            text-decoration: none;
            color: #333;
            transition: color 0.3s ease;
        }

        .category-title a::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            left: 0;
            bottom: -5px;
            background-color: #ff4c60;
            transition: width 0.3s ease;
        }

        .category-title a:hover { color: #ff4c60; }
        .category-title a:hover::after { width: 100%; }

        .category.active .card:nth-child(1) { transform: translateX(-150px) rotate(-15deg); }
        .category.active .card:nth-child(2) { transform: translateX(-50px) rotate(-8deg); }
        .category.active .card:nth-child(3) { transform: translateX(50px) rotate(8deg); }
        .category.active .card:nth-child(4) { transform: translateX(150px) rotate(15deg); }

        /* ============================================================
           TESTIMONIALS SECTION
        ============================================================ */
        .testimonials {
            position: relative;
            padding: 8rem 3rem;
            text-align: center;
            overflow: hidden;
            background-color: white;
            z-index: 2;
        }

        .testimonials::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(to bottom, white, transparent);
            z-index: 1;
            pointer-events: none;
        }

        .testimonial-slider {
            max-width: 800px;
            margin: 0 auto;
        }

        .testimonial {
            display: none;
            animation: fade 1s ease;
        }

        @keyframes fade {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        .testimonial.active { display: block; }

        .testimonial-text {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            font-style: italic;
            margin-bottom: 2rem;
            line-height: 1.8;
        }

        .testimonial-author {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            letter-spacing: 0.1em;
        }

        .testimonial-nav {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 3rem;
        }

        .testimonial-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--tertiary);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .testimonial-dot.active { background: var(--secondary); }

        .testimonials-header {
            text-align: center;
            margin-bottom: 3rem;
            margin-top: -4rem;
        }

        .testimonials-title {
            font-family: 'modernline - Personal Use', sans-serif;
            font-size: 1.5rem;
            color: var(--tertiary);
            margin: 0;
            line-height: 1;
        }

        .testimonials-main-title {
            font-size: 2.75rem;
            font-weight: 500;
            color: var(--tertiary);
            margin: 0;
            line-height: 1.2;
        }

        .testimonials-header-line {
            height: 1px;
            background-color: var(--tertiary);
            width: 80px;
            margin: 0 0 0 53.2rem;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 1s ease-out;
        }

        .testimonials-header-line.active { transform: scaleX(1); }

        /* ============================================================
           CONTACT SECTION
        ============================================================ */
        .contact {
            padding: 8rem 3rem;
            background-color: var(--sage);
            color: var(--textcolor);
        }

        .contact-container {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
        }

        .contact-info h2 { font-size: 2.5rem; margin-bottom: 2rem; }
        .contact-details { margin-bottom: 3rem; }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .contact-icon { margin-right: 1rem; font-size: 1.2rem; }

        .social-links { display: flex; gap: 1.5rem; }

        .social-link {
            font-size: 1.3rem;
            transition: transform 0.3s ease;
        }

        .social-link:hover { transform: translateY(-3px); }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(51,51,51,0.2);
            background: transparent;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: var(--textcolor);
        }

        .contact-form textarea { height: 150px; resize: none; }

        .submit-btn {
            background: var(--textcolor);
            color: var(--primary);
            border: none;
            padding: 1rem 2rem;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover { background: var(--dusty-rose); color: var(--textcolor); }

        /* ============================================================
           FEATURED GALLERY SECTION
        ============================================================ */
        .featured-gallery {
            background-color: var(--primary);
            padding: 8rem 3rem;
            position: relative;
            text-align: center;
            overflow: hidden;
        }

        .featured-gallery::before,
        .featured-gallery::after {
            content: "";
            position: absolute;
            left: 0;
            width: 100%;
            height: 100px;
            z-index: 1;
            pointer-events: none;
        }

        .featured-gallery::before {
            top: 0;
            background: linear-gradient(to bottom, rgba(255,255,255,1), transparent);
        }

        .featured-gallery::after {
            bottom: 0;
            background: linear-gradient(to top, rgba(255,255,255,1), transparent);
        }

        .featured-header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .3rem;
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .featured-header.active {
            opacity: 1;
            transform: translateY(0);
        }

        .featured-subtitle {
            font-family: 'modernline - Personal Use', sans-serif;
            font-size: 1.5rem;
            margin: 0;
            white-space: nowrap;
            position: relative;
            top: -80px;
            z-index: 1;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
            color: var(--textcolor);
        }

        .featured-title {
            font-size: 3rem;
            margin: 0;
            white-space: nowrap;
            position: relative;
            top: -80px;
            z-index: 1;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
            color: var(--textcolor);
        }

        .featured-header-line {
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

        .featured-header.active .featured-subtitle,
        .featured-header.active .featured-title {
            opacity: 1;
            transform: translateY(0);
        }

        .featured-header.active .featured-header-line {
            opacity: 1;
            transform: scaleX(1);
        }

        .featured-heading {
            font-size: 2.5rem;
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            color: var(--textcolor);
            margin-bottom: 3rem;
            letter-spacing: 0.1em;
        }

        .featured-grid {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .featured-grid img {
            width: 300px;
            height: 500px;
            object-fit: cover;
            border-radius: 0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .featured-grid img:hover {
            transform: scale(1.03);
            box-shadow: 0 12px 25px rgba(0,0,0,0.2);
        }

        .featured-btn {
            font-family: 'Montserrat', sans-serif;
            display: inline-block;
            margin-top: 3rem;
            padding: 0.75rem 2rem;
            background-color: transparent;
            color: var(--textcolor);
            border: 2px solid var(--textcolor);
            width: 300px;
            border-radius: 0;
            font-size: 1rem;
            letter-spacing: 0.05em;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .featured-btn:hover {
            background-color: var(--tertiary);
            color: #fff;
            border-color: var(--textcolor);
        }

        .featured-grid img:nth-child(1),
        .featured-grid img:nth-child(3) {
            border-radius: 0;
            pointer-events: none;
        }

        .featured-grid img:nth-child(1):hover,
        .featured-grid img:nth-child(3):hover {
            transform: none !important;
            box-shadow: none !important;
        }

        .featured-grid img:nth-child(1) {
            border-bottom-left-radius: 100px;
            border-top-left-radius: 100px;
        }

        .featured-grid img:nth-child(3) {
            border-top-right-radius: 100px;
            border-bottom-right-radius: 100px;
        }

        .featured-grid img:nth-child(2) {
            width: 400px;
            height: 400px;
            object-fit: cover;
            border-radius: 0%;
            z-index: 1;
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        .featured-image-wrapper {
            position: relative;
            width: 500px;
            height: 550px;
            border-radius: 0%;
            overflow: hidden;
            z-index: 1;
        }

        .featured-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0;
            display: block;
            z-index: 1;
        }

        .featured-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 550px;
            height: 550px;
            background-color: #C3B8AC;
            border-radius: 0%;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.4s ease;
            transform: translate(-50%, -50%);
            z-index: 2;
            pointer-events: none;
        }

        .featured-image-wrapper:hover .featured-overlay { opacity: 1; }

        .overlay-content {
            margin-left: 40px;
            color: #fff;
            text-align: center;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1rem;
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            z-index: 3;
            pointer-events: auto;
        }

        .overlay-content .wedding-date  { margin-top: -20px; }
        .overlay-content .wedding-venue { margin-top: 20px; }

        .vertical-line {
            width: 1px;
            height: 100px;
            background-color: #fff;
        }

        /* ============================================================
           TEAM SECTION
        ============================================================ */
        .team-modern {
            background-color: var(--tertiary);
            padding: 6rem 5% 4rem;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .team-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .team-subtitle {
            font-family: 'modernline - Personal Use', sans-serif;
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: -10px;
        }

        .team-title {
            font-size: 2.75rem;
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            font-weight: 700;
            color: var(--primary);
        }

        .team-container {
            height: 750px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
            margin-right: 150px;
        }

        .team-card {
            display: flex;
            flex-direction: row;
        }

        .team-image {
            margin-top: -10px;
            width: 500px;
            height: 700px;
        }

        .team-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .team-details {
            flex: 2;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            text-align: left;
            color: var(--primary);
            padding-right: 13.2rem;
            padding-left: 70px;
        }

        .team-title-row h3 {
            font-size: 4.5rem;
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            margin: 0;
        }

        .team-divider {
            width: 400px;
            height: 2px;
            background-color: var(--primary);
            margin: 0.5rem 0;
            align-self: flex-start;
        }

        .team-name-row p {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.7rem;
            margin: 0;
            word-spacing: .3rem;
            letter-spacing: 1px;
        }

        .team-bio-row p {
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            line-height: 1.5;
            margin: 0;
            text-align: justify;
            word-spacing: .2rem;
            margin-bottom: 10px;
        }

        .team-button-row .team-btn {
            width: 420px;
            display: inline-block;
            padding: 0.3rem 1rem;
            background-color: var(--primary);
            color: var(--tertiary);
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }

        .team-button-row .team-btn:hover { color: var(--dusty-rose); }

        .team-featured-row {
            font-family: 'Montserrat', sans-serif;
            letter-spacing: .2rem;
            font-style: italic;
            font-size: 1.3rem;
            color: var(--primary);
        }

        /* ============================================================
           CINEMA SLIDER
        ============================================================ */
        .cinema-slider-container {
            position: relative;
            width: 100%;
            height: 90vh;
            overflow: hidden;
        }

        .cinema-slider {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .cinema-slide {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            animation: swipeSingle 12s infinite;
        }

        .cinema-slide:nth-child(1) { animation-delay: 0s; }
        .cinema-slide:nth-child(2) { animation-delay: 3s; }
        .cinema-slide:nth-child(3) { animation-delay: 6s; }
        .cinema-slide:nth-child(4) { animation-delay: 9s; }

        @keyframes swipeSingle {
            0%   { opacity: 1; transform: translateX(100%); }
            5%   { opacity: 1; transform: translateX(0%); }
            25%  { opacity: 1; transform: translateX(0%); }
            30%  { opacity: 1; transform: translateX(-100%); }
            100% { opacity: 1; transform: translateX(-100%); }
        }

        .cinema-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.5);
        }

        .cinema-title,
        .cinema-description,
        .cinema-subdescription,
        .cinema-btn {
            position: absolute;
            z-index: 2;
            text-align: center;
            color: white;
        }

        .cinema-title {
            top: 38%;
            left: 50%;
            transform: translate(-50%, 0%);
            font-size: 2rem;
        }

        .cinema-title h1 {
            font-family: 'modernline - Personal Use', sans-serif;
            font-size: 1.7rem;
            color: var(--primary);
            letter-spacing: 0.3em;
            font-weight: lighter;
            margin: 0;
            transform: translate(-180%, -775%) rotate(-10deg);
        }

        .cinema-title h2 {
            color: white;
            font-weight: normal;
            transform: translate(-130%, -472%);
        }

        .cinema-description {
            top: 90%;
            left: 12%;
            transform: translate(-50%, -50%);
        }

        .cinema-description p {
            font-family: 'Montserrat', sans-serif;
            font-weight: 200;
            font-size: 1.2rem;
            color: white;
        }

        .highlight { color: #ff4081; font-weight: bold; }

        .cinema-subdescription {
            top: 91.3%;
            left: 80%;
            transform: translate(-10%, -69%);
        }

        .cinema-subdescription p {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            color: white;
        }

        .cinema-subdescription .extraordinary {
            font-family: 'Montserrat', sans-serif;
            font-style: italic;
            font-size: 1.1rem;
            color: white;
        }

        .cinema-btn {
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
        }

        .cinema-btn a {
            text-decoration: underline;
            font-weight: bold;
            font-size: 2rem;
            color: var(--primary);
            transition: color 0.3s ease;
        }

        .cinema-btn a:hover { color: var(--secondary); }

        /* ============================================================
           LEGACY SLIDER SECTION
        ============================================================ */
        .legacy-slider-section {
            width: 100%;
            padding: 100px 0 50px;
            background: #fff;
            text-align: center;
        }

        .legacy-logo-mark {
            width: 100px;
            height: 100px;
            border: 1px solid #2a2a2a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 28px;
            padding: 10px;
        }

        .legacy-logo-mark img {
            width: 100%;
            height: 80%;
            object-fit: contain;
        }

        .legacy-headline {
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            font-size: clamp(28px, 4.5vw, 40px);
            font-weight: 300;
            letter-spacing: 6px;
            color: #2a2a2a;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.1;
            margin-bottom: 12px;
            max-width: 50%;
            margin-left: auto;
            margin-right: auto;
        }

        .legacy-headline em { font-style: italic; font-weight: 300; }

        .legacy-subhead {
            font-family: 'Montserrat', sans-serif;
            font-size: clamp(9px, 1vw, 15px);
            font-weight: 400;
            letter-spacing: 4px;
            color: #999;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 44px;
        }

        .vv-slider-outer {
            width: 100%;
            position: relative;
        }

        .vv-viewport {
            width: 78vw;
            margin: 0 auto;
            overflow: hidden;
            position: relative;
        }

        .vv-slider-track {
            display: flex;
            gap: 5px;
            will-change: transform;
            transition: transform 0.85s cubic-bezier(0.45, 0.05, 0.28, 0.98);
        }

        .vv-slide {
            flex: 0 0 calc((78vw - 20px) / 5);
            width: calc((78vw - 20px) / 5);
            height: 400px;
        }

        .vv-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .vv-slide:hover img { transform: scale(1.04); }

        .vv-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.9);
            border: 1px solid #ddd;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            color: #2a2a2a;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
            transition: background 0.2s, box-shadow 0.2s;
        }

        .vv-nav-btn:hover { background: #fff; box-shadow: 0 4px 14px rgba(0,0,0,0.18); }
        .vv-nav-prev { left: calc(11vw - 24px); }
        .vv-nav-next { right: calc(11vw - 24px); }

        .vv-dots {
            display: flex;
            gap: 7px;
            justify-content: center;
            margin-top: 26px;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .vv-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #ccc;
            cursor: pointer;
            border: none;
            padding: 0;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .vv-dot.active {
            background: var(--tertiary, #323538);
            transform: scale(1.3);
        }

        /* ============================================================
           AS SEEN IN
        ============================================================ */
        .as-seen-in {
            text-align: center;
            padding: 40px 20px;
            margin-bottom: 200px;
            overflow: hidden;
        }

        .as-seen-in h2 {
            font-size: 22px;
            letter-spacing: 2px;
            margin-bottom: 40px;
            color: #340f3b;
        }

        .carousel {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .carousel-track {
            display: flex;
            width: max-content;
            animation: scrollCarousel 20s linear infinite;
        }

        .carousel-track img {
            max-height: 80px;
            object-fit: contain;
            margin: 0 40px;
            flex: 0 0 auto;
        }

        @keyframes scrollCarousel {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ============================================================
           FOOTER FIX
        ============================================================ */
        .footer-container {
            width: 100%;
            overflow-x: hidden;
        }

        /* ============================================================
           KEYFRAMES (Shared)
        ============================================================ */
        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes lineReveal {
            to { opacity: 1; transform: scaleX(1); }
        }

        /* ============================================================
           ██████████████████████████████████████████████████████████
           MEDIA QUERIES
           ██████████████████████████████████████████████████████████
        ============================================================ */

        /* ── Desktop (1024px+) ──────────────────────────────────── */
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
            .hero h2 {
                font-size: 3.5rem;
            }
        }

        /* ── Tablets & Mobile (1023px and below) ────────────────── */
        @media (max-width: 1023px) {

            /* Show hamburger, hide nav links */
            .mobile-menu-btn { display: block; }
            .nav-group-left,
            .nav-group-right { display: none; }

            /* Hero */
            .hero { height: 85vh; }

            /* Legacy slider */
            .legacy-slider-section { margin-top: 0; }

            /* VV slider: 3 images */
            .vv-viewport { width: 92vw; }
            .vv-slide {
                flex: 0 0 calc((92vw - 10px) / 3);
                width: calc((92vw - 10px) / 3);
                height: 400px;
            }
            .vv-nav-prev { left: 4px; }
            .vv-nav-next { right: 4px; }

            /* Legacy headline */
            .legacy-headline { max-width: 90%; }

            /* Gallery section */
            .gallery-section { padding: 4rem 1.5rem; }
            .gallery-cards {
                flex-direction: column;
                gap: 3rem;
                align-items: center;
            }
            .category {
                width: 90%;
                height: auto;
                position: relative;
            }
            .category .card {
                position: relative;
                width: 100%;
                height: auto;
                transform: none !important;
                box-shadow: 0px 0px 20px -5px rgba(0,0,0,0.2);
                margin-bottom: 1rem;
            }
            .category .card img {
                height: auto;
                object-fit: cover;
            }
            .category-title {
                position: static;
                margin-top: 0.5rem;
                font-size: 1.2rem;
            }
            .section-header {
                flex-direction: column;
                text-align: center;
                gap: 0.3rem;
            }
            .section-header h2.section-title,
            .section-header h2 {
                top: 0;
                left: 0;
                font-size: 1.5rem;
            }
            .section-header-line { display: none; }

            /* Testimonials */
            .testimonials { padding: 4rem 1.5rem; margin-bottom: 50px; }
            .testimonials-header { margin-top: 1px; margin-bottom: 50px; }
            .testimonials-title { font-size: 1.2rem; font-weight: normal; }
            .testimonials-header h2 { font-size: 1.7rem; letter-spacing: .3em; }
            .testimonials-header h2.testimonials-main-title {
                letter-spacing: normal;
                font-size: 2.5rem;
                font-weight: normal;
            }
            .testimonial-text { font-size: 1.1rem; line-height: 1.6; margin-bottom: 1.5rem; padding: 0 0.5rem; }
            .testimonial-author { font-size: 0.8rem; line-height: 1.4; padding: 0 0.5rem; }
            .testimonial-nav { gap: 0.7rem; margin-top: 2rem; }
            .testimonial-dot { width: 8px; height: 8px; }

            /* Featured gallery */
            .featured-gallery { padding: 5rem 1.5rem; }
            .featured-heading { margin-top: -10px; margin-bottom: -10px; font-size: 1.75rem; }
            .featured-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1px;
            }
            .featured-grid img { width: 100%; height: auto; display: block; }
            .featured-grid img:nth-child(1) {
                border-radius: 0;
                border-top-left-radius: 100px;
                border-top-right-radius: 100px;
            }
            .featured-grid img:nth-child(3) {
                border-radius: 0;
                border-bottom-left-radius: 100px;
                border-bottom-right-radius: 100px;
            }
            .featured-grid img:nth-child(2),
            .featured-image-wrapper { width: 250px; height: 250px; }
            .featured-overlay { width: 300px; height: 300px; box-shadow: 0 0 0 6px #333333; }
            .overlay-content { flex-direction: column; font-size: 0.9rem; margin-left: 0; gap: 0.5rem; }
            .vertical-line { width: 80%; height: 1px; }
            .featured-btn { width: 80%; font-size: 0.95rem; }
            .featured-subtitle, .featured-title { top: 0; }
            .featured-title { margin-top: 0; font-size: 2.8rem; }
            .featured-header { flex-direction: column; gap: 0.5rem; }
            .featured-header-line { display: none; }

            /* Team section */
            .team-modern { padding: 3rem 1.5rem; }
            .team-header { margin-bottom: 2rem; }
            .team-subtitle { font-size: 1.2rem; margin-bottom: 0.5rem; }
            .team-title { font-size: 2rem; margin-bottom: 2rem; }
            .team-container {
                height: auto;
                display: flex;
                flex-direction: column;
                gap: 3rem;
                margin: 0;
            }
            .team-card { display: flex; flex-direction: column; align-items: center; }
            .team-name-row { order: 2; margin-bottom: 1rem; width: 100%; text-align: center; }
            .team-name-row p { font-size: 1.5rem; font-weight: 500; letter-spacing: 0.5px; margin: 0; margin-bottom: 10px; transform: none; }
            .team-image {
                order: 3;
                width: 100%;
                max-width: 350px;
                height: 450px;
                margin: 0 auto 1.5rem;
                overflow: hidden;
                transform: none;
            }
            .team-image img { width: 100%; height: 100%; object-fit: cover; }
            .team-details { order: 4; width: 100%; text-align: center; margin-bottom: 1.5rem; padding: 0; }
            .team-title-row h3 { font-size: 3rem; margin: 0 0 0.5rem 0; transform: none; }
            .team-divider { width: 100%; max-width: 349px; height: 2px; margin: 0 auto 1rem; transform: none; }
            .team-bio-row p { font-size: 1rem; line-height: 1.6; margin: 0 auto 1.5rem; max-width: 90%; transform: none; }
            .team-featured-row { order: 5; font-size: 0.9rem; letter-spacing: 0.1rem; margin: 1rem 0; text-align: center; width: 100%; transform: none; }
            .team-button-row { order: 6; width: 100%; text-align: center; margin-top: 1rem; transform: none; }
            .team-btn {
                display: inline-block;
                width: 100%;
                max-width: 350px;
                padding: 0.8rem 1.5rem;
                background-color: var(--primary);
                color: var(--tertiary);
                font-family: 'Montserrat', sans-serif;
                font-size: 0.95rem;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
                border: 2px solid transparent;
            }
            .team-btn:hover { background-color: transparent; color: var(--primary); border-color: var(--primary); }

            /* Cinema slider */
            .cinema-slider-container { height: auto; min-height: 100vh; }
            .cinema-title h1, .cinema-title h2 { transform: none; text-align: center; }
            .cinema-title h1 { font-size: 1.2rem; color: var(--primary); }
            .cinema-title h2 { font-size: 2rem; }
            .cinema-description { top: 75%; left: 50%; transform: translate(-50%, -50%); width: 90%; padding: 0 1rem; }
            .cinema-description p { font-size: 3rem; text-align: center; }
            .cinema-subdescription { top: 38%; left: 50%; transform: translate(-50%, -50%); width: 90%; padding: 0 1rem; }
            .cinema-subdescription p { font-size: 0.95rem; text-align: center; }

            /* As seen in */
            .as-seen-in { padding: 20px 10px; margin-bottom: 80px; }
            .as-seen-in h2 { font-size: 18px; margin-bottom: 25px; }
            .carousel-track img { max-height: 55px; margin: 0 20px 50px; }

            /* Footer */
            .footer-container { flex-direction: column; text-align: center; padding: 2rem 1rem; }
        }

        /* ── Mobile (768px and below) ──────────────────────────── */
        @media (max-width: 768px) {
            .hero { height: 80vh; }
            .hero-content { padding: 0 1rem; }
            .hero-logo { max-width: 220px; }
            .hero h2 { font-size: 1.9rem; }
            .hero p { font-size: 1rem; letter-spacing: 1px; }
            .hero p::before, .hero p::after { width: 20px; }
            .hero p::before { left: -30px; }
            .hero p::after  { right: -30px; }

            .logo-container .logotitle { height: 42px; }

            /* VV slider: 3 images still */
            .vv-viewport { width: 92vw; }
            .vv-slide {
                flex: 0 0 calc((92vw - 10px) / 3);
                width: calc((92vw - 10px) / 3);
                height: 300px;
            }
        }

        /* ── Small Mobile (480px and below) ───────────────────── */
        @media (max-width: 480px) {
            .hero { height: 75vh; }
            .hero h2 { font-size: 1.5rem; }
            .hero p { font-size: 0.9rem; }
            .hero-logo { max-width: 180px; }
            .logo-container .logotitle { height: 36px; }

            .legacy-headline { max-width: 90%; font-size: clamp(20px, 5vw, 28px); }

            /* VV slider: 2 images */
            .vv-viewport { width: 90vw; }
            .vv-slide {
                flex: 0 0 calc((90vw - 5px) / 2);
                width: calc((90vw - 5px) / 2);
                height: 260px;
            }
            .vv-nav-prev { left: 2px; }
            .vv-nav-next { right: 2px; }

            .category .card:nth-child(n+2) { display: none; }
            .category { width: 100%; }
            .category-title { font-size: 1rem; }

            .testimonial-text { font-size: 1rem; margin-bottom: 1.2rem; }
            .testimonial-author { font-size: 0.75rem; }
            .testimonial-slider { padding: 0 1rem; }

            .featured-grid { gap: 1rem; }
            .featured-heading { font-size: 1.5rem; }
            .featured-btn { padding: 0.5rem 1.5rem; }

            .as-seen-in { margin-bottom: 40px; }
        }

        /* ── Landscape phones ──────────────────────────────────── */
        @media (max-width: 956px) and (orientation: landscape) {
            body { overflow-x: auto; }
            .gallery-cards {
                display: flex;
                flex-direction: row !important;
                gap: 1.5rem;
                padding: 1rem;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }
            .gallery-cards::-webkit-scrollbar { display: none; }
            .category {
                width: 80vw;
                height: 60vh;
                min-width: 80vw;
                scroll-snap-align: center;
                margin: 0 0.5rem;
            }
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
            <img src="assets/image/logo2.png" alt="AMRIT Logo" class="logotitle">
        </a>
    </div>
    <div class="nav-group-right">
        <a href="veil&varmalaexperience.php">EXPERIENCE</a>
        <a href="inquire.php">INQUIRE</a>
    </div>
    <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>
</div>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero-container">
        <div class="image-bg"></div>
        <img src="assets/image/Cover Photo homepage_11zon (1).jpg" class="slide-img active" />
    </div>

    <script>
        const slides = document.querySelectorAll('.hero-container .slide-img');
        const intervalTime = 4000;
        setInterval(() => {
            const currentSlide = document.querySelector('.hero-container .slide-img.active');
            currentSlide.classList.remove('active');
            const nextSlide = currentSlide.nextElementSibling?.classList.contains('slide-img')
                ? currentSlide.nextElementSibling
                : slides[0];
            nextSlide.classList.add('active');
        }, intervalTime);
    </script>

    <div class="hero-content">
        <div class="estd-container">
            <small class="estd-text">ESTD &nbsp; 2024</small>
        </div>
        <img src="assets/image/VV-White-color.png" alt="Beyond the Lens Logo" class="hero-logo-v" />
        <img src="assets/image/whitelogo.png" alt="Beyond the Lens Logo" class="hero-logo" />
        <h2>BEYOND THE LENS</h2>
        <p>Crafting <span class="timeless">Timeless</span> love</p>
    </div>
</section>

<?php
$slider_images = [
    'assets/image/A7404069.jpg',
    'assets/image/feature_69c433801d5de_2.png',
    'assets/image/feature_68e48be6afaae9.05976397.jpg',
    'assets/image/img_68c3f1270e3269.69480699.jpg',
    'assets/image/feature_69c4352e46707_DSC06450-2.jpg',
    'assets/image/feature_68e485c0360a39.92193863.jpg',
    'assets/image/feature_69c44d8231d86_RRV00775-Edit-Edit.jpg',
    'assets/image/feature_68e48656a39957.67406407.jpg',
    'assets/image/feature_68e48d840ff5b_duke-photography-wedding-ss15-st-regis-03.jpg',
    'assets/image/cover_69c42f21b8bc0_TRI08147.jpg',
    'assets/image/feature_69c4355568ed6_DSC06450-2.jpg',
    'assets/image/AG103164.jpg',
    'assets/image/img_68c3f1270fb943.75208667.jpg',
    'assets/image/feature_69c458233248c_DSC01596.jpg',
    'assets/image/AG100714.jpg',
    'assets/image/A7406831.jpg',
    'assets/image/A7406816.jpg',
    'assets/image/AG100012.jpg',
    'assets/image/AG100175.jpg',
    'assets/image/AG100213.jpg',
    'assets/image/A7406781.jpg',
    'assets/image/cover_69c4338021cd1_DJI_0250.jpg',
    'assets/image/img_68c27287adec26.52647974.jpg',
    'assets/image/img_68c27287af09d6.02600190.jpg',
    'assets/image/feature_69c4716b842c9_DSC03499.jpg',
    'assets/image/img_68c3f127126928.26974028.jpg',
    'assets/image/AG100441.jpg',
    'assets/image/feature_68e48d21e93189.96580157.jpg',
    'assets/image/A7404717.jpg',
    'assets/image/feature_68e48d21e93189.96580157.jpg',
    'assets/image/DSC08714.jpg',
    'assets/image/feature_68e48d21e93189.96580157.jpg',
    'assets/image/feature_68e48d4007a84_bc163d70251b7f5bc18b097b73d90a17.jpg',
];
$slider_total = count($slider_images);
?>

<!-- Legacy Slider Section -->
<section class="legacy-slider-section">

    <div class="legacy-logo-mark">
        <img src="assets/image/logo.png" alt="VV Logo">
    </div>

    <h2 class="legacy-headline"><em>Preserving your love story through editorial timeless imagery</em></h2>
    <p class="legacy-subhead">Through artful photographs that will stand the test of time</p>

    <div class="vv-slider-outer" id="vvSliderOuter">

        <button class="vv-nav-btn vv-nav-prev" id="vvPrevBtn" aria-label="Previous">&#8592;</button>
        <button class="vv-nav-btn vv-nav-next" id="vvNextBtn" aria-label="Next">&#8594;</button>

        <div class="vv-viewport">
            <div class="vv-slider-track" id="vvSliderTrack">

                <?php foreach ($slider_images as $src): ?>
                    <div class="vv-slide">
                        <img src="<?= htmlspecialchars($src) ?>" alt="Wedding photography" loading="lazy">
                    </div>
                <?php endforeach; ?>

                <?php foreach (array_slice($slider_images, 0, 6) as $src): ?>
                    <div class="vv-slide vv-clone">
                        <img src="<?= htmlspecialchars($src) ?>" alt="Wedding photography" loading="lazy">
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

    </div>

    <div class="vv-dots" id="vvDots">
        <?php for ($i = 0; $i < $slider_total; $i++): ?>
            <button
                class="vv-dot <?= $i === 0 ? 'active' : '' ?>"
                data-index="<?= $i ?>"
                aria-label="Go to slide <?= $i + 1 ?>"
            ></button>
        <?php endfor; ?>
    </div>

</section>

<script>
(function () {
    const TOTAL       = <?= $slider_total ?>;
    const INTERVAL_MS = 3000;
    const GAP         = 5;

    const track   = document.getElementById('vvSliderTrack');
    const dots    = document.querySelectorAll('.vv-dot');
    const prevBtn = document.getElementById('vvPrevBtn');
    const nextBtn = document.getElementById('vvNextBtn');
    const outer   = document.getElementById('vvSliderOuter');

    let currentIndex    = 0;
    let isTransitioning = false;
    let timer;
    let STEP_PX = 0;

    function getStepPx() {
        const firstSlide = document.querySelector('.vv-slide');
        return firstSlide.getBoundingClientRect().width + GAP;
    }

    function jumpTo(index) {
        track.style.transition = 'none';
        track.style.transform  = `translateX(-${index * STEP_PX}px)`;
        track.getBoundingClientRect();
        track.style.transition = '';
    }

    function updateDots(index) {
        const dotIdx = ((index % TOTAL) + TOTAL) % TOTAL;
        dots.forEach((d, i) => d.classList.toggle('active', i === dotIdx));
    }

    function slideTo(index) {
        if (isTransitioning) return;
        isTransitioning = true;
        currentIndex = index;
        track.style.transform = `translateX(-${currentIndex * STEP_PX}px)`;
        updateDots(currentIndex);
    }

    track.addEventListener('transitionend', () => {
        isTransitioning = false;
        if (currentIndex >= TOTAL) {
            currentIndex -= TOTAL;
            jumpTo(currentIndex);
        } else if (currentIndex < 0) {
            currentIndex += TOTAL;
            jumpTo(currentIndex);
        }
    });

    function startAuto() {
        clearInterval(timer);
        timer = setInterval(() => slideTo(currentIndex + 1), INTERVAL_MS);
    }

    nextBtn.addEventListener('click', () => { slideTo(currentIndex + 1); startAuto(); });
    prevBtn.addEventListener('click', () => { slideTo(currentIndex - 1); startAuto(); });

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            slideTo(parseInt(dot.dataset.index, 10));
            startAuto();
        });
    });

    outer.addEventListener('mouseenter', () => clearInterval(timer));
    outer.addEventListener('mouseleave', startAuto);

    let touchStartX = 0;
    outer.addEventListener('touchstart', e => {
        touchStartX = e.touches[0].clientX;
        clearInterval(timer);
    }, { passive: true });
    outer.addEventListener('touchend', e => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) slideTo(currentIndex + (diff > 0 ? 1 : -1));
        startAuto();
    }, { passive: true });

    window.addEventListener('resize', () => {
        STEP_PX = getStepPx();
        jumpTo(currentIndex);
    });

    window.addEventListener('load', () => {
        STEP_PX = getStepPx();
        currentIndex = 0;
        jumpTo(0);
        updateDots(0);
        startAuto();
    });

})();
</script>

<hr style="border: none; border-top: 1px solid #2a2a2a; width: 100%; margin: 0 auto;">

<!-- Testimonials Section -->
<section class="testimonials">
    <div class="testimonials-header">
        <h2 class="testimonials-title">their</h2>
        <h2 class="testimonials-main-title">TESTIMONIALS</h2>
    </div>

    <div class="testimonial-slider">
        <div class="testimonial active">
            <div class="testimonial-text">
                "EJ and Sarah were a joy to work with kind, respectful, and seamlessly present. They captured every meaningful moment without ever being intrusive. Our photos turned out beyond anything we imagined—truly dreamy. Highly recommend."
            </div>
            <div class="testimonial-author">— Rikita Bhakta</div>
        </div>
        <div class="testimonial">
            <div class="testimonial-text">
                "Veil and Varmala captured our engagement, wedding and reception. EJ and Sarah are so sweet and helpful! Sarah was my hype woman and literally helped me so much while planning her own wedding! EJ is so talented and quality of work was amazing! We were speechless when we received our pictures and videos."
            </div>
            <div class="testimonial-author">— Kajal Sozan</div>
        </div>
        <div class="testimonial">
            <div class="testimonial-text">
                "EJ and his team are some of the kindest and most artistic individuals we have had the fortune of working with. I feel so lucky to have found Veil and Varmala for our wedding photography"
            </div>
            <div class="testimonial-author">— Geetika</div>
        </div>
        <div class="testimonial-nav">
            <div class="testimonial-dot active" data-slide="0"></div>
            <div class="testimonial-dot" data-slide="1"></div>
            <div class="testimonial-dot" data-slide="2"></div>
        </div>
    </div>
</section>

<!-- As Seen In -->
<section class="as-seen-in">
    <h2>AS SEEN IN</h2>
    <div class="carousel">
        <div class="carousel-track">
            <img src="assets/image/wedding_wire.png" alt="Logo 1">
            <img src="assets/image/wedding_sutra_featured_charcoal_1.png" alt="Logo 2">
            <img src="assets/image/vogue_india.png" alt="Logo 3">
            <img src="assets/image/the_knot.png" alt="Logo 4">
            <img src="assets/image/sab.webp" alt="Logo 5">
            <img src="assets/image/SABAYASACHI.jpeg" alt="Logo 6">
            <img src="assets/image/azb-logo.svg" alt="Logo 7">
            <img src="assets/image/wedding_wire.png" alt="Logo 1">
            <img src="assets/image/wedding_sutra_featured_charcoal_1.png" alt="Logo 2">
            <img src="assets/image/vogue_india.png" alt="Logo 3">
            <img src="assets/image/the_knot.png" alt="Logo 4">
            <img src="assets/image/sab.webp" alt="Logo 5">
            <img src="assets/image/SABAYASACHI.jpeg" alt="Logo 6">
            <img src="assets/image/azb-logo.svg" alt="Logo 7">
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'footer.php'; ?>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
    });

    // Testimonial slider
    const testimonials = document.querySelectorAll('.testimonial');
    const dots = document.querySelectorAll('.testimonial-dot');
    let currentTestimonial = 0;

    function showTestimonial(index) {
        testimonials.forEach(t => t.classList.remove('active'));
        dots.forEach(d => d.classList.remove('active'));
        testimonials[index].classList.add('active');
        dots[index].classList.add('active');
        currentTestimonial = index;
    }

    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            const slideIndex = parseInt(this.getAttribute('data-slide'));
            showTestimonial(slideIndex);
        });
    });

    setInterval(() => {
        currentTestimonial = (currentTestimonial + 1) % testimonials.length;
        showTestimonial(currentTestimonial);
    }, 5000);

    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
            const mobileMenu = document.getElementById('mobileMenu');
            const overlay = document.getElementById('overlay');
            if (mobileMenu) mobileMenu.classList.remove('active');
            if (overlay) overlay.classList.remove('active');
        });
    });

    // Legacy mobile menu is intentionally skipped here because the fullscreen nav
    // for this page is handled by nav-mobile.php and should not toggle a different menu state.
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.querySelector('.section-header');
        if (header) {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) header.classList.add('active');
                });
            }, { threshold: 0.3 });
            observer.observe(header);
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.classList.add("active");
                });
            },
            { threshold: 0.3 }
        );

        const featuredHeader = document.querySelector(".featured-header");
        if (featuredHeader) observer.observe(featuredHeader);
    });
</script>

<script>
    document.querySelectorAll('.category').forEach(category => {
        category.addEventListener('click', function () {
            document.querySelectorAll('.category').forEach(c => {
                if (c !== this) c.classList.remove('active');
            });
            this.classList.toggle('active');
        });
    });

    const catObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.category-header').forEach(header => {
        catObserver.observe(header);
    });

    const testimonialsLine = document.querySelector('.testimonials-header-line');
    if (testimonialsLine) {
        const lineObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) testimonialsLine.classList.add('active');
            });
        }, { threshold: 0.5 });
        lineObserver.observe(testimonialsLine);
    }
</script>

</body>
</html>