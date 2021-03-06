<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);
    $description = new Typecho_Widget_Helper_Form_Element_Textarea('description', NULL, 'test', _t('随机描述,一行一个'), _t('原站点描述已失效'));
    $form->addInput($description);

    
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('ShowRecentPosts' => _t('显示最新文章'),
    'ShowRecentComments' => _t('显示最近回复'),
    'ShowCategory' => _t('显示分类'),
    'ShowArchive' => _t('显示归档'),
    'ShowOther' => _t('显示其它杂项')),
    array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));
    
    $form->addInput($sidebarBlock->multiMode());
}


/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/

//判断是否存在图片
function is_img($thiz){
    $content = $thiz->content;
    $ret = preg_match("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $content, $thumbUrl);
    if($ret === 1 && count($thumbUrl) == 2){
        return 1;
    }else{
        return 0;
    }
}


//获取文章中第一张图片
function img_postthemb($thiz){
    $content = $thiz->content;
    $ret = preg_match("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $content, $thumbUrl);
    if($ret === 1 && count($thumbUrl) == 2){
        return "<div class=post-themb style=background-image:url(" . $thumbUrl[1] . ")><a href=" . $thiz->permalink . "></a></div>";
    }else{
        return "";
    }
}

//获取文章中的视频
function video_postthemb($thiz){
    $content = $thiz->content;
    $ret = preg_match("/\<iframe.*>.*\<\/iframe>/i", $content, $thumbUrl);
    if($ret === 1 && count($thumbUrl) == 1){
        return "<div class=post-themb_video>" . $thumbUrl[0] . "</div>";
    }else{
        return "";
    }
}