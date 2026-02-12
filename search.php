<?php
$conn = mysqli_connect("localhost", "root", "", "chargev");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
    
    <link rel="stylesheet" href="fpmaincss.css">
    <title>Search Vehicle</title>
</head>
<body>

<div class="form-container">
    <h2>Search Vehicle History</h2>

    <form method="GET">
        <label>
            Enter Vehicle Number
            <input type="text" name="vehicle_number" required>
        </label>

        <button type="submit" name="search" class="btn primary">Search</button>
    </form>



<?php
if (isset($_GET['search'])) {
    $vehicle = $_GET['vehicle_number'];

    $sql = "SELECT * FROM visits WHERE vehicle_number='$vehicle'";
    $result = mysqli_query($conn, $sql);

    $visit_count = 0;
    $total_amount = 0;

    if (mysqli_num_rows($result) > 0) {

        echo "<h3>Results for Vehicle: $vehicle</h3>";

        echo "<table border='1' cellpadding='8'>";
        echo "<tr>
                <th>Customer Name</th>
                <th>Phone Number</th>
                <th>Amount</th>
                <th>Visit Date</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            $visit_count++;
            $total_amount += $row['amount'];

            echo "<tr>";
            echo "<td>".$row['customer_name']."</td>";
            echo "<td>".$row['phone_number']."</td>";
            echo "<td>".$row['amount']."</td>";
            echo "<td>".$row['visit_date']."</td>";
            echo "</tr>";
        }

        echo "</table>";

        echo "<h4>Total Visits: $visit_count</h4>";
        echo "<h4>Total Amount Spent: Rs. $total_amount</h4>";

    } else {
        echo "<p>No records found for this vehicle.</p>";
    }
}

mysqli_close($conn);
?>
</div>
</body>
</html>
