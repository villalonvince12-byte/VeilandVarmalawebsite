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
        /* Base Styles */
     :root {
            --primary: #ffffff;
            --secondary: #C3B8AC;
            --tertiary: #323538;
            --textcolor: #333333;
            --dusty-rose: #C7A8A3;
            --sage: #A3B8A7;
            
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'NewYork', 'Cormorant Garamond', serif;
            color: var(--textcolor);
            background: var(--primary);
            line-height: 1.6;
            overflow-x: hidden;
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
        
        /* Navigation */
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
        
        .nav-links a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: var(--textcolor);
            transition: width 0.3s ease;
        }
        
        .nav-links a:hover:after {
            width: 100%;
        }
        
        /* Navigation */
        .hero-text {
            top: 0;
            left: 0;
            width: 100%;
            height: 200px;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            padding: 2rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.5s ease;
        }
        
        .hero-text.scrolled {
            background-color: rgba(248, 245, 242, 0.9);
            padding: 1rem 3rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
                
        .logo-container {
            display: flex;
            align-items: flex-start;
        }

        .logotitle {
            width: 400px;
            height: auto;
            object-fit: cover;
            object-position: center;
        }

        .nav-links-hero {
            display: flex;
            gap: 2.5rem;
        }
        
        .nav-links-hero a {
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            font-weight: 300;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            position: relative;
        }
        
        .nav-links-hero a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: var(--textcolor);
            transition: width 0.3s ease;
        }
        
        .nav-links-hero a:hover:after {
            width: 100%;
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--textcolor);
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 101;
        }

        /* Mobile Menu */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            max-width: 300px;
            height: 100vh;
            background-color: var(--primary);
            z-index: 100;
            transition: right 0.3s ease;
            padding: 6rem 2rem 2rem;
            box-shadow: -5px 0 15px rgba(0,0,0,0.1);
        }

        .mobile-menu.active {
            right: 0;
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
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

    /* Hero Section */
    .hero {
        position: relative;
        height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 0 50px;
        width: 100vw;       /* Full screen width */
        max-width: none;    /* Remove any max width constraint */
        margin: 0;          /* Remove all margins */
    }


        /* Hero Image */
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

        /* Content on top of the image */
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

            /* Style for the logo */
            .hero-logo {
                width: 350px; /* Adjust size as needed */
                height: auto;
                margin-bottom: 1rem; /* Optional spacing if you add text later */
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
        
    

        /* Gallery Section */
        .gallery-section {
            padding: 5rem 3rem;
            background-color: var(--primary);
            
            color: var(--textcolor);
            padding: 8rem 3rem;
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

        /* Top fade */
        .gallery-section::before {
            top: 0;
            background: linear-gradient(to bottom, white, transparent);
        }

        /* Bottom fade */
        .gallery-section::after {
            bottom: 0;
            background: linear-gradient(to top, white, transparent);
            z-index: -1;
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

        /* When active (in viewport) */
        .section-header.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* h2 animation */
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

        /* line animation */
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

        /* When section is active, animate h2 and line */
        .section-header.active h2 {
            opacity: 1;
            transform: translateY(0);
        }

        .section-header.active .section-header-line {
            opacity: 1;
            transform: scaleX(1);
        }

        /* Keyframes */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes lineReveal {
            to {
                opacity: 1;
                transform: scaleX(1);
            }
        }
        .gallery-grid {
        margin-top: -20px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
            }
    @keyframes fadeInOnScroll {
    from {
        opacity: 0;
        transform: scale(1.03);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
    }

    .gallery-item {
    opacity: 0;
    transform: scale(1.03);
    transition: transform 0.5s ease;
    }

    .gallery-item.visible {
    animation: fadeInOnScroll 0.8s ease forwards;
    }

    .gallery-item {
    will-change: opacity, transform;
    }


        .gallery-item {
        position: relative;
        overflow: hidden;
        height: 650px; /* Increased from 500px */
        aspect-ratio: 3/4; /* Optional: adjust to 2/3 for a taller look */
        }

        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease, filter 0.5s ease;
            filter: grayscale(30%) brightness(0.9);
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
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
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

        /* Import Cormorant Garamond font */
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&display=swap');

.info-section {
  padding: 4rem 0rem; /* Removed left/right padding */
  background-color: var(--primary);
}

.info-wrapper {
  display: flex;
  align-items: stretch;
  max-width: 1200px;
  margin: 0 auto;
}

/* Left Column */
.info-left {

  flex: 1;
  padding: 2rem -15rem 2rem 2rem; /* left padding only */
  display: flex;
  flex-direction: column;
}


.info-name {
    margin-left: -200px;
  font-family: 'NewYork', 'Cormorant Garamond', serif;
text-align: center;
  font-weight: 700;
  line-height: .8; /* Reduced line-height to tighten name gap */
  margin-bottom: 1rem;
}

.info-name .first-name {
      font-size: 4rem;
}

.info-name .last-name {

      font-size: 3.5rem;
}
.info-name .full-name {
     display: none;
}
.info-name .first-name,
.info-name .last-name {
  display: block;
  margin: 0; /* Ensure no default spacing */
  padding: 0;
}

.info-location {
margin-left: 20px;
  font-size: 1.5rem;
  margin-bottom: 1.5rem;
}

.info-logo img {
    margin-left: 8px;
  max-width: 150px;
  height: auto;
}
.vertical-divider {
    height: 350px;
transform: translate(-10rem,-1rem);
  width: 2px;
  background-color: var(--textcolor); /* or any color */
  margin: 0 2rem;
}


/* Right Column */
/* Right Column */
.info-right {
  transform: translate(-10rem, -2rem);
  flex: 2;
  padding: 2rem 0 2rem 0.5rem; /* Was 15rem, now tight */
  font-size: 1.4rem;
  line-height: 1.6;
  text-align: justify; /* ✅ Justify text to align both left and right */
}


     
   /* Mobile Responsiveness */
        @media (max-width: 1024px) {
            .hero h1 {
                font-size: 3rem;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .gallery-item {
                height: 400px;
            }
            
            .about-text p {
                font-size: 1.1rem;
            }
        }
        
        @media (max-width: 956px) {
            .hero-text {
                height: auto;
               
            }
            
            .logotitle {
                width: 250px;
            }
            
            .nav-links-hero {
                display: none;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            .hero {
               transform: translateY(-10px);
            }
            .hero .hero-image {
              
                top: -30px;
                height: 300px;
                width: 500px;
                margin-bottom: -100px;
                
            }
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 0.8rem;
                letter-spacing: 0.2em;
            }
            
            
            .contact-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .section-header h2 {
                font-size: 2rem;
                top: -60px;
            }
            
            .section-header h2.section-title {
                font-size: 1.2rem;
                top: -60px;
            }
            
            .section-header-line {
                top: -60px;
            }
            
            .testimonial-text {
                font-size: 1.2rem;
            }
        }
        
        @media (max-width: 480px) {
            .hero-text {
                padding: 1rem;
            }
            
            .hero {
                height: 80vh;
                margin-top: 20px;
            }
            
            .hero h1 {
                font-size: 2rem;
                margin-bottom: 1rem;
            }
            
            .hero p {
                margin-bottom: 2rem;
            }
            
            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .gallery-item {
                height: 350px;
            }
            
            .about, .gallery-section, .testimonials, .contact {
                padding: 5rem 1.5rem;
            }
            
            .about-heading h2 {
                top: -100px;
                font-size: 1.5rem;
            }
            
            
            .section-header h2 {
                font-size: 1.5rem;
                top: -50px;
            }
            
            .section-header h2.section-title {
                font-size: 1rem;
                top: -50px;
            }
            
            .section-header-line {
                top: -50px;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
            
            .testimonial-text {
                font-size: 1rem;
            }
            
            .contact-form input,
            .contact-form textarea {
                padding: 0.8rem;
            }
            
            .submit-btn {
                padding: 0.8rem 1.5rem;
            }
        }

/* Responsive */
@media (max-width: 956px) {
  .info-wrapper {
    flex-direction: column;
  }

  .info-left {
    border-right: none;
 
  }

  .info-right {
    padding: 2rem; /* Reset padding for mobile */
  }
}


@media (max-width: 956px) {
  .info-section {
    margin-top: -350px;
    padding: 2rem 1rem;
  }

  .info-wrapper {
    margin-top: -190px;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .info-left {
    padding: 1.5rem 1rem;
    margin-bottom: 2rem;
    
  }

  .info-name {

    margin-left: 0;
  }

  .info-name .first-name {
   display: none;
  }

  .info-name .last-name {
    display: none;
  }

  .info-name .full-name {

    display: inline;
    font-size: 3rem;
    border-bottom: 1px solid var(--textcolor);
    transform: translateY(-1rem);
    margin-top: -20px;
  }

  .info-location {
    margin-left: 0;
    font-size: 1.8rem;
  }

  .info-logo img {
    max-width: 50px;
    margin-top: -1rem;
    margin-bottom: 10px;
  }

  .vertical-divider {
    display: none; /* Hide vertical line on mobile */
  }

  .info-right {
    margin-top: -80px;
    transform: none;
    padding: 1rem;
    font-size: 1.2rem;
    text-align: justify;
  }
  .info-section .info-right p {
    font-size: 1.3rem;
    text-align: justify;
    text-indent: 2em; /* ✅ This adds the indent */
    letter-spacing: 0.8px;
  }
  .gallery-section .gallery-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: .4rem;
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
  display: block; /* Ensures <a> or <div> behaves same */
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
  position: static;                /* Remove absolute positioning */
  width: 100%;
  padding: 0.5rem 0;
  background: none;                /* Remove gradient background */
  opacity: 1 !important;           /* Always visible */
  transition: none;                /* No fade effect needed */
  text-align: center;
}
.gallery-grid .gallery-overlay h3 {
width: 200px;
  color: var(--primary);
  margin: 0;
  font-size: .75rem;
  transform: translateY(20px);
  letter-spacing: .1rem;
}

.gallery-grid  .gallery-overlay p {
  font-family: 'Montserrat', sans-serif;
  font-size: 0.5rem;
  color: var(--primary);
  transform: translateY(15px);
  margin: 0.2rem 0 0;
  width: 200px;
  letter-spacing: 1px;
}




}
.gallery-overlay {
  display: none !important;
}   
    </style>
</head>
<body>
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>
    
    <!-- Mobile Menu Overlay -->
    <div class="overlay" id="overlay"></div>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-nav-links">
            <a href="index.php">HOME</a>
            <a href="about.php">The Veil and Vermala Experience</a>
            <a href="portfolio.php">GALLERIES</a>
            <a href="#gallery">PORTFOLIO</a>
            <a href="inquire.php">INQUIRE</a>
        </div>
    </div>

    <section class="hero-text">
        <div class="logo-container">
            <img src="assets/image/logo2.png" alt="Veil & Varmala Logo" class="logotitle">
        </div>
        <div class="nav-links-hero">
            <a href="index.php">HOME</a>
            <a href="about.php">The Veil and Vermala Experience</a>
            <a href="portfolio.php">GALLERIES</a>
            <a href="#gallery">PORTFOLIO</a>
            <a href="inquire.php">INQUIRE</a>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <img src="assets/image/portfolio-hero.avif" alt="Photography" class="hero-image">
    </section>
<section class="info-section">
  <div class="info-wrapper">
    <!-- Left Column -->
    <div class="info-left">
      <div class="info-name">
        <span class="first-name">Portrait</span><br/>
        <span class="last-name">Series</span>
        <span class="full-name">Portrait + Series</span>
      </div>
      <div class="info-location">Tokyo, Japan</div>
      <div class="info-logo">
        <img src="assets/image/logo.png" alt="Logo" />
      </div>
    </div>

    <!-- Vertical Line -->
    <div class="vertical-divider"></div>
            <!-- Right Column -->
        <div class="info-right">
        <p>
            <u><i>"Portrait Series"</i></u> is a captivating collection that delves deep into the intricacies of human expression, identity, and untold stories. Each portrait is more than just a visual representation—it is a window into the subject’s soul, emotions, and lived experiences.
        </p>
        <p>
            Through thoughtful composition, lighting, and mood, this series explores themes of resilience, vulnerability, cultural heritage, and personal transformation. Whether it’s the sparkle of joy in a child’s eyes, the quiet wisdom in an elder’s gaze, or the silent strength in a moment of solitude, every image is designed to connect and inspire.
        </p>

        </div>
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
        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg" alt="Portrait Series" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1494526585095-c41746248156" alt="Urban Landscapes" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/1027130/pexels-photo-1027130.jpeg" alt="Still Life" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/29553374/pexels-photo-29553374.jpeg" alt="Documentary" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/9760556/pexels-photo-9760556.jpeg" alt="Fine Art" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/1661478/pexels-photo-1661478.jpeg" alt="Editorial" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/1704488/pexels-photo-1704488.jpeg" alt="Fashion" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1516116216624-53e697fedbea" alt="Nature" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/1130626/pexels-photo-1130626.jpeg" alt="Street" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1552083974-186346191183" alt="Architecture" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/1542085/pexels-photo-1542085.jpeg" alt="Abstract" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1574158622682-e40e69881006" alt="Wildlife" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/70497/pexels-photo-70497.jpeg" alt="Food" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg" alt="Events" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb" alt="Travel" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg" alt="Night Photography" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/290470/pexels-photo-290470.jpeg" alt="Sports" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>

        <div class="gallery-item">
            <img src="https://images.pexels.com/photos/1559285/pexels-photo-1559285.jpeg" alt="Underwater" class="gallery-img">
            <div class="gallery-overlay"></div>
        </div>
    </div>
</section>
<!-- Lightbox Modal -->
<div id="lightbox" class="lightbox"  style="display: none;">
    <div class="lightbox-wrapper">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <img class="lightbox-content" id="lightbox-img">
    <div class="lightbox-caption" id="lightbox-caption"></div>
    <button class="lightbox-nav prev" onclick="changeImage(-1)">&#10094;</button>
    <button class="lightbox-nav next" onclick="changeImage(1)">&#10095;</button>
</div></div>
<script>
    function openLightbox(imageSrc) {
  const lightbox = document.querySelector('.lightbox');
  const img = document.querySelector('.lightbox-content');
  img.style.opacity = 0;
  lightbox.style.display = 'flex'; // or 'block', depending on your layout
  img.src = imageSrc;

  img.onload = () => {
    img.style.opacity = 1;
  };
}

document.addEventListener('mousemove', function (e) {
    const nextArrow = document.querySelector('.lightbox-nav.next');
    const prevArrow = document.querySelector('.lightbox-nav.prev');
    const windowWidth = window.innerWidth;
    const x = e.clientX;

    // Reset hover effect
    nextArrow.classList.remove('simulated-hover');
    prevArrow.classList.remove('simulated-hover');

    // Define hover zones
    const leftHoverZone = windowWidth * 0.3;
    const rightHoverZone = windowWidth * 0.7;

    if (x < leftHoverZone) {
        prevArrow.classList.add('simulated-hover');
    } else if (x > rightHoverZone) {
        nextArrow.classList.add('simulated-hover');
    }
    // Between 30% and 70% = dead zone = no hover
});
</script>


<style>
    
.lightbox {
    display: none;
    position: fixed;
    z-index: 9999;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: var(--primary);
    opacity: 0;
    transition: opacity 0.5s ease;
}

.lightbox.show {
    display: block;
    opacity: 1;
}

   .lightbox-wrapper {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.lightbox-content {
    max-width: 90vw;
    max-height: 80vh;
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
    top: 30px;
    right: 45px;
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
.lightbox-nav.simulated-hover {
    color: var(--textcolor); /* same color used in hover */
}

.lightbox-nav.prev {
    left: 20px;
}

.lightbox-nav.next {
    right: 20px;
}



/* Keyframe Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes swipeLeft {
    0% { transform: translateX(100%); opacity: 0; }
    100% { transform: translateX(0); opacity: 1; }
}

@keyframes swipeRight {
    0% { transform: translateX(-100%); opacity: 0; }
    100% { transform: translateX(0); opacity: 1; }
}

/* Animation classes */
.animate-left {
    animation: swipeLeft 0.5s forwards;
}

.animate-right {
    animation: swipeRight 0.5s forwards;
}
@media (max-width: 956px) {
     .lightbox-content {
        max-width: 95vw;
        max-height: 70vh;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

   .lightbox-caption {
        position: fixed;
        bottom: 10px;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 1rem;
    }

.lightbox-nav {
         position: fixed;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2rem;
    }

    .lightbox-close {
        position: fixed;
        top: 15px;
        right: 15px;
        font-size: 30px;
    }
}

</style>
<script>
// Touch swipe functionality for mobile
let startX = 0;
let endX = 0;

lightbox.addEventListener('touchstart', function(e) {
    startX = e.changedTouches[0].screenX;
}, false);

lightbox.addEventListener('touchend', function(e) {
    endX = e.changedTouches[0].screenX;
    handleSwipe();
}, false);

function handleSwipe() {
    const deltaX = startX - endX;
    const threshold = 50; // Minimum distance for swipe

    if (Math.abs(deltaX) > threshold) {
        if (deltaX > 0) {
            changeImage(1); // Swipe left → Next
        } else {
            changeImage(-1); // Swipe right → Previous
        }
    }
}
</script>
<script>
    function showImage(index) {
    const imageElement = document.querySelector(".lightbox-content");
    const image = images[index]; // your array of image URLs
    imageElement.style.opacity = 0; // fade out

    // Set the new image src
    imageElement.src = image;

    // Once image loads, re-center it
    imageElement.onload = () => {
        imageElement.style.top = '50%';
        imageElement.style.left = '50%';
        imageElement.style.transform = 'translate(-50%, -50%)';
        imageElement.style.opacity = 1; // fade in
    };
}
    
</script>
<script>
const images = document.querySelectorAll('.gallery-img');
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox-img');
const lightboxCaption = document.getElementById('lightbox-caption');

let currentIndex = 0;
let galleryImages = [];

// Prepare gallery data
images.forEach((img, index) => {
    galleryImages.push({
        src: img.src
    });

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
    // Reset animations
    lightboxImg.className = 'lightbox-content';

    // Preload next image
    const img = new Image();
    img.src = galleryImages[currentIndex].src;
    img.onload = () => {
        lightboxImg.src = img.src;
        lightboxCaption.textContent = galleryImages[currentIndex].alt;

        // Add animation class
        if (animation === 'left') {
            lightboxImg.classList.add('animate-left');
        } else if (animation === 'right') {
            lightboxImg.classList.add('animate-right');
        } else {
            lightboxImg.classList.add('show'); // fadeIn
        }
    };
}

// Keyboard support
document.addEventListener('keydown', (e) => {
    if (lightbox.classList.contains('show')) {
        if (e.key === "Escape") closeLightbox();
        if (e.key === "ArrowRight") changeImage(1);
        if (e.key === "ArrowLeft") changeImage(-1);
    }
});
</script>


    <!-- Footer -->
<?php include 'footer.php'; ?>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const galleryItems = document.querySelectorAll(".gallery-item");

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          // Generate a random delay between 0s and 1s (adjust as needed)
          const delay = (Math.random() * 1).toFixed(2);
          entry.target.style.animationDelay = `${delay}s`;
          entry.target.classList.add("visible");
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.1
    });

    galleryItems.forEach(item => {
      observer.observe(item);
    });
  });
</script>


</body>
</html>