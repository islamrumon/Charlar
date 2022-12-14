$(document).ready(function () {
    //  select2 start
    // Single Search Select
    $(".select2").select2();

    // Multi Select
    $(".select2-multi").select2();
    // select2 end

   
});

//empji


//published the all
$('input[type="checkbox"]').change(function () {
    var url = this.dataset.url;
    var id = this.dataset.id;

    if (url != null && id != null) {
        $.ajax({
            url: url,
            data: { id: id },
            method: "get",
            success: function (result) {
                // $.notify(result.message, "success");
                new PNotify({
                    title: "Success notice",
                    text: result.message,
                    type: "success",
                });
            },
        });
    }
});

// theme dark mood
$(".mode").on("click", function () {
    var url = $("#darkRoute").val();
    $.ajax({
        url: url,
        method: "get",
        success: function (result) {
            console.log(result);
        },
    });
    $(".mode").toggleClass("dark");
    $("body").toggleClass("dark-only");
    var color = $(this).attr("data-attr");
    localStorage.setItem("body", "dark-only");
});

//show the modal in this function
function forModal(url, message) {
    $("#show-modal").modal("show");
    $("#title").text(message);
    $("#show-form").load(url);
    $("body").on("shown.bs.modal", ".modal", function () {
        $(this)
            .find("select")
            .each(function () {
                var dropdownParent = $(document.body);
                if ($(this).parents(".modal.in:first").length !== 0)
                    dropdownParent = $(this).parents(".modal.in:first");
                $(this).select2({
                    dropdownParent: dropdownParent,
                    templateResult: formatState,
                    templateSelection: formatState,
                });
            });
    });
}
