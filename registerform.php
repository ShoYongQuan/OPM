<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>One Paradise Massage</title>
</head>
<html>
<body>
	<form action="register.php" method="POST" class="register-form">
		<div class="register-wrapper">

			<div class="form-row"><label for="name" >Name</label></div>

			<div class="form-row">
				<input type="text" class="register-input" size="30" maxlength="30" id="name" placeholder="Name" name="name" autocomplete="off" required>
			</div>

			<div class="form-row">
				<div class="register-column">
					<label  style="padding-bottom:10px;"> Gender </label>
				</div>
				<div class="register-column">
					<label for="dob" >Date of Birth</label>
				</div>
			</div>

			<div class="form-row">
				<div class="register-column">
				<label class="radio-container">Male
					<input type="radio" checked="checked" name="radio" value="Male">
					<span class="checkmark"></span>
				</label>
				<label class="radio-container">Female
					<input type="radio" name="radio" value="Female">
					<span class="checkmark"></span>
				</label>
				</div>

				<div class="register-column">
					<input type="date" class="register-input" name="dob" id="dob" max="<?=date("Y-m-d")?>" required>
				</div>	
			</div>

			<div class="form-row">
				<div class="register-column">
					<label for="email">Email</label>
				</div>
				<div class="register-column">
					<label for="pNo" >Phone Number</label>
				</div>
			</div>

			<div class="form-row">
				<div class="register-column">
					<input type="email" class="register-input" id="email" placeholder="Email" name="email" autocomplete="off" required>
				</div>
				<div class="register-column">
					<input type="text" class="register-input" id="pNo" minlength="10" maxlength="10" placeholder="10 Digits Phone Number" name="phoneNo" autocomplete="off" required>
				</div>
			</div>

			<div class="form-row">
				<label for="password" >Password</label>
			</div>

			<div class="form-row">
				<input type="password" class="register-input" minlength="8" maxlength="15" id="password" placeholder="Password" name="password"  required>
			</div>
			
			<div class="form-row">
				<label for="cpassword" >Confirm Password</label>
			</div>

			<div class="form-row">
				<input type="password" class="register-input" minlength="8" maxlength="20" id="password" placeholder="Confirm Password" name="cPassword"  required>
			</div>

			<input type="hidden" id="role" name="role" value="Customer">

			<div>
				<input type="submit" class="register-btn" name="register" value="REGISTER"></button>
			</div>

		</div>
	</form>
</body>
</html>