<!DOCTYPE html>
<html>
<head>
    <title>Usuń zwierzę</title>
</head>
<body>
<a href="welcome.php" class="fixed-button">
    <span>&rarr;</span>
  </a>
    <h2>Usuń zwierzę</h2>
    
    <?php
    // Połączenie z bazą danych (przykładowe dane)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "schronisko";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Połączenie nieudane: " . $conn->connect_error);
    }

    // Pobranie wszystkich danych z tabeli "zwierzeta"
    $sql = "SELECT * FROM zwierzeta";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Imię</th><th>Wiek</th><th>Rasa</th><th>Typ</th><th>Zdjęcie</th><th>Akcje</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["imie"] . "</td>";
            echo "<td>" . $row["wiek"] . "</td>";
            echo "<td>" . $row["rasa"] . "</td>";
            echo "<td>" . $row["typ"] . "</td>";
            echo "<td><img src='" . $row["zdjecie"] . "' width='100' height='100'></td>";
            echo "<td><form method='POST' action=''>
                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                    <input type='submit' name='delete' value='Usuń'>
                </form></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Brak danych w tabeli.";
    }

    $conn->close();
    ?>
    
    <?php
    // Obsługa usuwania zwierzęcia
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Połączenie nieudane: " . $conn->connect_error);
        }

        // Usunięcie zwierzęcia na podstawie ID
        $sql = "DELETE FROM zwierzeta WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Zwierzę o ID $id zostało usunięte.";
        } else {
            echo "Błąd: " . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
