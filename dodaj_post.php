<?php
session_start();



// Połączenie z bazą danych (ustaw swoje dane dostępu)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uzytkownicy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pobierz dane z formularza
$id_uzytkownika = $_SESSION['user_id']; // Użyj rzeczywistego klucza sesji
$tytul = $_POST['tytul'];
$tresc = $_POST['tresc'];

// Dodaj post do bazy danych
$sql = "INSERT INTO posty (id_uzytkownika, tytul, tresc) VALUES ('$id_uzytkownika', '$tytul', '$tresc')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>