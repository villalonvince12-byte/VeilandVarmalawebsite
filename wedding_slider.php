<?php
// Wedding Photography - Image Slider
// Auto-slides to the right every 3 seconds, smooth transition
// Place your 33 images in the /images/ folder and update the $images array below

$images = [
    // Replace these with your actual image paths (all 33 images)
    'images/photo_01.jpg',
    'images/photo_02.jpg',
    'images/photo_03.jpg',
    'images/photo_04.jpg',
    'images/photo_05.jpg',
    'images/photo_06.jpg',
    'images/photo_07.jpg',
    'images/photo_08.jpg',
    'images/photo_09.jpg',
    'images/photo_10.jpg',
    'images/photo_11.jpg',
    'images/photo_12.jpg',
    'images/photo_13.jpg',
    'images/photo_14.jpg',
    'images/photo_15.jpg',
    'images/photo_16.jpg',
    'images/photo_17.jpg',
    'images/photo_18.jpg',
    'images/photo_19.jpg',
    'images/photo_20.jpg',
    'images/photo_21.jpg',
    'images/photo_22.jpg',
    'images/photo_23.jpg',
    'images/photo_24.jpg',
    'images/photo_25.jpg',
    'images/photo_26.jpg',
    'images/photo_27.jpg',
    'images/photo_28.jpg',
    'images/photo_29.jpg',
    'images/photo_30.jpg',
    'images/photo_31.jpg',
    'images/photo_32.jpg',
    'images/photo_33.jpg',
];

