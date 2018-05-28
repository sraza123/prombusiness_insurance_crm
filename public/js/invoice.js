$(window).on('load', function() {

    var contractor_attr = $("#contractor").attr('data-value');
    if(contractor_attr == 'Independent') {
        $("#form-group-independent").css('display','block');
        $("#form-group-engineer_id").css('display','none');
    }else {
        $("#form-group-independent").css('display','none');
        $("#form-group-engineer_id").css('display','block');
    }

    $("#contractor").change(function () {

        if($(this).val() == 'Independent') {
            $("#form-group-independent").css('display','block');
            $("#form-group-engineer_id").css('display','none');
        }else {
            $("#form-group-independent").css('display','none');
            $("#form-group-engineer_id").css('display','block');
        }
    });

});