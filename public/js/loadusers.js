$(document).ready(function(){
    $('#userrole').change(function(){
        var role;
        var roleChosen = parseInt($('#userrole').val());
        switch(roleChosen){
            case 0:
                role = "admin";
            break;
            case 1:
                role = "coordinator";
            break;
            case 2:
                role = "teacher";
            break;
            case 3:
                role = "student";
            break;
            default:
                break;
        }
        $.get(BASE+'/role/'+role, function(data){
            $('#table').html(data);
        });
    });
    $("td").click(function(){
        console.log("class =" + $(this).attr("class"));
        console.log("contents = " + $(this).text());
    })
});
