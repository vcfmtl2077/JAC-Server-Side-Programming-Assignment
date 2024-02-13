<?php
$emailErr = $pwdErr = $firstNameErr = $lastNameErr = $phoneErr = $addressErr = $townErr = $regionErr = $postcodeErr = $countryErr = "";
$email = $password = $confirm_password = $first_name = $last_name = $phone_number = $address = $town = $region = $postcode = $country = "";
$isValid = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["email"])) {
        $emailErr = "Email required";
        $isValid = false;
    } else {
        $email = inputFilter($_POST["email"]);
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
            $emailErr = "Invalid Email Format.";
            $isValid = false;
        }
    }


    if (empty($_POST["password"]) or empty($_POST["confirm_password"])) {
        $pwdErr = "password required";
        $isValid = false;
    } else {
        $password = inputFilter($_POST["password"]);
        $confirm_password = inputFilter($_POST["confirm_password"]);

        if ($password !== $confirm_password) {
            $pwdErr = "Password not matched.";
            $isValid = false;
        }

        if (strlen($password) < 10 || !preg_match("/\A(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9]).{10,}\z/", $password)) {
            $pwdErr = "Invalide pasword format.";
            $isValid = false;
        }
    }

    if (empty($_POST["first_name"])) {
        $firstNameErr = "password required";
        $isValid = false;
    } else {
        $first_name = inputFilter($_POST["first_name"]);

        if (!preg_match("/^[A-Z]{1,10}$/", $first_name)) {
            $firstNameErr = "First name must have up to 10 chars, only uppercase letters, with no space.";
            $isValid = false;
        }
    }

    if (empty($_POST["last_name"])) {
        $lastNameErr = "password required";
        $isValid = false;
    } else {
        $last_name = inputFilter($_POST["last_name"]);

        if (!preg_match("/^[A-Z]{1,15}\s?$/", $last_name)) {
            $lastNameErr = "Last name must have up to 15 chars, only uppercase letters, with no more than one blank space.";
            $isValid = false;
        }
    }

    if (empty($_POST["phone_number"])) {
        $phoneErr = "password required";
        $isValid = false;
    } else {
        $phone_number = inputFilter($_POST["phone_number"]);

        if (!preg_match("/^\+[0-9]{1,15}$/", $phone_number)) {
            $phoneErr = "Phone number entry should start with a ‘+’ followed by up to 15 digits.";
            $isValid = false;
        }
    }

    if (empty($_POST["address"])) {
        $addressErr = "password required";
        $isValid = false;
    } else {
        $address = inputFilter($_POST["address"]);

        if (!preg_match("/\d+\s+[\w\s]+/", $address)) {
            $addressErr = "Address entry should contain street number and street name separated with a blank space.";
            $isValid = false;
        }
    }

    if (empty($_POST["town"])) {
        $townErr = "password required";
        $isValid = false;
    } else {
        $town = inputFilter($_POST["town"]);

        if (!preg_match("/^[^\s]{1,15}$/", $town)) {
            $townErr = "Town is an optional entry with up to 15 characters without space.";
            $isValid = false;
        }
    }

    if (empty($_POST["region"])) {
        $regionErr = "password required";
        $isValid = false;
    } else {
        $region = inputFilter($_POST["region"]);

        if (!preg_match("/^[A-Z]{2,3}$/", $region)) {
            $regionErr = "Region entry takes between 2 to 3 letters [A-Z].";
            $isValid = false;
        }
    }

    if (empty($_POST["postcode"])) {
        $postcodeErr = "password required";
        $isValid = false;
    } else {
        $postcode = inputFilter($_POST["postcode"]);

        if (!preg_match("/^[A-Z][0-9][A-Z]\s[0-9][A-Z][0-9]$/", $postcode)) {
            $postcodeErr = "Invalid postcode format. Expected format: A1A 1A1.";
            $isValid = false;
        }
    }

    if (empty($_POST["country"])) {
        $countryErr = "password required";
        $isValid = false;
    } else {
        $country = inputFilter($_POST["country"]);

        if (!preg_match("/^[A-Z][a-z]{3,14}$/", $country)) {
            $countryErr = "Country must start with an uppercase letter followed by 3 to 14 lowercase letters.";
            $isValid = false;
        }
    }

    if ($isValid) {
        $filename = "userdata.txt";
        $file = fopen($filename, "w");
        if ($file === false) {
            echo "Error in opening file";
            exit();
        }
        $content = "";
        $content .= "email=$email;";
        $content .= "password=$password;";
        $content .= "first_name=$first_name;";
        $content .= "last_name=$last_name;";
        $content .= "phone_number=$phone_number;";
        $content .= "address=$address;";
        $content .= "town=$town;";
        $content .= "region=$region;";
        $content .= "postcode=$postcode;";
        $content .= "country=$postccountryode;";

        // file_put_contents($filename, $content);
        fwrite($file, $content);
        fclose($file);
        $filePath = dirname(__FILE__) . '/' . $filename;

        echo 'File created successfully. <br> View User Page.<a href="user.php">User Page</a> <br>';
        echo 'View User Data File. <a href="userdata.txt">User File</a> <br>';

    }

}


