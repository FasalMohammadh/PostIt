 <?php
    function loadPosts($email,$type){
          require 'connection.php';
          if($type=="Mine"){
            $query="SELECT post_text,post_img_path,fullname,profile_pic_path,post_id,posted_time  FROM Posts JOIN Users ON Users.email=Posts.user_email WHERE user_email='$email' ORDER BY posted_time DESC";
        }else{
            $query="SELECT post_text,post_img_path,fullname,profile_pic_path,post_id,posted_time  FROM Posts  JOIN Users ON email=user_email WHERE user_email IN(SELECT user_email2 FROM Users_friends WHERE user_email='$email') ORDER BY posted_time DESC";
        }
        

        $res=mysqli_query($con, $query);
   if(mysqli_num_rows($res)>0){
        while ($rec=mysqli_fetch_array($res)) {   

        echo '<div class="singlePost" id="'.$rec[4].'">
    <div class="card-body p-0">
        <div class="singlePerson d-flex flex-coloumn p-2">
        <img src="'.$rec[3].'" class="rounded-circle border border-primary mt-2 me-2" width="60px" height="60px">
        <span>
            <span class="card-title">'.$rec[2].'</span>
            <div class="time">Posted on '.$rec[5].'</div>
        </span>
           
        </div>
        <p class="card-text rounded p-2">'.$rec[0].'</p>
    </div>
    <img src="'.$rec[1].'" class="card-img-top" >
         <div class="box d-flex">
                        <span onclick="toggleLike(event)" class="btnStar' ;
            $query="SELECT * FROM Posts_users_like WHERE user_email='".$_SESSION["email"]."' AND post_id='$rec[4]'";
            $resnew=mysqli_query($con, $query);
            if ($recnew=mysqli_fetch_array($resnew)) {
                echo ' active bi bi-star-fill" >';
            } else {
                echo ' bi bi-star">';
            }
            $query="SELECT COUNT(*) FROM Posts_users_like WHERE post_id='$rec[4]'";
            $resLikeCount=mysqli_query($con, $query);
            $recLikeCount=mysqli_fetch_array($resLikeCount);

            echo ' Star</span> 
                        <span class=" text-center">Total <span class="bi bi-star total"> '.$recLikeCount[0].'</span></span> 
                    </div>
                    </div>
            ';
    }

    }else{
    echo "No Post Found";
}
}
?> 
<style type="text/css">
    
    .card-img-top{
  object-fit: contain;
  /*max-height: 250px;*/
  /*width: auto;*/
}
.card {
  color: black;
    /*backdrop-filter: blur(16px) saturate(180%);*/
    /*background-color: rgba(32, 34, 37, 0.75);*/
    border-radius: 12px;
    border: 1px solid #bfbfbf;

}
.time{
  font-size: 16px;
  padding: 0;
  margin-top: -10px;
  color: grey;
}
.singlePost{
   border: 1px solid #bfbfbf;
     border-radius: 12px;
     overflow: hidden;
     margin: 10px;
     box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}
.card-title{
   font-size: 30px;
  font-weight: bold;
}
.singlePerson{
    border-bottom: 1px solid #bfbfbf;
  }
    .box > span{
  width: 50%;
  display: inline-block;
  text-align: center;
  background-color: black;
  cursor: pointer;
  color: white;
}
</style>
    <script type="text/javascript" src="js/toggleLike.js"></script>