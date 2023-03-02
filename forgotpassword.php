<?php

session_start();
include 'connection.php';

if(isset($_POST['check-email'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $check_email = "SELECT * FROM user WHERE email='$email'";
    $run = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($run) > 0){
        $code = rand(999999, 111111);
        $insert_code = "UPDATE user SET code = $code WHERE email = '$email'";
        $run =  mysqli_query($conn, $insert_code);
        if($run){
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code .";
            $sender = "From: oneparadisemassage@outlook.com";
            if(mail($email, $subject, $message, $sender)){

                $info = "OTP sent to $email. Please check all your folders including spam.";
                $_SESSION['status'] = "Code Sent";
                $_SESSION['email'] = $email;
                echo "<script>alert('$info'); window.location='resetcode.php'</script>";
                exit();
            }else{
                echo "<script>alert('Error occured. OTP unable to sent. Please contact the administrator.'); window.location='index.php'</script>";
            }
        }else{
            echo "<script>alert('Error occured. Please contact the administrator.'); window.location='index.php'</script>";
        }
    }else{
        echo "<script>alert('This email address does not exist.'); window.location='index.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="background container">
        <div class="center">
            <div class="form-container">
                <div class="text">Forgot Password? <a href="index.php"><span class="close" id="close1">&times;</span></a></div>
                <form action="forgotpassword.php" method="POST" autocomplete="off">
                    <div class="data">
                        <label for="email">Enter your email address</label><br><br>
                        <input type="email" name="email" placeholder="name@email.com" required>
                    </div>
                    <br>
                    <div class="btn-row">
                        <button class="submit-btn" type="submit" name="check-email" value="Continue">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>