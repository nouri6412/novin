jQuery(document).ready(function ($) {
    console.log('hi jquery');
    var myForm = $('#myform');

    $(myForm).submit(function (e) {
        //Prevent normal form submission
        e.preventDefault();

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
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //if fails     
                console.log('fail upload');
                console.log(jqXHR);
            }
        });
    });
});