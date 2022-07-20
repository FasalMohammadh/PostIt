    <?php


    include "connection.php";

    if(!isset($_SESSION)){
    	session_start();
    }
    	 $logedEmail=$_SESSION['email'];

   

        if (!empty($_POST["submitPost"])) {
            $postText=$_POST['postText'];

            $path="PostImages/".$_FILES["postImg"]["name"];

            move_uploaded_file($_FILES["postImg"]["tmp_name"], $path);

            $query="INSERT INTO Posts (user_email, post_text, post_img_path, posted_time) VALUES ('$logedEmail',  '$postText', 'otherRes/$path', '".date('Y-m-d H:i:s')."')";

            if (!$con -> query($query)) {
                echo("Error description: " . $con -> error);
            }
            header("Location:http://localhost/WebGrp/Home.php");
        }
     ?>
  <div class="postbox col-6 col-md-3 border bg-white">
            <section class="post">
                <div>
                    <span class="topic">Create Post</span>
                </div>
                <form action="otherRes/postBox.php" method="post" enctype="multipart/form-data">
                    <div class="content">
                        <?php
                    $query="SELECT fullname,profile_pic_path FROM Users WHERE email='$logedEmail'";
                    $res=mysqli_query($con, $query);
                    $rec=mysqli_fetch_array($res);
              echo '<img src="'.$rec[1].'" class="rounded-circle" alt="logo" width="100">
                <span>'.ucfirst($rec[0]);
                ?>
                        </span>
                    </div>
                    <textarea placeholder="What's on your mind?" spellcheck="false" required name="postText"></textarea>
                    <div class="options rounded">
                        <span class="m-2">Add to Your Post</span>
                        <label class="bi bi-image-fill rounded-circle " for="Attach">
                            <input type="file" hidden id="Attach" name="postImg">
                        </label>
                    </div>
                    <input class="btn btn-primary btn-sm" type="submit" value="Post" name="submitPost" />
                </form>
            </section>
    </div>
    <div class="actionBtn " onclick="popup()">
        <div class="bi bi-plus-circle-fill"></div>
    </div>


<script>
	function popup() {
	let postbox=document.getElementsByClassName("postbox")[0];
  let icon=document.getElementsByClassName("actionBtn")[0].getElementsByClassName('bi bi-plus-circle-fill')[0];
  if(icon.style.transform=="rotate(45deg)"){
       icon.style.transform="";
  }else{
    icon.style.transform="rotate(45deg)";
  }
  
  postbox.classList.toggle('postboxActive');
}
</script>
<style>
	  .postbox{
      border-radius: 10px;
      z-index: 2;
      position: fixed;
      right:-500px;
      bottom: 100px;
      transition: all 0.25s ease-in-out;
      opacity: 0;
    }
  .postboxActive
  {
    right: 30px;
    opacity: 1;
  }    .post>div{
      position: relative;
      text-align: center;
      border-bottom: 1px solid #bfbfbf;
    }
    .content img{
      margin-left: 10px;
      margin-top: 10px;
      width: 50px;
      height: 50px;
      object-fit: cover;
    }
    .bi-plus-circle-fill{
       transition: all 0.25s ease-in-out;
       font-size:50px;
       color: white;
    }
    .actionBtn{
      position: fixed;
      bottom: 20px;
      right: 20px;
      text-align: center;
      z-index: 2;
    }
    textarea{
      border: none;
      font-size: 16px;
      resize: none;
       width: calc(100% - 20px);
     margin: 10px;
    }
    textarea:focus{
      outline: none;
    }
    textarea::placeholder{
      font-size: 16px;
      color: #858585;
    }
    .bi-image-fill{
      cursor: pointer;
      padding: 0 10px;
      float: right;
    }
    .options{
      font-size: 16px;
      border: 1px solid #bfbfbf;
      margin: 10px;
      line-height: 40px;
      vertical-align: baseline;
    }
    .postbox .btn{
      width: calc(100% - 20px);
      margin: 10px;
      margin-top: 0;
    }


</style>