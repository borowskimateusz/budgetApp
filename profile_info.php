
<?php
$link = $_SERVER['REQUEST_URI'];
require_once 'dbbudget.php';
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['editEmail']))
{
    editEmail($con);
}

function editEmail ($con){
    $sql = "update accounts set email= '".$_POST['email']."' where id_user = '".$_SESSION['id']."'";
    echo $sql;
    $result=$con->query($sql);

    if($result=$con->query($sql)){
        header('Location: transactions.php');
    }
}


function profile_info($con)
{
    global $link;

    $newPassword = 'change_password.php';

    $sql = "select username, email, date_registration, password 
            from accounts 
            where id_user= '" . $_SESSION['id'] . "'";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo "<form action='' method='post'>";
        while ($row = $result->fetch_assoc()) {

            echo "

            <div class='form-group row w-100'>
                <label  for='username'>Nazwa użytkownika:</label>
                <input class='form-control' type='text' name='username' value='{$row['username']}' id='username'   readonly>
            </div>
            <div class='form-group row w-100'>
                <label  for='username'>Adres email:</label>
                <input class='form-control' type='text' name='email' value='{$row['email']}' id='email' disabled>
                <div>
                <a id='btn_edit' href='#' type='button' onclick='EditEmail()'><small>Edytuj</small></a>
                <a id='btn_email' href='#' style='display: none;' > <input type='submit' name='editEmail' value='Potwierdz'></a>
                   
              </div>
            </div>
            

            <div class='form-group row w-100'>
                <label  for='date'>Data rejestracji:</label>
                <input class='form-control' type='text' name='date' value='{$row['date_registration']}' id='password' readonly>
            </div>
            <div class='form-group row w-100'>
           
            <a href='$newPassword'><small>Zmień hasło</small></a>
            </div>
            
<script src='http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
<script type='text/javascript'>
    function EditEmail(){
        document.getElementById('email').value='';
        document.getElementById('email').placeholder='Nowy adres email';
        document.getElementById('email').disabled=false;
        document.getElementById('email').style.display='block';
        document.getElementById('btn_email').style.display='block';
        document.getElementById('btn_edit').style.display='none';
        }
    
</script>
        </form>";

        }
        echo "</form>";

    }
}

?>
