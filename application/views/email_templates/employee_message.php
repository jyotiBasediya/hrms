<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $type_msg?></title>
</head>

<body style="margin:0; background-color: #f4f4f4">
	<style type="text/css">
		
            @media only screen and (min-width: 767px){
                .tableFull, .tableHAlf {
                	width:320px !important;
                }
            }
	</style>
	<table style="width: 50%; background: #fff; max-width: 90%; margin: 0 auto; font-size: 14px; color: gray; padding-top: 0rem; box-shadow: 0 0 30px rgba(37,45,51,.1)!important;">
		<tbody>
			<tr style="color: #000;">
				<td>
					<table style="width: 100%; padding: 2rem;">
						<tr>
							<td width="" style="width: 100%; text-align:center;">
								<!-- <a href="" style="text-decoration: none; font-family: sans-serif;"> -->
									<!-- <strong style="font-size: 50px; color: #333;"> -->
										 <img src="<?php echo site_url();?>assets/images/logo.png" alt="logo" width="200px"/>
									<!-- </strong> -->
								<!-- </a> -->
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="font-family: sans-serif; width: 100%; padding: 0 2rem; color: #000; font-size: 16PX; text-align: left;">
					<p style="color: #666; font-size: 18px; text-align: left;">Hello, 
						<span style="color: #333;">
							<?= $name?>
						</span>
					</p>

					<?php if($type == 1) { ?>
						<P style="color: #666; font-size: 15px;">
							<b> <?= $emp_name?> </b> apply for <b><?= $number_days?></b> days leave form date <b> <?= $start_date?> to <?= $end_date?> </b> for the category <b> <?= $leave_name?> </b>  <?php if(!empty($note)) { ?>  due to  <b> <?= $note?> </b> <?php } ?>
						</p>
					<?php } elseif($type == 2) { ?>
						<P style="color: #666; font-size: 15px;">
							<b> <?= $emp_name?> </b> apply for <b> <?= $leave_name?> expense</b>  with amount <b> <?= $amount?> </b> <?php if(!empty($note)) { ?>  due to  <b> <?= $note?> </b> <?php } ?>
						</p>
					<?php } elseif($type == 3) { ?>
						<P style="color: #666; font-size: 15px;">
							HR <b><?=$status?></b> your request <b> <?= $leave_name?> expense</b>  with amount <b> <?= $amount?> </b>  <?php if(!empty($note)) { ?>  due to  <b> <?= $note?> </b> <?php } ?>
						</p>
					<?php } elseif($type == 4) { ?>
						<P style="color: #666; font-size: 15px;">
							HR <b><?=$status?></b> your request <b> <?= $leave_name?> expense</b>  with amount <b> <?= $amount?> </b>  <?php if(!empty($note)) { ?>  due to  <b> <?= $note?> </b> <?php } ?>
						</p>
					<?php } elseif($type == 5) { ?>
						<P style="color: #666; font-size: 15px;">
							HR <b><?=$status?></b> your request <b><?= $number_days?></b> days leave form date <b> <?= $start_date?> to <?= $end_date?> </b> for the category <b> <?= $leave_name?> </b>  <?php if(!empty($note)) { ?>  due to  <b> <?= $note?> </b> <?php } ?>
						</p>
					<?php } elseif($type == 6) { ?>
						<P style="color: #666; font-size: 15px;">
							HR <b><?=$status?></b> your request <b><?= $number_days?></b> days leave form date <b> <?= $start_date?> to <?= $end_date?> </b> for the category <b> <?= $leave_name?> </b>  <?php if(!empty($note)) { ?>  due to  <b> <?= $note?> </b> <?php } ?>
						</p>
					<?php } elseif($type == 7) { ?>
						<P style="color: #666; font-size: 15px;">
							<b> <?= $emp_name?> </b> added hour.
						</p>
					<?php } elseif($type == 8) { ?>
						<P style="color: #666; font-size: 15px;">
							HR <b><?=$status?></b> your tasksheet <?php if(!empty($note)) { ?>  due to  <b> <?= $note?> </b> <?php } ?>
						</p>
						
					<?php } ?>
		 			<p style="color: rgb(85, 85, 85); margin-bottom: 1px; font-size: 15px; margin-top: 29px;"><b> Best Regards,</b></p>

		 			<p style="font-weight: bold; color: rgb(0, 0, 0); font-size: 16px; margin-bottom: 0px; margin-top: 8px;">
		 				<a target="_blank" href="<?=base_url();?>" style="color: #32Bfc0;">AARAV SOLUTIONS HRMS PORTAL</a>
		 			</p>

					<p style="font-size: 14px;"><b>Email:</b>hrms@aaravsolutions.com</p>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>