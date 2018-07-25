<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/order.php';

$order = new Order;
$orders = $order->selectAll();

if (isset($_GET['key'])) {
    if ($_GET['key'] == "QBPEQgsVfYVW684SYcsgZ1ZDvnkVBd28") {
        if (sizeof($orders) > 0) {
            echo json_encode($orders, JSON_PRETTY_PRINT);
        } else {
            echo json_encode(
                array("message" => "No orders found.")
            );
        }
    }
}
?>