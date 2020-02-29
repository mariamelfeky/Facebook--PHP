<?php 
    $connect = mysqli_connect("localhost","root","mariam@2468","studentphp");
if($connect){
    echo 'connected DB';
if(isset($_POST['login'])){
    $result=  mysqli_query($connect,"select * from user where email='{$_POST['email']}' and password='{$_POST['password']}'");
    if($result){
       $resData=mysqli_fetch_assoc($result);
       $_SESSION['imgProfile'] = "../view/upload/".$row['image'];
       session_start();
      $_SESSION['name']=$resData['name'];
      $_SESSION['id']=$resData['id'];
      $_SESSION['imgProfile'] =$resData['image'];
      header("Location: ../postlist.php");
    }
    else {
        echo 'error';
    }

}

elseif(isset($_POST['register'])){
    $name = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $dir_to_upload = "../view/upload/";
    $dir_tmp = $_FILES['image']['tmp_name'];
    if(!empty($_FILES['image']['name'])){
        echo 'mmm';
        $imageName = basename($_FILES['image']['name']);
        $imagePath =  $dir_to_upload.$imageName;
        $imageType = pathinfo($imagePath,PATHINFO_EXTENSION);
        $typeAllaw = array("jpg","jpeg","png");
        if(in_array($imageType,$typeAllaw)){
            echo'nn';
            if(move_uploaded_file($dir_tmp,$imagePath)){
                echo 'ff';
                $result=  mysqli_query($connect,"insert into user set
                   name = '$name',
                   email = '$email',
                   password = '$password',
                   image = '$imageName' 
        ");
    if($result){
       header("Location:../postlist.php");
    }
    else {
       // header("location : ../view/bootstrap/login/register.php");
       //echo "error";
    }
            }
        }
    }
}

}
else {
    echo 'error connection DB';
}

?>