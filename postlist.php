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
                $imgProfile = $_SESSION['imgProfile']
               if(isset($_SESSION['name'])){
                echo "Welcome"." ".$_SESSION['name'];
                echo "<img src='$imgProfile' style = 'border-radius: 50%; width:100px; height:100px; '/>";
                }else{
               // header("Location:loginPage.html");
                }
                ?>
                
        </tr>     
           <form method="POST" action="postcontroller.php" enctype ="multipart/form-data">
            <tr class="group">
               <td colspan="3"><input  type="text" id="new" name="newpost"  placeholder="What is in your mind?" /></td>
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
                $result=mysqli_query($connect,"select * from post");
                session_start();

                while($row=mysqli_fetch_assoc($result))
    {           $postimage = "view/upload/".$row['postImage'];
        echo
         "<tr > 
        <td class='newpost'>{$row['content']}</td>
     
        if($_SESSION['name']==$row['name']){
        <td><a href='postDelete.php?id={$row['id']}'>Delete</a></td>
        <td><a href='postEdit.php?id={$row['id']}'>Edit</a></td>
        }
       </tr>
       <tr> <img style='width:100px; height:100px;' src ='$postimage' />
       </tr>
       <tr>
            <td><input type='text' id='newcomment' name='newcomment' placeholder='write your comment'/></td>
            if($_SESSION['name']==$row['name']){
           <td><a href='commentDelete.php?id={$row['id']}'>Delete</a></td>
           <td><a href='commentEdit.php?id={$row['id']}'>Edit</a></td>
            }
         </tr>";
    }
           
        }
            else{
                echo "error connection DB";
            }
            
            ?>
          
            <tr>
                <td colspan="3">
               <pre id="post">
                  content
               </pre>
                </td>

            </tr>

        </table>
           

        <body>

<html>
