<?php $this->load->helper('form'); ?>
<div class="accordion">
    <h3 href="">PENAWARAN</h3>
    <div>
        <fieldset class="ui-widget-content">
        <form id="frm_Penawaran" method="POST" action="" >
        <input type="hidden" name="KODE_TENDER" value="<?php echo $KODE_TENDER; ?>" />   
        <input type="hidden" name="KODE_KANTOR" value="<?php echo $KODE_KANTOR; ?>" />   
        <input type="hidden" name="KODE_VENDOR" value="<?php echo $KODE_VENDOR; ?>" />   
        
        
        <p>	
            <?php echo form_label("Nomor Pengadaan") ?>
	    <input type="text" readonly="true" name="KODE_TENDER"  value="<?php echo $KODE_TENDER; ?>" />
	</p>
        <p>	
            <?php echo form_label("Nomor Penawaran *") ?>
	    <input type="text" style="width: 50%"  class="{validate:{required:true}}"   name="NO_PENAWARAN"  value="<?php echo $NO_PENAWARAN;  ?>" />
	</p>
        <p>	
            <?php echo form_label("Tipe Penawaran *") ?>
	    <select name="TIPE" class="{validate:{required:true}}">
                <option value="">--</option>
                <option value="A" <?php echo ($TIPE == "A" ? " SELECTED " : " "); ?>  >Type A</option>
                <option value="B" <?php echo ($TIPE == "B" ? " SELECTED " : " "); ?>  >Type B</option>
                <option value="C" <?php echo ($TIPE == "C" ? " SELECTED " : " "); ?>  >Type C</option>
            </select>        
         </p>
        <p>	
            <?php echo form_label("Nilai Bidbond *") ?>
	    <input type="number"   class="{validate:{required:true}}"   id="BID_BOND" name="BID_BOND" value="<?php echo $BID_BOND;  ?>" />
	</p>
        <p>	
            <?php echo form_label("Kandungan Lokal *") ?>
	    <input type="number"   class="{validate:{required:true}}"   id="KANDUNGAN_LOKAL" name="KANDUNGAN_LOKAL" value="<?php echo $KANDUNGAN_LOKAL;  ?>" />
	</p>
        <p>	
            <?php echo form_label("Waktu Pengiriman *") ?>
	    <input type="number"   class="{validate:{required:true}}"   id="WAKTU_PENGIRIMAN" name="WAKTU_PENGIRIMAN" value="<?php echo $WAKTU_PENGIRIMAN;  ?>" />
            <select name="UNIT">
                <option value="H" >HARI</option>
                <option value="W" >MINGGU</option>
                <option value="M" >BULAN</option>
                
            </select>    
        </p>
        <p>	
            <?php echo form_label("Berlaku Hingga *") ?>
	    <input type="text"  class="datepicker  {validate:{required:true,dateID:true}}"   id="BERLAKU_HINGGA" name="BERLAKU_HINGGA" value="<?php echo $BERLAKU_HINGGA;  ?>" />
	</p>
        <p>	
            <?php echo form_label("CATATAN") ?>
            <input type="text"  style="width: 50%"     id="KETERANGAN" name="KETERANGAN" value="<?php echo $KETERANGAN;  ?>" />
        </p>
        <p>	
            <?php echo form_label("MATA UANG") ?>
            <input type="text"      id="MATAUANG"   readonly="true"  name="MATAUANG" value="IDR" />
        </p>
        
        </form>
        </fieldset>
        <!--
        <p> 
            <button id="btnPenawaran" >Update</button>
        </p>
        -->
        <div id="list"></div>
    </div>
    <h3 href="">ITEM ADMINISTRASI</h3>
    <div>
      <form id="frm_adm" method="POST" action="" >
    
        <table class="ui-jqgrid-htable" style="width: 100%;" cellspacing="0" cellpadding="0" border="0" >
          <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px"  >Nomor</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 70%; height: 30px" >Deskripsi</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 20%; height: 30px" >Respon Vendor</th>
          </tr>
          <?php
          $i = 1;
          foreach($rsadm as $row) {
          ?>
          
          <tr>
              <td align="center" >&nbsp;<?php echo $i; ?></td>
              <td>&nbsp;<?php echo $row->KETERANGAN; ?></td>
              <td align="center" > &nbsp;<group> <input type="radio"   name="VENDOR_CEK[]"  <?php echo ($row->VENDOR_CEK ? " CHECKED " : " "); ?>  value="1" >YA</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="VENDOR_CEK[]"  value="0" <?php echo ($row->VENDOR_CEK == 0 ? " CHECKED " : " "); ?>   >TIDAK</input> </group>  </td>
          </tr>
          <input type="hidden"  name="KETERANGAN[]"   value="<?php echo $row->KETERANGAN; ?>" />
           <input type="hidden"  name="BERAT[]"   value="<?php echo $row->BERAT; ?>" />
          <?php
          $i++;
          }
          ?>
          
          <input type="hidden" name="administrasi" value="1" />
         <input type="hidden" name="KODE_TENDER" value="<?php echo $KODE_TENDER; ?>" />   
         <input type="hidden" name="KODE_KANTOR" value="<?php echo $KODE_KANTOR; ?>" />   
         <input type="hidden" name="KODE_VENDOR" value="<?php echo $KODE_VENDOR; ?>" />   
        
      
          </table>
        
        
      </form>
        <!--
        <p> 
            <button id="btnAdministrasi" >Update</button>
        </p>
        -->
        <div id="list"></div>
    </div>
    <h3 href="">ITEM TEKNIS</h3>
    <div>
          <form id="frm_teknis" method="POST" action="" >
    
        <table class="ui-jqgrid-htable" style="width: 100%;" cellspacing="0" cellpadding="0" border="0" >
          <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px"  >No</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 50%; height: 30px" >Deskripsi</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 40%; height: 30px" >Respon Vendor</th>
          </tr>
          <?php
          $i = 1;
          foreach($rsteknis as $row) {
          ?>
          
          <tr>
              <td align="center" >&nbsp;<?php echo $i; ?></td>
              <td>&nbsp;<?php echo $row->KETERANGAN; ?></td>
              <td align="center" > &nbsp;<input type="text" style="width: 90%" name="KETERANGAN_VENDOR[]" value="<?php echo $row->KETERANGAN_VENDOR; ?>" /> </td>
          </tr>
          <input type="hidden"  name="KETERANGAN[]"   value="<?php echo $row->KETERANGAN; ?>" />
          <input type="hidden"  name="BERAT[]"   value="<?php echo $row->BERAT; ?>" />
          
          <?php
          $i++;
          }
          
          
          
          ?>
        </table>  
        <input type="hidden" name="teknis" value="1" />
         <input type="hidden" name="KODE_TENDER" value="<?php echo $KODE_TENDER; ?>" />   
         <input type="hidden" name="KODE_KANTOR" value="<?php echo $KODE_KANTOR; ?>" />   
         <input type="hidden" name="KODE_VENDOR" value="<?php echo $KODE_VENDOR; ?>" />   
        
          </form>
        <!--
         <p> 
            <button id="btnTeknis" >Update</button>
        </p>
        -->
        <div id="list"></div>
    </div>
    <h3 href="">ITEM KOMERSIAL</h3>
    <div>
             <form id="frm_komersial" method="POST" action="" >
    
        <table class="ui-jqgrid-htable" style="width: 100%;" cellspacing="0" cellpadding="0" border="0" >
          <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%; height: 30px"  >No</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >Kode</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 20%; height: 30px" >Deskripsi</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%; height: 30px" >Jumlah</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >[Penawaran Vendor] <br/> Deskripsi</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%; height: 30px" >[Penawaran Vendor] <br/>  Jumlah</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >[Penawaran Vendor] <br/>  Harga Satuan</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >[Penawaran Vendor] <br/> Sub Total</th>
              
          </tr>
          <?php
          $i = 1;
          foreach($rskomersial as $row) {
          ?>
          
          <tr>
              <td style="width: 5%; height: 30px"  align="center" >&nbsp;<?php echo $i; ?></td>
              <td>&nbsp;<?php echo $row->KODE_BARANG_JASA; ?></td>
              <td>&nbsp;<?php echo $row->KETERANGAN; ?></td>
              <td>&nbsp;<?php echo $row->JUMLAH; ?></td>
              <td>&nbsp;<input type="text" id="KETERANGAN_PENAWARAN_<?php echo $i; ?>"  name="KETERANGAN_PENAWARAN[]" value="<?php echo $row->KETERANGAN_PENAWARAN; ?>" /></td>
              <td>&nbsp;<input onchange="fnSubTotal(<?php echo $i; ?>)" type="number" style="text-align: right" id="JUMLAH_PENAWARAN_<?php echo $i; ?>"   name="JUMLAH_PENAWARAN[]" value="<?php echo $row->JUMLAH_PENAWARAN; ?>" /></td>
              <td>&nbsp;<input onchange="fnSubTotal(<?php echo $i; ?>)" type="number" style="text-align: right" id="HARGA_PENAWARAN_<?php echo $i; ?>"   name="HARGA_PENAWARAN[]" value="<?php echo $row->HARGA_PENAWARAN; ?>" /></td>
              <td>&nbsp;<input type="number" id="SUBTOTAL_PENAWARAN_<?php echo $i; ?>" style="text-align: right"  value="<?php echo ($row->JUMLAH_PENAWARAN * $row->HARGA_PENAWARAN); ?>" name="SUBTOTAL_PENAWARAN[]" /></td>
              
          
          </tr>
          <input type="hidden" name="KODE_BARANG_JASA[]" value="<?php echo $row->KODE_BARANG_JASA; ?>" /> 
          <input type="hidden" name="KODE_SUB_BARANG_JASA[]" value="<?php echo $row->KODE_SUB_BARANG_JASA; ?>" /> 
          
                   
          <?php
          $i++;
          }
          ?>
        </table>
                 
                 
                   <input type="hidden" name="komersial" value="1" />
                   
                   
                   <input type="hidden" name="KODE_TENDER" value="<?php echo $KODE_TENDER; ?>" />   
                    <input type="hidden" name="KODE_KANTOR" value="<?php echo $KODE_KANTOR; ?>" />   
                    <input type="hidden" name="KODE_VENDOR" value="<?php echo $KODE_VENDOR; ?>" />   
        </form>
        
        <div id="item_total" ref="<?php echo base_url(); ?>index.php/item_total/total?KODE_TENDER=<?php echo $KODE_TENDER; ?>&KODE_KANTOR=<?php echo $KODE_KANTOR; ?>&KODE_VENDOR=<?php echo $KODE_VENDOR; ?>"  >
        </div>
        
        <!--
        <p> 
            <button id="btnKomersial" >Update</button>
        </p>
        -->
        <div id="list"></div>
    </div>
    <p align="center" id="peringkat" style="font-size: 18;font-weight: bold;color: red" >
        
     </p>
    <p align="center" >
        <button type="button" id="btnSimpan" >Simpan</button>
        <button type="button" id="btnKembali" >Kembali</button>
    </p>
    
