<div class="accordion">
    <h3 href="<?php echo site_url('/contract/ammend/view_grid/ammend.ep_ktr_perubahan_todo') ?>"> DAFTAR PEKERJAAN ADENDUM KONTRAK</h3>
    <div></div>
    <h3 href="<?php echo site_url('/contract/po/view_grid/po.ep_ktr_po_todo') ?>"> DAFTAR PEKERJAAN WORK ORDER</h3>
    <div></div>
    <h3 href="<?php echo site_url('/contract/milestone/view_grid/milestone.ep_ktr_jangka_todo_approval') ?>"> DAFTAR PEKERJAAN PROGRESS</h3>
    <div></div>
    <h3 href="<?php echo site_url('/contract/invoice/view_grid/invoice.ep_ktr_invoice_todo') ?>">  DAFTAR PEKERJAAN TAGIHAN</h3>
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