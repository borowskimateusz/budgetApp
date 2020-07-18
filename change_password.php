<?php
require_once 'dbbudget.php';
require_once 'newPassword.php';

?>
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

        <h1>Zmiana hasła</h1>
        <form autocomplete="off" action="newPassword.php" method="post"  >
            <div class="form-group row-100">
                <label for="password">Obecne hasło:</label>
                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                <input class="form-control" id="oldPassword" name="password" oninput="submitPassword()" type="password"  >
                <small id="subs" style="display:none;">Błędne hasło.</small>
            </div>
            <div class="form-group row-100">
                <label for="newPassword">Nowe hasło:</label>
                <input autocomplete="new-password" class="form-control" type="password" oninput="checkPassword()" name="newPassword" id="newPassword" >
                <small id="length" style="display:none;">Hasło musi zawierać przynajmniej 8 znaków.</small>
                <small id="numbers" style="display:none;">Hasło musi zawierać przynajmniej 1 cyfrę.</small>
            </div>
            <div class="form-group row-100">
                <label for="newPassword">Powtórz hasło:</label>
                <input class="form-control" type="password" oninput="checkPassword2()" name="checkNewPassword"
                       id="checkNewPassword">
                <small id="different" style="display:none;">Hasła różnią się od siebie.</small>
            </div>
            <div class="form-group row-100" >

                <input  class="btn btn-primary" type="submit"  >
            </div>
        </form> <?echo $row['password']?>
        <script type="text/javascript">

            function checkPassword() {

                var x = document.getElementById("newPassword");

                if (x.value.length < 8) {
                    document.getElementById('length').style.display = 'block';
                    document.getElementById('length').className = 'text-monospace';
                } else {
                    document.getElementById('length').style.display = 'none';
                }
                if (x.value.match(/\d+/g)) {
                    document.getElementById('numbers').style.display = 'none';
                } else {
                    document.getElementById('numbers').className = 'text-monospace';
                    document.getElementById('numbers').style.display = 'block';
                }
            }

            function checkPassword2() {
                var x = document.getElementById("newPassword");
                var y = document.getElementById("checkNewPassword");


                if (x.value != y.value) {
                    document.getElementById('different').style.display = 'block';
                    document.getElementById('different').className = 'text-monospace';
                } else {
                    document.getElementById('different').style.display = 'none';
                }
            }

        </script>
    </div>

</div>
</body>
</html>

