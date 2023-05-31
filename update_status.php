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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $query = "UPDATE dane SET status = :status WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);

    try {
      $stmt->execute();
    } catch (PDOException $e) {
      die("Błąd podczas aktualizacji statusu: " . $e->getMessage());
    }
  }
}
?>
