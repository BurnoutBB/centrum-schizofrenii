<?php
session_start();
include('db_connect.php'); // Załącz plik z połączeniem do bazy danych

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Bezpieczne haszowanie hasła
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO logowanie (Nazwa_uzytkownika, haslo, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $email);

    if ($stmt->execute()) {
        echo "Rejestracja udana!";
    } else {
        echo "Błąd rejestracji: " . $stmt->error;
    }

    $stmt->close();
}
?>
