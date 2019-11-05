<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
    <div ui-view class="app-body" id="view">
      <div class="padding">
  <div class="box">
    <div class="box-header">
      <div class="box-body p-v-md">
      		<div class="alert alert-success" id="success-alert" style="display: none;">
			    <button type="button" class="close" data-dismiss="alert">x</button>
			    <strong>SuccessFully! Inserted  </strong>

			</div>
			<div class="alert alert-danger" id="danger-alert" style="display: none;">
			    <button type="button" class="close" data-dismiss="alert">x</button>
			    <strong>SuccessFully! Inserted  </strong>
			   
			</div>
            <div class="form-group">
            	<div class="col-md-6">
             		<h2>INVOICE LIST</h2>
             	</div>
             	<div class="col-md-6 text-right">
             		<a class="btn info" href = "add_invoice.php">ADD INVOICE</a>
              </div>
            </div>
                      
        </div>
        <div class="table-responsive">
      		<table id="customer_list_table" class="table  table-bordered dt-responsive nowrap" cellspacing="0"
                       width="100%">
	            <thead>
	            <tr>
	                <th>Invoide No</th>
                  <th>Customer Name</th>
	                <th>Customer Address</th>
	                <th>Date</th>
	                <th>Action</th>
	            </tr>
	            </thead>
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
		var gtable = jQuery('#customer_list_table').dataTable({
            "bFilter": false,
            "bLengthChange": false,
            "bSort": false,
            "paging": true,
            "iDisplayLength": 9,
            "bProcessing": true,
            "bServerSide": true,
            "info": false,
            "serverSide": true,
            "ordering": false,
            "searching": true,
            "sAjaxSource": "process.php",
            "oLanguage": {
                "sEmptyTable": "No Review founds in the system.",
                "sZeroRecords": "No Connected account to display",
                "sProcessing": "Loading..."
            },
            "fnPreDrawCallback": function (oSettings) {
                //logged_in_or_not();
            },
            "fnServerParams": function (aoData) {
                aoData.push({"name": "get_all_invoice", "value": true});
            }
        });
	})
</script>