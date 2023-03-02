<?php
    session_start();
    if(!isset($_SESSION['userID'])){
        echo "<script>alert('Please login first. Click the top right icon to login.'); window.location='index.php'</script>";
    }else if(!isset($_POST['submit'])){
        echo "<script>alert('Please select a session for reservation first.'); window.location='checksession.php'</script>";
    }else{
        $id=$_SESSION['userID'];
    }

    include 'connection.php';

    $date = $_POST["date"]??"";
    $mID = $_POST["massageID"]??"";

    $sql="SELECT massagePrice FROM massage WHERE massageID='$mID'";
    $run=mysqli_query($conn,$sql);
    $data=mysqli_fetch_array($run);
    $massagePrice= $data["massagePrice"];

    $session = $_POST["timeslot"]??"";
    $startTime = substr("$session",0,8);
    $endTime = substr("$session",11);

    

    $sql="INSERT INTO booking (date, userID, massageID, price, startTime, endTime) VALUES ('$date','$id', '$mID', '$massagePrice', '$startTime', '$endTime');";
    echo $sql;
    
    if(mysqli_query($conn, $sql)){
        $_SESSION['status']="Successful";
        header("location: comfirmationpopup.php ");
    }else{
        echo "<script>alert('Booking failed. Please contact the administrator.'); window.location='checksession.php'</script>";
    }
?>