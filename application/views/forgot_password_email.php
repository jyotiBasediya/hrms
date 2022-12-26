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
                            <!--    <a class="navbar-brand brand-logo" href="<?php echo site_url();?>dashboard"> -->
                                <img src="<?php echo site_url();?>assets/images/logo.png" alt="logo"  width="200px"/>
                              
                           </strong> 
                        </a>
                        
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td style="font-family: sans-serif; width: 100%;color: #000; font-size: 16PX; text-align: left;">
            
                <p style="font-size:16px;margin:4px 0;margin: 0 0;">Hello, <strong style="font-size:20px;color:#0d7bf5;"><?php if(!empty($fullname)) { echo ucwords($fullname); } ?></strong></p>

                 <p>Did you forgot your password?! It is okay, it is happen sometimes. Please click on the link below to reset your password.</p>

                 <p>
                     <a href="<?=base_url();?>Forgot_password/reset_verify?token=<?php echo $id;?>" style="padding: 10px 15px;background: #00afa9;color: #fff;border-radius: 50px;width: 50%;margin: 40px auto;text-align: center;text-decoration: none;display: block;">Reset Password</a>
                  </p>
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