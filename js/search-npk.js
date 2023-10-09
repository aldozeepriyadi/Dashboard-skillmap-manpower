function search_npk(npk) {
    if ('URLSearchParams' in window) {
        console.log(npk);
        window.location.replace("actions/search-npk.php?q=" + npk.toString())
    }
}

$(function() {
    $('#npk-search-btn').click(function(){
        var searched_npk = $("#npk-search").val();
        search_npk(searched_npk);
    });
});
