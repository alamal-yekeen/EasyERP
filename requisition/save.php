<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $items = json_decode($_POST['items'], true);
    print_r($items);
    exit();
    foreach ($items as $item) {
        $category = $conn->real_escape_string($item['category']);
        $itemName = $conn->real_escape_string($item['item']);
        $unitPrice = $conn->real_escape_string($item['unitPrice']);
        $quantity = $conn->real_escape_string($item['quantity']);
        $amount = $conn->real_escape_string($item['amount']);

        $sql = "INSERT INTO items (category, item, unitprice, quantity, amount) 
                VALUES ('$category', '$itemName', '$unitPrice', '$quantity', '$amount')";
        $conn->query($sql);
    }

    echo "Items saved successfully!";
    $conn->close();
}
?>
