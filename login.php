<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php', true, 303);
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_connect.php';

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare('SELECT id, password FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashedPassword);

    if ($stmt->num_rows === 1) {
        $stmt->fetch();
        if (password_verify($password, $hashedPassword)) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['login_time'] = time();
            $stmt->close();
            $conn->close();
            header('Location: dashboard.php', true, 303);
            exit();
        }
        $error = 'Invalid password. Please try again.';
    } else {
        $error = 'No account found with this email.';
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Veil &amp; Varmala</title>
  <style>
    body { font-family: 'Montserrat', sans-serif; background: #f9f9f9; }
    .main-content { max-width: 500px; margin: 200px auto 50px; background: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,.1); }
    h2 { text-align: center; margin-bottom: 1.5rem; }
    .form-group { margin-bottom: 1.2rem; }
    label { display: block; margin-bottom: .4rem; font-weight: 500; }
    .form-control { width: 100%; padding: .9rem; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
    .btn-submit { width: 100%; padding: 1rem; background: #323538; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
    .error { color: #721c24; background: #f8d7da; border: 1px solid #f5c6cb; padding: .75rem; border-radius: 6px; text-align: center; }
  </style>
</head>
<body>
<div class="main-content">
  <h2>Login</h2>
  <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
  <form method="POST" action="login.php">
    <div class="form-group">
      <label>Email Address</label>
      <input type="email" name="email" class="form-control" required autocomplete="username">
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required autocomplete="current-password">
    </div>
    <button type="submit" class="btn-submit">Login</button>
  </form>
</div>
</body>
</html>
