<?php
session_start();
include("includes/config.php");
if (isset($_SESSION['login'])) {
    
$_SESSION['login'] = "";
$_SESSION['login']=="";
}
session_unset();
session_destroy();

?>
<script language="javascript">
document.location="index.php";
</script>
