<?php
require_once('Classes/Globals.php');
session_start();

if ($_SESSION['username'] == '') {
    $username = false;
    $loginuser = '';
} else {
    $usertype = $_SESSION['usertype'];
    $username = $_SESSION['username'];
    $useremail = $_SESSION['useremail'];
    $usersig = $_SESSION['usersig'];
    $renew = $_SESSION['renew'];
    $findsession = $_SESSION['find'];
}

$globals = new Globals();





if ($usertype == 1) {
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<html class="main">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="css/style.css" rel="stylesheet" />
        <link href="skins/default.css" rel="stylesheet" />
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/jcarousel.css" rel="stylesheet" />
        <link href="css/flexslider.css" rel="stylesheet" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sound Health Stream</title>
        <header>
		
		</header>
    <body class="main">
    	<table class="outsideTable" align="center">
    		<tr height="5%">';

    echo '      
                <td align="left"><a style="font-size:50px;" href="main.php"><span>Sound</span>Health</a></td>
                <td align="right">Logged in as: ' . $username . '<br><a href="bugreport.php">Report an Issue</a><br><a href="logout.php">Log out</a><br></td>';


                
    echo '
    		</tr>
            <tr>
                <td colspan="2">
                	<table class="middleTable" align="center">
                    <tr height="1%">
                    	<td align="left">&nbsp;</td>
                        <td align="right">
                        	<a href="recentactivity.php" target="frame1">Recent Activity</a> &nbsp;&nbsp; | &nbsp;&nbsp;
                        	<a href="viewertable.php?refresh=1" target="frame1">Show All</a> &nbsp;&nbsp;| &nbsp;&nbsp;
                        	<a href="viewertable.php?find=1" target="frame1">Find</a> &nbsp;&nbsp; | &nbsp;&nbsp;
                        </td>
                    </tr>
                	<tr>
                            <td colspan="2">
                                <table class="insideTable" align="center">
                                    <tr>
                                        <td width="20%">
                                            <table class="sideBarHead">
                                            	<tr>
                                                        <td align="left">Groups</td>
                                                        <td align="right"></td>
                                                    </tr>
                                            </table>
                                            <iframe src="groups.php"  name="frame4" id="frame4" height="92%" width="100%" frameborder="0" scrolling="auto" style="background-color: #FFFFFF">
                                                <p>Your Browser does not support iframes.</p>
                                            </iframe>
                                            <font color="black"><button onclick="refreshframe4();" style="font-color : black">Refresh Groups</button></font>
                                            <script>
                                            function refreshframe4() {
    											var ifr = document.getElementsByName(\'frame4\')[0];
    											ifr.src = ifr.src;
											}
                                            </script>
                                            <font color="black"><button onclick="refreshallframes();" style="font-color : black">Refresh All</button></font>
                                            <script>

                                            var runs = 0;

                                            function addRun(){

                                                runs++;

                                            }

                                            window.setInterval(function(){addRun();}, 500);

                                            function refreshallframes() {

    											var ifr = document.getElementsByName(\'frame4\')[0];
    											ifr.src = ifr.src;
    											var ifr = document.getElementsByName(\'frame2\')[0];
    											ifr.src = ifr.src;
    											var ifr = document.getElementsByName(\'frame1\')[0];
    											ifr.src = ifr.src;

											}

                                            function checkFrameSource() {

                                                var frame = document.getElementById(\'frame4\');
                                                document.getElementById("checkframesrc").innerHTML = frame.contentDocument.location+"<br> runs = "+runs;

                                            }

                                            window.setInterval(function(){checkFrameSource();}, 500);
                                            </script>

                                            <div id="checkframesrc" name="checkframesrc">

                                            </div>
                                        </td>
                                        <td width="80%">
                                            <iframe src="recentactivity.php"  name="frame1" id="frame1" height="100%" width="100%" frameborder="0" scrolling="auto" style="background-color: #FFFFFF">
                                                <p>Your Browser does not support iframes.</p>
                                            </iframe>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">
                                            <table class="sideBarHead">
                                                    <tr>
                                                        
                                                    </tr>
                                            </table>
                                            
                                        </td>
                                        <td width="80%">
                                            <iframe onload="frame1.src="recentactivity.php"" src="actions.php"  name="frame2" id="frame2" height="100%" width="100%" frameborder="0" scrolling="auto" style="background-color: #FFFFFF">
                                                <script>
													var iframeLoadCount = 0;
													function reloadOnce(iframe) {
  														iframeLoadCount ++;
  														if (iframeLoadCount <= 1) {
    														iframe.contentWindow.location.reload();
    														console.log("reload()");
  														}
													}
												</script>
                                                <p>Your Browser does not support iframes.</p>
                                            </iframe>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr height="1%">
                <td align="left"> &nbsp;&nbsp;v'.$globals->version.'</td>
                <td></td>
            </tr>
        </table>
    </body>
</html>';
}else{
    header( 'Location: notloggedin.php' ) ;
    die();
}
?>