<?php
require_once "connection.php";

$sql = "SELECT * FROM customers";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Customers</title>
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>

<div class="container">

    <h2>Customers</h2>

    <a class="btn" href="addcustomer.php">➕ Add New Customer</a>

    <br><br>

    <table>
        <tr>
            <th>Contact Name</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Country</th>
            <th>ID</th>

        </tr>

        <?php
        if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["contactLastName"]) . " " . htmlspecialchars($row["contactFirstName"]) . "</td>";
                                echo "<td><a class=\"meta\" href='showorders.php?customerNumber=" . $row["customerNumber"] . "'>" . htmlspecialchars($row["customerName"]) . "</a></td>";
                                echo "<td class=\"small\">" . htmlspecialchars($row["phone"]) . "</td>";
                                echo "<td class=\"small\">" . htmlspecialchars($row["country"]) . "</td>";
                                echo "<td class=\"small\">" . htmlspecialchars($row["customerNumber"]) . "</td>";

                                echo "</tr>";
                        }
        }
        ?>

    </table>

</div>

</body>

</html>

<?php
$connection->close();
?>