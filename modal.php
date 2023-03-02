<div class="profile"><button id="modal"><img src="user.png"></button></div> 

<!-- Login Modal -->
<?php if(!isset($_SESSION['userID'])){?>

  <div id="mainModal" class="modal">
    <div class="modal-content">
      <div>
        <h1><span class="modal-main">Login</span> | <span class="modal-sub" id="register">Register</span><span class="close" id="close1">&times;</span></h1>
      </div>
      <?php include 'loginform.php'; ?>
    </div>
  </div>

<?php } else {?>
  <div id="mainModal" class="modal">
  <!-- Logout Modal -->
    <div class="modal-content">
      <p><span class="close" id="close2">&times;</span></p>
      <div>
      <h2>Would you like to log out?</h2>
      </div>
      <button class="logout-btn" onclick="window.location = 'logout.php'">Yes</button>
    </div>
  </div>
  <?php }?>


<!-- Register Modal -->
<div id="subModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div>
      <h1><span class="modal-main">Register</span> | <span class="modal-sub" id="login">Login</span><span class="close" id="close2">&times;</span></h1>
    </div>
    <?php include 'registerform.php'; ?>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("mainModal");

// Get the button that opens the modal
var btn = document.getElementById("modal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal || event.target== modal2) {
    modal.style.display = "none";
    modal2.style.display= "none";
  }
}


var modal2 = document.getElementById("subModal");
var register = document.getElementById("register");
var span = document.getElementsByClassName("close")[1];

register.onclick = function() {
  modal.style.display="none";
  modal2.style.display = "block";
}
span.onclick = function() {
  modal2.style.display = "none";
}


var login = document.getElementById("login");

login.onclick = function() {
  modal.style.display="block";
  modal2.style.display = "none";
}
</script>