<?php
$params = '';
if (count($_REQUEST) > 0) {
    foreach ($_REQUEST as $key => $value) {
        $params .= $key . '=' . rawurlencode($value) . '&';
    }

    if (strlen($params) > 0)
        $params = '?' . $params;
}
?>
<?php $this->load->helper('form'); ?>
<div class="accordion">
    <h3 href="#">PENCARIAN</h3>
    <div>
        <form action="" accept-charset="utf-8" id="id_form_form_deactivation" name="form_form_deactivation" method="GET" enctype="multipart/form-data" class="form-horizontal" novalidate="novalidate">
            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <?php echo form_label("JANGKA KONTRAK EXPIRED", "EXPIRED", array("class" => "control-label")) ?> 
                        <div class="controls">
                            <?php
                            echo form_dropdown("EXPIRED_CONDITION", array(
                                'eq' => '==',
                                'gt' => '>=',
                                'lt' => '<=',
                                'ne' => '<>',
                                    ), isset($_REQUEST['EXPIRED_CONDITION']) ? $_REQUEST['EXPIRED_CONDITION'] : "", 'class="{validate:{required:true,maxlength:22}}"');
                            ?>
                            <?php echo form_input("EXPIRED_VALUE", isset($_REQUEST['EXPIRED_VALUE']) ? $_REQUEST['EXPIRED_VALUE'] : "", 'class="{validate:{required:true,maxlength:22}}"'); ?>
                            BULAN
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="btnCari" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">CARI</span></button>
            <button type="button" id="btnBatal" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">BATAL</span></button>

        </form>
    </div>
    <h3 href="<?php echo site_url('/contract/grid/contract.monitoring' .$params) ?>">DAFTAR SELURUH KONTRAK</h3>
    <div></div>
    
</div>
<script>
    $(".accordion").each(function(){
        //alert("test");
                
        $('h3', $(this)).each(function(){
            var uri = $(this).attr('href');
            if(uri != '' && uri != '#'){
                var ctn = $(this).next();
                //alert($(ctn).width());
                //alert(uri);
                if(ctn.html() == '')
                    ctn.load(uri);
            }
        });
    });
    
    $(".accordion")
    .addClass("ui-accordion ui-widget ui-helper-reset")
    //.css("width", "auto")
    .find('h3')
    .addClass("current ui-accordion-header ui-helper-reset ui-state-active ui-corner-top")
    .css("padding", ".5em .5em .5em .7em")
    //.prepend('<span class="ui-icon ui-icon-triangle-1-s"><span/>')
    .next()
    .addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active")
    .css('overflow','visible')
    //.css("width", "auto");
</script>