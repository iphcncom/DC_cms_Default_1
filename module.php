<?php 
/*
* 侧边栏组件、页面模块
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
//widget：blogger
function widget_blogger($title){
  global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="bloggerinfo">
	<div id="bloggerinfoimg">
	<?php if (!empty($user_cache[1]['photo']['src'])): ?>
	<img src="<?php echo BLOG_URL.$user_cache[1]['photo']['src']; ?>" width="<?php echo $user_cache[1]['photo']['width']; ?>" height="<?php echo $user_cache[1]['photo']['height']; ?>" alt="blogger" />
	<?php endif;?>
	</div>
	<p><b><?php echo $name; ?></b>
	<?php echo $user_cache[1]['des']; ?></p>
	</ul>
	</li>
<?php }?>
<?php
//widget：日历
function widget_calendar($title){ ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<div id="calendar">
	</div>
	<script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script>
	</li>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogtags">
	<?php foreach($tag_cache as $value): ?>
		<span style="font-size:<?php echo $value['fontsize']; ?>pt; line-height:30px;">
		<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇日志"><?php echo $value['tagname']; ?></a></span>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogsort">
	<?php foreach($sort_cache as $value): ?>
	<li>
	<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
	<a href="<?php echo BLOG_URL; ?>rss.php?sort=<?php echo $value['sid']; ?>"><img src="<?php echo TEMPLATE_URL; ?>images/rss.png" alt="订阅该分类"/></a>
	</li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：最新碎语
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="twitter">
	<?php foreach($newtws_cache as $value): ?>
	<?php $img = empty($value['img']) ? "" : '<a title="查看图片" class="t_img" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank">&nbsp;</a>';?>
	<li><?php echo $value['t']; ?><?php echo $img;?><p><?php echo smartDate($value['date']); ?></p></li>
	<?php endforeach; ?>
    <?php if ($istwitter == 'y') :?>
	<p><a href="<?php echo BLOG_URL . 't/'; ?>">更多&raquo;</a></p>
	<?php endif;?>
	</ul>
	</li>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newcomment">
	<?php
	foreach($com_cache as $value):
	$url = Url::comment($value['gid'], $value['page'], $value['cid']);
	?>
	<li id="comment"><?php echo $value['name']; ?>
	<br /><a href="<?php echo $url; ?>"><?php echo $value['content']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：最新日志
function widget_newlog($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newlog">
	<?php foreach($newLogs_cache as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：热门日志
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="hotlog">
	<?php foreach($randLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：随机日志
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="randlog">
	<?php foreach($randLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="logserch">
	<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
	<input name="keyword" class="search" type="text" />
	</form>
	</ul>
	</li>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="record">
	<?php foreach($record_cache as $value): ?>
	<li><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul>
	<?php echo $content; ?>
	</ul>
	</li>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="link">
	<?php foreach($link_cache as $value): ?>
	<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul>
	<?php 
	foreach($navi_cache as $value):
		if($value['url'] == 'admin' && (ROLE == 'admin' || ROLE == 'writer')):
			?>
			<li class="common"><a href="<?php echo BLOG_URL; ?>admin/write_log.php">写日志</a></li>
			<li class="common"><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li class="common"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
		$value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
		$current_tab = (BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url']) ? 'current' : 'common';
		?>
		<li class="<?php echo $current_tab;?>"><a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a></li>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//blog：置顶
function topflg($istop){
	$topflg = $istop == 'y' ? "<img src=\"".TEMPLATE_URL."/images/import.gif\" title=\"置顶日志\" /> " : '';
	echo $topflg;
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == 'admin' || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
	分类：<a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php endif;?>
<?php }?>
<?php
//blog：日志标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '标签:';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "	<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}
}
?>
<?php
//blog：日志作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：相邻日志
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	&laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>
		|
	<?php endif;?>
	<?php if($nextLog):?>
		 <a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>&raquo;
	<?php endif;?>
<?php }?>
<?php
//blog：引用通告
function blog_trackback($tb, $tb_url, $allow_tb){
    if($allow_tb == 'y' && Option::get('istrackback') == 'y'):?>
	<div id="trackback_address">
	<p>引用地址: <input type="text" style="width:350px" class="input" value="<?php echo $tb_url; ?>">
	<a name="tb"></a></p>
	</div>
	<?php endif; ?>
	<?php foreach($tb as $key=>$value):?>
		<ul id="trackback">
		<li><a href="<?php echo $value['url'];?>" target="_blank"><?php echo $value['title'];?></a></li>
		<li>BLOG: <?php echo $value['blog_name'];?></li><li><?php echo $value['date'];?></li>
		</ul>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>
	<a name="comments"></a>
	<p class="comment-header"><b>评论：</b></p>
	<?php endif; ?>
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<div class="comment" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo getGravatar($comment['mail']); ?>" /></div><?php endif; ?>
		<div class="comment-info">
			<b><?php echo $comment['poster']; ?> </b><br /><span class="comment-time"><?php echo $comment['date']; ?></span>
			<div class="comment-content"><?php echo $comment['content']; ?></div>
			<div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div>
		</div>
		<?php blog_comments_children($comments, $comment['children']); ?>
	</div>
	<?php endforeach; ?>
    <div id="pagenavi">
	    <?php echo $commentPageUrl;?>
    </div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<div class="comment comment-children" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo getGravatar($comment['mail']); ?>" /></div><?php endif; ?>
		<div class="comment-info">
			<b><?php echo $comment['poster']; ?> </b><br /><span class="comment-time"><?php echo $comment['date']; ?></span>
			<div class="comment-content"><?php echo $comment['content']; ?></div>
			<?php if($comment['level'] < 4): ?><div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div><?php endif; ?>
		</div>
		<?php blog_comments_children($comments, $comment['children']);?>
	</div>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<div id="comment-place">
	<div class="comment-post" id="comment-post">
		<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
		<p class="comment-header"><b>发表评论：</b><a name="respond"></a></p>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<?php if(ROLE == 'visitor'): ?>
			<p>
				<input type="text" name="comname" maxlength="49" value="<?php echo $ckname; ?>" size="22" tabindex="1">
				<label for="author"><small>昵称</small></label>
			</p>
			<p>
				<input type="text" name="commail"  maxlength="128"  value="<?php echo $ckmail; ?>" size="22" tabindex="2">
				<label for="email"><small>邮件地址 (选填)</small></label>
			</p>
			<p>
				<input type="text" name="comurl" maxlength="128"  value="<?php echo $ckurl; ?>" size="22" tabindex="3">
				<label for="url"><small>个人主页 (选填)</small></label>
			</p>
			<?php endif; ?>
			<p><textarea name="comment" id="comment" rows="10" tabindex="4"></textarea></p>
			<p><?php echo $verifyCode; ?> <input type="submit" id="comment_submit" value="发表评论" tabindex="6" /></p>
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		</form>
	</div>
	</div>
	<?php endif; ?>
<?php }?>
<?php
//index:分类
function index_sort($logsid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$logsid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$logsid]['id']); ?>"><?php echo $log_cache_sort[$logsid]['name']; ?></a>
	<?php endif;?>
<?php }?>
<?php
//index:分类列表
	function index_list($sort,$num){
		$log_Model = new Log_Model;
		$logs = $log_Model->getLogsForHome("and sortid=$sort and top!='y' ORDER BY `date` DESC", 1, $num);
		$logs1 = array_slice($logs,0,1);
		foreach($logs as $val)?>
		<ul>
		<h3><?php echo index_sort($val['gid']);?></h3>
		<?php foreach($logs1 as $row){
		    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $row['excerpt'], $img);
	        $imgext = !empty($img[1]) ? $img[1][0] : '';
            preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $row['content'], $img);
			$imgsrc = !empty($img[1]) ? $img[1][0] : '';?>
			<ol>
			<div id="post_img">
			<dl>
	 <a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" target="_blank">
		<img src="<?php if($imgext):{ echo $imgext;} elseif($imgsrc):{ echo $imgsrc;} else:{ echo ''.thumb_images_src(rand(1,50)).'';} endif;?>" alt="<?php echo $row['title'];?>"></a>
	         </dl>
		     </div>
			 <div id="post_tx">
		      <dl>
		        <h4><a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" target="_blank">
		              <?php echo $row['title'];?></a></h4>
		          <p><?php echo extractHtmlData($row['content'],45);?></p>
		      </dl>
		     </div>
			</ol>
			<?php }?>
			</ul>
		<?php $logs2 = array_slice($logs,1,$num);
		      foreach($logs2 as $row){
	?>
	<li><a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" target="_blank">
					<span><?php echo $row['title'];?></span></a></li>
	<?php }
};?>
<?php
//index:焦点图
function index_show(){
		$log_Model = new Log_Model;
		$logs = $log_Model->getLogsForHome("and top!='y' ORDER BY `views` DESC", 1, 4);?>
<div id="zSlider">
     <div id="picshow">
	  <div id="picshow_img">
			<ul>
			<?php foreach($logs as $row){
			preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $row['excerpt'], $img);
	        $imgext = !empty($img[1]) ? $img[1][0] : '';
            preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $row['content'], $img);
			$imgsrc = !empty($img[1]) ? $img[1][0] : '';
	?>
	<li>
	 <a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" target="_blank">
		<img src="<?php if($imgext):{ echo $imgext;} elseif($imgsrc):{ echo $imgsrc;} else:{ echo ''.thumb_images_src(rand(1,50)).'';} endif;?>" alt="<?php echo $row['title'];?>"></a>
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
			$imgsrc = !empty($img[1]) ? $img[1][0] : '';
	?>
	<li>
	<a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" target="_blank">
		<img src="<?php if($imgext):{ echo $imgext;} elseif($imgsrc):{ echo $imgsrc;} else:{ echo ''.thumb_images_src(rand(1,50)).'';} endif;?>" alt="<?php echo $row['title'];?>">
		<span class="select_text"><?php echo $row['title'];?></span>
		 <span class="select_date"><?php echo gmdate('m-d H:i', $row['date']);?>
</span></a>
	</li>
	<?php }?>
		</ul>
	</div>	
  </div>
<?php }?>
<?php
//预备缩略图
function thumb_images_src($thumb_num){
	if($thumb_num == '1'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/21/658553312013021821513025THX.jpg';
	}if($thumb_num == '2'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/21/658553312013021821513086THX.jpg';
	}if($thumb_num == '3'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/21/658553312013021821513390THX.jpg';
	}if($thumb_num == '4'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/21/658553312013021821513070THX.jpg';
	}if($thumb_num == '5'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/21/658553312013021821505022THX.jpg';
	}if($thumb_num == '6'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/21/658553312013021821505036THX.jpg';
	}if($thumb_num == '7'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/21/658553312013021821505159THX.jpg';
	}if($thumb_num == '8'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/21/65855331201302182150535THX.jpg';
	}if($thumb_num == '9'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/21/658553312013021821510176THX.jpg';
	}if($thumb_num == '10'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/21/658553312013021821505387THX.jpg';
	}if($thumb_num == '11'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/21/658553312013021821505820THX.jpg';
	}if($thumb_num == '12'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/21/658553312013021821485384THX.jpg';
	}if($thumb_num == '13'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/21/658553312013021821485470THX.jpg';
	}if($thumb_num == '14'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/21/658553312013021821485429THX.jpg';
	}if($thumb_num == '15'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/21/658553312013021821490180THX.jpg';
	}if($thumb_num == '16'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/21/658553312013021821490272THX.jpg';
	}if($thumb_num == '17'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/21/658553312013021821485586THX.jpg';
	}if($thumb_num == '18'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/21/658553312013021821490298THX.jpg';
	}if($thumb_num == '19'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130217/22/6585533120130217224417010.jpg';
	}if($thumb_num == '20'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130217/22/6585533120130217224015079.jpg';
	}if($thumb_num == '21'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823410098THX.jpg';
	}if($thumb_num == '22'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/23/65855331201302182341002THX.jpg';
	}if($thumb_num == '23'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/23/65855331201302182341216THX.jpg';
	}if($thumb_num == '24'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/23/658553312013021823412121THX.jpg';
	}if($thumb_num == '25'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823451562THX.jpg';
	}if($thumb_num == '26'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/65855331201302182345166THX.jpg';
	}if($thumb_num == '27'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823453270THX.jpg';
	}if($thumb_num == '28'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823453213THX.jpg';
	}if($thumb_num == '29'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/23/65855331201302182345491THX.jpg';
	}if($thumb_num == '30'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/23/658553312013021823454959THX.jpg';
	}if($thumb_num == '31'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/23/658553312013021823462275THX.jpg';
	}if($thumb_num == '32'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823463592THX.jpg';
	}if($thumb_num == '33'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823465077THX.jpg';
	}if($thumb_num == '34'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823470239THX.jpg';
	}if($thumb_num == '35'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/23/658553312013021823471762THX.jpg';
	}if($thumb_num == '36'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823482448THX.jpg';
	}if($thumb_num == '37'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823482413THX.jpg';
	}if($thumb_num == '38'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/23/658553312013021823483760THX.jpg';
	}if($thumb_num == '39'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823483788THX.jpg';
	}if($thumb_num == '40'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/65855331201302182348497THX.jpg';
	}if($thumb_num == '41'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/23/658553312013021823485059THX.jpg';
	}if($thumb_num == '42'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/23/658553312013021823490291THX.jpg';
	}if($thumb_num == '43'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823490156THX.jpg';
	}if($thumb_num == '44'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823491360THX.jpg';
	}if($thumb_num == '45'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/23/658553312013021823491596THX.jpg';
	}if($thumb_num == '46'){
		echo'http://img14.poco.cn/mypoco/myphoto/20130218/23/658553312013021823492478THX.jpg';
	}if($thumb_num == '47'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823495941THX.jpg';
	}if($thumb_num == '48'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130218/23/658553312013021823495981THX.jpg';
	}if($thumb_num == '49'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130219/22/65855331201302192215565THX.jpg';
	}if($thumb_num == '50'){
		echo'http://img13.poco.cn/mypoco/myphoto/20130219/22/658553312013021922184088THX.jpg';
	}
}?>
