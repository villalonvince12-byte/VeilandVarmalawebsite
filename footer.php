<style>
/* =====================
   Footer Styles
===================== */
footer {
  background: var(--tertiary);
  color: var(--primary);
  text-align: center;
  padding: 2.5rem 2rem; /* reduce vertical padding */
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem; /* reduce space between items */
  /* remove margin-bottom completely */
}
.footer-menu {
  display: none;
}
/* 1️⃣ Navigation Links */
.footer-links {
  display: flex;
  gap: 2rem;
  flex-wrap: wrap;
  transform: translateY(10px);
}

.footer-links a {
  font-family: 'Montserrat', sans-serif;
  font-size: 1rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--primary);
  text-decoration: none;
}

.footer-links a:hover {
  color: var(--secondary);
}

/* 2️⃣ Picture Grid */
.footer-grid {
  margin-left: -20px;
  display: grid;
  grid-template-columns: repeat(6, 271.5px); /* fixed 6 columns */
  grid-template-rows: repeat(2, 271.5px);    /* fixed 2 rows */
  gap: 5px;
  transform: translateY(40px);
}
.footer-grid img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.3s ease, filter 0.3s ease;

  /* Soft white tone effect */
  background-color: rgba(255, 255, 255, 0.15);
  mix-blend-mode: lighten; /* applies soft white overlay */

  /* ✨ Fade-in effect */
  opacity: 0;
  transform: scale(1.05);
  transition: opacity 0.8s ease, transform 0.8s ease;
}
.footer-grid img.loaded {
  opacity: 1;
  transform: scale(1);
}

/* 3️⃣ Logo */
.footer-logo img {
  width: 550px;
  height: auto;
  transform: translateY(40px);
}

/* 4️⃣ Subtext */
.footer-subtext {
  font-family: 'Montserrat', sans-serif;
  font-size: 0.8rem;
  opacity: 0.7;
  transform: translateY(10px);
}

/* 5️⃣ Social Icons */
.footer-social {
  display: flex;
  gap: 1.5rem;
  justify-content: center;
  transform: translateY(20px);
}

.footer-social a {
  font-size: 1.4rem;
  color: var(--primary);
  transition: transform 0.3s ease, color 0.3s ease;
}

.footer-social a:hover {
  transform: scale(1.2);
  color: var(--secondary);
}

/* Responsive */
@media (max-width: 1400px) {
  .footer-grid {
    grid-template-columns: repeat(3, 200px);
    grid-template-rows: repeat(4, 200px);
  }
  .footer-grid img {
    width: 200px;
    height: 200px;
  }
}

@media (max-width: 956px) {
  /* Footer Grid: 2x2 */
  .footer-grid {
    grid-template-columns: repeat(2, 176px);
    grid-template-rows: repeat(2, 176px);
    gap: 5px; /* ✅ Add gap between grid items */
  }
  .footer-links {
    display: none 
  }
  .footer-grid img {
    margin-left: -15px;
    width: 176px;
    height: 176px;
  }

  /* Hide all images after the first 4 */
  .footer-grid a:nth-child(n+5) {
    display: none;
  }

  .footer-logo img {
    width: 350px;
  }
  .footer-subtext {
    transform: translateY(10px);
  }
  .footer-social a {
    margin-top: -20px;
    font-size: 1.5rem;
  }
  .footer-grid-wrapper .footer-card {
    display: none !important; /* ensures it hides even with inline styles */
  }
  .footer-menu {
    display: block;
    font-family: 'Montserrat', sans-serif;
    font-size: 1.3rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--primary);
    text-decoration: none;
    transform: translate(-140px, -20px);
    margin-bottom: -50px;
  }

}
@media (max-width: 600px) {
  /* Footer Grid: 2x2 for phones */
  .footer-grid {
    grid-template-columns: repeat(2, 150px);
    grid-template-rows: repeat(2, 150px);
    gap: 5px; /* ✅ Add gap between grid items */
  }

  .footer-links {
    display: none;
  }

  .footer-grid img {
    margin-left: 0px;
    width: 150px;
    height: 150px;
  }

  /* Hide all images after the first 4 */
  .footer-grid a:nth-child(n+5) {
    display: none;
  }

  .footer-logo img {
    width: 280px;
  }

  .footer-subtext {
    transform: translateY(8px);
  }

  .footer-social a {
    margin-top: -15px;
    font-size: 1.3rem;
  }

  .footer-grid-wrapper .footer-card {
    display: none !important; /* ensures it hides even with inline styles */
  }

  .footer-menu {
    display: block;
    font-family: 'Montserrat', sans-serif;
    font-size: 1.1rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--primary);
    text-decoration: none;
    transform: translate(-100px, -15px);
    margin-bottom: -40px;
  }
}


