<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="icon" href="server/house.png"/>

    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.css'>


    <script defer src="functions.js"></script>
    <title>Budzet domowy</title>
</head>

<body class="bg-white">

<div class="grid_reg_log">
    <div class="navbar">
        <nav class="navbar  fixed-top navbar-expand-lg navbar-dark bg-dark">

            <ul class="navbar-nav mr-auto">
                <!--        Top toolbar-->
                <li class="nav-item"><a class="nav-link" href="about.php">O programie</a></li>
                <li class="nav-item"><a class="nav-link" href="sql_transactions.php"></i>Funkcje</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php"></i>Kontakt</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php"></i>Log in</a></li>
            </ul>
        </nav>

    </div>
    <div class="form">

        <h1>Rejestracja</h1>
        <button type="button" onclick="danger()">Try it</button>
        <form action="register.php" method="post" class="form-col">
            <p id="danger">TEKST</p>
            <div class="form-group row">
                <label  for="username">Nazwa użytkownika:</label>
                <input class="form-control" type="text" name="username" placeholder="Username" id="username"  required>
            </div>
            <div class="form-group row">
                <label  for="email">Email:</label>
                <input class="form-control" type="email" name="email" placeholder="Email" id="email" required>
            </div>

            <div class="form-group row">
                <label  for="password">Hasło:</label>
                <input class="form-control" type="password" name="password" placeholder="Password" id="password" required>
            </div>
            <div  class="form-group row">
                <label  for="password">Powtórz hasło:</label>
                <input  class="form-control" type="password" name="password" placeholder="Password" id="password" required>
            </div>
            <div class="form-group row">
                <input class="btn btn-secondary" type="submit" value="Zarejestruj się">
            </div>

        </form>
    </div>
</div>



</body>
</html>
