<?php
session_start();
session_destroy();
header('Location: /smileapp/index.php')
?>