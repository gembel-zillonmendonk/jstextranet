<div style="display: table;">
    <div style="float:left; width: 50%">
        <?php echo Modules::run('vendor/_view'); ?>
    </div>
    <div style="float:left; width: 50%">
        <?php echo Modules::run('vendor/_view_temp'); ?>
    </div>
</div>
<script>
    $( ".tabs" ).tabs({
        select: function(event, ui){
            // You need Firebug or the developer tools on your browser open to see these
            //console.log(event);
            // This will get you the index of the tab you selected
            //console.log(event.target.baseURI);

            //            $( ".tabs" ).tabs( "select", ui.panel.id );
            //$(".tabs").tabs("select", 1);
            //            $(".tabs").each(function(){
            //                $(this).tabs( "select", ui.panel.id );
            //            });
            //window.location.href = event.target.baseURI + "#" + ui.panel.id
            
            document.location.href = event.target.baseURI + "#" + ui.panel.id
            location.reload();
            return false;
        }
    });
    //    $( ".tabs" ).bind( "tabselect", function(e, ui){
    //        alert(e + ' = ' + ui.index);
    //        //alert(ui.index);
    //    });
</script>