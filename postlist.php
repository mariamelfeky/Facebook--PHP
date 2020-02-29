<!DOCTYPE html>

<html>
    <head>
        <style>
            header{
                background-color:rgb(97, 97, 243);
                margin:10px auto;
                text-align: center;
                width:80%;
                padding:10px;
                font-size:50px;
                color: white;
                
            }
            #post{
                background-color:lightsteelblue;
                margin:10px auto;
                text-align:center;

            }
            #new{
                margin:10px auto;
                width:100%;
                height:50px;
                text-align:center;
                border: 2px solid lightsteelblue;

            }
            .newpost{
                margin:10px auto;
                width:600px;
                height:50px;
                text-align:left;
                border: 2px solid lightsteelblue;

            }
            #newcomment{
                margin:10px auto;
                width:400px;
                height:30px;
                

            }

            </style>
    <head>
     
        
       <body>
           <header>FaceBook</header>
           <table style="text-align:center; margin:5px auto; border:2px solid; width:60%;">
           <tr>
               
               <?php 
                session_start();
                $name = $_SESSION['name'];
                $imgProfile = $_SESSION['imgProfile'];
                $imgPath = "view/upload/".$imgProfile;
               if(isset($_SESSION['name'])){
                echo "<h2>Welcome $name</h2>";
                echo "<img src='$imgPath' style = 'border-radius: 50%; width:100px; height:100px; '/>";
                }else{
                header("Location: view/bootstrap/login/login.html");
                }
                ?>
                
        </tr>     
           <form method="POST" action="postcontroller.php" enctype ="multipart/form-data">
            <tr class="group">
               <td colspan="4"><input  type="text" id="new" name="newpost"  placeholder="What is in your mind?" /></td>
            </tr>
            <tr class="group" >
                <td>
            <input type="file" name="image" /> 
             <br/>
            </td>
          </tr>
            <tr>
                <td><input type="submit" name="add" value="publish"/></td>
            </tr>
        </form>
            <?php
           
            $errorArray=[];
            $connect = mysqli_connect("localhost","root","mariam@2468","studentphp");
            if($connect){
                //echo "connected DB";
                $result=mysqli_query($connect,"select * from post inner join user as u  
                where id_user = u.id;");

                while($row=mysqli_fetch_assoc($result)){
             $postimage = "view/upload/".$row['postImage'];
                $imgPost = $row['postImage'];
                $userid = $row['id'];
                $id =$_SESSION['id'];
               // echo $userid;
               // echo $_SESSION['id'];
        echo
         "<tr>
         <td style='text-align = left'>
         <h3>{$row['name']}</h3> 
         </td>
         </tr>
         <tr > 
        <td class='newpost'>{$row['content']}</td>";
        if($userid==$id){
            echo"
        <td><a href='postDelete.php?id={$row['id']}'>Delete</a></td>
        <td><a href='postEdit.php?id={$row['id']}'>Edit</a></td>";
        }
    
        echo "
       </tr>";
       if($imgPost!==null){
           echo"
       <tr><td> <img style='width:500px; height:400px;' src ='$postimage' />
       <td>
       </tr>";
       }
       
       $comment = mysqli_query($connect,"select c.id,c.content,u.`name` from comment as c 
       inner join user as u on id_user=u.id 
       inner join post as p on id_post = p.id;");
       while($comm = mysqli_fetch_assoc($comment)){
           if($userid == $comm['id']){
            echo"
            <tr>
            <td>{$comm['name']}</td>
            <td>
            <p>{$comm['content']}</p>
       </td></tr>";
           }
        }
       ?>
       <tr>  
       <form method='POST' action='postcontroller.php'>
            <td><input type='text' id='newcomment' name='newcomment' placeholder='write your comment'/></td>
            <td><input type='submit' name='addcomment' value='add'/></td>
            </from>
           
<?php
            if($userid==$id){
                echo"
           <td><a href='commentdelete.php?id={$row['id']}'>Delete</a></td>
           <td><a href='commentedit.php?id={$row['id']}'>Edit</a></td>";
           
            }
            ?>
        <?php
            echo" 
         </tr>";
        }}
        ?>  
        <?php
        // else{
        //         echo "error connection DB";
        //     }
            
            ?>
          
          
            <tr>
                <td colspan="4">
               <pre id="post">
                  content
               </pre>
                </td>

            </tr>

        </table>

        </body>

</html>