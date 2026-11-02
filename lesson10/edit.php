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
        <label>Username:</label><br>
        <input type="text" name="username" value="<?php echo htmlspecialchars($data['username'] ?? ''); ?>"><br><br> 
        
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($data['name'] ?? ''); ?>"><br><br> 
        
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>"><br><br> 
        
        <button type="submit" name="update">Update</button> 
    </form> 
    <br>
    <a href="dashboard.php">Go to Dashboard</a> 
</body> 
</html>
