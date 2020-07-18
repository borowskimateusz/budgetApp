<?php

require_once 'functions.php';
require_once 'dbbudget.php';

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

$con->query("SET CHARSET utf8");
$con->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");


$expense = "select date_transaction, sum(money) as money, name from transactions as t 
join category as c on c.id_category=t.id_category where t.type=1 and id_user = '".$_SESSION['id']."' group by name ;";
$expenseResult = $con->query($expense);
$income = "select date_transaction, sum(money)*(-1) as money, name from transactions as t 
join category as c on c.id_category=t.id_category where t.type=0 and id_user = '".$_SESSION['id']."' group by name ;";
$incomeResult = $con->query($income);


?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="icon" href="server/house.png"/>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script defer src="functions.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">


        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(IncomeChart);
        google.charts.setOnLoadCallback(ExpenseChart);
        function IncomeChart() {

            var data = google.visualization.arrayToDataTable([
                ['name','money'],
                <?php

                while($row=$expenseResult->fetch_assoc()) {
                    echo "['".$row['name']."',".$row['money']."],";
                }
                ?>
            ]);

            var options = {

                backgroundColor:'#efedec',
                fontSize:16,
                title: 'Przychody',

            };

            var chart = new google.visualization.PieChart(document.getElementById('iChart'));
            chart.draw(data, options);


        }
        function ExpenseChart() {

            var data = google.visualization.arrayToDataTable([
                ['name','money'],
                <?php

                while($row=$incomeResult->fetch_assoc()) {
                    echo "['".$row['name']."',".$row['money']."],";
                }
                ;
                ?>
            ]);

            var options = {
                backgroundColor:'#C0c0c0',

                fontSize:16,
                title: 'Wydatki',

            };

            var chart = new google.visualization.PieChart(document.getElementById('eChart'));
            chart.draw(data, options);

        }

    </script>
</head>
<body class="loggedin">
<div class="grid_container">
    <div class="navbar">
<nav class="navtop">


    <ul>
        <li><a href="transactions.php">Transakcje</a></li>
        <li><a href="expense.php"></i>Wydatki</a></li>
        <li><a href="income.php"></i>Przychody</a></li>
        <li><a href="planner.php"></i>Kalendarz</a></li>
        <li><a href="calendar.php"></i>Calendar</a></li>
        <li><a href="dbbudget.php"">FAQ</a></li>
        <li><a href="contanct.php">Kontakt</a></li>
    </ul>
</nav>
    </div>





<div class="left_menu">

    <ul>
        <li><?year($con,'expense',0,'');?></li>
    </ul>


</div>

    <div class="table">
        <h1 style="text-align: left;">Wydatki</h1>
    <table>

        <tr><?tab_sql($con, 0)?></tr>


    </table>
    </div>




</div>

</div>
</body>
</html>


