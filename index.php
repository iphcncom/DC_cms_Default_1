<?php 
/*
* 网站首页部分
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="content">
<div id="contentleft">
   <?php index_show();?>
   <div class="post">
    <ul>
    <?php index_list(1,10);?>
  </ul>
   </div>

   <div class="post">
    <ul>
    <?php index_list(2,10);?>
	</ul>
   </div>

   <div class="post">
    <ul>
    <?php index_list(3,10);?>
	</ul>
   </div>

   <div class="post">
    <ul>
    <?php index_list(4,10);?>
	</ul>
   </div>

</div><!-- end #contentleft-->
