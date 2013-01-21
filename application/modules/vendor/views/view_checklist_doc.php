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
<div class="accordion-chklist">
    <h3 href="<?php echo site_url('/vendor/view_form/ep_vendor_dokumen' . $params) ?>">CHECKLIST DOKUMEN</h3>
    <div></div>
    <h3 href="<?php echo site_url('/vendor/grid/ep_vendor_dokumen_pendukung' . $params) ?>">DOKUMEN PENDUKUNG</h3>
    <div></div>
</div>

<script>
    $(".accordion-chklist").each(function(){
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
        
    $(document).ajaxComplete(function(){
        $('input, select, textarea', $('.accordion-chklist form')).attr('readonly', 'true');
    });
    
    $(".accordion, .accordion-chklist")
    .addClass("ui-accordion ui-widget ui-helper-reset")
    //.css("width", "auto")
    .find('h3')
    .addClass("current ui-accordion-header ui-helper-reset ui-state-active ui-corner-top")
    .css("padding", ".5em .5em .5em .7em")
    //.prepend('<span class="ui-icon ui-icon-triangle-1-s"><span/>')
    .next()
    .addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active")
    .css('overflow','visible');
</script>