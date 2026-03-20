<!DOCTYPE html>
<html>
<head>
  <title>Upload Audio/Video File</title>
</head>
<body>
  <h2>🎧 Upload Audio/Video File</h2>

  <form action="upload_file.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="media" accept="audio/*,video/*" required>
    <br><br>
    <input type="submit" value="Upload Now">
  </form>
</body>
</html>
