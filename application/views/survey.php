<!DOCTYPE html>
<html>
<head>
  <title>survey</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?=base_url()?>skin/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>skin/vendor/font-awesome/css/font-awesome.min.css">
  <script type="text/javascript" src="<?=base_url()?>skin/vendor/jquery/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>skin/vendor/tether/js/tether.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>skin/vendor/bootstrap/js/bootstrap.min.js"></script>
</head>


<style type="text/css">
b {
  font-weight: normal;
}
.form-group
{
  float: left;
  width: 100%;
  border-bottom: 1px solid #e1e1e1;
  padding-bottom: 1.5rem;
}
form {
  background: #fff none repeat scroll 0 0;
  padding: 33px 10px;
  position: relative;
}

.survey {
  background: #ededed none repeat scroll 0 0;
  padding: 19px;
}

fieldset {
  border: 1px solid #e1e1e1;
  padding: 13px 0;
  position: relative;
}
legend
{
  background: #fff none repeat scroll 0 0;
  display: inline-block;
  font-size: 16px;
  left: 22px;
  padding: 1px 11px;
  position: absolute;
  top: -15px;
  width: auto;
}
button
{
  background: #bbd725 none repeat scroll 0 0;
  color: #fff;
  font-size: 19px;
}
h4 {
  font-size: 18px;
  margin-bottom: 12px;
}

/***************radio*************/
.checkbox label:after, 
.radio label:after {
  content: '';
  display: table;
  clear: both;
}

.checkbox .cr,
.radio .cr {
  position: relative;
  display: inline-block;
  border: 2px solid #a1a1a1;
  border-radius: .25em;
  width: 1.3em;
  height: 1.3em;
  float: left;
  margin-right: .5em;
}

.radio input[type="radio"]:checked + .cr {
  border: 2px solid #0d7bf5;
}
.checkbox input[type="checkbox"]:checked + .cr {
  border: 2px solid #0d7bf5;
}
.radio .cr {
  border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
  position: absolute;
  font-size: 10px;
  line-height: 0;
  top: 50%;
  left: 20%;
}

.radio .cr .cr-icon {
  margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
  display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
  transform: scale(3) rotateZ(-20deg);
  opacity: 0;
  transition: all .3s ease-in;
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
  transform: scale(1) rotateZ(0deg);
  opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
  opacity: .5;
}

.cr-icon.fa.fa-circle, .cr-icon.fa.fa-check {
  color: #0d7bf5;
}
.form-control:focus
{
  border-color: #0D7BF5; 
}
select {
  -webkit-appearance: none;
  -moz-appearance:    none;
  appearance:         none;
}
.selectbasic2
{
  position: relative;
}
.selectbasic2 i {
  color: #bbd725;
  font-size: 20px;
  position: absolute;
  right: 11px;
  top: 10px;
}
/***************radio******************/
</style>
<body>
  <div class="survey">

    <form class="form-horizontal" action="<?=site_url('Api/addSurveyAnswers')?>" method="post">
      <fieldset>

        <input type="hidden" name="survey_id" value="<?=$survey_id?>">
        <input type="hidden" name="user_id" value="<?=$user_id?>">

        <!-- Form Name -->
        <legend>Survey Form</legend>

        <?php foreach($questions as $question){ ?>
          <?php if($question->answer_type == 'text'){ ?>

            <div class="form-group">
              <div class="col-md-12">
                <h4><?=$question->question?><input type="hidden" name="question[]" value="<?=$question->question_id?>"></h4>
                <input name="inputText_<?=$question->question_id?>" placeholder="<?=$question->question?>" class="form-control input-md" type="text">
              </div>
            </div><!-- Text -->

          <?php } else if($question->answer_type == 'select'){ ?>

            <div class="form-group">
              <div class="col-md-12">
                <h4><?=$question->question?><input type="hidden" name="question[]" value="<?=$question->question_id?>"></h4>
                <?php $options = json_decode($question->answer_options); ?>                
                <div class="selectbasic2">
                  <select name="inputSelect_<?=$question->question_id?>" class="form-control">
                    <?php foreach($options as $option){ ?>
                    <option value="<?=$option?>"><?=$option?></option>
                    <?php } ?>
                  </select>
                  <i class="fa fa-caret-down" aria-hidden="true"></i>
                </div>                
              </div>
            </div><!-- Select -->

          <?php } else if($question->answer_type == 'radio'){ ?>

            <div class="form-group">
              <div class="col-md-12">
                <h4><?=$question->question?> <input type="hidden" name="question[]" value="<?=$question->question_id?>"></h4>
                <?php $options = json_decode($question->answer_options); ?>
                <?php foreach($options as $option){ ?>
                <div class="radio">
                  <label >
                    <input type="radio" name="inputRadio_<?=$question->question_id?>" value="<?=$option?>">
                    <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                    <b><?=$option?></b>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div><!-- Radio -->

          <?php } else if($question->answer_type == 'checkbox'){ ?>

            <div class="form-group">
              <div class="col-md-12">
                <h4><?=$question->question?><input type="hidden" name="question[]" value="<?=$question->question_id?>"></h4>
                <?php $options = json_decode($question->answer_options); ?>
                <?php foreach($options as $option){ ?>
                <div class="checkbox">
                  <label style="">
                    <input type="checkbox" name="inputCheckbox_<?=$question->question_id?>[]" value="<?=$option?>" >
                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                     <b><?=$option?></b>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div><!-- Checkbox -->

          <?php } else if($question->answer_type == 'textarea'){ ?>

            <div class="form-group">
              <div class="col-md-12">  
                <h4><?=$question->question?><input type="hidden" name="question[]" value="<?=$question->question_id?>"></h4>                   
                <textarea class="form-control" name="inputTextarea_<?=$question->question_id?>" placeholder="<?=$question->question?>"></textarea>
              </div>
            </div><!-- Textarea -->

          <?php } ?>
        <?php } ?>

            <!-- Button -->
            <div class="form-group">
              <div class="col-md-12">
                <button class="btn btn-block"  type="submit">Submit</button>
              </div>
            </div>

      </fieldset>
    </form>


  </div>
</body>
</html>