<?php 
    session_start();
    date_default_timezone_set('Asia/Calcutta');
    if(isset($_SESSION['userID'])){
		$id=$_SESSION['userID'];
	}else{
		echo "<script>alert('Please login first. Click the top right icon to login.'); window.location='index.php'</script>";
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/appointment.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    
    <title>One Paradise Massage</title>
</head>
<body>
    <?php include 'header.php';?>

    <!--appointment-->
    <section id="appointment">
        <div class="top">
            <h2>Appointment</h2>
            <div class="dropdown">
                <button class="dropbtn">Upcoming</button>
                <div class="drop-content">
                    <a href="appointmentHistory.php">History</a>
                </div>
            </div>
        </div>
        <div class="list">
            <div class="listhead">
                <p>Massage</p>
                <p>Price</p>
                <p>Time Slot</p>
                <p>Date</p>
            </div>
            <hr>
            
                
                <?php 
                $id=$_SESSION['userID'];
                $today = date("Y-m-d",time());
                include 'connection.php';
                $sql="SELECT u.userID, m.massageName, m.imgdir, b.userID, b.price, b.startTime, b.endTime, b.date FROM massage m, booking b, user u WHERE b.massageID=m.massageID and b.userID=u.userID and b.userID='$id' and b.date >='$today' ;";
                $run=mysqli_query($conn,$sql);
                
                
                while($data=mysqli_fetch_array($run)){
                    $userID=$data['userID'];
                    $massageName=$data['massageName'];
                    $imgdir=$data['imgdir'];
                    $price=$data['price'];
                    $startTime=$data['startTime'];
                    $endTime=$data['endTime'];
                    $merge=array($startTime, $endTime);
                    $timeslot= implode(" ~ ", $merge);
                    $date=$data['date'];
                        
                        echo'
                        <div class="main">
                        <div class="massage">
                            <div class="massage-img">
                                <img src="massages/'.$imgdir.'" alt="'.$massageName.'">
                            </div>   
                            <div class="massage-name">
                                <p>'.$massageName.'</p>
                            </div>
                        </div>
                        <div class="price">  
                            <div class="massage-price">
                                    <p>RM '.$price.'</p>
                                </div>
                            </div>
                            <div class="timeslot">  
                            <div class="bookingTimeSlot">
                                <p>'.$timeslot.'</p>
                            </div>
                        </div>
                        <div class="date">  
                            <div class="bookingDate">
                                <p>'.$date.'</p>
                            </div>
                        </div>
                        </div>
                        <hr>' ;
                        
                    };
            ?>
            
        </div>
    </section>

    <!--End appointment-->
</body>
</html>