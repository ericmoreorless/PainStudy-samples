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
    $findsession = $_SESSION['find'];
}

require_once('Classes/DataAccess.php');
    
echo '<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>VIEWtelligence - Viewer Display</title>';
 print "<script type=\"text/javascript\">
            checked=false;
            function checkedAll (frm1) {
                    var aa= document.getElementById('frm1');
                     if (checked == false)
                      {
                       checked = true
                      }
                    else
                      {
                      checked = false
                      }
                    for (var i =0; i < aa.elements.length; i++)
                    {
                     aa.elements[i].checked = checked;
                    }
                }
          function OnSubmitFrm1(button)
                {
                  if(button==0)
                  {
                   document.frm1.action =\"email.php\";
                   document.frm1.target=\"frame2\";
                  }
                  else
                  if(button==1)
                  {
                    document.frm1.action =\"addviewer.php?e=mult\";
                    document.frm1.target=\"frame2\";
                  }
                  else
                  if(button==2)
                  {
                    var check = confirm('Are you sure you want to Delete the selected Viewers?');
                    if(check)
                    {
                        document.frm1.action =\"delete.php\";
                        document.frm1.target=\"\";
                    }
                  }
                  document.frm1.submit();
                  return true;
                }
            </script>
    </head> ";
    echo '<body>';

    print "<form id=\"frm1\" name=\"frm1\" action=\"viewertable.php\" method=\"post\">";

    echo  '  <table class="formTable">
                <tr>
                <td colspan="2">
                    <a href="addUser.php?a=1" target="frame2">Add Viewer</a> |
                    <a href="#" onClick="OnSubmitFrm1(1);return false;" target="frame2" VALUE="Mult">Edit Selected</a> |
                    <a href="#" onClick="OnSubmitFrm1(2);return false;" VALUE="Mult">Delete Selected</a> |
                    <a href="#" onClick="OnSubmitFrm1(0);return false;" target="frame2" VALUE="Email">Message Selected</a> |
                    <a href="/SHSadmin/uploader/basic.html" target="frame2">Add New Wav</a>
                </td>
                </tr>
                <tr>
                <td valign="top">';
    recentMessagesTable($username);
    /*echo  '
                 </td>
                 <td valign="top">';
	recentVisitsTable($username);
    echo "          </td>
                    </tr>
                    <tr>
                    <tr>
                    <td colspan=\"2\">&nbsp;</td>
                    </tr>
                    <td valign=\"top\">";

    mostMessagesTable($username);

    echo '
                    </td>
                    <td valign=\"top\">';

    mostVisitsTable($username);

    echo '          </td>
                </tr>
            </table></form>';
   echo' </body>
            </html>';
    */
   function recentMessagesTable($username) {
         echo '            <br />
                            <table class="mainTable"  align="left">
                                 <thead align="left">
                                     <tr>
                                         <th></th>
                                         <th><a href="recentactivity.php?sort=fname" >First Name</a></th>
                                         <th><a href="recentactivity.php?sort=lname" >Last Name</a></th>
                                         <th><a href="recentactivity.php?sort=tv" >Total Visits</a></th>
                                         <th><a href="recentactivity.php?sort=flv" >Full Length Visits</a></th>
                                         <th><a href="recentactivity.php?sort=mrv" >Most Recent Visit</a></th>
                                         <th><a href="recentactivity.php?sort=lm" >Last Message</a></th>
                                     </tr>
                                     </thead>
                                     <tbody>';

        $result = DataAccess::populateTable($_GET["sort"]);

        $rowcolor = "mainTableodd";
        
        if(isset ($result)) {

        	while ($row = mysqli_fetch_assoc($result)) {

        	if ($rowcolor == "mainTableodd") {
            	$rowcolor = "mainTableeven";
        	} else {
            	$rowcolor = "mainTableodd";
        	}

          //query to update the fullLengthVisits field for each customer
          $con = Globals::getConnection();
          $sql = "SELECT COUNT(`interrupt`) FROM `shdevp5_SHS`.`Visits` WHERE `Visits`.`interrupt` = 'no' AND `Visits`.`CustomersID` = '" . $row['id'] . "';";
          
          if ($r = mysqli_query($con,$sql))
          {
            $row_count = mysqli_num_rows($r);

          }
          else
          {
            $row_count = "Query Failed";
          }
  
          $flV = $row_count;

          $id = $row['id'];
        	$fname = $row['fname']; 
        	$lname = $row['lname'];
        	$numV = $row['numvisits'];
        	//$flV = $row['fullLengthVisits'];
        	$mrV = $row['mostRecentVisit'];
        	$msg = $row['message'];
        	$email = $row['email'];
        	$flag = $row['flag'];
        	$company = $row['company'];
        	$lastemail = formatDate($row['lastemail']);

          

        
        	//echo '<br>' . $id . '<br>' . $fname . '<br>' . $lname . '<br>'. $email . '<br>' . $flag . '<br>' . $company;
        
        	print "<tr class=\"$rowcolor\" onMouseOver=\"this.className='mainTableHover'\" onMouseOut=\"this.className='$rowcolor'\">";
        	if(isset ($checked)){

            if(in_array($id, $checked)){
                print '<td><input type="checkbox" name="id[]" value="'.$id.'" checked="checked" /></td>';
            }
            else{
                print '<td><input type="checkbox" name="id[]" value="'.$id.'" /></td>';
            }
        }
        else if(isset ($editid))
        {
            if(in_array($id, $editid))
            {
                print '<td><input type="checkbox" name="id[]" value="'.$id.'" checked="checked" /></td>';
            }
            else
            {
                print '<td><input type="checkbox" name="id[]" value="'.$id.'" /></td>';
            }
        }
        else
        {
            print '<td><input type="checkbox" name="id[]" value="'.$id.'" /></td>';
        }


        print "<td><a href=\"viewerdisplay.php?id=$id\" target=\"frame2\" name=\"$id\">$fname&nbsp;</a></td>";
        print "<td><a href=\"viewerdisplay.php?id=$id\" target=\"frame2\">$lname&nbsp;</a></td>";
        print "<td><a href=\"viewerdisplay.php?id=$id\" target=\"frame2\">$numV&nbsp;</a></td>";
        print "<td><a href=\"viewerdisplay.php?id=$id\" target=\"frame2\">$flV&nbsp;</a></td>";
        print "<td><a href=\"viewerdisplay.php?id=$id\" target=\"frame2\">$mrV&nbsp;</a></td>";
        print "<td><a href=\"viewerdisplay.php?id=$id\" target=\"frame2\">$msg&nbsp;</a></td>";
        print "</tr>";
    }
       }
       echo '</tbody>
             </table>';
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
?>