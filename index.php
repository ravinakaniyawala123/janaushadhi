<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<!-- content -->

   <div ui-view class="app-body" id="view">
      <!-- ############ PAGE START-->
      <div class="padding">
         <div class="margin">
            <h5 class="m-b-0 _300">Hi Admin, Welcome back</h5>
            <!-- <small class="text-muted">Awesome uikit for your next project</small> -->
         </div>
         <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-4">
               <div class="row">
                  <div class="col-xs-6">
                     <div class="box p-a">
                        <div class="pull-left m-r">
                           <i class="fa fa-file text-2x text-danger m-y-sm"></i>
                        </div>
                        <div class="clear">
                           <div class="text-muted">Total Invoice</div>
                           <?php $sql = "select count(*) as total from customer where isDelete=0";
                           $result = mysqli_query($conn, $sql);
                           $result = $result->fetch_assoc();
                           ?>
                           <h4 class="m-a-0 text-md _600"><a href><?php echo $result['total']; ?></a></h4>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-6">
                     <div class="box p-a">
                        <div class="pull-left m-r">
                           <i class="fa fa-rupee text-2x text-info m-y-sm"></i>
                        </div>
                        <div class="clear">
                           <div class="text-muted">Total Amount</div>
                           <?php $sql1 = "SELECT SUM(total_amount) as amount FROM `customer` WHERE isDelete=0";
                           $result1 = mysqli_query($conn, $sql1);
                           $result1 = $result1->fetch_assoc();
                           ?>
                           <h4 class="m-a-0 text-md _600"><a href><?php echo $result1['amount']; ?></a></h4>
                        </div>
                     </div>
                  </div>
                  <!--<div class="col-xs-6">
                     <div class="box p-a">
                        <div class="pull-left m-r">
                           <i class="fa fa-photo text-2x text-accent m-y-sm"></i>
                        </div>
                        <div class="clear">
                           <div class="text-muted">Photos</div>
                           <h4 class="m-a-0 text-md _600"><a href>630</a></h4>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-6">
                     <div class="box p-a">
                        <div class="pull-left m-r">
                           <i class="fa fa-video-camera text-2x text-success m-y-sm"></i>
                        </div>
                        <div class="clear">
                           <div class="text-muted">Videos</div>
                           <h4 class="m-a-0 text-md _600"><a href>750</a></h4>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12">
                     <div class="row-col box-color text-center primary">
                        <div class="row-cell p-a">
                           Followers
                           <h4 class="m-a-0 text-md _600"><a href>2350</a></h4>
                        </div>
                        <div class="row-cell p-a dker">
                           Following
                           <h4 class="m-a-0 text-md _600"><a href>7250</a></h4>
                        </div>
                     </div>
                  </div>-->
               </div>
            </div>
         </div>
      </div>
      <!-- ############ PAGE END-->
   </div>
</div>
<!-- / -->
<?php include 'footer.php'; ?>