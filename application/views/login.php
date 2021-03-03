<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<meta charset=utf-8>
            <meta name="viewport" content="width=device-width,initial-scale=1">

             <!---Fontawesome--->
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
            <!---Bootstrap5----->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <!---custom style---->
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/index_style.css');?>" media="all"/>

	<style>
		fieldset{
			width:300px;
			height: 300px;
		}

	</style>
</head>
<body>

	<nav class="navbar navbar-expand-lg top1 sticky-top top">
    <div class="container">
    <img  class="logo" style="">
        <a href="" class="text-decoration-none text-primary"></a>
       
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item">
                    <a href="<?php echo base_url()?>" class="nav-link text-dark">Home</a>
                </li>
               
                <li class="nav-item">
                    <a href="<?php echo base_url()?>main/login" class="nav-link text-dark">Sign In</a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url()?>main/register" class="nav-link text-dark" >Sign Up</a>
                </li>

               
               
            </ul>
        </div>
    </div>
</nav>



	<form action="<?php echo base_url()?>main/new_login" method="post">
		<center>
			<fieldset class="py-5">
				<h1>Login</h1>
				<input type="text" name="uname" placeholder="username/mob/email" class="form-control"><br>
				<input type="password" name="password" placeholder="password" class="form-control"><br>



				<input type="submit" name="submit" value="Login"><br>

				<a href="<?php echo base_url()?>main/forgotpassword">forgot password?</a>
			</fieldset>
		</center>
	</form>

</body>
</html>