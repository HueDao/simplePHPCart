<?php
include_once 'database.php';
$database = new Database();
$sql = 'SELECT * FROM products';
$products = $database->runQuery($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <div class='container'>
        <div class='row'>
            <?php
                if(!empty($products)){
                    foreach($products as $product){
                        echo $product;
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>