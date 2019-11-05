<?php 
  include 'config.php';
  if(isset($_REQUEST['id'])){
    $id=$_REQUEST['id'];
    $sql_customer = "select * from customer where id=".$id;
    $sql = "select m.id,m.name,m.discription,m.amount,i.quantity,m.discount,i.total from item i INNER JOIN medicine m  on(i.`medcine_id` = m.id) where i.customer_id=".$id;
    $query_customer = mysqli_query($conn, $sql_customer);
    $Row_customer = mysqli_fetch_array($query_customer);
    $query_item =  mysqli_query($conn, $sql);
    $query_total = mysqli_query($conn, "select SUM(total) as total from item where customer_id=".$id);
    $Row_total = mysqli_fetch_array($query_total);
  }else{
    header("Location:add_invoice.php");
  } 
  include 'header.php'; 
  include 'sidebar.php';
?>
   <div ui-view class="app-body" id="view">
      <div class="padding">
         <div class="box">
            <div class="box-header">
               <div class="">
                  <form id="edit_invoice">
                    <input type="hidden" name="edit_id" value="<?php echo $id;?>">
                    <div class="">
                      <div class='row'>
                         <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                            <div class="form-group">
                               <input type="text" class="form-control" value="<?php echo $Row_customer['customerName']; ?>" name="clientCompanyName" id="clientCompanyName" placeholder="Company Name" required>
                            </div>
                            <div class="form-group">
                               <textarea class="form-control" rows='3' name="clientAddress" id="clientAddress" placeholder="Your Address" ><?php echo $Row_customer['customerAddress']; ?></textarea>
                            </div>
                         </div>
                          <div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
                           <div class="form-group">
                               <input type="text" class="form-control" value="<?php echo $Row_customer['mobile_number']; ?>" name="contact_no" id="contact_no" placeholder="Contact No" >
                            </div>
                            <div class="form-group">
                               <input type="text" class="form-control"  value="<?php echo $Row_customer['doctor_name']; ?>" name="doctor_name" id="doctor_name" placeholder="Doctor Name" >
                            </div>
                         </div>
                         <div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
                            <!--<div class="form-group">
                               <input type="number" class="form-control" id="invoiceNo" placeholder="Invoice No">
                            </div>-->
                            <div class="form-group">
                               <input type="date" class="form-control" name="invoiceDate" id="invoiceDate" value="<?php echo $Row_customer['date']; ?>" placeholder="Invoice Date" readonly>
                            </div>
                         </div>
                      </div>
                      <div><br/></div>
                      <div class='row'>
                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th width="1%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                                <th width="12%">Product</th>
                                <th width="22%">Description</th>
                                <th width="14%">Amount</th>
                                <th width="5%">Discount(%)</th>
                                <th width="10%">Quantity</th>
                                <th width="12%">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              $k=0;
                              $i=1;
                              while ($Row = mysqli_fetch_array($query_item)) {

                                $Json[$k]['id']= $Row['id'];
                                $Json[$k]['name']= $Row['name'];
                                $Json[$k]['discription']= $Row['discription'];
                                $sql1 = "select sum(quantity) as total FROM `item` where  customer_id NOT IN(".$id.") and medcine_id=".$id;
                                $result1 = mysqli_query($conn,$sql1);
                                $Row1 = mysqli_fetch_assoc($result1);
                              ?>
                              <tr>
                                <td> <?php if($k > 0){ ?><input class="case" type="checkbox"/> <?php } ?></td>
                                <td><select data-type="productName" name="itemName[]" id="itemName_<?php echo $i; ?>" data-row="<?php echo $i; ?>" class="js-data-example-ajax form-control " autocomplete="off" required></select></td>
                                <td><select name="productDis[]" id="productDis_<?php echo $i; ?>" data-row="<?php echo $i; ?>" class="productDis form-control " autocomplete="off" required></select></td>
                                <td><input type="number" name="amount[]" value="<?php echo $Row['amount']; ?>" step="0.01" min="0" id="amount_<?php echo $i; ?>" class="form-control changesNo medicine_amount"  autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" required></td>
                                <td><input type="number" min="0"  value="<?php echo $Row['discount']; ?>" step="1" name="discount[]" id="discount_<?php echo $i; ?>"  class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                                <td><input type="number" step="1" value="<?php echo $Row['quantity']; ?>" name="quantity[]" min="0" max="<?php echo $Row1['total']; ?>" id="quantity_<?php echo $i; ?>" oninvalid="setCustomValidity('Out of Stock Please Add Quantity in Medicine')" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" value="1" ondrop="return false;" onpaste="return false;" required></td>
                                <td><input type="number" name="total[]" min="0" value="<?php echo $Row['total']; ?>" id="total_<?php echo $i; ?>" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" step="0.01" ondrop="return false;" readonly onpaste="return false;" required></td>
                              </tr>
                               <?php $k++;
                                $i++;} ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
                          <button class="btn btn-sm btn-outline b-danger text-danger delete" type="button">- Delete</button>
                          <button class="btn btn-sm btn-outline b-info text-info addmore" type="button">+ Add More</button>
                        </div>
                        <div class='col-xs-12 col-sm-offset-6 col-md-offset-6 col-lg-offset-6 col-sm-5 col-md-5 col-lg-5'>
                          <form class="form-inline">
                            <div class="form-group">
                              <label>Total: &nbsp;</label>
                              <div class="input-group">
                                <div class="input-group-addon">Rs</div>
                                <input type="number" value="<?php echo $Row_customer['total_amount']; ?>" class="form-control" step="0.01" name="totalAftertax" id="totalAftertax" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" required>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                        <h2>Notes: </h2>
                        <div class='row'>
                          <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                            <div class="form-group">
                              <textarea class="form-control" rows='3' name="notes" id="notes" placeholder="Your Notes"><?php echo $Row_customer['note']; ?></textarea>
                            </div>
                          </div>
                        </div>  
                        <div class='row'>
                          <div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
                            <button class="btn btn-outline b-success text-success" type="submit">Update Invoice</button>
                          </div>
                          <div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
                            <a href="invoice_list.php" class="btn btn-outline b-danger text-danger">Back</a>
                          </div>
                        </div>  
                        <div class='row'>
                          <div class="alert alert-success" id="success-alert" style="display: none;">
                              <button type="button" class="close" data-dismiss="alert">x</button>
                              <strong>SuccessFully! Inserted  </strong>
                             
                          </div>
                          <div class="alert alert-danger" id="danger-alert" style="display: none;">
                              <button type="button" class="close" data-dismiss="alert">x</button>
                              <strong>Something Went Wrong Plese try again!  </strong>
                          </div>
                        </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include 'footer.php'; ?>
