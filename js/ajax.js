$(document).ready(function () {

    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var is_ajax_fire = 0;

    manageData();

    /* manage data list */
    function manageData() {
        $.ajax({
            dataType: 'json',
            url: 'api/getData.php',
            data: { page: page }
        }).done(function (data) {
            total_page = Math.ceil(data.total / 10);
            current_page = page;

            $('#pagination').twbsPagination({
                totalPages: total_page,
                visiblePages: current_page,
                onPageClick: function (event, pageL) {
                    page = pageL;
                    if (is_ajax_fire != 0) {
                        getPageData();
                    }
                }
            });

            manageRow(data.data);
            is_ajax_fire = 1;

        });

    }

    /* Get Page Data*/
    function getPageData() {
        $.ajax({
            dataType: 'json',
            url: 'api/getData.php',
            data: { page: page }
        }).done(function (data) {
            manageRow(data.data);
        });
    }

    /* Add new Item table row */
    function manageRow(data) {
        var rows = '';
        $.each(data, function (key, value) {
            rows = rows + '<tr>';
            rows = rows + '<td>' + value.id + '</td>';
            rows = rows + '<td>' + value.firstname + '</td>';
            rows = rows + '<td>' + value.lastname + '</td>';
            rows = rows + '<td>' + value.email + '</td>';
            rows = rows + '<td data-id="' + value.id + '">';
            rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
            rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
            rows = rows + '</td>';
            rows = rows + '</tr>';
        });

        $("tbody").html(rows);
    }

    /* Create new Item */
    $("body").on("click", ".crud-submit", function (e) {
        e.preventDefault();
        var form_action = $("#create-modal").find("form").attr("action");
        var firstname = $("#create-modal").find("input[name='firstname']").val();
        var lastname = $("#create-modal").find("input[name='lastname']").val();
        var email = $("#create-modal").find("input[name='email']").val();


        if (firstname != '' && lastname != '' && email != '') {
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: form_action,
                data: { firstname: firstname, lastname: lastname, email: email }
            }).done(function (data) {
                $("#create-modal").find("input[name='firstname']").val('');
                $("#create-modal").find("input[name='lastname']").val('');
                $("#create-modal").find("input[name='email']").val('');
                getPageData();
                $(".modal").modal('hide');
                toastr.success('Employee added successfully.', 'Success Alert', { timeOut: 5000 });
            });
        } else {
            alert('Please fill all required field.')
        }
    });

    /* Remove Item */
    $("body").on("click", ".remove-item", function () {
        var id = $(this).parent("td").data('id');
        var c_obj = $(this).parents("tr");

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: 'api/delete.php',
            data: { id: id }
        }).done(function (data) {
            c_obj.remove();
            toastr.success('Employee Deleted Successfully.', 'Success Alert', { timeOut: 5000 });
            getPageData();
        });

    });

    /* Edit Item */
    $("body").on("click", ".edit-item", function () {

        var id = $(this).parent("td").data('id');
        var firstname = $(this).parent("td").prev("td").prev("td").prev("td").text();
        var lastname = $(this).parent("td").prev("td").prev("td").text();
        var email = $(this).parent("td").prev("td").text();

        $("#edit-item").find("input[name='firstname']").val(firstname);
        $("#edit-item").find("input[name='lastname']").val(lastname);
        $("#edit-item").find("input[name='email']").val(email);
        $("#edit-item").find(".edit-id").val(id);

    });

    /* Updated new Item */
    $(".crud-submit-edit").click(function (e) {

        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");
        var firstname = $("#edit-item").find("input[name='firstname']").val();
        var lastname = $("#edit-item").find("input[name='lastname']").val();
        var email = $("#edit-item").find("input[name='email']").val();
        var id = $("#edit-item").find(".edit-id").val();

        if (firstname != '' && lastname != '' && email != '') {
            $.ajax({
                dataType: 'json',
                type: 'POST',
                url: form_action,
                data: { firstname: firstname, lastname: lastname, email: email, id: id }
            }).done(function (data) {
                getPageData();
                $(".modal").modal('hide');
                toastr.success('Employee data Updated Successfully.', 'Success Alert', { timeOut: 5000 });
            });
        } else {
            alert('Please fill all required field.')
        }

    });
});