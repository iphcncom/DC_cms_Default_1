<?php
/*
Template Name:DC_cms_Default_1
Description:根据默认模板修改的CMS模板...
Version:1.1
Author:emlog & 舞城
Author Url:http://www.emlog.net  & http://www.iphcn.com
Sidebar Amount:1
ForEmlog:5.1.2
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
if(function_exists('emLoadJQuery')) {
    emLoadJQuery();
};
$cssTime = filemtime(TEMPLATE_PATH.'main.css');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="generator" content="emlog" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link href="<?php echo TEMPLATE_URL; ?>main.css?t=<?php echo date('YmdGis',$cssTime) ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/1cms_show.js"></script>
<?php doAction('index_head'); ?>
</head>
<body>
<div id="wrap">
  <div id="header">
    <div class="headernone">
    <h1><?php echo $blogname; ?></h1>
    <h3><?php echo $bloginfo; ?></h3>
  </div>
	<div class="logo"><a href="<?php echo BLOG_URL; ?>"><img src="<?php echo TEMPLATE_URL; ?>images/logo.gif"/></a></div>
	<div id="banner">
<script type="text/javascript">
/*468*60，创建于2011-10-31*/
var cpro_id = "u661513";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>
</div>
  </div>
  
  <div id="nav"><?php blog_navi();?></div>

  
