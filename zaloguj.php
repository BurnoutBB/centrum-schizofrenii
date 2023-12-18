<?php

$conn = new mysqli("localhost", "root", "", "uzytkownicy");
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

$sql = "SELECT logowanie.id_uzytkownika, logowanie.Nazwa_uzytkownika, logowanie.haslo, logowanie.email
        FROM logowanie
        WHERE id_uzytkownika=1";

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>" . $row['Nazwa_uzytkownika'] . "</h2>";
        echo "<h2>" . $row['email'] . "</h2>";
        echo "<h2>" . $row['haslo'] . "</h2>";
    } else {
        echo "Brak wyników";
    }
} else {
    echo "Błąd zapytania: " . $conn->error;
}

$conn->close();

?>








