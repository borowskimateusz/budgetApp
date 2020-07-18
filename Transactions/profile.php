<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
require_once 'dbbudget.php';
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT username, password, email FROM accounts WHERE id_user = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id_user']);
$stmt->execute();
$stmt->bind_result($username, $password, $email);
$stmt->fetch();
$stmt->close();




?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="../css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Budzet domowy</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                <a href="transactions.php"><i class="fas fa-wallet"></i>Transactions</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                <a href="../server/tasks.php"><i class="fas fa-sign-out-alt"></i>Tasks</a>

			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
                <table>
                <tr>
                    <td><i  class="fas fa-user-alt fa-10x "></i></td>
                </tr>
                </table>
				<table>

					<tr>
						<td>Username:  <?=$username?></td>
                        <td><?=$result?></td>

					</tr>
					<tr>
						<td>Time:</td>

					</tr>
					<tr>
						<td>Email:  <?=$sqlmoney?></td>

					</tr>
				</table>
			</div>
		</div>
	</body>
</html>