<?php

session_start();
if ($_SESSION['username'] == '') {
    $username = false;
    $loginuser = '';
} else {
    $usertype = $_SESSION['user_type'];
    $username = $_SESSION['username'];
    $useremail = $_SESSION['useremail'];
    $usersig = $_SESSION['usersig'];
    $renew = $_SESSION['renew'];
}

require_once('Classes/DataAccess.php');
$a = $_GET['a'];
$e = $_GET['e'];
$d = $_GET['d'];
$req = $_GET['req'];

if($d==1){
	echo 'Edit successful!<br>';
}
editHeader();

if($a==1){
    addViewer($username, $req);
}else if($e != ''){

    if($e == "mult"){

        $editid = $_POST['id'];
        if(count($editid) != 1){
            editMultViewers($username, $editid);
        } else{
            editViewer($username, $editid[0]);
        }
    } else{
        editViewer($username, $e);
    }
}




echo '</body>
    </html> ';

function editHeader(){ ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style type="text/css">

                #dhtmltooltip{
                position: absolute;
                border: 2px solid black;
                padding: 2px;
                color: #FFFFFF;
                background-color: #00006E;
                visibility: hidden;
                z-index: 100;
                /*Remove below line to remove shadow. Below line should always appear last within this CSS*/
                filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);
                }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>VIEWtelligence - Add Viewer</title>
    	<script type="text/javascript">
		var f = document.getElementById('frame2');
		f.contentWindow.location.reload(true);
		</script>
    </head>

    <body>

<div id="dhtmltooltip"></div>

            <script type="text/javascript">

            /***********************************************
            * Cool DHTML tooltip script- ¬© Dynamic Drive DHTML code library (www.dynamicdrive.com)
            * This notice MUST stay intact for legal use
            * Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
            ***********************************************/

            var offsetxpoint=-60 //Customize x offset of tooltip
            var offsetypoint=20 //Customize y offset of tooltip
            var ie=document.all
            var ns6=document.getElementById && !document.all
            var enabletip=false
            if (ie||ns6)
            var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""

            function ietruebody(){
            return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
            }

            function ddrivetip(thetext, thecolor, thewidth){
            if (ns6||ie){
            if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"
            if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor
            tipobj.innerHTML=thetext
            enabletip=true
            return false
            }
            }

            function positiontip(e){
            if (enabletip){
            var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
            var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
            //Find out how close the mouse is to the corner of the window
            var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20
            var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20

            var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000

            //if the horizontal distance isnt enough to accomodate the width of the context menu
            if (rightedge<tipobj.offsetWidth)
            //move the horizontal position of the menu to the left by its width
            tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"
            else if (curX<leftedge)
            tipobj.style.left="5px"
            else
            //position the horizontal position of the menu where the mouse is positioned
            tipobj.style.left=curX+offsetxpoint+"px"

            //same concept with the vertical position
            if (bottomedge<tipobj.offsetHeight)
            tipobj.style.top=ie? ietruebody().scrollTop+event.clientY-tipobj.offsetHeight-offsetypoint+"px" : window.pageYOffset+e.clientY-tipobj.offsetHeight-offsetypoint+"px"
            else
            tipobj.style.top=curY+offsetypoint+"px"
            tipobj.style.visibility="visible"
            }
            }

            function hideddrivetip(){
            if (ns6||ie){
            enabletip=false
            tipobj.style.visibility="hidden"
            tipobj.style.left="-1000px"
            tipobj.style.backgroundColor=''
            tipobj.style.width=''
            }
            }

            document.onmousemove=positiontip

            </script>
<?php
}

