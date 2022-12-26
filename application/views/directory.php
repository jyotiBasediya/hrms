<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Organization Chart</title>
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<style>
.treemenu li { list-style: none; }
.treemenu .toggler { cursor: pointer; }
.treemenu .toggler:before { display: inline-block; margin-right: 2pt; }
li.tree-empty > .toggler { opacity: 0.3; cursor: default; }
li.tree-empty > .toggler:before { content: "\2212"; }
li.tree-closed > .toggler:before { content: "+"; }
li.tree-opened > .toggler:before { content: "\2212"; }

.tree { background-color:#bbd725; color:#333; }
.tree li,
.tree li > a,
.tree li > span {
padding: 2pt 4pt;
border-radius: 4px;
}
.treemenu {
padding-left: 20px;
}
.tree li a {
color:#333;
text-decoration: none;
line-height: 20pt;
border-radius: 4px;
}
.tree li a:hover {
background-color:#0d7bf5;
color: #fff;
}
.active a {
color: #fff;
}
.tree li a.active:hover {
background-color: #34BC9D;
}
.treemenu small {
padding-left: 27px;
font-size: 12px;
color: #fff;
}
body{
background-color:#f1f1f1;
font-family: 'Lato', sans-serif;
}
.companyChart {
background-color: #fff;
padding: 15px;
}
.tree-opened .directoryHead{
background-color:#0d7bf5;
color:#fff;
}
@media(max-width:320px){
.treemenu {
padding-left: 5px;

}
}
</style>
</head>
<body>
<div class="companyChart">
<h3 style="margin:0 auto 15px auto;">Organization Chart</h3>


<?php
$firstLevel = $this->api_model->select_multiple_row("SELECT user_id, CONCAT(first_name, ' ', last_name) AS name, designation_id FROM hrms_employees WHERE head_employee=0 and company_id =".$company_id);
if(!empty($firstLevel)){
?>
<ul class="tree">
<?php
foreach ($firstLevel as $firstLevelEmployee) {
$designation = $this->api_model->getSingle('hrms_designations', array("designation_id" => $firstLevelEmployee->designation_id));
?>
<li>
<a href="javascript:;" class="directoryHead"><?=$firstLevelEmployee->name?></a>
<br>
<small><?=$designation->designation_name?></small>
<?php
$secondLevel = $this->api_model->select_multiple_row("SELECT user_id, CONCAT(first_name, ' ', last_name) AS name, designation_id FROM hrms_employees WHERE head_employee='".$firstLevelEmployee->user_id."'");
if(!empty($secondLevel)){
?>
<ul>
<?php
foreach ($secondLevel as $secondLevelEmployee) {
$designation = $this->api_model->getSingle('hrms_designations', array("designation_id" => $secondLevelEmployee->designation_id));
?>
<li>
<a href="javascript:;" class="directoryHead"><?=$secondLevelEmployee->name?></a>
<br>
<small><?=$designation->designation_name?></small>
<?php
$thirdLevel = $this->api_model->select_multiple_row("SELECT user_id, CONCAT(first_name, ' ', last_name) AS name, designation_id FROM hrms_employees WHERE head_employee='".$secondLevelEmployee->user_id."'");
if(!empty($thirdLevel)){
?>
<ul>
<?php
foreach ($thirdLevel as $thirdLevelEmployee) {
$designation = $this->api_model->getSingle('hrms_designations', array("designation_id" => $thirdLevelEmployee->designation_id));
?>
<li>
<a href="javascript:;" class="directoryHead"><?=$thirdLevelEmployee->name?></a>
<br>
<small><?=$designation->designation_name?></small>
<?php
$fourthLevel = $this->api_model->select_multiple_row("SELECT user_id, CONCAT(first_name, ' ', last_name) AS name, designation_id FROM hrms_employees WHERE head_employee='".$thirdLevelEmployee->user_id."'");
if(!empty($fourthLevel)){
?>
<ul>
<?php
foreach ($fourthLevel as $fourthLevelEmployee) {
$designation = $this->api_model->getSingle('hrms_designations', array("designation_id" => $fourthLevelEmployee->designation_id));
?>
<li>
<a href="javascript:;" class="directoryHead"><?=$fourthLevelEmployee->name?></a>
<br>
<small><?=$designation->designation_name?></small>
<?php
$fifthLevel = $this->api_model->select_multiple_row("SELECT user_id, CONCAT(first_name, ' ', last_name) AS name, designation_id FROM hrms_employees WHERE head_employee='".$fourthLevelEmployee->user_id."'");
if(!empty($fifthLevel)){
?>
<ul>
<?php
foreach ($fifthLevel as $fifthLevelEmployee) {
$designation = $this->api_model->getSingle('hrms_designations', array("designation_id" => $fifthLevelEmployee->designation_id));
?>
<li>
<a href="javascript:;" class="directoryHead"><?=$fifthLevelEmployee->name?></a>
<br>
<small><?=$designation->designation_name?></small>
<?php
$sixthLevel = $this->api_model->select_multiple_row("SELECT user_id, CONCAT(first_name, ' ', last_name) AS name, designation_id FROM hrms_employees WHERE head_employee='".$fifthLevelEmployee->user_id."'");
if(!empty($sixthLevel)){
?>
<ul>
<?php
foreach ($sixthLevel as $sixthLevelEmployee) {
$designation = $this->api_model->getSingle('hrms_designations', array("designation_id" => $sixthLevelEmployee->designation_id));
?>
<li>
<a href="javascript:;" class="directoryHead"><?=$sixthLevelEmployee->name?></a>
<br>
<small><?=$designation->designation_name?></small>
<?php
$seventhLevel = $this->api_model->select_multiple_row("SELECT user_id, CONCAT(first_name, ' ', last_name) AS name, designation_id FROM hrms_employees WHERE head_employee='".$sixthLevelEmployee->user_id."'");
if(!empty($seventhLevel)){
?>
<ul>
<?php
foreach ($seventhLevel as $seventhLevelEmployee) {
$designation = $this->api_model->getSingle('hrms_designations', array("designation_id" => $seventhLevelEmployee->designation_id));
?>
<li>
<a href="javascript:;" class="directoryHead"><?=$seventhLevelEmployee->name?></a>
<br>
<small><?=$designation->designation_name?></small>
<?php
$eighthLevel = $this->api_model->select_multiple_row("SELECT user_id, CONCAT(first_name, ' ', last_name) AS name, designation_id FROM hrms_employees WHERE head_employee='".$seventhLevelEmployee->user_id."'");
if(!empty($eighthLevel)){
?>
<ul>
<?php
foreach ($eighthLevel as $eighthLevelEmployee) {
$designation = $this->api_model->getSingle('hrms_designations', array("designation_id" => $eighthLevelEmployee->designation_id));
?>
<li>
<a href="javascript:;" class="directoryHead"><?=$eighthLevelEmployee->name?></a>
<br>
<small><?=$designation->designation_name?></small>
<?php
$ninethLevel = $this->api_model->select_multiple_row("SELECT user_id, CONCAT(first_name, ' ', last_name) AS name, designation_id FROM hrms_employees WHERE head_employee='".$eighthLevelEmployee->user_id."'");
if(!empty($ninethLevel)){
?>
<ul>
<?php
foreach ($ninethLevel as $ninethLevelEmployee) {
$designation = $this->api_model->getSingle('hrms_designations', array("designation_id" => $ninethLevelEmployee->designation_id));
?>
<li>
<a href="javascript:;" class="directoryHead"><?=$ninethLevelEmployee->name?></a>
<br>
<small><?=$designation->designation_name?></small>
<?php
$tenthLevel = $this->api_model->select_multiple_row("SELECT user_id, CONCAT(first_name, ' ', last_name) AS name, designation_id FROM hrms_employees WHERE head_employee='".$ninethLevelEmployee->user_id."'");
if(!empty($tenthLevel)){
?>
<ul>
<?php
foreach ($tenthLevel as $tenthLevelEmployee) {
$designation = $this->api_model->getSingle('hrms_designations', array("designation_id" => $tenthLevelEmployee->designation_id));
?>
<li>
<a href="javascript:;" class="directoryHead"><?=$tenthLevelEmployee->name?></a>
<br>
<small><?=$designation->designation_name?></small>
</li>
<?php
}
?>
</ul>
<?php
}
?>
</li>
<?php
}
?>
</ul>
<?php
}
?>
</li>
<?php
} 
?>
</ul>
<?php
}
?>
</li>
<?php
} 
?>
</ul>
<?php
}
?>
</li>
<?php
} 
?>
</ul>
<?php
}
?>
</li>
<?php
} 
?>
</ul>
<?php
}
?>
</li>
<?php
} 
?>
</ul>
<?php
}
?>
</li>
<?php
} 
?>
</ul>
<?php
}
?>
</li>
<?php
} 
?>
</ul>
<?php
}
?>
</li>
<?php
} 
?>
</ul>
<?php
}
?>

</div>
<script src="<?=base_url()?>skin/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?=base_url()?>skin/js/jquery.treemenu.js"></script>
<script>
$(function(){
$(".tree").treemenu({delay:300}).openActive();
});
</script>
</body>
</html>