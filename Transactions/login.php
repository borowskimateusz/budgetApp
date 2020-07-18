<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="icon" href="../server/house.png"/>
    <script defer src="functions.js"></script>
    <title>Budzet domowy</title>
</head>

<body >
<nav class="navtop">


    <ul>
        <li><a href="index.php">Strona główna</a></li>
        <li><a href="login.php">Zaloguj się</a></li>
        <li><a href="registration.php">Rejestracja</a></li>
        <li><a href="FAQ">FAQ</a></li>
        <li><a href="">Kontakt</a></li>
    </ul>
</nav>

<div class="login">
    <h1>Logowanie</h1>
    <form action="authorization.php" method="post">
        <label for="username">
            <i class="fas fa-user"></i>
        </label>
        <input id="username" type="text" name="username" placeholder="Nazwa użytkownika" autocomplete="off" required>

        <br>
        <label>
            <i class="fas fa-lock"></i>
        </label>
        <input id="password" type="password" name="password" placeholder="Hasło" required >



        <button id="login_btn" type="submit" name="submit" value="Zaloguj się" > Zaloguj się

        </button>
        <code><p id="demo">
                <!--               Wprowadz dane-->
            </p></code>

    </form>
</div>
</body>
</html>
