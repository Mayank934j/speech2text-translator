<?PHP if(session_id()==''){session_start();}
//$basefolder ="../";
include("../globals_var.php"); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../app/css/CIL_boot.min.css">

        <title>Mine Vehicl Information Portal</title>

 <script src="http://code.jquery.com/jquery.min.js"></script>

 <link rel="stylesheet" href="../slideshow/vegas.min.css">
 <script src="../slideshow/vegas.min.js"></script>
<style>
.col-smm-12{position:relative; min-height:1px;padding-right:15px;padding-left:15px; text-align:inherit; }
@media screen and (max-width:380px){
	.col-smm-12{width:100%; }
}
</style>
<?PHP
 include("../app/xmlhttpreq.php");?>
<link rel="shortcut icon" href="logo.ico" type="image/ico" />


<style>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

     * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: 'Segoe UI', sans-serif;
    }

    body {

            background: linear-gradient(135deg, #1c1c1c, #42275a, #734b6d);
            color: white;
            padding: 40px 20px;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
    }

    .translator-container {
        max-width: 800px;
        margin: auto;
        background-color: #303134;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #8ab4f8;
        font-size: 28px;
    }

    .language-select {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        align-items: center;
    }

    .language-select select {
        background-color: #3c4043;
        color: #e8eaed;
        border: none;
        padding: 12px 15px;
        border-radius: 8px;
        font-size: 16px;
        width: 45%;
        cursor: pointer;
        transition: all 0.3s;
    }

    .language-select select:hover {
        background-color: #424548;
    }

    .switch-btn {
        text-align: center;
        font-size: 24px;
        color: #8ab4f8;
        cursor: pointer;
        margin: 10px 0;
        transition: transform 0.3s;
    }

    .switch-btn:hover {
        transform: rotate(180deg);
    }

    textarea {
        width: 100%;
        background-color: #202124;
        color: #e8eaed;
        border: none;
        font-size: 18px;
        padding: 15px;
        border-radius: 8px;
        resize: none;
        height: 120px;
        margin-top: 10px;
        transition: box-shadow 0.3s;
        box-shadow: 0 0 0 2px #8ab4f8;
    }

    textarea:focus {
        outline: none;
        box-shadow: 0 0 0 2px #8ab4f8;
    }

    .output-box {
        margin-top: 20px;
        padding: 15px;
        background-color: #202124;
        border: 1px solid #5f6368;
        border-radius: 8px;
        min-height: 120px;
        font-size: 18px;
        box-shadow: 0 0 0 2px #8ab4f8;
    }

    .output-box:empty::before {
          content: attr(data-placeholder);
          color: #888;
          pointer-events: none;
    }

    .mic-section {
        width: 6px;
        height: 6px;
        margin-left:680px;
        margin-top: -55px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #3c4043;
        padding:30px;
        border-radius: 10px;
        cursor: pointer;
    }

    .mic-section span {
        font-size: 30px;
        color: #e8eaed;
    }

    .mic-button {
        background-color: #8ab4f8;
        border: none;
        padding: 12px 25px;
        border-radius: 50px;
        color: #202124;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.3s;
    }

    .mic-button:hover {
        background-color: #a8c7fa;
        transform: scale(1.05);
    }

    .speak-icon {
        width: 6px;
        height: 6px;
        font-size:30px;
        margin-left:640px;
        margin-top: -60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #3c4043;
        padding:30px;
        border-radius: 10px;
        cursor: pointer;
    }

    .speak-icon2 {
        width: 6px;
        height: 6px;
        font-size:30px;
        margin-left:640px;
        margin-top: -56px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding:30px;
        border-radius: 10px;
        cursor: pointer;
    }

    footer {
        background-color: #202124;
        color: white;
        text-align: center;
        padding: 15px;
        font-size: 14px;
        border-top: 1px solid #444;
        margin-top: 40px;
        border-radius: 0 0 8px 8px;
    }

    .footer-links {
        margin-top: 10px;
    }

    .footer-links a {
        color: #8ab4f8;
        text-decoration: none;
        margin: 0 10px;
        transition: color 0.3s;
    }

    .footer-links a:hover {
        text-decoration: underline;
    }

    </style>

</head>

<body id="bodypg" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif; ">
        <?PHP  $basefolder=$BaseUrl="../app/";
	          include_once("header_logo.php");
		?>
              <div class="translator-container">
                <div class="language-select">
                  <select id="from-lang">

                    <option value="hi">Hindi</option>
                    <option value="en">English</option>
                    <option value="es">Spanish</option>
                    <option value="fr">French</option>
                    <option value="de">German</option>
                  </select>

                  <select id="to-lang">
                    <option value="en">English</option>
                    <option value="hi">Hindi</option>
                    <option value="es">Spanish</option>
                    <option value="fr">French</option>
                    <option value="de">German</option>
                  </select>
                </div>

                <div class="switch-btn" onclick="swapLanguages()">⇄</div>

                <textarea id="inputText" placeholder="Enter text" ></textarea>
               <div class="mic-section">
                  <span id="mic-button">🎙️</span>
               </div>
               <div class="speak-icon">
                  <span id="speakBtn">🔊</span>
               </div>



<!-- 📎 Upload Audio/Video Icon (NO default file input shown) -->
<form id="uploadForm" action="upload_translate.php" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
  <!-- Hidden file input triggered by image click -->
  <img src="fupload.jpg"
       id="uploadfiles_icon"
       onclick="document.getElementById('xfiles').click();"
       title="Upload Audio/Video"
       style="position: absolute; top:380px; right: 750px; width: 22px; cursor: pointer;">

  <input type="file"
         id="xfiles"
         name="media"
         accept="audio/*,video/*"
         style="display: none;"
         onchange="handleAudioVideoUpload(this)" />

  <!-- 👇 Optional preview after file selected -->
  <div id="preview" style="color: #ccc; font-size: 12px; margin-top: 5px;"></div>

  <!-- Use existing language selectors -->
  <input type="hidden" id="sourceLangHidden" name="source">
  <input type="hidden" id="targetLangHidden" name="target">

  <!-- Submit button -->
  <input type="submit" value="📤 Upload & Translate" class="mic-button" style="margin-top:10px;">
</form>




                <div class="output-box" id="translatedText" contenteditable="false" data-placeholder="Translation"></div>
                 <div class="speak-icon2">
                  <span id="speakOutputBtn">🔊</span>
                 </div>


<script>
function handleAudioVideoUpload(input) {
  const previewDiv = document.getElementById('preview');
  if (!previewDiv) return;

  const files = input.files;
  if (!files || !files.length) return;

  const file = files[0];
  const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
  previewDiv.style.display = 'block';
  previewDiv.innerText = `Selected: ${file.name} (${sizeMB} MB)`;

  // ✅ Create form data and send to server
  const formData = new FormData();
  formData.append('media', file);

  fetch('upload_file.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    console.log("✅ Upload Response:", data);
    previewDiv.innerHTML += `<br><span style="color:lightgreen;">✅ Uploaded successfully!</span>`;
  })
  .catch(err => {
    console.error("❌ Upload failed:", err);
    previewDiv.innerHTML += `<br><span style="color:red;">❌ Upload failed.</span>`;
  });
}

