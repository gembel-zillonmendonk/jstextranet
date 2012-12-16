<?php $this->load->helper('form'); ?>
<div class="accordion">
    <h3 href="<?php echo base_url() . "index.php/pengadaan_monitor/header?KODE_TENDER=" . $KODE_TENDER . "&KODE_KANTOR=" . $KODE_KANTOR; ?>" >INFORMASI UMUM</h3>
    <div>
         
        <div id="list"></div>
    </div>
    <h3 href="<?php echo base_url(); ?>index.php/crud/gridrf/ep_pgd_item_tender_view?KODE_TENDER=<?php echo $KODE_TENDER; ?>&KODE_KANTOR=<?php echo $KODE_KANTOR; ?>">ITEM PENGADAAN</h3>
    <div>
       
        <div id="list"></div>
    </div>
    <h3 href="<?php echo base_url(); ?>index.php/crud/gridrf/ep_pgd_dokumen?KODE_TENDER=<?php echo $KODE_TENDER; ?>&KODE_KANTOR=<?php echo $KODE_KANTOR; ?>">DOKUMEN PENDUKUNG</h3>
    <div>
        
        <div id="list"></div>
    </div>
    <h3 href="<?php echo base_url(); ?>index.php/pengadaan_monitor/metode_jadwal?KODE_TENDER=<?php echo $KODE_TENDER; ?>&KODE_KANTOR=<?php echo $KODE_KANTOR; ?>">INFORMASI PENGADAAN</h3>
    <div>
         
        <div id="list"></div>
    </div>
    
    <form id="frm_Pendaftaran" method="POST" action="<?php echo base_url() . "index.php/pengadaan/pendaftaran_add" ?>" >
     
    <input type="hidden" name="KODE_TENDER" value="<?php echo $KODE_TENDER; ?>" />
    <input type="hidden" name="KODE_KANTOR" value="<?php echo $KODE_KANTOR; ?>" />
    <input type="hidden" name="KODE_VENDOR" value="<?php echo $KODE_VENDOR; ?>" />
    
    <p align="center">
        <label>Reason</label>
    
     
    <select id="PVTS_STATUS" name="PVTS_STATUS" >
        <option Value="0">PILIH</option>
        <option Value="2">DAFTAR</option>
        <option Value="-1">TIDAK IKUT</option>
    </select> 
   <button type="button" id="btnKirim" >KIRIM</button>
    </p>
    </form>
      
</div>
<div id="trace" ></div>
<script>


    $(document).ready(function(){
        
        
        $("#btnKirim").click(function(){ 
            alert("Kirim");
            if ($("#PVTS_STATUS").val() != 0) {
                       $("#frm_Pendaftaran").ajaxSubmit({
                                             success: function(msg){
                                                 
                                             //$("#trace").html(msg);
                                             alert(msg);
                                                  
                                                 //reload grid
                                                 //   window.location.reload();
                                                  window.location = "<?php echo base_url() ."index.php/pengadaan/daftar_pekerjaan"; ?>";  
                     
                                             },
                                             error: function(){
                                                 alert('Data gagal disimpan')
                                             }
                                          
                                      });
            }
            
    
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
 
