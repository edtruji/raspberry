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
            width: 600px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .setting-item {
            margin: 10px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }
        .vertical-checkboxes .setting-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-align: left;
            padding: 0 20px;
        }
        .setting-item input[type="text"],
        .setting-item input[type="password"] {
            width: 150px;
            padding: 5px;
            margin-right: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }
        .input-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            margin-left: 10px;
        }
        .toggle-switch input[type="checkbox"] {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ff4d4d;
            transition: 0.4s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #32CD32;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
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
        /* Tab Styles */
        .tab-nav {
            display: flex;
            border-bottom: 2px solid #ccc;
            margin-bottom: 20px;
        }
        .tab-link {
            flex: 1;
            padding: 10px;
            text-align: center;
            background: #f0f0f0;
            cursor: pointer;
            border-radius: 5px 5px 0 0;
            transition: background 0.3s;
        }
        .tab-link.active {
            background: #32CD32;
            color: white;
        }
        .tab-link:hover {
            background: #e0e0e0;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="settings-container">
        <h2>Settings</h2>
        <div class="tab-nav">
            <div class="tab-link active" data-tab="general">General Settings</div>
            <div class="tab-link" data-tab="other">Other Settings</div>
        </div>
        <div id="general" class="tab-content active">
            <div class="vertical-checkboxes">
                <div class="setting-item">
                    <label>Require confirmation before sending credits to machine.</label>
                    <label class="toggle-switch">
                        <input type="checkbox" id="require-confirmation">
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="setting-item">
                    <label>To clear the LOG, require Administrator's password</label>
                    <label class="toggle-switch">
                        <input type="checkbox" id="require-admin-password">
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="setting-item">
                    <label>Employee can see the LOG table</label>
                    <label class="toggle-switch">
                        <input type="checkbox" id="employee-log">
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="setting-item">
                    <label>Employee can see TOTAL IN</label>
                    <label class="toggle-switch">
                        <input type="checkbox" id="employee-total-in">
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="setting-item">
                    <label>Employee can see TOTAL OUT</label>
                    <label class="toggle-switch">
                        <input type="checkbox" id="employee-total-out">
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="setting-item">
                    <label>Employee can see TOTAL INCOME</label>
                    <label class="toggle-switch">
                        <input type="checkbox" id="employee-total-income">
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="setting-item">
                    <label>Employee have the reboot button available</label>
                    <label class="toggle-switch">
                        <input type="checkbox" id="employee-reboot">
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="setting-item">
                    <label>Require passcode for every action on the control panel</label>
                    <label class="toggle-switch">
                        <input type="checkbox" id="require-passcode">
                        <span class="slider"></span>
                    </label>
                </div>
                <div class="setting-item">
                    <label>Change Administrator password</label>
                    <div class="input-group">
                        <input type="password" id="admin-passcode" placeholder="New passcode" pattern="[0-9]*" inputmode="numeric" maxlength="10"> 
                        <input type="password" id="admin-confirm-passcode" placeholder="Confirm passcode" pattern="[0-9]*" inputmode="numeric" maxlength="10"> 
                    </div>
                </div>
            </div>
        </div>
        <div id="other" class="tab-content">
            <div class="separator"></div>
            <div class="setting-item">
                <div class="input-group">
                    <input type="text" id="btn1-text" placeholder="1st button text" maxlength="20"> 
                    <input type="text" id="btn1-pulses" placeholder="number of pulses" pattern="[0-9]*" inputmode="numeric" maxlength="10"> 
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="btn1-enable">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="setting-item">
                <div class="input-group">
                    <input type="text" id="btn2-text" placeholder="2nd button text" maxlength="20"> 
                    <input type="text" id="btn2-pulses" placeholder="number of pulses" pattern="[0-9]*" inputmode="numeric" maxlength="10"> 
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="btn2-enable">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="setting-item">
                <div class="input-group">
                    <input type="text" id="btn3-text" placeholder="3rd button text" maxlength="20"> 
                    <input type="text" id="btn3-pulses" placeholder="number of pulses" pattern="[0-9]*" inputmode="numeric" maxlength="10"> 
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="btn3-enable">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="setting-item">
                <div class="input-group">
                    <input type="text" id="btn4-text" placeholder="4th button text" maxlength="20"> 
                    <input type="text" id="btn4-pulses" placeholder="number of pulses" pattern="[0-9]*" inputmode="numeric" maxlength="10"> 
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="btn4-enable">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="setting-item">
                <div class="input-group">
                    <input type="text" id="btn5-text" placeholder="5th button text" maxlength="20"> 
                    <input type="text" id="btn5-pulses" placeholder="number of pulses" pattern="[0-9]*" inputmode="numeric" maxlength="10"> 
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="btn5-enable">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="separator"></div>
            <div class="setting-item">
                <div class="input-group">
                    <input type="text" id="emp1-name" placeholder="1st Employee Name" maxlength="20"> 
                    <input type="text" id="emp1-passcode" placeholder="passcode is" pattern="[0-9]*" inputmode="numeric" maxlength="10"> 
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="emp1-enable">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="setting-item">
                <div class="input-group">
                    <input type="text" id="emp2-name" placeholder="2nd Employee Name" maxlength="20"> 
                    <input type="text" id="emp2-passcode" placeholder="passcode is" pattern="[0-9]*" inputmode="numeric" maxlength="10"> 
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="emp2-enable">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="setting-item">
                <div class="input-group">
                    <input type="text" id="emp3-name" placeholder="3rd Employee Name" maxlength="20"> 
                    <input type="text" id="emp3-passcode" placeholder="passcode is" pattern="[0-9]*" inputmode="numeric" maxlength="10"> 
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="emp3-enable">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="setting-item">
                <div class="input-group">
                    <input type="text" id="emp4-name" placeholder="4th Employee Name" maxlength="20"> 
                    <input type="text" id="emp4-passcode" placeholder="passcode is" pattern="[0-9]*" inputmode="numeric" maxlength="10"> 
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="emp4-enable">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="setting-item">
                <div class="input-group">
                    <input type="text" id="emp5-name" placeholder="5th Employee Name" maxlength="20"> 
                    <input type="text" id="emp5-passcode" placeholder="passcode is" pattern="[0-9]*" inputmode="numeric" maxlength="10"> 
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="emp5-enable">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        <button id="apply-btn">APPLY</button>
    </div>
    <script>
        // Tab Switching
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabContents = document.querySelectorAll('.tab-content');

        tabLinks.forEach(link => {
            link.addEventListener('click', () => {
                // Remove active class from all tabs and contents
                tabLinks.forEach(l => l.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));

                // Add active class to clicked tab and corresponding content
                link.classList.add('active');
                document.getElementById(link.dataset.tab).classList.add('active');
            });
        });

        // Add input validation for passcode and pulses fields
        const numericInputs = document.querySelectorAll('input[id*="passcode"], input[id*="pulses"]');
        
        numericInputs.forEach(input => {
            input.addEventListener('input', function(e) {
                // Remove any non-digit characters
                this.value = this.value.replace(/[^0-9]/g, '');
            });
            
            input.addEventListener('keypress', function(e) {
                // Prevent non-digit keys from being entered
                if (!/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            });
        });

        document.getElementById('apply-btn').addEventListener('click', function() {
            const settings = {
                requireConfirmation: document.getElementById('require-confirmation').checked,
                requireAdminPassword: document.getElementById('require-admin-password').checked,
                employeeLog: document.getElementById('employee-log').checked,
                employeeTotalIn: document.getElementById('employee-total-in').checked,
                employeeTotalOut: document.getElementById('employee-total-out').checked,
                employeeTotalIncome: document.getElementById('employee-total-income').checked,
                employeeReboot: document.getElementById('employee-reboot').checked,
                requirePasscode: document.getElementById('require-passcode').checked,
                adminPasscode: document.getElementById('admin-passcode').value,
                adminConfirmPasscode: document.getElementById('admin-confirm-passcode').value,
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

            // Send JSON to settings.py
            fetch('settings.py', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: jsonSettings
            })
            .then(response => response.text())
            .then(data => {
                alert('Settings sent to Python script: ' + data);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to send settings to Python script.');
            });
        });
    </script>
</body>
</html>
HTML;
?>