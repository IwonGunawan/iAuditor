

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-lg-8">
          <div class="card">
              <div class="card-header">
                  <strong>New</strong> Employee
              </div>

              <form action="<?=base_url('employee/save');?>" method="post" class="form-horizontal">
                <div class="card-body card-block">
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIK</label></div>
                          <div class="col-12 col-md-9"><input type="text" id="employeeNik" name="employeeNik" class="form-control"></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="email-input" class=" form-control-label">Full Name</label></div>
                          <div class="col-12 col-md-9"><input type="text" id="employeeName" name="employeeName" class="form-control"></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="password-input" class=" form-control-label">Site</label></div>
                          <div class="col-12 col-md-9">
                            <select name="site" id="site" class="form-control">
                                <option style="display: none;">Please select</option>
                                <?php
                                if (count($listSite) > 0) 
                                {
                                  foreach ($listSite as $key => $row) 
                                  {
                                    echo "<option value='".$row['siteCode']."'>".$row['siteName']."</option>";
                                  }
                                }
                                ?>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Department</label></div>
                          <div class="col-12 col-md-9">
                            <select name="department" id="department" class="form-control">
                                <option style="display: none;">Please select</option>
                                <?php
                                if (count($listDept) > 0) 
                                {
                                  foreach ($listDept as $key => $row) 
                                  {
                                    echo "<option value='".$row['departmentCode']."'>".$row['departmentName']."</option>";
                                  }
                                }
                                ?>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Section</label></div>
                          <div class="col-12 col-md-9"><input type="text" id="section" name="section" class="form-control"></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Job Position</label></div>
                          <div class="col-12 col-md-9"><input type="text" id="jobPosition" name="jobPosition" class="form-control"></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">level</label></div>
                          <div class="col-12 col-md-9"><input type="text" id="level" name="level" class="form-control"></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Sub-Level</label></div>
                          <div class="col-12 col-md-9"><input type="text" id="subLevel" name="subLevel" class="form-control"></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Email</label></div>
                          <div class="col-12 col-md-9"><input type="email" id="officeMail" name="officeMail" class="form-control"></div>
                      </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> Submit
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                </div>
              </form>
          </div>
      </div>


    </div>
  </div><!-- .animated -->
</div><!-- .content -->