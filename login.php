<?php
// login.php
echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Login Screen</title>
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
        }
        .keypad button {
            width: 80px;
            height: 80px;
            font-size: 24px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background: #f9f9f9;
            cursor: pointer;
            touch-action: manipulation; /* Optimize for touch screens */
        }
        .keypad button:active {
            background: #e0e0e0;
        }
        .bottom-row {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 10px;
        }
        .bottom-row button {
            width: 100px;
            height: 80px;
            font-size: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background: #f9f9f9;
            cursor: pointer;
            touch-action: manipulation;
        }
        #backspace {
            background: #ff6347; /* Red for Borrar */
            color: white;
        }
        #enter {
            background: #32CD32; /* Green for Aceptar */
            color: white;
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
    <div class="login-container">
        <h2>Ingrese Número de Empleado</h2>
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
            <button id="backspace">Borrar</button>
            <button class="digit" data-digit="0">0</button>
            <button id="enter">Aceptar</button>
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
                showMessage("Por favor ingrese 4 dígitos");
            } else if (enteredCode === "1234") {
                showMessage("Acceso concedido");
            } else {
                showMessage("Código incorrecto");
                enteredCode = "";
                updatePinDisplay();
            }
        });
    </script>
</body>
</html>
HTML;
?>