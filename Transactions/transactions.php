<?php
require_once 'functions.php';
require_once 'dbbudget.php';

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<head>

    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="icon" href="../server/house.png"/>
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script defer src="../functions.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



    <title>Transakcje</title>

        </head>
<body class="loggedin">

<!--GRID CONTAINER-->

<div class="grid_container">


    <!--    NAVBAR-->
    <div class="navbar">
<nav class="navtop">

    <ul >
<!--        Top toolbar-->
        <li><a href="transactions.php">Transakcje</a></li>
        <li><a href="expense.php"></i>Wydatki</a></li>
        <li><a href="income.php"></i>Przychody</a></li>
        <li><a href="planner.php"></i>Kalendarz</a></li>
        <li><a href="calendar.php"></i>Calendar</a></li>
        <li><a href="../dbbudget.php"">FAQ</a></li>
        <li><a href="contanct.php">Kontakt</a></li>
    </ul>
</nav>

  </div>
<!--    NAVBAR END-->
    <div class="left_menu">


        <ul >

            <li><?year($con,'transactions',0, 1);?></li>
        </ul>


    </div>


<!--    TABLE-->

  <div class="content">
      <h1 style="text-align: left;">Transakcje</h1>


        <?sql($con)?>



  </div>



</div>
</body>
</html>
