<?php
// login.php
session_start();

// Default language
$default_lang = 'es';
$lang = isset($_GET['lang']) ? $_GET['lang'] : (isset($_SESSION['lang']) ? $_SESSION['lang'] : $default_lang);

// Validate language
if (!in_array($lang, ['en', 'es'])) {
    $lang = $default_lang;
}
$_SESSION['lang'] = $lang;

// Load translations
$translations = include "$lang.php";

echo <<<HTML
<!DOCTYPE html>
<html lang="$lang">
<head>
    <title>{$translations['title']}</title>
    <style>
        body {
            background: linear-gradient(to bottom, #87CEEB, #ADD8E6);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .login-container {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .keypad {
            display: grid;
            grid-template-columns: repeat(3, 80px);
            gap: 10px;
            margin-top: 20px;
            justify-content: center;
        }
        .keypad button {
            width: 80px;
            height: 80px;
            font-size: 24px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background: #f9f9f9;
            cursor: pointer;
            touch-action: manipulation;
            transition: background 0.1s ease;
        }
        .keypad button:active {
            background: #e0e0e0;
            transform: scale(0.95);
        }
        #backspace {
            background: #ff6347;
            color: white;
        }
        #backspace:active {
            background: #cc4f39;
            transform: scale(0.95);
        }
        #enter {
            background: #32CD32;
            color: white;
        }
        #enter:active {
            background: #28a428;
            transform: scale(0.95);
        }
        #pin-display {
            font-size: 28px;
            letter-spacing: 10px;
            margin-bottom: 20px;
        }
        #message {
            color: red;
            margin-top: 10px;
            font-size: 18px;
        }
        .language-select {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <select class="language-select" onchange="location = this.value;">
            <option value="?lang=es" {$lang == 'es' ? 'selected' : ''}>Español</option>
            <option value="?lang=en" {$lang == 'en' ? 'selected' : ''}>English</option>
        </select>
        <h2>{$translations['employee_number']}</h2>
        <span id="pin-display"></span>
        <div id="message"></div>
        <div class="keypad">
            <button class="digit" data-digit="1">1</button>
            <button class="digit" data-digit="2">2</button>
            <button class="digit" data-digit="3">3</button>
            <button class="digit" data-digit="4">4</button>
            <button class="digit" data-digit="5">5</button>
            <button class="digit" data-digit="6">6</button>
            <button class="digit" data-digit="7">7</button>
            <button class="digit" data-digit="8">8</button>
            <button class="digit" data-digit="9">9</button>
            <button id="backspace">{$translations['clear']}</button>
            <button class="digit" data-digit="0">0</button>
            <button id="enter">{$translations['accept']}</button>
        </div>
    </div>
    <script>
        const pinDisplay = document.getElementById('pin-display');
        const messageDiv = document.getElementById('message');
        const digitButtons = document.querySelectorAll('.digit');
        const backspaceButton = document.getElementById('backspace');
        const enterButton = document.getElementById('enter');
        
        let enteredCode = "";
        
        function updatePinDisplay() {
            pinDisplay.textContent = "*".repeat(enteredCode.length);
        }
        
        function showMessage(message) {
            messageDiv.textContent = message;
        }
        
        function clearMessage() {
            messageDiv.textContent = "";
        }
        
        digitButtons.forEach(button => {
            button.addEventListener('click', () => {
                if (enteredCode.length < 4) {
                    enteredCode += button.dataset.digit;
                    updatePinDisplay();
                    clearMessage();
                }
            });
        });
        
        backspaceButton.addEventListener('click', () => {
            enteredCode = enteredCode.slice(0, -1);
            updatePinDisplay();
            clearMessage();
        });
        
        enterButton.addEventListener('click', () => {
            if (enteredCode.length !== 4) {
                showMessage("{$translations['enter_4_digits']}");
            } else if (enteredCode === "1234") {
                showMessage("{$translations['access_granted']}");
            } else {
                showMessage("{$translations['incorrect_code']}");
                enteredCode = "";
                updatePinDisplay();
            }
        });
    </script>
</body>
</html>
HTML;
?>