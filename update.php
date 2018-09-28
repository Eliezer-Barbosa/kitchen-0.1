<?php
$conn = require('connection.php');

$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? null;
    $position = $_POST['position'] ?? null;
    $email = $_POST['email'] ?? null;

    $stmt = $conn->prepare('UPDATE employee SET name=?, position=?, email=? WHERE id=?');
    $stmt->bind_param('sssi', $name, $position, $email, $id);
    $stmt->execute();

    header('location: see.php');
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
     <form action="update.php?id=<?php echo $user['id']; ?>" method="post">
        <fieldset>
            <legend>Update employee</legend>
            <label>Name:</label> <input type="text" name="name" value="<?php echo $user['name']; ?>">
            <label>Position:</label> <input type="text" name="position" value="<?php echo $user['position']; ?>">
            <label>Email:</label> <input type="text" name="email" value="<?php echo $user['email']; ?>">
            <input type="submit" value="update">
        </fieldset>
    </form>

    <p><a href="see.php">voltar</a></p>
</body>
</html>
