<?php
require 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form action="HOI_Signup.php" method="post">
        <div>
            <label>HOI UDISE ID</label>
            <input type="text" name="HOI_UDISE_ID" value="<?php echo isset($_POST['HOI_UDISE_ID']) ? $_POST['HOI_UDISE_ID'] : ''; ?>">
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="HOI_Password" value="<?php echo isset($_POST['HOI_Password']) ? $_POST['HOI_Password'] : ''; ?>">
        </div>
        <div>
            <label>Email</label>
            <input type="text" name="HOI_Email_ID" value="<?php echo isset($_POST['HOI_Email_ID']) ? $_POST['HOI_Email_ID'] : ''; ?>">
        </div>
        <div>
            <input type="submit" name="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>
    </form>
</body>
</html>

<?php
if(isset($_POST['submit'])){
    $HOI_UDISE_ID = $_POST['HOI_UDISE_ID'];
    $HOI_Password = $_POST['HOI_Password'];
    $HOI_Email_ID = $_POST['HOI_Email_ID'];

    // Insert data into database
    $sql = "INSERT INTO 9475755847_HOI_Login_Credentials (HOI_UDISE_ID, HOI_Password, HOI_Email_ID) VALUES ('$HOI_UDISE_ID', '$HOI_Password', '$HOI_Email_ID')";
    
    if(mysqli_query($db, $sql)){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
    }
}
?>
