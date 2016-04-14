<?php require_once('Classes/Globals.php');

    $globals = new Globals();

?>
<script>
	function chkForm(el){
		var valid = true;
		var oForm = el;
		for(var i=0; i < oForm.elements.length; i++) {
			var oField = oForm.elements[i];
			if (oField.value == ''){
				alert('You must fill in the '+oField.name+' field');
				valid = false;
			}
		}

		return valid;
	}
</script>
<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="css/jcarousel.css" rel="stylesheet" />
<link href="css/flexslider.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<!-- Theme skin -->
<link href="skins/default.css" rel="stylesheet" />

<header>
<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            	<a class="navbar-brand" href="index.php"><span>Sound</span>Health</a>
        </div>
    </div>
</div>
</header>
<!-- end header -->
    <body>
        <table width="80%" color="#000000" height="40%" border="0" align="center" cellpadding="0" cellspacing="0" style="font-size: 14px;">
       <tr><td>
        <form id="loginForm" name="loginForm" method="post" action="<?php echo $globals->userLogin; ?>" onsubmit="return chkForm(this)">
          <table style="background-color: #8FBCCE; border-width: 1px; height: 400px; width: 100%; font-size: 12px;" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
           <tr height="30%"><td width="33%">&nbsp;</td><td width="33%">&nbsp;</td><td width="33%">&nbsp;</td></tr>
           <tr height="8%"><td>&nbsp;</td><td>Please Login: </td><td>&nbsp;</td></tr>
           <tr height="8%"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
           <tr height="8%"><td>&nbsp;</td><td>Username: <input name="name" type="text" id="name" size="18" /></td> <td>&nbsp;</td></tr>
           <tr height="8%"><td>&nbsp;</td><td>Password:&nbsp; <input name="password" type="password" id="password" size="18" /></td> <td>&nbsp;
               <input name="client" type="hidden" id="client" value="<?php echo $globals->client; ?>" /></td></tr>
           <tr height="8%"><td>&nbsp;</td><td><input type="submit" value="Log In" name="submit" /></td><td>&nbsp;</td></tr>
           <tr height="30%"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
          </table>
        </form>
       </td></tr>
        <tr><td align="left"> &nbsp;&nbsp;v<?php echo $globals->version; ?></td></tr>
        </table>
    </body>
</html>
