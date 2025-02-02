<?php
session_start();
$host ='localhost';
$username ='root';
$password ='';
$database ='wosha';

$conn = new mysqli($host, $username, $password, $database);
if($conn->connet_error){
    die('Connection failed'.$conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn -> prepare($sql);
    $stmt->blind_param('s',$email);
    $stmst->execute();
    $results = $stmt->get_results();
  
    
    if($results->num_rows === 1){
        $user = $results->fetch_assoc();
        
        if (password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            header('location: index.html');
            exit;
        }else{
            $error = 'Invalid email or password';

        }
        }else{
            $error =  'Invalid email or password';

        }
        $stmt->close();
    }
    $conn->close();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LogIn to Wosha </title>
    </head>
    <body>
    <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
    </body>
    </html>
