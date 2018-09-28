<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$conn = require('connection.php');

$name = $_POST['name'];
$position = $_POST['position'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO employee (name, position,email) VALUES (?,?,?)");
$stmt->bind_param("sss", $name, $position, $email);
$stmt->execute();

header('location: see.php');
die();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Add new employee</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>
    </head>
    <?php
    include("index.php");
    ?>
    <body>
        <div class="container">
            <!-- <h2>Add new employee</h2> -->
            <form action="add.php" method='POST'>
                <fieldset>
                    <legend>New employee</legend>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter the employee's name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Position:</label>
                        <input type="text" class="form-control" placeholder="Enter the employee's position" name="position" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" placeholder="Enter the employee's email" name="email">
                    </div>
                    <input type="submit" value="Add" class="btn btn-success">
                </fieldset>
                
            </form>
        </div>
    </body>
</html>
