<?php
require_once 'sql_transactions.php';
require_once 'sql_planner.php';
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
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">
<div class="grid_container_planner">
<div class="navbar fixed-top">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">

        <ul class="navbar-nav mr-auto">
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
                                    title="Dostępne środki">Saldo:<? select_summary($con) ?></a></li>
        </ul>
    </nav>

</div>

<div class="left_menu mt-5 border position-fixed">

    <h5 class="mt-1">Wybierz datę</h5>

    <form class='form ' method="get">
        <select class="custom-select" onchange="if (this.value) window.location.href=this.value">
            <option>Wybierz rok</option>
            <? select_year($con); ?>
        </select>
        <? $disabled = '';
        if (!isset($_GET['year'])) {
            $disabled = 'title ="Wybierz rok" disabled';
        }
        ?>
        <select class="custom-select"
                onchange="if (this.value) window.location.href=this.value" <? echo $disabled ?>>
            <option>Wybierz Miesiac</option>
            <? select_month($con); ?>
        </select>
    </form>
    <form action="" method="get">
        <label for="date_transaction">OD:</label>
        <input class='custom-select w-75' type="date" id="date_transaction" value="<? echo date('Y-m-d') ?>"
               name="from">
        <label for="date_transaction">DO:</label>
        <input class='custom-select  w-75' type="date" id="date_transaction" value="<? echo date('Y-m-d') ?>"
               name="to">
        <input class='btn btn-primary' type="submit">
    </form>
    <small class="font-weight-bolder">
        <?
        if (isset($_GET['to'])) {
            if (isset($_GET['from'])) {
                if ($_GET['from'] == $_GET['to']) {
                    echo $_GET['to'];
                } else {
                    echo $_GET['from'] . " <i class='fas fa-arrows-alt-h'></i> " . $_GET['to'];
                }
            }
        }
        if (isset($_GET['year'])) {
            if (isset($_GET['month'])) {
                echo $_GET['month'] . " " . $_GET['year'];
            } else {
                echo $_GET['year'];
            }
        }
        ?>
    </small>
    <? selectCategory($con, implode("','", array(0, 1))) ?>
    <? select_type() ?>
    </form>
    <h4><?select_saldo($con,implode("','", array(0, 1)));?></h4>

</div>
    <div class="preMonth mt-5">

        <?select_planner($con)?>
        
    </div>
</div>
</body>
</html>


