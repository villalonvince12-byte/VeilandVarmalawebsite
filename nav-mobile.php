<!-- nav-mobile.php -->
<div class="mobile-nav-container">
  <!-- Logo -->
  <div class="mobile-nav-logo">
    <a href="index.php">
      <img src="assets/image/logo2.png" alt="Logo">
    </a>
  </div>

  <!-- One toggle button: hamburger turns into X -->
  <button class="mobile-nav-toggle" id="mobileMenuToggle"
          aria-label="Open menu" aria-expanded="false" aria-controls="mobileMenu" type="button">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
         stroke-width="2" stroke-linecap="round" aria-hidden="true">
      <line class="bar bar-top"    x1="3" y1="6"  x2="21" y2="6"></line>
      <line class="bar bar-middle" x1="3" y1="12" x2="21" y2="12"></line>
      <line class="bar bar-bottom" x1="3" y1="18" x2="21" y2="18"></line>
    </svg>
  </button>

  <!-- Fullscreen Overlay Menu -->
  <div class="mobile-fullscreen-menu" id="mobileMenu" aria-hidden="true">
    <div class="mobile-fullscreen-header">
      <div class="mobile-nav-logo">
        <a href="index.php">
          <img src="assets/image/logo2.png" alt="Logo">
        </a>
      </div>
    </div>

    <nav class="mobile-fullscreen-links">
      <a href="index.php">HOME</a>
      <a href="about.php">ABOUT</a>
      <a href="portfolio.php">GALLERIES</a>
      <a href="veil&amp;varmalaexperience.php">EXPERIENCE</a>
      <a href="inquire.php">INQUIRE</a>
    </nav>
  </div>
</div>

<style>
/* ===== Shared sizes (same in closed and open states) ===== */
:root {
  --nav-pad-y: 12px;
  --nav-pad-x: 20px;
  --nav-logo-w: 140px;
  --nav-btn: 44px;
  --nav-header-h: calc(var(--nav-pad-y) * 2 + var(--nav-btn));
}

/* ===== Top bar ===== */
.mobile-nav-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #fff;
  padding: var(--nav-pad-y) var(--nav-pad-x);
  position: relative;
  z-index: 1000;
  box-sizing: border-box;
  width: 100%;
}

.mobile-nav-logo img {
  width: var(--nav-logo-w);
  max-width: 100%;
  height: auto;
  display: block;
}

/* ===== Toggle button ===== */
.mobile-nav-toggle {
  display: flex;
  align-items: center;
  justify-content: center;
  width: var(--nav-btn);
  height: var(--nav-btn);
  padding: 0;
  cursor: pointer;
  background: none;
  border: none;
  color: #333;
  z-index: 1100;
  -webkit-tap-highlight-color: transparent;
}

.mobile-nav-toggle svg {
  display: block;
  pointer-events: none;
}

.mobile-nav-toggle:focus-visible {
  outline: 2px solid #333;
  outline-offset: 2px;
}

.mobile-nav-toggle .bar {
  transform-box: fill-box;
  transform-origin: center;
  transition: transform 0.3s ease, opacity 0.2s ease;
}

.mobile-nav-toggle.is-open .bar-top    { transform: translateY(6px) rotate(45deg); }
.mobile-nav-toggle.is-open .bar-middle { opacity: 0; }
.mobile-nav-toggle.is-open .bar-bottom { transform: translateY(-6px) rotate(-45deg); }

/* Open: the X sits exactly where the hamburger was */
.mobile-nav-toggle.is-open {
  position: fixed;
  top: var(--nav-pad-y);
  right: var(--nav-pad-x);
}

/* ===== Fullscreen overlay ===== */
#mobileMenu.mobile-fullscreen-menu {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;   /* fallback */
  height: 100dvh;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  background: #fff;
  z-index: 1050;
  transform: none !important;

  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  transition: opacity 0.25s ease, visibility 0.25s ease;
}

#mobileMenu.mobile-fullscreen-menu.show {
  opacity: 1;
  visibility: visible;
  pointer-events: auto;
}

/* Logo bar: pinned to the top, same position as the closed bar */
#mobileMenu .mobile-fullscreen-header {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-sizing: border-box;
  height: var(--nav-header-h);
  padding: var(--nav-pad-y) var(--nav-pad-x);
  background: #fff;
  z-index: 2;
}

/* Links: fill the whole screen and center in the middle.
   Equal top and bottom padding = the middle of the list is the
   middle of the screen, and it can never go under the logo bar. */
#mobileMenu .mobile-fullscreen-links {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  right: 0;
  bottom: 0;
  transform: none !important;
  margin: 0 !important;
  box-sizing: border-box;
  padding: var(--nav-header-h) var(--nav-pad-x);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: clamp(10px, 3vh, 25px);
  overflow-y: auto;
  z-index: 1;
}

/* margin:auto = safe centering (scrolls instead of overlapping) */
#mobileMenu .mobile-fullscreen-links a:first-child { margin-top: auto !important; }
#mobileMenu .mobile-fullscreen-links a:last-child  { margin-bottom: auto !important; }

#mobileMenu .mobile-fullscreen-links a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
  font-size: clamp(16px, 3.8vh, 22px);   /* shrinks on short screens */
  line-height: 1.2;
  text-align: center;
  transition: color 0.2s ease;
}

#mobileMenu .mobile-fullscreen-links a:hover,
#mobileMenu .mobile-fullscreen-links a:focus-visible {
  color: #666;
}

body.menu-open {
  overflow: hidden;
}

/* Larger screens: bigger, but identical in closed and open states */
@media (min-width: 769px) {
  :root {
    --nav-pad-y: 16px;
    --nav-pad-x: 40px;
    --nav-logo-w: 160px;
  }
  #mobileMenu .mobile-fullscreen-links a {
    font-size: clamp(18px, 4vh, 28px);
  }
}

/* Legacy elements (mobile only, as before) */
@media (max-width: 768px) {
  .hero-header,
  #mobileMenuBtn,
  .mobile-menu-btn {
    display: none !important;
    pointer-events: none !important;
  }
}
</style>

<script>
(function () {
  var menu, toggle;

  function setMobileMenuState(isOpen) {
    if (!menu || !toggle) return;

    menu.classList.toggle("show", isOpen);
    menu.setAttribute("aria-hidden", String(!isOpen));
    document.body.classList.toggle("menu-open", isOpen);

    toggle.classList.toggle("is-open", isOpen);
    toggle.setAttribute("aria-expanded", String(isOpen));
    toggle.setAttribute("aria-label", isOpen ? "Close menu" : "Open menu");
  }

  document.addEventListener("DOMContentLoaded", function () {
    menu = document.getElementById("mobileMenu");
    toggle = document.getElementById("mobileMenuToggle");
    if (!menu || !toggle) return;

    toggle.addEventListener("click", function () {
      setMobileMenuState(!menu.classList.contains("show"));
    });

    menu.querySelectorAll(".mobile-fullscreen-links a").forEach(function (link) {
      link.addEventListener("click", function () {
        setMobileMenuState(false);
      });
    });

    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && menu.classList.contains("show")) {
        setMobileMenuState(false);
      }
    });

    document.querySelectorAll("#mobileMenuBtn, .mobile-menu-btn").forEach(function (button) {
      button.style.display = "none";
      button.style.pointerEvents = "none";
      button.setAttribute("aria-hidden", "true");
      button.disabled = true;
    });

    setMobileMenuState(false);
  });
})();
</script>