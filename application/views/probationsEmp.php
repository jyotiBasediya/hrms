<!DOCTYPE html>
<html>

<head>
	<title>Probations</title>
	<link rel="stylesheet" href="<?=base_url()?>skin/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>skin/css/core.css">

</head>
<body>
		<style>
		.pull-left{
			float: left;
		}
		.pull-right{
			float: right;
		}
		.privacyContent p {
		    padding: 10px 0 0;
		}
		p.pull-right.from-date {
    margin: 0;
    padding: 0;
    color: #acacac;
}
.privacyContent h3{
	color: #0C85FF;
}

		</style>	
	<div class="privacyPage">
		<div class="container">
			<div class="privacyContent">
				<div class="clearfix">
					<h3 class="pull-left">Probation</h3>
					<p class="pull-right from-date"><?php echo 'From '.$getgetProbationsData->start_date.' To '.$getgetProbationsData->end_date; ?></p>
				</div>

				<p><?=$getgetProbationsData->description?></p>
			</div>
		</div>
	</div>
	

	 
</body>
<!-- Hello Mam/Sir,

I have fixed all testing bugs and requesting to testing department for making sure that all modules are working fine. All bugs are presented in google bug sheet.

Bug Sheet URL :- https://docs.google.com/spreadsheets/d/1N3CZLXtW7MpdQBmJ0jBAWYLlyZSumrkLuPHJDE6oxbY/edit#gid=0

Thank you

Hemant Anjana

PHP Developer -->