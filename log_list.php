<?php 
/*
* 日志列表部分
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
    if($pageurl == Url::logPage()){
        include View::getView('index');
}else{?>
<div id="content">
<div id="contentleft">
<?php doAction('index_loglist_top'); ?>
<?php foreach($logs as $value): 
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['log_description'], $img);
  $imgext = !empty($img[1]) ? $img[1][0] : '';
	preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $img);
	$imgsrc = !empty($img[1]) ? $img[1][0] : '';?>
	<h2><?php topflg($value['top']); ?><a href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a></h2>
	<p class="date">作者：<?php blog_author($value['author']); ?> 发布于：<?php echo gmdate('Y-n-j G:i l', $value['date']); ?> 
	<?php blog_sort($value['logid']); ?> 
	<?php editflg($value['logid'],$value['author']); ?>
	</p>
	<div class="postinfo">
	<a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>">
		<img title="<?php echo $value['log_title']; ?>" 
		src="<?php if($imgext):{ echo $imgext;} elseif($imgsrc):{ echo $imgsrc;} else:{ echo ''.thumb_images_src(rand(1,50)).'';} endif;?>" alt="<?php echo $value['log_title']; ?>" target="_blank"></a>
	<?php echo extractHtmlData($value['content'],200);?>
	</div>
	<p class="count">
	<?php blog_tag($value['logid']); ?>
	<a href="<?php echo $value['log_url']; ?>#comments">评论(<?php echo $value['comnum']; ?>)</a>
	<a href="<?php echo $value['log_url']; ?>#tb">引用(<?php echo $value['tbcount']; ?>)</a>
	<a href="<?php echo $value['log_url']; ?>">浏览(<?php echo $value['views']; ?>)</a>
	</p>
	
	<div style="clear:both;"></div>
<?php endforeach; ?>

<div id="pagenavi">
	<?php echo $page_url;?>
</div>

</div><!-- end #contentleft-->
<?php }
 include View::getView('side');
 include View::getView('footer');
?>
