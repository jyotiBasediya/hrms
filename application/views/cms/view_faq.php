<!-- <link rel="stylesheet" href="<?php echo base_url();?>ckeditor/samples/sample.css"> -->
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><?= $title;?></h1>
          <!-- <p>Bootstrap default form components</p> -->
        </div>
        <!--<ul class="app-breadcrumb breadcrumb">-->
        <!--  <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-home fa-lg"></i></a></li>-->
        <!--  <li class="breadcrumb-item"><a href="<?php echo base_url('admin/cms/faq');?>">Faq List</a></li> -->
        <!--  <li class="breadcrumb-item"><?= $title;?></li>-->
          <!-- <li class="breadcrumb-item"><a href="#">Form Components</a></li> -->
        <!--</ul>-->
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-12">
                
                <form class="form-horizontal" action="<?php echo site_url('CmsController/insert_faq');?>" enctype="multipart/form-data" method="post" data-parsley-validate="">
                    <input type="hidden" name="id" value="<?php echo $getfaqDetail->id; ?>">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Question</label>

                     <textarea required="" id="question" class="form-control ckeditor" name="question" required data-parsley-required data-parsley-required-message="Enter Question" readonly >
                          <?php echo $getfaqDetail->question;?>
                          
                    </textarea>

                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Answer</label>
                    
                     <textarea required="" id="answer" class="form-control ckeditor" name="answer" required data-parsley-required data-parsley-required-message="Enter Answer " readonly><?= $getfaqDetail->answer;?></textarea>

                  </div>
                    <!--<div class="tile-footer">-->
                    <!--  <button type="submit" name="add" class="btn btn-primary">Add</button>-->
                    <!--</div>-->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
<!-- /. PAGE WRAPPER  -->
</div>
<script src="<?php echo base_url() ;?>assets/js/ckeditor/ckeditor.js">  </script>
<script type="text/javascript">
    CKEDITOR.on('instanceReady', function () {
        $('#question').attr('required', '');
        $('#answer').attr('required', '');
        $.each(CKEDITOR.instances, function (instance) {
            CKEDITOR.instances[instance].on("change", function (e) {
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                    $('form').parsley().validate();
                }
            });
        });
    });

</script>