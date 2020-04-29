

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-lg-10">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong> Checklist
              </div>

                <div class="card-body card-block">
                  <div class="col-md-6">
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Section</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?=$data['sectionId'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Inspection</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?=$data['inspectionId'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Question</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?=$data['questionId'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Target Val</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?=$data['targetVal'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Actual Val</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?=$data['actualVal'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Note</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?=$data['note'];?></p>
                        </div>
                    </div>
                  </div>

                  <div class="col-md-1"></div>

                  <div class="col-md-5">
                    <div class="row form-group" >
                        <div class="col col-md-4"><label class=" form-control-label">Created By</label></div>
                        <div class="col-12 col-md-8">
                            <p class="form-control-static"><?=$data['createdBy'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4"><label class=" form-control-label">Created Date</label></div>
                        <div class="col-12 col-md-8">
                            <p class="form-control-static"><?=$data['createdTime'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4"><label class=" form-control-label">Modified By</label></div>
                        <div class="col-12 col-md-8">
                            <p class="form-control-static"><?=$data['modifiedBy'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4"><label class=" form-control-label">Modified Date</label></div>
                        <div class="col-12 col-md-8">
                            <p class="form-control-static"><?=$data['modifiedTime'];?></p>
                        </div>
                    </div>
                  </div>

                      
                </div>
                <div class="card-footer">
                  <button type="reset" class="btn btn-danger btn-sm" onclick="history.back(-1)">
                      <i class="fa fa-ban"></i> Back
                  </button>
                </div>
          </div>
      </div>


    </div>
  </div><!-- .animated -->
</div><!-- .content -->