<?php
// login.php

// Initialize language (default to Spanish)
$language = isset($_GET['lang']) && in_array($_GET['lang'], ['en_US', 'es_ES']) ? $_GET['lang'] : 'es_ES';

// Set locale and gettext configuration
putenv("LC_ALL=$language.UTF-8");
setlocale(LC_ALL, "$language.UTF-8");
bindtextdomain('messages', './locale');
bind_textdomain_codeset('messages', 'UTF-8');
textdomain('messages');

// Define _() for convenience if not already defined
if (!function_exists('_')) {
    function _($string) {
        return gettext($string);
    }
}

echo <<<HTML
<!DOCTYPE html>
<html lang="{$language}">
<head>
    <title>" . _("Employee Number") . "</title>
    <style>
        body {
            background: linear-gradient(to bottom, #87CEEB, #ADD8E6);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            position: relative;
        }
        .language-selector {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .language-selector select {
            padding: 5px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
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
            background: #ff6347; /* Red for Clear */
            color: white;
        }
        #backspace:active {
            background: #cc4f39;
            transform: scale(0.95);
        }
        #enter {
            background: #32CD32; /* Green for Accept */
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
    </style>
</head>
<body>
    <div class="language-selector">
        <select id="language" onchange="changeLanguage()">
            <option value="es_ES" " . ($language === 'es_ES' ? 'selected' : '') . ">" . _("Spanish") . "</option>
            <option value="en_US" " . ($language === 'en_US' ? 'selected' : '') . ">" . _("English") . "</option>
        </select>
    </div>
    <div class="login-container">
        <h2>" . _("Employee Number") . "</h2>
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
            <button id="backspace">" . _("Clear") . "</button>
            <button class="digit" data-digit="0">0</button>
            <button id="enter">" . _("Accept") . "</button>
        </div>
    </div>
    <script>
        // JavaScript translations for dynamic messages
        const translations = {
            'es_ES': {
                'please_enter_4_digits': '" . _("Please enter 4 digits") . "',
                'access_granted': '" . _("Access granted") . "',
                'incorrect_code': '" . _("Incorrect code") . "'
            },
            'en_US': {
                'please_enter_4_digits': '" . _("Please enter 4 digits") . "',
                'access_granted': '" . _("Access granted") . "',
                'incorrect_code': '" . _("Incorrect code") . "'
            }
        };
        const currentLang = '$language';

        function changeLanguage() {
            const lang = document.getElementById('language').value;
            window.location.href = '?lang=' + lang;
        }

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
            messageDiv.textContent = translations[currentLang][message];
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
                showMessage('please_enter_4_digits');
            } else if (enteredCode === "1234") {
                showMessage('access_granted');
            } else {
                showMessage('incorrect_code');
                enteredCode = "";
                updatePinDisplay();
            }
        });
    </script>
</body>
</html>
HTML;
?>