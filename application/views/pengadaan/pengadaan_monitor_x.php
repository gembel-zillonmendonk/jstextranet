<?php $this->load->helper('form'); ?>
<div class="accordion">
    <h3 href="<?php echo base_url() . "index.php/pengadaan_monitor_x/header?KODE_TENDER=" . $KODE_TENDER . "&KODE_KANTOR=" . $KODE_KANTOR; ?>" >INFORMASI UMUM</h3>
    <div>
         
        <div id="list"></div>
    </div>
   
    <h3 href="<?php echo base_url(); ?>index.php/crudx/gridrf/ep_pgd_item_tender_view?KODE_TENDER=<?php echo $KODE_TENDER; ?>&KODE_KANTOR=<?php echo $KODE_KANTOR; ?>">ITEM PENGADAAN</h3>
    <div>
       
        <div id="list"></div>
    </div>
    
 <?php
     if (!$is_lelang) {
    ?>
    <h3 href="<?php echo base_url(); ?>index.php/crudx/gridrf/ep_pgd_dokumen?KODE_TENDER=<?php echo $KODE_TENDER; ?>&KODE_KANTOR=<?php echo $KODE_KANTOR; ?>">DOKUMEN PENDUKUNG</h3>
    <div>
        
        <div id="list"></div>
    </div>
    <?php
     }
    ?>
    <h3 href="<?php echo base_url(); ?>index.php/pengadaan_monitor_x/metode_jadwal?KODE_TENDER=<?php echo $KODE_TENDER; ?>&KODE_KANTOR=<?php echo $KODE_KANTOR; ?>">INFORMASI PENGADAAN</h3>
    <div>
         
        <div id="list"></div>
    </div>
   
 
   
</div>
<div id="trace" ></div>
<script>


    $(document).ready(function(){
        
        /*
        
        $("#btnKembali").click(function(){ 
            // alert("btnKembali");
            window.location = "<?php echo base_url() . "index.php/pengadaan/monitor"; ?> "; 
    
        }); 
        
        */
            
             
        
        
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
        
        
    $('.accordion h3').each(function(){
        var uri = $(this).attr('href');
        if(uri != '' && uri != '#'){
           var ctn =  $(this).next().children("#list");  
            //alert($(ctn).width());
                
            if(ctn.html() == '')
                ctn.load(uri);
        }
    });
    });
    
  </script>
 
