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
            //console.log(response);
            if (response.error) {
                $("#spmadditemmessage").html(response.message);
                $("#spmadditemmessage").removeClass("text-info");
                $("#spmadditemmessage").addClass("text-danger");
                console.log(response.message);
            }
            else {
                $("#spmadditemmessage").html(response.message);
                $("#spmadditemmessage").removeClass("text-danger");
                $("#spmadditemmessage").addClass("text-info");
                console.log(response.message);
            }
        },
        error: function (response) {

        }
    });

});