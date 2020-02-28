<html>
<head>
<style>

#form{
    margin:10px auto;

}
</style>
</head>
<body>
<table>
<form id="form" action="postcontroller.php" method="POST">
<tr>
<th colspan="3"><input type="text" name="owner" placeholder="owner of post"/></th></tr>
</tr>
<tr>
<th colspan="3"><input type="text" name="newpost" placeholder="What is in your mind?"/></th></tr>
<tr>
<th colspan="3"><input type="text" name="newcomment" placeholder="write your comment"/></th></tr>
<tr>
<th><input type="submit" name="add" value="post" /></th>
<th><input type="submit" name="edit" value="edit" /></th>
<th><input type="submit" name="delete" value="delete" /></th>
</tr>

</form>
</table>
</body>

</html>