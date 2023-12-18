<?php
session_start();
session_destroy(); // Zniszcz sesję

// Przekieruj użytkownika na stronę logowania po wylogowaniu
header('Location: logowanie.html');
exit();
?>