function addViewer($username, $req){
    if($req != '')
    {
        echo '<font color="#FF0000"><p><b>Please fill in all Required Fields.</b> </p></font>';
        $id = $row['id'];
    	$fname = $row['fname'];
    	$lname = $row['lname'];
    	$email = $row['email'];
    	$phone = $row['phone'];
    	$carrier = $row['carrier'];
    	$company = $row['company'];
    	$message = $row['message'];
    	$video = $row['video'];
    	$secvideo = $row['secvideo'];
    	$thirdvideo = $row['thirdvideo'];
    	$fourvideo = $row['fourvideo'];
    	$numvisits = $row['numvisits'];
    	$date = $row['date'];
    	$url = $row['url'];
    	$user = $row['user'];
    	$flag = $row['flag'];
    	$address = $row['address'];
		$city = $row['city'];
    	$state = $row['state'];
    	$zip = $row['zip'];
    	$notes = $row['notes'];
    	$meetingnotes = $row['meetingnotes'];
    	$todo = $row['todo'];
    	$reminder = $row['reminder'];
    	$extra1name = $row['extra1name'];
    	$extra1 = $row['extra1'];
    	$extra2name = $row['extra2name'];
    	$extra2 = $row['extra2'];
    	$extra3name = $row['extra3name'];
    	$extra3 = $row['extra3'];
    	$setting = $row['setting'];
    	$surl = preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']);
    	$surl = 'http://' . $_SERVER['HTTP_HOST'] . '/' . ltrim(dirname($surl), '/') . '/';
    } ?>
    
    <form id="addcustomerForm" name="addcustomerForm" method="post" action="setcustomer.php">

        <div>
            <input name="user" type="hidden" id="user" value="<?php echo $username; ?>" />
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
            <input type="hidden" name="numvisits" id="numvisits" value="<?php echo $numvisits; ?>">
            <p style="font-size:1.2em;">Add Viewer:</p>

            <p style="font-size: 0.8em;">Fields marked with <b>*</b> are <b>Required</b>.</p>


            <ul>
                <li>
                    <ol>
                        <div>First&nbsp;Name:<b>*</b></div>
                        <input name="fname" type="text" id="fname" size="18" value="<?php echo $fname; ?>"/>
                        <div style="width:5em;">Last&nbsp;Name:<b>*</b></div>
                        <input name="lname" type="text" id="lname" size="18" value="<?php echo $lname; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>Address:</div>
                        <input name="address" type="text" id="address" size="30" value="<?php echo $address; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>City:</div>
                        <input name="city" type="text" id="city" size="10" value="<?php echo $city; ?>" />
                        <div style="width:2em;">State:</div>
                        <?php echo stateDropDown($state); ?>
                        <div style="width:2em;">Zip:</div>
                        <input name="zip" type="text" id="zip" size="5" value="<?php echo $zip; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>E-mail:<b>*</b></div>
                        <input name="email" type="text" id="email" size="20" value="<?php echo $email; ?>" placeholder="abc@123.com" />
                        <div>Group:</div>
                        <input name="flag" type="text" id="flag" size="18" value="<?php echo $flag; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>Phone:</div>
                        <input name="phone" type="text" id="phone" size="18" value="<?php echo $phone; ?>" placeholder="111-222-3333" />
                        <div>Carrier:</div>
                        <select name="carrier">
                            <option value="" selected>Select a Carrier</option>
                            <option value="Verizon">Verizon</option>
                            <option value="AT&T">AT&T</option>
                            <option value="Sprint">Sprint</option>
                            <option value="T-Mobile">T-Mobile</option>
                            <option value="MetroPCS">MetroPCS</option>
                        </select>
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>Company:</div>
                        <input name="company" type="text" id="company" size="18" value="<?php echo $company; ?>" />
                        <input name="user" type="hidden" id="user" size="18" value="<?php echo $user; ?>" />
                    </ol>
                </li>
            </ul>


            <ul>
                <li>
                    <ol>
                        <div>Notes:</div>
                        <input name="notes" type="text" id="notes" size="30" value="<?php echo $notes; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>Meeting Notes:</div>
                        <input name="meetingnotes" type="text" id="meetingnotes" size="30" value="<?php echo $meetingnotes; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>To-Do Notes:</div>
                        <input name="todo" type="text" id="todo" size="30" value="<?php echo $todo; ?>" />
                        <div style="width: 6em;">To-Do Date:</div>
                        <input name="reminder" type="text" id="reminder" size="12" value="<?php echo $reminder; ?>" placeholder="MM/DD/YYYY" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div style="width:13em; margin: 0em; padding: 0em;">Customizable Fields:</div>
                    </ol>
                </li>
                <li>
                    <ol>
                        <div style="width:6.5em; padding: 0em; margin: 0em;">Field Name</div>
                        <div>Value</div>
                    </ol>
                </li>
                <li>
                    <ol>
                        <input name="extra1name" type="text" id="extra1name" size="10" value="<?php echo $extra1name;?>" />
                        <input name="extra1" type="text" id="extra1" size="22" value="<?php echo $extra1; ?>" />

                    </ol>
                </li>
                <li>
                    <ol>
                        <input name="extra2name" type="text" id="extra2name" size="10" value="<?php echo $extra2name; ?>" />
                        <input name="extra2" type="text" id="extra2" size="22" value="<?php echo $extra2; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <input name="extra3name" type="text" id="extra3name" size="10" value="<?php echo $extra3name; ?>" />
                        <input name="extra3" type="text" id="extra3" size="22" value="<?php echo $extra3; ?>" />
                    </ol>
                </li>
                	<ol>
                        <input type="submit" value="Submit" name="submit" />
                    </ol>
                
            </ul>
        </div>
    </form>




<?php
}


