<?php
session_start();
require 'db_connect.php';
require 'assets/PHPMailer/Exception.php';
require 'assets/PHPMailer/PHPMailer.php';
require 'assets/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

$config = require __DIR__ . '/config.php';

// ------------------------------------------------------------
// Helpers
// ------------------------------------------------------------
function clean($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

function fail_alert($message, $goBack = true) {
    $msg = json_encode($message);
    $after = $goBack ? "history.back();" : "window.location.href='inquire.php';";
    echo "<script>alert($msg); $after</script>";
    exit;
}

// Store a one-time message, then return to the existing inquire page.
function success_redirect($message) {
    $_SESSION['success_message'] = $message;
    header('Location: inquire.php');
    exit;
}

/**
 * Sends the notification email. Returns true on success, false on failure.
 * The real error is written to the PHP error log (xampp/logs/php_error_log).
 */
function send_mail(array $config, $replyEmail, $replyName, $subject, $htmlBody) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $config['smtp_host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['smtp_user'];
        $mail->Password   = $config['smtp_pass'];
        $mail->SMTPSecure = $config['smtp_secure'] === 'tls'
            ? PHPMailer::ENCRYPTION_STARTTLS
            : PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = $config['smtp_port'];
        $mail->CharSet    = 'UTF-8';

        if (!empty($config['smtp_debug'])) {
            $mail->SMTPDebug   = 2;
            $mail->Debugoutput = 'error_log';
        }

        $mail->setFrom($config['smtp_user'], $config['from_name']);
        $mail->addAddress($config['to_email'], $config['to_name']);
        $mail->addReplyTo($replyEmail, $replyName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->addCustomHeader('X-Entity-Ref-ID', uniqid());
        $mail->Body    = $htmlBody;
        $mail->AltBody = strip_tags(str_replace(['<br>', '<br />', '</p>'], "\n", $htmlBody));

        $mail->send();
        return true;
    } catch (\Throwable $e) {
        error_log("PHPMailer Error: " . $mail->ErrorInfo . " | " . $e->getMessage());
        return false;
    }
}

// ------------------------------------------------------------
// 1. Must be POST
// ------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Direct access not allowed.");
}

// 2. Honeypot
if (!empty($_POST['website'])) {
    die("Submission successful!");
}

// 3. CSRF token
if (
    empty($_POST['token']) ||
    empty($_SESSION['token']) ||
    !hash_equals($_SESSION['token'], $_POST['token'])
) {
    die("Session expired or invalid request. Please refresh the page.");
}

// 4. Detect form type
$form_type = clean($_POST['form_type'] ?? 'couple');

