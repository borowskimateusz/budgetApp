<?php
//$user = $_SESSION['name'];
//$con->query("SET CHARSET utf8");
//$con->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

//$expense = "select date_transaction, sum(money) as money, name from transactions as t
//join category as c on c.id_category=t.id_category where t.type=1 and id_user = '".$_SESSION['id']."' group by name ;";
//$expenseResult = $con->query($expense);
//$income = "select date_transaction, sum(money)*(-1) as money, name from transactions as t
//join category as c on c.id_category=t.id_category where t.type=0 and id_user = '".$_SESSION['id']."' group by name ;";
//$incomeResult = $con->query($income);


function total($con)
{
    $total = "select format(sum(money),2) as money from transactions where id_user = '" . $_SESSION['id'] . "'";
    $totalresult = $con->query($total);
    if ($totalresult->num_rows > 0 ) {
        while ($row = $totalresult->fetch_assoc()) {
            echo $row['money'] . "$";

        }

        }
    }

function total_expense($con)
{
    $total = "select format(sum(money),2) as money from transactions where type ='0' and id_user = '" . $_SESSION['id'] . "'";
    $totalresult = $con->query($total);
    if ($totalresult->num_rows > 0 ) {
        while ($row = $totalresult->fetch_assoc()) {
            echo $row['money'] . "$";

        }

    }
}

function total_income($con)
{
    $total = "select format(sum(money),2) as money from transactions where type ='1' and id_user = '" . $_SESSION['id'] . "'";
    $totalresult = $con->query($total);
    if ($totalresult->num_rows > 0 ) {
        while ($row = $totalresult->fetch_assoc()) {
            echo $row['money'] . "$";

        }

    }
}



function amount($con)
{
    $all = "select count(id_transaction) as id_transaction from transactions where id_user = '" . $_SESSION['id'] . "'";
    $allresult = $con->query($all);
    if ($allresult->num_rows > 0 ) {
        while ($row = $allresult->fetch_assoc()) {
            echo $row['id_transaction'];

        }

    }

}

function category($con)
{
    if ($_POST['category']) {
        $sql = 'select name from category where id_category = "' . $_POST['category'] . '"';
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        echo $row['name'];


    }
}
function to_do($con)
{
    $total = "select format(sum(money),2) as money from tasks where done ='0' and id_user = '" . $_SESSION['id'] . "'";
    $totalresult = $con->query($total);
    if ($totalresult->num_rows > 0 ) {
        while ($row = $totalresult->fetch_assoc()) {
            echo $row['money'] . "$";

        }

    }
}


function done($con)
{
    $total = "select format(sum(money),2) as Kwota from tasks where done ='1' and id_user = '" . $_SESSION['id'] . "'";
    $totalresult = $con->query($total);
    if ($totalresult->num_rows > 0 ) {
        while ($row = $totalresult->fetch_assoc()) {
            echo $row['money'] . "$";

        }

    }
}

function select_done($con)
{
    $total = "select  task, money, date from todolist where done ='1' and id_user = '" . $_SESSION['id'] . "'";
    $totalresult = $con->query($total);
    if ($totalresult->num_rows > 0 ) {
        echo "<table>";
        echo "<tr>";
        echo "<td>Cel zapłaty";
        echo "</td>";
        echo "<td>Kwota";
        echo "</td>";
        echo "<td>Data";
        echo "</td>";
        echo "</tr>";
        while ($row = $totalresult->fetch_assoc()) {

            echo "<tr class ='transaction' >";

            echo "<td>" . $row["task"] . "</td>" . "";
            echo "<td>" . $row["money"] . "</td>" . "";
            echo "<td style='width: 120px;'>" . $row["date"] . "</td>" . "";
            echo "<td><input  type='button' value='X'/> </td>";

            echo "</tr>";


        }
        echo "</table>";


    }
}


