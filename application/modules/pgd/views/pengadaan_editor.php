<?php
print_r($kode_aktifitas);

print_r($arr_antarmuka);

?>
 <script type="text/javascript" src="<?php echo base_url();  ?>js/tiny_mce/tiny_mce.js"></script> 
<?php
if (in_array("MonitorTender", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorTender" href="<?php echo base_url(); ?>index.php/pgd/view_form/ep_pgd_tender?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">HEADER</h3>
    <div>
        
          <div id="list" ></div>
    </div>
 </div>
<?php
}
?> 
<?php
if (in_array("MonitorMataAnggaran", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorMataAnggaran" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_perencanaan_anggaran?KODE_PERENCANAAN=<?php echo $kode_perencanaan; ?>&KODE_KANTOR_PERENCANAAN=<?php echo $kode_kantor_perencanaan; ?>">Mata Anggaran</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
<?php
}
?> 

    <?php
if (in_array("MonitorTenderDetail", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorTenderDetail" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >ITEM</h3>
    <div>
        
        <div id="list" ></div>
    </div>
 </div>     
<?php
}
?>

<?php
if (in_array("MonitorTenderDocument", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorTenderDocument" href="">LAMPIRAN</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
<?php
}
?> 

<?php
if (1) {
?>
<div class="accordion">
 <h3 id="MonitorTender" href="<?php echo base_url(); ?>index.php/pgd/view_form/ep_pgd_persiapan_tender?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">METODE DAN JADWAL PENGADAAN</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
<?php
}
?> 
<?php
if (1) {
?>
<div class="accordion">
 <h3 id="MonitorKomentar" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_komentar_tender?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">DAFTAR KOMENTAR</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
<?php
}
?> 

<?php   
if (1) {
?>
<div class="accordion">
 <h3 id="Komentar" href="<?php echo base_url(); ?>index.php/pgd/komentar_tender/edit?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>&KODE_KOMENTAR=<?php echo $kode_komentar; ?>&KODE_AKTIFITAS=<?php echo $kode_aktifitas; ?>">KOMENTAR</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
<?php
}
?> 
 <script>
  
  $(document).ready(function(){
	//$("#mysearch").jqGrid('filterGrid','#grid_ep_kom_kelompok_jasa');
	
     	
	$(".accordion" ).each(function(){
                 
                
                $('h3', $(this)).each(function(){
                    var uri = $(this).attr('href');
				//	alert(uri);
                    if(uri != '' && uri != '#'){
                            var ctn =  $(this).next().children("#list");   
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
    });
    
  </script>  
                