function editViewer($username, $edit){
     $cnt = 0;
     $sql = "SELECT * FROM Customers WHERE id='" . $edit . "'";
     $server = "localhost";
     $username = "shdevp5";
     $password = "datsri22";
     $db	= "shdevp5_SHS";
     $con = mysql_connect($server, $username, $password) or die('Failure connecting to the database!');
     	$Link = mysql_select_db($db) or die('Failure selecting the database!');
     		$res = mysql_query($sql) or die(mysql_error()); mysql_close($con);
    if(!$res){
            die("Failed getting Customer data");
    }else{
        $cnt = mysql_num_rows($res);
    }
    $row = mysql_fetch_array($res);
    $id = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $phone = $row['phone'];
    $carrier = $row['carrier'];
    $company = $row['company'];
    $message = $row['message'];
    $video = $row['video'];
    $secvideo = $row['secvideo'];
    $thirdvideo = $row['thirdvideo'];
    $fourvideo = $row['fourvideo'];
    $numvisits = $row['numvisits'];
    $date = $row['date'];
    $url = $row['url'];
    $user = $row['user'];
    $flag = $row['flag'];
    $address = $row['address'];
    $city = $row['city'];
    $state = $row['state'];
    $zip = $row['zip'];
    $notes = $row['notes'];
    $meetingnotes = $row['meetingnotes'];
    $todo = $row['todo'];
    $reminder = $row['reminder'];
    $extra1name = $row['extra1name'];
    $extra1 = $row['extra1'];
    $extra2name = $row['extra2name'];
    $extra2 = $row['extra2'];
    $extra3name = $row['extra3name'];
    $extra3 = $row['extra3'];
    $setting = $row['setting'];
    $surl = preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']);
    $surl = 'http://' . $_SERVER['HTTP_HOST'] . '/' . ltrim(dirname($surl), '/') . '/';
    ?>

    <form id="editcustomer" name="editcustomer" method="post" action="editcustomer.php">
        <div>
            <input name="user" type="hidden" id="user" value="<?php echo $username; ?>" />
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
            <input type="hidden" name="numvisits" id="numvisits" value="<?php echo $numvisits; ?>">
            <p style="font-size:1.2em;">Edit Viewer:</p>

            <p style="font-size: 0.8em;">Fields marked with <b>*</b> are <b>Required</b>.</p>

            <ul>
                <li>
                    <ol>
                        <div>First&nbsp;Name:<b>*</b></div>
                        <input name="fname" type="text" id="fname" size="18" value="<?php echo $fname; ?>"/>
                        <div style="width:5em;">Last&nbsp;Name:<b>*</b></div>
                        <input name="lname" type="text" id="lname" size="18" value="<?php echo $lname; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>Address:</div>
                        <input name="address" type="text" id="address" size="30" value="<?php echo $address; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>City:</div>
                        <input name="city" type="text" id="city" size="10" value="<?php echo $city; ?>" />
                        <div style="width:2em;">State:</div>
                        <?php echo stateDropDown($state); ?>
                        <div style="width:2em;">Zip:</div>
                        <input name="zip" type="text" id="zip" size="5" value="<?php echo $zip; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>E-mail:<b>*</b></div>
                        <input name="email" type="text" id="email" size="20" value="<?php echo $email; ?>" placeholder="abc@123.com" />
                        <div>Group:</div>
                        <input name="flag" type="text" id="flag" size="18" value="<?php echo $flag; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>Phone:</div>
                        <input name="phone" type="text" id="phone" size="18" value="<?php echo $phone; ?>" placeholder="111-222-3333" />
                        <div>Carrier:</div>
                        <select name="carrier">
                            <?php
                            if($carrier == 'Verizon'){
                                echo '<option value="Verizon" selected>Verizon</option>';
                            }else{
                                echo '<option value="Verizon">Verizon</option>';
                            }
                            if($carrier == 'AT&T'){
                                echo '<option value="AT&T" selected>AT&T</option>';
                            }else{
                                echo '<option value="AT&T">AT&T</option>';
                            }
                            if($carrier == 'Sprint'){
                                echo '<option value="Sprint" selected>Sprint</option>';
                            }else{
                                echo '<option value="Sprint">Sprint</option>';
                            }
                            if($carrier == 'T-Mobile'){
                                echo '<option value="T-Mobile" selected>T-Mobile</option>';
                            }else{
                                echo '<option value="T-Mobile">T-Mobile</option>';
                            }
                            if($carrier == 'MetroPCS'){
                                echo '<option value="MetroPCS" selected>MetroPCS</option>';
                            }else{
                                echo '<option value="MetroPCS">MetroPCS</option>';
                            }
                            ?>
                        </select>
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>Company:</div>
                        <input name="company" type="text" id="company" size="18" value="<?php echo $company; ?>" />
                        <input name="user" type="hidden" id="user" size="18" value="<?php echo $user; ?>" />
                    </ol>
                </li>
            </ul>
            <ul>
                <li>
                    <ol>
                        <div>Notes:</div>
                        <input name="notes" type="text" id="notes" size="30" value="<?php echo $notes; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>Meeting Notes:</div>
                        <input name="meetingnotes" type="text" id="meetingnotes" size="30" value="<?php echo $meetingnotes; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div>To-Do Notes:</div>
                        <input name="todo" type="text" id="todo" size="30" value="<?php echo $todo; ?>" />
                        <div style="width: 6em;">To-Do Date:</div>
                        <input name="reminder" type="text" id="reminder" size="12" value="<?php echo $reminder; ?>" placeholder="MM/DD/YYYY" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <div style="width:13em; margin: 0em; padding: 0em;">Customizable Fields:</div>
                    </ol>
                </li>
                <li>
                    <ol>
                        <div style="width:6.5em; padding: 0em; margin: 0em;">Field Name</div>
                        <div>Value</div>
                    </ol>
                </li>
                <li>
                    <ol>
                        <input name="extra1name" type="text" id="extra1name" size="10" value="<?php echo $extra1name;?>" />
                        <input name="extra1" type="text" id="extra1" size="22" value="<?php echo $extra1; ?>" />

                    </ol>
                </li>
                <li>
                    <ol>
                        <input name="extra2name" type="text" id="extra2name" size="10" value="<?php echo $extra2name; ?>" />
                        <input name="extra2" type="text" id="extra2" size="22" value="<?php echo $extra2; ?>" />
                    </ol>
                </li>
                <li>
                    <ol>
                        <input name="extra3name" type="text" id="extra3name" size="10" value="<?php echo $extra3name; ?>" />
                        <input name="extra3" type="text" id="extra3" size="22" value="<?php echo $extra3; ?>" />
                    </ol>
                </li>
                	<ol>
                    	<input type="submit" value="Submit" name="submit" />
                    </ol>
            </ul>
        </div>
    </form>

    <?php
}


