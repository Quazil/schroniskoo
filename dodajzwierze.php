<!DOCTYPE html>
<html>
<head>
  <title>Dodaj zwierzę</title>
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
    .form-container input[type="text"],
    .form-container select,
    .form-container textarea {
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
      $typ = $_POST['typ'];
      $imie = $_POST['imie'];
      $wiek = $_POST['wiek'];
      $rasa = $_POST['rasa'];
      $zdjecie = $_POST['zdjecie']; // Zdjęcie jako link
      $opis = $_POST['opis'];

      // Dodanie zwierzęcia do bazy danych
      $query = "INSERT INTO zwierzeta (typ, imie, wiek, rasa, zdjecie, opis) VALUES (:typ, :imie, :wiek, :rasa, :zdjecie, :opis)";
      $stmt = $db->prepare($query);
      $stmt->bindParam(':typ', $typ);
      $stmt->bindParam(':imie', $imie);
      $stmt->bindParam(':wiek', $wiek);
      $stmt->bindParam(':rasa', $rasa);
      $stmt->bindParam(':zdjecie', $zdjecie);
      $stmt->bindParam(':opis', $opis);

      try {
        $stmt->execute();

        // Pobierz ID dodanego zwierzęcia
        $idZwierzecia = $db->lastInsertId();

        // Przekieruj użytkownika na stronę wyboru klatki
        header("Location: wybierz_klatke.php?id=$idZwierzecia");
        exit();
      } catch (PDOException $e) {
        echo "Błąd podczas dodawania zwierzęcia do bazy danych: " . $e->getMessage();
      }
    }
  }
  ?>

  <div class="form-container">
    <form method="POST" action="" enctype="multipart/form-data">
      <label for="typ">Typ:</label>
      <select name="typ" id="typSelect" required onchange="updateRasy()">
        <option value="kot">Kot</option>
        <option value="pies">Pies</option>
      </select>

      <label for="imie">Imię:</label>
      <input type="text" name="imie" required>

      <label for="wiek">Wiek:</label>
      <select name="wiek" required>
        <?php
        // Generowanie opcji dla wieku 1-20
        for ($i = 1; $i <= 20; $i++) {
          echo "<option value='$i'>$i</option>";
        }
        ?>
      </select>

      <label for="rasa">Rasa:</label>
      <select name="rasa" id="rasaSelect" required></select>

      <label for="zdjecie">Zdjęcie (link):</label>
      <input type="text" name="zdjecie" required>

      <label for="opis">Opis:</label>
      <textarea name="opis" required></textarea>

      <input type="submit" name="submit" value="Dodaj zwierzę">

      <script>
        function updateRasy() {
          var typSelect = document.getElementById("typSelect");
          var rasaSelect = document.getElementById("rasaSelect");
          rasaSelect.innerHTML = ""; // Wyczyść opcje pola rasy

          if (typSelect.value === "kot") {
            var kotRasy = ['Dachowiec', 'Bezdomny', 'Inna'];
            for (var i = 0; i < kotRasy.length; i++) {
              var option = document.createElement("option");
              option.text = kotRasy[i];
              option.value = kotRasy[i];
              rasaSelect.add(option);
            }
          } else if (typSelect.value === "pies") {
            var piesRasy = ['Labrador', 'Husky', 'Inna'];
            for (var i = 0; i < piesRasy.length; i++) {
              var option = document.createElement("option");
              option.text = piesRasy[i];
              option.value = piesRasy[i];
              rasaSelect.add(option);
            }
          }
        }
      </script>
    </form>
  </div>
</body>
</html>