</div>
<div id="trace" ></div>
<script>



    $(document).ready(function(){


    
     $('#item_total').each(function(){
    
                    var uri = $(this).attr('ref');
				//	alert(uri);
                            $(this).load(uri);
                    }
      );
     

    

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
    
    
        var validator_Penawaran = $("#frm_Penawaran").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        
        $("#btnAdministrasi").click(function() {
            
                   $("#frm_adm").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                    //   alert(msg);
                                    //   $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                    
                                     

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                    });
                            
        });
        $("#btnTeknis").click(function() {
           
                   $("#frm_teknis").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                    //   alert(msg);
                                     //  $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                    
                                     

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                    });
                            
        });
    
    $("#btnKomersial").click(function() {
           
                   $("#frm_komersial").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                       alert(msg);
                                       $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                    
                                     

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                    });
                            
        });
        
    

    $("#btnPenawaran").click(function() {
        
     
            	 if(validator_Penawaran.form()) {
                    $("#frm_Penawaran").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                        alert(msg);
                                        $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                     

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
                 
      });
        
    $("#btnKembali").click(function(){
        
          window.location = "<?php echo base_url() ."index.php/pengadaan/daftar_pekerjaan"; ?>";  
                     
        
    })
    
    
    $("#btnSimpan").click(function(){
        if (Number($("#BID_BOND").val()) < Number($("#min_bidbond").val()) ) { 
            alert("Nilai Bid Bond Tidak Cukup ");
            return;
        }
        
                   if(validator_Penawaran.form()) {
                    $("#frm_Penawaran").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
             
                                                               
                                        $("#frm_adm").ajaxSubmit({
                                                     //clearForm: false,
                                                     success: function(msg){
                                                          //  alert(msg);
                                                          //  $("#trace").html(msg);
                                                        // alert(msg);
                                                         //reload grid

                                                                 $("#frm_teknis").ajaxSubmit({
                                                                            //clearForm: false,
                                                                            success: function(msg){
                                                                                 // alert(msg);
                                                                                  // $("#trace").html(msg);
                                                                                        $("#frm_komersial").ajaxSubmit({
                                                                                                     //clearForm: false,
                                                                                                     success: function(msg){
                                                                                                             // alert(msg);
                                                                                                             //$("#trace").html(msg);
                                                                                                        // alert(msg);
                                                                                                          //window.location.reload(1);
                                                                                                          $("#peringkat").html(msg);
                                                                                                         //  alert($('#item_total').attr('ref'));   
                                                                                                          $('#item_total').load($('#item_total').attr('ref'));

                                                                                                     },
                                                                                                     error: function(){
                                                                                                         alert('Data gagal disimpan')
                                                                                                     }
                                                                                         });




                                                                            },
                                                                            error: function(){
                                                                                alert('Data gagal disimpan')
                                                                            }
                                                                });



                                                     },
                                                     error: function(){
                                                         alert('Data gagal disimpan')
                                                     }
                                         });

             
                    
                    
                                    
                                     

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }    
        
    })
    
    
    });
    
    
    
    function fnSubTotal(ival) {
        if ($("#HARGA_PENAWARAN_" + ival).val() == "") {
            $("#HARGA_PENAWARAN_" + ival).val(0);
            
        }
        if ($("#JUMLAH_PENAWARAN_" + ival).val() == "") {
            $("#JUMLAH_PENAWARAN_" + ival).val(0);
        }
    
    
        $("#SUBTOTAL_PENAWARAN_"  + ival).val(  $("#HARGA_PENAWARAN_" + ival).val() *  $("#JUMLAH_PENAWARAN_" + ival).val());
        
    }

    
 </script>
 
