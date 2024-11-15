<?php 
include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName = htmlspecialchars($_POST['fname']);
    $lastName = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];


    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
    } elseif ($password !== $confirmPassword) {
        echo "Passwords do not match. Please try again.";
    } else {
     
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Email Address Already Exists!";
        } else {
        
            $insertQuery = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
            $insertQuery->bind_param("ssss", $firstName, $lastName, $email, $passwordHash);
            if ($insertQuery->execute()) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
}

if(isset($_POST['signIn'])){
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['email'] = $row['email'];
            header("Location: home.php");
            exit();
        } else {
            echo "Not Found, Incorrect Email or Password";
        }
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}
?>