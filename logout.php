<?php
session_start();
session_destroy(); // Zniszcz sesję
header('Location: logowanie.html');
exit();
?>
