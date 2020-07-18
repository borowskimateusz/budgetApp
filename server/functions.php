
//SELECT DATE_TRANSACTION
if(isset($_POST['date']))
{
    $sqldate = "select date_transaction from transactions where date_transaction='$date'";
    $result = $con->query($sqldate);
    if($sqldate == true) {
        echo "Date: " . $date ."<br>";
    }else {
        echo "You have to choose date transaction.";
    }
}
//SELECT TYPE ( 0-EXPENSE / 1-INCOME)
if(isset($_POST['type']))
{
    $sqltype = "select type from transactions where type = '$type'";
    $result = $con->query($sqltype);
    if($result==true)
    {
        echo $type . '<br>';

    }
    else {
        echo "Choose your type of transaction";
    }

}
//SELECT CATEGORY ( id_category)
if($_POST['category']) {
    $sql = 'select nazwa from category where id_category = "' . $_POST['category'] . '"';
    $result = $con->query($sql);
    if($result==true) {
        echo $category .'<br>';
    }else {
        echo 'You have to choose some category.';
    }
}



{


}
//SELECT CARD NUMBER [card_number (must have 16 numbers) ]
if(isset($_POST['card_number']))
{


    if($result) {
        echo  $card_number . "<br>";
    }

}
//INSERT INTO TRANSACTIONS
if(isset($_POST['insert'])) {

    if (empty(!$money)) {
         {


        }
    } else{
        $sqlinsert = "insert into transactions 

        set
            type = '$type',
            date_transaction = '$date',
            money = '$money',
            id_category = '$category',

            card_number = '$card_number',
            id_user= " . $_SESSION['id_user'] . ".";
    $result = $con->query($sqlinsert);


    if ($result == true) {
        echo "Succes";
    } else {
        echo 'failure';
    }
}

}


<form action="expense.php" method="post">
            <select name="category">
                <otpion >CHOOSE CATEGORY</otpion>
                <option value="1" >RENT</option>
                <option value="6">GROCERIES</option>
                <option value="7">HEALTH</option>
                <option value="8">CAR MAINTENCE</option>
                <option value="9">ENTERTAINMENT</option>

            </select>

            <input type="submit" name="submit" value="Get Selected values">
        </form>
    </table>
    <!------------------INSERT NEW TRANSACTION------------------------------------------>
    <div >
        <form method="post" action="insert.php">
            <table>
                <!----------------SELECT TYPE FROM DATABASE------------------------------>
                <tr>
                    <td>Type
                        <select name="type">
                            <option value="0">Expense</option>
                            <option value="1">Income</option>
                        </select>

                    </td>

                </tr>
                <!------------------------SELECT DATE------------------------------------->
                <tr>
                    <td>Date

                        <input type="date" name="date">

                </tr>
                <tr>
                    <!------------------------INSERT MONEY------------------------------------->
                    <td>Money
                        <input oninput="empty_money()" text" name="money">
                        <script>
                            function empty_money() {

                                alert('No money');
                            }
                        </script>
                    </td>
                </tr>
                <tr>
                    <!------------------------SELECT CATEGORY------------------------------------>
                    <td>Category
                        <select name="category">
                            <otpion value="0">CHOOSE CATEGORY</otpion>
                            <option value="1" >RENT</option>
                            <option value="6">GROCERIES</option>
                            <option value="7">HEALTH</option>
                            <option value="8">CAR MAINTENCE</option>
                            <option value="9">ENTERTAINMENT</option>
                        </select>
                    </td>
                </tr>


                    <!------------------------SELECT CARD OR CASH----------------------------------->

                <!------------------------INSERT CARD NUMBER------------------------------------->
                <tr>
                    <td>Card number:

                        <input type="text"  name='card_number'>


                    </td>
                </tr>
            </table>
            <!------------------------ADDING TRANSACTION BUTTON----------------------------------->
            <button name="insert" value="Add new transaction">ADD</button>



        </form>
    <div>
        <a href="expense.php"><i class="fas fa-sign-out-alt"></i>Expenses</a>
        <a href="income.php"><i class="fas fa-sign-out-alt"></i>Income</a>
        <form action="expense.php" method="post">
            <textarea name="insert" ></textarea>
            <input name="insert" type="submit" placeholder="insert" ><?=insert($con)?>
        </form>




