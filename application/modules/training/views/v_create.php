
<?php

$action           = "training/save";
$trainingUUID     = "";
$trainingName     = "";
$trainingContent  = "";


if ($page == "Edit") 
{
  $action           = "training/update";
  $trainingUUID     = $data['trainingUUID'];
  $trainingName     = $data['trainingName'];
  $trainingContent  = $data['trainingContent'];
}

?>


<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-lg-8">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong> Training
              </div>

              <form action="<?=base_url($action);?>" method="post" class="form-horizontal">

                <input type="hidden" name="trainingUUID" value="<?=$trainingUUID;?>">

                <div class="card-body card-block">
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Training Name</label></div>
                          <div class="col-12 col-md-9"><input type="text" id="trainingName" name="trainingName" class="form-control" value="<?=$trainingName;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="email-input" class=" form-control-label">Content</label></div>
                          <div class="col-12 col-md-9">
                            <textarea name="trainingContent" id="trainingContent" rows="9" placeholder="type here..." class="form-control"><?=$trainingContent;?></textarea>
                          </div>
                      </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> Submit
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm" onclick="history.back(-1)">
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                </div>
              </form>
          </div>
      </div>


    </div>
  </div><!-- .animated -->
</div><!-- .content -->