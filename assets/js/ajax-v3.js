jQuery(document).ready(function ($) {
    console.log('hi jquery');
    var myForm = $('#myform');

    $(myForm).submit(function (e) {
        //Prevent normal form submission
        e.preventDefault();
        $('.spinner-border').css('display','block');
        //Get the form data and store in a variable
        var myformData = new FormData(myForm[0]);

        //Add our own action to the data
        //action is where we will be hooking our php function
        myformData.append('action', 'pn_wp_frontend_ajax_upload');

        //Prepare and send the call
        $.ajax({
            type: "POST",
            data: myformData,
            dataType: "json",
            url: custom_theme_mbm_object.ajaxurl,
            cache: false,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function (data, textStatus, jqXHR) {
                console.log('success upload');
                console.log(data);
                $('#plan-uploaded').val(data.file_id);
                $('#plan-uploaded-img').attr('src',data.url);
                $('.spinner-border').css('display','none');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //if fails     
                $('.spinner-border').css('display','none');
                alert('خطا دوباره امتحان فرمائید');
                console.log('fail upload');
                console.log(jqXHR);
            }
        });
    });
});

function select_plan_from_gallery(obj)
{
    $('#plan-uploaded-img').attr('src',obj.children('img').eq(0).attr('src'));
}