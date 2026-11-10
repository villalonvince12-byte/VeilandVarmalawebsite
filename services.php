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
        }
        html, body {
        overflow-x: hidden;
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
            margin-top: -20px;
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

/* Navigation container */
.nav-links-hero {
  margin-top: 70px;
  display: flex;
  gap: 1.5rem; /* reduce space between links */
}

/* Navigation link styling */
.nav-links-hero a {
  font-family: 'Montserrat', sans-serif;
  font-size: 1rem;
  font-weight: 400;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  text-align: center;
  line-height: 1;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;  /* Align bottom if needed */
  align-items: center;
  white-space: nowrap;
  height: 60px; /* Fixes inconsistent height */
  
}

/* Optional: Allow wrapping but keep alignment */
.nav-links-hero a br {
  line-height: 0.5;
}

/* Second line (span) */
.nav-links-hero a span {
  margin-top: 2px;
  font-size: 1rem;
  font-weight: 300;
  text-transform: capitalize;
  letter-spacing: 0.1em;
  display: block;
}
/* Base styles for nav links */
.nav-links-hero a {
  position: relative;
  color: inherit;
  text-decoration: none; /* Remove native underline */
  transition: color 0.3s ease;
}


/* Hover styles */
.nav-links-hero a:hover {
  color: var(--secondary);
}

.nav-links-hero a:hover::after {
  width: 100%; /* Animate underline */
}

/* Optional: Hover effect for second line (span) */
.nav-links-hero a:hover span {
  color: var(--secondary);
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
            margin-top: 30px;
            width: 100%;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 10px;
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
            .hero-content h2 {
              margin-left: 60px;
                        font-family: 'Montserrat', sans-serif;
                            font-size: 4rem;
              margin-bottom: 5px;
               transform: translateY(20px);
                        }
            /* Style for the logo */
            .hero-logo {
                margin-top: 20px;
                margin-left: 60px;
                width: 60px; /* Adjust size as needed */
                height: auto;
                margin-bottom: 1rem; /* Optional spacing if you add text later */
            }
            .hero-logo-about {
                margin-top: -30px;
                margin-left: 60px;
                width: 600px; /* Adjust size as needed */
                height: auto;
                margin-bottom: 1rem; /* Optional spacing if you add text later */
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
        /* mobile responsive for hero section */

        @media (max-width: 600px) {
  .hero {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 0 20px; /* spacing for smaller screens */

}

.hero-image {
    width: 100vw;           /* full viewport width */
    height: 230px;          /* fixed landscape height */
    object-fit: cover;      /* cover the area without stretching */
    display: block;         /* remove inline spacing */
    filter: brightness(0.7);
    margin: 0;              /* remove extra margins */
    
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

    .hero h1 {
        font-size: 2rem;
    }

    .hero p {
        font-size: 0.8rem;
        letter-spacing: 0.15em;
    }

    .scroll-indicator {
        bottom: 1rem;
    }

    .scroll-text {
        font-size: 0.6rem;
    }

    .scroll-line {
        height: 30px;
    }
    .hero-text .logotitle {
       margin-top: 5px;
       margin-bottom: -70px;
    }

    .gallery-section {
           transform: translateY(120px);
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

     
   
        /* Mobile Responsiveness */
        @media (max-width: 1024px) {
            .hero h1 {
                font-size: 3rem;
            }
            
        }
        
        @media (max-width: 956px) {
            .hero-text {
                padding: 1.5rem;
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
                height: 50vh;
                margin-bottom: 80px;
                padding: 0 20px;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 0.8rem;
                letter-spacing: 0.2em;
            }
            

        }
        
        @media (max-width: 480px) {
            .hero-text {
                padding: 1rem;
            }
            
            .hero {
                height: 70vh;
                margin-top: 0;
            }
            
            .hero h1 {
                font-size: 2rem;
                margin-bottom: 1rem;
            }
            
            .hero p {
                margin-bottom: 2rem;
            }
            
        }
        
.three-row-section {
  background-color: var(--tertiary);
  margin: 10rem auto;
  padding: 3rem 5%;
  display: flex;
  flex-direction: column;
  gap: 2rem;
  height: auto;
}

.row {
  width: 100%;
}

.title-row h2 {
  text-align: center;
  font-size: 2rem;
  font-family: 'Montserrat', sans-serif;
  color: var(--primary); /* black */
  letter-spacing: 4px;
  word-spacing: 5px;
}

.image-row {
  text-align: center;
}

.image-row img {
  width: 100%;
  max-width: 800px;
  height: 300px;
  object-fit: cover;
  object-position: center;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}


.description-row p {
  font-size: .9rem;
  line-height: 1.7;
  letter-spacing: 1px;
  text-align: center;
  font-family: 'Montserrat', sans-serif;
  color: var(--secondary); /* black */
  max-width: 900px;
  margin: 0 auto;
  padding: 0 4rem;
}

/* New Section Styles */
.photography-section {
  max-width: 1400px;
  margin: 0 auto;
  padding: 6rem 3rem;
  transform: translateY(10px);
  margin-bottom: 100px;
}

.section-header {
  text-align: center;
  margin-bottom: 4rem;
}

.section-header h2 {
  font-family: 'NewYork', serif;
  font-size: 3rem;
  margin-bottom: 1rem;
}

/* Initial state (invisible, collapsed) */
.divider {

  width: 200px;
  height: 1px;
  background-color: var(--textcolor);
  margin: 0 auto;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 3s ease-out;
 
}

/* Triggered when scrolled into view */
.divider.animate {
  transform: scaleX(1);
}

.pricing-title .divider{
  margin-top: -15px;
}
.section-content {
  display: flex;
  flex-direction: column;
  gap: 3rem;
}

.section-block {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.section-subheading {
  font-family: 'NewYork', 'Cormorant Garamond', serif;
  font-size: 2rem;
  font-weight: 400;
  letter-spacing: 0.05em;
  color: var(--tertiary);
}

.section-description {
   font-family: 'Montserrat', sans-serif;
  font-size: 1.1rem;
  line-height: 1.7;
  letter-spacing: 0.03em;
}

.gallery-carousel {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
  margin-top: 2rem;
}

.gallery-carousel img {
  width: 100%;
  height: 300px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.gallery-carousel img:hover {
  transform: scale(1.02);
}

.approach-points {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.approach-point {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.approach-point h4 {
  font-family: 'NewYork', 'Cormorant Garamond', serif;
  font-size: 1.3rem;
  color: var(--textcolor);
}

/* Journey Section */
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
  position: relative; /* Needed for the ::after to position correctly */
  display: inline-block; /* Ensures the line aligns with the text */
}
.journey-header h2::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 100%; /* Start the line right after the text */
  margin-left: 1rem;
  width: 0; /* Start with 0 width */
  height: 1px;
  background-color: black;
  transform: translateY(-50%);
  animation: lineGrow 3s ease-out forwards; /* Trigger the animation */
}

/* Keyframes for line drawing */
@keyframes lineGrow {
  from {
    width: 0;
  }
  to {
    width: 500px; /* Final width of the line */
  }
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
  /* ✅ Rectangle border styles */
  border: 1px solid var(--tertiary); /* or use #000 for black */
  padding: 2rem;
  background-color: var(--primary); /* Optional background */
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); /* Optional shadow for depth */
}

.journey-steps {
  transform: translateY(10px);
  display: flex;
  flex-direction: column;
  gap: 4rem;


 /* Optional shadow for depth */
}

.faq-section {
  padding: 5rem 2rem;
  max-width: 1000px;
  margin: 0 auto;
  text-align: center;
    margin-top: -5rem;
}

.faq-title h2 {
  font-family: 'NewYork', serif;
  font-size: 2.5rem;
  color: var(--tertiary);
  margin-bottom: 2.5rem;

}



.faq-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 2.5rem;
}

.faq-question {
  font-family: 'Montserrat', sans-serif;
  font-weight: 500;
  font-size: 1rem;
  margin-bottom: 0.5rem;
  color: var(--textcolor);
  text-transform: uppercase;
  letter-spacing: 2px;
  word-spacing: 1px;
}

.faq-answer {
  font-family: 'Montserrat', sans-serif;
  font-size: 1rem;
  color: var(--textcolor);
  max-width: 700px;
}

.journey-step {
  display: flex;
  align-items: center;
  gap: 4rem;
}

.journey-step.reverse {
  flex-direction: row-reverse;
}

.journey-image {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
}

.journey-image img {
  width: 400px;        /* fixed portrait width */
  height: 600px;       /* fixed portrait height */
  object-fit: cover;   /* keeps aspect & crops overflow */
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
    letter-spacing: 0em;
    font-size: 42px;

  color: var(--tertiary);
  margin-bottom: 0.5rem;
  text-transform: uppercase;
}
.journey-step.reverse .journey-title {
transform: translateX(120px);
}
.journey-step.reverse .journey-description {
  text-align: justify;
transform: translateX(120px);
}

.journey-description {
  text-align: justify;
  font-family: 'Montserrat', sans-serif;
line-height: 1.6;
    letter-spacing: 0em;
    font-size: 16px;
    width: 510px;
}

/* Responsive adjustments */
@media (max-width: 1024px) {
  .journey-step, .journey-step.reverse {
    flex-direction: column;
    gap: 2rem;
  }
  
  .journey-image, .journey-content {
    flex: none;
    width: 100%;
  }
}

@media (max-width: 600px) {
  .journey-section {
    margin-top: -380px;
    padding: 0 1.5rem;
  }
  .journey-header {
    width: 100%;
    padding: 0 15px;
  }
.journey-header h2 {
  margin-top: 10px;
  font-size: 1.8rem !important;
  margin-bottom: 0;        /* remove default spacing */
  position: relative;       /* allow positioning child elements if needed */
  left: 190px;              /* similar to your translate X */
  top: 15px;      
  width: 400px;
}

.cursived-text {
  display: block;           /* ensure it’s below H2 */
  font-size: 3rem !important;
  position: relative;
  left: -60px;              /* shift horizontally */
  top: 110px;               /* shift vertically */

}
.journey-steps {
  margin-top: -70px;
}
.logo-container {
  display: none;
}
.journey-header h2::after {transform: translate(-125px, 25px);}
  .journey-header h2 {
    font-size: 2.8rem;
  }
  .journey-step.reverse .journey-title {
    transform: translateX(0px);
  }
  .journey-step.reverse .journey-description {
    text-align: left;
    transform: translateX(0px);
    width: 350px;
  }
  .journey-title {
    font-size: 1.5rem;
  }
  
  .journey-description {
    font-size: 1rem;
    width: 350px;
  }
  
  .journey-image img {
    height: 300px;
  }
}
/* Animation Keyframes */
@keyframes slideInLeft {
  0% {
    opacity: 0;
    transform: translateX(-100px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes slideInRight {
  0% {
    opacity: 0;
    transform: translateX(100px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

/* Add animation base styles */
.journey-step {
  opacity: 0;
  animation: slideInLeft 1s ease forwards;
}

.journey-step.reverse {
  animation: slideInRight 1s ease forwards;
}
.journey-image,
.journey-content {
  animation-play-state: paused;
}

/* Animate image and content separately */
.journey-image,
.journey-content {
  opacity: 0;
  animation-duration: 1s;
  animation-fill-mode: forwards;
}

/* Normal step: image from left, content from right */
.journey-step .journey-image {
  animation-name: slideInLeft;
}

.journey-step .journey-content {
  animation-name: slideInRight;
  animation-delay: 0.3s;
}

/* Reverse step: image from right, content from left */
.journey-step.reverse .journey-image {
  animation-name: slideInRight;
}

.journey-step.reverse .journey-content {
  animation-name: slideInLeft;
  animation-delay: 0.3s;
}


/* Testimonials Section */
.testimonials {
  position: relative;
  padding: 8rem 3rem;
  text-align: center;
  overflow: hidden;

  /* Explicit Background Reset */
  
  background-color: white; /* Prevents transparency if image fails */
  background-attachment: scroll; /* Important: prevents "fixed" effect from bleeding */
  background-position: center;
  background-repeat: repeat;
  background-size: auto;

  /* Isolate z-index context */
  z-index: 2;
}


/* Top fade */
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
            to { opacity: 1; }
        }
        
        .testimonial.active {
            display: block;
        }
        
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
 
        .testimonial-dot.active {
            background: var(--secondary);
        }

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
          font-family: 'NewYork', 'Cormorant Garamond', serif;
          font-size: 2.75rem;
          font-weight: 400;
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

        .testimonials-header-line.active {
          transform: scaleX(1);
        }        .testimonials-header-line.active {
          transform: scaleX(1);
        }

         /* mobile view Section for testimonials */
@media (max-width: 956px) {
  .testimonials {
    padding: 4rem 1.5rem;
    margin-bottom: 50px;
  }

  .testimonial-text {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    padding: 0 0.5rem;
  }
.testimonials-header {
  margin-top: 1px;
  margin-bottom: 50px;
}
  .testimonials-title {
   font-family: 'modernline - Personal Use', sans-serif;
    font-size: 1.2rem;
    font-weight: normal;
  }
.testimonials-header h2 {
  font-size: 1.7rem;
  letter-spacing: .3em ;

}
 .testimonials-header h2.testimonials-title {
    font-size: 1.6rem;
 
  }
  .testimonials-header h2.testimonials-main-title {
    letter-spacing: normal;
    font-size: 2.5rem;
    font-weight: normal;
  }
  .testimonial-author {
    font-size: 0.8rem;
    line-height: 1.4;
    padding: 0 0.5rem;
  }

  .testimonial-nav {
    gap: 0.7rem;
    margin-top: 2rem;
  }

  .testimonial-dot {
    width: 8px;
    height: 8px;
  }
}

@media (max-width: 480px) {
  .testimonial-text {
    font-size: 1rem;
    margin-bottom: 1.2rem;
  }

  .testimonial-author {
    font-size: 0.75rem;
  }

  .testimonial-nav {
    margin-top: 1.5rem;
  }
  .testimonial-slider {
  padding: 0 1rem;
}

}

    </style>
</head>
<body class="services-page">
<div class="nav-container">
    <!-- Logo on Left -->
    <div class="nav-logo">
      <a href="index.php">
        <img src="assets\image\logo2.png" alt="Logo">
      </a>
    </div>

    <!-- MENU button on Right -->
    <div class="nav-toggle" id="menuToggle" onclick="toggleMenu()">
      MENU
    </div>

    <!-- Fullscreen Menu Overlay -->
    <div class="nav-links-hero fullscreen-menu" id="mobileMenu">
      <a href="index.php">HOME</a>
      <a href="about.php">ABOUT</a>
      <a href="portfolio.php">GALLERIES</a>
      <a href="veil&varmalaexperience.php">EXPERIENCE</a>
      <a href="services.php">SERVICES</a>
      <a href="inquire.php">INQUIRE</a>
    </div>
  </div>

  <style>
  /* Container */
  .nav-container {
    display: flex;
    justify-content: space-between; /* Logo left, Menu right */
    align-items: center;
    background: #fff;
    padding: 10px 20px;
    z-index: 1000;
    
  }

  /* Logo */
  .nav-logo img {
    width: 150px; /* adjust size */
  }

  /* MENU Button */
  .nav-toggle {
    display: none;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    color: #333;
    z-index: 1100;
  }

  /* Fullscreen Menu */
  .fullscreen-menu {
  
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 25px;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: #fff;
    z-index: 1050;
    padding: 40px 20px;
    transition: all 0.3s ease;
  transform: translateY(-22px);
  }

  .fullscreen-menu.show {
    display: flex;
  }

  /* Menu links */
  .fullscreen-menu a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    font-size: 22px;
    text-align: center;
  }

  /* Show MENU button only on mobile */
  @media (max-width: 768px) {
    .nav-toggle {
      display: block;
    }
  }

  /* Hide mobile nav on desktop if you already have a main nav */
  @media (min-width: 769px) {
    .nav-container {
      display: none;
    }
  }
  </style>

  <script>
  function toggleMenu() {
    const menu = document.getElementById("mobileMenu");
    const toggle = document.getElementById("menuToggle");

    menu.classList.toggle("show");

    if (menu.classList.contains("show")) {
      toggle.textContent = "CLOSE";
    } else {
      toggle.textContent = "MENU";
    }
  }
  </script>

    <section class="hero-text">
           <div class="logo-container">
            <img src="assets/image/logo2.png" 
     alt="Veil & Varmala Logo" 
     class="logotitle" 
     id="logo" 
     style="cursor: pointer;">

<script>
  document.getElementById("logo").addEventListener("click", function() {
    window.location.href = "index.php";
  });
</script>


        </div>
       <div class="nav-links-hero">
         
            <a href="about.php">ABOUT</a>
            <a href="portfolio.php">GALLERIES</a>
            <a href="veil&varmalaexperience.php">EXPERIENCE</a>
            <a href="services.php">SERVICES</a>
            <a href="inquire.php">INQUIRE</a>
          </div>
        </div>
    </section>


    <!-- Hero Section -->
    <section class="hero" id="home">
        <img src="assets/image/img_68c3eefe90c4a0.68164326.jpg" alt="Photography" class="hero-image">
    <!--div class="hero-content">
        
        <h2>The</h2>
        <img src="assets/image/whitelogo.png" alt="Centered Logo" class="hero-logo-about">
         <h2 class="subtext"> EXPERIENCE</h2>

    </div-->
    </section>
    


<!-- The Veil & Vermala Experience Section -->
<section class="journey-section">
  <div class="journey-header">
    <h2>THE VEIL AND VARMALA  <span class="cursived-text">services</span> </h2>
  </div>

  

  
  <div class="journey-steps">

    <!-- Connection -->
    <div class="journey-step">
      <div class="journey-image">
        <img src="assets/image/img_68c3f1270e3269.69480699.jpg" alt="Connection">
      </div>
      <div class="journey-content">
        <h3 class="journey-title">Connection</h3>
        <p class="journey-description">CONNECTION is at the heart of everything we do. From scouting locations to refining your wedding day timeline, we collaborate closely with you, your planner, and your venue to ensure every detail is thoughtfully curated. By working hand in hand during the planning process, we create the perfect conditions for stunning imagery, selecting ideal locations and crafting a seamless flow for your day. Our role goes beyond photography; we guide and support you so you can be fully present, savoring every moment. Through intentional collaboration and clear communication, we capture your celebration with authenticity and elegance, preserving memories that feel natural, timeless, and uniquely yours.</p>
      </div>
    </div>

    <!-- Authenticity -->
    <div class="journey-step reverse">
      <div class="journey-image">
        <img src="assets/image/img_68c3f127126928.26974028.jpg" alt="Authenticity">
      </div>
      <div class="journey-content">
        <h3 class="journey-title">Authenticity</h3>
        <p class="journey-description">We approach every moment with intention, capturing the natural beauty and emotion of your wedding day as it unfolds. Our focus is on creating a visual story that is true to you — blending heartfelt, unscripted moments with a modern, editorial sensibility. Beyond crafting stunning imagery, we aim to provide an experience that allows you to be fully present, celebrating your love without distraction. By documenting your day as it naturally happens — without staging or interference — we capture genuine emotions and intimate connections from the perspective of a guest. For couples who value honesty, emotion, and timeless storytelling, we are committed to preserving your wedding day with elegance, care, and heart.</p>
      </div>
    </div>

    <!-- Quality -->
    <div class="journey-step">
      <div class="journey-image">
        <img src="assets/image/img_68c3f1270fb943.75208667.jpg" alt="Quality">
      </div>
      <div class="journey-content">
        <h3 class="journey-title">Quality</h3>
        <p class="journey-description">As a husband-and-wife duo, we prioritize quality over quantity in our approach to wedding photography. We are devoted to crafting visual legacies for couples who connect deeply with our vision. By intentionally limiting the number of weddings we accept each season, we ensure our full attention, care, and creative energy are dedicated to capturing each love story with intention. Every moment we photograph is thoughtfully considered — we don't capture randomly, but with purpose, framing each detail and emotion to reflect the true essence of your celebration. Our experience spans a wide range of weddings worldwide, from grand multi-day events to intimate ceremonies at private estates.</p>
      </div>
    </div>

    <!-- Legacy -->
    <div class="journey-step reverse">
      <div class="journey-image">
        <img src="assets/image/img_68c3f127197f45.46339112.jpg" alt="Legacy">
      </div>
      <div class="journey-content">
        <h3 class="journey-title">Legacy</h3>
        <p class="journey-description">We believe wedding photographs should be more than a collection of images — they should embody the essence of your love and become a lasting part of your family's legacy. Each image is crafted with intention and care, preserving the emotion and beauty of your day so it can be cherished not only by you, but by generations to come.</p>
      </div>
    </div>

  </div>
</section>
<style>
@media (max-width: 956px) {
  .custom-section {
    max-width: 100%;
    padding: 0 15px;
  }

  .section-image {
    width: 600px !important;
    height: 200px !important; /* landscape height */
    overflow: hidden;
  }

  .section-image img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* maintains landscape */
  }

  .section-title h2 {
    font-size: 32px;
    margin: 30px 0 -30px 0;
  }

  .section-description p {
    text-align: center;
    font-size: 16px;
    margin-top: 30px;
    padding: 55px;


  }
  .section-description{
    margin-bottom: -70px;
  }
}
</style>

<style>
.custom-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  max-width: 2000px;
  margin: 0 auto;
}

/* Row 1: Full-width image */
.section-image {
  width: 100%;
  height: 500px;
  overflow: hidden;
}

.section-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Row 2: Title */
.section-title h2 {
  font-size: 42px;
  margin: 55px 0 10px 0;
  color: #333;
  text-transform: uppercase;
}

/* Row 3: Description */
.section-description p {
  margin-top: 40px;
  margin-bottom: 200px;
  font-size: 18px;
  color: #666;
  max-width: 800px;
  line-height: 1.6;
  padding: 20px;             /* optional, adds spacing inside the border */
  border: 1px solid #333;    /* 1px border */
  box-sizing: border-box;     /* include padding & border in width */
}

</style>

    <!-- Footer -->
<?php include 'footer.php'; ?>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Testimonial slider
        const testimonials = document.querySelectorAll('.testimonial');
        const dots = document.querySelectorAll('.testimonial-dot');
        let currentTestimonial = 0;
        
        function showTestimonial(index) {
            testimonials.forEach(testimonial => testimonial.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
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
        
        // Auto-rotate testimonials
        setInterval(() => {
            currentTestimonial = (currentTestimonial + 1) % testimonials.length;
            showTestimonial(currentTestimonial);
        }, 5000);
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
                
                // Close mobile menu if open
                mobileMenu.classList.remove('active');
                overlay.classList.remove('active');
            });
        });
        
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('overlay');
        
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        
        overlay.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            overlay.classList.remove('active');
        });
        
        // Close menu when clicking on a link
        document.querySelectorAll('.mobile-nav-links a').forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                overlay.classList.remove('active');
            });
        });
    </script>
