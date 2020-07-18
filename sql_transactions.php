<?php
//include "css/style.css";
require_once 'sortView.php';
require_once 'summary.php';
require_once 'dbbudget.php';
echo "<head>
<link href='css/style.css' type='text/css' rel='stylesheet'>
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
            <script src='https://code.jquery.com/jquery-3.4.1.js'></script>
            <script src='../js/bootstrap.min.js'></script>
            <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\">
</head>";
function generateRandomString($length = 10) {
    $randomStirng= substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    echo $randomStirng;
}
function removeData($con) {
    echo "<script type='text/javascript'>
alert('usunieto rekord');
</script>";
    $sqlRemove = "delete from transactions where id_transaction ='".$_GET['remove']."'";
    $result=$con->query($sqlRemove);
    echo $sqlRemove;
}
if(isset($_GET['remove'])) {
    removeData($con);
}
function number_of_pages($con, $results_per_page)
{
    $url = $_SERVER['REQUEST_URI'];
    if (isset($_GET['page'])) {
        $page = '&page=';
        $page .= $_GET['page'];
        $url = str_replace($page, '', $url);
    } else {
        if (strpos($url, '?')) {
        } else {
            $url = $url . "?";
        }
    }


    $sql = "select count(id_transaction) as total 
                from transactions as t 
                join category as c on t.id_category=c.id_category 
                where id_user='" . $_SESSION['id'] . "' ";
    if (isset($_GET['category'])) {
        $categoryId = $_GET['category'];
        if ($_GET['category'] == $categoryId) {
            $sql .= " and c.id_category in ('$categoryId') ";
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
        }
    } else {
        $sql .= " and month(date_transaction) = month(CURDATE()) ";
    }

    if (isset($_GET['year'])) {
        $year = $_GET['year'];
        if ($_GET['year'] == $year) {
            $sql .= " and year(date_transaction) = {$year} ";
        }
    }
    $result = $con->query($sql);
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $total_pages = ceil($row['total']) / $results_per_page;
//            echo "<select class='custom-select-sm ' onchange='if (this.value) window.location.href=this.value'>";
            if ($total_pages > 1) {
                echo "<ul class='pagination'>";
                if ($total_pages == 0) {
                    echo "<li class='page-item'><a class='page-link' href=''>Poprzednia</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='#'>1</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='#'>2</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='#'>3</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='#'>Następna</a></li>";

                }
                if (isset($_GET['page']) && ($_GET['page'] != 0) and ($_GET['page'] > 1)) {
                    $pageNumber = $_GET['page'];
                    $i = $pageNumber - 1;
                    $page = "&page=";
                    $link = $url . $page . $i;
                    echo "<li class='page-item'><a class='page-link' href='$link'>Poprzednia</a></li>";
                }
                for ($i = 1; $i < $total_pages; $i++) {

                    $page = "&page=";
                    $link = $url . $page . $i;
                    echo "<li class='page-item'><a class='page-link' href='$link'>$i</a></li>";
                }
                if (isset($_GET['page']) && ($_GET['page'] != 0) and ($_GET['page'] < floor($total_pages))) {
                    $pageNumber = $_GET['page'];
                    $i = $pageNumber + 1;
                    $page = "&page=";
                    $link = $url . $page . $i;
                    echo "<li class='page-item'><a class='page-link' href='$link'>Następna</a></li>";
                }


                echo "</ul>";
//            echo "</select>";;
            }
        }
    }
}

function select_date($con, $link, $table, $type)
{
    $url = $_SERVER['REQUEST_URI'];
    if (!isset($_GET['month']) or ($_GET['year'])) {
        if (!strpos($url, "?")) {
            $url .= "?";
        }
    }

    if (isset($_GET['month']) && ($_GET['year'])) {
        $month = '&month=';
        $year = '&year=';
        $month .= $_GET['month'];
        $year .= $_GET['year'];
        $url = str_replace($month, '', $url);
        $url = str_replace($year, '', $url);
        echo $url;
    }
    $sql = 'select distinct year(date_transaction) as year,
                ( case
                     when month(date_transaction) = 1 then \'styczen\'
                     when month(date_transaction) = 2 then \'luty\'
                     when month(date_transaction) = 3 then \'marzec\'
                     when month(date_transaction) = 4 then \'kwiecien\'
                     when month(date_transaction) = 5 then \'maj\'
                     when month(date_transaction) = 6 then \'czerwiec\'
                     when month(date_transaction) = 7 then \'lipiec\'
                     when month(date_transaction) = 8 then \'sierpien\'
                     when month(date_transaction) = 9 then \'wrzesien\'
                     when month(date_transaction) = 10 then \'pazdziernik\'
                     when month(date_transaction) = 11 then \'listopad\'
                     when month(date_transaction) = 12 then \'grudzien\'
                     else null
                     end
                     
                       )
                     as month
            from ' . $table . '
                where id_user = "' . $_SESSION['id'] . '" and type in ( ' . $type . '  )';
    $result = $con->query($sql);

    if ($result->num_rows > 0) {


        echo "<option value=''>Wybierz datę </option>";


        while ($row = $result->fetch_assoc()) {

            $month = "&month=";
            $month .= $row['month'];
            $year = "&year=";
            $year .= $row['year'];

            $link = $url . $month . $year;
            echo $url;

            echo "<option value ='{$link}'> {$row['year']} / {$row['month']} </option><br>";


        }
        echo "<a href='{$link}.php'>Odswiez</a>";

    } else {
        echo "<select class='custom-select'>";
        echo "<option >Wybierz datę</option>";
        echo "<option disabled>" . date("Y.m.d") . "</option>";
        echo "</select>";
    }


}

