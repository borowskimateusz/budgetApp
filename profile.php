<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
require_once 'dbbudget.php';
require_once 'profile_info.php';
function search($con) {
    $sql = "select t.id_transaction, c.id_category, money , c.name as category
            from transactions as t join category as c on t.id_category=c.id_category
             where id_user = '" . $_SESSION['id']. "'";

    if(isset($_GET['search'])){
        if($_GET['search']){
            $sql.=" and (c.name like '%" . $_GET['search'] . "%' or comment like '%".$_GET['search']."%')";
        }
    }
    $result=$con->query($sql);

    if($result->num_rows>0){

        echo "<table class='table' ' >";
        echo "<thead class='thead-dark' >";
        echo "<form method='get'>";
        echo "<tr >";
        echo "<th  scope='col'  >#</th>";
        echo "<th  scope='col'  >id_category</th>";
        echo "<th  scope='col'  >category</th>";
        echo "<th  scope='col'  >money</th>";

        echo "</tr>";
        echo "</form>";
        echo "</thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()){
            echo "<tr class='table'>";
            echo "<td class='col-md'>".$row['id_transaction']."</td>";
            echo "<td class='col-md'>".$row['id_category']."</td>";
            echo "<td class='col-md'>".$row['category']."</td>";
            echo "<td class='col-md'>".$row['money']."</td>";
            echo "</tr><br>";

        }
    }
}


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

            <h1>Informacje</h1>
            <button class="btn btn-primary" title="Bootstrap tooltip"
                    data-toggle="tooltip">
                Button
            </button>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                });
            </script>
            <?profile_info($con)?>
        </div>

</div>
</body>
</html>
