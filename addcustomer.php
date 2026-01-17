<?php 
require_once "db.php";
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $customername = trim($_POST['customername'] ?? '');
    $customeremail = trim($_POST['customeremail'] ?? '');
    $customerphone = trim($_POST['customerphone'] ?? '');
    $customeraddress = trim($_POST['customeraddress'] ?? '');
    $status = trim($_POST['status'] ?? '');
    
    if ($customername && $customeremail && $status) {
        $sql = "INSERT INTO customer (Name, Email, Phone, Address, AccountStatus)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$customername, $customeremail, $customerphone, $customeraddress, $status])) {
            $message = "Addition successful";
        } else {
            $message = "An error occurred";
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
    <title>Custoner Table</title>
</head>
<body>
<div class="message"><?php echo htmlspecialchars($message); ?></div>
    <form action="" method="POST">
        <label for="">Name</label>
        <input type="text" name="customername"><br>
        <label for="email">Email</label>
        <input type="email" name="customeremail"><br>
        <label for="">Phone</label>
        <input type="text" name="customerphone"> <br>
        <label for="">Address</label>
        <input type="text" name="customeraddress"><br>
        <label for="">Account Status</label>
        <select name="status" id="" required>
            <option value="">Select a status</option>
            <option value="active">active</option>
            <option value="inactive">inactive</option>
        </select> <br>
        <button type="Submit">Add</button>
    </form>
    
</body>
</html>