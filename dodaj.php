<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="../css/style.css" rel="stylesheet" type="text/css">

    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.css'>
    <title>Transakcje</title>
</head>
<body class="bg-white">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<div class="grid_reg_log">
    <div class="navbar">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="transactions.php">Transakcje</a></li>
                <li class="nav-item"><a class="nav-link" href="expense.php"></i>Wydatki</a></li>
                <li class="nav-item"><a class="nav-link" href="income.php"></i>Przychody</a></li>
                <li class="nav-item"><a class="nav-link" href="planner.php"></i>Kalendarz</a></li>
                <li class="nav-item"><a class="nav-link" href="../dbbudget.php"">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="contanct.php">Kontakt</a></li>
            </ul>
        </nav>
    </div>
    <div class="form">

        <form class="form-col">

            <div class="form-group row">
                <label  for="inputMoney">Money</label>
                <input class="form-control" type="number" id="inputMoney">
            </div>

            <div class="form-group row ">
                <label  for="inputDate">Date transaction</label>
                <input class="form-control" type="date" id="inputDate">
            </div>
            <div class="form-group row">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label  id="inlineRadio1">Income</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option1">
                <label  id="inlineRadio2">Expense</label>
            </div>
            </div>

            <div class="form-group row">
                <label  for="inpuCategory">Category</label>
                <select class="form-control" id="inpuCategory" >
                    <option selected>Select category</option>
                    <option>Rozrywka</option>
                    <option>Praca</option>
                </select>
            </div>

            <div class="form-group row">
                <label  for="inputComment">More details</label>
                <textarea class="form-control" type="text" id="inputComment"></textarea>
            </div>




        </form>
    </div>
</div>

</body>
</html>