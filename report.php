<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
    <div ui-view class="app-body" id="view">
      <div class="padding">
  <div class="box">
    <div class="box-header">
      <div class="form-group">
        <div class="col-md-6">
          <h2>REPORT</h2>
        </div>
      </div> <br/><br/>
      <div class="row">
        <div class="form-group">
          <div class="col-md-4">
            <input type="date" class="form-control" id="startDate" value="<?php echo date('Y-m-d', strtotime("-1 months", strtotime("NOW")));  ?>">
          </div>
          <div class="col-md-4" >
            <input type="date" class="form-control" id="endDate" value="<?php echo date("Y-m-d"); ?>">
          </div>
          <div class="col-md-4" >
            <input type="button" class="btn click"  value="Submit">
          </div>
        </div>      
      </div>
        <br>
        <div class="row">
        <div class="col-xs-3">
            <div class="box p-a">
                <div class="pull-left m-r">
                    <i class="fa fa-file text-2x text-danger m-y-sm"></i>
                </div>
                <div class="clear">
                    <div class="text-muted">Total Invoice</div>

                    <h4 class="m-a-0 text-md _600" id="invoice"></h4>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="box p-a">
                <div class="pull-left m-r">
                    <i class="fa fa-rupee text-2x text-info m-y-sm"></i>
                </div>
                <div class="clear">
                    <div class="text-muted">Total Amount</div>
                    <h4 class="m-a-0 text-md _600" id="amount"></h4>
                </div>
            </div>
        </div>
        </div>

    </div>
        <div class="container table-responsive">
      		<table id="customer_list_table" class="table  table-bordered dt-responsive nowrap" cellspacing="0"
                       width="100%">
	            <thead>
  	            <tr>
	                <th>Invoide No</th>
                  <th>Customer Name</th>
	                <!-- <th>Customer Address</th> -->
	                <th>Mobile Number</th>
                  <th>Date</th>
                  <th>Amount</th>
  	            </tr>
	            </thead>
              <tbody>
              </tbody>
	        </table>

    </div>
    </div>
    
    
  </div>
</div>

  
    </div>
  </div>
<?php include 'footer.php'; ?>
<script>
	jQuery(document).ready(function(){
    var gtable;
jQuery.ajax({
                  url: "process.php",
                  data: "get_all_invoice_report=true&startDate="+jQuery('#startDate').val()+"&endDate="+jQuery('#endDate').val(),
                  type: 'POST',
                  success: function(msg){   
                    var obj=jQuery.parseJSON(msg);
                    jQuery('#customer_list_table').dataTable().fnDestroy();
                    jQuery('#customer_list_table tbody').html(obj.data);
                    jQuery('#customer_list_table').dataTable({
                        dom: 'Bfrtip',
                        "info": false,
                        buttons: [
                            'copy', 'excel', 'pdf', 'print'
                        ]
                    } );            
                    jQuery('.dt-button').addClass('btn btn-default');  
                    jQuery('#customer_list_table').show();
                      jQuery('#invoice').text(obj.total);
                      jQuery('#amount').text(obj.amount);

                  }
              });
    //jQuery('#customer_list_table').DataTable();
    jQuery(document).on('click','.click',function(){
              event.preventDefault();
              jQuery.ajax({
                  url: "process.php",
                  data: "get_all_invoice_report=true&startDate="+jQuery('#startDate').val()+"&endDate="+jQuery('#endDate').val(),
                  type: 'POST',
                  success: function(msg){   
                    var obj=jQuery.parseJSON(msg);
                    jQuery('#customer_list_table').dataTable().fnDestroy();
                    jQuery('#customer_list_table tbody').html(obj.data);
                    jQuery('#customer_list_table').dataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'excel', 'pdf', 'print'
                        ]
                    } );            
                    jQuery('.dt-button').addClass('btn btn-default');  
                    jQuery('#customer_list_table').show();
                    if(obj.total == "")
                      jQuery('#invoice').text('0');
                    else
                      jQuery('#invoice').text(obj.total);
                    if(obj.amount == "")
                      jQuery('#amount').text('0');
                    else
                      jQuery('#amount').text(obj.amount);

                  }
              });
            });
	})
</script>