
<div class="accordion">
    <h3 href="#">DAFTAR KOMENTAR</h3>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <?php
                    $cols = $history[0];
                    $col_cnt = count($history);
                    foreach ($cols as $key => $val) :
                        ?>
                        <th>
                            <?php echo $key; ?>
                        </th>

                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history as $key => $val) : ?>
                    <tr>
                        <td>
                            <?php echo++$key; ?>
                        </td>
                        <?php foreach ($val as $k => $v) : ?>
                            <td>
                                <?php echo $v; ?>
                            </td>
                        <?php endforeach; ?>                                
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>    
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