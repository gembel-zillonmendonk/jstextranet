<?php
$params = '';
if (count($_REQUEST) > 0) {
    foreach ($_REQUEST as $key => $value) {
        $params .= $key . '=' . $value . '&';
    }

    if (strlen($params) > 0)
        $params = '?' . $params;
}

//die($_REQUEST['KODE_PERUBAHAN']);
?>

<div class="accordion">
    <h3 href="<?php echo site_url('/contract/view_form/ammend.ep_ktr_perubahan' . $params) ?>">HEADER</h3>
    <div></div>
    <h3 href="<?php echo site_url('/contract/view_grid/contract.ep_ktr_kontrak_dok' . $params) ?>">LAMPIRAN</h3>
    <div></div>    

</div>
<div style="display: inline-block; width: 100%;">
    <div class="accordion" style="width: 50%; float:left">
        <h3 href="<?php echo site_url('/contract/view_grid/contract.ep_ktr_kontrak_item' . $params) ?>">ITEM</h3>
        <div></div>
        <h3 href="<?php echo site_url('/contract/milestone/view_grid/milestone.ep_ktr_jangka_kontrak' . $params) ?>">MILESTONE</h3>
        <div></div>
    </div>
    <div class="accordion" style="width: 50%; float:right">
        <h3 href="<?php echo site_url('/contract/ammend/view_grid/ammend.ep_ktr_perubahan_item' . $params) ?>">ITEM</h3>
        <div></div>
        <h3 href="<?php echo site_url('/contract/ammend/view_grid/ammend.ep_ktr_perubahan_jangka' . $params) ?>">MILESTONE</h3>
        <div></div>
    </div>
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
    
    
    $(document).ajaxComplete(function() {
        $("#id_ep_ktr_perubahan_kode_kontrak").change(function(){
            if($(this).val() != "")
                window.location = $site_url + "/wkf/start?kode_wkf=63&KODE_KONTRAK=" + $(this).val();
            else
                window.location = $site_url + "/wkf/start?kode_wkf=63&KODE_KONTRAK=-1";
        });
        
        var f = $("#id_form_ep_ktr_perubahan");
        var el = $("#id_form_ep_ktr_perubahan #btnSimpan");
        if(el.length > 0) {
            $(el).off('click');
            
            var validator = $(f).validate({
                meta: "validate",
                submitHandler: function(form) {
                    jQuery(form).ajaxSubmit();
                }
            });
        
            // attach event to button
            $(el).click(function() {
                if(validator.form()) {
                    jQuery(f).ajaxSubmit({
                        success: function(){
                            validator.prepareForm();
                            validator.hideErrors();
                            
                            var params = "KODE_KONTRAK="+$("#id_ep_ktr_perubahan_kode_kontrak", f).val()
                                +"&KODE_PERUBAHAN="+$("#id_ep_ktr_perubahan_kode_perubahan", f).val()
                                +"&KODE_KANTOR="+$("#id_ep_ktr_perubahan_kode_kantor", f).val();
                            
                            //reload page
                            window.location = '<?php echo site_url('/wkf/start?kode_wkf=63&') ?>' + params;
                        },
                        error: function(){
                            alert('Data gagal disimpan')
                        }
                    });
                }
            });
        }
    });
</script>