<!DOCTYPE html>
<html>
<head>
  <title>FAQ</title>
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>skin/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>skin/vendor/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>skin/vendor/font-awesome/css/font-awesome.min.css">
  <script type="text/javascript" src="<?=base_url()?>skin/vendor/jquery/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>skin/vendor/bootstrap/js/bootstrap.min.js"></script>
</head>


<style type="text/css">

#accordion .panel-heading {

  padding: 0;
}
#accordion .panel-title > a { 
  display: block;
  font-weight: bold;
  outline: medium none;
  padding: 9px 0;
  text-decoration: none;
}

#accordion .panel-title > a.accordion-toggle::before, #accordion a[data-toggle="collapse"]::before  {
  content:"";
  float: right;
  font-family: 'FontAwesome';


}
#accordion .panel-title > a.accordion-toggle.collapsed::before, #accordion a.collapsed[data-toggle="collapse"]::before  {
  content:"";
}
.panel.panel-default {
  background: #ededed none repeat scroll 0 0;
  padding: 5px 0px;
  margin-bottom: 15px;
}
.panel-title
{
  font-size: 18px;
  margin-bottom: 0px;
  padding: 0px 11px;

}
.panel-title a
{
  color: #003333;

}
.panel-body {
  font-size: 14px;
  padding: 6px 11px;
  border-top: 1px solid #ccc;
  margin-bottom: 7px;
}
.faq-conten 
{
  padding: 10px;
  background-color: #fff;
  margin-top: 15px;
}
.faq-conten h3
{
  font-size: 23px;
  margin-bottom: 12px;
}
.faq
{
  float: left;
  width: 100%;
  background-color: #ededed;
}

</style>
<body>

  <div class="faq">
    <img width="100%" class="img-responsive" src="<?=base_url()?>skin/img/faq.png">

    <div class="col-sm-12 col-xs-12">
      <div class="faq-conten">
        <h3>Frequently Asked Questions</h3>

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <?php $i = 0; ?>
          <?php foreach($faqs as $f){ ?>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading<?=$i?>">
              <h4 class="panel-title">
                <a <?=($i == 0)?'class="collapsed"':''?> role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapseOne">
                  <?=$f->title?>
                </a>
              </h4>
            </div>
            <div id="collapse<?=$i?>" class="panel-collapse collapse <?=($i == 0)?'in':''?>" role="tabpanel" aria-labelledby="heading<?=$i?>">
              <div class="panel-body">
                <?=html_entity_decode($f->description)?>
              </div>
            </div>
          </div>
          <?php $i++; } ?>
        </div>
      </div>
    </div>

  </div>

</body>
</html>