<?php
session_start();

// Read the one-time success message set by send_inquiry.php
$successMessage = $_SESSION['success_message'] ?? '';
unset($_SESSION['success_message']);

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquire | Veil & Varmala</title>
    <?php include 'icon.php'; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/modernline-personal-use" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Base Styles */
        :root {
            --primary: #ffffff;
            --secondary: #C3B8AC;
            --tertiary: #323538;
            --textcolor: #333333;
            --dusty-rose: #C7A8A3;
            --sage: #A3B8A7;
            --skintone-color: #DE9B72;
            --dark-color: #3A3D3E;
            --error-color: #c0392b;
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

        @media (min-width: 1024px) {
            .hero-header { padding: 0.6rem 15%; }
            .nav-group-left, .nav-group-right { gap: 6rem; }
            .logo-container .logotitle { height: 70px; }
        }

        @media (max-width: 1023px) {
            .mobile-menu-btn { display: block; }
            .nav-group-left, .nav-group-right { display: none; }
        }

        @media (max-width: 768px) {
            .logo-container .logotitle { height: 42px; }
        }

        @media (max-width: 480px) {
            .logo-container .logotitle { height: 36px; }
        }

        .page-offset {
            height: 75px;
        }

        @media (max-width: 768px) {
            .page-offset { height: 60px; }
        }

        .hero-image-section {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .image-grid {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            gap: 1rem;
            height: 620px;
            width: 100%;
        }

        .portrait-column {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .portrait-column img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .grid-column {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 1fr);
            gap: 1rem;
            width: 100%;
            height: 100%;
        }

        .grid-column img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .grid-item {
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        @media (max-width: 1200px) { .image-grid { height: 500px; } }
        @media (max-width: 992px)  { .image-grid { height: 400px; } }

        @media (max-width: 956px) {
            .hero-image-section { padding: 0 0.5rem; }
            .image-grid {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto;
                height: auto;
                gap: 0.5rem;
            }
            .portrait-column:last-child { display: none; }
            .portrait-column { width: 100%; height: 300px; }
            .grid-column {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: repeat(2, 150px);
                height: auto;
            }
        }

        @media (max-width: 768px) {
            .image-grid { display: block !important; height: 320px !important; }
            .grid-column { display: none !important; }
            .portrait-column { display: none !important; }
            .portrait-column:first-child {
                display: block !important;
                width: 100% !important;
                height: 320px !important;
            }
        }

        @media (max-width: 600px) {
            .image-grid { display: block !important; height: 320px !important; }
            .grid-column { display: none !important; }
            .portrait-column { display: none !important; }
            .portrait-column:first-child {
                display: block !important;
                width: 100% !important;
                height: 320px !important;
            }
        }

        .inquiry-section {
            margin-top: 30px;
            background-color: var(--tertiary);
            width: 100%;
            padding: 4rem 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            text-align: center;
        }

        .inquiry-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
        }

        .inquiry-logo {
            transform: translateY(-35px);
            width: 500px;
            height: auto;
        }

        .inquiry-text h2 {
            margin-left: -10px;
            font-size: 3.7rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .inquiry-text p {
            transform: translateY(-40px);
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            line-height: 1.7;
            color: var(--primary);
        }

        @media (max-width: 900px) {
            .inquiry-text h2 { font-size: 2.2rem; }
            .inquiry-text p { font-size: 1rem; text-align: center; }
            .inquiry-logo { margin-top: 3px; width: 350px; }
            .inquiry-header { margin-bottom: -50px; }
        }

        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .form-column {
            padding: 2rem;
            margin: 0 auto;
            max-width: 800px;
        }

        .form-group {
            margin-bottom: 1.8rem;
        }

        .form-group label {
            display: block;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            color: var(--tertiary);
            font-weight: 500;
        }

        .form-group label .required-star {
            color: var(--error-color);
            margin-left: 3px;
            font-size: 1rem;
            line-height: 1;
            vertical-align: middle;
        }

        .field-error {
            display: none;
            color: var(--error-color);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8rem;
            margin-top: 0.35rem;
            font-weight: 400;
        }

        .form-group.has-error .field-error { display: block; }

        .form-group.has-error .form-control {
            border-color: var(--error-color);
            box-shadow: 0 0 0 2px rgba(192, 57, 43, 0.15);
        }

        .form-control {
            width: 100%;
            padding: 0.9rem;
            border: 1px solid #ddd;
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9f9f9;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--skintone-color);
            box-shadow: 0 0 0 2px rgba(222, 155, 114, 0.2);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23333538' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .btn-submit {
            background-color: var(--tertiary);
            color: white;
            border: none;
            padding: 1.2rem 2.5rem;
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 0.5rem;
        }

        .btn-submit:hover { background-color: var(--secondary); }

        .datepicker-wrapper {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
            width: 100%;
        }

        .datepicker-wrapper label { margin-bottom: 0.5rem; }
        .datepicker-wrapper .field-error { text-align: left; width: 100%; }

        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange,
        .flatpickr-day.selected:hover {
            background: var(--tertiary) !important;
            border-color: var(--tertiary) !important;
            color: var(--primary) !important;
        }

        @media (max-width: 768px) {
            .main-content { padding: 1rem; margin-bottom: 200px; }
            .form-column { padding: 1rem; }
            .inquiry-header h2 { font-size: 2.2rem; }
        }


        /* Centered inquiry success modal */
        .success-modal {
            display: none;
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
            z-index: 999999;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .success-modal-content {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 40px 30px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            animation: successAppear 0.35s ease;
        }

        .success-icon {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: #F3E9E7;
            color: #A47770;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin: 0 auto 20px;
        }

        .success-modal-content h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 36px;
            color: #323538;
            margin-bottom: 8px;
        }

        .success-modal-content h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            letter-spacing: 1px;
            color: #A47770;
            margin-bottom: 15px;
        }

        .success-modal-content p {
            font-family: 'Montserrat', sans-serif;
            color: #777777;
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .success-modal-content button {
            width: 100%;
            padding: 14px;
            background: #323538;
            color: #ffffff;
            border: none;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            letter-spacing: 2px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .success-modal-content button:hover {
            background: #A47770;
        }

        .success-brand {
            display: block;
            margin-top: 22px;
            font-family: 'Montserrat', sans-serif;
            font-size: 9px;
            letter-spacing: 3px;
            color: #A49A94;
        }

        @keyframes successAppear {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

    </style>
</head>
<body class="inquiry-page">

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

<div class="page-offset"></div>

<section class="hero-image-section">
    <div class="image-grid">
        <div class="portrait-column">
            <img src="assets/image/img_68c27287adec26.52647974.jpg" alt="Wedding Photography">
        </div>
        <div class="grid-column">
            <div class="grid-item"><img src="assets/image/img_68c2746e0c6628.21488714.jpg"></div>
            <div class="grid-item"><img src="assets/image/img_68c2746e0b71d1.92140946.jpg"></div>
            <div class="grid-item"><img src="assets/image/img_68c2746e0d3285.85603573.jpg"></div>
            <div class="grid-item"><img src="assets/image/img_68c2746e09b109.92744950.jpg"></div>
        </div>
        <div class="portrait-column">
            <img src="assets/image/img_68c27287af09d6.02600190.jpg">
        </div>
    </div>
</section>

<section class="inquiry-section">
    <div class="inquiry-header">
        <div class="inquiry-text">
            <h2>INQUIRE WITH</h2>
            <img src="assets/image/whitelogo.png" alt="Logo" class="inquiry-logo">
            <p>Please complete the form below to take the first step in bringing your vision to life. <br> We can't wait to hear about your story.</p>
        </div>
    </div>
</section>

<div class="main-content">
    <div style="display: flex; justify-content: center; gap: 1rem; margin-bottom: 2rem;">
        <button onclick="showForm('couple')" id="btn-couple" class="btn-submit" style="width: auto; padding: 0.8rem 2rem;">COUPLE INQUIRY</button>
        <button onclick="showForm('planner')" id="btn-planner" class="btn-submit" style="width: auto; padding: 0.8rem 2rem; background-color: var(--secondary);">PLANNER FORM</button>
    </div>

    <!-- ═══════════════════════════════════════
         COUPLE FORM
    ═══════════════════════════════════════ -->
    <div id="form-couple" class="form-column">
        <form id="couple-form" action="send_inquiry.php" method="POST" novalidate>
            <!-- Honeypot -->
            <input type="text" name="website" style="display:none !important" tabindex="-1" autocomplete="off">
            <!-- CSRF Token -->
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <!-- Form Type -->
            <input type="hidden" name="form_type" value="couple">

            <div class="form-group" id="group-full_name">
                <label for="full_name">Full Name <span class="required-star">*</span></label>
                <input type="text" name="full_name" id="full_name" class="form-control">
                <span class="field-error">This value is required.</span>
            </div>
            <div class="form-group" id="group-instagram">
                <label for="instagram">Instagram Handle <span class="required-star">*</span></label>
                <input type="text" name="instagram" id="instagram" class="form-control">
                <span class="field-error">This value is required.</span>
            </div>
            <div class="form-group" id="group-email">
                <label for="email">Email Address <span class="required-star">*</span></label>
                <input type="email" name="email" id="email" class="form-control">
                <span class="field-error">This value is required.</span>
            </div>
            <div class="form-group" id="group-phone">
                <label for="phone">Phone Number <span class="required-star">*</span></label>
                <input type="tel" name="phone" id="phone" class="form-control">
                <span class="field-error">This value is required.</span>
            </div>
            <div class="form-group datepicker-wrapper" id="group-wedding_date">
                <label for="wedding-date">Wedding Date <span class="required-star">*</span></label>
                <input type="text" name="wedding_date" id="wedding-date" class="form-control" placeholder="Select a date">
                <span class="field-error">This value is required.</span>
            </div>
            <div class="form-group">
                <label for="location">Wedding Location (Venue and City)</label>
                <input type="text" name="location" id="location" class="form-control">
            </div>
            <div class="form-group">
                <label for="wedding-type">Wedding Type?</label>
                <select name="wedding_type" id="wedding-type" class="form-control">
                    <option value="">Select an option</option>
                    <option value="hindu">Hindu</option>
                    <option value="sikh">Sikh</option>
                    <option value="fusion">Fusion</option>
                    <option value="muslim">Muslim</option>
                    <option value="christian">Christian</option>
                </select>
            </div>
            <div class="form-group">
                <label for="reception">Wedding Reception (Venue and City)</label>
                <input type="text" name="reception" id="reception" class="form-control">
            </div>
            <div class="form-group">
                <label for="hear-about">How did you hear about us?</label>
                <input type="text" name="hear_about" id="hear-about" class="form-control">
            </div>
            <div class="form-group">
                <label for="planner">Who is your wedding planner? (If you have one)</label>
                <input type="text" name="planner" id="planner" class="form-control">
            </div>
            <div class="form-group">
                <label for="budget">Estimated Budget for Photography</label>
                <input type="text" name="budget" id="budget" class="form-control">
            </div>
            <div class="form-group">
                <label for="details">Tell us more about your wedding</label>
                <textarea name="details" id="details" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn-submit">SEND INQUIRY</button>
        </form>
    </div>

    <!-- ═══════════════════════════════════════
         PLANNER FORM
    ═══════════════════════════════════════ -->
    <div id="form-planner" class="form-column" style="display: none;">
        <form id="planner-form" action="send_inquiry.php" method="POST" novalidate>
            <!-- Honeypot -->
            <input type="text" name="website" style="display:none !important" tabindex="-1" autocomplete="off">
            <!-- CSRF Token -->
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <!-- Form Type -->
            <input type="hidden" name="form_type" value="planner">

            <div class="form-group" id="group-planner_name">
                <label for="planner_name">Your First and Last Name <span class="required-star">*</span></label>
                <input type="text" name="planner_name" id="planner_name" class="form-control">
                <span class="field-error">This value is required.</span>
            </div>
            <div class="form-group" id="group-planner_email">
                <label for="planner_email">Planner Email Address <span class="required-star">*</span></label>
                <input type="email" name="planner_email" id="planner_email" class="form-control">
                <span class="field-error">This value is required.</span>
            </div>
            <div class="form-group" id="group-couple_names">
                <label for="couple_names">What are the names of your couple? <span class="required-star">*</span></label>
                <input type="text" name="couple_names" id="couple_names" class="form-control">
                <span class="field-error">This value is required.</span>
            </div>
            <div class="form-group datepicker-wrapper" id="group-planner_wedding_date">
                <label for="planner-wedding-date">Wedding Event Dates <span class="required-star">*</span></label>
                <input type="text" name="planner_wedding_date" id="planner-wedding-date" class="form-control" placeholder="Select a date">
                <span class="field-error">This value is required.</span>
            </div>
            <div class="form-group">
                <label for="planner_venue">Wedding Venue and Reception</label>
                <input type="text" name="planner_venue" id="planner_venue" class="form-control">
            </div>
            <div class="form-group">
                <label for="planner_budget">Planned Photography Investment (USD)</label>
                <input type="text" name="planner_budget" id="planner_budget" class="form-control">
            </div>
            <div class="form-group">
                <label for="planner_hear">How did you hear about us?</label>
                <input type="text" name="planner_hear" id="planner_hear" class="form-control">
            </div>
            <div class="form-group">
                <label for="planner_details">Tell us more about the couple</label>
                <textarea name="planner_details" id="planner_details" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn-submit">SEND INQUIRY</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#wedding-date", { dateFormat: "m/d/Y", minDate: "today", clickOpens: true });
    flatpickr("#planner-wedding-date", { dateFormat: "m/d/Y", minDate: "today", clickOpens: true });

    function showForm(type) {
        document.getElementById('form-couple').style.display  = type === 'couple'  ? 'block' : 'none';
        document.getElementById('form-planner').style.display = type === 'planner' ? 'block' : 'none';
        document.getElementById('btn-couple').style.backgroundColor  = type === 'couple'  ? 'var(--tertiary)' : 'var(--secondary)';
        document.getElementById('btn-planner').style.backgroundColor = type === 'planner' ? 'var(--tertiary)' : 'var(--secondary)';
    }

    function validateField(field, groupId) {
        const group = document.getElementById(groupId);
        if (!group) return true;
        if (field.value.trim() === '') {
            group.classList.add('has-error');
            return false;
        } else {
            group.classList.remove('has-error');
            return true;
        }
    }

    function clearOnInput(fieldId, groupId) {
        const field = document.getElementById(fieldId);
        if (!field) return;
        ['input', 'change'].forEach(evt => {
            field.addEventListener(evt, function () {
                if (field.value.trim() !== '') {
                    const group = document.getElementById(groupId);
                    if (group) group.classList.remove('has-error');
                }
            });
        });
    }

    const coupleRequired = [
        { fieldId: 'full_name',    groupId: 'group-full_name'    },
        { fieldId: 'instagram',    groupId: 'group-instagram'    },
        { fieldId: 'email',        groupId: 'group-email'        },
        { fieldId: 'phone',        groupId: 'group-phone'        },
        { fieldId: 'wedding-date', groupId: 'group-wedding_date' },
    ];

    const plannerRequired = [
        { fieldId: 'planner_name',         groupId: 'group-planner_name'         },
        { fieldId: 'planner_email',        groupId: 'group-planner_email'        },
        { fieldId: 'couple_names',         groupId: 'group-couple_names'         },
        { fieldId: 'planner-wedding-date', groupId: 'group-planner_wedding_date' },
    ];

    [...coupleRequired, ...plannerRequired].forEach(r => clearOnInput(r.fieldId, r.groupId));

    document.getElementById('couple-form').addEventListener('submit', function(e) {
        let isValid = true;
        let firstInvalidGroup = null;
        coupleRequired.forEach(r => {
            const field = document.getElementById(r.fieldId);
            const valid = validateField(field, r.groupId);
            if (!valid && !firstInvalidGroup) firstInvalidGroup = document.getElementById(r.groupId);
            if (!valid) isValid = false;
        });
        if (!isValid) {
            e.preventDefault();
            if (firstInvalidGroup) firstInvalidGroup.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    document.getElementById('planner-form').addEventListener('submit', function(e) {
        let isValid = true;
        let firstInvalidGroup = null;
        plannerRequired.forEach(r => {
            const field = document.getElementById(r.fieldId);
            const valid = validateField(field, r.groupId);
            if (!valid && !firstInvalidGroup) firstInvalidGroup = document.getElementById(r.groupId);
            if (!valid) isValid = false;
        });
        if (!isValid) {
            e.preventDefault();
            if (firstInvalidGroup) firstInvalidGroup.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    // Mobile menu
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


    // Close the centered success message without leaving inquire.php
    function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

</script>


<!-- SUCCESS MODAL -->
<div id="successModal" class="success-modal" role="dialog" aria-modal="true" aria-labelledby="successTitle" <?php echo !empty($successMessage) ? 'style="display: flex;"' : ''; ?>>
    <div class="success-modal-content">
        <div class="success-icon" aria-hidden="true">&#10003;</div>
        <h2 id="successTitle">Thank You!</h2>
        <h3>INQUIRY RECEIVED</h3>
        <p><?php echo htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8'); ?></p>
        <button type="button" onclick="closeSuccessModal()">OK</button>
        <span class="success-brand">VEIL &amp; VARMALA</span>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>