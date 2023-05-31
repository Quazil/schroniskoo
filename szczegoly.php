<!DOCTYPE html>
<html>
<head>
    <title>Szczegóły zwierzęcia</title>
</head>
<body>
<a href="welcome.php" class="fixed-button">
    <span>&rarr;</span>
  </a>
    <h1>Szczegóły zwierzęcia</h1>

    <?php
    // Połączenie z bazą danych - wymaga odpowiednich danych dostępowych
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "schronisko";

    $conn = new mysqli($host, $username, $password, $database);

    // Sprawdzenie połączenia
    if ($conn->connect_error) {
        die("Błąd połączenia: " . $conn->connect_error);
    }

    // Pobranie danych zwierzęcia na podstawie przekazanego ID
    $id = $_GET["id"];

    $sql = "SELECT * FROM zwierzeta WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Wyświetlanie danych zwierzęcia
        $row = $result->fetch_assoc();
        $imie = $row["imie"];
        $wiek = $row["wiek"];
        $rasa = $row["rasa"];
        $szczepiony = $row["szczepiony"];
        $utrzymanie = $row["utrzymanie"];
        $opis = $row["opis"];

        echo "<h2>$imie</h2>";
        echo "<p>Wiek: $wiek</p>";
        echo "<p>Rasa: $rasa</p>";
        echo "<p>Szczepiony: $szczepiony</p>";
        echo "<p>Koszt utrzymania miesięczny: $utrzymanie</p>";
        echo "<p>Opis: $opis</p>";
    } else {
        echo "Nie znaleziono zwierzęcia o podanym ID.";
    }

    $conn->close();
    ?>
</body>
</html>
