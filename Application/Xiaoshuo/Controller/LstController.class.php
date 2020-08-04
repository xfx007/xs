<?php
namespace Xiaoshuo\Controller;
use Think\Controller;
class LstController extends Controller {
	public function lst(){
		if (IS_GET) {
			$id = I('id');
			if (!S('info'.$id)) {
				$url = c('COPY_FROM.XSURL').'/'.$id.'/';
				$url = curl($url);
				if (!S('catalogue'.$id)) {
					preg_match_all("/<dd><a href=\"(.*?)\">(.*?)<\/a><\/dd>/",$url,$data);
					preg_match_all("/<h1>(.*?)<\/h1>/",$url,$title);
					foreach ($data[1] as $k => $v) {
						$data[1][$k] = substr($v,1);
					}
					$num=count($data[1])-1;
					$data[1][$num]=str_replace('"',"",$data[1][$num]);
					$data[1][$num]=str_replace(' ',"",$data[1][$num]);
					$data[1][$num] = substr($data[1][$num],0,strrpos($data[1][$num],'class='));
					$listArticle['name']  = $data[2];
					$listArticle['url']   = $data[1];
					$listArticle['title'] = $title[1];
					// session('lst.catalogue'.$id,$listArticle);
					S('catalogue'.$id,$listArticle,10000);
				}
				preg_match_all("/<img alt=\"(.*?)\" src=\"(.*?)\" .*?>/",$url,$item);
				preg_match_all("/<meta property=\"og:.*?\" content=\"(.*?)\"\/>/",$url,$data);
				preg_match_all("/[^<\/dd>]<dd><a href=\"(.*?)\">.*?<\/a><\/dd>/",$url,$oneArticle);//第一篇文字
				foreach ($data[1] as $k => $v) {
					if(strpos($v,c('COPY_FROM.XSURL')) !== false){ 
						$details[] = str_replace(c('COPY_FROM.XSURL'),'',$v);
					}else{
						$details[] = $v;
					}
				}
				$details[0] = substr($oneArticle[1][0],1);
				$details[7] = str_replace('/','',$details[7]);
				$details[8] = str_replace('/','',$details[7]);
				// session('lst.info'.$id,$details);
				S('info'.$id,$details,10000);
			}
			// $details = session('lst.info'.$id);
			// $new = session('lst.catalogue'.$id);
			$details = S('info'.$id);
			$new = S('catalogue'.$id);
			//查询是否阅读过
			$reading = 0;
			if (cookie('reading_'.$id)) {
				$reading = cookie('reading_'.$id);
				$number=array_search($reading['son'], $new['url']);
				$reading['reading_name'] = $new['name'][$number];
			}
			//var_dump($reading);
			$newLst['url']=array_slice(array_reverse($new['url']),0,6);
			$newLst['name']=array_slice(array_reverse($new['name']),0,6);
			$this -> assign('newLst',$newLst);
			$this -> assign('data',$details);
			$this -> assign('reading',$reading);
			$this -> assign('id',$id);
		}
			$this -> display();
	}
	//目录
	public function catalogue(){
		$p = I('post.p');
		$p = ($p != 1)?$p*30:0;
		$id=I('id');
		$id=($id!='')?$id:I('post.Aid');
		if (S('catalogue'.$id)) {
			$data[2]     = S('catalogue'.$id)['name'];
			$data[1]     = S('catalogue'.$id)['url'];
			$listArticle = S('catalogue'.$id);
		}
		$count=count($data[2]);
		if ($p >= $count) {
			$p=$p-30;
		}
		$Page=new \Think\Ajaxpage($count,30);
		$Page -> rollPage = 5;
		$Page -> lastSuffix = false;
		$Page -> setConfig('id',$id);
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('last','末页');
		$Page -> setConfig('first','首页');
		$show = bootstrap_page_style($Page->show());
		$list = array_slice($data[2],$p,$Page->listRows);
		$listUrl = array_slice($data[1],$Page->firstRow,$Page->listRows);
	  	//dump($list);
		if (IS_POST) {
			$this->ajaxReturn(array('sta'=>1,'list'=>$list,'listUrl'=>$listUrl,'show'=>$show));
		}  
	   // dump($listUrl);
		$this -> assign('list',$list);// 赋值数据集
		$this -> assign('page',$show);// 赋值分页输出
		$this -> assign('listUrl',$listUrl);
		$this -> assign('listArticle',$listArticle);
		$this -> display();
	}
	public function delSession(){
		$id=I('id');
		session('lst.catalogue'.$id,null); // 删除name
		session('lst.info'.$id,null); // 删除name
		echo "<script> window.location.href ='/Xiaoshuo/Lst/lst.html?id={$id}';</script>";
	}

}