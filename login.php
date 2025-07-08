<?php
// login.php
echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Login Screen</title>
    <style>
        .keypad {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 10px;
        }
        .keypad button {
            padding: 10px;
            font-size: 18px;
        }
        .bottom-row {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .bottom-row button {
            padding: 10px;
            font-size: 18px;
        }
        #pin-display {
            font-size: 24px;
            letter-spacing: 5px;
        }
        #message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Enter PIN</h2>
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
        </div>
        <div class="bottom-row">
            <button id="backspace">Backspace</button>
            <button class="digit" data-digit="0">0</button>
            <button id="enter">Enter</button>
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
                showMessage("Please enter 4 digits");
            } else if (enteredCode === "1234") {
                showMessage("Access granted");
            } else {
                showMessage("Incorrect code");
                enteredCode = "";
                updatePinDisplay();
            }
        });
    </script>
</body>
</html>
HTML;
?>