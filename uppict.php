<?php
$file = $_FILES['myfile']; 
if ((($file["type"] == "image/gif")||($file["type"] == "image/png")|| ($file["type"] == "image/jpeg")|| ($file["file"]["type"] == "image/pjpeg"))&& ($file["size"] < 200000))
	{    
$fileName = uploadFile($file); 
$fileName='http://'.$_SERVER['HTTP_HOST'].'/upload/'.$_SESSION['token'].'/'.$fileName;
	
 $text=$_POST['kjname']; 
  echo "<script type='text/javascript'>window.parent.stopUpload('{$fileName}','{$text}')</script>"; 
//$result = readFromFile("../upload/" . $fileName);    
} 
else
{echo "<script type='text/javascript'>alert('上传文件类型错误，或者文件大小超过200k')</script>"; 
	}
    
function uploadFile($file) {    
    // 上传路径 
    session_start();   
    $destinationPath = "upload/".$_SESSION['token']."/";    
    if (!file_exists($destinationPath)){    
        mkdir($destinationPath , 0777);    
    }    
    //重命名    
    $fileName =$_SESSION['token']. '_'.date('YmdHis').'_.' . iconv('utf-8' , 'gb2312' , pathinfo($file['name'], PATHINFO_EXTENSION));    
    if (move_uploaded_file($file['tmp_name'], $destinationPath . $fileName)) {    
        return iconv('gb2312' , 'utf-8' , $fileName);    
    } 
      
    return '';  
}
?>
