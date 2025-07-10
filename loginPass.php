<?php
// login.php

// Check if the form is submitted with a passcode
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['passcode'])) {
    $passcode = trim($_POST['passcode']);
    
    // Validate passcode is a 4-digit number
    if (!preg_match('/^\d{4}$/', $passcode)) {
        $message = "Por favor ingrese un código de 4 dígitos";
    } else {
        // Execute the Python script with the passcode
        $python_script = escapeshellcmd('python3 validate_user.py');
        $passcode_arg = escapeshellarg($passcode);
        $command = "$python_script $passcode_arg";
        $output = shell_exec($command);
        $output = trim($output);

        // Check the Python script's output
        if (strpos($output, 'Error:') === 0) {
            $message = str_replace('Error: ', '', $output); // Extract error message
        } else {
            $message = "Acceso concedido: Bienvenido, $output";
        }
    }
} else {
    $message = '';
}

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
            background: #ff6347; /* Red for Borrar */
            color: white;
        }
        #backspace:active {
            background: #cc4f39;
            transform: scale(0.95);
        }
        #enter {
            background: #32CD32; /* Green for Aceptar */
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
    <div class="login-container">
        <h2>Número de Empleado</h2>
        <span id="pin-display"></span>
        <div id="message">$message</div>
        <form id="passcode-form" method="POST" action="">
            <input type="hidden" name="passcode" id="passcode-input">
            <div class="keypad">
                <button type="button" class="digit" data-digit="1">1</button>
                <button type="button" class="digit" data-digit="2">2</button>
                <button type="button" class="digit" data-digit="3">3</button>
                <button type="button" class="digit" data-digit="4">4</button>
                <button type="button" class="digit" data-digit="5">5</button>
                <button type="button" class="digit" data-digit="6">6</button>
                <button type="button" class="digit" data-digit="7">7</button>
                <button type="button" class="digit" data-digit="8">8</button>
                <button type="button" class="digit" data-digit="9">9</button>
                <button type="button" id="backspace">Borrar</button>
                <button type="button" class="digit" data-digit="0">0</button>
                <button type="submit" id="enter">Aceptar</button>
            </div>
        </form>
    </div>
    <script>
        const pinDisplay = document.getElementById('pin-display');
        const messageDiv = document.getElementById('message');
        const digitButtons = document.querySelectorAll('.digit');
        const backspaceButton = document.getElementById('backspace');
        const enterButton = document.getElementById('enter');
        const passcodeInput = document.getElementById('passcode-input');
        const form = document.getElementById('passcode-form');
        
        let enteredCode = "";
        
        function updatePinDisplay() {
            pinDisplay.textContent = "*".repeat(enteredCode.length);
            passcodeInput.value = enteredCode;
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
            } else {
                form.submit();
            }
        });
    </script>
</body>
</html>
HTML;
?>