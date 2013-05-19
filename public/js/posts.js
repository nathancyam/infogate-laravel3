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
    bootbox.confirm("Are you sure you delete this post?", function(result){
        if (result){
            var goHere = $('#btn_Delete').data('link');
            $.ajax({
                url: goHere,
                type: 'DELETE',
                success: function(result){
                    console.log("Successfully deleted this post");
                }
            });
        } else {
            console.log("Not deleted yet");
        }
    })
})