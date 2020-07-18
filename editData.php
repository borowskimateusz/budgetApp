<?php
require_once 'dbbudget.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
if (isset($_POST['submit'])) {
    editData($con);
}
function selectTransaction($con)
{
    $id_transaction = $_GET['id_transaction'];
    $sql = "select t.id_transaction, t.id_category, t.money, t.date_transaction, c.name,comment,
        (case
            when c.type = 0 then 'Wydatek'
            when c.type = 1 then 'Przychód'
            end
        ) as type
        from transactions as t join category as c on t.id_category=c.id_category and t.type=c.type
        
            where id_transaction = '$id_transaction' 
            and id_user = '" . $_SESSION['id'] . "';";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<form action='' method='post' class='form-group '>";
            echo "<ul >Edycja transakcji:";
            echo "<li>Nr tran.<input class='form-control' value={$row['id_transaction']}></li>";
            echo "<li>Kwota:<input id='money' name='money' class='form-control' value={$row['money']}></li>";
            echo "<li>Data:<input id='date_transaction' name='date_transaction' class='form-control' value={$row['date_transaction']}></li>";
            echo "<li>kategoria<input class='form-control' value={$row['name']} disabled></li>";
            echo "<li>kategoria<input class='form-control' value={$row['id_category']} disabled></li>";
            echo "<li><a href='transactions.php'><input class='btn btn-primary' name='submit' type='submit' value='Potwierdź'></a></li>";

            echo "</form>";
        }
    }
}


function editData($con)
{
    if (isset($_POST['money']) && ($_POST['date_transaction'])) {
        $sqlUpdate = "update transactions set money=  '" . $_POST['money'] . "',
                                  date_transaction = '" . $_POST['date_transaction'] . "' 
                                  where id_transaction = '" . str_replace('?', '', $_GET['id_transaction']) . "' and
                                  id_user = '" . $_SESSION['id'] . "'";
        $result = $con->query($sqlUpdate);
        if ($con->query($sqlUpdate)) {
            header("refresh:2;url=transactions.php");
            echo $sqlUpdate;
            echo $_GET['id_transaction'];
        }


    } else {
        echo 'null';
    }
}


?>