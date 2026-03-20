<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// ✅ Step 1: DB Connection
$conn = new mysqli("localhost", "root", "", "chat"); // <- Change "chat" if your DB name is different

// ✅ Check if DB connected properly
if ($conn->connect_error) {
    die("❌ DB Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Connected to DB successfully<br>";
}

// ✅ Handle File Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media'])) {
    if ($_FILES['media']['error'] === 0) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = basename($_FILES["media"]["name"]);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["media"]["tmp_name"], $targetFile)) {
            echo "✅ File uploaded successfully: <strong>$fileName</strong><br>";
            echo "📁 Saved to: <code>$targetFile</code><br>";

            // ✅ Now insert into MySQL
            $stmt = $conn->prepare("INSERT INTO uploaded_files (filename, filepath, uploaded_at) VALUES (?, ?, NOW())");
            $stmt->bind_param("ss", $fileName, $targetFile);

            if ($stmt->execute()) {
                echo "✅ DB Saved Successfully.";
            } else {
                echo "❌ DB Insert Failed: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "❌ move_uploaded_file() failed.";
        }
    } else {
        echo "❌ File error code: " . $_FILES['media']['error'];
    }
} else {
    echo "⚠️ Please upload via POST method.";
}
?>
