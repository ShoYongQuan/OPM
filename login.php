<?php
  session_start();
  if(isset($_POST['login'])){
    include 'connection.php';

    $pass = $_POST['password'];
    $email = $_POST['email'];
  
    $sql="SELECT * FROM user WHERE email = '$email'";
  
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
      $fetch = mysqli_fetch_assoc($res);
      $fetch_pass = $fetch['password'];
      if(password_verify($pass, $fetch_pass)){
        $role=$fetch['role'];
  
        if($role=="Admin"){
          $_SESSION['userID'] = $fetch['userID'];
          $_SESSION['role'] = $role;
          $_SESSION['name'] = $fetch['name'];
          echo "<script>alert('Successful Login! Welcome ".$_SESSION['name']."'); window.location='./admin/dashboard.php' </script>";
        }else if($role=="Customer"){
          $_SESSION['userID'] = $fetch['userID'];
          $_SESSION['role'] = $role;
          $_SESSION['name'] = $fetch['name'];
          echo "<script>alert('Successful Login! Welcome ".$_SESSION['name']."'); window.location='index.php'</script>";
        }else{
          echo"error";
        }
      }else{
        echo "<script>alert('Woops! Email or Password is Wrong.'); window.location='index.php'</script>";
      }
  
    }else{
      echo "<script>alert('Woops! Invalid or Wrong Email.'); window.location='index.php'</script>";
    }
    
  
    //echo "$sql"; 
  
    mysqli_close($conn);

  }else{
    echo "<script>alert('You do not have access to this page.'); window.location='index.php'</script>";
  }
  
?>
