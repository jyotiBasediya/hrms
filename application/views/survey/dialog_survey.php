<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['survey_id']) && $_GET['data']=='survey'){
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data">Edit Survey</h4>
</div>
<form class="m-b-1" action="<?php echo site_url("survey/update").'/'.$survey_id; ?>" method="post" name="edit_survey" id="edit_survey">
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="employee">Title</label>
          <input type="text" name="title" placeholder="Title" class="form-control" value="<?=$title?>">
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="survey_information">Survey Information</label>
      <textarea class="form-control" placeholder="Survey Information" name="survey_information" cols="30" rows="3" id="survey_information"><?=$description?></textarea>
    </div>
    <hr>
    <div id="survey-questions">
      <?php $i = 0; ?>
      <?php foreach($survey_questions as $question){ ?>
      <div class="question-box" id="question-<?=$i?>">
        <input type="hidden" name="question_id[]" value="<?=$question->question_id?>">
        <div class="row">
          <div class="col-md-9">
            <div class="form-group">
              <label>Question</label>
              <input type="text" name="question[]" placeholder="Question" class="form-control" value="<?=$question->question?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Answer Type</label>
              <select name="answer_type[]" class="form-control" data-plugin="select_hrm" data-placeholder="Choose an answer type..." id="answer-<?=$i?>">
                <option value="">Choose an answer type</option>
                <option value="radio" <?=($question->answer_type == 'radio')?'selected':''?>>Radio</option>
                <option value="checkbox" <?=($question->answer_type == 'checkbox')?'selected':''?>>Checkbox</option>
                <option value="select" <?=($question->answer_type == 'select')?'selected':''?>>Select</option>
                <option value="text" <?=($question->answer_type == 'text')?'selected':''?>>Text</option>
                <option value="textarea" <?=($question->answer_type == 'textarea')?'selected':''?>>Textarea</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <?php $answers = json_decode($question->answer_options); ?>
          <?php if(!empty($answers)){ ?>
          <?php foreach($answers as $answer){ ?>
          <div class="col-md-3">
            <div class="form-group">
              <input type="text" name="answer_option[<?=$i?>][]" class="form-control" placeholder="Answer" value="<?=$answer?>">
            </div>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
        <div class="row" id="answer-option-box-<?=$i?>">
        </div>
        <div id="add-answer-options-<?=$i?>">
          <p>
            <?php if($question->answer_type == 'radio' || $question->answer_type == 'checkbox' || $question->answer_type == 'select'){ ?>
              <a href="javascript:void(0);" id="add-option" data-answer_id="<?=$i?>" class="btn btn-success"><i class="fa fa-plus"></i> Add Option</a>
              <a href="javascript:void(0);" id="remove-option" data-answer_id="<?=$i?>" class="btn btn-warning"><i class="fa fa-times"></i> Remove Option</a>
            <?php } ?>
          </p>
        </div>
      </div>
      <?php $i++; } ?>
    </div>
    <p>
      <a href="javascript:void(0)" class="btn btn-info add-survey-question"><i class="fa fa-plus"></i> Add Question</a>
    </p>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Update</button>
  </div>
</form><script type="text/javascript">
  
  var question = <?=$i?>;

  var radio = '';
  radio += '<div class="col-md-3">';
  radio += '<input type="text" class="form-control" name="asnwer">';
  
  $('.m-b-1').on('click', '.add-survey-question', function(){
    var html = '';
    html += '<div class="question-box" id="question-'+question+'">';
    html += '<div class="row">';
    html += '<div class="col-md-9">';
    html += '<div class="form-group">';
    html += '<label>Question</label>';
    html += '<input type="text" name="question[]" placeholder="Question" class="form-control">';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-md-3">';
    html += '<div class="form-group">';
    html += '<label>Answer</label>';
    html += '<select name="answer_type[]" class="form-control" data-plugin="select_hrm" data-placeholder="Choose an answer type..." id="answer-'+question+'">';
    html += '<option value="">Choose an answer type</option>';
    html += '<option value="radio">Radio</option>';
    html += '<option value="checkbox">Checkbox</option>';
    html += '<option value="select">Select</option>';
    html += '<option value="text">Text</option>';
    html += '<option value="textarea">Textarea</option>';
    html += '</select>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="row" id="answer-option-box-'+question+'">';
    html += '</div>';
    html += '<div id="add-answer-options-'+question+'" class="pull-left"><p></p></div>';
    html += '<div id="remove-answer-options-'+question+'" class="pull-right"><p><a href="javascript:void(0);" id="remove-question" data-answer_id="'+question+'" class="btn btn-danger"><i class="fa fa-times"></i> Remove Question</a></p></div>';
    html += '</div>';
    $('.m-b-1 #survey-questions').append(html);
    question++;
    $('[data-plugin="select_hrm"]')['select2']({width:'100%'});
  });

  $('.m-b-1').on('change', 'select[name="answer_type[]"]', function(){
    
    var answer_type = $(this).val();
    var id = $(this).attr('id');
    var answer_id = id.split('-')[1];
    var html = '';
    

    if(answer_type == 'text' || answer_type == 'textarea'){
      html = '';
      $('.m-b-1 #add-answer-options-'+answer_id+' p').html('');
    } else if (answer_type == 'radio' || answer_type == 'checkbox' || answer_type == 'select') {
      
      html += '<div class="col-md-3">';
      html += '<div class="form-group">';
      html += '<input type="text" name="answer_option['+answer_id+'][]" class="form-control" placeholder="Answer" autofocus>';
      html += '</div>';
      html += '</div>';

      $('.m-b-1 #add-answer-options-'+answer_id+' p').html('<a href="javascript:void(0);" id="add-option" data-answer_id="'+answer_id+'" class="btn btn-success"><i class="fa fa-plus"></i> Add Option</a><a href="javascript:void(0);" id="remove-option" data-answer_id="'+answer_id+'" class="btn btn-warning"><i class="fa fa-times"></i> Remove Option</a>');

    }

    $('.m-b-1 #answer-option-box-'+answer_id).html(html);

  });

  $('.m-b-1').on('click', '#add-option', function(){

    var answer_id = $(this).attr('data-answer_id');
    var html = '';
    html += '<div class="col-md-3">';
    html += '<div class="form-group">';
    html += '<input type="text" name="answer_option['+answer_id+'][]" class="form-control" placeholder="Answer">';
    html += '</div>';
    html += '</div>';
    $('.m-b-1 #answer-option-box-'+answer_id).append(html);
    $('.m-b-1 #answer-option-box-'+answer_id+' input:last-child').focus();

  });

  $('.m-b-1').on('click', '#remove-option', function(){

    var answer_id = $(this).attr('data-answer_id');
    $('.m-b-1 #answer-option-box-'+answer_id+' .col-md-3:last-child').remove();

  });

  $('.m-b-1').on('click', '#remove-question', function(){

    var answer_id = $(this).attr('data-answer_id');
    $('.m-b-1 #question-'+answer_id).remove();

  });

 $(document).ready(function(){

		var hrms_table = $('#hrms_table').dataTable({
			"bDestroy": true,
			"ajax": {
				url : "<?php echo site_url("survey/survey_list") ?>",
				type : 'GET'
			},
			"fnDrawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();          
			}
    	});
		
		$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 
		
		$('#description2').summernote({
		  height: 151,
		  minHeight: null,
		  maxHeight: null,
		  focus: false
		});
		$('.note-children-container').hide();
		// Survey Date
		$('.d_survey_date').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:'yy-mm-dd',
		yearRange: '1900:' + (new Date().getFullYear() + 15),
		beforeShow: function(input) {
			$(input).datepicker("widget").show();
		}
		});
		// Survey Month & Year
		$('.d_month_year').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat:'yy-mm',
		yearRange: '1900:' + (new Date().getFullYear() + 15),
		beforeShow: function(input) {
			$(input).datepicker("widget").addClass('hide-calendar');
		},
		onClose: function(dateText, inst) {
			var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
			var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
			$(this).datepicker('setDate', new Date(year, month, 1));
			$(this).datepicker('widget').removeClass('hide-calendar');
			$(this).datepicker('widget').hide();
		}
			
		});
		
		$("#edit_survey").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		var description = $("#description2").code();
		fd.append("is_ajax", 1);
		fd.append("edit_type", 'survey');
		fd.append("description", description);
		fd.append("form", action);
		e.preventDefault();
		$('.icon-spinner3').show();
		$('.save').prop('disabled', true);
		$.ajax({
			url: e.target.action,
			type: "POST",
			data:  fd,
			contentType: false,
			cache: false,
			processData:false,
			success: function(JSON)
			{
				if (JSON.error != '') {
					toastr.error(JSON.error);
						$('.save').prop('disabled', false);
						$('.icon-spinner3').hide();
				} else {
					hrms_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('.icon-spinner3').hide();
					$('.edit-modal-data').modal('toggle');
					$('.save').prop('disabled', false);
				}
			},
			error: function() 
			{
				toastr.error(JSON.error);
				$('.icon-spinner3').hide();
				$('.save').prop('disabled', false);
			} 	        
	   });
	});
	});	
  </script>
<?php } else if(isset($_GET['jd']) && isset($_GET['survey_id']) && $_GET['data']=='view_survey'){
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data">View Survey</h4>
</div>
<form class="m-b-1">
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="employee">Title</label>
          <p><strong><?=$title?></strong></p>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="survey_information">Survey Information</label>
      <p><strong><?=$description?></strong></p>
    </div>
    <hr>
    <div id="survey-questions">
      <?php $i = 0; ?>
      <?php foreach($survey_questions as $question){ ?>
      <div class="question-box" id="question-0">
        <div class="row">
          <div class="col-md-9">
            <div class="form-group">
              <label>Question</label>
              <p><strong><?=$question->question?></strong></p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Answer Type</label>
              <p><strong><?=ucwords($question->answer_type)?></strong></p>
            </div>
          </div>
        </div>
        <?php $answers = json_decode($question->answer_options); ?>
        <?php if(!empty($answers)){ ?>
        <label>Answers</label>
        <div class="row">
          <?php foreach($answers as $answer){ ?>
          <div class="col-md-3">
            <div class="form-group">
              <strong><?=$answer?></strong>
            </div>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
</form>
<?php }
?>
