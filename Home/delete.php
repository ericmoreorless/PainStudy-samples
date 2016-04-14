<?php
    session_start();
    if ($_SESSION['username'] == ''){
        $username = false;
        $loginuser = '';
    }else{
        $usertype = $_SESSION['user_type'];
        $username = $_SESSION['username'];
        $client = $_SESSION['client'];
       // $loginuser = $_SESSION['userfname'];
    }

    require_once('Classes/DataAccess.php');
    
    $id = $_GET['id'];
    $item = $_GET['item'];
    $userid = $_GET['user'];
    
    $ids = $_POST['id'];

    if($ids != '')
    {

      foreach($ids as $value)
      {

            DataAccess::removeCustomer($value);
      }
      header( 'Location: recentactivity.php' ) ;
      die();
    }
    else {

        if(!$id)
        {
            if(!(!$userid))
            {
                $surl = preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']);
                $surl = 'http://'.$_SERVER['HTTP_HOST'].'/'.ltrim(dirname($surl), '/').'/';
                 echo '
                 <html>
                 <head>
                 <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
                 </head>
                 <body>
                 <form id="deluser" name="deluser" method="post" action="deluser.php">
                  <input name="userid" type="hidden" id="userid" value="'.$userid.'" />
                  <input name="client" type="hidden" id="client" value="'.$client.'" />
                  <input name="url" type="hidden" id="url" value="'.$surl.'" />
                  </form>
                  <script type="text/javascript">
                  document.deluser.submit();
                  </script>
                 </body>
                 </html>';
                if($usertype == 0)
                {
                   header( 'Location: manager.php' ) ;
                   die();
               }
            }
        }
        else
        {
            if(!$item){
            DataAccess::removeCustomer($id);
            }
            else
            {
                $res = DataAccess::getVideoByID($id);
                if(!(!$res))
                {
                    $row = mysql_fetch_array($res);
                    $thumbnail = $row['thumbnail'];
                    $video = $row['url'];
                    $type = $row['type'];
                    
                    if($type == 'd')
                    {
                        if($thumbnail != "pdf-icon.png" && $thumbnail != "pdf-icon"
                                && $thumbnail != "video-icon.png" && $thumbnail != "video-icon"
                                && $thumbnail != "document-icon.png" && $thumbnail != "document-icon"
                                && $thumbnail != "invoice-icon.png" && $thumbnail != "invoice-icon")
                        {
                            unlink('thumbnails/'.$thumbnail);
                        }
                        //unlink('video/documents/'.$video.'.pdf');
                    }
                    else {                  
                        
                        if($thumbnail != "pdf-icon.png" && $thumbnail != "pdf-icon" 
                                && $thumbnail != "video-icon.png" && $thumbnail != "video-icon"
                                && $thumbnail != "document-icon.png" && $thumbnail != "document-icon"
                                && $thumbnail != "invoice-icon.png" && $thumbnail != "invoice-icon")
                        {
                            unlink('thumbnails/'.$thumbnail);
                        }
                        unlink('video/videos/'.$video.'.flv');
                    }
                    
                }
                DataAccess::removeVideo($id);
            }


                if($usertype == 0)
                {
                   header( 'Location: manager.php' ) ;
                   die();
               }
               else
               {
                  header( 'Location: actions.php' ) ;
                  die();
               }
      }
    }
   
?>
