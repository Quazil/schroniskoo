<?php
// Połączenie z bazą danych - należy dostosować do własnych ustawień
$host = "localhost";
$dbname = "schronisko";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Błąd połączenia z bazą danych: " . $e->getMessage());
}

$typ = $_GET['typ'];

$query = "SELECT id FROM klatki WHERE typ = :typ";
$stmt = $db->prepare($query);
$stmt->bindParam(':typ', $typ);
$stmt->execute();

$klatki = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($klatki);
?>
