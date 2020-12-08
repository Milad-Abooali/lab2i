$( document ).ready(function() {

    //  Login
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