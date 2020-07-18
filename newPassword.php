<?php
require_once 'dbbudget.php';

$password = $_POST['password'];
$newPassword = $_POST['newPassword'];
$checkNewPassword = $_POST['checkNewPassword'];
$newPassword = md5($newPassword);
$checkNewPassword = md5($checkNewPassword);
if (isset($_POST['password']) &&  ($_POST['newPassword']) && ($_POST['checkNewPassword'])) {
    echo "<script type='text/javascript'> document.getElementById('subs').style.display='none';</script>";


    $sql = "select password from accounts where id_user ='" . $_SESSION['id'] . "'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $password = md5($password);
            if($row['password']==$password){
                echo "Haslo poprawne <br>";
                echo $password.'<br>';
                echo $newPassword.'<br>';
                echo $checkNewPassword.'<br>';
            }
            else {
                echo "Haslo niepoprawne";
                header('location:change_password.php');
            }


            header('refresh:2;url=change_password.php');


        }
    }
}else {
    header('refresh:change_password.php');
}

?>