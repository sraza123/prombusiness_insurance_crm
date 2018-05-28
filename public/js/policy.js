$(function() {
    /*$('#payment_plan_id').change(function() {
        var item=$(this);
        if(item.val() && $('#start_date').val() != '') {
            var start_date = $('#start_date').datepicker('getDate');
            var value = item.val().split('_');
            var days = parseInt(value[1]);

            start_date.setDate(start_date.getDate() + days);

            var y = start_date.getFullYear();
            var m = start_date.getMonth()+1;
            if(m >=1 || m < 10) {
                m = "0"+m;
            }

            var d = start_date.getDate();
            if(d >=1 || d < 10) {
                d = "0"+d;
            }

            var renweal_date = y+'-'+m+'-'+d;
            $('#renewal_date').val(renweal_date);

            var renewalInvitationDate = new Date(renweal_date);;
            renewalInvitationDate.setDate(renewalInvitationDate.getDate() - 28);
            debugger;
            $("#renewal_invitation_date").val(renewalInvitationDate.getFullYear() + '-' + renewalInvitationDate.getMonth()+1 + '-' + renewalInvitationDate.getDate());
        }
    });*/
});