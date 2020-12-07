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