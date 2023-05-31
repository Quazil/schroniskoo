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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST["id"];

  $query = "SELECT opis FROM dane WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindParam(":id", $id);

  try {
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $opis = $result["opis"];
    echo $opis;
  } catch (PDOException $e) {
    die("Błąd podczas pobierania opisu: " . $e->getMessage());
  }
}
