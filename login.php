<?php
session_start();
 
//ja
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: admin.php");
    exit;
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
  // Retrieve the form data
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $type = $_POST['type'];

  // Validate the form data
  if (empty($username) || empty($password) || empty($email)) {
    $error = "Username or Password is invalid";
  } else {
    // Connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'schronisko');

    // Check if the user exists in the database
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND email = '$email'";
    $result = mysqli_query($db, $query);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows == 1) {
      // Start a new session and store the username in a session variable
      session_start();
      $_SESSION["loggedin"] = true;
      $_SESSION["username"] = $username;
      $_SESSION["email"] = $email; 
      $_SESSION["type"] = $type;
      header("location: welcome.php");
      
      
    } else {
      $error = "Username or Password is invalid";
    }
  }
}

?>

<link rel="stylesheet" href="Bootstrap\css\styles.css">

<head>
    <link rel="icon" type="image/x-icon" href="Bootstrap/assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
</head>

<!-- Display the login form -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
    <div class="container px-5">
        <a class="aEraFreshLogo" href="index.php"><img class="eraFreshLogo" src="Bootstrap\assets\img\logoERAfresh.png"
                alt=""></a>
        <a class="navbar-brand fw-bold" href="index.php">ERA Fresh</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                <li class="nav-item"><a class="nav-link me-lg-3" href="login.php">Zaloguj się</a></li>
                <li class="nav-item"><a class="nav-link me-lg-3" href="register.php">Stwórz konto</a></li>
            </ul>
            <button class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal"
                data-bs-target="#feedbackModal">
                <span class="d-flex align-items-center">
                  <a href="calendar.php">
                  <i class="bi-chat-text-fill me-2"></i>
                  <span class="small">Umów wizytę</span></a>
                </span>
            </button>
        </div>
    </div>
</nav>

<link rel="stylesheet" href="style-login.css">

<div class="container" id="container">
    <!-- <div class="form-container sign-up-container">
		<form action="#">
			<h1>Stwórz konto</h1>
			<span>or use your email for registration</span>
			<label for="username">Username:</label><br>
      <input type="text" name="username" placeholder="Name" ><br>
      <input type="email" name="email" placeholder="Email" />
      <label for="password">Password:</label><br>
      <input type="password" name="password" placeholder="Password"><br><br>
      <input type="submit" name="submit" value="Submit">
			<button>Stwórz konto</button>
		</form>
	</div> -->
    <div class="form-container sign-in-container">
        <form method="post" action="login.php">
            <h1>Zaloguj się</h1>
            <span>użyj swojego konta</span>
            <input type="text" name="username" placeholder="Imię" />
            <input type="email" name="email" placeholder="E-mail" />
            <input type="password" name="password" placeholder="Hasło" />
            <a href="#">Zapomniałeś hasła?</a>
            <!-- <button> <input type="submit" name="submit" Zaloguj się ></button> -->
            <input type="submit" name="submit" value="Zaloguj się">
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <!-- <div class="overlay-panel overlay-left">
				<h1>Witaj ponownie!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div> -->
            <div class="overlay-panel overlay-right">
                <h1>Witaj przyjacielu!</h1>
                <p>Podaj swoje dane osobowe i rozpocznij z nami swoją podróż</p>
                <a href="register.php">
                    <button class="ghost" id="signUp">Zarejestruj się</button></a>
            </div>
        </div>
    </div>
</div>

<!-- <script src="login.js"></script> -->

<!-- Display an error message, if one exists -->
<?php if (isset($error)) { echo $error; } ?>