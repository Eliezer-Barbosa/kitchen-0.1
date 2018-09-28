<?php
session_start();

$conn = require 'connection.php';
require('index.php');
require('sumHoursFromDB.php');
//require('calculateTips.php');
$result = $conn->query('SELECT * FROM employee');
$users = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" type="text/css" href="style.css" /> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <title>Showing employees</title>
    </head>
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
                        <th>Tips Due</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <?php $fmt = numfmt_create( 'de_DE', NumberFormatter::CURRENCY ); ?>
                        <tr>
                            <?php $user['tips_due'] = ($_POST['tips_week'] / $total) * $user['hours_worked'] - $user['expenses']; ?>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['position']; ?></td>
                            <td class="text-info"><?php echo $user['hours_worked']; ?></td>
                            <td class="text-danger"><?php echo numfmt_format_currency($fmt, $user['expenses'], "EUR"); ?></td>
                            <td class="text-success"><?php echo numfmt_format_currency($fmt, $user['tips_due'], "EUR"); ?></td>
                        </tr>
                        
                        <?php 
                            $id = $user['id'];
                            $tips_due = number_format($user['tips_due'], 2);
                            //echo "ID: ".$id.'<br>'.$tips_due.'<br>' ?? null;
                        
                            $stmt = $conn->prepare('UPDATE employee SET tips_due=? WHERE id = ?');
                            $stmt->bind_param('di', $tips_due, $id);
                            $stmt->execute();
                        ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h2>Tips of the week:</h2>
            <h3><?php echo numfmt_format_currency($fmt, $_POST['tips_week'], "EUR"); ?></h3> 
            <?php $_SESSION['tips_week_session'] = $_POST['tips_week']; ?>
        </div>
    </body>
</html>