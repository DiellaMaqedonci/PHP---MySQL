<?php 
include_once('config.php'); 

// Fetch the user ID from the URL
$id = $_GET['id']; 

// Prepare and execute the SQL statement safely
$sql = "SELECT * FROM user WHERE id=:id"; 
$prep = $conn->prepare($sql); 
$prep->bindParam(':id', $id); // Added the missing colon in bindParam
$prep->execute(); 

// Fetch the data to display in the form
$data = $prep->fetch(); 

// REMOVED: header('Location: dashboard.php'); 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>EDIT</title> 
</head> 
<body> 
    <h2>Edit User Profile</h2>
    <form action="update.php" method="post"> 
        <!-- Keep ID hidden so update.php knows which row to change -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id'] ?? ''); ?>"> 
        
        <!-- Changed these to visible fields so you can actually edit them -->
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($data['name'] ?? ''); ?>"><br><br> 
        
        <label>Description:</label><br>
        <input type="text" name="description" value="<?php echo htmlspecialchars($data['description'] ?? ''); ?>"><br><br> 
        
        <label>Quantity:</label><br>
        <input type="integer" name="quantity" value="<?php echo htmlspecialchars($data['quantity'] ?? ''); ?>"><br><br> 
        
    </form> 
    <br>
    <a href="dashboard.php">Go to Dashboard</a> 
</body> 
</html>