<?php
$studentName = $guardianName = $contact = $email = $address = $class = $shift = $gender = $bloodGroup = $division = "";
$studentNameErr = $guardianNameErr = $contactEr = $emailErr = $addressErr = $classErr = $shiftErr = $genderErr = $bloodGroupErr = $divisionErr = "";
$isValid = true;

if (empty($_POST["studentName"])) {
    $studentNameErr = "Student Name required";
    $isValid = false;
} else {
    $studentName = inputFilter($_POST["studentName"]);
    $_SESSION['studentName'] = $studentName;
    if (!preg_match("/\b[A-Z][a-z]{0,9}\s[A-Z][a-z]{0,9}\b/", $studentName)) {
        $studentNameErr = "Invalid Student Name Format. Example: John Smith";
        $isValid = false;
    }
}

if (empty($_POST["guardianName"])) {
    $guardianNameErr = "Guardian Name required";
    $isValid = false;
} else {
    $guardianName = inputFilter($_POST["guardianName"]);
    $_SESSION['guardianName'] = $guardianName;
    if (!preg_match("/\b[A-Z][a-z]{0,9}\s[A-Z][a-z]{0,9}\b/", $guardianName)) {
        $guardianNameErr = "Invalid Guardian Name Format. Example: John Smith";
        $isValid = false;
    }
}

if (empty($_POST["contact"])) {
    $contactErr = "Contact Number required";
    $isValid = false;
} else {
    $contact = inputFilter($_POST["contact"]);
    $_SESSION['contact'] = $contact;
    if (!preg_match("/^001(514|438)\d{7}$/", $contact)) {
        $contactErr = "Invalid Contact Number Format. Example: 0015141234567";
        $isValid = false;
    }
}

if (empty($_POST["email"])) {
    $emailErr = "Email required";
    $isValid = false;
} else {
    $email = inputFilter($_POST["email"]);
    $_SESSION['email'] = $email;
    if (!preg_match("/^[a-zA-Z]+\.[a-zA-Z]+@johnabbottcollege\.net$/", $email)) {
        $emailErr = "Invalid Email Format. Example: firstname.lastname@johnabbottcollege.net";
        $isValid = false;
    }
}

if (empty($_POST["address"])) {
    $addressErr = "Address required";
    $isValid = false;
} else {
    $address = inputFilter($_POST["address"]);
    $_SESSION['address'] = $address;
    if (!preg_match("/^H[12349][ABGJHPRWXY]$/", $address)) {
        $addressErr = "Invalid Address. A Montreal 3 digits Postal Code Example: H1A";
        $isValid = false;
    }
}

if (empty($_POST["class"])) {
    $classErr = "Class required";
    $isValid = false;
} else {
    $class = inputFilter($_POST["class"]);
    $_SESSION['class'] = $class;
    if (!preg_match("/^(?=.{1,8}programming).{1,20}$/", $class)) {
        $classErr = "Invalid Class Format. Example: java programming";
        $isValid = false;
    }
}

if (empty($_POST["shift"])) {
    $shiftErr = "Shift required";
    $isValid = false;
} else {
    $shift = inputFilter($_POST["shift"]);
    $_SESSION['shift'] = $_POST["shift"];
}

if (empty($_POST["gender"])) {
    $genderErr = "Gender required";
    $isValid = false;
} else {
    $gender = inputFilter($_POST["gender"]);
    $_SESSION['gender'] = $_POST["gender"];
}

if (empty($_POST["bloodGroup"])) {
    $bloodGroupErr = "Blood Group required";
    $isValid = false;
} else {
    $bloodGroup = inputFilter($_POST["bloodGroup"]);
    $_SESSION['bloodGroup'] = $bloodGroup;
    if (!preg_match("/^(A|B|O|AB)[+-]$/", $bloodGroup)) {
        $bloodGroupErr = "Invalid Blood Group Format. Example: A+, A-, B+, B-, O+, O-, AB+ or AB-";
        $isValid = false;
    }
}

