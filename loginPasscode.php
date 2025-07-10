<?php
// loginPasscode.php
// Enable error logging for debugging
ini_set('display_errors', 1); // Show errors to the users
ini_set('log_errors', 1);
ini_set('error_log', '/var/www/html/php_errors.log');

// Handle POST request for validation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['passcode'])) {
    $passcode = filter_input(INPUT_POST, 'passcode', FILTER_VALIDATE_INT);
    
    if ($passcode === false || $passcode < 0) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Código inválido'
        ]);
        exit;
    }
    
    try {
        // Connect to SQLite database
        $db = new SQLite3(__DIR__ . '/amusement.db');
        
        // Prepare and execute query (assuming column is 'name')
        $stmt = $db->prepare('SELECT name FROM users WHERE passcode = :passcode');
        $stmt->bindValue(':passcode', $passcode, SQLITE3_INTEGER);
        $result = $stmt->execute();
        
        // Check if user exists
        if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'name' => $row['name']
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Código incorrecto'
            ]);
        }
        
        $result->finalize();
        $db->close();
    } catch (Exception $e) {
        error_log('SQLite Error: ' . $e->getMessage());
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Error en la base de datos'
        ]);
    }
    exit;
}

// Output HTML and JavaScript
header('Content-Type: text/html; charset=UTF-8');
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
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Número de Empleado</h2>
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
        
        let enteredCode = '';
        
        function updatePinDisplay() {
            pinDisplay.textContent = '*'.repeat(enteredCode.length);
        }
        
        function showMessage(message) {
            messageDiv.textContent = message;
        }
        
        function clearMessage() {
            messageDiv.textContent = '';
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
        
        enterButton.addEventListener('click', async () => {
            if (enteredCode.length !== 4) {
                showMessage('Por favor ingrese 4 dígitos');
                return;
            }
            
            if (!/^\d{4}$/.test(enteredCode)) {
                showMessage('Código debe ser numérico');
                enteredCode = '';
                updatePinDisplay();
                return;
            }
            
            try {
                const response = await fetch('/loginPasscode.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'passcode=' + encodeURIComponent(enteredCode)
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const result = await response.json();
                
                if (result.success) {
                    showMessage(`Bienvenido, ${result.name}!`);
                    setTimeout(() => {
                        enteredCode = '';
                        updatePinDisplay();
                        clearMessage();
                    }, 2000);
                } else {
                    showMessage(result.message);
                    enteredCode = '';
                    updatePinDisplay();
                }
            } catch (error) {
                console.error('Fetch error:', error);
                showMessage('Error de conexión: ' + error.message);
                enteredCode = '';
                updatePinDisplay();
            }
        });
    </script>
</body>
</html>
HTML;
?>