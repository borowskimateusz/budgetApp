<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link href="../css/style.css" type="text/css" rel="stylesheet" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <script defer src="../functions.js"></script>
</head>

<body class="loggedin">

<nav class="navtop">


    <ul>
        <li><a href="../index.php">Strona główna</a></li>
        <li><a href="login.php">Zaloguj się</a></li>
        <li><a href="registration.php">Rejestracja</a></li>
        <li><a href="FAQ">FAQ</a></li>
        <li><a href="">Kontakt</a></li>
    </ul>
</nav>

<div class="register">
    <h1>Rejestracja</h1>
    <form action="register.php" method="post" autocomplete="off">


        <label for="username">
            <i class="fas fa-user"></i>
        </label>

        <input type="text" name="username" placeholder="Nazwa użytkownika" id="username" required>
<br>

        <label for="password">
            <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="password" placeholder="Hasło" id="password" required>
        <br>
        <label for="email">
            <i class="fas fa-envelope"></i>
        </label>
        <input type="email" name="email" placeholder="Email" id="email" required>
        <br>
        <div id ='userr' style=" display:none; width: 100px;height: 100px;background-color: #333;">
            <span id="add"></span>
        </div>

        <button id="login_btn" type="submit" name="submit" value="Zaloguj się" >Zarejestruj się




    </form>

</div>


</body>
</html>