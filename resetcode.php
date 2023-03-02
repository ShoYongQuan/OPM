<?php 
session_start();
include 'connection.php';
$email = $_SESSION['email'];

if($email == true && isset($_SESSION['status'])){
    if(isset($_POST['check-reset-otp'])){
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM user WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $_SESSION['code']=$_POST['otp'];
            echo "<script>alert('Please create a new password that you don\'t use on any other site.'); window.location='newpassword.php'</script>";
            exit();
        }else{
            echo "<script>alert('Invalid code. Please check again.'); window.location='resetcode.php'</script>";
        }
    }
  
} else{
    echo "<script>alert('Please request for an OTP first.'); window.location='forgotpassword.php'</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="center background container">
        <div class="form-container">
        <form action="resetcode.php" method="POST" autocomplete="off">
            <div class="text">Code Verification <a href="index.php"><span class="close" id="close1">&times;</span></a></div>
            <div class="data">
                <label for="otp">Enter the 6 digit One Time Password</label><br><br>
                <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
            </div>
            <br>
            <div class="btn-row">
                <button class="submit-btn" type="submit" name="check-reset-otp" value="Submit">Submit</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>