// Hidden lang values set karne wala code
  document.getElementById('uploadForm').addEventListener('submit', function (e) {
    const fromLang = document.getElementById('from-lang').value;
    const toLang = document.getElementById('to-lang').value;

    document.getElementById('sourceLangHidden').value = fromLang;
    document.getElementById('targetLangHidden').value = toLang;
  });
</script>




<script>
        function swapLanguages() {
                const fromLang = document.getElementById("from-lang");
                const toLang = document.getElementById("to-lang");

                // Swap the selected values
                const temp = fromLang.value;
                fromLang.value = toLang.value;
                toLang.value = temp;

                  // 2. Move translated output into input box
                inputText.value = translatedText.innerText;

                // Call translation again after swapping
                translateText();
        }
 </script>

 <script>
// Translation
// Variables for debouncing
        let debounceTimer;
        const DEBOUNCE_DELAY = 400; // milliseconds

        async function translateText() {
          const rawInput = document.getElementById("inputText").value;
          const inputText = rawInput.trim();
          const fromLang = document.getElementById("from-lang").value;
          const toLang = document.getElementById("to-lang").value;
          const outputBox = document.getElementById("translatedText");


          // Immediate clear if input is empty (handles all deletion cases)
          if (inputText.length === 0) {
            outputBox.innerText = "Translating...";
            return;
          }

          // If same language, just copy text
          if (fromLang === toLang) {
            outputBox.innerText = inputText;
            outputBox.innerText = "Translating..."
            return;
          }

          outputBox.innerText = "Translating...";

          try {
            const formData = new FormData();
            formData.append("text", inputText);
            formData.append("from", fromLang);
            formData.append("to", toLang);

            const res = await fetch("translate_backend.php", {
              method: "POST",
              body: formData
            });

            const result = await res.text();

            // Only update if input hasn't changed during the request
            if (inputText === document.getElementById("inputText").value.trim()) {
              outputBox.innerText = result;
            }
          } catch (error) {
            console.error(error);
            outputBox.innerText = "❌ Translation failed";
          }
        }

        // Debounced translation function
        function debouncedTranslate() {
          clearTimeout(debounceTimer);
          debounceTimer = setTimeout(translateText, DEBOUNCE_DELAY);
        }

        // Event listeners
        document.getElementById("inputText").addEventListener("input", function(e) {
          // Immediate clear if input is empty (for better responsiveness)
          if (e.target.value.trim().length === 0) {
            document.getElementById("translatedText").innerText = "";
            return;
          }
          debouncedTranslate();
        });

        // Language change handlers (no debounce needed)
        document.getElementById("from-lang").addEventListener("change", translateText);
        document.getElementById("to-lang").addEventListener("change", translateText);
