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


    if (!isset($_SESSION['loggedin'])) {
        header('Location: tasks.php');
        exit();

    }



// initialize errors variable
    $errors = "";

// connect to database


// insert a quote if submit button is clicked
    if (isset($_POST['submit'])) {
        if (empty($_POST['task'])) {
            $errors = "You must fill in the task";
        } else {
            $task = $_POST['task'];
            $sql = "INSERT INTO tasks (task) VALUES ('$task')";
            mysqli_query($con, $sql);
            header('location: tasks.php');
        }
    }
    if (isset($_GET['del_task'])) {
        $id_task = $_GET['del_task'];

        mysqli_query($con, "DELETE FROM tasks WHERE id_task=" . $id_task);
        header('location: tasks.php');
    }



?>


<!DOCTYPE html>
<html>
<head>
	<title>ToDo List Application PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<script>
    function myFunction() {
        alert( <?$i?>);
    }
</script>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">ToDo List Application PHP and MySQL database</h2>
	</div>
	<form method="post" action="tasks.php" class="input_form">
        <?php if (isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
        <?php } ?>
		<input type="text" name="task" class="task_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>
    <table>

        <tr>
            <td class="first">NR</td>
            <td>Tasks</td>
            <td style="width: 60px;">Action</td>
        </tr>


        <tbody>
        <?php
        // select all tasks if page is visited or refreshed
        $tasks = mysqli_query($con, "SELECT * FROM tasks");

        $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
            <form method="post" action="tasks.php" id = "checkbox">
            <tr>
                <td class="first"> <?php echo $i; ?> </td>
                <td class="task"> <?php echo $row['task']; ?> </td>
                <td> <button onclick ="myFunction()" />BUTTON </td>
                <td class="delete">
                    <a href="tasks.php?del_task=<?php echo $row['id_task'] ?>">x</a>
                </td>
            </tr>
            </form>
            <?php $i++; } ?>
        </tbody>
    </table>

</body>
</html>