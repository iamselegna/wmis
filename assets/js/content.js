var _partno = null;
var _itemid = null;

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

function deleteInboundItem(row) {
    var i = row.parentNode.rowIndex;
    var itemlist = document.getElementById("itemlistbody");
    itemlist.deleteRow(i);

    var itemrow = itemlist.getElementsByTagName("tr");
    var itemlength = itemrow.length;

    if (itemlength == 0) {
        var x = document.createElement("tr");
        x.setAttribute("id", "noitem");
        itemlist.appendChild(x);

        var y = document.createElement("td");
        var z = document.createTextNode("Please Insert Item(s)");
        y.setAttribute("colspan", "3");
        x.appendChild(y);
        y.appendChild(z);
    }




    console.log(itemlength);

}

function addInboundListItem() {
    var checknoitem = document.getElementById("noitem");
    var itemlist = document.getElementById("itemlistbody");
    var itemrow = "<tr>" +
        "<input type=\"hidden\" name=\"itemid[]\" value=\"" + _itemid + "\">" +
        "<td><button type=\"button\" class=\"btn btn-danger btn-block\" onclick=\"deleteInboundItem(this)\">Remove</button></td>" +
        "<th scope=\"row\"><input type=\"text\" readonly class=\"form-control-plaintext\" value=\"" + _partno + "\"></th>" +
        "<td><input type=\"number\" class=\"form-control\" min=\"1\" max=\"99999\" name=\"itemqty[]\" placeholder=\"Quantity\" required></td>" +
        "</tr>";




    if (_itemid != null) {
        if (checknoitem) {
            itemlist.deleteRow(0);
            console.log(itemlist);
        }
        $("#itemlistbody").append(itemrow);
    }
    else {
        alert("Please select part no");
    }


    // var x = document.createElement("tr"); //CREATE TABLE ROW
    // itemlist.appendChild(x); //ADD TABLE ROW TO ITEM LIST TABLE

    // var y = document.createElement("td"); //CREATE TABLE DATA
    // var z = document.createTextNode("Please Insert Item(s)");
    // y.setAttribute("colspan","3");
    // x.appendChild(y);
    // y.appendChild(z);
}

$(function () {
    $("#finditem").autocomplete({
        source: "spmgetallpartno",
        minLength: 2,
        source: function (request, response) {
            // Fetch data
            $.ajax({
                url: "spmgetallpartno",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function (data) {
                    response(data);
                    console.log(data);
                }
            });
        },
        select: function (event, ui) {
            // Set selection
            console.log('PartNo: ' + ui.item.label + " Id: " + ui.item.value);
            _partno = ui.item.label;
            _itemid = ui.item.value;
            $("#finditem").val(ui.item.label); // display the selected text
            //$('#userid').val(ui.item.value); // save selected id to input
            return false;
        }
    });
});

$("#addspminboundinventoryform").submit(function (event) {
    event.preventDefault();

    var checknoitem = document.getElementById("noitem");

    if (checknoitem) {
        alert("Please insert item(s)");
        return false;
    }

    $form = $(this);

    $serializedData = $form.serialize();
    $.ajax({
        type: "POST",
        url: "spminboundinventoryadditem",
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