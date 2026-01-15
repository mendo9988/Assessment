<!-- Customer Support ticketing system.
generates a ticket.  customer’s contact information, issue description, and timestamps. -->
<?php
require_once "db.php";

$sql = "Select * from ticket";
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate ticket</title>
</head>
<body>
    <header>
        <h2>View Table</h2>
    </header>
    <main>
        <table border="1">
            <tr>
                <th>Ticket ID</th>
                <th>CustomerId</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Status</th>
                <th>Priority</th>
                <th>AssignedTo</th>
                <th>Created At</th>
            </tr>
            <?php foreach ($data as $rows): ?>
            <tr>
                <th><?= htmlspecialchars($rows['TicketID']) ?></th>
                <th><?= htmlspecialchars($rows['CustomerID']) ?></th>
                <th><?= htmlspecialchars($rows['Subject']) ?></th>
                <th><?= htmlspecialchars($rows['Description']) ?></th>
                <th><?= htmlspecialchars($rows['Status']) ?></th>
                <th><?= htmlspecialchars($rows['Priority']) ?></th>
                <th><?= htmlspecialchars($rows['AssignedTo']) ?></th>
                <th><?= $rows['CreatedAt']? date('d-m-Y', strtotime($row['CreatedAt'])) : 'N/A' ?></th>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>