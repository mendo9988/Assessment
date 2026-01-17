
<?php
require_once "db.php";
$message = "";
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $customerID = trim($_POST['customerID'] ?? '');
	$subject = trim($_POST['subject'] ?? '');
	$description = trim($_POST['description'] ?? '');
	$status = trim($_POST['status'] ?? '');
	$priority = trim($_POST['priority'] ?? '');
    $agentID = trim($_POST['agentID'] ?? '');
    $errors = [];
    
    if ($customerID && $subject && $status && $priority && $agentID){
        $sql = "INSERT INTO ticket 
        (`CustomerID`, `Subject`, `Description`, `Status`, `Priority`, `AssignedTo`)
        VALUES (?, ?, ?, ?, ?, ?)";


        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([$customerID, $subject, $description, $status, $priority, $agentID]);
            $message = "Addition successful";
        } catch (PDOException $e) {
            $message = $e->getMessage();
        }
        
    } else {
        $message = "Please fill all required fields";
    }
}
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
        <h2>Generate Ticket</h2>
    </header>
    <main>
    <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <form action="" method="POST">
            <label for="">CustomerID</label>
            <input type="number" name="customerID" required><br>
            <label for="text">Subject</label>
            <input type="text" name="subject" required><br>
            <label for="">Description</label>
            <textarea name="description" rows="3"></textarea><br>
            <label for="">Status</label>
            <select name="status" id="" required>
            <option value="">Select a status</option>
            <option value="active">active</option>
            <option value="inactive">inactive</option>
        </select> <br>
            <label for="">Priority</label>
            <input type="text" name="priority"><br>
            <label for="">Assigned To</label>
            <input type="number" name="agentID" required><br>
            <button type="Submit">Add</button>
        </form>
    </main>
</body>
</html>