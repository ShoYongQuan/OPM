<?php
 session_start();

 if(!isset($_SESSION['userID'])){
    echo "<script>alert('Please login first. Click the top right icon to login.'); window.location='index.php'</script>";
 }else if(!isset($_SESSION['status']) || $_SESSION['status'] != 'Successful'){
    echo "<script>alert('Please select a session for reservation first.'); window.location='checksession.php'</script>";
 }else{
    $id=$_SESSION['userID'];
 }
 $_SESSION['status']="Null";
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/comfirmationpopup.css">
    <title>One Paradise Massage</title>
</head>
<body>
    <div id="comfirmation" class="container background">
    <div class="popup" id="popup">
    <?php include 'connection.php';
    $sql="SELECT u.name, u.phoneNo, m.massageName, b.date, b.startTime, b.endTime, m.massagePrice FROM user u, massage m, booking b WHERE u.userID=b.userID and b.userID='$id' and m.massageID=b.massageID ORDER BY b.bookingID DESC LIMIT 1;";
    $run=mysqli_query($conn,$sql);

    while($data=mysqli_fetch_array($run)){
        $name=$data['name'];
        $phoneNo=$data['phoneNo'];
        $massageName=$data['massageName'];
        $date=$data['date'];
        $startTime=$data['startTime'];
        $endTime=$data['endTime'];
        $merge=array($startTime, $endTime);
        $timeslot= implode(" ~ ", $merge);
        $massagePrice=$data['massagePrice'];
    
    
    echo'
        <div class="container">
        
            <h2>Booking Successful !!</h2>
        
            <h4>Your booking has been successfully submited. Thank you !</h4><br>
            <p>Name: &nbsp;   '.$name.'</p><br>
            <p>Phone Number: &nbsp;'.$phoneNo.'</p><br>
            <p>Massage: &nbsp;'.$massageName.'</p><br>
            <p>Date: &nbsp;'.$date.'</p><br>
            <p>Time Slot: &nbsp;'.$timeslot.'</p><br>
            <p>Price: &nbsp;RM'.$massagePrice.'</p><br>
            <div class="done">
                <a href="index.php" class="done-btn">OK</a>
            </div>
        </div>
    </div>
    ';}?>
    </div>

</body>
</html>