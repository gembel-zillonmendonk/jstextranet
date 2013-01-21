<div id="ctn_proses"></div>
<script>
    $(document).ready(function(){
        var $url = '<?php echo site_url('/wkf/run?referer_url=/account/success_message&kode_proses='.$proses['KODE_PROSES'].'&KODE_VENDOR='.$proses['KODE_VENDOR']); ?>';
        $.get('<?php echo site_url('/wkf/run?referer_url=/account/success_message&kode_proses='.$proses['KODE_PROSES'].'&KODE_VENDOR='.$proses['KODE_VENDOR']); ?>', function(data){
            $('#ctn_proses').html(data);
            
            var $ctn = $('#ctn_proses');
//            $('button', $ctn).click(function(){
//                alert('xxx');
//                return false;
//            });
            
            $('form', $ctn).attr('action',$url);
        });
    });
</script>
<?php //echo modules::run('/wkf/run?referer_url=/account/waiting_approval&kode_proses='.$proses['KODE_PROSES'].'&KODE_VENDOR='.$proses['KODE_VENDOR']); ?>