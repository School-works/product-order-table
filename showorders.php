<?php
require_once "connection.php";

if (!isset($_GET["customerNumber"])) {
    die("Customer not selected.");
}

$customerNumber = $_GET["customerNumber"];

$stmt1 = $connection->prepare("SELECT customerName FROM customers WHERE customerNumber = ?");
$stmt1->bind_param("i", $customerNumber);
$stmt1->execute();
$result1 = $stmt1->get_result();
$customer = $result1->fetch_assoc();

$stmt2 = $connection->prepare("SELECT * FROM orders WHERE customerNumber = ?");
$stmt2->bind_param("i", $customerNumber);
$stmt2->execute();
$result2 = $stmt2->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Orders</title>
</head>
<body>

<h2>Orders for <?php echo $customer["customerName"]; ?></h2>

<a href="showtable.php">⬅ Back to Customers</a>

<br><br>

<table border="1" cellpadding="5">
<tr>
    <th>Order Number</th>
    <th>Order Date</th>
    <th>Status</th>
    <th>Comments</th>
</tr>

<?php
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["orderNumber"]."</td>";
        echo "<td>".$row["orderDate"]."</td>";
        echo "<td>".$row["status"]."</td>";
        echo "<td>".$row["comments"]."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No orders found</td></tr>";
}
?>

</table>

</body>
</html>

<?php
$stmt1->close();
$stmt2->close();
$connection->close();
?>
