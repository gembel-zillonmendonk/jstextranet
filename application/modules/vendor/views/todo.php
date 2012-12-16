<div class="accordion">
    <h3 href="<?php echo site_url('/vendor/grid/vendor.vw_ep_vendor_registration') ?>">DAFTAR VENDOR BARU YANG PERLU PERSETUJUAN</h3>
    <div></div>
    <h3 href="<?php echo site_url('/vendor/grid/vendor.vw_ep_vendor_update') ?>">DAFTAR VENDOR UPDATE YANG PERLU PERSETUJUAN</h3>
    <div></div>
    <h3 href="<?php echo site_url('/vendor/grid/vendor.vw_ep_vendor_blacklist') ?>">DAFTAR VENDOR BLACK LIST YANG PERLU PERSETUJUAN</h3>
    <div></div>
    <h3 href="<?php echo site_url('/vendor/grid/vendor.vw_ep_vendor_suspend') ?>">DAFTAR VENDOR DALAM PENGAWASAN YANG PERLU PERSETUJUAN</h3>
    <div></div>
    <h3 href="<?php echo site_url('/vendor/grid/vendor.vw_ep_vendor_activation') ?>">DAFTAR VENDOR AKTIVASI YANG PERLU PERSETUJUAN</h3>
    <div></div>
    <h3 href="<?php echo site_url('/vendor/grid/vendor.vw_ep_vendor_expired') ?>">DAFTAR VENDOR TDP,SIUP,DOMISILI EXPIRED YANG PERLU PERSETUJUAN</h3>
    <div></div>
    <h3 href="<?php echo site_url('/vendor/grid/vendor.vw_ep_vendor_delisting') ?>">DAFTAR DELISTING VENDOR PRODUCT/SERVICE</h3>
    <div></div>
    <h3 href="<?php echo site_url('/vendor/grid/vendor.vw_ep_vendor_undelisting') ?>">DAFTAR UNDELISTING VENDOR PRODUCT/SERVICE</h3>
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