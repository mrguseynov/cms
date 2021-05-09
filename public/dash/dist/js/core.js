var darckModeSt = window.localStorage;
let mode = darckModeSt.getItem('darkmode');
if(mode != null){
    $("body").addClass( mode );
    $( ".fa-moon" ).addClass('fas');
}
else{
    $( ".fa-moon" ).addClass('far');
}

$( "#night-mode" ).on( "click", function(event) {
    event.preventDefault();
    if($("body").hasClass( 'dark-mode' )){
        $("body").removeClass( 'dark-mode' );
        $( ".fa-moon" ).addClass('far');
        $( ".fa-moon" ).removeClass('fas');
        darckModeSt.removeItem('darkmode');
    }
    else{
        $("body").addClass( 'dark-mode' );
        $( ".fa-moon" ).addClass('fas');
        $( ".fa-moon" ).removeClass('far');
        darckModeSt.setItem('darkmode', 'dark-mode');
    }
});
