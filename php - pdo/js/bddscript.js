$(document).ready(function () {
    window.setTimeout(function() {
        $(".alert").fadeTo(1000, 50).slideUp(1000, function(){
            $(this).remove();
        });
    }, 5000);
});
