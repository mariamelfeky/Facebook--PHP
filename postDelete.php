
<?php
$connect = mysqli_connect("localhost","root","mariam@2468","studentphp");
    if($connect){
        $res=  mysqli_query($connect,"delete from post where id='{$_GET['id']}'");
        if($res){
            header("Location:postlist.php");
        }
            }
            else{
                echo "Error in delete";
            }             
                
 ?>