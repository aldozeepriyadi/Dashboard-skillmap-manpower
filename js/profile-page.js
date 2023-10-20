var show = function(id) {
	$(id).removeClass('hidden');
}
var hide = function(id) {
	$(id).addClass('hidden');
}

function hide_tabs() {
    $(".pt-tab").each(function () {
        $(this).addClass("hidden");
    });
}

function hide_descs() {
    $(".mp-desc").each(function () {
        $(this).addClass("hidden");
    });
}

$(function() {
    $('document').ready(function(){
        console.log($(".pt-tab"));
        $(".pt-update-assessment").addClass("hidden");
        $(".pt-chart-info").removeClass("hidden");
        $("#show-msk").prop('checked', true)
    });
    $('#pt-tab-radio').change(function(){
        selected_value = $("input[name='pt-tab']:checked").val();
        hide_tabs();
        if (selected_value == "chart-info") {
            $(".pt-chart-info").removeClass("hidden");
        } else if (selected_value == "update-assessment") {
            $(".pt-update-assessment").removeClass("hidden");
        };

        console.log(selected_value);
    });

    $('#show-mp-desc').change(function(){
        selected_value = $("input[name='show-mp-desc']:checked").val();
        hide_descs();
        $("#"+selected_value).removeClass("hidden");

        console.log("#"+selected_value);
    });
});