<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Email Registration Detail</title>
</head>

<body style="margin:0; background-color: #f4f4f4">
	<style type="text/css">
		
            @media only screen and (min-width: 767px){
                .tableFull, .tableHAlf {
                	width:320px !important;
                }
            }
	</style>
	<table style="width: 100; max-width: 100%; margin: 0 auto; font-size: 14px; color: gray; padding-top: 0rem; box-shadow: 0 0 30px rgba(37,45,51,.1) !important;padding: 0px 67px;">
		<tbody>
			<tr style="color: #000;">
				<td>
					<table style="width: 100%; padding: 2rem;">
						<tr>
							<td width="" style="width: 100%; text-align:center;">
								<a href="" style="text-decoration: none; font-family: sans-serif;">
									 <strong style="font-size: 50px; color: #333;">
									 <!-- 	<a class="navbar-brand brand-logo" href="<?php echo site_url();?>dashboard"> -->
										  <img src="<?php echo site_url();?>assets/images/logo.png" alt="logo"  width="200px"/>
										
									</strong> 
		<!-- 							 <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="<?php echo site_url();?>dashboard">
            <img src="assets/images/logo.png" alt="logo" /> </a>
          <a class="navbar-brand brand-logo-mini" href="<?php echo site_url();?>dashboard">
            <img src="assets/images/logo-mini.png" alt="logo" /> </a>
        </div> -->
								</a>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="font-family: sans-serif; width: 100%;color: #000; font-size: 16PX; text-align: left;">
				

					<!-- <h2 style="font-size: 18px; text-align: center;"> Employee Detail</h2> -->
					<h2 style="font-size: 18px; text-align: center;">Thank you for your registration for Aarav Solutions HRMS Portal !</h2>

						<p>Below are your login Credentials-</p>
					 <table width="100%">
					 		<tr>
		                     <td style="padding:15px; width: 30%;">URL </td>
		                     <td style="padding:15px; width: 1%;">:</td>
		                     <td style="padding:15px; width: 65%; color: #878787;">
		                     	<a target="_blank" href="<?=base_url();?>" style="color: #32Bfc0;">Aarav Solutions HRMS URL</a> 
		                     </td>
		                  </tr>
		                  <tr>
		                     <td style="padding:15px; width: 30%;">Name </td>
		                     <td style="padding:15px; width: 1%;">:</td>
		                     <td style="padding:15px; width: 65%; color: #878787;"><?= $name;?> </td>
		                  </tr>
		                   <tr>
		                     <td style="padding:15px; width: 30%;">Email Id </td>
		                     <td style="padding:15px; width: 1%;">:</td>
		                     <td style="padding:15px; width: 65%; color: #878787;"><?= $email;?> </td>
		                  </tr>
		                  <tr>
		                     <td style="padding:15px; width: 30%;">Password</td>
		                     <td style="padding:15px; width: 1%;">:</td>
		                     <td style="padding:15px; width: 65%; color: #878787;"><?= $password;?></td>
		                  </tr>
		                
		               </table>
				</td>
			</tr>
			<tr>
				<td>
					<p style="color: rgb(85, 85, 85); margin-bottom: 1px; font-size: 15px; margin-top: 29px;">
						Please feel free to reach out to HRMS team for any queries and concern at 
						<a href="mailto:hrms@aaravsolutions.com">hrms@aaravsolutions.com</a>
						
					</p>

					<p style="color: rgb(85, 85, 85); margin-bottom: 1px; font-size: 15px; margin-top: 29px;">
						<b> Best Regards,</b>
					</p>
					<p style="font-weight: bold; color: rgb(0, 0, 0); font-size: 16px; margin-bottom: 0px; margin-top: 8px;">
						<a target="_blank" href="<?=base_url();?>" style="color: #32Bfc0;">Aarav Solutions HRMS Team</a>
					</p>
					
					
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>