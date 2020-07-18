<?php
require_once 'dbbudget.php';
function sql_transactions($con, $type)
{
    $url = $_SERVER['REQUEST_URI'];
    $con->query("SET CHARSET utf8");
    $con->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");


    $sql = "select id_transaction, money, comment, date_transaction, c.name as category
                from transactions as t 
                join category as c on c.id_category=t.id_category and c.type=t.type
                 where t.type= '" . $type . "' and  id_user='" . $_SESSION['id'] . "'";

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
        echo "<table class='table '>";
        echo "<thead class='thead-dark'>";
        echo "<form method='get'>";
        echo "<tr>";
        echo "<th scope='col'>#</th>";
        echo "<th scope='col'>Kategoria</th>";
        echo "<th scope='col'>Kwota</th>";
        echo "<th scope='col'>Data transakcji</th>";
        echo "</tr>";
        echo "</form>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            $id++;
            if ($type == 0) $color = "class='text-danger'";
            if ($type == 1) $color = "class='text-success'";

            echo "<tr>";
            echo "<form action='info.php' method='get'>";
            echo "<td>" . $id . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td {$color}>" . $row['money'] . "<small>zł</small></td>";
            echo "<td>" . $row['date_transaction'] . "</td>";

            echo "</form>";
            echo "</tr>";

        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<table class='table'>";
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

        echo "</table>";
        echo "Brak danych do wyświetlenia :(";
    }
}

function select_year($con,$type)
{
    $url = $_SERVER['REQUEST_URI'];
    if (!isset($_GET['month'])) {
        if (!strpos($url, "?")) {
            $url .= "?";
        }
    }
    if (isset($_GET['category'])) {
        $category = "&category=";
        $category .= $_GET['category'];
        $url = str_replace($category, '', $url);
    }

    if (isset($_GET['from']) || ($_GET['to']) || ($_GET['date_transaction'])) {
        $from = "from=" . $_GET['from'];
        $to = "&to=" . $_GET['to'];
        $date_transaction = "&date_transaction=" . $_GET['date_transaction'];
        $url = str_replace($from, '', $url);
        $url = str_replace($to, '', $url);
        $url = str_replace($date_transaction, '', $url);
    }
    if (isset($_GET['month'])) {
        $month = '&month=';
        $month .= $_GET['month'];
        $url = str_replace($month, '', $url);
    }

    if (isset($_GET['year'])) {
        $month = '&year=';
        $month .= $_GET['year'];
        $url = str_replace($month, '', $url);
    }


    $sql = "select distinct year(date_transaction) as year 
                    from transactions 
                        where type= '".$type."' and  id_user = '" . $_SESSION['id'] . "'";
    $result = $con->query($sql);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $year = '&year=';
            $year .= $row['year'];
            if (isset($_GET['year'])) {
                if ($_GET['year'] == $_GET['year']) {
                    $selected = ' selected';
                } else {
                    $selected = '';
                }
            }
            $link = $url . $year;
            echo "<option name='year' value='$link' >{$row['year']}</option>";
        }
    }
}

function select_month($con,$type)
{
    $url = $_SERVER['REQUEST_URI'];
    if (!isset($_GET['month'])) {
        if (!strpos($url, "?")) {
            $url .= "?";
        }
    }
    if (isset($_GET['from']) || ($_GET['to']) || ($_GET['date_transaction'])) {
        $from = "from=" . $_GET['from'];
        $to = "&to=" . $_GET['to'];
        $date_transaction = "&date_transaction=" . $_GET['date_transaction'];
        $url = str_replace($from, '', $url);
        $url = str_replace($to, '', $url);
        $url = str_replace($date_transaction, '', $url);
    }

    if (isset($_GET['month'])) {
        $month = '&month=';
        $month .= $_GET['month'];
        $url = str_replace($month, '', $url);
    }

    $sql = "select distinct (  case
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
                        where type= '".$type."' and  id_user = '" . $_SESSION['id'] . "'";


    if (isset($_GET['year'])) {
        $year = $_GET['year'];
        $sql .= " and year(date_transaction) = {$year} ";
    }

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $month = '&month=';
            $month .= $row['month'];
            $link = $url . $month;
            echo "<option name='year' value='$link' >{$row['month']}</option>";
        }
    }
}

function selectCategory($con, $type)
{
    $con->query("SET CHARSET utf8");
    $con->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
    $url = $_SERVER['REQUEST_URI'];
    if (!isset($_GET['category'])) {
        if (strpos($url, '?')) {
        } else {
            $url = $url . "?";
        }
    }
    if (isset($_GET['category'])) {
        $category = '&category=';
        $categoryId = $_GET['category'];
        $search = $category . $categoryId;
        $url = str_replace($search, '', $url);
    }


    $sql = "select c.id_category,count(c.id_category) as amount, c.name, c.type
                from category as c
                join transactions as t 
                    on t.id_category = c.id_category and c.type=t.type
                    where t.type = " . $type . " and id_user='" . $_SESSION['id'] . "'";

    if (isset($_GET['to'])) {
        if (isset($_GET['from'])) {
            if ($_GET['from'] == $_GET['to']) {
                $sql .= "and date_transaction = " . "'" . $_GET['from'] . "'";
            } else {
                $sql .= " and date_transaction between " . "'" . $_GET['from'] . "' and '" . $_GET['to'] . "'";
            }
        }
    }

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

            $sql .= " and month(date_transaction ) = '{$month}' ";
        } else {
            $sql .= " and month(date_transaction) = curdate() ";
        }
    }

    if (isset($_GET['year'])) {
        $year = $_GET['year'];
        if ($_GET['year'] == $year) {
            $sql .= " and year(date_transaction) = {$year} ";
        }
    }
    $sql .= " group by name";
    $sql .= " order by type";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo "<h5>Wybierz kategorię</h5>";
        while ($row = $result->fetch_assoc()) {
            $category = "&category=";
            $categoryName = $row['name'];
            $categoryId = $row['id_category'];
            $link = $url . $category . $categoryId;
            if ($row['type'] == 0) $color = "class='badge badge-danger border w-100 '";
            if ($row['type'] == 1) $color = "class='badge badge-success border w-100 '";

            echo "<a {$color}  href={$link}>" . $row['name'] . " <span class=' badge badge-light '> " . $row['amount'] . "</span></a>";

        }


    } else {
        echo "<br>Brak danych do wyświetlenia :(<br>";

    }


}

?>