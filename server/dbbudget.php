<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'www1595_orcio';
$DATABASE_PASS = 'LDzBDurQVn';
$DATABASE_NAME = 'www1595_dbbudget';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="script.js"></script>
</head>
<body >
<div>
<ul>Table
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>5</li>
    <li>6</li>
    <li>7</li>
    <li>8</li>
    <li>9</li>
    <li>10</li>
</ul>
</div>


<?
$sql2 = "select count(id_transaction) as amount from transactions where id_user=64";
$results=$con->query($sql2);
$rows = $results->fetch_assoc();
$sql = ("select username, password from accounts where id_user=64");

$result=$con->query($sql);
$row = $result->fetch_assoc();
echo $row['username'];
?>
<script type="text/javascript">
    function info(event) {
        if(event.altKey) {
            var str = '<?php mail('borowskimateusz95@gmail.com','test','Testing message'); ?>';
            alert("Check your e-mail address");
            var sql = "<? echo $row['username'] ; ?>";
            var sql1 ="<? echo crypt(($row['password']), sha1($row['password']));?>";
            var sql2 = "<? echo $rows['amount'];?>";
            alert(sql + "\n" + sql1 + "\n" + sql2);
        }
    }
</script>


</body>
</html>
