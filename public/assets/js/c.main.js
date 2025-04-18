function ajaxRequest(dataurl,postdata,type='POST',isformupload=false)
{
    $('#loader').show();
    let config={
        type: type,
        url: dataurl,
        dataType: 'json',
        data: postdata,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
       
    };
    if(isformupload===true)
    {
        config.processData=false;
        config.contentType=false;
        config.cache=false;
    }
    return $.ajax(config);
    

}

function getRequest(dataurl)
{
    return $.ajax({
        type: 'GET',
        url: dataurl,
        dataType: 'json',
    
    });
}

function showNotification(message,type)
{
    if(type=='error')
    {
        type='danger';
    }
        var duration = '3000';
        var ripple = true;
        var dismissible = true;
        var positionX = 'right';
        var positionY = 'top';
        window.notyf.open({
            type,
            message,
            duration,
            ripple,
            dismissible,
            position: {
                x: positionX,
                y: positionY
            }
        });
}