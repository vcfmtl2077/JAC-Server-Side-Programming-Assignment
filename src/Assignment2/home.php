<?php
// Start the session
session_start();
//database conection  file
include('config.php');
$staffID = $_SESSION['staffID'];
if (isset($_GET['isbn'])) {
    $isbn = intval($_GET['isbn']);
    $sql = mysqli_query($con, "delete from book where isbn=$isbn and staff_id=$staffID");
    echo "<script>alert('Data deleted');</script>";
    echo "<script>window.location.href = 'home.php'</script>";
}
if (isset($_GET['code'])) {
    $code = intval($_GET['code']);
    $sql = mysqli_query($con, "delete from subject where code=$code and staff_id=$staffID");
    echo "<script>alert('Data deleted');</script>";
    echo "<script>window.location.href = 'home.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Elegant Table Design</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            font-size: 15px;
            padding-bottom: 10px;
            margin: 0 0 10px;
            min-height: 45px;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title select {
            border-color: #ddd;
            border-width: 0 0 1px 0;
            padding: 3px 10px 3px 5px;
            margin: 0 5px;
        }

        .table-title .show-entries {
            margin-top: 7px;
        }

        .search-box {
            position: relative;
            float: right;
        }

        .search-box .input-group {
            min-width: 200px;
            position: absolute;
            right: 0;
        }

        .search-box .input-group-addon,
        .search-box input {
            border-color: #ddd;
            border-radius: 0;
        }

        .search-box .input-group-addon {
            border: none;
            border: none;
            background: transparent;
            position: absolute;
            z-index: 9;
        }

        .search-box input {
            height: 34px;
            padding-left: 28px;
            box-shadow: none !important;
            border-width: 0 0 1px 0;
        }

        .search-box input:focus {
            border-color: #3FBAE4;
        }

        .search-box i {
            color: #a0a5b1;
            font-size: 19px;
            position: relative;
            top: 8px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child {
            width: 130px;
        }

        table.table td a {
            color: #a0a5b1;
            display: inline-block;
            margin: 0 5px;
        }

        table.table td a.view {
            color: #03A9F4;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #E34724;
        }

        table.table td i {
            font-size: 19px;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            padding: 0 10px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 30px !important;
            text-align: center;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-5">
                            <h2>Book List</b></h2>
                        </div>
                        <div class="col-sm-7" align="right">
                            <a href="addBook.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i>
                                <span>Add New Book</span></a>

                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ISBN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Price</th>
                            <th>Publish Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ret = mysqli_query($con, "select isbn,title,author,price,date_of_publication as dateOfPub from book where staff_id='$staffID'");
                        $cnt = 1;
                        $row = mysqli_num_rows($ret);
                        if ($row > 0) {
                            while ($row = mysqli_fetch_array($ret)) {

                                ?>
                                <!--Fetch the Records -->
                                <tr>
                                    <td>
                                        <?php echo $cnt; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['isbn']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['title']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['author']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['price']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['dateOfPub']; ?>
                                    </td>
                                    <td>
                                        <a href="editBook.php?isbn=<?php echo htmlentities($row['isbn']); ?>" class="edit"
                                            title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                        <a href="home.php?isbn=<?php echo ($row['isbn']); ?>" class="delete" title="Delete"
                                            data-toggle="tooltip" onclick="return confirm('Do you really want to Delete ?');"><i
                                                class="material-icons">&#xE872;</i></a>
                                    </td>
                                </tr>
                                <?php
                                $cnt = $cnt + 1;
                            }
                        } else {

                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-5">
                            <h2>Subject List</b></h2>
                        </div>
                        <div class="col-sm-7" align="right">
                            <a href="addSubject.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i>
                                <span>Add New Subject</span></a>

                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Credits</th>
                            <th>Start Date</th>
                            <th>Publish Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ret = mysqli_query($con, "select code,name,credit,start_date as startDate from subject where staff_id='$staffID'");
                        $cnt = 1;
                        $row = mysqli_num_rows($ret);
                        if ($row > 0) {
                            while ($row = mysqli_fetch_array($ret)) {

                                ?>
                                <!--Fetch the Records -->
                                <tr>
                                    <td>
                                        <?php echo $cnt; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['code']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['credit']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['startDate']; ?>
                                    </td>
                                    <td>
                                        <a href="editSubject.php?code=<?php echo htmlentities($row['code']); ?>" class="edit"
                                            title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                        <a href="home.php?code=<?php echo ($row['code']); ?>" class="delete" title="Delete"
                                            data-toggle="tooltip" onclick="return confirm('Do you really want to Delete ?');"><i
                                                class="material-icons">&#xE872;</i></a>
                                    </td>
                                </tr>
                                <?php
                                $cnt = $cnt + 1;
                            }
                        } else {

                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div align="center">
        <a href="logout.php" class="btn btn-secondary"></i>
            <span>Logout</span></a>

    </div>
</body>

</html>