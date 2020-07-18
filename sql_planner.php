<?php
require_once 'dbbudget.php';
function select_planner($con){
    $sql = "select id_task, id_user, id_category, money, date_transaction, type, comment, form
      from todolist where id_user='".$_SESSION['id']."'";

    $result=$con->query($sql);

    if($result->num_rows>0){
        echo "<table class='table'>";
        echo "<thead class='thead-dark'>";
        echo "<tr>";
        echo "<th>#</th>";
        echo "<th>user</th>";
        echo "<th>category</th>";
        echo "<th>money</th>";
        echo "<th>date</th>";
        echo "<th>type</th>";
        echo "<th>comment</th>";
        echo "<th>form</th>";
        echo "</tr>";
        echo "</thead>";

        while($row=$result->fetch_assoc()){
            echo "<td>".$row['id_task']."</td>";
            echo "<td>".$row['id_user']."</td>";
            echo "<td>".$row['id_category']."</td>";
            echo "<td>".$row['money']."</td>";
            echo "<td>".$row['date_transaction']."</td>";
            echo "<td>".$row['type']."</td>";
            echo "<td>".$row['comment']."</td>";
            echo "<td>".$row['form']."</td>";
        }
        echo "</table>";
    }else {
        echo "<script>alert('Hello world')</script>";
    }
}
?>