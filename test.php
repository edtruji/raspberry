<?php
header('Content-Type: text/html');
echo <<<HTML
<script>
    console.log(encodeURIComponent('test'));
</script>
HTML;
?>