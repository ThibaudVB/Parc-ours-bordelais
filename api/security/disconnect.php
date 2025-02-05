<?php
session_start();
session_unset();
session_destroy();
header("Location: /views/backend/security/login.php");
exit();
?>
