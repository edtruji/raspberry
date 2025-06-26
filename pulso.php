<!DOCTYPE html>
<html>
<?php
if (!empty($_GET["count"]) && !empty($_GET["delay"])) {
  // Sanitize inputs to prevent command injection
  $count = escapeshellarg($_GET["count"]);
  $delay = escapeshellarg($_GET["delay"]);
  $output = shell_exec("sudo python /var/www/html/webBlinkLED.py $count $delay");
  echo "No of times to blink LED: " . htmlspecialchars($_GET["count"]) . "<br>";
  echo "Delay between blinks (seconds): " . htmlspecialchars($_GET["delay"]);
}
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
# times to blink LED 
<input type="text" name="count" placeholder="Enter number of blinks"/>
<br/>
Delay between blinks (seconds)
<input type="text" name="delay" placeholder="Enter delay in seconds"/>
<br/>
<input type="submit"/>
</form>
</html>