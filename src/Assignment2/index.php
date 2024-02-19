<?php
// Start the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: home.php");
    exit;
}

// Include config file
include "config.php";

// Define variables and initialize with empty values
$staffID = $password = "";
$staffIDErr = $password_err = $login_err = "";
$isValid = true;

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(inputFilter($_POST["staffID"]))) {
        $staffIDErr = "Please enter staff ID.";
        $isValid=false;
    } else {
        $staffID = inputFilter($_POST["staffID"]);
    }

    // Check if password is empty
    if (empty(inputFilter($_POST["password"]))) {
        $password_err = "Please enter your password.";
        $isValid=false;
    } else {
        $password = inputFilter($_POST["password"]);
    }
    // Validate credentials
    if ($isValid) {
        // Prepare a select statement
        $sql = "SELECT staff_id, password FROM teacher WHERE staff_id = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $staffID);
            $param_password = md5(base64_encode($password)); 
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                $result = mysqli_stmt_get_result($stmt);
                $user = $result->fetch_assoc();
                // Check if username exists, if yes then verify password
                if ($param_password==$user['password']) {
                    // Password is correct, so start a new session
                    session_start();

                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["staffID"] = $staffID;

                    header("location: home.php");
                } else {
                    // Password is not valid, display a generic error message
                    $login_err = "Invalid staffID or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
    <div class="wrapper">
        <h2>Sign In As Teacher</h2>
        <p>Please fill in your credentials to login.</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Staff ID</label>
                <input type="text" name="staffID"
                    class="form-control <?php echo (!empty($staffIDErr)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $staffID; ?>">
                <span class="invalid-feedback">
                    <?php echo $staffIDErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                    class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback">
                    <?php echo $password_err; ?>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Register As Teacher <a href="signup.php">Sign up now</a>.</p>
        </form>
    </div>
</body>

</html>