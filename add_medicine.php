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
			    <strong>Something Went Wrong Plese try again!  </strong>
			</div>
            <div class="form-group">
            	<div class="col-md-6">
             		<h2>ADD PRODUCT</h2>
             	</div>
             	<div class="col-md-6 text-right">
             		<button class="btn info" data-toggle="modal" data-target="#add_medicine_modal" ui-toggle-class="fade-down-big" ui-target="#animate">Add Product</button>
             	</div>
            </div>
                      
        </div>
        <div class="table-responsive">
	      	<table class="table table-striped b-t b-b " id="medicine_table">
		        <thead>
	          		<tr>
			            <th style="width:25%">Product Name</th>
			            <th style="width:7%">Amount</th>
			            <th style="width:7%">Discount(%)</th>
			            <th style="width:7%">Quantity</th>
			            <th style="width:12%">Quantity Left</th>
			            <th style="width:10%">Code</th>
			            <!-- <th style="width:10%">Batch Code</th> -->
			            <th style="width:25%">Action</th>
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
	<div id="add_medicine_modal" class="modal fade animate" data-backdrop="true">
	  	<div class="modal-dialog" id="animate">
		    <div class="modal-content">
		      	<div class="modal-header">
			      	<h5 class="modal-title">Add Product</h5>
		      	</div>
		      	<form id="add_medicine_form">
			      	<div class="modal-body text-center p-lg">
				        <div class="">
				          <div class="">                    
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Name</label>
				              <div class="col-sm-8">
				                <input type="text" name="medicine_name_txt" class="form-control parsley-error" required="" placeholder="Product Name">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Company Name</label>
				              <div class="col-sm-8">
				                <input type="text" name="medicine_company_name_txt" class="form-control parsley-error" required="" placeholder="Product Company Name">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Code</label>
				              <div class="col-sm-8">
				                <input type="text" name="medicine_code_txt" class="form-control parsley-error" required="" placeholder="Product Code">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Batch Code</label>
				              <div class="col-sm-8">
				                <input type="text" name="medicine_batch_code_txt" class="form-control parsley-error" required="" placeholder="Product Batch Code">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Amount(Sell)</label>
				              <div class="col-sm-8">
				                <input type="number" step="0.01" min="1" name="medicine_amount_txt" required="" class="form-control" placeholder="Product Sell Amount">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Amount(Cost)</label>
				              <div class="col-sm-8">
				                <input type="number" step="0.01" min="1" name="medicine_amount_cost_txt" required="" class="form-control" placeholder="Product Cost Amount">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Discount</label>
				              <div class="col-sm-8">
				                <input type="number" min="0" step="1" name="medicine_discount_txt" class="form-control parsley-error" required="" value="0" placeholder="Product Discount Code">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Quantity</label>
				              <div class="col-sm-8">
				                <input type="number" min="0" name="medicine_quantity_txt" required="" class="form-control" placeholder="Product Quantity">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Discription</label>
				              <div class="col-sm-8">
				                <textarea type="number" name="medicine_discription_txt" required="" class="form-control" placeholder="Product Discription"></textarea>
				              </div>
				            </div>
			             	<div class="form-group row">
				              <label class="col-sm-4 form-control-label">Expiry Date</label>
				              <div class="col-sm-8">
				                <input type="date"  name="medicine_expiry_txt"  required="" class="form-control" >
				              </div>
				            </div>
				          </div>
				        </div>
			      	</div>
			      	<div class="modal-footer">
				        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn info">Submit</button>
			      	</div>
		     	</form>
		    </div><!-- /.modal-content -->
	  	</div>
	</div>
	<div id="edit_medicine_modal" class="modal fade animate" data-backdrop="true">
	  	<div class="modal-dialog" id="animate">
		    <div class="modal-content">
		      	<div class="modal-header">
			      	<h5 class="modal-title">Edit Product</h5>
		      	</div>
		      	<form id="edit_medicine_form">
		      		<input type="hidden" name="edit_id" id="edit_id">
			      	<div class="modal-body text-center p-lg">
				        <div class="">
				          <div class="">                    
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Name</label>
				              <div class="col-sm-8">
				                <input type="text" name="edit_medicine_name_txt" id="edit_medicine_name_txt" class="form-control parsley-error" required="" placeholder="Product Name">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Company Name</label>
				              <div class="col-sm-8">
				                <input type="text" name="edit_medicine_company_name_txt" id="edit_medicine_company_name_txt" class="form-control parsley-error" required="" placeholder="Product Company Name">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Code</label>
				              <div class="col-sm-8">
				                <input type="text" name="edit_medicine_code_txt"  id="edit_medicine_code_txt" class="form-control parsley-error" required="" placeholder="Product Code">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Batch Code</label>
				              <div class="col-sm-8">
				                <input type="text" name="edit_medicine_batch_code_txt" id="edit_medicine_batch_code_txt" class="form-control parsley-error" required="" placeholder="Product Batch Code">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Amount(Sell)</label>
				              <div class="col-sm-8">
				                <input type="number" step="0.01" min="1" name="edit_medicine_amount_txt" id="edit_medicine_amount_txt" class="form-control" required="" placeholder="Product Amount">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Amount(Cost)</label>
				              <div class="col-sm-8">
				                <input type="number" step="0.01" min="1" name="edit_medicine_amount_cost_txt" id="edit_medicine_amount_cost_txt" class="form-control" placeholder="Product Cost Amount">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Discount</label>
				              <div class="col-sm-8">
				                <input type="number" step="1" name="edit_medicine_discount_txt" id="edit_medicine_discount_txt" class="form-control parsley-error" required="" placeholder="Product Discount Code">
				              </div>
				            </div>
				            <div class="form-group row">
				              <label class="col-sm-4 form-control-label">Product Discription</label>
				              <div class="col-sm-8">
				                <textarea type="number" name="edit_medicine_discription_txt" id="edit_medicine_discription_txt" class="form-control" placeholder="Product Discription"></textarea>
				              </div>
				            </div>
				          </div>
				        </div>
			      	</div>
			      	<div class="modal-footer">
				        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn info">Submit</button>
			      	</div>
		     	</form>
		    </div><!-- /.modal-content -->
	  	</div>
	</div>
	<div id="add_edit_medicine_quantity_modal" class="modal fade animate" data-backdrop="true">
	  	<div class="modal-dialog" id="animate">
		    <div class="modal-content">
		      	<div class="modal-header">
			      	<h5 class="modal-title">Add Product Qantity</h5>
		      	</div>
		      	<form id="add_edit_medicine_quantity_form">
		      		<input type="hidden" name="edit_qunatity_id" id="edit_qunatity_id">
	      			 	<div class="box">
				          	<div class="box-body"> 
					            <div class="form-group row">
					              <label class="col-sm-3 form-control-label">Product Quantity</label>
					              <div class="col-sm-9">
					                <input type="number"  min="0"   name="medicine_quantity_txt" class="form-control" placeholder="Medicine Quantity">
					              </div>
					            </div>
			        		</div>
			            </div>
			      	<div class="modal-footer">
				        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn info">Submit</button>
			      	</div>
		     	</form>
		    </div><!-- /.modal-content -->
	  	</div>
	</div>
	<div id="minus_edit_medicine_quantity_modal" class="modal fade animate" data-backdrop="true">
	  	<div class="modal-dialog" id="animate">
		    <div class="modal-content">
		      	<div class="modal-header">
			      	<h5 class="modal-title">Minus Product Qantity</h5>
		      	</div>
		      	<form id="minus_edit_medicine_quantity_form">
		      		<input type="hidden" name="edit_qunatity_id" id="edit_qunatity_id">
	      			 	<div class="box">
				          	<div class="box-body"> 
					            <div class="form-group row">
					              <label class="col-sm-3 form-control-label">Product Quantity</label>
					              <div class="col-sm-9">
					                <input type="number"  min="0"   name="medicine_quantity_txt" class="form-control" placeholder="Medicine Quantity">
					              </div>
					            </div>
			        		</div>
			            </div>
			      	<div class="modal-footer">
				        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn info">Submit</button>
			      	</div>
		     	</form>
		    </div><!-- /.modal-content -->
	  	</div>
	</div>
	<div id="m-sm" class="modal " data-backdrop="true">
	  <div class="row-col h-v">
	    <div class="row-cell v-m">
	      <div class="modal-dialog modal-sm">
	        <div class="modal-content">
	          <div class="modal-header">
	          	<h5 class="modal-title">Message</h5>
	          </div>
	          <div class="modal-body text-center p-lg">
	            <p>Are you sure to delete this Product?</p>
	          </div>
	          <div class="modal-footer">
	            <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">No</button>
	            <button type="button" class="btn danger p-x-md" id="yes">Yes</button>
	          </div>
	        </div><!-- /.modal-content -->
	      </div>
	    </div>
	  </div>
	</div>
	
