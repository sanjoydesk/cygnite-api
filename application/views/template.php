<?PHP
//echo $viewpage;exit;
//show($data);
//require("templates/sources/scripts.php");
require_once('../../libs/Smarty.class.php');
$smarty = new Smarty;
//$smarty->force_compile = true;
$smarty->debugging = TRUE;
$smarty->caching = FALSE;
$smarty->cache_lifetime = 120;

//$smarty->clear_cache('spark.tpl');
//$smarty->clear_all_cache();

$username =  (isset($_SESSION['username'])) ? ucfirst($_SESSION['username']) : '';
$usertype = (isset($_SESSION['usertype'])) ? $_SESSION['usertype'] : '';
$smarty->assign("username",$username);
$smarty->assign("usertype",$usertype);


$status_msg =  (isset($_GET['success_msg'])) ? urldecode($_GET['success_msg']) : '';
$smarty->assign("success",$status_msg);
$directory = $_SERVER['DOCUMENT_ROOT']."smarty/application/spark/templates/";
$directory = str_replace('/', '\\', $directory);
$uristring = explode('/',($_SERVER['REQUEST_URI']));
$indexCount = array_search('index.php',$uristring);

if(empty($uristring)) {
    LoadGlobalCofig::redirect("index.php");
}
urlstucture();

$username =  (isset($_SESSION['username'])) ? ucfirst($_SESSION['username']) : '';
$usertype = (isset($_SESSION['usertype'])) ? $_SESSION['usertype'] : '';
$smarty->assign("username",$username);
$smarty->assign("usertype",$usertype);
$status_msg =  (isset($_GET['success_msg'])) ? urldecode($_GET['success_msg']) : '';
$smarty->assign("success",$status_msg);

    if (!empty($details)) {
        $smarty->assign('data',$details);
    }

    try {
        //$smarty->fetch($directory.'spark.tpl');
        if(LoadGlobalCofig::chkIsLoggedin() =="loggedin" ) {
             //$cpage = $viewpage;
            //$cpage = (isset($_REQUEST['cpage']) ? $_REQUEST['cpage'] : $cpageTPL);
           // $cpage = LoadGlobalCofig::getCPAGE_URL($cpage);
            $smarty->assign("viewpage",$viewpage);

        }
        $smarty->display($directory.'spark.tpl');
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
?>
