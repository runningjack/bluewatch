       <div class="row">
        <div class="col-md-12">
          <div class="block-flat">
            <div class="header">              
              <h3>Qualifications Setup</h3>
                                                        
    <?php foreach ($css_files as $file): ?>
  <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
            </div>
<div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
               
                <div class="x_content">


                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" 
                      aria-expanded="true">Skills</a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" 
                      aria-expanded="false"><?php echo 'Education'; ?></a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" 
                      aria-expanded="false"><?php echo 'Certifications'; ?></a>
                      </li>

                  <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" 
                      aria-expanded="false"><?php echo 'Languages'; ?></a>
                      </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        <p><?php echo $output1; ?></p>
                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        
                          <IFRAME SRC=<?php echo base_url('admin/settings/education'); ?> WIDTH=1200 Height=500></IFRAME>
                          <?php 
                              //$url= base_url('admin/settings/pay_grade');
                              //file_get_contents() reads remote webpage content
                             // $output2 =file_get_contents($url);
                               echo $output2;
                        ?>
                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        <IFRAME SRC=<?php echo base_url('admin/settings/certifications'); ?> WIDTH=1200 Height=500></IFRAME>                    
                      </div>

                       <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                        <IFRAME SRC=<?php echo base_url('admin/settings/languages'); ?> WIDTH=1200 Height=500></IFRAME>                    
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>


              </div>
              </div>
            </div>
             </div>

             <?php //var_dump($js_files);exit;
  $i = 0;
  foreach ($js_files as $file): ?>
    <?php if ($i != 0) {
      ?>    <script src="<?php echo $file; ?>"></script><?php
  }?>
    <?php 
  ++$i;
  endforeach; ?>