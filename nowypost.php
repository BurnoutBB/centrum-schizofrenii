<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Centrum schizofrenii</title>
        <link rel="icon" type="image/x-icon" href="img/ikona.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Żyjemy w centrum schizofrenii">
        <meta name="keywords" content="shizofrenia">
        <link rel="stylesheet" href="css/nowypost.css">
    </head>
    <body>
        <div id="post">
            
            
            <?php
$tytul = $_GET['tytul'] ?? '';
$tresc = $_GET['tresc'] ?? '';
$username = $_GET['username'] ?? '';
$profile_picture = $_GET['profile_picture'] ?? '';

// Zastosuj wordwrap tylko do tytułu
$wrappedTitle = wordwrap(htmlspecialchars($tresc), 100, "\n", true);

// Wyświetl informacje o użytkowniku
echo '<div id="userinfo">';
echo '<img id="profile_picture" src="' . htmlspecialchars($profile_picture) . '" height="160px" width="160px">';
echo '<h3 id="username">' . htmlspecialchars($username) . '</h3>';
echo '</div>';

// Wyświetl tytuł i treść posta
echo '<div id="post-content">';
echo '<h2 id="tytul">' . nl2br(htmlspecialchars($tytul)) . '</h2>';
echo '<p id="tresc">' . nl2br(htmlspecialchars($wrappedTitle)) . '</p>';
echo '</div>';


?>
        
</div>
        </div>
        <div id="powrut">
           <a href="index.php"><img src="img/logo3.png" height="60px"></a>
        </div>
        <div id="komentarz">
            <from>
                <div id="tekst">
                    <textarea required maxlength="445"></textarea> 
                </div>
                <div id="dodaj">
                    <input type="submit" value="+">
                </div>
            </from>
        </div>
    </body>
</html>