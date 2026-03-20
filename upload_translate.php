<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sourceLang = $_POST['source'];
    $targetLang = $_POST['target'];

    // Handle file upload
    $uploadedFile = $_FILES['media']['tmp_name'];
    $originalName = basename($_FILES['media']['name']);
    $uploadDir = 'uploads/';
    $outputDir = 'outputs/';

    if (!file_exists($uploadDir)) mkdir($uploadDir);
    if (!file_exists($outputDir)) mkdir($outputDir);

    $uploadedPath = $uploadDir . uniqid() . "_" . $originalName;
    move_uploaded_file($uploadedFile, $uploadedPath);

    // 🔁 Python Script Call
$pythonScript = '"C:/Users/Win10/miniconda3/python.exe" process_audio.py';
$command = "$pythonScript " . escapeshellarg($uploadedPath) . " " . escapeshellarg($sourceLang) . " " . escapeshellarg($targetLang);
$output = shell_exec($command . " 2>&1"); // to catch errors too
file_put_contents("debug_log.txt", "Command: $command\nOutput:\n$output\n");



    if ($output) {
    echo "<h2>✅ Translation Complete!</h2>";
    echo "<p><strong>Python Output:</strong><br><pre>$output</pre></p>";

    // 🧠 Get only last line of output
    $lines = explode("\n", trim($output));
    $translatedPath = trim(end($lines));  // ✅ Only the path
    $absolutePath = __DIR__ . '/' . $translatedPath;

    // 🕵️ Check if file actually exists
    if (file_exists($absolutePath)) {
        echo "<a href='$translatedPath' download>🎧 Download Translated Audio/Video</a>";
    } else {
        echo "<p style='color:red;'>⚠️ Could not locate translated file.</p>";
        echo "<p>Expected at: $absolutePath</p>"; // 🔍 For debugging
    }
} else {
    echo "<p style='color:red;'>❌ Python processing failed.</p>";
}

}
?>
