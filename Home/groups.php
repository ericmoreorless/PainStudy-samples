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


groupsHeader();

$res = DataAccess::getUniqueFlagByUser($username);
if(isset ($res)) {

    while ($row = mysqli_fetch_assoc($res)) {
        $group = $row['flag'];
        if($group != '')
        {
            $groupCount = DataAccess::countByFlagUser($username, $group);
            if ($rowcolor == "sideBarodd") {
               $rowcolor = "sideBareven";
            } else { 
               $rowcolor = "sideBarodd";
            }
            echo '  <tr class="'.$rowcolor.'" onMouseOver="this.className=\'sideBarHover\'" onMouseOut="this.className=\''.$rowcolor.'\'">
                        <td align="left"><a href="find.php?group='.$group.'" target="frame1">'.$group.'</a></td>
                        <td class="sideBarViewers" align="right" target="frame1"><a href="find.php?group='.$group.'" target="frame1">'.$groupCount.'</a></td>
                    </tr>';
        }

    }
}

groupsFooter();


function groupsHeader()
{
    echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
        <html>
        <head>
            <link rel="stylesheet" type="text/css" href="style.css">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>VIEWtelligence - Groups</title>
        </head>
        <body class="sideBar">
        <table class="sideBar" align="center">';
}

function listGroups($username)
{
    
}

function groupsFooter()
{
    echo '<tr>
                <td align="left">&nbsp</td>
                        </tr>
                    </table>
                </body>
            </html>';
}
?>  