<?php
include "config.php";

$staffID = $name = $password = $confirmPassword = $email = $dateOfBirth = $cellphone = "";
$staffIDErr = $nameErr = $passwordErr = $confirmPasswordErr = $emailErr = $dateOfBirthErr = $cellphoneErr = "";
$isValid = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate staffID
    if (empty(inputFilter($_POST["staffID"]))) {
        $staffIDErr = "Please enter a staffID.";
        $isValid = false;
    } elseif (!preg_match('/^\d{4}$/', inputFilter($_POST["staffID"]))) {
        $staffIDErr = "Staff ID can only contain 4 digits.";
        $isValid = false;
    } else {
        // Prepare a select statement
        $sql = "SELECT staff_id FROM teacher WHERE staff_id = ?";
        $staffID = $_POST["staffID"];

        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $staffID);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);
                $count = mysqli_stmt_num_rows($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $staffIDErr = "This staff id is already taken.";
                    $isValid = false;
                } else {
                    $staffID = inputFilter($_POST["staffID"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(inputFilter($_POST["password"]))) {
        $passwordErr = "Please enter a password.";
        $isValid = false;
    } elseif (strlen(inputFilter($_POST["password"])) < 8) {
        $passwordErr = "Password must have atleast 8 characters.";
        $isValid = false;
    } else {
        $password = inputFilter($_POST["password"]);
    }

    // Validate confirm password
    if (empty(inputFilter($_POST["confirmPassword"]))) {
        $confirmPasswordErr = "Please confirm password.";
        $isValid = false;
    } else {
        $confirmPassword = inputFilter($_POST["confirmPassword"]);
        if ($password != $confirmPassword) {
            $confirmPasswordErr = "Password did not match.";
            $isValid = false;
        }
    }

    // Validate email
    if (empty(inputFilter($_POST["name"]))) {
        $nameErr = "Please enter your name.";
        $isValid = false;
    } else {
        $name = inputFilter($_POST["name"]);
    }

    // Validate email
    if (empty(inputFilter($_POST["email"]))) {
        $emailErr = "Please enter a staffID.";
        $isValid = false;
    } elseif (!preg_match('/([\w\-]+\@[\w\-]+\.[\w\-]+)/', inputFilter($_POST["email"]))) {
        $emailErr = "Invalid Email Format.";
        $isValid = false;
    } else {
        $email = inputFilter($_POST["email"]);
    }

    // Validate date of birth
    if (empty(inputFilter($_POST["dateOfBirth"]))) {
        $dateOfBirthErr = "Please pick a date.";
    } else {
        $dateOfBirth = inputFilter($_POST["dateOfBirth"]);
    }

    // Validate cellphone
    if (empty(inputFilter($_POST["cellphone"]))) {
        $cellphoneErr = "Please enter Cellphone number.";
        $isValid = false;
    } elseif (!preg_match('/^\d{10}$/', inputFilter($_POST["cellphone"]))) {
        $cellphoneErr = "Cellphone can only contain 10 digits.";
        $isValid = false;
    } else {
        $cellphone = inputFilter($_POST["cellphone"]);
    }

    // Check input errors before inserting in database
    if ($isValid) {
        // Prepare an insert statement
        $sql = "INSERT INTO teacher (staff_id, name, password, email, date_of_birth, cellphone) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($con, $sql)) {
            $param_password = md5(base64_encode($password)); // Creates a password hash
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $staffID, $name, $param_password, $email, $dateOfBirth, $cellphone);
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: index.php");
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
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
                <label>Name</label>
                <input type="text" name="name"
                    class="form-control <?php echo (!empty($nameErr)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $name; ?>">
                <span class="invalid-feedback">
                    <?php echo $nameErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                    class="form-control <?php echo (!empty($passwordErr)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $password; ?>">
                <span class="invalid-feedback">
                    <?php echo $passwordErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmPassword"
                    class="form-control <?php echo (!empty($confirmPasswordErr)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $confirmPassword; ?>">
                <span class="invalid-feedback">
                    <?php echo $confirmPasswordErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email"
                    class="form-control <?php echo (!empty($emailErr)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $email; ?>">
                <span class="invalid-feedback">
                    <?php echo $emailErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Date Of Birth</label>
                <input type="date" id="dateOfBirth" name="dateOfBirth" />
                <span class="invalid-feedback">
                    <?php echo $dateOfBirthErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Cellphone</label>
                <input type="text" name="cellphone"
                    class="form-control <?php echo (!empty($cellphoneErr)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $cellphone; ?>">
                <span class="invalid-feedback">
                    <?php echo $cellphoneErr; ?>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>
</body>

</html>