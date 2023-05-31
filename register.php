<?php
// Connect to the database
$db = new mysqli('localhost', 'root', '', 'schronisko');

// Check for a successful connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {

    // Get the form data
    $email = $db->real_escape_string($_POST['email']);
    $username = $db->real_escape_string($_POST['username']);
    $password = $db->real_escape_string($_POST['password']);
    $type = $db->real_escape_string($_POST['type']);

    // Insert the data into the database
    $query = "INSERT INTO users (email, username,password,type) VALUES ('$email', '$username','$password','$type')";
    if ($db->query($query) === TRUE) {
        echo "Registration successful!";
        header("location: login.php");
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Zarejestruj się</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style-login.css">
    <link rel="stylesheet" href="Bootstrap\css\styles.css">
    <link rel="icon" type="image/x-icon" href="Bootstrap/assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="aEraFreshLogo" href="index.php"><img class="eraFreshLogo"
                    src="Bootstrap\assets\img\logoERAfresh.png" alt=""></a>
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

    <div class="wrapper">
        <h2>Zarejestruj się</h2>
        <!-- Formularz rejestracji -->
        <form method="post" action="register.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" name="submit" value="Register">
            <label for="username">Type:</label>
            <input type="text" id="type" name="type" required>
            
        </form>
    </div>



    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form method="post" action="register.php">
                <h1>Zarejestruj się</h1>
                <span>stwórz konto, aby móc korzystać z naszych usług</span>
                <input type="text" id="username" name="username" placeholder="Imię" required>
                <input type="email" id="email" name="email" placeholder="E-mail" required>
                <input type="password" id="password" name="password" placeholder="Hasło" required>
                <!-- <button> <input type="submit" name="submit" Zaloguj się ></button> -->
                <input type="submit" name="submit" value="Stwórz konto">
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
                    <h1>Masz już konto?</h1>
                    <p>Wciśnij poniższy guzik i przejdź do strony logowania</p>
                    <a href="login.php">
                        <button class="ghost" id="signUp">Zaloguj się</button></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>