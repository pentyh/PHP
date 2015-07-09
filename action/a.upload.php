<?PHP 

  //error_reporting(E_ALL);
  
  header("content=text/html; charset=utf-8");
  
  $uf = $_FILES['fileToUpload'];
  
  if(!$uf){
    echo "no fileToUpload index";
    exit();
  }
  
  $upload_file_temp = $uf['tmp_name'];  
  $upload_file_name = $uf['name'];  
  $upload_file_size = $uf['size'];
  
  if(!$upload_file_temp){
    echo "업로드 실패";
    exit();
  }
  
  $file_size_max = 30*1024*1024;// 30M로 제한(bytes)  
  // 파일크기 체크
  if ($upload_file_size > $file_size_max) {  
    echo "용량을 초과하였습니다".$file_size_max;  
    exit();  
  }  
  
  $store_dir = "../files/";// 업로드 할 경로  
  $accept_overwrite = 1;//같은 파일 덮어쓰기 가능 여부  
  $file_path = $store_dir . $upload_file_name; 
  
  // 파일 존재하는지 체크 
  if (file_exists($file_path) && !$accept_overwrite) {  
    echo "같은 파일이 있습니다";  
    exit();  
  }  
   
  //템프파일을 해당 경로로 복사
  if (!move_uploaded_file($upload_file_temp,$file_path)) {  
    echo "파일 복사 실패".$upload_file_temp." to ". $file_path;  
    exit;  
  }  
   
  //Echo "<p>你上传了文件:";  
  //echo $upload_file_name;  
  //echo "<br>";  
  //客户端机器文件的原名称。   
   
  //Echo "文件的 MIME 类型为:";  
  //echo $uf['type'];  
  //文件的 MIME 类型，需要浏览器提供该信息的支持，例如“image/gif”。   
  //echo "<br>";  
   
  //Echo "上传文件大小:";  
  //echo $uf['size'];  
  //已上传文件的大小，单位为字节。   
  //echo "<br>";  
   
  //Echo "文件上传后被临时储存为:";  
  //echo $uf['tmp_name'];  
  //文件被上传后在服务端储存的临时文件名。   
  //echo "<br>";     
   
  $error = $uf['error'];  
  switch($error){  
  case 0:  
    Echo "파일 업로드 성공"; break;  
  case 1:  
    Echo "上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值."; break;  
  case 2:  
    Echo "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。";break;  
  case 3:  
    Echo "文件只有部分被上传";break;  
  case 4:  
    Echo "没有文件被上传";break;  
  }  
?> 