$total = count($images);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preserving Your Legacy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Montserrat:wght@200;300;400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #fff;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 40px 0 60px;
        }

        /* ── Logo ── */
        .logo {
            width: 72px;
            height: 90px;
            border: 1px solid #2a2a2a;
            border-radius: 50% / 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 32px;
        }
        .logo span {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 300;
            letter-spacing: 1px;
            color: #2a2a2a;
        }

        /* ── Headline ── */
        .headline {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(32px, 5vw, 64px);
            font-weight: 300;
            letter-spacing: 6px;
            color: #2a2a2a;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.1;
            margin-bottom: 14px;
        }
        .headline em {
            font-style: italic;
            font-weight: 300;
        }

        .subhead {
            font-size: clamp(9px, 1.1vw, 11px);
            font-weight: 300;
            letter-spacing: 4px;
            color: #888;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 48px;
        }

        /* ── Slider Wrapper ── */
        .slider-outer {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .slider-track {
            display: flex;
            will-change: transform;
            transition: transform 0.8s cubic-bezier(0.45, 0.05, 0.28, 0.98);
        }

        /* Each slide = exactly 1/5 of the viewport, minus gaps */
        .slide {
            flex: 0 0 calc(20% - 5px); /* 5 slides, 4 gaps of 6px = 24px total / 5 ≈ 5px each */
            width: calc(20% - 5px);
            height: 400px;
            margin-right: 6px;
            overflow: hidden;
            border-radius: 3px;
        }

        /* Remove margin from last visible slide */
        .slide:last-child {
            margin-right: 0;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.6s ease;
        }

        .slide:hover img {
            transform: scale(1.04);
        }

        /* ── Dot Indicators ── */
        .dots {
            display: flex;
            gap: 6px;
            justify-content: center;
            margin-top: 28px;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #ccc;
            cursor: pointer;
            border: none;
            padding: 0;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .dot.active {
            background: #2a2a2a;
            transform: scale(1.25);
        }

        /* ── Nav Arrows ── */
        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.85);
            border: 1px solid #ddd;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: background 0.2s;
            color: #2a2a2a;
        }
        .nav-btn:hover { background: #fff; }
        .nav-prev { left: 14px; }
        .nav-next { right: 14px; }
    </style>
</head>
<body>

    <!-- Logo -->
    <div class="logo"><span>W<sub style="font-size:14px">B</sub></span></div>

    <!-- Headline -->
    <h1 class="headline">Preserving Your <em>Legacy</em></h1>
    <p class="subhead">Through artful photographs that will stand the test of time</p>

    <!-- Slider -->
    <div class="slider-outer" id="sliderOuter">
        <button class="nav-btn nav-prev" id="prevBtn" aria-label="Previous">&#8592;</button>
        <button class="nav-btn nav-next" id="nextBtn" aria-label="Next">&#8594;</button>

        <div class="slider-track" id="sliderTrack">
            <?php foreach ($images as $src): ?>
                <div class="slide">
                    <img
                        src="<?= htmlspecialchars($src) ?>"
                        alt="Wedding photo"
                        loading="lazy"
                    >
                </div>
            <?php endforeach; ?>

            <!-- Cloned slides for seamless infinite loop (first ~6 repeated at end) -->
            <?php foreach (array_slice($images, 0, 6) as $src): ?>
                <div class="slide clone">
                    <img
                        src="<?= htmlspecialchars($src) ?>"
                        alt="Wedding photo"
                        loading="lazy"
                    >
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Dots -->
    <div class="dots" id="dots">
        <?php for ($i = 0; $i < $total; $i++): ?>
            <button
                class="dot <?= $i === 0 ? 'active' : '' ?>"
                data-index="<?= $i ?>"
                aria-label="Go to slide <?= $i + 1 ?>"
            ></button>
        <?php endfor; ?>
    </div>

<script>
(function () {
    const TOTAL        = <?= $total ?>;   // real image count from PHP
    const GAP          = 6;              // px – must match CSS margin-right
    const INTERVAL_MS  = 3000;           // 3 seconds

    // Measure actual rendered slide width so it's always responsive
    const firstSlide   = document.querySelector('.slide');
    const SLIDE_WIDTH  = firstSlide.getBoundingClientRect().width;
    const STEP_PX      = SLIDE_WIDTH + GAP;

    const track  = document.getElementById('sliderTrack');
    const dots   = document.querySelectorAll('.dot');
    const prevBtn= document.getElementById('prevBtn');
    const nextBtn= document.getElementById('nextBtn');

    let currentIndex = 0;   // 0-based, tracks real images (0 … TOTAL-1)
    let isTransitioning = false;
    let timer;

    /* ── Move track without animation (for infinite-loop reset) ── */
    function jumpTo(index) {
        track.style.transition = 'none';
        track.style.transform  = `translateX(-${index * STEP_PX}px)`;
        // Force reflow so the next transition starts from this position
        track.getBoundingClientRect();
        track.style.transition = '';  // restore CSS transition
    }

    /* ── Animate to a target index ── */
    function slideTo(index) {
        if (isTransitioning) return;
        isTransitioning = true;

        currentIndex = index;
        track.style.transform = `translateX(-${currentIndex * STEP_PX}px)`;

        // Update dots (wrap around)
        const dotIndex = ((currentIndex % TOTAL) + TOTAL) % TOTAL;
        dots.forEach((d, i) => d.classList.toggle('active', i === dotIndex));
    }

    /* ── After transition ends, handle infinite loop reset ── */
    track.addEventListener('transitionend', () => {
        isTransitioning = false;

        // If we've scrolled past the real images into the clone zone, jump back silently
        if (currentIndex >= TOTAL) {
            currentIndex = currentIndex - TOTAL;
            jumpTo(currentIndex);
        } else if (currentIndex < 0) {
            currentIndex = currentIndex + TOTAL;
            jumpTo(currentIndex);
        }
    });

    /* ── Auto-advance every 3 s (slide RIGHT = index + 1) ── */
    function startAuto() {
        clearInterval(timer);
        timer = setInterval(() => {
            slideTo(currentIndex + 1);
        }, INTERVAL_MS);
    }

    /* ── Arrow buttons ── */
    nextBtn.addEventListener('click', () => {
        slideTo(currentIndex + 1);
        startAuto(); // reset timer on manual interaction
    });

    prevBtn.addEventListener('click', () => {
        slideTo(currentIndex - 1);
        startAuto();
    });

    /* ── Dot clicks ── */
    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            const idx = parseInt(dot.dataset.index, 10);
            slideTo(idx);
            startAuto();
        });
    });

    /* ── Pause on hover ── */
    const outer = document.getElementById('sliderOuter');
    outer.addEventListener('mouseenter', () => clearInterval(timer));
    outer.addEventListener('mouseleave', startAuto);

    /* ── Touch / swipe support ── */
    let touchStartX = 0;
    outer.addEventListener('touchstart', e => {
        touchStartX = e.touches[0].clientX;
        clearInterval(timer);
    }, { passive: true });
    outer.addEventListener('touchend', e => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) {
            slideTo(currentIndex + (diff > 0 ? 1 : -1));
        }
        startAuto();
    }, { passive: true });

    /* ── Init ── */
    jumpTo(0);
    startAuto();
})();
</script>
</body>
</html>
