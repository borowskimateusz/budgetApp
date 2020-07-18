<?php
function select_summary($con)
{
    $sql = "select saldo from saldo where id_user= '" . $_SESSION['id'] . "'";

    if (isset($_GET['type'])) {

    }
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $color = "class='text-white'";
            if ($row['saldo'] > 0) $color = "class='text-success'";
            if ($row['saldo'] < 0) $color = "class='text-danger'";

            echo "<span $color> " . $row['saldo'] . "<small>zł</small></span>";
        }

    }
}

function select_saldo($con, $type)
{

    $sql = "select sum(money) as summary
                from transactions 
                    where `type` in ('{$type}') and id_user = {$_SESSION['id']}";


    if (isset($_GET['year'])) {
        $month = $_GET['month'];
        if (isset($_GET['month'])) {

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
                $sql .= " and year(date_transaction)=" . $_GET['year'] . " and month(date_transaction)=" . $month;
            }

        } else {
            $sql .= " and year(date_transaction)= " . $_GET['year'];

        }
    }

    if (isset($_GET['to'])) {
        if (isset($_GET['from'])) {
            if ($_GET['from'] == $_GET['to']) {
                $sql .= " and date_transaction = " . $_GET['to'];
                $date = "Data: " . $_GET['from'] . "<br>";

            } else {
                $sql .= " and date_transaction between '" . $_GET['from'] . "' and '" . $_GET['to'] . "'";
                $date = "Data od: " . $_GET['from'] . " do " . $_GET['to'] . "<br>";
            }

        } else {
            $sql .= " and date_transaction = " . $_GET['to'];
            $date = "Data: " . $_GET['from'] . "<br>";
        }

    }
    if (isset($_GET['category'])) {
        $sql .= " and id_category = " . $_GET['category'];
        $category = "Kategoria: " . $_GET['category'] . "<br>";
    }


    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['summary'] < 0) $color = 'class="text-danger"';
            if ($row['summary'] > 0) $color = 'class="text-success"';
            echo $date;
            echo $category;
            echo "<small title='' $color>" . $row['summary'] . " zł</small>";
        }
    }
}

function select_in_out_summary($con, $type)
{
    $sql = "select c.name as name, sum(money) as sum,round(avg(money),2) as avg, count(id_transaction) as count
        from transactions as t 
        join category as c on c.id_category=t.id_category and c.type=t.type
       where t.type = '" . $type . "' and  id_user = '" . $_SESSION['id'] . "'  ";

    if(isset($_GET['year'])){
        $sql.=" and year(date_transaction) = " .$_GET['year'];
    }
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
            $sql.=" and month(date_transaction) = " .$month;

        }

    }

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $id = 0;
        echo "<table class='table w-100'>";
        echo "<thead class='thead-dark'>";
        echo "<form method='get'>";
        echo "<tr>";
        echo "<th scope='col'>#</th>";
        echo "<th scope='col'>Kategoria</th>";
        echo "<th scope='col'>Kwota</th>";
        echo "<th scope='col'>Srednia</th>";
        echo "<th scope='col'>Ilość</th>";
        echo "</tr>";
        echo "</form>";
        echo "</thead>";
        echo "<tbody>";
        while($row=$result->fetch_assoc()){
            $id++;
            if ($type == 0) $color = "class='text-danger'";
            if ($type == 1) $color = "class='text-success'";

            echo "<tr>";
            echo "<form method='get'>";
            echo "<td>" . $id . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td {$color}>" . $row['sum'] . "<small>zł</small></td>";
            echo "<td {$color}>" . $row['avg'] . "<small>zł</small></td>";
            echo "<td class='text-black-50'>" . $row['count'] . "</td>";
            echo "</form>";
            echo "</tr>";

        }
        echo "</tbody>";
        echo "</table>";
    }else {
        echo "Brak danych do wyświetlenia :(";
    }

}

function select_in_out_summary_before($con, $type)
{
    $sql = "select c.name as name, sum(money) as sum, avg(money) as avg, count(id_transaction) as count
        from transactions as t 
        join category as c on c.id_category=t.id_category and c.type=t.type
       where t.type = {$type} and  id_user = '" . $_SESSION['id'] . "'  ";

    if (isset($_GET['year'])) {
        $sql .= " and year(date_transaction) = " . $_GET['year'];
        if (isset($_GET['month'])) {
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

            }

            $month -= 1;
            if ($month == 0) $month = 12;

        }
    }
    $sql .= " group by c.id_category";
    $result = $con->query($sql);


    if ($result->num_rows > 0) {
        $id = 0;
        echo "<table class='table w-100'>";
        echo "<thead class='thead-dark'>";
        echo "<form method='get'>";
        echo "<tr>";
        echo "<th scope='col'>#</th>";
        echo "<th scope='col'>Kategoria</th>";
        echo "<th scope='col'>Kwota</th>";
        echo "<th scope='col'>Średnia</th>";
        echo "<th scope='col'>Ilość</th>";
        echo "</tr>";
        echo "</form>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            $id++;
            if ($type == 0) $color = "class='text-danger'";
            if ($type == 1) $color = "class='text-success'";

            echo "<tr>";
            echo "<form method='get'>";
            echo "<td>" . $id . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td {$color}>" . $row['sum'] . "<small>zł</small></td>";
            echo "<td class='text-info'>" . $row['avg'] . "<small>zł</small></td>";
            echo "<td class='text-black-50'>" . $row['count'] . "</td>";
            echo "</form>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "Brak danych do wyświetlenia :(";
    }
}

function currentDate()
{
    if (!isset($_GET['year']) and !isset($_GET['to'])) {
        echo date("m-Y");
    }
    if (isset($_GET['year'])) {
        $year = $_GET['year'];
        if (isset($_GET['month'])) {
            $month = $_GET['month'];
            if ($_GET['month'] == $month) {
                if ($month == 'styczen') $month = '01';
                if ($month == 'luty') $month = '02';
                if ($month == 'marzec') $month = '03';
                if ($month == 'kwiecien') $month = '04';
                if ($month == 'maj') $month = '05';
                if ($month == 'czerwiec') $month = '06';
                if ($month == 'lipiec') $month = '07';
                if ($month == 'sierpien') $month = '08';
                if ($month == 'wrzesien') $month = '09';
                if ($month == 'pazdziernik') $month = 10;
                if ($month == 'listopad') $month = 11;
                if ($month == 'grudzien') $month = 12;
                echo $month . "-" . $year;
            }
        } else {
            echo $_GET['year'];
        }
    }


}

?>