function editMultViewers($username, $editid){
    echo '
                 <table class="formTable">
                 <tr>
                 <td colspan="2"><b>Edit Selected Viewers:</b></td>
                 </tr>
                 <tr>
                    <td valign="top" width="50%">
                            <table class="formTable">
                         <form id="editmult" name="editmult" method="post" action="editmult.php">
                         <tr>
                          <td colspan="3"><input name="user" type="hidden" id="user" value="' . $user . '" />
                         Any changes will affect all selected Viewers. Any Fields left blank will not be affected.</td>
                         </tr>
                         <tr>
                          <td>Group: </td><td><input name="flag" type="text" id="flag" size="18" /></td><td>Viewers Selected:</td>
                         </tr>
                         <tr>
                          <td>Company: </td><td><input name="company" type="text" id="company" size="18" /></td>
                          <td rowspan=4><select name="id[]" size="9" multiple="multiple">';
                          if(isset($editid))
                          {
                              foreach($editid as $value)
                              {

                                $res = DataAccess::getCustomerByID($value);
                                $row = mysql_fetch_array($res);
                                $fname = $row['fname'];
                                $lname = $row['lname'];
                                echo '<option value="' . $value . '" selected>' . $fname . ' ' . $lname . '</option>';
                              }
                          }
            echo '       </td>
                         </tr>
                         <td><input type="submit" value="Submit" name="submit" /></td>
                    </td>
                 </tr></table>';
}

