 <div class="accordion">
            <h3 href="">RINGKASAN AKTIFITAS/PEKERJAAN</h3>
            <div>
                 <table class="ui-jqgrid-htable" style="width: 100%;" cellspacing="0" cellpadding="0" border="0" >
          <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 40%; height: 30px" >Aktivitas</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >Jumlah</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 40%; height: 30px" >Aktivitas</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >Jumlah</th>  
          </tr>
           <tr>
              <td style="height: 25px" >&nbsp;Undangan Pengadaan/Pengadaan</td>
              <td   align="center"  ><a href="<?php echo base_url() . "index.php/pengadaan/daftar_pekerjaan?PTVS_STATUS=1"; ?>" ><?php echo $cnt_undangan; ?></a></td>
              <td  >&nbsp;Negosiasi Pengadaan</td>
              <td   align="center" ><a href="<?php echo base_url() . "index.php/pengadaan/daftar_pekerjaan?PTVS_STATUS=10"; ?>" ><?php echo $cnt_negosiasi; ?></a></td>
           </tr>
           <tr>
              <td style="height: 25px" >&nbsp;Penawaran yang Sudah Dikirim</td>
              <td   align="center"  ><a href="<?php echo base_url() . "index.php/pengadaan/daftar_pekerjaan?PTVS_STATUS=3,21"; ?>" ><?php echo $cnt_sudah_kirim_penawaran; ?></a></td>
              <td  >&nbsp;Award Announcement</td>
              <td   align="center" ><a href="<?php echo base_url() . "index.php/pengadaan/monitor_pekerjaan?PTVS_STATUS=11"; ?>" ><?php echo $cnt_award; ?></a></td>
           </tr>
           <tr>
              <td style="height: 25px" >&nbsp;Pengadaan yang Menunggu Penawaran</td>
              <td   align="center"  ><a href="<?php echo base_url() . "index.php/pengadaan/daftar_pekerjaan?PTVS_STATUS=2,20"; ?>" ><?php echo $cnt_tunggu_penawaran; ?></a></td>
              <td  >&nbsp;Menunggu Pembuatan BASTP/B</td>
              <td   align="center" >0</td>
           </tr>
           <tr>
              <td style="height: 25px" >&nbsp;Pengadaan yang Sedang Dievaluasi</td>
              <td   align="center"  >0</td>
              <td  >&nbsp;Tagihan Berjalan</td>
              <td   align="center" >0</td>
           </tr>
           
      </table>
     
            </div>
            <h3 href="">Catatan</h3>
            <div>
                <ul style=" text-align : left;">
                    <li>Kami menjamin setiap penawaran/transaksi yang anda lakukan dalam aplikasi ini terjaga kerahasiannya, di mana tidak ada pihak satupun (termasuk buyer) yang berhak menginformasikan penawaran anda sampai penawaran/lelang dibuka.</li>
                    <li><b>Sangatlah disarankan</b> untuk mengirimkan penawaran Anda sesegera mungkin, di mana Anda masih diberi kesempatan untuk melakukan verifikasi pada penawaran tersebut  sampai saat penutupan.</li>
                    <li>Aplikasi akan secara otomatis keluar (log out) bila browser Anda tidak melakukan aktivitas lebih dari 20 menit. Untuk lebih menjamin keamannya, disarankan untuk mengganti password Anda setiap 30-60 hari.</li>
                    <!--
                    <li>Aplikasi akan secara otomatis keluar (session habis), jika ada dua akun yang login berbarengan di komputer yang berbeda.</li>
                    <li>Tampilan terbaik dari aplikasi ini bila anda menggunakan Microsoft Internet Explorer 6.0 (atau di atasnya lagi) dengan resolusi minimum 1024 x 768 pixel</li>
                -->
                </ul>
                
            </div>
 </div>           
 <script>
    // Tabs
    $('.tabs').tabs({
        show: function(event, ui) {
            $(".accordion", ui.panel).each(function(){
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
    .css('overflow','visible');
</script>
      