<?php
$host = "localhost"; // Twój host
$uzytkownik = "root"; // Twój użytkownik bazy danych
$haslo = ""; // Twoje hasło
$baza_danych = "uzytkownicy"; // Nazwa Twojej bazy danych

$conn = new mysqli($host, $uzytkownik, $haslo, $baza_danych);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}
?>
