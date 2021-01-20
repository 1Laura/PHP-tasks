<?php

include_once "Class/Items.php";
include_once "Class/VendingMachine.php";


var_dump($_POST);
$itemsArray = [
    new Items('A1', 'tangerines', 13, 0.5),
    new Items('A2', 'bananas', 15, 2),
    new Items('A3', 'pear', 12, 1.5),
    new Items('A4', 'apple', 10, 1),
    new Items('A5', 'pineapple', 2, 6),
    new Items('A6', 'mango', 0, 5),
];

//var_dump($vendMachine);//private items negalima pasiekti
//var_dump($vendMachine->getItems());
$vendMachine = new VendingMachine($itemsArray);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productCode = $_POST['productCode'];
    $myMoney = $_POST['myMoney'];

//    $vendMachine->vend($productCode);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<h2>Items</h2>
<div class="itemsTable">
    <table>
        <tr>
            <td>Code</td>
            <td>Title</td>
            <td>Price</td>
            <td>Quantity</td>
        </tr>
        <?php foreach ($vendMachine->getItems() as $item) : ?>
            <tr>
                <td><?php echo $item->getId(); ?></td>
                <td><?php echo $item->getTitle(); ?></td>
                <td><?php echo $item->getPrice(); ?></td>
                <td><?php echo $item->getQuantity(); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="slide12">
    <form action="" method="post">
        <div class="inputGroup">
            <label class="label" for="productCode">Enter product code</label>
            <input type="text" name="productCode"
                   value="<?php echo isset($_POST['productCode']) ? $_POST['productCode'] : null; ?>">
        </div>
        <div class="inputGroup">
            <label class="label" for="myMoney">Enter your money</label>
            <input type="text" name="myMoney"
                   value="<?php echo isset($_POST['myMoney']) ? $_POST['myMoney'] : null; ?>">
        </div>
        <button class="btn" type="submit">Search</button>
    </form>

    <!--    pirma karta meta klaidas, veliau ivedus nebemeta-->
    <h3>Your product name
        is: <?php isset($vendMachine) ? $vendMachine->vend($productCode, $myMoney) : null; ?>
    </h3>

</div>


</body>
</html>
