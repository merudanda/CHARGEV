<?php
include "connection.php"; 
$totalVisits = 0;
$totalAmount = 0;
$result = null;

if (isset($_GET['month'])) {

    $month = $_GET['month']; // format: 2026-02

    $query = "SELECT * FROM visits 
              WHERE DATE_FORMAT(visit_date, '%Y-%m') = '$month'
              ORDER BY visit_date DESC";

    $result = mysqli_query($conn, $query);

    $totalVisits = mysqli_num_rows($result);

    // Calculate total amount
    $sumQuery = "SELECT SUM(amount) as total FROM visits 
                 WHERE DATE_FORMAT(visit_date, '%Y-%m') = '$month'";

    $sumResult = mysqli_query($conn, $sumQuery);
    $sumRow = mysqli_fetch_assoc($sumResult);
    $totalAmount = $sumRow['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Monthly Report</title>
    <link rel="stylesheet" href="fpmaincss.css">
</head>
<body>

<div class="report-container">
    <h2>Monthly Report</h2>

    <form method="GET" class="report-filter">
        <input type="month" name="month" required>
        <button type="submit">Generate</button>
    </form>

<?php if ($result && $totalVisits > 0): ?>

    <div class="report-table">
        <table>
            <tr>
                <th>Vehicle Number</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['vehicle_number']; ?></td>
                <td><?php echo $row['customer_name']; ?></td>
                <td><?php echo $row['phone_number']; ?></td>
                <td>Rs. <?php echo $row['amount']; ?></td>
                <td><?php echo $row['visit_date']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="report-summary">
        <p>Total Visits: <?php echo $totalVisits; ?></p>
        <p>Total Revenue: Rs. <?php echo $totalAmount; ?></p>
    </div>

<?php elseif(isset($_GET['month'])): ?>
    <p>No records found for selected month.</p>
<?php endif; ?>

</div>

</body>
</html>
