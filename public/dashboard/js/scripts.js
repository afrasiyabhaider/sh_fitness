$(function() {
    /**
     *  Image Previewer
     *
     */
    $("#img-input").imoViewer({
        preview: "#img-previewer"
    });

    /**
     * Confirmations
     *
     */
    $(".confirmation").click(function() {
        return confirm("Do you really want to perform this action?");
    });

    /**
     *  Jquery Datatables
     *
     */
    var table = $("#data_table").DataTable({
        dom: "Blfrtip",
        lengthChange: true,
        lengthMenu: [5, 10, 25, 50, 100],
        pagingType: "full_numbers",
        // select: true,
        buttons: [{
            extend: "collection",
            text: "<i class='fa fa-file-export'></i> Export",
            className: "mb-2",
            buttons: ["excel", "csv"]
        }]
    });

    /**
     * Check all permissions if super admin is selcted
     * Below code is for Register Role
     *
     * Below code will toggle if check/uncheck Super Admin
     * {check/uncheck and enable/disable all checkbox except Super Admin}
     *
     */
    $("#super_admin").click(function() {
        $("input:checkbox")
            .not(this)
            .prop("checked", this.checked);
        if (this.checked) {
            $("input:checkbox")
                .not(this)
                .prop("disabled", true)
                .prop("disabled", true);
        } else {
            $("input:checkbox")
                .not(this)
                .prop("disabled", false);
        }
    });

    /**
     * This code is for store role form it will enabled fields on submit
     * otherwise we can not get value of checkboxes in our controller
     *
     */
    $("#store_role").submit(function() {
        $("input:checkbox").prop("disabled", false);
    });

    /**
     * Initializing Select 2
     *
     */
    $(".select2").select2();
});

$("#civil_chooseFile").bind("change", function() {
    var filename = $("#civil_chooseFile").val();
    if (/^\s*$/.test(filename)) {
        $(".file-upload").removeClass("active");
        $("#civil_noFile").text("No file chosen...");
    } else {
        $(".file-upload").addClass("active");
        $("#civil_noFile").text(filename.replace("C:\\fakepath\\", ""));
    }
});
$("#passport_chooseFile").bind("change", function() {
    var filename = $("#passport_chooseFile").val();
    if (/^\s*$/.test(filename)) {
        $(".file-upload").removeClass("active");
        $("#passport_noFile").text("No file chosen...");
    } else {
        $(".file-upload").addClass("active");
        $("#passport_noFile").text(filename.replace("C:\\fakepath\\", ""));
    }
});

/**
 * Id Izn-E-Amal and Actual is Same "Staff/Create"
 *
 */
$("select[name='izn_e_amal']").change(function() {
    $("select[name='actual']")
        .val(this.value)
        .change();
});
$(".dtBox").DateTimePicker({
    mode: "date",
    dateFormat: "dd-MM-yyyy",
    maxDate: "31-12-2035"
});

// $("input.date").dateDropper({
//     largeOnly: true,
//     animate: true,
//     init_animation: "fadein",
//     format: "d-m-Y",
//     theme: "leaf",
//     modal: true
// });