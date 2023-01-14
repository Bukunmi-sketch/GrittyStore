<?php


include '../Includes/db.inc.php';
include './excel/SimpleXLSXGen.php';

$orders = [
    ['S/N', 'orderid', 'Customers Name', 'Email', 'Address', 'Cart item',  'Amount', 'payment Type', 'local government', 'State', 'Payment Status', 'Additional Info', 'Phone', 'Order status'],
 //   [618260307, 'The Hobbit', 'J. R. R. Tolkien', 'Houghton Mifflin', 'USA'],
 //   [908606664, 'Slinky Malinki', 'Lynley Dodd', 'Mallinson Rendel', 'NZ']
];

$g = 0;
$sql = "SELECT * FROM orders ORDER BY id ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($stmt->rowCount() > 0) {
    foreach ($data as $row) {
        $g++;
     $orders=array_merge($orders, [array($g, $row["order_id"], $row["customers_firstname"] . $row["customers_lastname"], $row["email"], $row["customers_address"], $row["cart_items"], $row['amount'], $row['payment_type'], $row['customers_lga'], $row['state'], $row['payment_status'], $row['additional_info'], $row['phone_no'], $row['order_status'] ) ] );
    }

}else{
  $output .= 'no result';

}

$xlsx = Shuchkin\SimpleXLSXGen::fromArray($orders);
//$xlsx->saveAs('orders.xlsx'); // or save file to local system
$xlsx->downloadAs('Orders.xlsx'); //or $xlsx_content = (string) $xlsx //download file t server


echo '<pre>';
print_r($orders);


?>