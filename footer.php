
  </div>
<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
  <script src="libs/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
  <script src="libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="libs/jquery/underscore/underscore-min.js"></script>
  <script src="libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="libs/jquery/PACE/pace.min.js"></script>

  <script src="scripts/config.lazyload.js"></script>

  <script src="scripts/auto1.js"></script>
  <script src="scripts/palette.js"></script>
  <script src="scripts/ui-load.js"></script>
  <script src="scripts/ui-jp.js"></script>
  <script src="scripts/ui-include.js"></script>
  <script src="scripts/ui-device.js"></script>
  <script src="scripts/ui-form.js"></script>
  <script src="scripts/ui-nav.js"></script>
  <script src="scripts/ui-screenfull.js"></script>
  <script src="scripts/ui-scroll-to.js"></script>
  <script src="scripts/ui-toggle-class.js"></script>
  <script src="scripts/jquery.dataTables.min.js"></script>
  <script src="scripts/select2.full.js"></script>
  <script src="libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
  <script src="scripts/select2.full.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.3/js/buttons.print.min.js"></script>



  <!-- <script src="scripts/app.js"></script> -->

  <!-- ajax -->
  <script src="libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script>
    var url   = window.location.href; 
    jQuery('ul.nav li').removeClass('active');   
        jQuery('ul.nav li a').each(function( index ) {
          
          if(jQuery(this).next('ul').find('li').length > 0 ){
            jQuery(this).next('ul').find('li').find('a').each(function( index ) {
              if( jQuery(this).attr("href") == url){
                jQuery(this).parent().addClass('active'); 
                jQuery(this).parent().parent().parent().addClass('open'); 
                return false;
              }
            })
          }else{
            if( jQuery(this).attr("href") == url){
              jQuery(this).parent().addClass('active');
              return false;
            }
          }
        })
  </script>
<!-- endbuild -->
</body>
</html>
