<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Veil & Varmala</title>
  <style>
      body { font-family: 'Montserrat', sans-serif; background: #f9f9f9; }
      .main-content {  transform: translate(0px, 200px);max-width: 500px; margin: 50px auto; background: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
      h2 { text-align: center; margin-bottom: 1.5rem; }
      .form-group { margin-bottom: 1.2rem; width: 97%; margin-left: -10px; }
      .form-group label { display: block; margin-bottom: 0.4rem; font-weight: 500; }
      .form-control { width: 100%; padding: 0.9rem; border: 1px solid #ccc; border-radius: 5px; }
      .btn-submit { width: 100%; padding: 1rem; background: #323538; color: #fff; border: none; border-radius: 5px; cursor: pointer; text-transform: uppercase; }
      .btn-submit:hover { background: #C3B8AC; }
      p { text-align: center; }
  </style>
</head>
<body>
<div class="main-content">
    <h2>Login</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include 'db_connect.php';

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $hashed_password);

    if ($stmt->num_rows > 0) {
    $stmt->fetch();
    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['email'] = $email;

        echo "
        <div style='
            padding: 12px 20px; 
            margin: 10px 0; 
            border: 1px solid #d4edda; 
            border-radius: 6px; 
            background-color: #d4edda; 
            color: #155724; 
            font-family: Arial, sans-serif;
        '>
            <strong>Login Successful</strong> – Redirecting to your dashboard...
        </div>";

        header("refresh:2; url=dashboard.php"); // redirect after 2 sec
        exit();
    } else {
        echo "
        <div style='
            padding: 12px 20px; 
            margin: 10px 0; 
            border: 1px solid #f8d7da; 
            border-radius: 6px; 
            background-color: #f8d7da; 
            color: #721c24; 
            font-family: Arial, sans-serif;
        '>
            Invalid password. Please try again.
        </div>";
    }
} else {
    echo "
    <div style='
        padding: 12px 20px; 
        margin: 10px 0; 
        border: 1px solid #f8d7da; 
        border-radius: 6px; 
        background-color: #f8d7da; 
        color: #721c24; 
        font-family: Arial, sans-serif;
    '>
        No account found with this email.
    </div>";
}

        $stmt->close();
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

        <button type="submit" class="btn-submit">Login</button>
    </form>
   
</div>
</body>
</html>
