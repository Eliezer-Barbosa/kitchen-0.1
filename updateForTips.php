<?php

$conn = require 'connection.php';

$result = $conn->query('SELECT * FROM employee');
$users = $result->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Set hours and expenses</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>

</head>
<?php
include("index.php");
?>
<body>
    <div class="container">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Hours worked</th>
                    <th>Expenses</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['position']; ?></td>
                    <td class="text-info"><?php echo $user['hours_worked']; ?></td>
                    <td class="text-danger"><?php echo '€'.$user['expenses']; ?></td>
                    <td><a href="setHoursAndExpenses.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Set hours and expenses</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
