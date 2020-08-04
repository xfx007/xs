<?php
namespace Xiaoshuo\Controller;
use Think\Controller;
class ReadController extends Controller {
	public function read(){
		if (IS_GET) {
			$id=I('id');
			if(strpos($id,'html') !== false){ 
			}else{
				$id = str_replace('/','',$id);
				echo '<script language="JavaScript">;alert("这是最后一章啦!");location.href="/Xiaoshuo/Lst/lst.html?id='.$id.'";</script>;';
				exit();
			}
			$url=c('COPY_FROM.XSURL').'/'.$id;
			$url=curl($url);
			preg_match_all("/<div id=\"content\">(.*?)<\/div>/",$url,$content);
			preg_match_all("/<meta name=\"keywords\" content=\"(.*?)\" \/>/",$url,$title);
			preg_match_all("/<a href=\"(.*?)\">上一章<\/a> &larr; <a href=\"(.*?)\">章节目录<\/a> &rarr; <a href=\"(.*?)\">下一章<\/a>/",$url,$pag);
			for ($i=1; $i < 4; $i++) { 
				$readPag[]=substr($pag[$i][0],1);
			}
			$readPag[1]=substr($readPag[1], 0, -1);
			if(strpos($content[1][0],'w&nbsp;Ww.XxBi&nbsp;Quge.c0m') !== false || strpos($content[1][0],'新笔趣阁') !== false){ 
				$content=str_replace('w&nbsp;Ww.XxBi&nbsp;Quge.c0m',c('COPY_FROM.MEURL'),$content[1][0]);
				$content=str_replace('新笔趣阁',c('COPY_FROM.TITLE'),$content);
			}else{
		 		$content=$content[1][0];
			}		
			$aname=explode(',',$title[1][0]);
			$res[]=$readPag[1];
			$res[]=$aname[1];
			$readings=implode(',',$res);
			$data = cookie('readings');
			if (isset($data)) {
				if (!in_array($readings, $data)) {
					$data[]=$readings;
					cookie('readings',$data);
				}
			}else{
				$arr[]=$readings;
				cookie('readings',$arr);
			}
			$reading=[];
			$reading['father']=$readPag[1];
			$reading['son']=$id;
			cookie($reading['father'],$reading,array('prefix'=>'reading_'));
			$this -> assign('pag',$readPag);
			$this -> assign('title',$title[1]);
			$this -> assign('content',$content);
			$this->display();
		}
	}
}