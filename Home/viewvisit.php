<?php
    /* VIEWTelligence - viewvisit.php
     * Author: Kevin Hawker
     * Description: Displays an HTML table
     *              containing full info about every visit
     *              made by a specific Viewer. The Viewer
     *              is identified by an id.
     */

    session_start();
    if ($_SESSION['username'] == ''){
        $username = false;
        $loginuser = '';
    }else{
        $usertype = $_SESSION['user_type'];
        $username = $_SESSION['username'];
        $useremail = $_SESSION['useremail'];
        $usersig = $_SESSION['usersig'];
       // $loginuser = $_SESSION['userfname'];
    }
    
    require_once('Classes/DataAccess.php');
    if($username == false)
    {
         echo '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
        <html>
        <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Please log in</title>';
        echo '
	</head>
        <body>
        You are not logged in!

        <a href="index.php">Return to login</a>
        </body>
        </html>';
    }
    else{

    $msg = $_GET['msg'];
    $msgnum = $_GET['num'];
    if(isset ($msg))
    {
        $mres = DataAccess::getEmailsByID($msg);
        if($mres)
        {            
            $mrow = mysqli_fetch_assoc($mres);
            $visitids = $mrow['visitids'];        
            $id = $mrow['viewerid']; 
            //echo "id1=$id ";
            if (isset($visitids)) {
                $visitids_array = explode(",", $visitids);
            } else {
                $id = NULL;
            }
        }
    }
            //echo "id2=$id ";
    if(!isset ($id))
    {        
        $id = $_GET['id'];
        
    }
            //echo "id3=$id ";
    $res = DataAccess::getCustomerByID($id);
    if(!$res)
    {
            //echo "id4=$id ";
        die('Failed getting Viewer Data');
    }
    else
    {

        $row = mysqli_fetch_assoc($res);
        $fname = $row['fname'];
        $lname = $row['lname'];
        print "
                <html>
                <head>
                 <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
                <style type=\"text/css\">

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
                 <title>VIEWtelligence - View Visits</title>
                 </head>
                 <body>
                 <table class=\"pageTable\">
                 <tr>
                 <td>
                 <b>Visits Made by $fname $lname";
        if(isset ($msgnum))
        {
            echo " from Message #$msgnum";
        }
        print ":</b>
                 </td>
                 </tr>
                 </table>";
        echo '   <div id="dhtmltooltip"></div>

                <script type="text/javascript">

                /***********************************************
                * Cool DHTML tooltip script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
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
                tipobj.style.backgroundColor=\'\'
                tipobj.style.width=\'\'
                }
                }

                document.onmousemove=positiontip

                </script>';
               print "<table class=\"mainTable\">
                                <thead align=\"left\">
                                    <tr>
                                        <th><b>Visit #</b></th>
                                        <th><b>Date</b></th>
                                        <th><b>Time</b></th>
                                        <th><b>Audio</b></th>
                                        <th><b>Device</b></th>
                                        <th><b>IP Address</b></th>
                                        <th><b>Listened for (hh:mm:ss)</b></th>
                                        <th><b>Referred By</b></th>
                                        <th><b>Interruption</b></th>
                                        <th><b>Interruption Time (hh:mm:ss)</b></th>
                                    </tr>
                                </thead>
                                <tbody align=\"left\">";

               if(isset ($visitids_array))
               {                

                $visitres = DataAccess::getVisitsByVisitIDArray($id, $visitids_array);
               
               }
               else
               {
                

                    $visitres = DataAccess::getVisitsByID($id);                   
               }
        if (!$visitres) {
            if ($rowcolor == "mainTableodd") {
                $rowcolor = "mainTableeven";
            } else {
                $rowcolor = "mainTableodd";
            }
            print "<tr class=\"$rowcolor\"><td colspan=\"8\">This Viewer has not made any visits.</td></tr>";
        } else {


            $numvisit = mysqli_num_rows($visitres);

            while ($visitrow = mysqli_fetch_assoc($visitres)) {

                $visitid = $visitrow['visitid'];
                $visitdate = formatDate($visitrow['Date']);
                $visittime = $visitrow['time'];
                $visitmessage = $visitrow['message'];
                $visitaudio = $visitrow['audio'];
                $visitdevice = $visitrow['device'];
                $visitip = $visitrow['ip'];
                $visitviewtime = $visitrow['timeListened'];
                $visitreferrer = $visitrow['reference'];
                $interrupt = $visitrow['interrupt'];
                $intertime = $visitrow['timeinterrupt'];
                if ($rowcolor == "mainTableodd") {
                    $rowcolor = "mainTableeven";
                } else {
                    $rowcolor = "mainTableodd";
                }
                
               
                print "<tr class=\"$rowcolor\">
                ";
                print "<td>$visitid</td>
                ";
                print "<td>$visitdate</td>
                ";
                print "<td>$visittime</td>
                ";
                //print "<td><span class=\"hotspot\" onMouseover=\"ddrivetip('".str_replace('"', "&quot;", $visitmessage)."');\" onMouseout=\"hideddrivetip()\">View</span></td></td>
                //";
                print "<td>$visitaudio</td>
                ";
                print "<td>$visitdevice</td>
                ";

                print '<td class="real"><a href="http://whatismyipaddress.com/ip/'.$visitip.'" target="_blank">'.$visitip.'</a></td>
                    ';
                //print "<td>$visitip</td>
                //";
                $vthr = round(($visitviewtime / 3600));
                $vtmin = round(($visitviewtime / 60));
                $vtsec = round(($visitviewtime % 60),-1);
                print "<td>" . $vthr . ":" . $vtmin . ":" . $vtsec . "</td>
                ";
                print "<td>$visitreferrer</td>
                ";
                print "<td>$interrupt</td>
                ";
                $intimehr = round(($intertime / 3600));
                $intimemin = round(($intertime / 60));
                $intimesec = round(($intertime % 60),-1);
                print "<td>" . $intimehr . ":" . $intimemin . ":" . $intimesec . "</td>
                ";
                print "</tr>
                    ";
                $numvisit--;
            }
        }
            echo '</tbody></table></body></html>';
        }
        
      }

function formatDate($MySqlDate) {
    if (isset($MySqlDate)) {
        $date_array = explode("-", $MySqlDate); // split the array

        if($date_array[1]=='00' && $date_array[2]=='00' && $date_array[0]=='0000')
        {
            return NULL;
        }
        return($date_array[1] . '/' . $date_array[2] . '/' . $date_array[0]); // return it to the user

    } else {
        return NULL;
    }
}

function formatTime($MySqlTime) {
    if (isset($MySqlTime)) {
        $time_array = explode(":", $MySqlTime); // split the array
        $hours = $time_array[0];
        $hours = (int)$hours;
        $hours = $hours-3;
        if($hours > 12)
        {
            $hours = $hours-12;
            $timeofday='PM';            
        }
        else if($hours == 12)
        {
            $timeofday='PM';
        }
        else
        {
            $timeofday='AM';                    
        }
        return($hours . ':' . $time_array[1] . ':' . $time_array[2].' '.$timeofday); // return it to the user

    } else {
        return NULL;
    }
}


?>
