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

<div class="accordion">
    <h3 href="<?php echo site_url('/contract/po/form/po.ep_ktr_po_perkembangan' . $params) ?>">HEADER</h3>
    <div></div>
    <?php if (!isset($_REQUEST['KODE_PERKEMBANGAN']) || $_REQUEST['KODE_PERKEMBANGAN'] == 0): ?>
        <h3 href="<?php echo site_url('/contract/po/view_grid/po.ep_ktr_po_item' . $params) ?>">ITEM</h3>
    <?php else: ?>
        <h3 href="<?php echo site_url('/contract/po/grid_form/po.ep_ktr_po_item_perkembangan' . $params) ?>">ITEM</h3>
    <?php endif; ?>

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
    
    $(document).ajaxComplete(function() {
        var f = $("#id_form_ep_ktr_po_perkembangan");
        var el = $("#id_form_ep_ktr_po_perkembangan #btnSimpan");
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
                        success: function(data){
                            validator.prepareForm();
                            validator.hideErrors();
                            
                            var kode_perkembangan = $("input[name='EP_KTR_PO_PERKEMBANGAN[KODE_PERKEMBANGAN]']", data).val();
                            var kode_po = $("input[name='EP_KTR_PO_PERKEMBANGAN[KODE_PO]']", data).val();
                            var kode_kontrak = $("input[name='EP_KTR_PO_PERKEMBANGAN[KODE_KONTRAK]']", data).val();
                            var kode_kantor = $("input[name='EP_KTR_PO_PERKEMBANGAN[KODE_KANTOR]']", data).val();
                            
                            $("#id_form_ep_ktr_po_perkembangan").replaceWith(data);
                            f = data;
                            
                            var params = "KODE_PERKEMBANGAN="+kode_perkembangan
                                +"&KODE_PO="+kode_po
                                +"&KODE_KONTRAK="+kode_kontrak
                                +"&KODE_KANTOR="+kode_kantor;
                            
                            //alert(params);
                            //reload page
                            //window.location = $site_url +"/contract/create_draft?" + params;
                            
                            //window.location = '<?php echo site_url('/wkf/start?kode_wkf=64&referer_url=/contract/po/list_todo&') ?>' + params;
                            
                            var newURL = updateURLParameter(window.location.href, 'KODE_PERKEMBANGAN', kode_perkembangan);
                            window.location = newURL;
                        },
                        error: function(){
                            alert('Data gagal disimpan')
                        }
                    });
                }
            });
        }
    });
    
    /**
     * http://stackoverflow.com/a/10997390/11236
     */
    function updateURLParameter(url, param, paramVal){
        var newAdditionalURL = "";
        var tempArray = url.split("?");
        var baseURL = tempArray[0];
        var additionalURL = tempArray[1];
        var temp = "";
        if (additionalURL) {
            tempArray = additionalURL.split("&");
            for (i=0; i<tempArray.length; i++){
                if(tempArray[i].split('=')[0] != param){
                    newAdditionalURL += temp + tempArray[i];
                    temp = "&";
                }
            }
        }

        var rows_txt = temp + "" + param + "=" + paramVal;
        return baseURL + "?" + newAdditionalURL + rows_txt;
    }
</script>