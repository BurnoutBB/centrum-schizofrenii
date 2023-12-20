<?php
// Rozpocznij sesję
session_start();

include 'db_connect.php';

// Pobierz dane z formularza
$komentarz = $_POST['komentarz'] ?? '';
$post_id = $_POST['post_id'] ?? '';
$user_id = $_SESSION['user_id'];

// Debugging
echo "komentarz: $komentarz, post_id: $post_id, user_id: $user_id";

// Zapisz komentarz do bazy danych z użyciem prepared statement
$sql = $conn->prepare("INSERT INTO komentarze (post_id, id_uzytkownika, komentarz) VALUES (?, ?, ?)");
$sql->bind_param("iis", $post_id, $user_id, $komentarz);

if ($sql->execute()) {
    // Udane dodanie komentarza
    header("Location: nowypost.php?post_id=$post_id");
} else {
    // Błąd przy dodawaniu komentarza
    echo "Błąd przy dodawaniu komentarza: " . $conn->error;
}

$sql->close();
