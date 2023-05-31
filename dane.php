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

  // Pobranie danych z tabeli "dane"
  $query = "SELECT * FROM dane";
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
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
