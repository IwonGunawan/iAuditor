
<?php

$action             = "checklist/save";
$checklistUUID      = "";
$sectionId          = "";
$inspectionId       = "";
$questionId         = "";
$question           = "";
$targetVal          = "";
$actualVal          = "";
$note               = "";


if ($page == "Edit") 
{
  $action             = "checklist/update";
  $checklistUUID      = $data['checklistUUID'];
  $sectionId          = $data['sectionId'];
  $inspectionId       = $data['inspectionId'];
  $questionId         = $data['questionId'];
  $question           = $data['question'];
  $targetVal          = $data['targetVal'];
  $actualVal          = $data['actualVal'];
  $note               = $data['note'];
}

?>


<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-lg-8">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong> Checklist
              </div>

              <form action="<?=base_url($action);?>" method="post" class="form-horizontal">

                <input type="hidden" name="checklistUUID" value="<?=$checklistUUID;?>">

                <div class="card-body card-block">
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Section</label></div>
                          <div class="col-12 col-md-9">
                            <select name="sectionId" class="form-control">
                                <option value="" style="display: none;">Please select</option>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="email-input" class=" form-control-label">Inspection</label></div>
                          <div class="col-12 col-md-9">
                            <select name="inspectionId" class="form-control">
                                <option value="" style="display: none;">Please select</option>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="password-input" class=" form-control-label">Question</label></div>
                          <div class="col-12 col-md-9">
                            <select name="questionId" class="form-control">
                                <option value="1" style="display: none;">Please select</option>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Target Val</label></div>
                          <div class="col-12 col-md-9"><input type="number" id="targetVal" name="targetVal" value="<?=$targetVal;?>" class="form-control">
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Actual Val</label></div>
                          <div class="col-12 col-md-9"><input type="number" id="actualVal" name="actualVal" value="<?=$actualVal;?>" class="form-control"></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Note</label></div>
                          <div class="col-12 col-md-9">
                            <textarea name="note" id="note" rows="9" placeholder="Note..." class="form-control"><?=$note;?></textarea>
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