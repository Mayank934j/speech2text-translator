<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['text'] ?? '';
    $from = $_POST['from'] ?? 'en';
    $to = $_POST['to'] ?? 'hi';

    if (!$text) {
        echo "No text provided";
        exit;
    }

    $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=$from&tl=$to&dt=t&q=" . urlencode($text);

    $response = file_get_contents($url);

    if ($response !== false) {
        $data = json_decode($response, true);
        echo $data[0][0][0]; // ✅ Translated text
    } else {
        echo "❌ Translation failed";
    }
} else {
    echo "Invalid request";
}
?>
