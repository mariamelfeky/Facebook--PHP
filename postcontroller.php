<?php
$connect = mysqli_connect("localhost","root","mariam@2468","studentphp");
if($connect){
    echo 'connected DB';
if(isset($_POST['login'])){
    $result=  mysqli_query($connect,"select * from user where email='{$_POST['email']}'and password='{$_POST['password']}'");
    if($result){
       $resData=mysqli_fetch_assoc($result);
       session_start();
      $_SESSION['name']=$resData['name'];
      $_SESSION['id']=$resData['id'];

      header("Location:postlist.php");
    }
    else {
        echo 'error';
        
    }

}



if(isset($_POST['add'])){
    if(!isset($_POST['add']) || empty($_POST['add'])){

        $errorArray[]="newpost";
    }
    // if(count($errorArray)>0){
    //     header("Location:postadd.php?error=".implode(",",$errorArray));
    // }
    else{
        session_start();
        $content = $_POST['newpost'];
        $id_user = $_SESSION['id'];
        $dir_to_upload = "view/upload/";
        $dir_tmp = $_FILES['image']['tmp_name'];
        if(!empty($_FILES['image']['name'])){
            $imageName = basename($_FILES['image']['name']);
            $imagePath =  $dir_to_upload.$imageName;
            $imageType = pathinfo($imagePath,PATHINFO_EXTENSION);
            $typeAllaw = array("jpg","jpeg","png");
            if(in_array($imageType,$typeAllaw)){
            if(move_uploaded_file($dir_tmp,$imagePath)){
        # insert into table_name (col1 , col2) values();
        $result = mysqli_query($connect,"insert into post set
        content = '$content',
        id_user = '$id_user',
        postImage = '$imageName'
        ");
        if($result){
            header("Location:postlist.php");
        }
    }
}

    }  

}
}
// $errorArray=[];

// if(isset($_POST['add'])){
// if($connect){
//     echo "connected DB";
//     if(!isset($_POST['newpost']) || empty($_POST['newpost'])){

//         $errorArray[]="newpost";
//     }
//     if(count($errorArray)>0){
//         header("Location:postadd.php?error=".implode(",",$errorArray));
//     }
//     else{
//         // $owner = $_POST['owner'];
//         $content = $_POST['newpost'];
//         // $comment = $_POST['newcomment'];
//         $result = mysqli_query($connect,"insert into post set
//         content = '$content',
//         ");
//         echo "inserted";
//     }



// }


    else if(isset($_POST['edit'])){
    $content = $_POST['newpost'];
    $idpost = $_POST['id'];
    $result= mysqli_query($connect," update post set content = '$content'
    where id = '$idpost'");
     if($result){
         header("Location:postlist.php");
     }
}
}
else{
    echo "error connection DB";
}



?>

