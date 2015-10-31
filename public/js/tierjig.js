

function successCallback(responseData, var2, var3) {
    location.reload(true);
}

function errorCallback() {
    alert("Failed to update setting.");
}

function processOnChange(var1, var2, var3) {
    var value = $(this).val();
    var params = {};

    params.colorScheme = 'value';

    $.ajax({
        url: "/userSetting",
        cache: false,
        method: 'POST',
        data: params,
        error: errorCallback,
        success: successCallback
    });
}

function initColorSelector(selector) {
    $(selector).change(processOnChange);
}