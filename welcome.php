<!DOCTYPE html>
<html>
<head>
  <title>Panel Admina</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Roboto', Arial, sans-serif;
      background-color: #f4f4f4;
    }
    
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .button-container {
      position: fixed;
      left: 0;
      top: 0;
      bottom: 0;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: center;
      padding: 20px;
      background: linear-gradient(to right, #34495e, #2c3e50);
      z-index: 9999;
    }
    
    .button {
      margin-bottom: 10px;
      color: #fff;
      background: linear-gradient(to bottom, #34495e, #2c3e50);
      border: none;
      opacity: 0.9;
      transition: opacity 0.3s ease;
    }
    
    .button:hover {
      opacity: 1;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Panel Admina</h1>
  </div>
  
  <div class="button-container">
    <a href="index.html" class="btn btn-outline-light button">Strona Główna</a>
    <a href="dodajzwierze.php" class="btn btn-outline-light button">Dodaj Zwierzę</a>
    <a href="zaadoptuj.php" class="btn btn-outline-light button">Zaadoptuj</a>
    <a href="usunzwierze.php" class="btn btn-outline-light button">Usuń Zwierzę</a>
    <a href="przegladaj.php" class="btn btn-outline-light button">Przeglądaj</a>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