</style>

<footer>
<!--
<div class="footer-menu" id="footerMenu" onclick="toggleMenu(this)">
  MENU
</div>
  <div class="footer-links">
    <a href="about.php">ABOUT</a>
    <a href="portfolio.php">GALLERIES</a>
    <a href="veil&varmalaexperience.php">EXPERIENCE</a>
    <a href="services.php">SERVICES</a>
    <a href="inquire.php">INQUIRE</a>
  </div>
-->
<!-- 2️⃣ Picture Grid with Semi-Transparent White Card & Logo -->
<div class="footer-grid-wrapper" style="position: relative; width: max-content; margin: 0 auto;">

<?php
include 'db_connect.php';

// Fetch images
$sql = "SELECT image_name FROM footer ORDER BY id ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="footer-grid">';
    while($row = $result->fetch_assoc()) {
        $image = htmlspecialchars($row['image_name']);
     echo '<a href="portfolio.php">
        <img 
          src="uploads/' . $image . '" 
          alt="' . pathinfo($image, PATHINFO_FILENAME) . '" 
          loading="lazy" 
          decoding="async" 
          style="width:100%; height:100%; object-fit:cover;" 
          srcset="uploads/' . $image . ' 400w, uploads/' . $image . ' 800w" 
          sizes="(max-width: 956px) 176px, (max-width: 1400px) 200px, 271.5px"
        >
      </a>';
    }
    echo '</div>';
} else {
    echo '<p>No images found in the footer.</p>';
}

$conn->close();
?>

  <!-- Semi-Transparent White Card -->
  <div class="footer-card" style="
      position: absolute;
      top: 57.5%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 500px;
      height: 200px;
      background: rgba(255, 255, 255, 0.85); /* ✅ semi-transparent */
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      z-index: 5;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 1rem;
      text-align: center;
    ">
    <!-- Logo on Card -->
    <img src="assets/image/logo.png" alt="Veil & Varmala Logo" style="width:125px; height: auto; margin-bottom: 1rem;">
</div>

</div>

  <!-- 3️⃣ Logo -->
  <div class="footer-logo">
    <img src="assets/image/whitelogo.png" alt="Veil & Varmala Logo">
  </div>

  <!-- 4️⃣ Subtext -->
  <div class="footer-subtext">
    © 2023 Veil & Varmala Photography. <br> All rights reserved.
  </div>

  <!-- 5️⃣ Social Links -->
  <div class="footer-social">
    <a href="https://www.instagram.com/veilandvarmala/" target="_blank"><i class="fab fa-instagram"></i></a>
    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
    <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
  </div>
</footer>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const images = document.querySelectorAll(".footer-grid img");

  images.forEach((img, index) => {
    img.addEventListener("load", () => {
      // Add staggered delay for smoothness
      setTimeout(() => {
        img.classList.add("loaded");
      }, index * 150);
    });

    // In case image is already cached
    if (img.complete) {
      setTimeout(() => {
        img.classList.add("loaded");
      }, index * 150);
    }
  });
});
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
