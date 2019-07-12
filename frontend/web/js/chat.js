/**
 * @param var oldComments
 * */

var websocketPort = wsPort ? wsPort : 8080,
    conn = new WebSocket('ws://localhost:' + websocketPort + '?id_task=' + taskId),
    idMessages = 'oldMessage';
// +var webSocket = new WebSocket("ws://front.task.local:8080?channel=" + channel);

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
        //document.getElementById("chat_form")
           // .addEventListener("submit", function (event) {
            //   event.preventDefault();
              //  var data = {
                //    message : this.message.value,
               //     user_id : this.user_id.value,
                //    channel : this.channel.value
               // };

              //  webSocket.send(JSON.stringify(data));
             //   return false;
        $(text).val("");
        $(document.getElementById('myForm')).addClass('hidden');
        $(document.getElementById('newMessage')).removeClass('hidden');
};