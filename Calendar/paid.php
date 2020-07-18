<?php

session_start();
require_once 'sql_transactions.php';


if (!isset($_SESSION['loggedin'])) {

    header('Location:index');
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'www1595_orcio';
$DATABASE_PASS = 'LDzBDurQVn';
$DATABASE_NAME = 'www1595_dbbudget';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());

}

function sql($con, $form)
{
    $con->query("SET CHARSET utf8");
    $con->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
    $sql = "select DISTINCT c.name as category, td.comment, td.date_transaction, td.money 
                from todolist as td 
                    join category as c on c.id_category=td.id_category
                    where  id_user = '" . $_SESSION['id'] . "'  and form = '" . $form . " '
        ";
    if (isset($_GET['month'])) {
        if ($_GET['month'] == 'styczen') {

            $sql .= 'and month(date_transaction) =  1 or month(date_transaction) = "styczen"  ';
        }
        if ($_GET['month'] == 'luty') {
            $sql .= 'and month(date_transaction) = 2   or month(date_transaction) = "luty" ';
        }
        if ($_GET['month'] == 'marzec') {
            $sql .= 'and month(date_transaction) = 3 or month(date_transaction) = "marzec" ';
        }
        if ($_GET['month'] == 'kwiecien') {
            $sql .= 'and month(date_transaction) =4  or month(date_transaction) = "kwiecien"';
        }
        if ($_GET['month'] == 'maj') {
            $sql .= 'and month(date_transaction) = 5 or month(date_transaction) = "maj" ';
        }
        if ($_GET['month'] == 'czerwiec') {
            $sql .= 'and month(date_transaction) =  6  or month(date_transaction) = "czerwiec" ';
        }
        if ($_GET['month'] == 'lipiec') {
            $sql .= 'and month(date_transaction) =  7  or month(date_transaction) = "lipiec" ';
        }
        if ($_GET['month'] == 'sierpien') {
            $sql .= 'and month(date_transaction) = 8  or month(date_transaction) = "sierpien" ';
        }
        if ($_GET['month'] == 'wrzesien') {
            $sql .= 'and month(date_transaction) =  9  or month(date_transaction) = "wrzesien" ';
        }
        if ($_GET['month'] == 'pazdziernik') {
            $sql .= 'and month(date_transaction) = 10 or month(date_transaction) = "pazdziernik" ';
        }
        if ($_GET['month'] == 'listopad') {
            $sql .= 'and month(date_transaction) = 11  or month(date_transaction) = "listopad" ';
        }
        if ($_GET['month'] == 'grudzien') {
            $sql .= 'and month(date_transaction) = 12  or month(date_transaction) = "grudzzien" ';
        }
    } else {
        $sql .= "and month(curdate()) and year(curdate())";
    }

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='trans' style='width:auto;'>";
        echo "<tr class='trans'>";
        echo "<th>Kategoria                      
                  </th>";
        echo "<th>Co                    
                  </th>";

        echo "<th>Data                       
                  </th>";
        echo "<th>Kwota                    
                  </th>";
        echo "<th>Opcje                    
                  </th>";

        while ($row = $result->fetch_assoc()) {

            echo "<form action='' method='post' role='form'>";

            echo "<tr >";
            echo "<td >" . $row["category"] . "</td>" . "";
            echo "<td >" . $row["comment"] . "</td>";
            echo "<td >" . $row["date_transaction"] . "</td>" . "";
            echo "<td>" . $row["money"] . "</td>";
            echo "<td>" . "Edit/Delete" . "</td>";


            echo "</tr>";
            echo "</form>";
        }
        echo "</table>";
    } else {
        echo "brak danych :(";
    }
}

function year($con) {
    $sql = "select distinct year(date_transaction) as year, 
                   
                   ( case
                     when  month(date_transaction) = 1 then 'styczen'
                     when month(date_transaction) = 2 then 'luty'
                     when month(date_transaction) = 3 then 'marzec'
                     when month(date_transaction) = 4 then 'kwiecien'
                     when month(date_transaction) = 5 then 'maj'
                     when month(date_transaction) = 6 then 'czerwiec'
                     when month(date_transaction) = 7 then 'lipiec'
                     when month(date_transaction) = 8 then 'sierpien'
                     when month(date_transaction) = 9 then 'wrzesien'
                     when month(date_transaction) = 10 then 'pazdziernik'
                     when month(date_transaction) = 11 then 'listopad'
                     when month(date_transaction) = 12 then 'grudzien'
                     else null
                     end
                     
                       )
                     as month
                     
                     from transactions where id_user = '".$_SESSION['id']."' order by date_transaction";
    $result = $con->query($sql);

    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            for($i = 1 ;$i <2;$i++) {
                echo "<ul><a  href='transactions.php?year={$row['year']}'>
                        {$row['year']} </a>";


                echo "<li><a  href='transactions.php?month={$row['month']}&year={$row['year']}'>
                        {$row['month']} </a></li><br>";

                echo "<ul>";
            }
        }


    }

}

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8" >
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">

<div class="grid_container_planner">
    <div id="navbar">
        <nav class="navtop">


            <ul>
                <li><a href="transactions.php">Transakcje</a></li>
                <li><a href="expense.php"></i>Wydatki</a></li>
                <li><a href="income.php"></i>Przychody</a></li>
                <li><a href="planner.php"></i>Kalendarz</a></li>
                <li><a href="info.php"">FAQ</a></li>
                <li><a href="contanct.php">Kontakt</a></li>
            </ul>
        </nav>
    </div>
    <div id="left_menu">
        <?=year($con)?>
        <ul>Menu

            <li><a href="to_pay.php">Do zapłaty</a></li>
            <li><a href="">Opłacone</a></li>
            <li><a href="standing_orders.php">Zlecenia stałe</a></li>
        </ul>
    </div>
    <div id="to_pay">


        <h1 >Opłacone</h1>
        <?sql($con,1)?>
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

