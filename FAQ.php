<?php
require_once 'dbbudget.php';
require_once 'charts/chart.php';
$sql = "select c.name, money 
                from transactions as t 
                    join category as c 
                    on c.id_category=.t.id_category 
                        where money>0 
        group by c.id_category";
$result = mysqli_query($con,$sql);

if($result){
    echo "success";
}else {
    echo "fail";
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart()
        {
            var data = google.visualization.arrayToDataTable([
                ['name', 'money'],
                <?php
                while($row = mysqli_fetch_array($result))
                {
                    echo "['".$row["name"]."', ".$row["money"]."],";
                }
                ?>
            ]);
            var options = {
                title: 'Percentage of Male and Female Employee',
                //is3D:true,
                pieHole: 0.5,
                is3D: true,
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
    <title>Document</title>
</head>
<body>

<div id="donutchart" style="width: 900px; height: 500px;"></div>

<div id="piechart" style="width: 900px; height: 500px;">


</div>

</body>
</html>
