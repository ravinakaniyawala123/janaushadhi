<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

   <div ui-view class="app-body" id="view">
      <div class="padding">
         <div class="box">
            <div class="box-header">
               <div class="">
                  <form id="add_invoice">
                    <div class="">
                      <div class='row'>
                         <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                            <div class="form-group">
                               <input type="text" class="form-control" name="clientCompanyName" id="clientCompanyName" placeholder="Customer Name" >
                            </div>
                            
                            <div class="form-group">
                               <textarea class="form-control" rows='3' name="clientAddress" id="clientAddress" placeholder="Your Address" ></textarea>
                            </div>
                         </div>
                          <div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
                           <div class="form-group">
                               <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Contact No" >
                            </div>
                            <div class="form-group">
                               <input type="text" class="form-control" name="doctor_name" id="doctor_name" placeholder="Doctor Name" >
                            </div>
                         </div>
                         <div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
                            <!--<div class="form-group">
                               <input type="number" class="form-control" id="invoiceNo" placeholder="Invoice No">
                            </div>-->
                            <div class="form-group">
                               <input type="date" class="form-control" name="invoiceDate" id="invoiceDate" value="<?php echo date("Y-m-d"); ?>" placeholder="Invoice Date">
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
                                <th width="10%">Discount(%)</th>
                                <th width="7%">Quantity</th>
                                <th width="10%">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><!-- <input class="case" type="checkbox"/> --></td>
                                <td><select data-type="productName" name="itemName[]" id="itemName_1" data-row=1 class="js-data-example-ajax form-control " autocomplete="off" required></select></td>
                                <td><select data-type="productDis" name="productDis[]" id="productDis_1" data-row=1 class="productDis form-control " autocomplete="off" required></select></td>
                                <!-- <td><input type="text" data-type="productDis" name="productDis[]" id="productDis_1" class="form-control productDis"  required></td> -->
                                <td><input type="number" name="amount[]" step="0.01" min="0" id="amount_1" class="form-control changesNo medicine_amount"  autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" required></td>
                                <td><input type="number" min="0" step="1" name="discount[]" id="discount_1"  value="0" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                                <td><input type="number" step="1" name="quantity[]" min="0" id="quantity_1" oninvalid="setCustomValidity('Out of Stock Please Add Quantity in Medicine')" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" value="1" ondrop="return false;" onpaste="return false;" required></td>
                                <td><input type="number" name="total[]" min="0" id="total_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" step="0.01" ondrop="return false;" readonly onpaste="return false;" required></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
                          <button class="btn btn-sm btn-outline b-danger text-danger delete" type="button">- Delete</button>
                          <button class="btn btn-sm btn-outline b-info text-info addmore" type="button">+ Add More</button>
                        </div>
                        <!-- <div class='col-xs-12 col-sm-offset-6 col-md-offset-6 col-lg-offset-6 col-sm-5 col-md-5 col-lg-5'>
                          <div class="form-group">
                              <label>Discount: &nbsp;</label>
                              <div class="input-group">
                                <div class="input-group-addon">%</div>
                                <input type="number" step="0.01" min="1" max="100" class="form-control" name="dicount" id="dicount" placeholder="Discount" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="0">
                              </div>
                            </div>
                        </div> -->
                        <div class='col-xs-12 col-sm-offset-6 col-md-offset-6 col-lg-offset-6 col-sm-5 col-md-5 col-lg-5'>
                          <form class="form-inline">
                            <div class="form-group">
                              <label>Total: &nbsp;</label>
                              <div class="input-group">
                                <div class="input-group-addon">Rs</div>
                                <input type="number" class="form-control" step="0.01" name="totalAftertax" id="totalAftertax" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly required>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                        <h2>Notes: </h2>
                        <div class='row'>
                          <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                            <div class="form-group">
                              <textarea class="form-control" rows='3' name="notes" id="notes" placeholder="Your Notes"></textarea>
                            </div>
                          </div>
                        </div>  
                        <div class='row'>
                          <div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
                            <button class="btn btn-outline b-success text-success" type="submit">Save Invoice</button>
                          </div>
                          <div class='col-xs-12 col-sm-2 col-md-2 col-lg-2'>
                            <a href="invoice_list.php" class="btn btn-outline b-danger text-danger">Cancel</a>
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
      // var ids=[];
      // jQuery( ".js-data-example-ajax" ).each(function() {
      //     ids.push(jQuery(this).val());
      // });
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
    jQuery(document).on('change','.js-data-example-ajax',function(){
      var row = jQuery(this).data('row');
      var va = jQuery(this).val();
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
            //console.log(va);
            //console.log(obj.discription);
            jQuery('#productDis_'+row).empty().append('<option value="'+va+'">'+obj.discription+'</option>').val(va);
            if(obj.remaning_quantity <= 0){

              alert("Out Of Stock");
              //jQuery(this).select2("val", "");
              return false;
            }
            
          }
       })
    })
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

       jQuery(document).on('submit','#add_invoice',function(event){
           event.preventDefault();
           jQuery.ajax({
               url: "process.php",
               data: 'add_invoice=true&'+jQuery('#add_invoice').serialize(),
               type: 'POST',
               success: function(msg){
                  location.reload();
               }
           })
       });
   });

</script>