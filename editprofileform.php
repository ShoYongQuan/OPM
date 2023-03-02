<?php

session_start();

if(isset($_SESSION['userID'])){
    $id=$_SESSION['userID'];
}else{
    echo "<script>alert('Please login first. Click the top right icon to login.'); window.location='index.php'</script>";
}

include "connection.php";

if(!isset($_POST['submit'])){
    $sql = "SELECT * FROM user WHERE userID='$id';";
    $run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($run) > 0) {
    // output data of each row
    while($data = mysqli_fetch_assoc($run)) {
        $name=$data["name"];
        $gender=$data["gender"];
        $dob=$data["dob"];
        $phoneNo=$data["phoneNo"];
        $email=$data["email"];
        $img= $data["image"];  
    }
    mysqli_close($conn);
    }
}else if (isset($_POST['submit'])){

    $name=$_POST["name"]??"";
    $gender=$_POST["gender"]??"";
    $dob=$_POST["dob"]??"";
    $phoneNo=$_POST["phoneNo"]??"";
    $email=$_POST["email"]??"";
    $img= $_POST["image"]??""; 

    if (isset($_FILES['newimg']) && $_FILES['newimg']['error'] === UPLOAD_ERR_OK){
        // get details of the uploaded file
        $fileTmpPath = $_FILES['newimg']['tmp_name'];
        $fileName = $_FILES['newimg']['name'];
        $fileSize = $_FILES['newimg']['size'];
        $fileType = $_FILES['newimg']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
    
        //sanitize file-name (to generate new file name avoiding data redundancy / clashing)
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    
        // check if file has one of the following extensions
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc', 'pdf','docx');
    
        if (in_array($fileExtension, $allowedfileExtensions)){
            // directory in which the uploaded file will be moved
            $uploadFileDir = "uploaded_img/";
            //$dest_path = $uploadFileDir . $fileName;
            $dest_path = $uploadFileDir . $newFileName;
        
            if(move_uploaded_file($fileTmpPath,$dest_path)) {

                unlink($img);  

                include "connection.php";
                $sql = "UPDATE user SET 
                        name='$name',
                        gender='$gender',
                        dob='$dob',
                        phoneNo='$phoneNo',
                        image = '$dest_path'
                        WHERE userID = '$id';";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Image is uploaded successfully.'); window.location='customerProfile.php'</script>";
                } else {
                    echo "<script>alert('User details update failed but image successfully uploaded.'); window.location='customerProfile.php'</script>";
                }
                mysqli_close($conn);       

            } else {
                echo "<script>alert('There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.'); window.location='customerProfile.php'</script>";
            }
        } else {
            echo "<script>alert('Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions)'); window.location='customerProfile.php'</script>";
        }
    }else{
        $sql = "UPDATE user SET 
        name='$name',
        gender='$gender',
        dob='$dob',
        phoneNo='$phoneNo'
        WHERE userID = '$id';";

        if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Profile updated successfully.'); window.location='customerProfile.php'</script>";
        } else {
            echo "<script>alert('Profile update failed.'); window.location='customerProfile.php'</script>";
        }
    }

} 

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin/style.css">
</head>
<body>
    <div class="center">
        <div class="form-container">
            <div class="text">Edit Profile <a href="index.php"><span class="close" id="close1">&times;</span></a></div>
            <form id="massage" name="user" action="editprofileform.php" method="POST" enctype="multipart/form-data">

            <div class="data">
                <label for="userID">User ID</label>
                <input type="text"  id="userID" name="userID" maxlength="30" readonly value="<?=$id?>">
            </div>

            <div class="data">
                <label for="name">User Name</label>
                <input type="text" size="30" id="name" name="name" maxlength="30" placeholder="Your name here" value="<?=$name?>"> 
            </div>

            <div class="data">
                <label for="gender">Gender</label><br>
                <select id="gender" name="gender">
                    <?php 
                        if($gender == "Male"){
                            echo"<option value='$gender'>$gender</option>";
                            echo"<option value='Female'>Female</option>";
                        }else{
                            echo"<option value='$gender'>$gender</option>";
                            echo"<option value='Male'>Male</option>";
                        }?>
                </select>
            </div>

            <div class="data">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="<?=$dob?>"><br>
            </div>

            <div class="data">
                <label for="phoneNo">Phone Number</label>
                <input type="text" size="30" id="phoneNo" name="phoneNo" maxlength="30" placeholder="10 Digits" value="<?=$phoneNo?>"><br>
            </div>

            <div class="row">
                <div class="data-edit columna">
                    <label for="image">Current Image:</label>
                </div>
                <div class="data-edit columnb">
                    <label for="newimg">Select a new image to upload</label>
                </div>
            </div>

            <div class="row">
                <div class="data-edit columna">
                    <img src="<?=$img?>" alt="<?=$name?>" id="image">
                </div>
                <div class="data-edit columnb">
                    <input type="file" name="newimg" id="newimg">
                </div>
            </div>
        
            <input type="hidden"  id="img" name="image" readonly value="<?=$img?>"><br>
            
            <div class="btn-row">
                <button class="submit-btn" type="submit" value="Submit" id="submit" name="submit">Submit</button>
            </div>
	</form>


        </div>
    </div>
</body>
</html>