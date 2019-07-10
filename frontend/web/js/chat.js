var websocketPort = wsPort ? wsPort : 8080,
    conn = new WebSocket('ws://localhost:' + websocketPort),
    idMessages = 'oldMessage';

conn.onopen = function(e) {
    console.log("Connection established!");

    var oldParent = document.getElementById('oldMessage');

    if(oldComments.length <= 2) {
        console.log('no comments in database');
    } else {
        oldComments = $.parseJSON(oldComments);
        for(var i in oldComments) {

            let name = oldComments[i].username;
            let text = oldComments[i].text;

            var div = document.createElement('DIV');
            $(div).addClass('forumMessage');
            div = oldParent.appendChild(div);
            div.innerHTML = name + ' : ' + text + '\n' ;
        }
    }

};

conn.onmessage = function(e) {
    console.log(e.data);

    var parent = document.getElementById(idMessages);
    var div = document.createElement('DIV');
    $(div).addClass('forumMessage');
    div = parent.appendChild(div);
    div.innerHTML = e.data + '\n' ;
};

document.getElementById('newMessage').onclick =
    function() {
        $(document.getElementById('myForm')).removeClass('hidden');
        $(document.getElementById('newMessage')).addClass('hidden');
    };

document.getElementById('addMessage').onclick =
    function(e) {
        e.preventDefault();
        let name = $(document.getElementById('author'));
        let text = $(document.getElementById('text'));

        conn.send($(name).val() + ' : ' + $(text).val());

        $(name).val("");
        $(text).val("");


        $(document.getElementById('myForm')).addClass('hidden');
        $(document.getElementById('newMessage')).removeClass('hidden');
};