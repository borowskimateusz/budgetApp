<?php
require_once 'sql_transactions.php';
require_once 'insertData.php';
require_once 'editData.php';
require_once 'dbbudget.php';

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>

<body class="bg-white">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<div class="grid_container">
    <!--    NAVBAR-->
    <div class="navbar fixed-top">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="transactions.php">Transakcje</a></li>
                <li class="nav-item "><a class="nav-link text-danger " title="do poprawy" href="expense.php"></i>
                        Wydatki</a></li>
                <li class="nav-item"><a class="nav-link text-danger" title="do poprawy" href="income.php"></i>
                        Przychody</a></li>
                <li class="nav-item"><a class="nav-link text-danger" title="do poprawy" href="planner.php"></i>
                        Kalendarz</a></li>
                <li class="nav-item"><a class="nav-link text-danger" title="do zrobienia FAQ"
                                        href="../dbbudget.php">FAQ</a></li>
                <li class="nav-item"><a class="nav-link text-danger" title="do zrobienia " href="profile.php">Moje
                        konto</a></li>
                <li class="nav-item"><a class="nav-link text-danger" title="do zrobienia " href="profile.php"><i
                                class="fa fa-long-arrow-alt-left"></i>Wyloguj</a></li>
                <li class="nav-item"><a class="nav-link" href=""
                                        title="Dostępne środki">Saldo:<? select_summary($con) ?></a></li>
            </ul>
        </nav>

    </div>


    <div class="left_menu mt-5 border position-fixed">

        <h5 class="mt-1">Wybierz datę</h5>

        <form class='form ' method="get">
            <select class="custom-select" onchange="if (this.value) window.location.href=this.value">
                <option>Wybierz rok</option>
                <? select_year($con); ?>
            </select>
            <? $disabled = '';
            if (!isset($_GET['year'])) {
                $disabled = 'title ="Wybierz rok" disabled';
            }
            ?>
            <select class="custom-select"
                    onchange="if (this.value) window.location.href=this.value" <? echo $disabled ?>>
                <option>Wybierz Miesiac</option>
                <? select_month($con); ?>
            </select>
        </form>
        <form action="" method="get">
            <label for="date_transaction">OD:</label>
            <input class='custom-select w-75' type="date" id="date_transaction" value="<? echo date('Y-m-d') ?>"
                   name="from">
            <label for="date_transaction">DO:</label>
            <input class='custom-select  w-75' type="date" id="date_transaction" value="<? echo date('Y-m-d') ?>"
                   name="to">
            <input class='btn btn-primary' type="submit">
        </form>
        <small class="font-weight-bolder">
            <?
            if (isset($_GET['to'])) {
                if (isset($_GET['from'])) {
                    if ($_GET['from'] == $_GET['to']) {
                        echo $_GET['to'];
                    } else {
                        echo $_GET['from'] . " <i class='fas fa-arrows-alt-h'></i> " . $_GET['to'];
                    }
                }
            }
            if (isset($_GET['year'])) {
                if (isset($_GET['month'])) {
                    echo $_GET['month'] . " " . $_GET['year'];
                } else {
                    echo $_GET['year'];
                }
            }
            ?>
        </small>
        <? selectCategory($con, implode("','", array(0, 1))) ?>
        <? select_type() ?>
        </form>
        <h4><? select_saldo($con, implode("','", array(0, 1))); ?></h4>

    </div>

    <div class="content mt-5  ">
        <h1 style="text-align: left;">Transakcje</h1>

        <h3><?
            if (isset($_GET['year'])) {
                if (isset($_GET['month'])) {
                    echo $_GET['month'] . " " . $_GET['year'];
                } else {
                    echo $_GET['year'];
                }
            }
            if (isset($_GET['from']) && ($_GET['to'])) {
                if ($_GET['from'] == $_GET['to']) {
                    echo $_GET['from'];
                } else {
                    echo $_GET['from'] . " <i class='fas fa-arrows-alt-h'></i> " . $_GET['to'];
                }
            }
            ?></h3>
        <? sql($con) ?>
        <!--    --><? //showDetails($con, 281)?>
    </div>


    <div class="details mt-5 border float-right ">
        <div class='position-fixed' id="edit">
<?selectTransaction($con);?>
        </div>

        <div id="insertData">
            <? if (isset($_GET['id_transaction'])) {
                echo "<script type='text/javascript'>
                    document.getElementById('edit').style.display ='block';
                    document.getElementById('insertData').style.display ='none';
                    </script>";
            }else {
                echo "<script type='text/javascript'>
                    document.getElementById('edit').style.display ='none';
                    document.getElementById('insertData').style.display ='block';
                    </script>";
            } ?>
            <div class="position-fixed ">
                <h5 class="mt-1">Dodawanie transakcji</h5>
                <form class="form mt-1 " action="insertData.php" method="post">
                    <div class="form-row  ">

                        <div class="form-group col-md-6">
                            <label for="date_transaction">Data transakcji:</label>
                            <input class='form-control' type="date" name="date_transaction"
                                   value="<? echo date('Y-m-d') ?>"
                                   required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="money">Kwota:</label>
                            <input class='form-control' type="text" placeholder="np. 356.42" name="money"
                                   required>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="id_category">Kategoria:</label>
                        <select class='form-control' id='id_category' name="id_category">
                            <? inputCategory($con) ?>
                        </select>
                    </div>

                    <div class="form-group  ">
                        <label for="comment">Dopisek:</label>
                        <input class='form-control ' name='comment' type="text">
                    </div>
                    <div class="form-group text-left ml-2">
                        <input class='' type="checkbox" name="standing_orders" id="standing_orders">
                        <label for="standing_orders">Zlecenie stałe</label>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary  " value="Potwierdz">
                </form>
            </div>

        </div>

    </div>
</div>

</body>
</html>
