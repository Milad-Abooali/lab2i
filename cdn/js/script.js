$( document ).ready(function() {

    //  Update tag
    $('body').on('click','.doP-edit', function(event){
        let tagId = $(this).data('id');
        $('input.tag').prop('disabled', true);
        $('input#tag-'+tagId).prop('disabled', false);
        $('.doP-edit').text('Edit').removeClass('doA-update btn-success').addClass('btn-primary');
        $(this).text('Update').blur().removeClass('btn-primary').addClass('doA-update btn-success');
    });

    //  Add new tag
    $('body').on('submit','form#login', function(event){
        event.preventDefault();
        const id = $(this).attr('id');
        const reload = $(this).data('reload');
        const data = $(this).serialize();
        const classA = $(this).attr('action');
        ajaxCall (classA, data,function(response) {
            let obj = JSON.parse(response);
            (obj.res) || notify('Email or Password is not true!','error',false);
            (obj.res) || $(location).attr('href', 'login&error=1')
            (obj.res) && notify('Welcome back ....','success',false);
            (obj.res) && location.reload();
        });
    });

});

/* Pass URLs - Core */
var appURL = $("meta[name=app-url]").attr('content');
var appToken = $("#app-body").data('token');
var appCDN = $("meta[name=app-cdn]").attr('content');
var appIMG = $("meta[name=app-img]").attr('content');
var appJS = $("meta[name=app-js]").attr('content');

// Modal Maker - Core
function makeModal(title,body,size='md',footer=null,dissClose=false) {
    $("#modalMain .modal-dialog").removeClass().addClass('modal-dialog modal-'+size);
    $("#modalMain .modal-title").html('').html(title);
    $("#modalMain .modal-body").html('').html(body);
    $("#modalMain .modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>');
    if (footer) $("#modalMain .modal-footer").html(footer);
    if (dissClose) {
        $("#modalMain").data('keyboard',false).data('backdrop','static')
        $("#modalMain .close").hide();
    } else {
        $("#modalMain").data('keyboard',true).data('backdrop',true);
        $("#modalMain .show").hide();
    }
    $("#modalMain").modal('show');
}

// Ajax Call- Core
function ajaxCall (classAction, data, callback) {
    $.ajax({
        type: "POST",
        url: appURL+"ajax/"+classAction+'&token='+appToken,
        data: data,
        cache: false,
        global: false,
        async: true,
        success: callback,
        error: function(request, status, error) {
            console.log(status);
        }
    });
    afterAjax();
}

// Tooltip Bootstrap
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

// Ajax logs reload - Core
function afterAjax () {
 return true;
}

// Notify Load - Core
function notify (text, type='info', close=true,sticky=false) {
    return Message.add(text,{
        vertical:'bottom',
        horizontal:'right',
        type:type,
        sticky:sticky,
        close:close
    });
}

//  Logout
$('body').on('click','.doA-logout', function(){
    const classA = 'user/logout';
    ajaxCall (classA, null,function(response) {
        let obj = JSON.parse(response);
        console.log(obj);
        (obj.e) || location.reload();
    });
});