<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

/*Load values from .ini*/
define('APPROOT', $_SERVER['DOCUMENT_ROOT']);
$ini_array = parse_ini_file(APPROOT . '/.config.ini', true);
define('APPBASE', $ini_array["general"]["appbase"]);

foreach ($_GET as $key => $value) {$$key = $value;}
foreach ($_POST as $key => $value) {$$key = $value;}

require_once APPROOT . '/view/pageheader.php';
/* Labels */
$lblEditMedia = $objLabel->get_Label("lblEditMedia", $SelLang);
$lblView = $objLabel->get_Label("lblView", $SelLang);


?> 
<!--CSS-->
<link rel="stylesheet" type="text/css" href="/<?= APPBASE ?>assets/plugins/datatables/dataTables.min.css"/>
<link href="http://root.latinconnect.com/assets/plugins/magnific/magnific-popup.min.css" rel="stylesheet">
<link href="http://root.latinconnect.com/assets/plugins/cropper/cropper.min.css" rel="stylesheet">
<link href="http://root.latinconnect.com/assets/plugins/dropzone/dropzone.css" rel="stylesheet">
<link href="http://root.latinconnect.com/lc_media/assets/css/lcMedia.css" rel="stylesheet">
<link href="/assets/css/lightslider.css" rel="stylesheet" type="text/css"> 
<style>
    .cl-white .lc-orange {
        color: white !important;
    }
</style>
<div class="page-content page-profil m-t-40" data-Id="<?= $id ?>" >
    <div class="profil-content">
        <div class="row">
            
            <div class="col-md-12">
                <div class="item hover-effect new-item">
                    <div class="comment">
                        <table class="table table-bordered" id="driverTables">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Email</th>
                                    <th>Company</th> 
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
</div>


<!-- END PAGE CONTENT -->
<?php
require_once APPROOT . '/view/pagefooter.php';
?>
<script type="text/javascript" src="/<?= APPBASE ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/assets/js/lightslider.js"></script>
<script type="text/javascript" src="http://root.latinconnect.com/content/tags/assets/js/apiTags.js"></script>
<script type="text/javascript" src="http://root.latinconnect.com/assets/plugins/magnific/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="http://root.latinconnect.com/assets/plugins/dropzone/dropzone.min.js"></script> 
<script type="text/javascript" src="http://root.latinconnect.com/lc_media/assets/js/customCropper.js"></script>
<script type="text/javascript" src="http://root.latinconnect.com/assets/plugins/cropper/cropper.min.js"></script>
<script type="text/javascript" src="http://root.latinconnect.com/lc_media/assets/js/pdfobject.js"></script>
<script type="text/javascript" src="http://root.latinconnect.com/lc_media/assets/js/apiMedia.js"></script>
<script type="text/javascript" src="/assets/js/lc_media/media_admin.js"></script> 
<script>
  


jQuery('#driverTables').dataTable({
    ajax: {
        url: "/logistics/controller/drivers/driversData.php",
        type: "post"
    },
    columns: [
        {data: 'imageProfile'},
        {data: 'name'},
        {data: 'number'},
        {data: 'email'},
        {data: 'company'}
    ],
    sDom: 'W<"clear">lfrtip',
    drawCallback: function( settings ) {
        
        //Show on popup file
        /*jQuery('[id^="view_"]').off('click').click(function () {
            var file = jQuery(this).attr('src').split('cache/_default_');
            jQuery.magnificPopup.open({
                items: {
                    src: file[0] + 'raw/images' + file[1]
                },
                type: 'image',
                cursor: 'mfp-zoom-out-cur'
            });
        });
        jQuery('[id^="view_"]').attr({"data-toggle": "tooltip", "data-placement": "top", "title": "<?= $lblView ?>"}).tooltip();*/
        
        jQuery('[id^="view_"]').popover({
            html: true,
            content: function() {
                return jQuery('#popoverCont_0').html();
            }
        });
    }
});
</script>

