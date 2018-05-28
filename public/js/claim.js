$(window).on('load', function() {


    var PENDING_STATUS = {
        'AWAITING FEEDBACK' : 'AWAITING FEEDBACK',
        'INVOICE' : 'INVOICE',
        'ORDER' : 'ORDER',
        'PARTS' : 'PARTS',
    };

    var COMPLETED_STATUS = {
        'PAID' : 'PAID',
        'UNPAID' : 'UNPAID',
        'TELEPHONE SUPPORT' : 'TELEPHONE SUPPORT'
    };

    var claim_status_attr = $("#claim_status").attr('data-value');
    if(claim_status_attr != '') {
        claim_status_attr = claim_status_attr.split('-');
        $("#claim_status").attr('data-value',claim_status_attr[0]);
        $("#claim_status").val(claim_status_attr[0]);

        var claim_state = $("#claim_state");
        $("#claim_state").empty();

        if(claim_status_attr[0] == 'PENDING') {
            $.each(PENDING_STATUS, function (val, text) {
                claim_state.append(
                    $('<option></option>').val(val).html(text)
                );
            });
        }else {
            $.each(COMPLETED_STATUS, function (val, text) {
                claim_state.append(
                    $('<option></option>').val(val).html(text)
                );
            });
        }

        $("#claim_state").val(claim_status_attr[1]);
    }

    var engineer_required = $("#engineer_required").val();
    if(engineer_required == 'Yes') {
        $("#form-group-engineer_id").css('display','block');
    }else {
        $("#form-group-engineer_id").css('display','none');
    }

    $("#job_type").change(function () {

        var item=$(this);
        if(item.val() == "Recall") {

            var policy_id = $("input[name=policy_id]").val();
            if(policy_id == "") {
                alert("Please select policy number");
                $("#job_type").val('');
            }else {
                $("#form-group-claim_id").css('display', 'block');
            }
        }else {
            $("#form-group-claim_id").css('display','none');
        }
    });

    $("#engineer_required").change(function() {

        var item = $(this);
        if(item.val() == 'Yes') {
            $("#form-group-engineer_id").css('display','block');
        }else {
            $("#form-group-engineer_id").css('display','none');
        }
    });


    $("#claim_status").change(function () {
        var claim_state = $("#claim_state");
        $("#claim_state").empty();
        if($(this).val() == 'PENDING') {
            $.each(PENDING_STATUS, function (val, text) {
                claim_state.append(
                    $('<option></option>').val(val).html(text)
                );
            });
        }else {
            $.each(COMPLETED_STATUS, function (val, text) {
                claim_state.append(
                    $('<option></option>').val(val).html(text)
                );
            });
        }
    });

});