<?php include 'footer.php'; ?>
<script>
	jQuery(document).ready(function(){
		var medicine_table = jQuery('#medicine_table').DataTable({
			"bFilter": false,
            "bLengthChange": false,
            "bSort": false,
            "paging": true,
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "info": false,
            "serverSide": true,
            "ordering": false,
            "searching": true,
            "sAjaxSource": "process.php",
            "oLanguage": {
                "sEmptyTable": "No Medicine founds in the system.",
                "sZeroRecords": "No Medicine to display",
                "sProcessing": "Loading..."
            },
            "fnPreDrawCallback": function (oSettings) {
                //logged_in_or_not();
            },
            "fnServerParams": function (aoData) {
                aoData.push({"name": "get_all_medicine", "value": true});
            }
        });
		jQuery(document).on('submit','#add_medicine_form',function(e){
			e.preventDefault();
			jQuery.ajax({
				url:'process.php',
			   	data: 'add_medicine=true&'+jQuery('#add_medicine_form').serialize(),
			   	success:function(data) {
			   		var obj = jQuery.parseJSON(data);
			   		
			   		if(obj.status == true){
			   			jQuery('#add_medicine_form').find("input[type=text],input[type=number], textarea").val("");
			   			medicine_table.draw();
			   			jQuery('#add_medicine_modal').modal('hide');
			   			$("#success-alert").alert();
		                $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
		               		$("#success-alert").slideUp(500);
		                }); 
			   		}else{
			   			jQuery('#add_medicine_modal').modal('hide');
			   			$("#danger-alert").alert();
		                $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
		               		$("#danger-alert").slideUp(500);
		                }); 
			   		}
			   	}
			})
		});
		jQuery(document).on('click','.edit_medicine',function(){
			var id = jQuery(this).attr("data_id");
				jQuery.ajax({
					url:'process.php',
				   	data: 'get_edit_medicine=true&id='+id,
				   	success:function(data) {
				   		var obj = jQuery.parseJSON(data);
				   		jQuery("#edit_id").val(id);
				   		jQuery("#edit_medicine_modal").modal('show');
				   		jQuery("#edit_medicine_name_txt").val(obj.name);
				   		jQuery("#edit_medicine_company_name_txt").val(obj.company_name);
				   		jQuery("#edit_medicine_code_txt").val(obj.code);
				   		jQuery("#edit_medicine_amount_txt").val(obj.amount);
				   		jQuery("#edit_medicine_discription_txt").val(obj.discription);
				   		jQuery("#edit_medicine_batch_code_txt").val(obj.batch_code);
				   		jQuery("#edit_medicine_discount_txt").val(obj.discount);
				   		jQuery("#edit_medicine_amount_cost_txt").val(obj.amount_cost);

				   	}
				})
		});
		jQuery(document).on('click','.edit_quantity',function(){
			var id = jQuery(this).attr("data_id");
			jQuery("#add_edit_medicine_quantity_modal").modal('show');
			jQuery("#edit_qunatity_id").val(id);
		});
		jQuery(document).on('submit','#add_edit_medicine_quantity_form',function(e){
			e.preventDefault();
			jQuery.ajax({
				url:'process.php',
			   	data: 'add_edit_medicine_qunatity=true&'+jQuery('#add_edit_medicine_quantity_form').serialize(),
			   	success:function(data) {
			   		var obj = jQuery.parseJSON(data);
			   		if(obj.status == true){
			   			medicine_table.draw();
			   			jQuery('#add_edit_medicine_quantity_modal').modal('hide');
			   			$("#success-alert").alert();
		                $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
		               		$("#success-alert").slideUp(500);
		                }); 
			   		}else{
			   			jQuery('#edit_medicine_modal').modal('hide');
			   			$("#danger-alert").alert();
		                $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
		               		$("#danger-alert").slideUp(500);
		                }); 
			   		}
			   	}
			})
		});	
		jQuery(document).on('click','.minus_edit_quantity',function(){
			var id = jQuery(this).attr("data_id");
			jQuery("#minus_edit_medicine_quantity_modal").modal('show');
			jQuery("#minus_edit_medicine_quantity_modal #edit_qunatity_id").val(id);
		});
		jQuery(document).on('submit','#minus_edit_medicine_quantity_form',function(e){
			e.preventDefault();
			jQuery.ajax({
				url:'process.php',
			   	data: 'minus_edit_medicine_qunatity=true&'+jQuery('#minus_edit_medicine_quantity_form').serialize(),
			   	success:function(data) {
			   		var obj = jQuery.parseJSON(data);
			   		if(obj.status == true){
			   			medicine_table.draw();
			   			jQuery('#minus_edit_medicine_quantity_modal').modal('hide');
			   			$("#success-alert").alert();
		                $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
		               		$("#success-alert").slideUp(500);
		                }); 
			   		}else{
			   			jQuery('#edit_medicine_modal').modal('hide');
			   			$("#danger-alert").alert();
		                $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
		               		$("#danger-alert").slideUp(500);
		                }); 
			   		}
			   	}
			})
		});	
		jQuery(document).on('submit','#edit_medicine_form',function(e){
			e.preventDefault();
			jQuery.ajax({
				url:'process.php',
			   	data: 'edit_medicine=true&'+jQuery('#edit_medicine_form').serialize(),
			   	success:function(data) {
			   		var obj = jQuery.parseJSON(data);
			   		if(obj.status == true){
			   			 medicine_table.draw();
			   			jQuery('#edit_medicine_modal').modal('hide');
			   			$("#success-alert").alert();
		                $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
		               		$("#success-alert").slideUp(500);
		                }); 
			   		}else{
			   			jQuery('#edit_medicine_modal').modal('hide');
			   			$("#danger-alert").alert();
		                $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
		               		$("#danger-alert").slideUp(500);
		                }); 
			   		}
			   	}
			})
		});
		jQuery(document).on('click','.delete_medicine',function(){
			var id = jQuery(this).attr("data_id");
			jQuery("#m-sm").modal('show');
			jQuery(document).on('click','#yes',function(){
				jQuery.ajax({
					url:'process.php',
				   	data: 'delete_medicine=true&id='+id,
				   	success:function(data) {
				   		var obj = jQuery.parseJSON(data);
				   		if(obj.status == true){
			   				jQuery('#m-sm').modal('hide');
			                medicine_table.draw();
				   		}else{
				   			
				   		}
				   	}
				})
			})
		});
	})
</script>