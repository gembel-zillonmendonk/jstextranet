$(function() {
    //    $.validator.addMethod("date", function (value, element) {
    //        return /^(([0-2]{1})([1-9]{1})|([3]{1})([0-1]{1}))(-|\/)(([0-1]{1})([1-2]{1})|([0]{1})([0-9]{1}))(-|\/)(\d{4})/.test(value);
    //    });
        
    $.validator.addMethod("dateID", function(value, element) {
        return this.optional(element) || /^\d\d?[\.\/-]\d\d?[\.\/-]\d\d\d?\d?$/.test(value);
    }, "Format tanggal dd-mm-yyyy.");
    
    $.validator.addMethod("datetimeID", function(value, element) {
        return this.optional(element) || /^\d\d?[\.\/-]\d\d?[\.\/-]\d\d\d?\d?[\s]([0-1]\d|2[0-3]):([0-5]\d):([0-5]\d)$/.test(value);
    }, "Format waktu dd-mm-yyyy HH:mm:ss.");
    
    $(".datepicker").livequery(function(){
        var dateoptions = {
            showOn: 'both',
            buttonImageOnly: true,
            buttonText: 'Calendar',
            dateFormat: "dd-mm-yy",
            readOnly: true
        //            defaultDate: $('.datepicker').val()
        };
        $(this).datepicker(dateoptions);
    });
    
    $(".money").livequery(function(){
        var e = $(this);
        $(e).each(function(){
            $(this).autoNumeric('destroy');
            $(this).autoNumeric('init');
        });
    });
    
    $("#form form, form").livequery(function(){
        var clear_form = true;
        var form = $(this);
        var object = form.attr("id") ? form.attr("id").replace("id_form_","").toLowerCase() : null;
        $("input:submit, input:button, button", form).button();
        
        if(! object){
            return false;
        }
        
        var validator = $(form).validate({
            meta: "validate",
            submitHandler: function(f) {
                jQuery(form).ajaxSubmit({
                    
                    //clearForm: <?php echo $form->clear_form ? "true" : "false"; ?>,
                    success: function(data){
                        if (clear_form) {
                            $(form).resetForm();
                            $(form).clearForm();
                            validator.prepareForm();
                            validator.hideErrors();
                                    
                            // new : for load form from server with default attributes 
                            var url = window.location.href;
                            var tempArray = url.split("?");
                            var additionalURL = tempArray[1];
                            var action = $(form).attr("action");
                            var newAction = action.split("?");
                            
                            newAction = newAction[0] + "?" + additionalURL;
                            $(form).parent().load(newAction);
                        } else {
                            // replace form
                            $(form).replaceWith(data);
                        }
    
                        
                        alert('Data berhasil disimpan');
                            
                            
                        //reload grid
                        $('#grid_' + object).trigger("reloadGrid");
                        
                    },
                    error: function(){
                        alert('Data gagal disimpan')
                    }
                });
            }
        });
    
            
        $("#btnSimpan", form).click(function(){
            form.submit();
        });
        
        
        $("#btnBatal", form).click(function() {
            $(form).resetForm();
            validator.prepareForm();
            validator.hideErrors();
                
            // new : for load form from server with default attributes 
            var url = window.location.href;
            var tempArray = url.split("?");
            var additionalURL = tempArray[1];
                
            var action = $(form).attr("action");
            var newAction = action.split("?");
            newAction = newAction[0] + "?" + additionalURL;
            $(form).parent().load(newAction);
        });
        
        
       
    
    });
});