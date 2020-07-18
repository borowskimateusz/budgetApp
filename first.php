<?php
require_once 'dbbudget.php';
if (isset($_GET['type'])) {
    if ($_GET['type'] == 1) {
        echo "success";
    } else {
        echo "faile";
    }
}
function selectCategory($con, $type)
{


    $con->query("SET CHARSET utf8");
    $con->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
    $url = $_SERVER['REQUEST_URI'];
    if (isset($_GET['category'])) {
        $category = '&category=';
        $category .= $_GET['category'];
        $url = str_replace($category, '', $url);
    } else {
        if (strpos($url, '?')) {
        } else {
            $url = $url . "?";
        }
    }


    $sql = "select id_category, `name`
                from category
                where type = '$type' ";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo "<ul> ";
        while ($row = $result->fetch_assoc()) {
            $category = "&category=";
            $categoryName = $row['name'];
            $id_category = $row['id_category'];
            $link = $url . $category . $categoryName;

            echo "<a id=$id_category class='text-primary'  href='$link'>" . $row['name'] . "</a>";
            echo "<br>";
            if ($_GET[''] == $categoryName) {
                echo "<script>
                    document.getElementById($id_category).className='text=danger';
                    </script>";
            }


        }
    }
    echo "</ul>";
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


<?
$url = $_SERVER['REQUEST_URI'];
if (!isset($_GET['category'])) {
    if (strpos($url, '?')) {
    } else {
        $url = $url . "?";
    }
}

if (isset($_GET['var'])) {
    $var = "&var=";
    $nr = $_GET['var'];
    $value = $var . $nr;
    echo $value;
    $url = str_replace($value, '', $url);
}

echo "<a class='text-primary' href='$url" . "&var=1'>var1</a>";
echo "<a class='text-primary' href='$url" . "&var=2'>var2</a>";
echo "<a class='text-primary' href='$url" . "&var=3'>var3</a>";
echo "<a class='text-primary' href='$url" . "&var=4'>var4</a>";
echo "<a class='text-primary' href='$url" . "&var=5'>var5</a>";
echo "<a class='text-primary' href='$url" . "&var=6'>var6</a>";

for ($i = 1; $i <= 10; $i++) {

    $category = "&category=";
    $name = 'name';
    $name .= $i;
    $link = $url . $category . $name;
    echo $link;

    echo "<label for={$i}>            
                <a class='text-primary' name='category' href='$link'>$i</a>
                </label>";
    echo "<br>";

}


?>
<? selectCategory($con, 1); ?>
</form>


</body>
</html>
