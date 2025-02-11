$(document).ready(function() {
    setTimeout(()=>{
        $('.alert').remove();
    },4000);
    $('#autoGenerate').change(function() {
        let passwordField = $('#passwordField');
        let confirmPasswordField = $('#confirmPasswordField');
        if ($(this).is(':checked')) {
            $('.toggle-password i').removeClass('bi-eye-slash').removeClass('bi-eye').addClass('bi-eye-slash');
            $('#passwordField, #confirmPasswordField').attr('type','text');
            let generatedPassword = Math.random().toString(36).slice(-8);
            passwordField.val(generatedPassword).prop('readonly', true);
            confirmPasswordField.val(generatedPassword).prop('readonly', true);
        } else {
            $('.toggle-password i').removeClass('bi-eye-slash').removeClass('bi-eye').addClass('bi-eye');
            $('#passwordField, #confirmPasswordField').attr('type','password');
            passwordField.val('').prop('readonly', false);
            confirmPasswordField.val('').prop('readonly', false);
        }
    });

    $('.toggle-password').click(function() {
        let target = $($(this).data('target'));
        let type = target.attr('type') === 'password' ? 'text' : 'password';
        target.attr('type', type);
        $(this).find('i').toggleClass('bi-eye bi-eye-slash');
    });
});

/* phone number validate */
$("input[name='phone']").on("input", function () {
    let phone = $(this).val();
    if (!/^\d*$/.test(phone)) {
        $(this).val(phone.replace(/\D/g, ""));
    }
    if (phone.length > 10) {
        $(this).val(phone.substring(0, 10));
    }
});

// Form submission validation
$("form").submit(function (e) {
    let phone = $("input[name='phone']").val();
    if (phone.length < 10) {
        e.preventDefault();
        showFlashMessage("error", "Phone number must be 10 digits.");
    }
});
/* end phone validation */
/* submit selected task script start */

$(document).ready(function() {
    // Select All Checkbox Functionality
    $("#selectAll").click(function() {
        $("input[name='task_ids[]']").prop('checked', this.checked);
    });

    if ($(".task_id_check").length === 0) {
        $("#selectAll").remove();
        $("#submitSelected").remove();
    }

    // Submit Selected Tasks
    $("#submitSelected").click(function() {
        var selectedTasks = $("input[name='task_ids[]']:checked").map(function() {
            return this.value;
        }).get();

        if (selectedTasks.length === 0) {
            showFlashMessage("danger", "Please select at least one task.");
            return;
        }

        $.ajax({
            url: " index.php?route=submit_tasks",
            type: "POST",
            data: { task_ids: selectedTasks },
            success: function(response) {                
                showFlashMessage(response.status, response.message);
                if (response.status === "success") {
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            },
            error: function() {
                showFlashMessage("danger", "An unexpected error occurred.");
            }
        });
    });
});
function showFlashMessage(type, message) {
    let flashHtml = `<div class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>`;
    $("#flashMessageContainer").html(flashHtml);
    setTimeout(() => {
        $(".alert").fadeOut();
    }, 4000);
}
/* submit selected task script end */

