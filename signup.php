<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql ="INSERT INTO users(email, password) VALUES(?, ?)";
    $stmt = $conn->prepre($sql);
    $stmt-> blind_param('ss', $email, $hashedPassword);
    
    if ($stmt->execute()){
        header('Location: login.php');
        exit;
    }else{
$stmt->close();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp To Wosha</title>
</head>
<body>
<form action="signup.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>
        <div class="text-center mt-3">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div> 
</body>
</html>