<script>
  // 1. Observer for .section-header
  document.addEventListener('DOMContentLoaded', function () {
    const header = document.querySelector('.section-header');

    if (header) {
      const headerObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            header.classList.add('active');
          }
        });
      }, { threshold: 0.3 });

      headerObserver.observe(header);
    }
  });
</script>

<script>
  // 2. Observer for .featured-header
  document.addEventListener("DOMContentLoaded", function () {
    const featuredHeader = document.querySelector(".featured-header");

    if (featuredHeader) {
      const featuredObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add("active");
          }
        });
      }, { threshold: 0.3 });

      featuredObserver.observe(featuredHeader);
    }
  });
</script>

<script>
  // 3. Category click logic
  document.querySelectorAll('.category').forEach(category => {
    category.addEventListener('click', function () {
      document.querySelectorAll('.category').forEach(c => {
        if (c !== this) c.classList.remove('active');
      });

      this.classList.toggle('active');
    });
  });

  // 4. Observer for .category-header
  const categoryHeaders = document.querySelectorAll('.category-header');
  const categoryObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('active');
      }
    });
  }, { threshold: 0.5 });

  categoryHeaders.forEach(header => {
    categoryObserver.observe(header);
  });

  // 5. Observer for .testimonials-header-line
  const testimonialsLine = document.querySelector('.testimonials-header-line');
  if (testimonialsLine) {
    const testimonialsObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          testimonialsLine.classList.add('active');
        }
      });
    }, { threshold: 0.5 });

    testimonialsObserver.observe(testimonialsLine);
  }
</script>

<script>
  // 6. Observer for .journey-step animations
  const steps = document.querySelectorAll('.journey-step');

  const journeyObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const image = entry.target.querySelector('.journey-image');
        const content = entry.target.querySelector('.journey-content');
        image.style.animationPlayState = 'running';
        content.style.animationPlayState = 'running';
        entry.target.style.opacity = 1;
      }
    });
  }, { threshold: 0.2 });

  steps.forEach(step => {
    journeyObserver.observe(step);
  });
   document.addEventListener("DOMContentLoaded", function () {
    const divider = document.querySelector(".section-header .divider");

    if (divider) {
      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              divider.classList.add("animate");
              observer.unobserve(divider); // Remove if you want it to animate only once
            }
          });
        },
        {
          threshold: 0.5, // 50% visible
        }
      );

      observer.observe(divider);
    }
  });
</script>


</body>
</html>