<?php
namespace Xiaoshuo\Controller;
use Think\Controller;
class SearchController extends Controller {
	public function search(){
		if (IS_GET) {
			$keyword=I('keyword');
			$p=I('p');
			$Numpage=($p!='') ? '&page='.$p : '';
			if ($keyword=='') {
				return;
			}
			$url='https://www.xsbiquge.com/search.php?keyword='.urlencode($keyword).$Numpage;
			$url=curl($url);
			preg_match_all("/<span.*?>(.*?)<\/span>/",$url,$data);
			preg_match_all("/<p class=\"result-game-item-desc\">(.*?)<\/p>/",$url,$desc);
			preg_match_all("/<img src=\"(.*?)\" class.*?>/",$url,$img);
			preg_match_all("/<a cpos=\"img\" href=\"(.*?)\"/",$url,$listArticle);
			preg_match_all("/<a href=\".*?page=(.*?)\" title=\"/",$url,$page);
			$details = array_chunk($data[1], 7);
			/*文章信息*/
			/*最新章节*/
			foreach ($listArticle[1] as $k => $v) {
				if(strpos($v,'https://www.xsbiquge.com') !== false){ 
					$listArticle[$k] = str_replace('https://www.xsbiquge.com/','',$v);
					$listArticle[$k] = str_replace('/','',$listArticle[$k]);
				}else{
					$listArticle[$k]=$v;
				}
			}
			$count=count($page[1]);
			$count=$pagCount=$page[1][$count-1]*10;//分页数
			$Page=new \Think\Page($count,10);
			$Page -> rollPage = 5;
			$Page -> lastSuffix = false;
			$Page -> setConfig('prev','上一页');
			$Page -> setConfig('next','下一页');
			$Page -> setConfig('last','末页');
			$Page -> setConfig('first','首页');
			$show = bootstrap_page_style($Page->show());
			$this -> assign('page',$show);
			$this -> assign('listArticle',$listArticle);
			$this -> assign('img',$img[1]);
			$this -> assign('desc',$desc[1]);
			$this -> assign('details',$details);
			//$this -> assign('article',$article);
			$this->display();
		}

	}
}