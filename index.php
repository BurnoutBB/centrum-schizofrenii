

<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Centrum schizofrenii</title>
        <link rel="icon" type="image/x-icon" href="img/ikona.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Żyjemy w centrum schizofrenii">
        <meta name="keywords" content="shizofrenia">
        <link rel="stylesheet" href="css/styl.css"> 
    </head>
    <body id="body">
        <div id="menu">
            <div id="logo">
                <img src="img/logo.png" height="150px">
            </div>
            <div id="log" class="wybur">
                <button onclick="window.location.href='logowanie.html'">LOGOWANIE</button>
            </div>
            <div id="reg" class="wybur">
                <button onclick="window.location.href='rejestracja.html'">REJESTRACJA</button>

            </div>
            <div id="info" class="wybur">
                <button href="informacje.html">INFORMACJE</button>

            </div>
            <div id="FAQ" class="wybur">
                <button onclick="window.location.href='profile.php'">KONTO</button>
            </div>
            <div id="text" class="wybur">
                <button onclick="window.location.href='post.html'">DODAJ POST</button>
            </div>
            <div id="przw">
                <h2>Najnowsze posty</h2>
            </div>
            
            <div class="nowypost-container">
        <?php
        // Użyj pliku do łączenia się z bazą danych
        include 'db_connect.php';

        // Zapytanie do bazy danych o posty z informacjami o użytkownikach
        $sql = "SELECT posty.post_id, posty.tytul, posty.tresc, logowanie.Nazwa_uzytkownika, logowanie.profile_picture 
                FROM posty 
                INNER JOIN logowanie ON posty.id_uzytkownika = logowanie.id_uzytkownika
                ORDER BY posty.post_id DESC"; // Dodana klauzula ORDER BY
        $result = $conn->query($sql);

        // Wyświetlanie postów
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="nowypost">';
                
                // Wyświetlanie nazwy użytkownika i zdjęcia profilowego
                echo '<div class="user-info">';
                echo '<img src="' . $row['profile_picture'] . '" alt="Profilowe" width="100" height="100">';
                echo '<p>' . $row['Nazwa_uzytkownika'] . '</p>';
                echo '</div>';
                
                // Wyświetlanie tytułu i treści posta obok zdjęcia
                $wrappedContent = wordwrap($row['tresc'], 160, "<br />\n", true);
                echo '<div class="post-content">';
                echo '<h3>' . $row['tytul'] . '</h3>';
                echo '<p>' . $wrappedContent . '</p>';
                echo '</div>';
                
                echo '</div>';
            }
        } else {
            // Wyświetlanie komunikatu, gdy brak postów
            echo '<div class="no-posts">';
            echo '<p>Brak postów do wyświetlenia.</p>';
            echo '</div>';
        }

        // Zamykanie połączenia
        $conn->close();
        ?>
    </div>
            <div id="footer">
                <p> Footer w chuj</p>
            </div>
            
            
        </div>
       
    </body>
</html>