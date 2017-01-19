$(document).ready(function () {

    var user_href;
    var user_href_splitted;
    var user_id;
    var image_src;
    var image_src_splitted;
    var image_name;
    var photo_id;


    $('.modal_thumbnails').click(function () {
        // Enable the Apply Selection button
        $("#set_user_image").prop('disabled', false);

        // Get the user id
        user_href = $("#user-id").prop('href');
        user_href_splitted = user_href.split("=");
        user_id = user_href_splitted[user_href_splitted.length - 1];

        // Get the image name
        image_src = $(this).prop("src");
        image_src_splitted = image_src.split("/");
        image_name = image_src_splitted[image_src_splitted.length - 1];

        // Sidebar
        photo_id = $(this).attr('data');
        $.ajax({
            url: "includes/ajax_code.php",
            data: {photo_id: photo_id},
            type: "POST",
            success: function (data) {
                if (!data.error) {
                    //Set user image to new image
                    $('#modal_sidebar').html(data);
                }
            }
        });
    });

    $("#set_user_image").click(function () {
        $.ajax({
            url: "includes/ajax_code.php",
            data: {image_name: image_name, user_id: user_id},
            type: "POST",
            success: function (data) {
                if (!data.error) {
                    //Set user image to new image
                    $('#users_img').attr('src', image_src);
                }
            }
        });
    });

    /************* Edit Photo Sidebar ***********/
    $('.info-box-header').click(function () {
        $('.inside').slideToggle("fast");
        $("#toggle").toggleClass("glyphicon-menu-down");
        $("#toggle").toggleClass("glyphicon-menu-up");
    });

    /**************** Confirm photo delete ****************/
    $('.delete_link').click(function () {
        return confirm("Are you sure you want to delete?");
    });


    tinymce.init({selector: 'textarea'});
});