function select_type()
{
    $url = $_SERVER['REQUEST_URI'];
    if (!isset($_GET['type'])) {
        if (!strpos($url, "?")) {
            $url .= "?";
        }
    }
    if (isset($_GET['type'])) {
        $type = "&type=";
        $type .= $_GET['type'];
        $url = str_replace($type, '', $url);
    }
    $type = "&type=";
    $expense = 0;
    $income = 1;
    $expense = $url . $type . $expense;
    $income = $url . $type . $income;
//    <button class='btn btn-danger' type="submit" value="0" name="type">Wydatki</button>
//     button       <button class='btn btn-success' type="submit" value="1" name="type">Przychody</button>
    echo "<a href='$expense'><button class='btn btn-danger' type='submit' name='type' value='0'>Wydatki</button></a>";
    echo "<a href='$income'><button class='btn btn-success' type='submit' name='type' value='1'>Przychody</button></a>";
}

function select_year($con)
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
                        where id_user = '" . $_SESSION['id'] . "'";
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

function select_month($con)
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
                        where id_user = '" . $_SESSION['id'] . "'";


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
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        if ($_GET['type'] == $type) {

        }
    } else {
        $type = "0, 1";
    }

    $sql = "select c.id_category,count(c.id_category) as amount, c.name, c.type
                from category as c
                join transactions as t 
                    on t.id_category = c.id_category and c.type=t.type
                    where t.type in ({$type}) and id_user='" . $_SESSION['id'] . "'";

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

