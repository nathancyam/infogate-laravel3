$(document).on("click", "#btn_Approve", function(event){
    bootbox.confirm("Are you sure you wish to confirm this post?", function(result){
        if (result){
            var goHere = $('#btn_Approve').data('link');
            $.ajax({
                url: goHere,
                type: 'PUT',
                success: function(result){
                    console.log("Successfully approved post");
                }
            });
        } else {
            console.log("Not approved yet");
        }
    })
})
$(document).on("click", "#btn_Delete", function(event){
    var goHere = $('#btn_Delete').data('link');
    $.ajax({
        url: goHere,
        type: 'DELETE',
        success: function(result){
            console.log("Successfully deleted this post");
        }
    });
})
function equalHeight(group) {
    var tallest = 0;
    group.each(function() {
        var thisHeight = $(this).height();
        if(thisHeight > tallest) {
            tallest = thisHeight;
        }
    });
    group.height(tallest);
}

$(document).ready(function(){
})
