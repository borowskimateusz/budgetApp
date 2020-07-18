<?php

//require_once 'insertData.php';
require_once 'dbbudget.php';

$id_user = $_SESSION['id'];
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {

    header('Location: index.html');
    exit;
}
if (isset($_GET['id_transaction'])) {
    $con->query("SET CHARSET utf8");
    $con->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
    $id_transaction = $_GET['id_transaction'];
    if ($_GET['id_transaction'] == $id_transaction) {

    }
}
function selectCategory($con)
{
    $sql = "select id_category, name,  type
        from category";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $id_category = $row['id_category'];
            $categoryName = $row['name'];
            echo "<option value=$id_category>$categoryName</option>";


        }
    }
}

function selectTransaction($con, $id_transaction, $id_user)
{

    $sql = "select t.id_transaction, t.id_category, t.money, t.date_transaction, c.name,
        (case
            when c.type = 0 then 'Wydatek'
            when c.type = 1 then 'Przychód'
            end
        ) as type
        from transactions as t join category as c on t.id_category=c.id_category and t.type=c.type
        
            where id_transaction = '$id_transaction' 
            and id_user = '$id_user';";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $id = 0;
echo "<br><br>";
        while ($row = $result->fetch_assoc()) {
            $id++;
            echo "<form class='form-group'>";
           echo "<ul >Dane:";
           echo "<li class='w-50'>Nr:<input class='form-control' value='$id'></li>";
           echo "<li>Nr tran.<input class='form-control' value='{$row["id_transaction"]}'></li>";
           echo "<li>Kategoria:<input class='form-control' value='{$row["id_category"]}'></li>";
           echo "<li>Kwota:<input class='form-control' value='{$row['money']}'></li>";
           echo "<li>Data:<input class='form-control' value='{$row['date_transaction']}'></li>";
           echo "<li>kategoria<input class='form-control' value='{$row['name']}'></li>";

            echo "</form>";

        }
        echo "<tbody>";
        echo "<table>";

    } else {
        echo "result fail";
    }
}

if (isset($_POST['edit'])) {
    if ($_POST['id_category']) {
        echo "<script> alert('essa')</script>";
    }
    if ($_POST['money']) {
        echo "<script> alert('bast')</script>";
    }
    if ($_POST['date_transaction']) {
        echo "<script> alert('siesta')</script>";
    }
}
?>
<!DOCTYPE html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="../css/style.css" rel="stylesheet" type="text/css">

    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.css'>


    <title>Transakcje</title>

</head>
<body class="bg-white">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<div class="grid_edit">

    <!--    NAVBAR-->
    <div class="navbar border fixed-top">
        <nav class="navbar  fixed-top navbar-expand-lg navbar-dark bg-dark">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="transactions.php">Transakcje</a></li>
                <li class="nav-item"><a class="nav-link" href="expense.php"></i>Wydatki</a></li>
                <li class="nav-item"><a class="nav-link" href="income.php"></i>Przychody</a></li>
                <li class="nav-item"><a class="nav-link" href="planner.php"></i>Kalendarz</a></li>
                <li class="nav-item"><a class="nav-link" href="../dbbudget.php"">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="contanct.php">Kontakt</a></li>
            </ul>
        </nav>

    </div>
    <div class="content m-1 ">
        <!--        ID, KATEGORIA, KWOTA, DATA TRANSAKCJI, PRZYCHOD/WYDATEK-->
        <? selectTransaction($con, $id_transaction, $id_user) ?>

        <form action="" method="post">
            <div>
                <label for="category">Kategoria:</label>
                <select name="id_category">
                    <? selectCategory($con) ?>
                </select>
            </div>
            <div>
                <label for="money">Kwota:</label>
                <input type="text" name="money">
            </div>
            <div>
                <label for="date_transaction">Data transakcji:</label>
                <input type="text" name="date_transaction">
                <input type="submit" name="edit">
            </div>
        </form>

    </div>


</div>

</body>
</html>