// ============================================================
// COUPLE FORM
// ============================================================
if ($form_type === 'couple') {

    $full_name    = clean($_POST['full_name'] ?? '');
    $instagram    = clean($_POST['instagram'] ?? '');
    $email        = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $phone        = clean($_POST['phone'] ?? '');
    $wedding_date = clean($_POST['wedding_date'] ?? '');
    $location     = clean($_POST['location'] ?? '');
    $reception    = clean($_POST['reception'] ?? '');
    $wedding_type = clean($_POST['wedding_type'] ?? '');
    $hear_about   = clean($_POST['hear_about'] ?? '');
    $planner      = clean($_POST['planner'] ?? '');
    $budget       = clean($_POST['budget'] ?? '');
    $details      = clean($_POST['details'] ?? '');

    if (empty($full_name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        fail_alert("Please provide a valid name and email address.");
    }

    // Save to database
    try {
        $stmt = $conn->prepare("INSERT INTO inquiries
            (type, full_name, instagram, email, phone, wedding_date, location, reception, wedding_type, hear_about, planner, budget, details)
            VALUES ('couple', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssss",
            $full_name, $instagram, $email, $phone,
            $wedding_date, $location, $reception, $wedding_type,
            $hear_about, $planner, $budget, $details
        );
        $stmt->execute();
        $stmt->close();
    } catch (\Throwable $e) {
        error_log("DB Error (couple): " . $e->getMessage());
        fail_alert("Sorry, we couldn't save your inquiry. Please try again later.");
    }

    // Send email
    $body = "
        <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
            <h2 style='color: #d4af37;'>New Couple Inquiry</h2>
            <hr>
            <p><b>Name:</b> $full_name</p>
            <p><b>Instagram:</b> $instagram</p>
            <p><b>Email:</b> $email</p>
            <p><b>Phone:</b> $phone</p>
            <p><b>Wedding Date:</b> $wedding_date</p>
            <p><b>Location:</b> $location</p>
            <p><b>Reception:</b> $reception</p>
            <p><b>Wedding Type:</b> $wedding_type</p>
            <p><b>How they heard about us:</b> $hear_about</p>
            <p><b>Planner:</b> $planner</p>
            <p><b>Budget:</b> $budget</p>
            <p><b>Details:</b><br>" . nl2br($details) . "</p>
            <hr>
            <p style='font-size: 0.8em; color: #777;'>Sent from Veil &amp; Varmala contact form.</p>
        </div>
    ";

    $sent = send_mail($config, $email, $full_name, "Couple Inquiry: $full_name | $wedding_date", $body);

    // Prevent reuse of the submitted form token.
    unset($_SESSION['token']);

    if ($sent) {
        success_redirect("Inquiry Sent Successfully!");
    }

    // Saved in DB but email failed: don't make the visitor resubmit.
    success_redirect("Thank you! Your inquiry was received. We will be in touch soon.");

// ============================================================
// PLANNER FORM
// ============================================================
} elseif ($form_type === 'planner') {

    $planner_name         = clean($_POST['planner_name'] ?? '');
    $planner_email        = filter_var($_POST['planner_email'] ?? '', FILTER_SANITIZE_EMAIL);
    $couple_names         = clean($_POST['couple_names'] ?? '');
    $planner_wedding_date = clean($_POST['planner_wedding_date'] ?? '');
    $planner_venue        = clean($_POST['planner_venue'] ?? '');
    $planner_budget       = clean($_POST['planner_budget'] ?? '');
    $planner_hear         = clean($_POST['planner_hear'] ?? '');
    $planner_details      = clean($_POST['planner_details'] ?? '');

    if (empty($planner_name) || !filter_var($planner_email, FILTER_VALIDATE_EMAIL)) {
        fail_alert("Please provide a valid name and email address.");
    }

    // Save to database (couple_names stored in the 'planner' column)
    try {
        $stmt = $conn->prepare("INSERT INTO inquiries
            (type, full_name, email, wedding_date, location, hear_about, budget, details, planner)
            VALUES ('planner', ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss",
            $planner_name, $planner_email, $planner_wedding_date,
            $planner_venue, $planner_hear, $planner_budget,
            $planner_details, $couple_names
        );
        $stmt->execute();
        $stmt->close();
    } catch (\Throwable $e) {
        error_log("DB Error (planner): " . $e->getMessage());
        fail_alert("Sorry, we couldn't save your inquiry. Please try again later.");
    }

    // Send email
    $body = "
        <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
            <h2 style='color: #d4af37;'>New Planner Inquiry</h2>
            <hr>
            <p><b>Planner Name:</b> $planner_name</p>
            <p><b>Planner Email:</b> $planner_email</p>
            <p><b>Couple Names:</b> $couple_names</p>
            <p><b>Wedding Date:</b> $planner_wedding_date</p>
            <p><b>Venue &amp; Reception:</b> $planner_venue</p>
            <p><b>Photography Budget (USD):</b> $planner_budget</p>
            <p><b>How they heard about us:</b> $planner_hear</p>
            <p><b>About the Couple:</b><br>" . nl2br($planner_details) . "</p>
            <hr>
            <p style='font-size: 0.8em; color: #777;'>Sent from Veil &amp; Varmala planner form.</p>
        </div>
    ";

    $sent = send_mail($config, $planner_email, $planner_name, "Planner Inquiry: $planner_name | $planner_wedding_date", $body);

    // Prevent reuse of the submitted form token.
    unset($_SESSION['token']);

    if ($sent) {
        success_redirect("Planner Inquiry Sent Successfully!");
    }

    success_redirect("Thank you! Your inquiry was received. We will be in touch soon.");

} else {
    die("Invalid form submission.");
}
