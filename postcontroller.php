<?php
$connect = mysqli_connect("localhost","root","mariam@2468","studentphp");
if($connect){
    echo 'connected DB';

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
            $typeAllaw = array("jpg","jpeg","png","JPG","IPEG","PNG");
            if(in_array($imageType,$typeAllaw)){
            move_uploaded_file($dir_tmp,$imagePath);
        // insert into table_name (col1 , col2) values();
        $result = mysqli_query($connect,"insert into post set
        content = '$content',
        postImage = '$imageName',
        id_user = '$id_user'
        ;");
        if($result){
            header("Location: postlist.php");
        }
    }
    }
}
}
    else if(isset($_POST['edit'])){
    $content = $_POST['newpost'];
    $idpost = $_POST['id'];
    $result= mysqli_query($connect," update post set content = '$content'
    where id = '$idpost'");
     if($result){
         header("Location:postlist.php");
     }
}

else if(isset($_POST['addcomment'])){
    echo "jjj";
    $commentbody = $_POST['newcomment'];
    session_start();
    $id_user = $_SESSION['id'];
    $result = mysqli_query($connect,"insert into comment set
    content = '$commentbody',
    id_user = '$id_user'
    ;");
    if($result){
        echo "done";
        header("Location:postlist.php");
    }
    else {
        echo 'error';
    }


}
}
else{
    echo "error connection DB";
}

?>

