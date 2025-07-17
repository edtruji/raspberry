<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Execute Download File Script</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .output {
            background-color: #f4f4f4;
            padding: 10px;
            border: 1px solid #ccc;
            white-space: pre-wrap;
            margin-top: 10px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h2>Execute downloadFile.sh</h2>
    <form method="POST" action="">
        <label for="filename">Enter Filename:</label>
        <input type="text" id="filename" name="filename" required>
        <input type="submit" value="Run Script">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the filename from the form and sanitize it
        $filename = $_POST['filename'] ?? '';
        $filename = escapeshellarg($filename); // Sanitize input to prevent command injection

        // Path to the bash script (adjust if needed)
        $scriptPath = './downloadFile.sh';

        // Check if the script exists
        if (!file_exists($scriptPath)) {
            echo '<div class="output error">Error: downloadFile.sh not found!</div>';
            exit;
        }

        // Execute the bash script with the sanitized filename
        $command = "./downloadFile.sh $filename 2>&1"; // Capture both stdout and stderr
        $output = shell_exec($command);

        // Check if the output is empty or null
        if ($output === null) {
            echo '<div class="output error">Error: Failed to execute the script or no output returned.</div>';
        } else {
            // Display the script output
            echo '<div class="output"><strong>Script Output:</strong><br>' . htmlspecialchars($output) . '</div>';
        }
    }
    ?>
</body>
</html>