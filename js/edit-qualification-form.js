
function update_form_qualification_val() {
    var str = '';
    $("input.edit-process-checkbox:checkbox:checked").each(function(){
        str += ($(this).val()) + ' ';
    });
    $("#ap-form-qualification-val").val(str);
    
    return str;
}

function update_form_s_certification_val() {
    var str = '';
    $("input.edit-s-process-checkbox:checkbox:checked").each(function(){
        str += ($(this).val()) + ' ';
    });
    $("#ap-form-s-certification-val").val(str);
    
    return str;
}

$(function() {
$('document').ready(function(){
    update_form_qualification_val();
    update_form_s_certification_val();
    $('input.edit-process-checkbox').change(function() {
        var s = update_form_qualification_val();
    });
    $('input.edit-s-process-checkbox').change(function() {
        var s = update_form_s_certification_val();
    });
})});