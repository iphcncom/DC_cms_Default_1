<?php 
/*
* 网站首页部分
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<?php
//index分类列表
  function index_show(){
		$log_Model = new Log_Model;
		$logs = $log_Model->getLogsForHome("and top='y' ORDER BY `date` DESC", 1, 4);?>
<div id="zSlider">
     <div id="picshow">
	  <div id="picshow_img">
			<ul>
			<?php foreach($logs as $row){
			preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $row['excerpt'], $img);
	        $imgext = !empty($img[1]) ? $img[1][0] : '';
            preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $row['content'], $img);
	?>
	<li>
	 <a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" target="_blank">
		<img src="<?php if($imgext):{ echo $imgext;} else:{ echo $imgsrc;} endif;?>" alt="<?php echo $row['title'];?>"></a>
	</li>
	<?php };?>
			</ul>
		</div>
		<div id="picshow_tx">
			<ul>
	<?php foreach($logs as $row){?>
		<li>
		<h3><a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" target="_blank">
		<?php echo $row['title'];?></a></h3>
		<p><?php echo extractHtmlData($row['content'],50);?></p>
		</li>
	<?php };?> 
			</ul>
		</div>
	</div>
	<div id="select_btn">
		<ul>
	<?php foreach($logs as $row){
			preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $row['excerpt'], $img);
	        $imgext = !empty($img[1]) ? $img[1][0] : '';
            preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $row['content'], $img);
	?>
	<li>
	<a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" target="_blank">
		<img src="<?php if($imgext):{ echo $imgext;} else:{ echo $imgsrc;} endif;?>" alt="<?php echo $row['title'];?>">
		<span class="select_text"><?php echo $row['title'];?></span>
		 <span class="select_date">2013/01/16</span></a>
	</li>
	<?php }?>
		</ul>
	</div>	
  </div>
<?php }?>
