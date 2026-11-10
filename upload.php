<?php
// Handle multiple file uploads
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['images'])) {
    $targetDir = "assets/image/";

    // Ensure directory exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $messages = [];

    foreach ($_FILES['images']['name'] as $key => $fileName) {
        $fileTmp  = $_FILES['images']['tmp_name'][$key];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileType, $allowedTypes)) {
            // Unique filename
            $newFileName = uniqid("img_", true) . "." . $fileType;
            $targetFile = $targetDir . $newFileName;

            if (move_uploaded_file($fileTmp, $targetFile)) {
                $messages[] = "✅ Uploaded: <img src='$targetFile' width='150' style='margin:5px;'>";
            } else {
                $messages[] = "❌ Failed to upload $fileName";
            }
        } else {
            $messages[] = "⚠️ Invalid file type for $fileName";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Multiple Image Upload</title>
</head>
<body>
  <h2>Upload Multiple Images</h2>

  <?php 
  if (!empty($messages)) {
      echo "<div>" . implode("<br>", $messages) . "</div>";
  }
  ?>

  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="images[]" multiple required>
    <button type="submit">Upload</button>
  </form>
</body>
</html>
