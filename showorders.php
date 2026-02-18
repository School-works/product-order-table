<?php
require_once "connection.php";

if (!isset($_GET["customerNumber"])) {
    die("Customer not selected.");
}

$customerNumber = $_GET["customerNumber"];

$stmt1 = $connection->prepare("SELECT contactFirstName, contactLastName FROM customers WHERE customerNumber = ?");
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
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Customer Orders</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<?php $displayFirstName = isset($customer["contactFirstName"]) ? htmlspecialchars($customer["contactFirstName"]) : ''; ?>
<?php $displayLastName = isset($customer["contactLastName"]) ? htmlspecialchars($customer["contactLastName"]) : ''; ?>

<?php
$fullName = trim($displayFirstName . ' ' . $displayLastName);
if ($fullName === '') {
    $fullName = 'Unknown Customer';
}
?>

<h2>Orders for <?php echo $fullName; ?></h2>

<a class="btn secondary" href="showtable.php">⬅ Back to Customers</a>
    
<br><br>

<table>
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
        echo "<td>".htmlspecialchars($row["orderNumber"])."</td>";
        echo "<td>".htmlspecialchars($row["orderDate"])."</td>";
        echo "<td>".htmlspecialchars($row["status"])."</td>";
        $comments = (isset($row["comments"]) && trim($row["comments"]) !== '') ? htmlspecialchars($row["comments"]) : 'N/A';
        echo "<td>".$comments."</td>";
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