function select_to_do($con)
{
    $total = "select  task, money, date from todolist where done ='0' and id_user = '" . $_SESSION['id'] . "'";
    $totalresult = $con->query($total);
    if ($totalresult->num_rows > 0 ) {
        echo "<table>";
        echo "<tr>";
        echo "<td>Cel zapłaty";
        echo "</td>";
        echo "<td>Kwota";
        echo "</td>";
        echo "<td>Data";
        echo "</td>";
        echo "</tr>";
        while ($row = $totalresult->fetch_assoc()) {

            echo "<tr class ='transaction' >";

            echo "<td>" . $row["task"] . "</td>" . "";
            echo "<td>" . $row["money"] . "</td>" . "";
            echo "<td style='width: 120px;'>" . $row["date"] . "</td>" . "";
            echo "<td><input  type='button' value='X'/> </td>";

            echo "</tr>";


        }
        echo "</table>";


    }
}

function notifications($con)
{

    $sql = "select  * from todolist where done ='0' and id_user = '" . $_SESSION['id'] . "'";
    $result = $con->query($sql);
    echo $result->num_rows;
echo '0';



}

function delete($con) {


if (isset($_POST['delete'])) {
        $con->query("delete from transaction where id_transaction = 279") or die($con->error());

}
}

function month($con,$form) {
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

        from todolist where form = $form and id_user = '".$_SESSION['id']."' order by year(date_transaction) ";
    $result = $con->query($sql);

    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            for($i = 1 ;$i <2;$i++) {
                echo "<ul><a  href='paid.php?year={$row['year']}'>
            {$row['year']} </a>";


                echo "<li><a  href='paid.php?month={$row['month']}&year={$row['year']}'>
                {$row['month']} </a></li><br>";

                echo "<ul>";
            }
        }


    }

}

function yeard($con, $link) {
    $sql = "select distinct year(date_transaction) as year                  
                   
                     from transactions 
                         where id_user = '".$_SESSION['id']."'  order by date_transaction";
    $result = $con->query($sql);

    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            echo "<ul><a  href='{$link}.php?year={$row['year']}'>
                        {$row['year']} </a>";

            echo "<ul>";

        }


    }

}


function year($con,$link, $type, $type2) {
    $sql = "select distinct year(date_transaction) as year,
                   
                   ( case
                     when month(date_transaction) = 1 then 'styczen'
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
                     
                     from transactions 
                         where id_user = '".$_SESSION['id']."' and type in ('".$type."','".$type2."')  order by date_transaction";
    $result = $con->query($sql);

    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

                echo "<ul><a  href='{$link}.php?year={$row['year']}'>
                        {$row['year']} </a>";


                echo "<li><a  href='{$link}.php?month={$row['month']}&year={$row['year']}'>
                        {$row['month']} </a></li><br>";

                echo "<ul>";

        }


    }

}


