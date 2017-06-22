


$(document).ready(function() {
    $('.modal').modal({
        //complete: function() { location.reload(); },
        dismissible: false
    });
});
$(document).ready(function() {
    $('select').material_select();
});

$(".item-info").click(function() {
    $("#modal-response h4").text("");
    $("#modal-form").css("display", "none");
    $("#listingForm").css("display", "none");
    $("#progress").css("display", "flex");
    $("#createBtn").css("display", "none");
    $("#updateBtn").css("display", "flex");
    $("#listingBtn").css("display", "flex");
    $("#deleteBtn").css("display", "flex");
    $("#updateListingBtn").css("display", "none");
    $("#publishBtn").css("display", "none");

    var skuText = $(this).prev()[0].innerText;
    $.ajax({
        url: "../item_details",
        method: 'post',
        data: { sku: skuText },

        success: function(result) {
            $("#progress").fadeOut('slow');
            $("#modal-form").fadeIn('slow');
            result = JSON.parse(result);
            $("#sku").val(result["sku"]);
            $("#title").val(result["product"]["title"]);
            $("#description").val(result["product"]["description"]);
            $("#quantity").val(result["availability"]["shipToLocationAvailability"]["quantity"]);
            $("#condition").val(result["condition"]);
            $("#imageUrls").val(result["product"]["imageUrls"][0]);
            $('select').material_select();
            Materialize.updateTextFields();

        }
    });

    Materialize.updateTextFields();
});

$(".modal-form-button").click(function() {


    switch($(this).attr("id")) {
        case "deleteBtn":
            $("#modal-form").css("display", "none");
            $("#progress").css("display", "flex");
            $.ajax({
                url: "../delete_item/" + $("#sku").val(),
                method: 'post',
                success: function(response) {
                    console.log(response);
                    if(response == "") {
                        $("#progress").css("display","none");
                        $("#modal-response").css("display", "block");
                        $("#cancelBtn").css("display", "flex");
                        $("#modal-response h4").text("Item successfully deleted.");
                    }
                    else {

                        $("#progress").css("display","none");
                        $("#modal-response h4").text("Unable to delete item");
                    }
                }
            });
            break;

        case "updateBtn":
        case "createBtn":

            $("#modal-form").css("display", "none");
            $("#progress").css("display", "flex");
            var $form = $("#modal-form");
            var item = {
                Sku: $form.find("#sku").val(),
                Title: $form.find("#title").val(),
                Description: $form.find("#description").val(),
                Quantity: $form.find("#quantity").val(),
                Condition: $form.find("#condition").val(),
                ImageUrls: $form.find("#imageUrls").val()
            };
            console.log(item);
            $.ajax({
                url: "../create_item",
                method: 'post',
                data: item,
                success: function(response, status) {
                    $("#progress").css("display", "none");
                    var $response = $("#modal-response");
                    $response.css("display", "flex");
                    console.log(response);
                    if(response !== false) {
                        $response.children().text("Item updated");
                    }
                    else {
                        $response.children().text("Unable to update item");
                    }
                },
                error: function(xhr, status, error) {
                    $("#progress").css("display", "none");
                    var $response = $("#modal-response");
                    $response.css("display", "flex");
                    $response.children().text("Status: " + status + ". Error: " + error);
                }
            });
            break;

        case "listingBtn":
            $("#modal-form").css("display", "none");
            $("#progress").css("display", "flex");
            $("#updateBtn").css("display", "none");
            $("#listingBtn").css("display", "none");
            $("#deleteBtn").css("display", "none");
            $("#updateListingBtn").css("display", "flex");
            $("#publishBtn").css("display", "flex");

            var sku = $("#modal-form").find("#sku").val();
            $.ajax({
                url: "../get_offers",
                method: 'post',
                data: { sku: sku },
                success: function(response, status) {
                    $("#progress").fadeOut('slow');
                    console.log(response);
                    $("#listingForm").fadeIn('slow');
                    response = JSON.parse(response);
                    $("#offerSku").val(response["offers"][0]["sku"]);
                    $("#offerId").val(response["offers"][0]["offerId"]);
                    $("#offerQuant").val(response["offers"][0]["availableQuantity"]);
                    $("#offerCat").val(response["offers"][0]["categoryId"]);
                    $("#offerStatus").val(response["offers"][0]["status"]);
                    $("#offerPrice").val();
                    Materialize.updateTextFields();
                },
                error: function(xhr, status, error) {
                    $("#progress").css("display", "none");
                    var $response = $("#modal-response");
                    $response.css("display", "flex");
                    $response.children().text("Status: " + status + ". Error: " + error);
                }
            });
            break;
        case "publishBtn":
            $("#progress").show();
            var offerId = $("#offerId").val();
            $.ajax({
                url: "../publish_offer",
                method: 'post',
                data: { offerId: offerId },
                success: function(response, status) {
                    $("#progress").fadeOut('slow');
                    if(response === "") {
                        Materialize.toast('Sorry, unable to publish listing', 4000);
                    }
                    else {
                        console.log(response);
                    }
                    Materialize.updateTextFields();
                },
                error: function(xhr, status, error) {

                }
            });
    }
});

$("#createItemBtn").click(function() {
    $("#modal-form")[0].reset();
    $("#modal-response h4").text("");
    $("#modal-form").css("display", "flex");
    $("#createBtn").css("display", "flex");
    $("#updateBtn").css("display", "none");
    $("#listingBtn").css("display", "none");
    $("#deleteBtn").css("display", "none");
});

$("#deleteAll").click(function() {
    $(".card-title").each(function(index, element) {
        $sku = $(this).text();
        var $context = $(this);
        $.ajax({
            url: "../delete_item/" + $sku,
            method: "POST",
            success: function() {
                console.log("Deleted " + $sku);
                $context.closest('.card-container').fadeOut('slow');
            }
        });
    });
});