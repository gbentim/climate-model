<?php
	$path='phptabs-files';
	include $path."/includes/tabs.php";
	$t=new Tabs($path);

	$sel=$_REQUEST['sel']=='' ? 0 : $_REQUEST['sel'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Tabs</title>
<?php $t->include_css(); ?>
</head>

<body>
<div class="container">
<h2>PHP TABS Demo</h2>            	
<?php					
	$t->add_tabs('Index','Home Page Content');
	$t->add_tabs('Page 1','Page 1 Content');
	$t->add_tabs('Page 2','Page 2 Content');
	$t->add_tabs('Page 3','Page 3 Content will come here <br /> This is due to line break tab.');
	$t->add_tabs('Page 4','Page 4 Content will come here');
	$t->add_tabs('Page 5','Page 5 Content will come here');

	$t->render_tabs($sel);
	$t->render_content($sel);
?>
</div>   
</body>
</html>