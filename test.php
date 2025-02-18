<?php
$log_file = '/home/pi/VBot_Offline/logs.log';
if (file_exists($log_file)) {
    $logs = file_get_contents($log_file);
    echo nl2br($logs);
} else {
    echo "File log không tồn tại.";
}
?>
