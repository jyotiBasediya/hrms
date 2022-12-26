<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body style="background-color:#e1e1e1;">
    <div class="container" style="max-width:767px; width:100%; margin:0 auto;">
        <table align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;font-family: 'Lato', sans-serif; padding:15px" bgcolor="#fff">
            <tr bgcolor="" style="padding:0 15px;">
                <td align="center" bgcolor="#fff" style="padding:0;  background-color:#fff; background-repeat:no-repeat; background-size:cover;" cellpadding="0" cellspacing="0">
                    <table style="font-family: sans-serif; border-bottom:1px solid #ddd; " width="100%">
                        <tr>
                            <td style=""><img src="<?=base_url('uploads/company/'.$company_log)?>" alt="" style="display: block;margin: 8px 0;width: 200px; padding:0 0 0;">
                            </td>
                            <td style="padding-left:10px;">
                                <h3 style="margin:0;"><?=ucwords($company_name)?></h3>
                                <p style="margin:0 0 3px ; font-size:14px;">Email : <?=$company_email?> | Phone : <?=$company_phone?> </p>
                                <p style="margin:0 0 3px; font-size:14px;">Address: <?=$company_address?></p>
                            </td> 
                        </tr>
                    </table>
                </td>
            </tr> 
            <tr>
                <td>
                    <table align="center" cellpadding="0" cellspacing="0" width="100%" style="margin-top:15px;">
                        <tr>
                            <td style="text-align:left;">
                                <h2 style="margin:0 0 3px;">Payslip </h2>
                                <p style="margin:0 0 3px;">Payslip No. <?=$make_payment_id?></p>
                                <p style="margin:0;">Date: <?=$date?></p>
                            </td>
                        </tr>
                    </table>
                </td>         
            </tr>
            <tr>
                <td>
                    <table align="left" cellpadding="0" cellspacing="0" width="100%" style="border: 1px solid #ddd; text-align:left; margin:20px 0 ">
                        <tr style="">
                            <td style=" border-bottom: 1px solid #ddd; padding:5px; border-right:1px solid #ddd; background-color:#eee;">
                                Name
                            </td>
                            <td style="border-bottom: 1px solid #ddd; padding:5px; border-right:1px solid #ddd;">
                                <?=$fullname?>
                            </td>

                            <td style=" border-bottom: 1px solid #ddd; padding:5px; border-right:1px solid #ddd; background-color:#eee;">
                                Employee ID
                            </td>
                            <td style="border-bottom: 1px solid #ddd; padding:5px;">
                                <?=$employee_id?>
                            </td>
                        </tr>
                        <tr>
                            <td style=" border-bottom: 1px solid #ddd; padding:5px;border-right:1px solid #ddd; background-color:#eee;">
                                Department
                            </td>
                            <td style=" border-bottom: 1px solid #ddd; padding:5px;border-right:1px solid #ddd;">
                                <?=$department_name?>
                            </td>

                            <td style=" border-bottom: 1px solid #ddd; padding:5px;border-right:1px solid #ddd; background-color:#eee;">
                                Designation
                            </td>
                            <td style=" border-bottom: 1px solid #ddd; padding:5px;">
                                <?=$designation_name?>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center; border-right:1px solid #ddd; background-color:#eee;">
                                Salary Month
                            </td>
                            <td style=" border-right:1px solid #ddd; padding:5px;">
                                <?=$payment_date?>
                            </td>                        
                            <td style="border-right:1px solid #ddd; padding:5px; background-color:#eee;">
                                Payslip No
                            </td>
                            <td style="padding:5px;">
                                <?=$make_payment_id?>
                            </td>
                        </tr> 
                    </table>
                </td>
            </tr> 
            <tr>
                <td>
                    <table align="center" cellpadding="0" cellspacing="0" width="100%" style=" border: 1px solid #ddd;">
                        <tr>
                            <td style="text-align:left; background-color:#eee;  border-bottom: 1px solid #ddd;  padding:5px">
                                Earning Salary
                            </td>
                            <td style="text-align:left; background-color:#eee;  border-bottom: 1px solid #ddd;  padding:5px">
                                Amount
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; border-bottom: 1px solid #ddd; padding:5px ">
                                House Rent Allowance
                            </td>
                            <td style="text-align:left; border-bottom: 1px solid #ddd;  padding:5px">
                                <?=$hra?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; border-bottom: 1px solid #ddd; padding:5px ">
                                Medical Allowance
                            </td>
                            <td style="text-align:left; border-bottom: 1px solid #ddd;  padding:5px">
                                <?=$ma?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; border-bottom: 1px solid #ddd;  padding:5px">
                                Travelling Allowance
                            </td>
                            <td style="text-align:left; border-bottom: 1px solid #ddd; padding:5px ">
                                <?=$ta?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:left;  padding:5px ">
                                Dearness Allowance
                            </td>
                            <td style="text-align:left;  padding:5px ">
                                <?=$da?>
                            </td>
                        </tr>                    
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table align="center" cellpadding="0" cellspacing="0" width="100%" style=" border: 1px solid #ddd; margin:20px 0;">
                        <tr>
                            <td style="text-align:left; background-color:#eee;  border-bottom: 1px solid #ddd;  padding:5px">
                                Deduction Salary
                            </td>
                            <td style="text-align:left; background-color:#eee;  border-bottom: 1px solid #ddd;  padding:5px">
                                Amount
                            </td>
                        </tr>                    
                        <tr>
                            <td style="text-align:left; border-bottom: 1px solid #ddd; padding:5px ">
                                Provident Fund
                            </td>
                            <td style="text-align:left; border-bottom: 1px solid #ddd;  padding:5px">
                                <?=$pf?>
                            </td>
                        </tr>                    
                        <tr>
                            <td style="text-align:left; border-bottom: 1px solid #ddd; padding:5px ">
                                Tax Deduction
                            </td>
                            <td style="text-align:left; border-bottom: 1px solid #ddd;  padding:5px">
                                <?=$td?>
                            </td>
                        </tr> 
                        <tr>
                            <td style="text-align:left;  padding:5px ">
                                Security Deposit
                            </td>
                            <td style="text-align:left;  padding:5px ">
                                <?=$sd?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr> 
            <tr>
                <td>
                    <table align="center" cellpadding="0" cellspacing="0" width="100%" style=" border: 1px solid #ddd; margin:20px 0;">
                        <tr>
                            <td style="padding:5px; background-color:#ddd; width:100%; text-align:center;" colspan="8">Payment Details</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width:50%;padding:5px;border-right:1px solid #ddd; ">
                            </td>
                            <td colspan="2" style="width:50%;padding:5px; border-right:1px solid #ddd; border-bottom:1px solid #ddd; ">
                                Basic Salary
                            </td>
                            <td colspan="4" style="width:50%; padding:5px; text-align:right;border-bottom:1px solid #ddd;">
                                <?=$bs?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width:50%;padding:5px; border-right:1px solid #ddd; border-bottom:1px solid #ddd;">
                            </td>
                            <td colspan="1" style="width:50%; padding:5px; border-bottom:1px solid #ddd; text-align:left; border-right:1px solid #ddd;">
                                Gross Salary
                            </td>
                            <td colspan="1" style="width:50%; padding:5px; border-bottom:1px solid #ddd;  text-align:right">
                                <?=$gs?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width:50%;padding:5px;border-bottom:1px solid #ddd;border-right:1px solid #ddd; ">
                            </td>
                            <td colspan="1" style="width:50%; padding:5px; border-bottom:1px solid #ddd;text-align:left; border-right:1px solid #ddd;">
                                Total Allowance
                            </td>
                            <td colspan="1" style="width:50%; padding:5px;border-bottom:1px solid #ddd; text-align:right">
                                <?=$ta2?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width:50%;padding:5px; border-bottom:1px solid #ddd;border-right:1px solid #ddd; ">
                            </td>
                            <td colspan="1" style="width:50%; padding:5px; border-bottom:1px solid #ddd;text-align:left; border-right:1px solid #ddd;">
                                Total Deduction
                            </td>
                            <td colspan="1" style="width:50%; padding:5px;border-bottom:1px solid #ddd; text-align:right">
                                <?=$td2?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width:50%;padding:5px; border-bottom:1px solid #ddd;border-right:1px solid #ddd; ">
                            </td>
                            <td colspan="1" style="width:50%; padding:5px; border-bottom:1px solid #ddd;text-align:left; border-right:1px solid #ddd;">
                                Net Salary
                            </td>
                            <td colspan="1" style="width:50%; padding:5px;border-bottom:1px solid #ddd; text-align:right">
                                <?=$nt?>
                            </td>
                        </tr> 
                        <tr>
                            <td colspan="2" style="width:50%;padding:5px; border-bottom:1px solid #ddd;border-right:1px solid #ddd; ">
                            </td>
                            <td colspan="1" style="width:50%; padding:5px; border-bottom:1px solid #ddd;text-align:left; border-right:1px solid #ddd;">
                                Paid Amount
                            </td>
                            <td colspan="1" style="width:50%; padding:5px;border-bottom:1px solid #ddd; text-align:right">
                                <?=$pa?>
                            </td>
                        </tr> 
                        <tr>
                            <td colspan="2" style="width:50%;padding:5px;border-right:1px solid #ddd; ">
                            </td>
                            <td colspan="1" style="width:50%; padding:5px;text-align:left; border-right:1px solid #ddd;">
                                Payment Method
                            </td>
                            <td colspan="1" style="width:50%; padding:5px; text-align:right">
                                <?=$p_method?>
                            </td>
                        </tr> 
                    </table>
                </td>
            </tr>  
            <tr>
                <td style="text-align:right; padding:20px 0 10px;">Authorised Signatory</td>
            </tr>
        </table>
    </div>
</body>
</html>