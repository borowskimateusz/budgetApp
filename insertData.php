<?php
require_once 'dbbudget.php';

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}


function inputCategory($con) {
    $sql = "select id_category,type, name from category";
$result=$con->query($sql);
if($result->num_rows>0){

    while($row=$result->fetch_assoc()){
        if($row['type'] ==1)$color= 'class="text-success"';
        if($row['type'] ==0)$color= 'class="text-danger"';
        $id_category = $row['id_category'];
        $categoryName= $row['name'];

        echo "<option {$color} value=$id_category>$categoryName</option>";
    }
}

}

$money = $_POST['money'];
$date_transaction = $_POST['date_transaction'];
$id_category = $_POST['id_category'];
$comment= $_POST['comment'];
$comment = "";

    if(isset($_POST['money'],$_POST['date_transaction'],$_POST['id_category'])) {

        if ($_POST['type'] == 0) {
            $money *= (-1);
        }

        $sql = "insert into 
            transactions ( `id_user`, 
            `money`, 
            `date_transaction`, 
             `type`,
            `id_category`, 
            `comment` )
        values ('" . $_SESSION["id"] . "',
         '$money',
          '$date_transaction',
          (select `type` from category where `id_category` = '$id_category') ,
          '$id_category',
          '$comment');";
        $sqlUpdate = "UPDATE saldo 
                        SET saldo=saldo + {$money}
                        WHERE id_user='" . $_SESSION["id"] . "'";
        echo $sql . "<br>";
            if ($con->query($sql)) {
                echo $sql . "<br>";
                echo $type . "<br>";
                echo $id_category . "<br>";
                if($con->query($sqlUpdate));
                if($_POST['standing_orders']){

                    $sqlToDo = "insert into todolist 
                                (id_category, 
                                        money, 
                                        date_transaction, 
                                        type,
                                     comment, 
                                        form, 
                                    id_user) 
                                    values ('$id_category',
                                    '$money',
                                    '$date_transaction',
                                    (select `type` from category where `id_category` = '$id_category') ,
                                    '$comment',
                                    '".$_SESSION['id']."')";
                    echo $sqlToDo;

                }
                echo "Success";

                header('refresh:5;url=transactions.php');
            } else {

                echo "Failure";
                header('refresh:5;url=transactions.php');
            }
    }


?>