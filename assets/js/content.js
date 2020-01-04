$("#addspmitem").submit(function (event) {
    event.preventDefault();

    $form = $(this);

    $serializedData = $form.serialize();

    //console.log($serializedData);
    $.ajax({
        type: "POST",
        url: "spmhubadditem",
        datatype: 'json',
        data: $serializedData,
        success: function (response) {
            console.log(response);
            if (response.error) {
                $("#spmadditemmessage").html(response.message);
                $("#spmadditemmessage").removeClass("text-info");
                $("#spmadditemmessage").addClass("text-danger");
                console.log(response.message);
            }
            else {
                $("#partno").val('');
                $("#spmadditemmessage").html(response.message);
                $("#spmadditemmessage").removeClass("text-danger");
                $("#spmadditemmessage").addClass("text-info");
                console.log(response.message);
            }
        },
        error: function (response) {
            $("#spmadditemmessage").html("Something wen't wrong while processing your request. Please contact your system administrator.");
            $("#spmadditemmessage").removeClass("text-info");
            $("#spmadditemmessage").addClass("text-danger");
            console.log(response.message);
        }
    });

});

$("#selectEntries").change(function (event) {

    event.preventDefault();

    $("#selectEntries option:selected").each(function () {
        /* console.log($(this).text());
        console.log($baseurl);
        window.location.assign($baseurl+"?per_page="+$(this).text()); */
        $("#showEntries").submit();
    });

});