function tab_sql($con,$type)
{
    $con->query("SET CHARSET utf8");
    $con->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");


    $sql = 'select   money, date_transaction, id_transaction, 
        c.name as category, comment 

        from transactions as t 
            
            
        join category as c on c.id_category=t.id_category where t.type = '.$type.' and  id_user = "' . $_SESSION['id'] . '"  ';

    if(isset($_GET['month'])) {
        if($_GET['month'] == 'styczen')
        {

            $sql.= 'and month(date_transaction) =  1 or month(date_transaction) = "styczen"  ';
        }
        if($_GET['month'] == 'luty')
        {
            $sql.= 'and month(date_transaction) = 2   or month(date_transaction) = "luty" ';
        }
        if($_GET['month'] == 'marzec')
        {
            $sql.= 'and month(date_transaction) = 3 or month(date_transaction) = "marzec" ';
        }
        if($_GET['month'] == 'kwiecien')
        {
            $sql.= 'and month(date_transaction) =4  or month(date_transaction) = "kwiecien"';
        }
        if($_GET['month'] == 'maj')
        {
            $sql.= 'and month(date_transaction) = 5 or month(date_transaction) = "maj" ';
        }
        if($_GET['month'] == 'czerwiec')
        {
            $sql.= 'and month(date_transaction) =  6  or month(date_transaction) = "czerwiec" ';
        }
        if($_GET['month'] == 'lipiec')
        {
            $sql.= 'and month(date_transaction) =  7  or month(date_transaction) = "lipiec" ';
        }
        if($_GET['month'] == 'sierpien')
        {
            $sql.= 'and month(date_transaction) = 8  or month(date_transaction) = "sierpien" ';
        }
        if($_GET['month'] == 'wrzesien')
        {
            $sql.= 'and month(date_transaction) =  9  or month(date_transaction) = "wrzesien" ';
        }
        if($_GET['month'] == 'pazdziernik')
        {
            $sql.= 'and month(date_transaction) = 10 or month(date_transaction) = "pazdziernik" ';
        }
        if($_GET['month'] == 'listopad')
        {
            $sql.= 'and month(date_transaction) = 11  or month(date_transaction) = "listopad" ';
        }
        if($_GET['month'] == 'grudzien')
        {
            $sql.= 'and month(date_transaction) = 12  or month(date_transaction) = "grudzzien" ';
        }
    }
    else{
        $sql.= "and month(curdate()) and year(curdate())";
    }


    if ($_POST['category']) {
        $sql .= 'and c.id_category = "' . $_POST['category'] . '"';


    }
    if (!$_POST['category'] or $_POST['category'] = 'SHOW ALL') {
        $sql .= ' ';
    }

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $result = $con->query($sql);
    if ($result->num_rows > 0) {


        echo "<tr >";

        echo "<th style='width: 120px;'>Kategoria</th>";
        echo "<th style='width: 150px;'>Nazwa</th>";
        echo "<th style='width: 150px;'>Data transakcji</th>";
        echo "<th style='width: 90px;'>Kwota</th>";
        echo "</tr>";




        while ($row = $result->fetch_assoc()) {

            echo "<form action='expense.php' method='post' role='form'>";
            echo "<tr class ='transaction' >";
            echo "<td>" . $row["category"] . "</td>" . "";
            echo "<td>" . $row["comment"] . "</td>";
            echo "<td>" . $row["date_transaction"] . "</td>" . "";
            echo "<td>" . $row["money"] . "</td>";



            echo "</tr>";

        }
        echo "</table>";
        echo "<p id='demo'></p>";

    }
    echo "</form>";
}
//planner functions

///
///
///





if(isset($_POST['planner'])) {
    header('Location:planner.php');

    $category = $_POST['category'] ;
    $money = $_POST['money'];
    $date_transaction = $_POST['date_transaction'];
    $comment = $_POST['comment'];
    $form = $_POST['form']  ;

    $sql = "insert into todolist  set
            form = '$form',
            type = '0',
            date_transaction = '$date_transaction',
            money = '$money',
            comment = '$comment',
            id_user= " . $_SESSION['id'] . ",
            id_category = " . $_POST['category'] . ".";

    $result = $con->query($sql) ;

}

function categories ($con) {
    $category = $_POST['category'];
    $sql = "select name from categroy where id_category ='$category' ";
    $result =$con->qury($sql);


}


