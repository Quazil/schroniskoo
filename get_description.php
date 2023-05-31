<!DOCTYPE html>
<html>
<head>
  <title>Przeglądanie danych</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      padding: 0;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .dog-details {
      display: flex;
      align-items: flex-start;
    }

    .dog-details img {
      max-width: 200px;
      margin-right: 20px;
    }

    .action-buttons {
      margin-top: 10px;
      display: flex;
      flex-wrap: wrap;
    }

    .action-button {
      display: inline-block;
      padding: 8px 12px;
      margin-right: 8px;
      margin-bottom: 8px;
      border-radius: 3px;
      cursor: pointer;
    }

    .approve-button {
      background-color: #4CAF50;
      color: white;
    }

    .reject-button {
      background-color: #FF0000;
      color: white;
    }

    /* Styl dla wyskakującego okna */
    .popup {
      max-width: 600px;
      max-height: 600px;
      overflow: auto;
      background-color: #ffffff;
      border: 1px solid #000000;
      padding: 20px;
    }
  </style>
</head>
<body>
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

  // Pobranie danych z tabeli "dane"
  $query = "SELECT * FROM zwierzeta";
  $stmt = $db->prepare($query);

  try {
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die("Błąd podczas pobierania danych: " . $e->getMessage());
  }
  ?>

  <div class="popup">
    <table>
      <tr>
        <th>ID</th>
        <th>Imię</th>
        <th>Wiek</th>
        <th>Rasa</th>
        <th>Typ</th>
        <th>Klatka</th>
        <th>Zdjęcie</th>
        <th>Opis</th>
        <th>Szczepiony</th>
        <th>Utrzymanie</th>
        <th>Akcje</th>
      </tr>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['imie']; ?></td>
          <td><?php echo $row['wiek']; ?></td>
          <td><?php echo $row['rasa']; ?></td>
          <td><?php echo $row['typ']; ?></td>
          <td><?php echo $row['klatka']; ?></td>
          <td>
            <?php if ($row['zdjecie']) : ?>
              <img src="<?php echo $row['zdjecie']; ?>" alt="Zdjęcie psa">
            <?php endif; ?>
          </td>
          <td><?php echo $row['opis']; ?></td>
          <td><?php echo $row['szczepiony']; ?></td>
          <td><?php echo $row['utrzymanie']; ?></td>
          <td class="action-buttons">
            <button class="action-button approve-button" onclick="updateStatus(<?php echo $row['id']; ?>, 'zatwierdzony')">Zatwierdź</button>
            <button class="action-button reject-button" onclick="updateStatus(<?php echo $row['id']; ?>, 'odrzucony')">Odrzuć</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

  <script>
    function updateStatus(id, status) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          location.reload(); // Przeładuj stronę po zaktualizowaniu statusu
        }
      };
      xhttp.open("POST", "update_status.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("id=" + id + "&status=" + status);
    }
  </script>
</body>
</html>
