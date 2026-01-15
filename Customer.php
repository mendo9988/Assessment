<?php 
require_once "db.php";
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $customername = trim($_POST['customername'] ?? '');
    $Customeremail = trim($_POST['Customeremail'] ?? '');
    $Customerphone = trim($_POST['Customerphone'] ?? '');
    $Customeraddress = trim($_POST['Customeraddress'] ?? '');
    $Status = trim($_POST['Status'] ?? '');
    
    $sql = "Insert into customer (Name, Email, Phone, Address, AccountStatus) 
    Values (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$customername, $Customeremail, $Customerphone, $Customeraddress, $Status]);
    $success = $stmt;
    if ($success) {
        $message = "Addition successful";
        echo "Added Successfully";
    } else {
        $message = "An error occured";
        echo "Unsuccessfull";
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
        <input type="email" name="Customeremail"><br>
        <label for="">Phone</label>
        <input type="text" name="Customerphone"> <br>
        <label for="">Address</label>
        <input type="text" name="Customeraddress"><br>
        <label for="">Account Status</label>
        <select name="Status" id="" required>
            <option value="">Select a status</option>
            <option value="">active</option>
            <option value="">inactive</option>
        </select> <br>
        <button method="Submit">Add</button>
    </form>
    
</body>
</html>