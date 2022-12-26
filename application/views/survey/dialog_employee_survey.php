<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['answer_id']) && $_GET['data']=='view_answer'){
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?=$survey->title?></h4>
</div>
<form class="m-b-1">
  <div class="modal-body">
    <div id="survey-questions">
      <?php $i = 1; ?>
      <?php foreach($answers as $answer){ ?>
      <div class="question-box" id="question-0">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <p><strong>Q<?=$i?>.</strong> <?=$answer['question']?></p>
            </div>
            <div class="form-group">
              <p><strong>Ans.</strong> <?=$answer['answer']?></p>
            </div>
          </div>
        </div>
      </div>
      <?php $i++; } ?>
    </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
</form>
<?php }
?>