</script>


<script>

// Speaker
         document.addEventListener("DOMContentLoaded", function () {
            let voices = [];

            function loadVoices() {
              voices = speechSynthesis.getVoices();
              if (!voices.length) {
                setTimeout(() => {
                  voices = speechSynthesis.getVoices();
                }, 100);
              }
            }

            loadVoices();
            speechSynthesis.onvoiceschanged = loadVoices;

            function speakText(text, lang = 'en-US') {
              if (text.trim() !== "") {
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = lang;

                const selectedVoice = voices.find(v => v.lang === lang);
                if (selectedVoice) {
                  utterance.voice = selectedVoice;
                }

                speechSynthesis.speak(utterance);
              }
            }

            // ✅ Input text speaker
            document.getElementById('speakBtn').addEventListener('click', () => {
              const text = document.getElementById('inputText').value;
              const lang = document.getElementById('from-lang').value;

              const langMap = {
                'hi': 'hi-IN',
                'en': 'en-US'
              };

              speakText(text, langMap[lang] || 'en-US');
            });

            // ✅ Output/Translated text speaker
            document.getElementById('speakOutputBtn').addEventListener('click', () => {
              const text = document.getElementById('translatedText').textContent;
              const lang = document.getElementById('to-lang').value;

              const langMap = {
                'hi': 'hi-IN',
                'en': 'en-US'
              };

              speakText(text, langMap[lang] || 'en-US');
            });

            // 🔄 other functions: translateText, swapLanguages, etc.
         });
</script>


<script>
// SpeechRecognition
          // ✅ Declare this at the top
          const languageLocales = {
            en: 'en-US',
            hi: 'hi-IN',
            fr: 'fr-FR',
            es: 'es-ES',
            de: 'de-DE',
            ru: 'ru-RU',
            zh: 'zh-CN',
            ja: 'ja-JP',
            ar: 'ar-SA'
          };

          const fromLang = document.getElementById('from-lang');
          const inputText = document.getElementById('inputText');
          const micBtn = document.getElementById('mic-button');

          const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

          if (SpeechRecognition) {
            const recognition = new SpeechRecognition();
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;

            micBtn.addEventListener('click', () => {
              const langCode = fromLang.value;
              const recognitionLang = languageLocales[langCode] || 'en-US';
              recognition.lang = recognitionLang;

              recognition.start();
              micBtn.innerText = '🎙️ Listening...';
            });

            recognition.onresult = (event) => {
              const transcript = event.results[0][0].transcript;

              // 📝 Set input field from voice
              inputText.value = transcript;

              // 🔁 Auto-translate after speaking
              translateText();
            };

            recognition.onend = () => {
              micBtn.innerText = '🎙️';
            };

            recognition.onerror = (event) => {
              alert('Speech recognition error: ' + event.error);
              micBtn.innerText = '🎙️';
            };
          } else {
            alert("Speech recognition is not supported in this browser.");
          }

</script>


<footer>
    © Developed by Mayank Barnwal | 2025 Hindi-English Learner | About | Contact | Privacy
</footer>

</body>
</html>