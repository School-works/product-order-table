<?php
require_once "connection.php";

$sql = "SELECT * FROM customers";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customers</title>
</head>
<body>

<h2>Customers</h2>

<a href="addcustomer.php">➕ Add New Customer</a>

<br><br>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Country</th>
</tr>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["customerNumber"]."</td>";
        echo "<td>
                <a href='showorders.php?customerNumber=".$row["customerNumber"]."'>
                ".$row["customerName"]."
                </a>
              </td>";
        echo "<td>".$row["phone"]."</td>";
        echo "<td>".$row["country"]."</td>";
        echo "</tr>";
    }
}
?>

</table>

</body>
</html>

<?php
$connection->close();
?>
