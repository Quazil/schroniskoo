<!DOCTYPE html>
<html>
<head>
  <title>Wybierz klatkę</title>
  <style>
    .form-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .form-container label {
      display: block;
      margin-bottom: 10px;
    }
    .form-container select {
      width: 100%;
      padding: 10px;
      border-radius: 3px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      margin-bottom: 15px;
    }
    .form-container input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
  </style>
</head>
<body>
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
    // Sprawdzenie, czy formularz został wysłany
    if (isset($_POST['submit'])) {
      $idZwierzecia = $_POST['idzwierzecia'];
      $idKlatki = $_POST['klatka'];

      // Aktualizacja wartości 'idzwierzecia' w wybranej klatce
      $query = "UPDATE klatki SET idzwierzecia = :idZwierzecia WHERE id = :id";
      $stmt = $db->prepare($query);
      $stmt->bindParam(':idZwierzecia', $idZwierzecia);
      $stmt->bindParam(':id', $idKlatki);

      try {
        $stmt->execute();
        echo "Zwierzę zostało przypisane do klatki.";
      } catch (PDOException $e) {
        echo "Błąd podczas przypisywania zwierzęcia do klatki: " . $e->getMessage();
      }
    }
  } else {
    // Sprawdzenie, czy parametr 'id' został przekazany w adresie URL
    if (isset($_GET['id'])) {
      $idZwierzecia = $_GET['id'];

      // Pobranie typu zwierzęcia na podstawie idZwierzecia
      $query = "SELECT typ FROM zwierzeta WHERE id = :idZwierzecia";
      $stmt = $db->prepare($query);
      $stmt->bindParam(':idZwierzecia', $idZwierzecia);

      try {
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $typZwierzecia = $result['typ'];
      } catch (PDOException $e) {
        die("Błąd podczas pobierania typu zwierzęcia: " . $e->getMessage());
      }

      // Pobranie klatek o odpowiednim typie (pasujące do typu zwierzęcia)
      $query = "SELECT * FROM klatki WHERE typ = :typZwierzecia AND idzwierzecia IS NULL";
      $stmt = $db->prepare($query);
      $stmt->bindParam(':typZwierzecia', $typZwierzecia);

      try {
        $stmt->execute();
        $klatki = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        die("Błąd podczas pobierania klatek: " . $e->getMessage());
      }
      ?>

      <div class="form-container">
        <form method="POST" action="">
          <input type="hidden" name="idzwierzecia" value="<?php echo $idZwierzecia; ?>">

          <label for="klatka">Wybierz klatkę:</label>
          <select name="klatka" required>
            <?php foreach ($klatki as $klatka) : ?>
              <option value="<?php echo $klatka['id']; ?>"><?php echo $klatka['id']; ?></option>
            <?php endforeach; ?>
          </select>

          <input type="submit" name="submit" value="Przypisz do klatki">
        </form>
      </div>
    <?php
    } else {
      echo "Nieprawidłowy parametr ID.";
    }
  }
  ?>
</body>
</html>