<script>
   jQuery(document).ready(function(){
      var json=<?php echo json_encode($Json) ?>;
      console.log(json);
      var i = 0;
      var j = 1;
      jQuery( ".js-data-example-ajax" ).each(function() {
          console.log(json[i]['id']);
          jQuery('#itemName_'+j).empty().append('<option value="'+json[i]['id']+'">'+json[i]['name']+'</option>').val(json[i]['id']).trigger('change');
          jQuery('#productDis_'+j).empty().append('<option value="'+json[i]['id']+'">'+json[i]['discription']+'</option>').val(json[i]['id']).trigger('change');
          i++;
          j++;
      });
      //ids.splice(-1,1);
      jQuery(".js-data-example-ajax").select2({
          ajax: {
            url: "process.php?get_medicine=true",
            dataType: 'json',
            data: function (params) {
              var ids=[];
              jQuery( ".js-data-example-ajax" ).not(this).each(function() {
                ids.push(jQuery(this).val());
              });
              return {
                q: params.term, // search term
                page: params.page,
                id: ids,
                cust_id: <?php echo $id; ?>,
              };
            },
            processResults: function (data) {
                return {
                    results: $.map(data.items, function(obj) {
                        return { id: obj.id, text: obj.name };
                    })
                };
            }
        },
    });
      jQuery(".productDis").select2({
          ajax: {
            url: "process.php?get_desc=true",
            dataType: 'json',
            data: function (params) {
              var ids=[];
              jQuery( ".productDis" ).not(this).each(function() {
                ids.push(jQuery(this).val());
              });
              return {
                q: params.term, // search term
                page: params.page,
                id: ids,
              };
            },
            processResults: function (data) {
                return {
                    results: $.map(data.items, function(obj) {

                        return { id: obj.id, text: obj.discription };
                    })
                };
            }
        },
    });
    jQuery(document).on('change','.productDis',function(){
      var row = jQuery(this).data('row');
      var va = jQuery(this).val();
      console.log("herere");
        jQuery.ajax({
          url: "process.php",
          data: 'get_price=true&id='+jQuery(this).val(),
          type: 'POST',
          success: function(msg){
            var obj = jQuery.parseJSON(msg);
            //jQuery('#productDis_'+row).val(obj.discription);
            
            jQuery('#amount_'+row).val(obj.amount);
            jQuery('#amount_'+row).trigger('change');
            jQuery('#quantity_'+row).attr('max',obj.remaning_quantity);
            jQuery('#discount_'+row).val(obj.discount);
            jQuery('#discount_'+row).trigger('change');
            console.log(va);
            console.log(obj.name);
            jQuery('#itemName_'+row).empty().append('<option value="'+va+'">'+obj.name+'</option>').val(va);
            if(obj.remaning_quantity <= 0){
              alert("Out Of Stock");
              return false;
            }
            
          }
       })
    })
    jQuery(document).on('change','.js-data-example-ajax',function(){
      var row = jQuery(this).data('row');
      var va = jQuery(this).val();
      console.log(row);
        jQuery.ajax({
          url: "process.php",
          data: 'get_price=true&id='+jQuery(this).val(),
          type: 'POST',
          success: function(msg){
            var obj = jQuery.parseJSON(msg);
            // jQuery('#productDis_'+row).val(obj.discription);
            jQuery('#productDis_'+row).empty().append('<option value="'+va+'">'+obj.discription+'</option>').val(va);
            jQuery('#amount_'+row).val(obj.amount);
            jQuery('#amount_'+row).trigger('change');
            jQuery('#quantity_'+row).attr('max',obj.remaning_quantity);
            jQuery('#discount_'+row).val(obj.discount);
            jQuery('#discount_'+row).trigger('change');
            if(obj.remaning_quantity <= 0){

              alert("Out Of Stock");
              //jQuery(this).select2("val", "");
              return false;
            }
            
          }
       })
    })

       jQuery(document).on('submit','#edit_invoice',function(event){
           event.preventDefault();
           jQuery.ajax({
              url: "process.php",
              data: 'edit_invoice=true&'+jQuery('#edit_invoice').serialize(),
              type: 'POST',
              success: function(msg){
                var obj = jQuery.parseJSON(msg);
                if(obj.status == true){
                  jQuery('#add_edit_medicine_quantity_modal').modal('hide');
                    $("#success-alert").alert();
                    $("#success-alert").fadeTo(2000, 1000).slideUp(1000, function(){
                      $("#success-alert").slideUp(1000);
                    }); 
                }else{
                    $("#danger-alert").alert();
                    $("#danger-alert").fadeTo(2000, 1000).slideUp(1000, function(){
                      $("#danger-alert").slideUp(1000);
                    }); 
                }
              }
           })
       });
   });

</script>