function sql($con)
{
    $url = $_SERVER['REQUEST_URI'];
    $con->query("SET CHARSET utf8");
    $con->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

    $results_per_page = 50;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    };
    $start_from = ($page - 1) * $results_per_page;


    $sql = "select  id_transaction, money, comment,date_transaction, 
                     (case 
                        when t.type = 0 then 'Wydatek' 
                        when t.type = 1 then 'Przychód'
                        else null
                        end  ) as type,
                             c.name as category
            
                        from transactions as t 
            
        
                            join category as c on c.id_category=t.id_category 
                            where id_user = '" . $_SESSION['id'] . "'";

    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        if ($_GET['type'] == 1) {
            $sql .= " and t.type = " . $type;
        } else {
            $sql .= " and t.type = " . "0";
        }
    }

    if (isset($_GET['category'])) {
        $categoryId = $_GET['category'];
        if ($_GET['category'] == $categoryId) {
            $sql .= " and c.id_category in ('$categoryId') ";
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
    if (isset($_GET['from']) || ($_GET['to'])) {
        if ($_GET['from'] == ($_GET['to'])) {
            $from = "from=";
            $from .= $_GET['from'];
            $to = '&to=';
            $date_transaction = $_GET['to'];
            $url = str_replace($from, '', $url);
            $url = str_replace($to, '&date_transaction=', $url);
            $sql .= " and date_transaction =  '{$date_transaction}'";

        } else {

            $_GET['month'] = $_GET['year'] = '';
            $_GET['to'] = str_replace('?', '', $_GET['to']);
            $sql .= "and date_transaction between '" . $_GET['from'] . "' and '" . $_GET['to'] . "'";
        }

    }
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }


    if (!isset($_GET['sort'])) {
        if (!strpos('?', $url)) {
            $url .= "?";
        }
    }

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        if (strpos($sort, '_asc')) $sort = str_replace('_asc', ' asc', $sort);
        if (strpos($sort, '_desc')) $sort = str_replace('_desc', ' desc', $sort);
        $sql .= " order by " . $sort;
    }

    $sql .= " limit $start_from, " . $results_per_page;

    $typeStyle = 'Przychód/Wydatek';
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        if ($type == 0) $typeStyle = 'Wydatek';
        if ($type == 1) $typeStyle = 'Przychód';
    }

    if (isset($_GET['sort'])) {
        if ($_GET['sort']) {

            if ($_GET['sort'] == 'category_desc') $catStyle = "<i class='fas fa-arrow-up'></i>";
            if ($_GET['sort'] == 'category_asc') $catStyle = "<i class='fas fa-arrow-down'></i>";

            if ($_GET['sort'] == 'money_desc') $moneyStyle = "<i class='fas fa-arrow-up'</i>";
            if ($_GET['sort'] == 'money_asc') $moneyStyle = "<i class='fas fa-arrow-down'></i>";

            if ($_GET['sort'] == 'date_transaction_desc') $dateStyle = "<i class='fas fa-arrow-up'</i>";
            if ($_GET['sort'] == 'date_transaction_asc') $dateStyle = "<i class='fas fa-arrow-down'></i>";

            if ($_GET['sort'] == 'type_desc') $typeStyle = "Przychód/<span class='text-danger'>Wydatek</span>";
            if ($_GET['sort'] == 'type_asc') $typeStyle = "<span class='text-success'>Przychód</span>/Wydatek";
        }
    }


    $result = $con->query($sql);
    number_of_pages($con, $results_per_page);

    if ($result->num_rows > 0) {

        if (isset($_GET['sort'])) {
            $sort = '&sort=';
            $sort .= $_GET['sort'];
            $url = str_replace($sort, '', $url);
            if (strpos($_GET['sort'], '_asc')) {
                $_GET['sort'] = str_replace('_asc', '', $_GET['sort']);
                $desc = '_desc';
            }
            if (strpos($_GET['sort'], '_desc')) {
                $_GET['sort'] = str_replace('_desc', '', $_GET['sort']);
                $desc = '_asc';
            }
        } else {
            $_GET['sort'] = str_replace('_desc', '', $_GET['sort']);
            $desc = '_asc';
        }
        $category = 'category';
        $money = 'money';
        $date = 'date_transaction';
        $type = 'type';
        $sort = '&sort=';

        $sortCategory = $url . $sort . $category . $desc;
        $sortMoney = $url . $sort . $money . $desc;
        $sortDate = $url . $sort . $date . $desc;
        $sortType = $url . $sort . $type . $desc;


        echo "<table class='table' ' >";
        echo "<thead class='thead-dark' >";
        echo "<form method='get'>";
        echo "<tr >";
        echo "<th  scope='col'  >#</th>";
        echo "<th  scope='col'><a href= $sortCategory><span class='text-top'>Kategoria {$catStyle}</span></a></th>";
        echo "<th  scope='col' ><a href=$sortMoney><span class='text-top'>Kwota{$moneyStyle}</span></a></th>";
        echo "<th  scope='col' ><a href=$sortDate><span class='text-top'>Data transakcji{$dateStyle}</span></a></th>";
        echo "<th  scope='col' style='width: 50px;' ><a href=$sortType><span class='text-top'> {$typeStyle}</span></a></th>";
        echo "<th scope='col' style='width: 50px;' >Akcje</th>";



        echo "</tr>";
        echo "</form>";
        echo "</thead>";
        echo "<tbody>";

        $id = 0;

        while ($row = $result->fetch_assoc()) {
            $id_transaction = $row['id_transaction'];
            if ($row['date_transaction'] == date("Y-m-d")) {
                $today = 'class="alert alert-dark" title="Dzisiejsza data"';

            } else {
                $today = '';
            }
            $id++;

            if ($row['money'] < 0) $color = 'class="text-danger"';
            if ($row['money'] > 0) $color = 'class="text-success"';

//            Usuwanie rekordow


            $randomString = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
            echo "<tr {$today} title={$row["comment"]}>";
            echo "<form action='' method='get'>";
            echo "<th  scope='row' >$id</th>";
            echo "<td >" . $row["category"] . "</td>" . "";
            echo "<td {$color}>" . $row["money"] . " <small>zł</small></td>";
            echo "<td >" . $row["date_transaction"] . "</td>" . "";
            echo "<td {$color}>" . $row["type"] . "</td>" . "";
            echo "<td><button type='submit' name='id_transaction' value=$id_transaction>Edytuj</button>
                    <form action='transactions.php' method='post'>
                    <button type='submit' id='remove' name='remove' value=$id_transaction>Usuń</button>
                    </form>
                 </td>";
            echo "<td></td>";
            echo "</form>";
            echo "</tr>";

        }
        echo "<tbody>";
        echo "</table>";
    } else {
        echo "Brak danych do wyświetlenia :(";
    }
}




?>