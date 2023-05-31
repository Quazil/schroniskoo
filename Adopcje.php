<!DOCTYPE html>
<html>
<head>
  <title>Przeglądanie danych</title>
  <style>
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

    .action-buttons {
      display: flex;
      align-items: center;
    }

    .action-button {
      display: inline-block;
      padding: 8px 12px;
      margin-right: 8px;
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

    .description-button {
      background-color: #008CBA;
      color: white;
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

  // Pobranie danych z tabeli "dane" wraz z odpowiadającymi im zdjęciami psów z tabeli "zwierzeta"
  $query = "SELECT dane.*, zwierzeta.zdjecie FROM dane LEFT JOIN zwierzeta ON dane.idzwierzecia = zwierzeta.id";
  $stmt = $db->prepare($query);

  try {
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die("Błąd podczas pobierania danych: " . $e->getMessage());
  }
  ?>

  <table>
    <tr>
      <th>ID</th>
      <th>Imię</th>
      <th>Nazwisko</th>
      <th>Telefon</th>
      <th>Email</th>
      <th>Data urodzenia</th>
      <th>Miejsce zamieszkania</th>
      <th>Dochód</th>
      <th>ID zwierzęcia</th>
      <th>Opis</th>
      <th>Status</th>
      <th>Zdjęcie</th>
      <th>Akcje</th>
    </tr>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['imie']; ?></td>
        <td><?php echo $row['nazwisko']; ?></td>
        <td><?php echo $row['telefon']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['dataurodzenia']; ?></td>
        <td><?php echo $row['miejscezamieszkania']; ?></td>
        <td><?php echo $row['dochod']; ?></td>
        <td><?php echo $row['idzwierzecia']; ?></td>
        <td><?php echo $row['opis']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>
          <?php if ($row['zdjecie']) : ?>
            <img src="<?php echo $row['zdjecie']; ?>" alt="Zdjęcie zwierzęcia" width="100">
          <?php endif; ?>
        </td>
        <td class="action-buttons">
          <button class="action-button description-button" onclick="showDescription(<?php echo $row['id']; ?>)">Opis</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <div id="description-modal" style="display: none;">
    <div id="description-content"></div>
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

    function showDescription(id) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var modal = document.getElementById("description-modal");
          var content = document.getElementById("description-content");
          content.innerHTML = this.responseText;
          modal.style.display = "block";
        }
      };
      xhttp.open("GET", "get_description.php?id=" + id, true);
      xhttp.send();
    }
  </script>
</body>
</html>
