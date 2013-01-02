<?php $this->load->helper('form'); ?>
 <script type="text/javascript" src="<?php echo base_url();  ?>js/tiny_mce/tiny_mce.js"></script> 
<div class="accordion">
    <h3 href="" >INFORMASI PENGADAAN</h3>
    <div>
      <fieldset class="ui-widget-content">
      <div id="modal_form_viewmonitor" ></div>
      <div id="modal_form_penawaran" ></div>
      
          <form id="frmPermintaan" method="POST"  >
        <p>	
            <?php echo form_label("NOMOR PENGADAAN") ?>
	    <input type="text"  readonly="true" name="KODE_TENDER"  value="<?php echo $KODE_TENDER; ?>" />
            <a href="javascript:fnViewMonitor();" >[Klik Untuk Melihat Pengadaan Detail]</a>
	</p>
        <p>	
            <?php echo form_label("NOMOR PENAWARAN ") ?>
	    <input type="text"   readonly="true" name="NAMA_KANTOR" value="<?php echo $NO_PENAWARAN ; ?>" />
            <a href="javascript:fnPenawaran();" >[Klik Untuk Melihat/Edit Penawaran]</a>
        </p>
      </form>
        </fieldset>     
    </div>
    <h3 href="<?php echo base_url() ."index.php/crud/gridrf/ep_pgd_pesan_tender?KODE_TENDER=" . $KODE_TENDER . "&KODE_KANTOR=" . $KODE_KANTOR; ?>">HISTORI KOMENTAR</h3>
    <div>
       
        <div id="list"></div>
    </div>
    <h3 href="">KOMENTAR</h3>
    <div>
         <form id="frmKomentar" action="<?php echo base_url() . "index.php/pengadaan/negosiasi" ?>"  method="POST" >
			<p>                   
               <textarea  style="width:100%" id="commentar" name="commentar" ></textarea>
			</p>
                    <input type="hidden" name="KODE_TENDER" id="KODE_TENDER" value="<?php echo $KODE_TENDER ; ?>" />
                   <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR" value="<?php echo $KODE_KANTOR; ?>" />						
                   <input type="hidden" name="KODE_VENDOR" id="KODE_VENDOR" value="<?php echo $KODE_VENDOR; ?>" />
                   <input type="hidden" id="komentar"  name="komentar" /> 			
			</form>
        
    </div>
     
    </form>
    <p align="center">
    <button type="button" id="btnSimpan" >Simpan</button>
    <button type="button" id="btnKembali" >Kembali</button>
        
    </p>
    
</div>
<div id="trace" ></div>
<script>
     tinyMCE.init({
		mode : "textareas",
		theme : "simple", 
                setup : function(ed) {
               
                    ed.onChange.add(function(ed, evt) {



                        //$(ed.getBody()).find('p').addClass('headline');

                        // get content from edito
                        var content = ed.getContent().toUpperCase();

                        // tagname to toUpperCase
                        // content = content.replace(/< *\/?(\w+)/g,function(w){return w.toUpperCase()});
                       ed.setContent(content);
                        // write content to html source element (usually a textarea)
                        // $(ed.id).html(content );
                    });
                }
	});
        

    $(document).ready(function(){
        
        
        $("#btnSimpan").click(function(){ 
            // alert("Kirim"); 
                       $('#komentar').val(tinyMCE.get('commentar').getContent());
                       $("#frmKomentar").ajaxSubmit({
                                             success: function(msg){
                                                 
                                            //  $("#trace").html(msg);
                                              // alert(msg);
                                                  
                                                 //reload grid
                                                 //   window.location.reload();
                                                    window.location = "<?php echo base_url() ."index.php/pengadaan/daftar_pekerjaan"; ?>";  
                     
                                             },
                                             error: function(){
                                                 alert('Data gagal disimpan')
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
    
    
    
    function  fnViewMonitor() { 
		str= "";
		jQuery('#modal_form_viewmonitor')
                     .load($site_url + '/pengadaan/view_popup?KODE_TENDER=<?php echo $KODE_TENDER; ?>&KODE_KANTOR=<?php echo $KODE_KANTOR; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        height: 400,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_viewmonitor').dialog("open");
        } 
        
   
    function  fnPenawaran() { 
		str= "";
		jQuery('#modal_form_penawaran')
                     .load($site_url + '/pengadaan/penawaran_negosiasi?KODE_TENDER=<?php echo $KODE_TENDER; ?>&KODE_KANTOR=<?php echo $KODE_KANTOR; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        height: 400,
                        width:1000,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            },
                            "SIMPAN": function() { 
                                      $("#frm_komersial").ajaxSubmit({
                                                 //clearForm: false,
                                                 success: function(msg){
                                                       //    alert(msg);
                                                         //$("#trace").html(msg);
                                                    // alert(msg);
                                                      //window.location.reload(1);
                                                   //   $("#peringkat").html(msg);
                                                   jQuery('#modal_form_penawaran').dialog("close"); 


                                                 },
                                                 error: function(){
                                                     alert('Data gagal disimpan')
                                                 }
                                     });


                               //  $(this).dialog("close");
                            }
                        } 
                        
                    });
            jQuery('#modal_form_penawaran').dialog("open");
        } 
        	
  
  </script>
 
