<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Calculate Tips</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>
    </head>
    <?php 
        include('index.php');
    ?>
    <body>
        <div class="container">
            <form action="tipsResult.php" method="post">
                <Label>Tips of the week:</Label>
                <input type="text" name="tips_week">
                <input type="submit" value="submit" class="btn btn-success">
            </form>
        </div>
    </body>
</html> 

