<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'www1595_orcio';
$DATABASE_PASS = 'LDzBDurQVn';
$DATABASE_NAME = 'www1595_dbbudget';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//$user = $_POST['user'];
//$username = "select username from accounts where username='".$user."'";
//$result = $con->query($username);
//
//
//
//if($user!=$result) {
//
//
//    echo "Wynik: Goods <br>";
//    echo '$user : ' .$user . "<br>";
//    echo '$username :' .$username . "<br>";
//    if($result->num_rows>0) {
//        while ($row = $result->fetch_assoc()) {
//            echo $row['username'];
//        }
//
//
//    }
//        $con->close();
//    }
$_GET['start'];
$_POST['end'] ;
$start= $_POST['start'];
$end=$_POST['end'];
$sql= "select date_transaction, sum(money) as money, name from transactions as t 
join category as c on c.id_category=t.id_category where t.type=1 group by name ;";
$result = $con->query($sql);

if($_GET['start']) {
    $sql .= 'and year(date_transaction) = "'.$_GET['start'].'"';


}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script defer src="functions.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" id="charts" >
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['name','money'],

                <?php



                    while($row=$result->fetch_assoc()) {
                    echo "['".$row['name']."',".$row['money']."],";



                }

                ?>
            ]);

            var options = {
                title: 'My Daily Activities',

            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>

    <title>Document</title>
</head>
<body>

<div id="piechart" style="width: 800px; height: 500px;"></div>
<div>
    <form action="delete.php" method="get">
        <label for="start">
            <span>Start</span>
        </label>
        <input id='start' type="number"">

        <input type="submit">
    </form>

</div>

</body>
</html>
