<!DOCTYPE html>
<html>
    <head>
        <title>forgot password</title>
            <meta charset=utf-8>
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <!---Fontawesome--->
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
            <!---Bootstrap5----->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <!---custom style---->
            <link rel="stylesheet" href="../css/styl.css">
    </head>
    <style>
      
    </style>

        <body>
                <?php 
                if($error=$this->session->flashdata('msg'))
                {
                ?>
                <p style="color:green"><strong>Successs</strong><?php echo $error;
                        ?></p>
                        <?php }
                        ?>
        
<form action="<?php echo base_url(); ?>main/send" method="post">
    <input type="email" name="from" class="form-control" placeholder="Enter Email" required><br>
    <textarea name="message" class="form-control" placeholder="Enter message here" required></textarea><br>
    <button type="submit" class="btn btn-primary">Send Message</button>
</form>
<script src="js/jquery.js"></script>
<script src="js/script.js"></script>
</body> 
</html>