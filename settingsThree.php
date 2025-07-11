<?php
// settings.php
echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Settings Screen</title>
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
        .settings-container {
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
        .setting-item {
            margin: 10px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .vertical-checkboxes .setting-item {
            display: block;
            text-align: left;
            margin-left: 20px;
        }
        .setting-item input[type="text"] {
            width: 150px;
            padding: 5px;
            margin-right: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }
        .setting-item input[type="checkbox"] {
            margin-left: 10px;
            transform: scale(1.5);
        }
        .separator {
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }
        #apply-btn {
            margin-top: 20px;
            width: 100px;
            height: 40px;
            font-size: 18px;
            border: 2px solid #ccc;
            border-radius: 5px;
            background: #32CD32;
            color: white;
            cursor: pointer;
            touch-action: manipulation;
            transition: background 0.1s ease;
        }
        #apply-btn:active {
            background: #28a428;
            transform: scale(0.95);
        }
    </style>
</head>
<body>
    <div class="settings-container">
        <h2>Settings</h2>
        <div class="vertical-checkboxes">
            <div class="setting-item">
                <input type="checkbox" id="require-confirmation"> Require confirmation before sending credits to machine.
            </div>
            <div class="setting-item">
                <input type="checkbox" id="require-manager-password"> To clear the LOG, require Managers password
            </div>
            <div class="setting-item">
                <input type="checkbox" id="employee-log"> Employee can see the LOG table
            </div>
        </div>
        <div class="setting-item">
            <input type="text" id="btn1-text" placeholder="1st button text"> 
            <input type="text" id="btn1-pulses" placeholder="number of pulses"> 
            <input type="checkbox" id="btn1-enable"> Enable
        </div>
        <div class="setting-item">
            <input type="text" id="btn2-text" placeholder="2nd button text"> 
            <input type="text" id="btn2-pulses" placeholder="number of pulses"> 
            <input type="checkbox" id="btn2-enable"> Enable
        </div>
        <div class="setting-item">
            <input type="text" id="btn3-text" placeholder="3rd button text"> 
            <input type="text" id="btn3-pulses" placeholder="number of pulses"> 
            <input type="checkbox" id="btn3-enable"> Enable
        </div>
        <div class="setting-item">
            <input type="text" id="btn4-text" placeholder="4th button text"> 
            <input type="text" id="btn4-pulses" placeholder="number of pulses"> 
            <input type="checkbox" id="btn4-enable"> Enable
        </div>
        <div class="setting-item">
            <input type="text" id="btn5-text" placeholder="5th button text"> 
            <input type="text" id="btn5-pulses" placeholder="number of pulses"> 
            <input type="checkbox" id="btn5-enable"> Enable
        </div>
        <div class="separator"></div>
        <div class="setting-item">
            <input type="text" id="emp1-name" placeholder="1st Employee Name"> 
            <input type="text" id="emp1-passcode" placeholder="passcode is"> 
            <input type="checkbox" id="emp1-enable"> Enable
        </div>
        <div class="setting-item">
            <input type="text" id="emp2-name" placeholder="2nd Employee Name"> 
            <input type="text" id="emp2-passcode" placeholder="passcode is"> 
            <input type="checkbox" id="emp2-enable"> Enable
        </div>
        <div class="setting-item">
            <input type="text" id="emp3-name" placeholder="3rd Employee Name"> 
            <input type="text" id="emp3-passcode" placeholder="passcode is"> 
            <input type="checkbox" id="emp3-enable"> Enable
        </div>
        <div class="setting-item">
            <input type="text" id="emp4-name" placeholder="4th Employee Name"> 
            <input type="text" id="emp4-passcode" placeholder="passcode is"> 
            <input type="checkbox" id="emp4-enable"> Enable
        </div>
        <div class="setting-item">
            <input type="text" id="emp5-name" placeholder="5th Employee Name"> 
            <input type="text" id="emp5-passcode" placeholder="passcode is"> 
            <input type="checkbox" id="emp5-enable"> Enable
        </div>
        <button id="apply-btn">APPLY</button>
    </div>
    <script>
        const applyBtn = document.getElementById('apply-btn');

        applyBtn.addEventListener('click', () => {
            const settings = {
                requireConfirmation: document.getElementById('require-confirmation').checked,
                requireManagerPassword: document.getElementById('require-manager-password').checked,
                employeeLog: document.getElementById('employee-log').checked,
                buttons: [
                    { text: document.getElementById('btn1-text').value, pulses: document.getElementById('btn1-pulses').value, enabled: document.getElementById('btn1-enable').checked },
                    { text: document.getElementById('btn2-text').value, pulses: document.getElementById('btn2-pulses').value, enabled: document.getElementById('btn2-enable').checked },
                    { text: document.getElementById('btn3-text').value, pulses: document.getElementById('btn3-pulses').value, enabled: document.getElementById('btn3-enable').checked },
                    { text: document.getElementById('btn4-text').value, pulses: document.getElementById('btn4-pulses').value, enabled: document.getElementById('btn4-enable').checked },
                    { text: document.getElementById('btn5-text').value, pulses: document.getElementById('btn5-pulses').value, enabled: document.getElementById('btn5-enable').checked }
                ],
                employees: [
                    { name: document.getElementById('emp1-name').value, passcode: document.getElementById('emp1-passcode').value, enabled: document.getElementById('emp1-enable').checked },
                    { name: document.getElementById('emp2-name').value, passcode: document.getElementById('emp2-passcode').value, enabled: document.getElementById('emp2-enable').checked },
                    { name: document.getElementById('emp3-name').value, passcode: document.getElementById('emp3-passcode').value, enabled: document.getElementById('emp3-enable').checked },
                    { name: document.getElementById('emp4-name').value, passcode: document.getElementById('emp4-passcode').value, enabled: document.getElementById('emp4-enable').checked },
                    { name: document.getElementById('emp5-name').value, passcode: document.getElementById('emp5-passcode').value, enabled: document.getElementById('emp5-enable').checked }
                ]
            };

            const jsonSettings = JSON.stringify(settings);

            // Save to SQLite database
            const db = new SQLite3.Database('amusement.db');
            db.run('DELETE FROM settings');
            db.run('INSERT INTO settings (config) VALUES (?)', [jsonSettings], (err) => {
                if (err) {
                    console.error(err.message);
                } else {
                    alert('Settings saved successfully!');
                }
                db.close();
            });
        });
    </script>
</body>
</html>
HTML;
?>