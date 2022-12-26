<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Untitled Document</title>
   </head>
   <!-- background-image:url(bg-color600.png);-->
   <body style="background-color:#e1e1e1;">
      <div class="container" style="max-width:767px; width:100%; margin:0 auto;">
      <table align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
         <tr bgcolor="" style="padding:0 15px;">
            <td align="center" bgcolor="#fff" style="padding:0;  background-color:#282B32; background-repeat:no-repeat; background-size:cover;" cellpadding="0" cellspacing="0">
               <table style="font-family: sans-serif;  " width="100%">
                  <tr>
                     <td style=""><img src="<?=base_url('skin/img/logo.png')?>" alt="" style="display: block;margin: 8px auto;width: 180px; padding:10px 0 150px;">
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr bgcolor="#282B32" style="padding:0 15px;">
            <td align="center" bgcolor=" #3E4148" style="padding:0 20px;" cellpadding="0" cellspacing="0">
               <table style="font-family: sans-serif; max-width:500px; margin:-120px 0 20px; background-color: #fff; box-shadow:1px 3px 9px 4px rgba(0,0,0,0.3);" width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                     <td>
                        <table style="font-family: sans-serif;margin-bottom: 0;" cellpadding="0" cellspacing="0">
                           <tr bgcolor="#fff" style="">
                              <td style="padding:30px  20px 30px;">
                                 <table style="font-family: sans-serif;" width="100%">
                                    <tr>
                                       <td width="100%">
                                          <p style="font-size:16px;margin:4px 0;margin: 0 0;">Hello, <strong style="font-size:20px;color:#0d7bf5;"><?php if(!empty($fullname)) { echo ucwords($fullname); } ?></strong></p>
                                          </h4>
                                          <div style="padding-top:20px;">
                                             <div style="font-size:14px;">
                                                <p>Did you forgot your password?! It is okay, it is happening sometimes.Please click on the link below to reset your password.</p>


                                                <p>
                                                   <a href="<?=base_url();?>reset_verify?token=<?php echo $id;?>" style="padding: 10px 15px;background: #00afa9;color: #fff;border-radius: 50px;width: 50%;margin: 40px auto;text-align: center;text-decoration: none;display: block;">Reset Password</a>
                                                </p>
                                             </div>
                                          </div>
                                       </td>
                                    </tr> 
                                    
                                    <tr>
                     <td>
                        <table bgcolor="#fff" style="font-family: sans-serif;margin-bottom: 20px; background-color:#fff;" width="100%;" cellpadding="0" cellspacing="0">
                           <tr bgcolor="">
                              <td style="text-align:left; background-color:#fff;">
                              <span style="background-color:#ddd; display:block; width:100%;
                              height:1px; margin-top:15px;"></span>
                                 <div style="padding-bottom:10px;">
                                    <div style="margin:15px 0 0;">
                                       <p style="margin:0;">Thank you</p>
                                       <h5 style="margin:0;color:#505050;font-size:16px; font-weight:normal;">
                                          <a href="<?php echo base_url();?>" style="color:#333;">Aarav Solution</a>
                                       </h5>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <tr bgcolor="#fff">
                              <td>
                           <tr>
                              <td style="color:#333 background-color:#fff; ">
                                 <p style="margin:0;font-size:12px;padding:11px 0 3px;text-align:left;">© Copyright <?=date('Y')?> Aarav Pvt. Ltd. All Rights Reserved.</p>
                              </td>
                           </tr>
                           </td>
                           </tr>
                        </table>
                     </td>
                  </tr>
                                 </table>
                              </td>
                           </tr>
                           
                        </table>
                     </td>
                  </tr>
                  
               </table>
            </td>
         </tr>
         <tr bgcolor="" style="padding:0 15px;">
            <td align="center" bgcolor="#3E4148" style="padding:0;" cellpadding="0" cellspacing="0">
               <br>
               <br>
             
            </td>
         </tr>
     
        
      </table>
   </body>
</html>