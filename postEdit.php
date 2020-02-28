

<?php
$connect = mysqli_connect("localhost","root","mariam@2468","studentphp");
    if($connect){
        $res=  mysqli_query($connect,"select * from post where id='{$_GET['id']}'");
        if($res){
                $resData=mysqli_fetch_assoc($res);
        }
            }
            else{
                echo "Error in delete";
            }             
                
 ?>

<form method="post" action="postcontroller.php">
<input  type="text" id="new" name="newpost" value="<?php echo $resData['content']?>"/>
<input type="submit" name="edit" value="save"/>
<input type="hidden" name="id" value="<?php echo $resData['id']?>">



</form>