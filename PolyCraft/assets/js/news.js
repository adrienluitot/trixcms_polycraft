$('.add-like').on('click', function () {
    let commentId = $(this).attr('data-id');
    let button = $(this);

    fetch("/news/add/likes/" + commentId, {
        method: 'post',
        credentials: "same-origin",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    }).then(function() {
        let xhr_object = null;
        if(window.XMLHttpRequest) { // Firefox
            xhr_object = new XMLHttpRequest();
        } else if(window.ActiveXObject) { // Internet Explorer
            xhr_object = new ActiveXObject('Microsoft.XMLHTTP');
        }

        let filename = '/news/add/refresh/likes/' + commentId;
        xhr_object.open("POST", filename, true);
        xhr_object.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr_object.onreadystatechange = function() {
            if(xhr_object.readyState == 4) {
                console.log(xhr_object.responseText);
                $(button).find('span').text(xhr_object.responseText);
            }
        }
        xhr_object.send(null);
    });    
});