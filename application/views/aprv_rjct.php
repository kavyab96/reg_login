<!DOCTYPE html>
<html>
<head>
	<title>approve&reject</title>
</head>
<style>
	table,th,tr{
		border-collapse: collapse;
	}
</style>
<body>
	<form method="post" action="">
	
		<table border="1">

			<thead>
				<tr>
					<th>Name</th>
					<th>Address</th>
					<th>DOB</th>
					
					<th colspan="2">Status</th>
					<th>Delete</th>
				</tr>
				<?php
			if($n->num_rows()>0)
			{
				foreach($n->result() as $row)
				{
			?>

					<tr>

						<td><?php echo $row->fname;?> <?php echo $row->lname;?></td>
						<td><?php echo $row->address;?></td>
						<td><?php echo $row->dob;?></td>
						

						<?php
							if($row->status==1)
							{
							?>
								<td>Approved</td>
								<td><a href="<?php echo base_url();?>main/rejectdetails/<?php echo $row->id;?>">Reject</a></td>
							<?php

							}
							elseif($row->status==2)
							{
							?>
								<td>Rejected</td>
								<td><a href="<?php echo base_url();?>main/approvedetails/<?php echo $row->id;?>">Approve</a></td>
							<?php	
							}
							else
							{
							?>
								
							
						
							<td><a href="<?php echo base_url()?>main/approvedetails/<?php echo $row->id;?>">Approve</a></td>
							<td><a href="<?php echo base_url()?>main/rejectdetails/<?php echo $row->id;?>">Reject</a></td>
							<?php
							}
							?>

							<td><a href="<?php echo base_url()?>main/deleteuser/<?php echo $row->id;?>">Delete</a></td>
					</tr>

					
			<?php
				}
			}
			else
			{
			?>
			<tr>
					<td>NO Data Found</td>
				</tr>

		<?php
			}
		

		?>


			
			</thead>
		</table>
		<a href="<?php echo base_url()?>main/admin">Back</a>
	</form>
</body>
</html>	