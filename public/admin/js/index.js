//add roles
$(document).ready(function(){
    $(document).on('click', '#addRoleButton', function(event) {
        event.preventDefault();
        var role =  $( ".role" ).val();
        $.ajax({
                type: "POST",
                url: "http://localhost/objorientedblog/public/roles/add",
                data: {
                    role: role
                },
                dataType: "json",
                success: function(data){
                    if (data.code == "200"){
                       $(".js-show-flash").html("<p>"+data.msg+"</p>").fadeIn('fast').delay(1000).fadeOut('fast');
                       $(".js-show-flash").css("display","block");
                       $( ".role" ).val("");
                    } else {
                       $(".invalid-feedback").html("<p>"+data.msg+"</p>");
                       $(".invalid-feedback").css("display","block");
                    }
                }

        });
    });
});
//edit roles
$(document).ready(function(){
    $(document).on('click', '#editRoleButton', function(event) {
        event.preventDefault();
        var role =  $( ".role" ).val();
        var roleId = $(".roleId").val();
        $.ajax({
                type: "POST",
                url: "http://localhost/objorientedblog/public/roles/edit/"+roleId,
                data: {
                    role: role
                },
                dataType: "json",
                success: function(data){
                    if (data.code == "200"){
                       $(".js-show-flash").html("<p>"+data.msg+"</p>").fadeIn('fast').delay(1000).fadeOut('fast');
                       $(".js-show-flash").css("display","block");
                    } else {
                       $(".invalid-feedback").html("<p>"+data.msg+"</p>");
                       $(".invalid-feedback").css("display","block");
                    }
                }

        });
    });
});
//delete roles
$(document).ready(function(){
    $(document).on('click', '#deleteRoleButton', function(event) {
        event.preventDefault();
        var roleId = $(this).val();
        $.ajax({
                type: "POST",
                url: "http://localhost/objorientedblog/public/roles/delete/"+roleId,
                data: {
                    id: roleId
                },
                dataType: "json",
                success: function(data){
                    if (data.code == "200"){
                       $('#'+roleId).remove();
                       $(".js-show-flash").html("<p>"+data.msg+"</p>").fadeIn('fast').delay(1000).fadeOut('fast');
                       $(".js-show-flash").css("display","block");
                    } else {
                       $(".invalid-feedback").html("<p>"+data.msg+"</p>");
                       $(".invalid-feedback").css("display","block");
                    }
                }

        });
    });
});
//add categories
$(document).ready(function(){
    $(document).on('click', '#js-buton-category', function(event) {
        event.preventDefault();
        var parent =  $( ".js-parent" ).val();
        var name =  $( ".js-name" ).val();
        var status =  $( ".js-status" ).val();
        var icon =  $( ".js-icon" ).val();
        var date =  $( ".js-date" ).val();
        $.ajax({
                type: "POST",
                url: "http://localhost/objorientedblog/public/categories/add",
                data: {
                    parent: parent,
                    name:name,
                    status:status,
                    icon:icon,
                    date:date
                },
                dataType: "json",
                success: function(data){
                    if (data.code == "200"){
                        $(".js-show-category").html("<p>"+data.msg+"</p>").fadeIn('fast').delay(1000).fadeOut('fast');
                        $(".js-show-category").css("display","block");
                        $( ".js-parent" ).val("");
                        $( ".js-name" ).val("");
                        $( ".js-status" ).val("");
                        $( ".js-icon" ).val("");
                        $( ".js-date" ).val("");
                    } else {
                       $.each(data.msg, function (key, val) {
                        $("#" + key + "_error").text(val).addClass('invalid-feedback').css("display","block");
                        });
                       // $(".invalid-feedback").html("<p>"+data.msg+"</p>");
                       // $(".invalid-feedback").css("display","block");
                    }
                }

        });
    });
});
//edit categories
$(document).ready(function(){
    $(document).on('click', '#js-edit-buton-category', function(event) {
        event.preventDefault();
        var catId = $(".catId").val();
        var parent =  $( ".js-edit-parent" ).val();
        var name =  $( ".js-edit-name" ).val();
        var status =  $( ".js-edit-status" ).val();
        var icon =  $( ".js-edit-icon" ).val();
        var date =  $( ".js-edit-date" ).val();
        $.ajax({
                type: "POST",
                url: "http://localhost/objorientedblog/public/categories/edit/"+catId,
                data: {
                    parent: parent,
                    name:name,
                    status:status,
                    icon:icon,
                    date:date
                },
                dataType: "json",
                success: function(data){
                    if (data.code == "200"){
                        $(".js-show-category").html("<p>"+data.msg+"</p>").fadeIn('fast').delay(1000).fadeOut('fast');
                        $(".js-show-category").css("display","block");
                        $( ".js-parent" ).val("");
                        $( ".js-name" ).val("");
                        $( ".js-status" ).val("");
                        $( ".js-icon" ).val("");
                        $( ".js-date" ).val("");
                    } else {
                       $.each(data.msg, function (key, val) {
                        $("#" + key + "_error").text(val).addClass('invalid-feedback').css("display","block");
                        });
                       // $(".invalid-feedback").html("<p>"+data.msg+"</p>");
                       // $(".invalid-feedback").css("display","block");
                    }
                }

        });
    });
});
//delete categories
$(document).ready(function(){
    $(document).on('click', '#deleteCategoryButton', function(event) {
        event.preventDefault();
        var catId = $(this).val();
        $.ajax({
                type: "POST",
                url: "http://localhost/objorientedblog/public/categories/delete/"+catId,
                data: {
                    id: catId
                },
                dataType: "json",
                success: function(data){
                    if (data.code == "200"){
                       $('#'+catId).remove();
                       $(".js-show-flash").html("<p>"+data.msg+"</p>").fadeIn('fast').delay(1000).fadeOut('fast');
                       $(".js-show-flash").css("display","block");
                    } else {
                       $(".invalid-feedback").html("<p>"+data.msg+"</p>");
                       $(".invalid-feedback").css("display","block");
                    }
                }

        });
    });
});