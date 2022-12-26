<?php
/* Survey view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="add-form" style="display:none;">
  <div class="box box-block bg-white">
    <h2><strong>Add New</strong> Survey
      <div class="add-record-btn">
        <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-minus icon"></i> Hide</button>
      </div>
    </h2>
    <div class="row m-b-1">
      <div class="col-md-12">
        <form action="<?php echo site_url("survey/add_survey") ?>" method="post" name="add_survey" id="xin-form">
          <input type="hidden" name="_user" value="<?php echo $session['user_id'];?>">
          <div class="bg-white">
            <div class="box-block">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="employee">Title</label>
                    <input type="text" name="title" placeholder="Title" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="survey_information">Survey Information</label>
                <textarea class="form-control" placeholder="Survey Information" name="survey_information" cols="30" rows="3" id="survey_information"></textarea>
              </div>
              <hr>
              <div id="survey-questions">
                <div class="question-box" id="question-0">
                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group">
                        <label>Question</label>
                        <input type="text" name="question[]" placeholder="Question" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Answer Type</label>
                        <select name="answer_type[]" class="form-control" data-plugin="select_hrm" data-placeholder="Choose an answer type..." id="answer-0">
                          <option value="">Choose an answer type</option>
                          <option value="radio">Radio</option>
                          <option value="checkbox">Checkbox</option>
                          <option value="select">Select</option>
                          <option value="text">Text</option>
                          <option value="textarea">Textarea</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row" id="answer-option-box-0">
                  </div>
                  <div id="add-answer-options-0"><p></p></div>
                </div>
              </div>
              <p>
                <a href="javascript:void(0)" class="btn btn-info pull-right add-survey-question"><i class="fa fa-plus"></i> Add Question</a>
              </p>
              <button type="submit" class="btn btn-primary save">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="box box-block bg-white">
  <h2><strong>List All</strong> Survey
    <div class="add-record-btn">
      <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-plus icon"></i> Add New</button>
    </div>
  </h2>
  <div class="table-responsive" data-pattern="priority-columns">
    <table class="table table-striped table-bordered dataTable" id="hrms_table" style="width:100%;">
      <thead>
        <tr>
          <th>Action</th>
          <th>Survey Name</th>
          <th>Created By</th>
          <th>Created At</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<style type="text/css">
.question-box {
    background-color: #f4f4f4;
    padding: 10px;
    margin-bottom: 10px;
    display: table;
    width: 100%;
}
#add-option {
  margin-right: 15px;
}
</style>

<script type="text/javascript">
  
  var question = 1;

  var radio = '';
  radio += '<div class="col-md-3">';
  radio += '<input type="text" class="form-control" name="asnwer">';
  
  $('#xin-form').on('click', '.add-survey-question', function(){
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
    $('#survey-questions').append(html);
    question++;
    $('[data-plugin="select_hrm"]')['select2']({width:'100%'});
  });

  $('#xin-form').on('change', 'select[name="answer_type[]"]', function(){
    
    var answer_type = $(this).val();
    var id = $(this).attr('id');
    var answer_id = id.split('-')[1];
    var html = '';
    

    if(answer_type == 'text' || answer_type == 'textarea'){
      html = '';
      $('#add-answer-options-'+answer_id+' p').html('');
    } else if (answer_type == 'radio' || answer_type == 'checkbox' || answer_type == 'select') {
      
      html += '<div class="col-md-3">';
      html += '<div class="form-group">';
      html += '<input type="text" name="answer_option['+answer_id+'][]" class="form-control" placeholder="Answer" autofocus>';
      html += '</div>';
      html += '</div>';

      $('#add-answer-options-'+answer_id+' p').html('<a href="javascript:void(0);" id="add-option" data-answer_id="'+answer_id+'" class="btn btn-success"><i class="fa fa-plus"></i> Add Option</a><a href="javascript:void(0);" id="remove-option" data-answer_id="'+answer_id+'" class="btn btn-warning"><i class="fa fa-times"></i> Remove Option</a>');

    }

    $('#answer-option-box-'+answer_id).html(html);

  });

  $('#xin-form').on('click', '#add-option', function(){

    var answer_id = $(this).attr('data-answer_id');
    var html = '';
    html += '<div class="col-md-3">';
    html += '<div class="form-group">';
    html += '<input type="text" name="answer_option['+answer_id+'][]" class="form-control" placeholder="Answer">';
    html += '</div>';
    html += '</div>';
    $('#answer-option-box-'+answer_id).append(html);
    $('#answer-option-box-'+answer_id+' input:last-child').focus();

  });

  $('#xin-form').on('click', '#remove-option', function(){

    var answer_id = $(this).attr('data-answer_id');
    $('#answer-option-box-'+answer_id+' .col-md-3:last-child').remove();

  });

  $('#xin-form').on('click', '#remove-question', function(){

    var answer_id = $(this).attr('data-answer_id');
    $('#question-'+answer_id).remove();

  });

</script>