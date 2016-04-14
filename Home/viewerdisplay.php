<?php

require_once('Classes/DataAccess.php');

    $id = $_GET['id'];
    
    $res = DataAccess::getCustomerByID($id);

    if($res != '')
    {

    $row = mysqli_fetch_assoc($res);

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
    $numemails = $row['numemails'];
    $date = formatDate($row['date']);
    $lastemail = formatDate($row['lastemail']);
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

    if(isset ($setting))
    {
        $hres = DataAccess::getSettingByID($setting);
        if(isset ($hres))
        {
            $hrow = mysqli_fetch_assoc($hres);
            $settingName = $hrow['name'];
        }
    }
    else
    {
            $settingName = 'Default';
    }

echo '<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>VIEWtelligence - Viewer Display</title>
    </head> ';
    echo '<body>
            <table class="pageTable">
                <tr>
                    <td><b>Viewer Info:</b></td>
                    <td></td>
                    <td align="right"><a href="addviewer.php?e='.$id.'" target="frame2">Edit</a> | <a href="email.php?id='.$id.'" target="frame2">Message</a> |
                        <a href="delete.php?id='.$id.'" onclick="return confirm(\'Are you sure you want to Delete this Viewer?\'); parent.frame1.location.reload();">Delete</a></td>
                </tr>
                <tr>
                <td valign="top">
                        <table class="pageTable" cellpadding="3">';
    echo "                   <tr>
                                <td colspan=\"2\"><b>Contact Info:</b></td>
                            </tr>
                            <tr>
                                <td>Name: </td>
                                <td>$fname $lname</td>
                            </tr>
                            <tr>
                                <td>Company: </td>
                                <td>$company</td>
                            </tr>
                            <tr>
                                <td>E-mail: </td>
                                <td><a href=\"mailto:$email\">$email</a></td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td>$phone</td>
                            </tr>
                            <tr>
                                <td>Carrier:</td>
                                <td>$carrier</td>
                            </tr>
                            <tr>
                                <td>Address: </td><td>$address</td>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td>$city</td>
                            </tr>
                            <tr>
                                <td>State:</td>
                                <td>$state</td>
                            </tr>
                            <tr>
                                <td>Zip:</td>
                                <td>$zip</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td><td></td>
                            </tr>";
    echo '               </table>
                    </td>
                    <td valign="top">
                        <table class="pageTable" cellpadding="3"> ';
   echo "                    <tr>
                                <td colspan=\"2\"><b>Additional Info:</b></td>
                            </tr>
                            <tr>
                                <td>Group: </td>
                                <td>$flag</td>
                            </tr>
                            <tr>
                                <td>Campaign:</td><td>$campaign</td>
                            </tr>
                            <tr>
                                <td>Notes: </td><td>$notes</td>
                            </tr>
                            <tr>
                                <td>Meeting Notes: </td><td>$meetingnotes</td>
                            </tr>
                            <tr>
                                <td>To-Do Notes: </td><td>$todo</td>
                            </tr>
                            <tr>
                                <td>To-Do Date: </td><td>$reminder</td>
                            </tr> 
                            <tr>
                               <td>$extra1name</td>
                               <td>$extra1</td>
                            </tr>
                            <tr>
                               <td>$extra2name</td>
                               <td>$extra2</td>
                            </tr>
                            <tr>
                               <td>$extra3name</td>
                               <td>$extra3</td>
                            </tr>
                        </table>
                    </td>
                    <td valign=\"top\">";
     echo '               <table class="pageTable" cellpadding="3">
                            <tr>';
     echo "                  <td colspan=\"2\"><b>Presentation Info:</b></td>
                            </tr>
                            <tr>
                                <td>Primary: </td><td>$video</td>
                            </tr>
                            <tr>
                                <td>Second: </td><td>$secvideo</td>
                            </tr>
                            <tr>
                                <td>Third: </td><td>$thirdvideo</td>
                            </tr>
                            <tr>
                                <td>Fourth: </td><td>$fourvideo</td>
                            </tr>
                            <tr>
                                <td>LP Message: </td><td rowspan=\"2\">$message</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td>LP Setting:</td><td>$settingName</td>
                            </tr>
                            <tr>
                                <td>Visits: </td><td><a href=\"viewvisit.php?id=$id\" target=\"frame2\">$numvisits</a></td>
                            </tr>
                            <tr>
                                <td>Messages: </td><td><a href=\"viewemail.php?id=$id\" target=\"frame2\">$numemails</a></td>
                            </tr>
                            <tr>
                                <td>Last Visit: </td><td>$date</td>
                            </tr>
                            <tr>
                                <td>Last Message: </td><td>$lastemail</td>
                            </tr>
                            <tr>
                                <td>Reference URL: </td><td><input type=\"text\" name=\"url\" value=\"".$surl . "video/video.php?url=" . $url . "\" size=\"20\" readonly=\"readonly\" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>";
   echo' </body>
</html>';
    }
    else
    {
        echo '<html>';
        echo '<body>';
        echo 'Viewer not found. ';
        echo '<a href="actions.php" target="frame2">Return to Home</a>';
        echo '</body>';
        echo '</html>';
    }


    function formatDate($MySqlDate) {
        if (isset($MySqlDate)) {
            $date_array = explode("-", $MySqlDate); // split the array

            if ($date_array[1] == '00' && $date_array[2] == '00' && $date_array[0] == '0000') {
                return NULL;
            }
            return($date_array[1] . '/' . $date_array[2] . '/' . $date_array[0]); // return it to the user
        } else {
            return NULL;
        }
    }
?>