
    function toggleLike(event){
        let postId=event.target.parentElement.parentElement.id;
        let likeBtn=event.target;
        let obj;
        if(likeBtn.classList.contains('active')){
            obj={
                status:"removelike",
                postId:postId
            }
        }else{
            obj={
                status:"addlike",
                postId:postId
            }
        }
        $.ajax({
            type:"POST",
            data:obj,
            url:"otherRes/toggleLike.php",
        }).done(function(result){
            console.log(result);
            if(result=="success"){
                likeBtn.classList.toggle('active');
                likeBtn.classList.toggle('bi-star');
                likeBtn.classList.toggle('bi-star-fill');
            }
            let res=likeBtn.classList.contains('bi-star-fill');
            if(res){
               let val=event.target.parentElement.parentElement.getElementsByClassName('total')[0].innerText;
               event.target.parentElement.parentElement.getElementsByClassName('total')[0].innerText=parseInt(val)+1;
            }
            else{
                let val=event.target.parentElement.parentElement.getElementsByClassName('total')[0].innerText;
                event.target.parentElement.parentElement.getElementsByClassName('total')[0].innerText=parseInt(val)-1;
            }
        }).fail(function() {
            alert("error");
        });
    }
