<?php
session_start();
include('db_connect.php');

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];

    // Sprawdź, czy plik został przesłany
    if (!empty($_FILES["file"]["tmp_name"]) && is_uploaded_file($_FILES["file"]["tmp_name"])) {
        $target_dir = "img/profile_pictures/";
        $original_file_name = basename($_FILES["file"]["name"]);
        $target_file = $target_dir . $original_file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Sprawdź, czy plik jest obrazem
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check !== false) {
            // Obsługa konfliktu nazw plików
            $counter = 1;
            while (file_exists($target_file)) {
                $original_file_name = pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME);
                $target_file = $target_dir . $original_file_name . '_' . $counter . '.' . $imageFileType;
                $counter++;
            }

            // Przenieś plik do odpowiedniego folderu
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

            // Zaktualizuj bazę danych o ścieżkę do nowego zdjęcia
            $stmt_update = $conn->prepare("UPDATE logowanie SET profile_picture = ? WHERE id_uzytkownika = ?");
            $stmt_update->bind_param("si", $target_file, $user_id);
            $stmt_update->execute();
            $stmt_update->close();
        } else {
            $_SESSION['phpKomunikat'] = "Plik nie jest obrazem.";
        }
    } else {
        $_SESSION['phpKomunikat'] = "Nie wybrano pliku do przesłania.";
    }

    // Przejdź z powrotem do profile.php
    header('Location: profile.php');
    exit();
}
?>
