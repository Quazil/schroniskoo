<?php
#komenatarzykfgh
@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

//    $select2 = "SELECT * FROM rezerwacja";
//    mysqli_query($conn, $select2);

//    echo $select2

$mysqli = new mysqli ("localhost", "root", "root","schronisko");
//        $sql = "SELECT * FROM rezerwacja";
//        if ($result = $mysqli -> query($sql))
//        {
//            $wiersz = $result -> fetch_assoc();
//             $lokalizacja = $wiersz['location'];
//             $data = $wiersz['date'];

//            $result -> free_result();

//            while($wiersz=$result->fetch_assoc())
//                 {
//            echo $lokalizacja;
//            echo $data;
//                 }
//        }


//        $mysqli -> close();

$sql = " SELECT * FROM rezerwacja ";
$result = $mysqli->query($sql);
$mysqli->close();
       
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Strona Admina</title>

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- Link to CSS -->
   <link rel="stylesheet" href="style.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
         <a class="navbar-brand" href="index.php">
            <img src="img/logoCarWash.png" alt="" width="30" height="24">
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Strona Główna</a>
               </li>
            </ul>
            <form class="d-flex">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                     <a class="nav-link active" href="logout.php">Wyloguj się</a>
                  </li>
               </ul>
            </form>
         </div>
      </div>
   </nav>

<div class="container">

   <div class="content">
      <h3>cześć, <span>admin</span></h3>
      <h1>Witaj <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <p>to jest strona administracyjna</p>
      <a href="login_form.php" class="btn">Zaloguj</a>
      <a href="register_form.php" class="btn">Zarejestruj</a>
      <a href="logout.php" class="btn">Wyloguj</a>

      <section class="tabela">
        <h1>Rezerwacje</h1>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>Lokalizacja</th>
                <th>Data</th>

            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['location'];?></td>
                <td><?php echo $rows['date'];?></td>

            </tr>
            <?php
                }
            ?>
        </table>
    </section>
   </div>

   

</div>

</body>
</html>