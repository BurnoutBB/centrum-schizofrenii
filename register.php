<?php
session_start();
include('db_connect.php');

$response = ""; // Inicjalizacja zmiennej odpowiedzi
$redirect = ""; // Inicjalizacja zmiennej przekierowania

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $checkUsernameQuery = "SELECT * FROM logowanie WHERE Nazwa_uzytkownika=?";
    $checkUsernameStmt = $conn->prepare($checkUsernameQuery);
    $checkUsernameStmt->bind_param("s", $username);
    $checkUsernameStmt->execute();
    $checkUsernameResult = $checkUsernameStmt->get_result();

    $checkEmailQuery = "SELECT * FROM logowanie WHERE email=?";
    $checkEmailStmt = $conn->prepare($checkEmailQuery);
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();

    if ($checkUsernameResult->num_rows > 0) {
        $response = "Ta nazwa jest juz zajeta";
    } elseif ($checkEmailResult->num_rows > 0) {
        $response = "Ten email jest juz zajety";
    } else {
        // Dodaj nowego użytkownika do bazy danych
        $insertQuery = "INSERT INTO logowanie (Nazwa_uzytkownika, haslo, email) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sss", $username, $password, $email);

        if ($insertStmt->execute()) {
            $response = "Rejestracja zakończona sukcesem";
            $redirect = "logowanie.html";
        } else {
            $response = "Błąd rejestracji: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    $checkUsernameStmt->close();
    $checkEmailStmt->close();
}

// Przekazanie odpowiedzi do JavaScript
echo json_encode(array("response" => $response, "redirect" => $redirect));
?>
