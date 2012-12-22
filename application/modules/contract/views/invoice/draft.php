<?php
$params = '';
if (count($_REQUEST) > 0) {
    foreach ($_REQUEST as $key => $value) {
        $params .= $key . '=' . $value . '&';
    }

    if (strlen($params) > 0)
        $params = '?' . $params;
}
?>

<div class="accordion">
    <?php if (strlen($params) > 0 && $_REQUEST['KODE_INVOICE'] == "@@KODE_INVOICE@@"): ?>
        <h3 href="<?php echo site_url('/contract/invoice/form/invoice.ep_ktr_invoice' . $params) ?>">HEADER</h3>
        <div></div>
<!--        
        <h3 href="<?php echo site_url('/contract/invoice/grid_form/invoice.ep_ktr_invoice_item' . $params) ?>">ITEM</h3>
        <div></div>
        <p>
            <button type="button" id="selesai">Lanjutkan Proses</button>
        </p>-->
    <?php else: ?>
        <h3 href="<?php echo site_url('/contract/invoice/view_form/invoice.ep_ktr_invoice' . $params) ?>">HEADER</h3>
        <div></div>
        <h3 href="<?php echo site_url('/contract/invoice/grid_form/invoice.ep_ktr_invoice_item' . $params) ?>">ITEM</h3>
        <div></div>
    <?php endif; ?>
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
        var f = $("#id_form_ep_ktr_invoice");
        $("#id_ep_ktr_invoice_kode_kontrak", f).change(function(){
            var newURL = window.location.href
            newURL = updateURLParameter(newURL, 'KODE_KONTRAK', $(this).val());
            window.location = newURL;            
        });
        
        var el = $("#id_form_ep_ktr_invoice #btnSimpan");
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
                            
//                                                        alert($("#id_ep_ktr_kontrak_kode_kontrak", f).val());
//                            alert($("select[name='EP_KTR_INVOICE[KODE_KONTRAK]']", data).val());
                            
                            var KODE_VENDOR = $("input[name='EP_KTR_INVOICE[KODE_VENDOR]']", data).val();
                            var KODE_INVOICE = $("input[name='EP_KTR_INVOICE[KODE_INVOICE]']", data).val();
                            var KODE_KONTRAK = $("input[name='EP_KTR_INVOICE[KODE_KONTRAK]']", data).val();
                            var KODE_KANTOR = $("input[name='EP_KTR_INVOICE[KODE_KANTOR]']", data).val();
                            
//                            var params = "KODE_KONTRAK="+kode_kontrak
//                                +"&KODE_KANTOR="+kode_kantor
//                                +"&KODE_INVOICE="+kode_invoice
//                                +"&KODE_VENDOR="+kode_vendor;
                            
//                            alert(params);
                            
                            //reload page
//                            window.location = $site_url +"/contract/invoice/create_draft?" + params;

                            var newURL = window.location.href
                            newURL = updateURLParameter(newURL, 'KODE_KONTRAK', KODE_KONTRAK);
                            newURL = updateURLParameter(newURL, 'KODE_KANTOR', KODE_KANTOR);
                            newURL = updateURLParameter(newURL, 'KODE_VENDOR', KODE_VENDOR);
                            newURL = updateURLParameter(newURL, 'KODE_INVOICE', KODE_INVOICE);
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
    
//    $(document).ready(function(){
//        $('#selesai').live('click', function(){
//            var f = $("#id_form_ep_ktr_invoice");
//            var params = "KODE_KONTRAK="+$("#id_ep_ktr_invoice_kode_kontrak", f).val()
//                +"&KODE_KANTOR="+$("#id_ep_ktr_invoice_kode_kantor", f).val()
//                +"&KODE_INVOICE="+$("#id_ep_ktr_invoice_kode_invoice", f).val()
//                +"&KODE_VENDOR="+$("#id_ep_ktr_invoice_kode_vendor", f).val();
//            
//            if(params.length > 0)
//                window.location = '<?php echo site_url('/wkf/start?kode_wkf=62&referer_url=/contract/invoice/monitoring&') ?>' + params;
//        });
//    });
    
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