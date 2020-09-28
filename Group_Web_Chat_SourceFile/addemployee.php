<?php
	$firstnamefielddata = array(
			        'type'			=> 'text',
			        'name'          => 'first_name',
			        'autocomplete'	=> 'off',
			        'value'			=> set_value('first_name'),
				);
	$lastnamefielddata = array(
			        'type'			=> 'text',
			        'name'          => 'last_name',
			        'autocomplete'	=> 'off',
			        'value'			=> set_value('last_name'),
				);
	$positionfielddata = array(
			        'type'			=> 'text',
			        'name'          => 'position',
			        'autocomplete'	=> 'off',
			        'value'			=> set_value('position'),
				);
	$incomefielddata = array(
			        'type'			=> 'number',
			        'name'          => 'income',
			        'autocomplete'	=> 'off',
			        'value'			=> set_value('income'),
				);
	$contactnumberfielddata = array(
			        'type'			=> 'number',
			        'name'          => 'contact_number',
			        'autocomplete'	=> 'off',
			        'value'			=> set_value('contact_number'),
				);
	$contactemailfielddata = array(
			        'type'			=> 'email',
			        'name'          => 'contact_email',
			        'autocomplete'	=> 'off',
			        'value'			=> set_value('contact_email'),
				);
	$descriptionfielddata = array(
			        'type'			=> 'text',
			        'name'          => 'description',
			        'autocomplete'	=> 'off',
			        'value'			=> set_value('description'),
				);
	$resetfielddata = array(
					'name'			=> 'reset',
					'value'			=> 'Cancel',
				);
	$submitfielddata = array(
			        'name'          => 'submit',
			        'value'			=> 'Save',
				);
	if (isset($message)) 
	{
	?>
		<script type="text/javascript">
			alert('<?php echo $message; ?>');
		</script>
	<?php
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo link_tag('/Assest/Css/styleemployee.css');?>
	<?php
		include 'header.php';
	?>
	<div id="outerbox">
		<div id="inner1">
			<h2>Add Employee</h2>
		</div>
		<div id="inner2">
			<?php echo form_open('admin/addemployee');?>
				<div id="profilesection">
					<table>
						<tr>
							<td>
								<label><b>First Name</b></label>
								<?php echo form_input($firstnamefielddata);?><br>
								<span id="error"><?php echo form_error('first_name'); ?></span>
							</td>
							<td>
								<label><b>Last Name</b></label>
								<?php echo form_input($lastnamefielddata);?><br>
								<span id="error"><?php echo form_error('last_name'); ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<label><b>Position</b></label>
								<?php echo form_input($positionfielddata);?><br>
								<span id="error"><?php echo form_error('position'); ?></span>
							</td>
							<td>
								<label><b>Income Per Month</b></label><br>
								<i class="fa fa-rupee fa-1x" aria-hidden="true"></i><?php echo form_input($incomefielddata);?><br>
								<span id="error"><?php echo form_error('income'); ?></span>
							</td>
						</tr>
					</table>
				</div>
				<div id="contactsection">
					<table>
						<tr>
							<td>
								<label><b>Contact Number</b></label>
								<?php echo form_input($contactnumberfielddata);?><br>
								<span id="error"><?php echo form_error('contact_number'); ?></span>
							</td>
							<td>
								<label><b>Contact Email</b></label>
								<?php echo form_input($contactemailfielddata);?><br>
								<span id="error"><?php echo form_error('contact_email'); ?></span>
							</td>
						</tr>
					</table>
				</div>
				<div id="descriptionsection">
					<table>
						<tr>
							<td>
								<label><b>Description</b></label>
								<?php echo form_input($descriptionfielddata);?><br>
								<span id="error"><?php echo form_error('description'); ?></span>
							</td>
						</tr>
					</table>
					<div id="submitbutton">
						<?php echo form_reset($resetfielddata);?>
						<?php echo form_submit($submitfielddata);?>
					</div>
				</div>
			<?php echo form_close();?>
		</div>
	</div>
	<div id="outertable">
		<table>
			<thead>
				<tr>
					<th>Sr No.</th>
					<th>Position</th>
					<th>Employee Id</th>
					<th>Full Name</th>
					<th>Contact Number</th>
					<th>Contact Email</th>
					<th>Joining Date</th>
					<th>Action Perform</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$a=1;
					foreach ($employee_array as $row)
					{
						$joining_date=date('d-m-yy',strtotime($row['date_of_joining']));
					?>
						<tr>
							<td><?php echo $a++;?></td>
							<td><?php echo $row['position'];?></td>
							<td><?php echo $row['employee_id'];?></td>
							<td><?php echo $row['first_name'].' '.$row['last_name'];?></td>
							<td><?php echo $row['contact_number'];?></td>
							<td><?php echo $row['contact_email'];?></td>
							<td><?php echo $joining_date;?></td>
							<td>
								<a href="<?php echo base_url('admin/editemployee/'.$row["employee_id"]);?>">
									<i class="fa fa-pencil fa-1x" aria-hidden="true"></i>
								</a>&nbsp;
								<a href="<?php echo base_url('admin/viewemployee/'.$row["employee_id"]);?>">
									<i class="fa fa-eye fa-1x" aria-hidden="true"></i>
								</a>&nbsp;
								<?php
										if($row['role'] != 'Admin')
										{
										?>
										<a href="<?php echo base_url('admin/deleteemployee/'.$row["employee_id"]);?>">
											<i class="fa fa-trash-o fa-1x" aria-hidden="true"></i>
										</a>
										<?php
										}
									?>
							</td>
						</tr>
					<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<?php
		include 'footer.php';
	?>