function sql($con) {
    $con->query("SET CHARSET utf8");
    $con->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
//    type: 0 - expense, 1 - income

    $sql = 'select  id_transaction, money, date_transaction, comment, 
       (case 
           when t.type = 0 then "Wydatek"
           when t.type = 1 then "Przychód"
           else null
           end  ) as type,
        c.name as category
            
        from transactions as t 
            
            
        join category as c on c.id_category=t.id_category where  id_user = "'.$_SESSION['id'].'"';


    if(isset($_GET['month'])) {
        if($_GET['month'] == 'styczen')
        {

            $sql.= 'and month(date_transaction) =  1 or month(date_transaction) = "styczen"  ';
        }
        if($_GET['month'] == 'luty')
        {
            $sql.= 'and month(date_transaction) = 2   or month(date_transaction) = "luty" ';
        }
        if($_GET['month'] == 'marzec')
        {
            $sql.= 'and month(date_transaction) = 3 or month(date_transaction) = "marzec" ';
        }
        if($_GET['month'] == 'kwiecien')
        {
            $sql.= 'and month(date_transaction) =4  or month(date_transaction) = "kwiecien"';
        }
        if($_GET['month'] == 'maj')
        {
            $sql.= 'and month(date_transaction) = 5 or month(date_transaction) = "maj" ';
        }
        if($_GET['month'] == 'czerwiec')
        {
            $sql.= 'and month(date_transaction) =  6  or month(date_transaction) = "czerwiec" ';
        }
        if($_GET['month'] == 'lipiec')
        {
            $sql.= 'and month(date_transaction) =  7  or month(date_transaction) = "lipiec" ';
        }
        if($_GET['month'] == 'sierpien')
        {
            $sql.= 'and month(date_transaction) = 8  or month(date_transaction) = "sierpien" ';
        }
        if($_GET['month'] == 'wrzesien')
        {
            $sql.= 'and month(date_transaction) =  9  or month(date_transaction) = "wrzesien" ';
        }
        if($_GET['month'] == 'pazdziernik')
        {
            $sql.= 'and month(date_transaction) = 10 or month(date_transaction) = "pazdziernik" ';
        }
        if($_GET['month'] == 'listopad')
        {
            $sql.= 'and month(date_transaction) = 11  or month(date_transaction) = "listopad" ';
        }
        if($_GET['month'] == 'grudzien')
        {
            $sql.= 'and month(date_transaction) = 12  or month(date_transaction) = "grudzzien" ';
        }
    }
    else{
        $sql.= "and month(curdate()) and year(curdate())";
    }



    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }




    //SORTING Transactions

    switch ($_GET['sort']) {
        // SORTING  by Category
        case 'category-asc':
            {
                $sql .= "order by category asc";
                break;
            }
        case 'category-desc':
            {
                $sql .= "order by category desc";
                break;
            }
        // SORTING  by Date transaction
        case 'date-asc':
            {
                $sql .= "order by date_transaction asc";
                break;
            }
        case 'date-desc':
            {
                $sql .= "order by date_transaction desc";
                break;
            }
        // SORTING  by Card/Cash

        // SORTING  by MONEY
        case 'money-asc':
            {
                $sql .= "order by money asc";
                break;
            }
        case 'money-desc':
            {
                $sql .= "order by money desc";
                break;
            }
        // SORTING  by Type ( Expense / Income )
        case 'type-asc':
            {
                $sql .= "order by type asc";
                break;
            }
        case 'type-desc':
            {
                $sql .= "order by type desc";
                break;
            }
        default:
            $sql .= "";
            break;



    }
    //FILTERING
    $result = $con->query($sql);
    if ($result->num_rows > 0 ) {

        echo "<table id='trans' >";


        echo "<tr class='trans'>";
        echo "<th>Kategoria
                      
                  </th>";

        echo "<th>Co
                      
                  </th>";

        echo "<th>Data transakcji
                      
                  </th>";
        echo "<th>Kwota
                     
                  </th>";
        echo "<th>Przychód/Wydatek
                      
                  </th>";

        echo "</tr>";


        if(isset($_POST['submitDeleteBtn'])) {
            $key = $_POST['keyToDelete'];
            $queryDelete = $con->query("delete from transactions where id_transaction = '$key' order by date_transaction ");
            header('refresh:1;')
            or die ("not deleted");
        }
        while ($row = $result->fetch_assoc()) {

            echo "<form action='' method='post' role='form'>";

            echo "<tr>";
            echo "<td>" . $row["category"] . "</td>" . "";
            echo "<td>" . $row["comment"] . "</td>";
            echo "<td>" . $row["date_transaction"] . "</td>" . "";
            echo "<td>" . $row["money"] . "</td>";
            echo "<td>" . $row["type"] . "</td>" . "";

            echo "</tr>";
            echo "</form>";
        }


        echo "</table>";
    }
    else {
        echo "Brak danych :(";
    }



}