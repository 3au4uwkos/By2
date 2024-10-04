<?php
   if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
    header('HTTP/1.1 403 Forbidden');
    die('Get out and stay out!');
}
?>