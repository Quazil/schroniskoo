<!DOCTYPE html>
<html>
<head>
    <title>Zwierzęta</title>
    <style>
        .animal {
            display: inline-block;
            margin: 10px;
            text-align: center;
        }

        .animal img {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .animal .details {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<a href="welcome.php" class="fixed-button">
    <span>&rarr;</span>
  </a>
<h2>Zwierzęta</h2>

<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "schronisko";

// Utworzenie połączenia z bazą danych
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}

// Pobranie danych zwierząt z bazy danych
$sql = "SELECT * FROM zwierzeta";
$result = $conn->query($sql);

// Wyświetlanie danych zwierząt
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imie = $row['imie'];
        $zdjecie = $row['zdjecie'];
        $opis = $row['opis'];

        echo '<div class="animal">';
        echo '<a href="szczegoly.php?id=' . $row['id'] . '"><img src="' . $zdjecie . '" alt="' . $imie . '"></a>';
        echo '<div class="details">';
        echo '<h3>' . $imie . '</h3>';
        echo '<p>' . $opis . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "Brak danych zwierząt.";
}

// Zamknięcie połączenia z bazą danych
$conn->close();
?>
</body>
</html>
