<?php
require_once 'dbbudget.php';
require_once 'summary.php';
require_once 'sql_expense.php'; ?>
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

<div class="grid_container_expense">
    <div class="navbar">
        <nav class="navbar  fixed-top navbar-expand-lg navbar-dark bg-dark">

            <ul class="navbar-nav mr-auto">
                <!--        Top toolbar-->
                <li class="nav-item"><a class="nav-link" href="transactions.php">Transakcje</a></li>
                <li class="nav-item "><a class="nav-link text-danger " title="do poprawy" href="expense.php"></i>
                        Wydatki</a></li>
                <li class="nav-item"><a class="nav-link text-danger" title="do poprawy" href="income.php"></i>
                        Przychody</a></li>
                <li class="nav-item"><a class="nav-link text-danger" title="do poprawy" href="planner.php"></i>
                        Kalendarz</a></li>
                <li class="nav-item"><a class="nav-link text-danger" title="do zrobienia FAQ"
                                        href="../dbbudget.php">FAQ</a></li>
                <li class="nav-item"><a class="nav-link text-danger" title="do zrobienia " href="profile.php">Moje
                        konto</a></li>
                <li class="nav-item"><a class="nav-link text-danger" title="do zrobienia " href="profile.php"><i
                                class="fa fa-long-arrow-alt-left"></i>Wyloguj</a></li>
                <li class="nav-item"><a class="nav-link" href=""
                                        title="Dostępne środki">Saldo:</a></li>
            </ul>
        </nav>

    </div>
    <div class="left_menu mt-5 border position-fixed">
        <h5 class="mt-1">Wybierz datę</h5>

        <form class='form ' method="get">
            <select class="custom-select" onchange="if (this.value) window.location.href=this.value">
                <option>Wybierz rok</option>
                <? select_year($con,0) ?>

            </select>

            <select class="custom-select" onchange="if (this.value) window.location.href=this.value">
                <option>Wybierz Miesiac</option>
                <? select_month($con,0) ?>

            </select>
        </form>

        <small class="font-weight-bolder">
            <?
            if (isset($_GET['year'])) {
                if (isset($_GET['month'])) {
                    echo $_GET['month'] . " " . $_GET['year'];
                } else {
                    echo $_GET['year'];
                }
            }
            ?>
        </small>
        <? selectCategory($con,0); ?>

        </form>
        <h4><? select_saldo($con, 0); ?></h4>

    </div>


</div>


</body>
</html>
