/**
 * @param var oldComments
 * */

var websocketPort = wsPort ? wsPort : 8080,
    conn = new WebSocket('ws://192.168.83.137:' + websocketPort + '?id_task=' + taskId),
    idMessages = 'oldMessage';

var oldParent = document.getElementById('oldMessage');

if(oldComments.length <= 2) {
    console.log('no comments in database');
} else {
    var arrayOldComments = $.parseJSON(oldComments);
    for(var i in arrayOldComments) {

        let name = arrayOldComments[i].username;
        let text = arrayOldComments[i].text;

        var div = document.createElement('DIV');
        $(div).addClass('forumMessage');
        div = oldParent.appendChild(div);
        div.innerHTML = name + ' : ' + text + '\n' ;
    }
}

conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.onmessage = function(e) {
    //console.log(e.data);

    var parent = document.getElementById('oldMessage');
    var div = document.createElement('DIV');
    $(div).addClass('forumMessage');
    div = parent.appendChild(div);
    var message = $.parseJSON(e.data);

    div.innerHTML = message.username + ' : ' + message.text + '\n' ;
};

document.getElementById('newMessage').onclick =
    function() {
        $(document.getElementById('myForm')).removeClass('hidden');
        $(document.getElementById('newMessage')).addClass('hidden');
    };

document.getElementById('addMessage').onclick =
    function(e) {
        e.preventDefault();

        if(userId) {
            let text = $(document.getElementById('text'));
            var data = {
                "text" : $(text).val(),
                "user_id" : userId
            };
            conn.send(JSON.stringify(data));
        } else {
            alert ('Зарегистрируйтесь для отправки сообщений в чате!');
        }
        $(text).val("");
        $(document.getElementById('myForm')).addClass('hidden');
        $(document.getElementById('newMessage')).removeClass('hidden');
};