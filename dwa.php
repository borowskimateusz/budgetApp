<?php

if (isset($_GET['type'])) {
    if ($_GET['type'] == 1) {
        echo "success";
    } else {
        echo "faile";
    }
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
</head>
<body>
<form action="<? $_SERVER['REQUEST_URI'] ?>" type="get">
    <input type="checkbox" value="1" name="type">

    <? $url = $_SERVER['REQUEST_URI'];

    echo $url . "<br>";
    for ($i = 0; $i < 5; $i++) {
        $type = '&type=' . $i;
        $link = $url . $type ;
        $empty = str_replace($type, '', $url);

        echo $link . "<br>";

        echo "<a href='$link'>link {$i}</a><br>";
        echo "<a href='$empty'>disable {$i}</a><br>";

    }
    ?>

    <a href="http://budzetdomowy.usite.pl/dwa.php?">TEST</a>
    <input type="checkbox" value="2" name="type">
    <input type="checkbox" value="3" name="type">
    <input type="submit">
</form>

</body>
</html>