function inputFilter($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 450px;
            margin: 0 auto;
            padding-top: 20px;
        }

        form {
            background: #f7f7f7;
            padding: 40px;
            border: 1px solid #e1e1e1;
            border-radius: 5px;
        }

        h2 {
            text-align: center;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input[type="text"],
        .input-group input[type="password"],
        .input-group input[type="email"],
        .input-group input[type="tel"],
        .input-group select {
            width: 100%;
            padding: 5px;
            border: 1px solid #e1e1e1;
            border-radius: 4px;
        }

        .required:after {
            content: " *";
            color: red;
        }

        .submit {
            text-align: center;
            display: block;
        }

        .submit input[type="submit"] {
            width: 40%%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }

        .submit input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>USER REGISTRATION</h2>
            <p>Fields marked <span class="required"></span> are required.</p>
            <div class="input-group">
                <label class="required" for="email">Email</label>
                <input type="email" name="email" id="email">
                <span class="required">
                    <?php echo $emailErr; ?>
                </span>
            </div>
            <div class="input-group">
                <label class="required" for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="input-group">
                <label class="required" for="confirm_password">Retype Password</label>
                <input type="password" name="confirm_password" id="confirm_password">
                <span class="required">
                    <?php echo $pwdErr; ?>
                </span>
            </div>
            <div class="input-group">
                <label class="required" for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name">
                <span class="required">
                    <?php echo $firstNameErr; ?>
                </span>
            </div>
            <div class="input-group">
                <label class="required" for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name">
                <span class="required">
                    <?php echo $lastNameErr; ?>
                </span>
            </div>
            <div class="input-group">
                <label class="required" for="phone_number">Phone Number</label>
                <input type="tel" name="phone_number" id="phone_number">
                <span class="required">
                    <?php echo $phoneErr; ?>
                </span>
            </div>
            <div class="input-group">
                <label class="required" for="address">Address</label>
                <input type="text" name="address" id="address">
                <span class="required">
                    <?php echo $addressErr; ?>
                </span>
            </div>
            <div class="input-group">
                <label for="town">Town</label>
                <input type="text" name="town" id="town">
                <span class="required">
                    <?php echo $townErr; ?>
                </span>
            </div>
            <div class="input-group">
                <label class="required" for="region">Region</label>
                <input type="text" name="region" id="region">
                <span class="required">
                    <?php echo $regionErr; ?>
                </span>
            </div>
            <div class="input-group">
                <label class="required" for="postcode">Postcode / Zip</label>
                <input type="text" name="postcode" id="postcode">
                <span class="required">
                    <?php echo $postcodeErr; ?>
                </span>
            </div>
            <div class="input-group">
                <label class="required" for="country">Country</label>
                <input type="text" name="country" id="country">
                <span class="required">
                    <?php echo $countryErr; ?>
                </span>
            </div>
            <div class="submit">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>

</html>