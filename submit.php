<?php
// Połączenie z bazą danych
$conn = mysqli_connect("localhost", "root", "", "schronisko");

// Sprawdzenie, czy udało się połączyć z bazą danych
if (!$conn) {
  die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Sprawdzenie, czy dane zostały przesłane z formularza
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Pobranie danych z formularza
  $idzwierzecia = $_POST["idzwierzecia"];
  $imie = $_POST["imie"];
  $nazwisko = $_POST["nazwisko"];
  $telefon = $_POST["telefon"];
  $email = $_POST["email"];
  $dataurodzenia = $_POST["dataurodzenia"];
  $miejscezamieszkania = $_POST["miejscezamieszkania"];
  $dochod = $_POST["dochod"];
  $opis = $_POST["opis"];

  // Zabezpieczenie danych przed atakami typu SQL Injection
  $idzwierzecia = mysqli_real_escape_string($conn, $idzwierzecia);
  $imie = mysqli_real_escape_string($conn, $imie);
  $nazwisko = mysqli_real_escape_string($conn, $nazwisko);
  $telefon = mysqli_real_escape_string($conn, $telefon);
  $email = mysqli_real_escape_string($conn, $email);
  $dataurodzenia = mysqli_real_escape_string($conn, $dataurodzenia);
  $miejscezamieszkania = mysqli_real_escape_string($conn, $miejscezamieszkania);
  $dochod = mysqli_real_escape_string($conn, $dochod);
  $opis = mysqli_real_escape_string($conn, $opis);

  // Zapytanie SQL do dodania danych do bazy
  $query = "INSERT INTO dane (idzwierzecia, imie, nazwisko, telefon, email, dataurodzenia, miejscezamieszkania, dochod, opis) 
            VALUES ('$idzwierzecia', '$imie', '$nazwisko', '$telefon', '$email', '$dataurodzenia', '$miejscezamieszkania', '$dochod', '$opis')";

  // Wykonanie zapytania
  if (mysqli_query($conn, $query)) {
    echo "Dane zostały pomyślnie dodane do bazy.";
  } else {
    echo "Błąd: " . mysqli_error($conn);
  }
}

// Zamknięcie połączenia z bazą danych
mysqli_close($conn);
?>
