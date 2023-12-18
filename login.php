<?php
session_start();
include('db_connect.php'); // Załącz plik z połączeniem do bazy danych

$response = array("success" => false, "message" => ""); // Inicjalizacja tablicy odpowiedzi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id_uzytkownika, haslo FROM logowanie WHERE Nazwa_uzytkownika = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $response["success"] = true;
        // Możesz dodać dodatkowe informacje do przekazania, jeśli potrzebujesz
    } else {
        $response["message"] = "Błędny login lub hasło!";
    }

    $stmt->close();
}

// Przekazanie odpowiedzi do JavaScript
echo json_encode($response);
?>
