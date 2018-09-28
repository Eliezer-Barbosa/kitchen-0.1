<?php
$conn = require('connection.php');

$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hours_worked = $_POST['hours_worked'] ?? null;
    $expenses = number_format($_POST['expenses'], 2) ?? null;

    $stmt = $conn->prepare('UPDATE employee SET hours_worked=?, expenses=? WHERE id=?');
    $stmt->bind_param('ddi', $hours_worked, $expenses, $id);
    $stmt->execute();

    header('location: updateForTips.php');
    die();
}

$stmt = $conn->prepare('SELECT * FROM employee WHERE id=?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <title>Update</title>
</head>
<?php
include("index.php");
?>
<body>
    <div class="container">
        <form action="setHoursAndExpenses.php?id=<?php echo $user['id']; ?>" method="post">
            <fieldset>
                <legend>Set hours and expenses of employee</legend>
                <label>Name:</label> <input type="text" name="name" value="<?php echo $user['name']; ?>" disabled>
                <label>Position:</label> <input type="text" name="position" value="<?php echo $user['position']; ?>" disabled>
                <label>Hours worked:</label> <input type="text" name="hours_worked" value="<?php echo $user['hours_worked']; ?>">
                <label>Expenses:</label> <input type="text" name="expenses" value="<?php echo $user['expenses']; ?>">
                <input type="submit" value="update" class="btn btn-success">
            </fieldset>
        </form>
        <div class="pagination">
            <li class="page-item"><a class="page-link" href="updateForTips.php">Previous</a></li>
        </div>
    </div>
</body>
</html>
