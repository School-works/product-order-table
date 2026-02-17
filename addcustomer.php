<?php
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customerNumber = $_POST["customerNumber"];
    $customerName = $_POST["customerName"];
    $contactLastName = $_POST["contactLastName"];
    $contactFirstName = $_POST["contactFirstName"];
    $phone = $_POST["phone"];
    $addressLine1 = $_POST["addressLine1"];
    $addressLine2 = $_POST["addressLine2"];
    $city = $_POST["city"];
    $country = $_POST["country"];

    $stmt = $connection->prepare("
        INSERT INTO customers
        (customerNumber, customerName, contactLastName, contactFirstName, 
         phone, addressLine1, addressLine2, city, country)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("issssssss",
        $customerNumber,
        $customerName,
        $contactLastName,
        $contactFirstName,
        $phone,
        $addressLine1,
        $addressLine2,
        $city,
        $country
    );

    if ($stmt->execute()) {
        header("Location: showtable.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
</head>
<body>

<h2>Add New Customer</h2>

<form method="POST">
    Customer Number: <input type="number" name="customerNumber" required><br><br>
    Customer Name: <input type="text" name="customerName" required><br><br>
    Last Name: <input type="text" name="contactLastName" required><br><br>
    First Name: <input type="text" name="contactFirstName" required><br><br>
    Phone: <input type="text" name="phone" required><br><br>
    Address Line 1: <input type="text" name="addressLine1" required><br><br>
    Address Line 2: <input type="text" name="addressLine2"><br><br>
    City: <input type="text" name="city" required><br><br>
    Country: <input type="text" name="country" required><br><br>

    <button type="submit">Add Customer</button>
</form>

<br>
<a href="showtable.php">Back to Customers</a>

</body>
</html>
