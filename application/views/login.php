<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Spark | Powered by Spark</title>
<link rel="stylesheet" type="text/css" href="templates/sources/style.css" />
<script type="text/javascript" src="templates/sources/jquery.min.js"></script>
<script type="text/javascript" src="templates/sources/ddaccordion.js"></script>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='templates/sources/images/plus.gif' class='statusicon' />", "<img src='templates/sources/images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>

<script type="text/javascript" src="templates/sources/jconfirmaction.jquery.js"></script>
<script type="text/javascript">

	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});

</script>

<script language="javascript" type="text/javascript" src="templates/sources/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="templates/sources/niceforms-default.css" />

</head>
<body>
<div id="main_container">

	<div class="header_login">
    <div class="logo"><a href="#"><img src="images/logo.gif" alt="" title="" border="0" /></a></div>

    </div>


         <div class="login_form">

         <h3>Spark Login</h3>
         <div style=""> <?php echo (isset($_GET['status_msg'])) ? urldecode($_GET['status_msg']) :""; ?></div>
         <a href="#" class="forgot_pass">Forgot password</a>

         <form action="<?php echo base_url()."login/loginUser"; ?>" method="post" class="niceform">

                <fieldset>
                    <dl>
                        <dt><label for="email">Username:</label></dt>
                        <dd><input type="text" name="txtUsername" id="" size="54" class="inputText" /></dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Password:</label></dt>
                        <dd ><input type="password" name="txtPassword" id="" size="54" class="inputText"/></dd>
                    </dl>

                    <dl>
                        <dt><label></label></dt>
                        <dd>
                    <input type="checkbox" name="interests[]" id="" value="" /><label class="check_label">Remember me</label>
                        </dd>
                    </dl>

                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Login" />
                     </dl>

                </fieldset>

         </form>
         </div>



    <div class="footer_login">

    	<div class="left_footer_login">Login Panel | Powered by <a href="#">Spark</a></div>
    	<div class="right_footer_login"></div>

    </div>

</div>
    <style type="text/css">
        .NFText,.NFhidden {
            border:1px solid #7FBFFF !important;

        }
</style>

<?php /*error_reporting(0);
include("configs/globalLoader.php");
include("maincontroller/login.php");
$classDetails = "globalconfigClass";
AutoloadClasses::__autoload($classDetails);
$base_url = LoadGlobalCofig::base_url("maincontroller/login");
$action = (isset($_POST['submit'])) ? "submit" : (isset($_GET['logout']) ? "logout" : "");
LoadGlobalCofig::show($_POST);
switch($action) {
  case 'submit':
      echo "dfgfd";exit;
                     $userdetails = login::loginUser($_POST);
                     $status_msg = LoadGlobalCofig::flashMsg("Successfully loggedin !!");

                        if($userdetails == "error_msg") {
                            echo "<span style='color:red;'>"."Please Check Login Credentials!!"."</span>";
                        } else {
                                //LoadGlobalCofig::show($userdetails);
                                session_start();
                                $_SESSION['username'] = $userdetails[0]['username'];
                                $_SESSION['password'] = $userdetails[0]['password'];
                                $_SESSION['email'] = $userdetails[0]['email'];
                                $_SESSION['usertype'] = $userdetails[0]['usertype'];
                                show($_SESSION);
                                LoadGlobalCofig::redirect("index.php/user_details/index");
                              //header("Location: http://localhost/smarty/application/spark/index.php?success_msg='".urlencode($status_msg)."'");
                        }
        break;

      case 'logout':
                        session_start();
                        login::logout();
          break;


}
 *
 * */

?>

</body>
</html>