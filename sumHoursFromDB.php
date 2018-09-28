<?php

$conn = require 'connection.php';

$result = $conn->query('SELECT SUM(hours_worked) as total FROM employee');
$users = $result->fetch_all(MYSQLI_ASSOC);

 foreach ($users as $user) {
   $total = $user['total'];
//     echo "Sum of kitchen hours: ".$user['total'];
//     echo "<br>";
 }
// var_dump($total);
// $_POST['total'];
