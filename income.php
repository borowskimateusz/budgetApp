<?php
require_once 'dbbudget.php';
require_once 'charts/chart.php';
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
                <? select_year($con,1) ?>

            </select>

            <select class="custom-select" onchange="if (this.value) window.location.href=this.value">
                <option>Wybierz Miesiac</option>
                <? select_month($con,1) ?>

            </select>
        </form>

        <small class="font-weight-bolder">
            <?
            if (isset($_GET['year'])) {
                $year = $_GET['year'];
                if(isset($_GET['month'])){
                    $month = $_GET['month'];
                    if ($_GET['month'] == $month) {
                        if ($month == 'styczen') $month = 1;
                        if ($month == 'luty') $month = 2;
                        if ($month == 'marzec') $month = 3;
                        if ($month == 'kwiecien') $month = 4;
                        if ($month == 'maj') $month = 5;
                        if ($month == 'czerwiec') $month = 6;
                        if ($month == 'lipiec') $month = 7;
                        if ($month == 'sierpien') $month = 8;
                        if ($month == 'wrzesien') $month = 9;
                        if ($month == 'pazdziernik') $month = 10;
                        if ($month == 'listopad') $month = 11;
                        if ($month == 'grudzien') $month = 12;
                        echo $_GET['month'] . " " . $year;
                    }
                }else {
                    echo $year;
                }
            }
            ?>
        </small>
        <? selectCategory($con,1); ?>

        </form>
        <h4><? select_saldo($con, 1); ?></h4>

    </div>
    <div class="content  ">
        <? sql_transactions($con, 1) ?>
    </div>
    <div class="details ">
        <? select_in_out_summary($con,1)?>
        <div id="donutchart" style="width: 500px;height: 50%;" ></div>


    </div>
</div>


</body>
</html>
