<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Veil & Varmala</title>
  <style>
      body { font-family: 'Montserrat', sans-serif; background: #f9f9f9; }
      .main-content { max-width: 500px; margin: 60px auto; background: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
      h2 { text-align: center; margin-bottom: 1.5rem; }
      .form-group { margin-bottom: 1.2rem; }
      .form-group label { display: block; margin-bottom: 0.4rem; font-weight: 500; }
      .form-control { width: 100%; padding: 0.9rem; border: 1px solid #ccc; border-radius: 5px; }
      .btn-submit { width: 100%; padding: 1rem; background: #323538; color: #fff; border: none; border-radius: 5px; cursor: pointer; text-transform: uppercase; }
      .btn-submit:hover { background: #C3B8AC; }
      p { text-align: center; }
  </style>
</head>
<body>
<div class="main-content">
    <h2>Create an Account</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include 'db_connect.php';

        $email = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "<p style='color:red;'>Email already registered.</p>";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $password);

            if ($stmt->execute()) {
                echo "<p style='color:green;'>Registration successful 🎉 <a href='login.php'>Login here</a></p>";
            } else {
                echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }
        $check->close();
        $conn->close();
    }
    ?>

    <form method="POST">
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" required placeholder="Enter your email">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required placeholder="Enter your password">
        </div>

        <button type="submit" class="btn-submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
