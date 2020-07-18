<?php
require_once 'dbbudget.php';

$url = $_SERVER['REQUEST_URI'];
$con->query("SET CHARSET utf8");
$con->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");


$sql = "select c.name, money
                from transactions as t 
                    join category as c 
                    on c.id_category=.t.id_category and c.type=t.type
                        where money>0 
                                ";

if (isset($_GET['type'])) {
    $sql.= " and t.type= " .$_GET['type'];

}
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
        $sql.= " and month(date_transaction) = " . $month;

    }
    $month -= 1;
    if($month == 0) $month = 12;

}

$sql.=" group by c.id_category order by c.name asc";
$result = mysqli_query($con, $sql);


?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        var data = google.visualization.arrayToDataTable([
            ['name', 'money'],
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "['" . $row["name"] . "', " . $row["money"] . "],";
            }
            ?>
        ]);
        var options = {
            title: 'Percentage of Male and Female Employee',
            pieHole: 0.5,
            is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
</script>
<body>

</body>