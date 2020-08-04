<?php
namespace Xiaoshuo\Controller;
use Think\Controller;
class IndexController extends Controller {
public function index(){
	
	if(S('index')){
		$url = S('index');
	}else{
		$url=curl(c('COPY_FROM.XSURL'));
		S('index',$url,10000);
	}
	preg_match_all("/<a href=\"(.*?)\"><img src=\"(.*?)\" alt=\"(.*?)\".*?><\/a>/",$url,$item);
	preg_match_all("/<dd>(.*?)<\/dd>/",$url,$desc);
	preg_match_all("/<li><a href=\"(.*?)\">(.*?)<\/a>(.*?)<\/li>/",$url,$data);
	foreach ($data[2] as $k => $v) {
		  if($k>11){
			$article[0]['name'][]=$v;
			$article[0]['url'][]=str_replace('/','',$data[1][$k]);
		}
	}
	foreach ($item[1] as $k => $v) {
			$titleurl[]=str_replace('/','',$v);
		
	}
	$readings=[];
	$data=cookie('readings');
	foreach ($data as $k => $v) {
		$reading=explode(',',$v);
		$res=explode('_',$reading[0]);
		$info['father']=$reading[0];
		$info['aname']=$reading[1];
		$info['img']=c('COPY_FROM.XSURL').'/cover/'.$res[0].'/'.$res[1].'/'.$res[1].'s.jpg';
		$readings[]=$info;
	}
	$this -> assign('readings',$readings);
	$this -> assign('titlename',$item[3]);
	$this -> assign('titleimg',$item[2]);
	$this -> assign('titleurl',$titleurl);
	$this -> assign('desc',$desc[1]);
	$this -> assign('article',$article);
	$this->display();

}
}
