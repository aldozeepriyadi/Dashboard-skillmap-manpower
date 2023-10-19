$(function() {
$('document').ready(function(){
    $('#ap-form-ws option').mousedown(function(e) {
        e.preventDefault();
        var originalScrollTop = $(this).parent().scrollTop();
        $(this).prop('selected', $(this).prop('selected') ? false : true);
        var self = this;
        $(this).parent().focus();
        setTimeout(function() {
            $(self).parent().scrollTop(originalScrollTop);
        }, 0);

        var items = $("#ap-form-ws").val();
        var str = '';
        if (items != null)
            items.forEach(element => {
            str += element + " ";
        });
        $('#ap-form-ws-val').attr('value', str);
        return false;
    });

    $('select#ap-form-role').on('change', function() {
        if (this.value == 0) {
            $('#ap-form-ws').attr('multiple', 'multiple')
        }
        else {
            $('#ap-form-ws').removeAttr('multiple')
        }
      });
})});
