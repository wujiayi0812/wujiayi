<?php
if ((($_FILES["pic"]["type"] == "image/gif")
  || ($_FILES["pic"]["type"] == "image/jpeg")
  || ($_FILES["pic"]["type"] == "image/pjpeg"))
  && ($_FILES["pic"]["size"] < 800040))
{
  if ($_FILES["pic"]["error"] > 0){
    echo "Return Code: " . $_FILES["pic"]["error"] . "<br />";
  }
  else{
    echo "Upload: " . $_FILES["pic"]["name"] . "<br />";
    echo "Type: " . $_FILES["pic"]["type"] . "<br />";
    echo "Size: " . ($_FILES["pic"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["pic"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["pic"]["name"]))
    {
      echo $_FILES["pic"]["name"] . " already exists. ";
    }
    else
    {
      move_uploaded_file($_FILES["pic"]["tmp_name"],
        "upload/" . $_FILES["pic"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["pic"]["name"];
    }
  }
}
else
{
  echo "无效的文件";
}
?>