function videoSelect($username) {
    $res = DataAccess::getVideos();
    if(isset ($res)) {
    while ($row = mysql_fetch_array($res)) {
        $videoname = $row['video'];
        $usersallowed = $row['usersallowed'];
            $usersallowed = unserialize($usersallowed);
            if($usersallowed == NULL)
            {
                $usersallowed = array();
            }
            if (in_array(strtolower($username), array_map('strtolower', $usersallowed))) {
                echo '<option>' . $videoname . '</option>';
            }
        }
    }

}

function videoSelectWithSelected($username, $video) {
    $res = DataAccess::getVideos();
    if(isset ($res)) {
    while ($row = mysql_fetch_array($res)) {
        $videoname = $row['video'];
        $usersallowed = $row['usersallowed'];
                        $usersallowed = unserialize($usersallowed);
            if($usersallowed == NULL)
            {
                $usersallowed = array();
            }
                        if (in_array(strtolower($username), array_map('strtolower', $usersallowed))) {
                                if($videoname == $video)
                                {
                                    echo '<option selected>' . $videoname . '</option>';
                                }
                                else
                                {
                                    echo '<option>' . $videoname . '</option>';
                                }
                        }
                    }

    }
}

function settingSelect($username) {
    $res = DataAccess::getSettings();
    if(isset ($res)) {
    while ($row = mysql_fetch_array($res)) {
        $settingid= $row['id'];
        $settingname = $row['name'];
        $usersallowed = $row['usersallowed'];
            $usersallowed = explode("&", $usersallowed);
            if($usersallowed == NULL)
            {
                $usersallowed = array();
            }
            if (in_array(strtolower($username), array_map('strtolower', $usersallowed))) {
                echo '<option value="'.$settingid.'">' . $settingname . '</option>';
            }
        }
    }

}

function settingSelectWithSelected($username, $setting) {
    $res = DataAccess::getSettings();
    if(isset ($res)) {
    while ($row = mysql_fetch_array($res)) {
        $settingid= $row['id'];
        $settingname = $row['name'];
        $usersallowed = $row['usersallowed'];
            $usersallowed = explode("&", $usersallowed);
            if($usersallowed == NULL)
            {
                $usersallowed = array();
            }
                        if (in_array(strtolower($username), array_map('strtolower', $usersallowed))) {
                                if($settingid == $setting)
                                {
                                    echo '<option value="'.$settingid.'" selected>' . $settingname . '</option>';
                                }
                                else
                                {
                                    echo '<option value="'.$settingid.'">' . $settingname . '</option>';
                                }
                        }
                    }

    }
}

function videoPreview($username) {
    $res = DataAccess::getVideos();
    if(isset ($res)) {
    while ($row = mysql_fetch_array($res)) {
        $videoname = $row['video'];
        $videourl = $row['url'];
        $thumbnail = $row['thumbnail'];
        $type = $row['type'];
        $usersallowed = $row['usersallowed'];
            $usersallowed = unserialize($usersallowed);
            if($usersallowed == NULL)
            {
                $usersallowed = array();
            }
            if (in_array(strtolower($username), array_map('strtolower', $usersallowed))) { ?>

                <span onmouseover="ddrivetip('<?php echo $videoname; ?>');" onmouseout="hideddrivetip()">
                           <a href="#"
                              onClick="javascript:window.open('video/preview.php?v=<?php echo $videourl; ?>&i=<?php echo $thumbnail; ?>&t=<?php echo $type;?>', 'WinName', 'width=660,height=380');">
                                    <img src="thumbnails/<?php echo $thumbnail; ?>" height="50" alt="<?php echo $videoname; ?>" title="<?php echo $videoname; ?> "/>
                           </a>
                </span>
     <?php }
        }
    }

}

