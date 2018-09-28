<?php

session_start();

$conn = require 'connection.php';
$result = $conn->query('SELECT * FROM employee');
$users = $result->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Showing employees</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>

        <script>
            function ConfirmDelete(){
                if (confirm("Delete employee?")){
                    return true;
                }
                else {
                    alert('Cancelled');
                        return false;
                }
            } 
            function ConfirmEmail(){
                if (confirm("Send email?")){
                    return true;
                }
                else {
                    alert('Cancelled');
                        return false;
                }
                // alert('This feature is not available at the moment...'+'\n'+'Apologies');
                // return false;
            }
        </script>

    </head>
    <?php
        include("index.php");
    ?>
    <body>
        <div class="container">
            <div class="table-responsive-sm">
            <?php $fmt = numfmt_create( 'de_DE', NumberFormatter::CURRENCY ); ?>
            <h2>Tips of the week: <?php echo numfmt_format_currency($fmt, $_SESSION['tips_week_session'], "EUR"); ?></h2>
            <h2>Date: <?php echo date('d'.'/'.'m'.'/'.'Y'); ?></h2>
            <h2>Time: <?php echo date("H:i:s"); ?></h2>
            <div style="overflow-x:auto;">
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
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['position']; ?></td>
                            <td class="text-info" align="center"><?php echo $user['hours_worked']; ?></td>
                            <td class="text-danger"><?php echo numfmt_format_currency($fmt, $user['expenses'], "EUR"); ?></td>
                            <td class="text-success"><?php echo numfmt_format_currency($fmt, $user['tips_due'], "EUR"); ?></td>

                            <td>
                                <a href="update.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Update</a>
                            </td>

                            <td>
                                <form action="delete.php?id=<?php echo $user['id']; ?>" method="POST" onsubmit="return ConfirmDelete()">  
                                    <input type="submit" name="submit" value="Delete" class="btn btn-danger"/>
                                </form>
                            </td>

                            <td>
                                <form action="sendEmail.php?id=<?php echo $user['id']; ?>" method="POST" onsubmit="return ConfirmEmail()">  
                                    <input type="submit" name="submit" value="Send Email" class="btn btn-warning"/>
                                </form>
                            </td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            </div>
            </div>
        </div>
    </body>
</html>
