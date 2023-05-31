<!DOCTYPE html>
<html>
<head>
  <title>Adopcja zwierząt - Schronisko</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .animal img {
      max-width: 500px;
      max-height: 500px;
    }
  </style>
</head>
<body>
<a href="welcome.php" class="fixed-button">
    <span>&rarr;</span>
  </a>
  <header>
    <h1>Adopcja zwierząt - Schronisko</h1>
  </header>
  
  <nav>
    <ul>
      <li><a href="index.php">Strona główna</a></li>
      <li><a href="adopcje.php">Dostępne zwierzęta</a></li>
      <li><a href="formularz.php">Formularz adopcyjny</a></li>
    </ul>
  </nav>
  
  <div class="content">
    <h2>Dostępne zwierzęta do adopcji</h2>
    
    <?php
    // Połączenie z bazą danych
    $conn = mysqli_connect("localhost", "root", "", "schronisko");

    // Sprawdzenie, czy udało się połączyć z bazą danych
    if (!$conn) {
      die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }

    // Zapytanie do bazy danych
    $query = "SELECT id, imie, zdjecie FROM zwierzeta";

    // Wykonanie zapytania
    $result = mysqli_query($conn, $query);

    // Wyświetlanie zwierząt
    if (mysqli_num_rows($result) > 0) {
      echo "<form method='post' action='submit.php'>";
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $imie = $row['imie'];
        $zdjecie = $row['zdjecie'];

        echo "<div class='animal'>";
        echo "<img src='$zdjecie' alt='$imie'>";
        echo "<input type='checkbox' name='zwierzeta[]' value='$id'>";
        echo "<label>$imie</label>";
        echo "</div>";
      }
      
      // Formularz adopcyjny
      echo "<h2>Formularz adopcyjny</h2>";
      echo "<input type='hidden' name='idzwierzecia' value='$id'>";
      echo "<label for='imie'>Imię:</label>";
      echo "<input type='text' id='imie' name='imie' required><br>";
      echo "<label for='nazwisko'>Nazwisko:</label>";
      echo "<input type='text' id='nazwisko' name='nazwisko' required><br>";
      echo "<label for='telefon'>Telefon:</label>";
      echo "<input type='text' id='telefon' name='telefon' required><br>";
      echo "<label for='email'>Email:</label>";
      echo "<input type='email' id='email' name='email' required><br>";
      echo "<label for='dataurodzenia'>Data urodzenia:</label>";
      echo "<input type='date' id='dataurodzenia' name='dataurodzenia' required><br>";
      echo "<label for='miejscezamieszkania'>Miejsce zamieszkania:</label>";
      echo "<input type='text' id='miejscezamieszkania' name='miejscezamieszkania' required><br>";
      echo "<label for='dochod'>Dochód:</label>";
      echo "<select id='dochod' name='dochod' required>";
      echo "<option value='1000-5000'>1000-5000</option>";
      echo "<option value='5000+'>5000+</option>";
      echo "</select><br>";
      echo "<label for='opis'>Opis:</label><br>";
      echo "<textarea id='opis' name='opis' required></textarea><br>";
      echo "<input type='submit' value='Wyślij'>";
      echo "</form>";
    } else {
      echo "Brak dostępnych zwierząt.";
    }

    // Zamknięcie połączenia z bazą danych
    mysqli_close($conn);
    ?>
    
  </div>
  
</body>
</html>
