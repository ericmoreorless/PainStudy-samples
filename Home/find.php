<?php
    /* VIEWTelligence - find.php
     * Author: Kevin Hawker
     * Description: Displays a form with a given list and Viewers.
     *              The User is able provide text to send
     *              email and SMS Messages to the selected Viewers.
     */
    session_start();
    if ($_SESSION['username'] == ''){
        $username = false;
        $loginuser = '';
    }else{
        $usertype = $_SESSION['user_type'];
        $username = $_SESSION['username'];
       // $loginuser = $_SESSION['userfname'];
    }    
    require_once('Classes/DataAccess.php');
    $id = $_POST['id'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $email = $_GET['email'];
    $company = $_GET['company'];
    $campaign= $_GET['campaign'];

    //This is where the group is recieved
    $flag = $_GET['group'];

    //For groups, the rest is irrelevant
    if(!isset ($fname))
    {
        $fname= $_POST['fname'];
    } if(!isset ($lname))
    {
        $lname= $_POST['lname'];
    } if(!isset ($email))
    {
        $email= $_POST['email'];
    } if(!isset ($company))
    {
        $company= $_POST['company'];
    }
    if(!isset ($campaign))
    {
        $campaign= $_POST['campaign'];
    }
    if(!isset ($flag))
    {
        $flag = $_POST['flag'];
    }
	
	require_once('Classes/Customer.php');
	if($id==NULL && $fname==NULL && $lname==NULL && $email==NULL && $company==NULL && $flag==NULL && $campaign==NULL){
		$_SESSION['find'] = NULL;
        header( 'Location: viewertable.php' );
        die();
    }
	$findarray = array();
    $findarray['fname'] = $fname;
    $findarray['lname'] = $lname;
    $findarray['email'] = $email;
    $findarray['company'] = $company;
    $findarray['flag'] = $flag;
    $findarray['campaign'] = $campaign;
    $_SESSION['find'] = $findarray;


    header( 'Location: viewertable.php' );
    die();
    ?>