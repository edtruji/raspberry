<!DOCTYPE html>
<html>
<?php
// Initialize variables
$output = "";
$ip_address = "";
$qr_image = "/qrimage.png"; // Path to the QR image

if (!empty($_GET["ip_address"])) {
    // Sanitize input to prevent command injection
    $ip_address = escapeshellarg($_GET["ip_address"]);
    
    // Execute the Python script with the IP address
    $output = shell_exec("python /var/www/html/qrimage.py $ip_address");
    
    // Add a timestamp to the image URL to prevent caching
    $qr_image = "/qrimage.png?" . time();
}
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
    IP Address for QR Code
    <input type="text" name="ip_address" placeholder="Enter IP address" value="<?php echo htmlspecialchars($_GET["ip_address"] ?? ''); ?>"/>
    <br/>
    <input type="submit" value="Generate QR Code"/>
</form>

<?php if (!empty($_GET["ip_address"])): ?>
    <h3>QR Code for IP: <?php echo htmlspecialchars($_GET["ip_address"]); ?></h3>
    <img src="<?php echo $qr_image; ?>" alt="QR Code" style="max-width: 300px;"/>
    <p><?php echo htmlspecialchars($output); ?></p>
<?php endif; ?>

</html>