<!DOCTYPE html>
<html>
<head>
	<title>update user profile</title>
</head>

<style>
		fieldset{
			border:solid 2px;
			width:400px;
			height:600px;
		}
		
	</style>
<body>
<form action="<?php echo base_url()?>main/update_action" method="post">
	<?php 
	if(isset($userdata))
	{
		foreach ($userdata->result()as $row) 
		{
		?>
	<center><fieldset>	
	<h2>User Details</h2>	
	First name   : <input type="text" name="fname" value="<?php echo $row->fname;?>"><br><br>
	Last name    : <input type="text" name="lname" value="<?php echo $row->lname;?>"><br><br>

	E-mail       : <input type="text" name="email" value="<?php echo $row->email?>"><br><br>

	Mobile number   : <input type="text" name="mob" value="<?php echo $row->mob?>"><br><br>

	DOB      : <input type="date" name="dob" value="<?php echo $row->dob?>"><br><br>


	Address      : <textarea name="address" value=""><?php echo $row->address;?></textarea><br><br>


	District     :<select name="district">
					<option><?php echo $row->district;?></option>
					<option>TVM</option>
					<option>Kollam</option>
				</select><br><br>


	Pin      : <input type="text" name="pin" value="<?php echo $row->pin;?>"><br><br>



	username:<input type="text" name="uname" value="<?php echo $row->uname?>"><br><br>

	<a href="<?php echo base_url()?>main/user">Back</a>
	<input type="submit" name="update" value="Update">

<?php
	}
  }
	?>
		
		</fieldset></center>
		</form>
</body>
</html>