<?php
// Start the session
session_start();
//Databse Connection file
include('config.php');
if (isset($_POST['submit'])) {
	//getting the post values
	$staffID = $_SESSION["staffID"];
	$code = $_POST['code'];
	$name = $_POST['name'];
	$credit = $_POST['credit'];
	$startDate = $_POST['start_date'];

	$credit = "";
	$creditErr = "";
	$isValid = true;
	// Validate password
	if (empty(inputFilter($_POST["credit"]))) {
		$creditErr = "Please enter a credit.";
		$isValid = false;
	} elseif (intval($_POST["credit"]) > 4 || intval($_POST["credit"]) < 0) {
		$creditErr = "Credit should be positive integer between 0 to 4";
		$isValid = false;
	} else {
		$credit = inputFilter($_POST["credit"]);
	}
	echo intval($_POST["credit"]); echo $isValid;
	if ($isValid) {
		// Query for data insertion
		$sql = "INSERT INTO subject (code,name, credit,start_date,staff_id) VALUES (?, ?, ?, ?, ?)";
		if ($stmt = mysqli_prepare($con, $sql)) {
			mysqli_stmt_bind_param($stmt, "ssdss", $code, $name, $credit, $startDate, $staffID);
			if (mysqli_stmt_execute($stmt)) {
				echo "<script>alert('You have successfully inserted the data');</script>";
				echo "<script type='text/javascript'> document.location ='home.php'; </script>";
			} else {
				echo "<script>alert('Something Went Wrong. Please try again');</script>";
			}

			// Close statement
			mysqli_stmt_close($stmt);
		}
	}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
	<title>PHP Crud Operation!!</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<style>
		body {
			color: #fff;
			background: #63738a;
			font-family: 'Roboto', sans-serif;
		}

		.form-control {
			height: 40px;
			box-shadow: none;
			color: #969fa4;
		}

		.form-control:focus {
			border-color: #5cb85c;
		}

		.form-control,
		.btn {
			border-radius: 3px;
		}

		.required::before {
			content: " *";
			color: red;
		}

		.signup-form {
			width: 450px;
			margin: 0 auto;
			padding: 30px 0;
			font-size: 15px;
		}

		.signup-form h2 {
			color: #636363;
			margin: 0 0 15px;
			position: relative;
			text-align: center;
		}

		.signup-form h2:before,
		.signup-form h2:after {
			content: "";
			height: 2px;
			width: 25%;
			background: #d4d4d4;
			position: absolute;
			top: 50%;
			z-index: 2;
		}

		.signup-form h2:before {
			left: 0;
		}

		.signup-form h2:after {
			right: 0;
		}

		.signup-form .hint-text {
			color: #999;
			margin-bottom: 30px;
			text-align: center;
		}

		.signup-form form {
			color: #999;
			border-radius: 3px;
			margin-bottom: 15px;
			background: #f2f3f7;
			box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			padding: 30px;
		}

		.signup-form .form-group {
			margin-bottom: 20px;
		}

		.signup-form input[type="checkbox"] {
			margin-top: 3px;
		}

		.signup-form .btn {
			font-size: 16px;
			font-weight: bold;
			min-width: 140px;
			outline: none !important;
		}

		.signup-form .row div:first-child {
			padding-right: 10px;
		}

		.signup-form .row div:last-child {
			padding-left: 10px;
		}

		.signup-form a {
			color: #fff;
			text-decoration: underline;
		}

		.signup-form a:hover {
			text-decoration: none;
		}

		.signup-form form a {
			color: #5cb85c;
			text-decoration: none;
		}

		.signup-form form a:hover {
			text-decoration: underline;
		}
	</style>
</head>

<body>
	<div class="signup-form">
		<form method="POST">
			<h2>Add Subject</h2>
			<p class="hint-text">Fill below form.</p>
			<div class="form-group">
				<label>Code</label>
				<input type="text" class="form-control" name="code" placeholder="123456" required="true">
			</div>
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" placeholder="Math" required="true">
			</div>
			<div class="form-group">
				<label>Credit</label>
				<input type="text" class="form-control" name="credit" placeholder="4" required="true">
				<span class="required">
					<?php echo $creditErr; ?>
				</span>
			</div>
			<div class="form-group">
				<label>Start Date</label>
				<input type="date" name="start_date">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Submit</button>
			</div>
		</form>
		<div class="text-center">View Aready Inserted Data!! <a href="home.php">View</a></div>
	</div>
	<div align="center">
		<a href="logout.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i>
			<span>Logout</span></a>

	</div>
</body>

</html>