if (empty($_POST["division"])) {
    $divisionErr = "Division required";
    $isValid = false;
} else {
    $division = inputFilter($_POST["division"]);
    $_SESSION['division'] = $division;
    if (!preg_match("/^(MAP|map)(\s)?08$/", $division)) {
        $divisionErr = "Invalid Division Format. Example: MAP08 or map 08";
        $isValid = false;
    }
}

if ($isValid) {
    $filename = "student.txt";
    $file = fopen($filename, "a");
    if ($file === false) {
        echo "Error in opening file";
        exit();
    }
    $content = "";
    $content .= "studentName=$studentName;";
    $content .= "guardianName=$guardianName;";
    $content .= "contact=$contact;";
    $content .= "email=$email;";
    $content .= "address=$address;";
    $content .= "class=$class;";
    $content .= "shift=$shift;";
    $content .= "gender=$gender;";
    $content .= "bloodGroup=$bloodGroup;";
    $content .= "division=$division;";

    fwrite($file, $content);
    fclose($file);
    header("Location: user.php");
    exit();

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
    <title>Admission Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #6c549c;
            color: white;
            padding: 10px 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }

        .required:before {
            content: " *";
            color: red;
        }

        form {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type=text],
        .form-group input[type=email],
        .form-group input[type=contact],
        .form-group select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type=radio] {
            margin-right: 5px;
        }

        .form-group .radio-label {
            display: inline-block;
            margin-right: 15px;
        }

        .submit-btn {
            background-color: #6c549c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Admission Form</h2>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="studentName">Student Name</label>
                <input type="text" id="studentName" name="studentName" value="<?php echo $_SESSION['studentName'] ?>">
                <span class="required">
                    <?php echo $studentNameErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label for="guardianName">Guardian Name</label>
                <input type="text" id="guardianName" name="guardianName"
                    value="<?php echo $_SESSION['guardianName'] ?>">
                <span class="required">
                    <?php echo $guardianNameErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="contact" id="contact" name="contact" value="<?php echo $_SESSION['contact'] ?>">
                <span class="required">
                    <?php echo $contactErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $_SESSION['email'] ?>">
                <span class="required">
                    <?php echo $emailErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo $_SESSION['address'] ?>">
                <span class="required">
                    <?php echo $addressErr; ?>
                </span>
            </div>

            <div class="form-group">
                <label for="class">Class</label>
                <input type="text" id="class" name="class" value="<?php echo $_SESSION['class'] ?>">
                <span class="required">
                    <?php echo $classErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label for="shift">Shift</label>
                <select id="shift" name="shift">
                    <option value="9:00-13:00">9:00-13:00</option>
                    <option value="16:00-20:00">16:00-20:00</option>
                </select>
                <span class="required">
                    <?php echo $shiftErr; ?>
                </span>
            </div>
            <div class="form-group">
                <span class="radio-label"><label>Gender</label></span>
                <label class="radio-label"><input type="radio" name="gender" value="male"> Male</label>
                <label class="radio-label"><input type="radio" name="gender" value="female"> Female</label>
                <label class="radio-label"><input type="radio" name="gender" value="others"> Others</label>
                <span class="required">
                    <?php echo $genderErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label for="bloodGroup">Blood Group</label>
                <input type="text" id="bloodGroup" name="bloodGroup" value="<?php echo $_SESSION['bloodGroup'] ?>">
                <span class="required">
                    <?php echo $bloodGroupErr; ?>
                </span>
            </div>
            <div class="form-group">
                <label for="division">Division</label>
                <input type="text" id="division" name="division" value="<?php echo $_SESSION['division'] ?>">
                <span class="required">
                    <?php echo $divisionErr; ?>
                </span>
            </div>
            <div class="submit-btn">
                <input type="submit" value="Submit">
            </div>
        </form>