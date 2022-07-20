   var id = null;

            function loadMsgWindow(event) {
                id = event.target.id;
                let user = event.target.outerHTML;
                let chatWindow = document.getElementById('chatWindow');
                document.getElementsByClassName('msgbox')[0].classList.toggle('d-none');
                chatWindow.classList.toggle('d-none');
                chatWindow.innerHTML =
                    user + `
                    <section></section>
                    <div class="insert w-100 d-flex">
                        <span onclick="Back()" class="bi bi-arrow-left"></span>
                        <input type="text" id="msg" class="flex-fill">
                        <span onclick="submitMsg()" class="bi bi-chevron-double-right"></span>
                    </div>
                </section>`;
            }

            function loadMessages() {
                $.ajax({
                    type: "POST",
                    data: {
                        id: id,
                    },
                    url: "otherRes/loadMessages.php",
                    cache: false,
                }).done(function(result) {
                    if(!(result=="empty")){
                    msg = document.getElementById('chatWindow').getElementsByTagName('section')[0];
                    msg.innerHTML = "";
                    let res = JSON.parse(result);
                    if (Array.isArray(res)) {
                        res.forEach(rec => {
                            msg.innerHTML += ` 
                                <div class="msg bg-primary rounded m-2" role="button">
                                    <div class="sender">` + rec.user_email + `</div>
                                    <div class="msgText h6 m-0">` + rec.msg + `</div>
                                    <div class="msgTime">` + rec.time + `</div>
                                </div>`;
                        });
                    } else {
                        msg.innerHTML += ` 
                        <div class="msg bg-primary rounded m-2">
                            <div class="sender">` + res.user_email + `</div>
                            <div class="msgText h6 m-0">` + res.msg + `</div>
                            <div class="msgTime">` + res.time + `</div>
                        </div>`;
                    }}
                })
            }

            function check() {
                if (id) {
                    loadMessages();
                }
            }

            setInterval(check, 2500);

            function submitMsg() {
                event.preventDefault();
                let userId = event.target.parentElement.parentElement.getElementsByClassName('idHolder')[0].id;
                let msg = document.getElementById('msg').value;
                $.ajax({
                    type: "POST",
                    data: {
                        msg: msg,
                        id: userId,
                    },
                    url: "otherRes/saveMsg.php",
                }).done(function(result) {
                    console.log(result);
                })
            }

            function Back(){
                id=null;
                  document.getElementsByClassName('msgbox')[0].classList.toggle('d-none');
                chatWindow.classList.toggle('d-none');
            }

            function hide() {
                id=null;
                if( (chatWindow.classList.contains="d-none")){
                chatWindow.classList.toggle('d-none',true);
                }
                document.getElementsByClassName('msgbox')[0].classList.toggle('d-none',false);
            }