function stateDropDown($state)
{
 echo '<select name="state">
	<option value="AL" '; if($state=='AL'){echo 'selected';} echo '>AL</option>
	<option value="AK" '; if($state=='AK'){echo 'selected';} echo '>AK</option>
	<option value="AZ" '; if($state=='AZ'){echo 'selected';} echo '>AZ</option>
	<option value="AR" '; if($state=='AR'){echo 'selected';} echo '>AR</option>
	<option value="CA" '; if($state=='CA'){echo 'selected';} echo '>CA</option>
	<option value="CO" '; if($state=='CO'){echo 'selected';} echo '>CO</option>
	<option value="CT" '; if($state=='CT'){echo 'selected';} echo '>CT</option>
	<option value="DE" '; if($state=='DE'){echo 'selected';} echo '>DE</option>
	<option value="DC" '; if($state=='DC'){echo 'selected';} echo '>DC</option>
	<option value="FL" '; if($state=='FL'){echo 'selected';} echo '>FL</option>
	<option value="GA" '; if($state=='GA'){echo 'selected';} echo '>GA</option>
	<option value="HI" '; if($state=='HI'){echo 'selected';} echo '>HI</option>
	<option value="ID" '; if($state=='ID'){echo 'selected';} echo '>ID</option>
	<option value="IL" '; if($state=='IL'){echo 'selected';} echo '>IL</option>
	<option value="IN" '; if($state=='IN'){echo 'selected';} echo '>IN</option>
	<option value="IA" '; if($state=='IA'){echo 'selected';} echo '>IA</option>
	<option value="KS" '; if($state=='KS'){echo 'selected';} echo '>KS</option>
	<option value="KY" '; if($state=='KY'){echo 'selected';} echo '>KY</option>
	<option value="LA" '; if($state=='LA'){echo 'selected';} echo '>LA</option>
	<option value="ME" '; if($state=='ME'){echo 'selected';} echo '>ME</option>
	<option value="MD" '; if($state=='MD'){echo 'selected';} echo '>MD</option>
	<option value="MA" '; if($state=='MA'){echo 'selected';} echo '>MA</option>
	<option value="MI" '; if($state=='MI'){echo 'selected';} echo '>MI</option>
	<option value="MN" '; if($state=='MN'){echo 'selected';} echo '>MN</option>
	<option value="MS" '; if($state=='MS'){echo 'selected';} echo '>MS</option>
	<option value="MO" '; if($state=='MO'){echo 'selected';} echo '>MO</option>
	<option value="MT" '; if($state=='MT'){echo 'selected';} echo '>MT</option>
	<option value="NE" '; if($state=='NE'){echo 'selected';} echo '>NE</option>
	<option value="NV" '; if($state=='NV'){echo 'selected';} echo '>NV</option>
	<option value="NH" '; if($state=='NH'){echo 'selected';} echo '>NH</option>
	<option value="NJ" '; if($state=='NJ'){echo 'selected';} echo '>NJ</option>
	<option value="NM" '; if($state=='NM'){echo 'selected';} echo '>NM</option>
	<option value="NY" '; if($state=='NY'){echo 'selected';} echo '>NY</option>
	<option value="NC" '; if($state=='NC'){echo 'selected';} echo '>NC</option>
	<option value="ND" '; if($state=='ND'){echo 'selected';} echo '>ND</option>
	<option value="OH" '; if($state=='OH'){echo 'selected';} echo '>OH</option>
	<option value="OK" '; if($state=='OK'){echo 'selected';} echo '>OK</option>
	<option value="OR" '; if($state=='OR'){echo 'selected';} echo '>OR</option>
	<option value="PA" '; if($state=='PA'){echo 'selected';} echo '>PA</option>
	<option value="RI" '; if($state=='RI'){echo 'selected';} echo '>RI</option>
	<option value="SC" '; if($state=='SC'){echo 'selected';} echo '>SC</option>
	<option value="SD" '; if($state=='SD'){echo 'selected';} echo '>SD</option>
	<option value="TN" '; if($state=='TN'){echo 'selected';} echo '>TN</option>
	<option value="TX" '; if($state=='TX'){echo 'selected';} echo '>TX</option>
	<option value="UT" '; if($state=='UT'){echo 'selected';} echo '>UT</option>
	<option value="VT" '; if($state=='VT'){echo 'selected';} echo '>VT</option>
	<option value="VA" '; if($state=='VA'){echo 'selected';} echo '>VA</option>
	<option value="WA" '; if($state=='WA'){echo 'selected';} echo '>WA</option>
	<option value="WV" '; if($state=='WV'){echo 'selected';} echo '>WV</option>
	<option value="WI" '; if($state=='WI'){echo 'selected';} echo '>WI</option>
	<option value="WY" '; if($state=='WY'){echo 'selected';} echo '>WY</option>
       </select>';

}
?>