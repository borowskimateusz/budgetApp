<?php
require_once 'sql_transactions.php';
require_once 'dbbudget.php';

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}



?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8" >
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">

<div class="grid_container_planner">
    <div class="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

            <ul class="navbar-nav mr-auto">
                <!--        Top toolbar-->
                <li class="nav-item"><a class="nav-link" href="transactions.php">Transakcje</a></li>
                <li class="nav-item"><a class="nav-link" href="expense.php"></i>Wydatki</a></li>
                <li class="nav-item"><a class="nav-link" href="income.php"></i>Przychody</a></li>
                <li class="nav-item"><a class="nav-link" href="planner.php"></i>Kalendarz</a></li>
                <li class="nav-item"><a class="nav-link" href="../dbbudget.php"">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="contanct.php">Kontakt</a></li>
            </ul>
        </nav>

    </div>
    <div id="left_menu">
        <ul>Menu
            <li>he</li>
            <li>he</li>


        </ul>

    </div>
    <p>dupa</p>
    <div id="to_pay">



        <h1 >Do zapłaty</h1>

        <h1>Dodaj</h1>
        <div >

            <form action="sql_transactions.php" method="post">
                Kategoria: <select name="category" id="category">
                    <option value="3">Spożywcze</option>
                    <option value="4">Dzieci i edukacja</option>
                    <option value="5">Rozrywka</option>
                    <option value="6">Dom i ogród</option>
                    <option value="7">Rachunki i media</option>
                    <option value="8">Samochód</option>
                    <option value="9">Zdrowie</option>
                    <option value="10">Prezent</option>
                    <option value="11">Kredyt</option>
                </select>
                Data: <input type="date" id="date_transaction" name="date_transaction"><br>
                Comment: <input type="text" id="comment" name="comment"><br>
                Kwota: <input type="number" id="money" name="money"><br>
                Forma: <select>
                    <option value="0">Do zapłaty</option>
                    <option value="1">Zapłacone</option>
                    <option value="2">Zlecenia stałe</option></select>
                <button type="submit" name="planner" id="planner" value="Potwierdz" ">
                Potwierdz
                </button>

            </form>

        </div>
        <div id="paid"">
        <h1>Opłacone</h1>

        <h1>Dodaj</h1>
        <form>
            <label for="Kwota">Kwota:</label><br>
            <input type="text" id="kwota" name="Kwota"><br>
            <label for="Kategoria">Kategoria:</label><br>
            <input type="text" id="kateogira" name="kategorai">
        </form>
    </div>
    <div id="standing_orders">
        <h1>Zlecenia stałe</h1>

        <h1>Dodaj</h1>
        <form>
            <label for="Kwota">Kwota:</label><br>
            <input type="text" id="kwota" name="Kwota"><br>
            <label for="Kategoria">Kategoria:</label><br>
            <input type="text" id="kateogira" name="kategorai">
        </form>

    </div>


</div>

</div>
</div>
</body>
</html>


