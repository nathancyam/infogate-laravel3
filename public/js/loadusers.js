$(document).ready(function(){
    $('.dropdown-toggle').change(function(event){
        event.preventDefault();
        console.log("A change!");
    });
});
