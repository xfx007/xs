<?php
namespace app\wechat\controller;
use think\Controller;
use think\Db;
use Config;
class One extends Controller
{
    /**
     * [index description 校验微信公众号]
    * @Author   liangweiquan
    * @DateTime 2020-03-11T09:49:54+0800
     * @return   [type]                   [description]
    */
    public function index()
    {
    	$json = '{
    		"type": "type",
    		"source": "soure",
    		"wxid": "wxid",
    		"msgSender": "msgSender",
    		"content": "content" 
    	}';
    	dump($json);
    	die;
    	$json_decode   = input('get.');
      $msg = $postArr->Content;
      $toUserName = $postArr->ToUserName;
      $fromUserName = $postArr->FromUserName;
      if(strpos($msg,'福利') !== false){ 
      $temText =config('wechat.text');
      	 $help = "一一一领优惠券教程一一一\n".
        "例如👇👇👇\n".
        "覆置这行话€GtrE1hcLrjN€转移至τáǒЬáǒ【脆乐淘 每日坚果混合坚果仁大礼包30袋儿童孕妇特产零食礼盒装】；或https://m.tb.cn/h.VVZlLhs?sm=3d6ff3 點击鏈→接，再选择瀏→覽→嘂..咑№亓\n\n".
        "一一一看小说教程一一一\n".
        "例如👇👇👇\n".
        "小说斗罗大陆";
		return sprintf($temText,$fromUserName,$toUserName,$help);
      }
      if(strpos($msg,'小说') !== false){ 
        return $this->resImageTextMsg($fromUserName,$toUserName,$msg);
      }elseif(strpos($msg,'https') !== false){
        return $this->TbkDgMaterialOptionalRequest($postArr);
      }else{
        return $this->resMsg($fromUserName,$toUserName,$msg);
      }

    }
    /**
     * [resMsg description 回复消息]
     * @Author   liangweiquan
     * @DateTime 2020-03-11T12:22:16+0800
     * @return   [type]                   [description]
     */
    public function resMsg($fromUserName,$toUserName,$msg){
      $Data = file_get_contents("http://api.qingyunke.com/api.php?key=free&appid=0&msg=$msg");
      $getData = json_decode($Data);
      $temText =config('wechat.text');
      if (!$getData->result) {
      	$msg = $getData->content;
        $info = sprintf($temText,$fromUserName,$toUserName,$msg."\n【📢温馨提示:想获取更多福利输入框发送[福利]🤑】");
      }else{
        $info = sprintf($temText,$fromUserName,$toUserName,"【📢温馨提示:想获取更多福利输入框发送[福利]🤑】");
      }
      return $info;
    }
    /**
     * [resMsg description 图文回复消息]
     * @Author   liangweiquan
     * @DateTime 2020-03-11T12:22:16+0800
     * @return   [type]                   [description]
     */
    public function resImageTextMsg($fromUserName,$toUserName,$msg){
      $temImageText =config('wechat.imageText');
      $dataArr = $this->search($msg);
      $info = sprintf($temImageText,$fromUserName,$toUserName,$dataArr['title'],$dataArr['desc'],$dataArr['img'],$dataArr['url']);
      return $info;
    }
    public function search($msg){
      $msgStr = str_replace("小说","",$msg);
      $msg = urlencode($msgStr);
      $urlStr="https://www.xsbiquge.com/search.php?keyword=$msg";
      $url=curl($urlStr);
      preg_match("/<span.*?>(.*?)<\/span>/",$url,$title);
      preg_match("/<p class=\"result-game-item-desc\">(.*?)<\/p>/",$url,$desc);
      preg_match("/<img src=\"(.*?)\" class.*?>/",$url,$img);
      $data['title'] = $title[1];
      $data['desc'] = $desc[1];
      $data['img'] = $img[1];
      $data['url'] = "https://blog.duyoli.com/xs/search/search.html?keyword=$msgStr";
      return $data;
    }
  public function TbkDgMaterialOptionalRequest($postArr)
    {
      require("extend/Taobao/TopSdk.php");
      require("extend/Taobao/top/request/TbkItemInfoGetRequest.php");
      require("extend/Taobao/top/request/TbkDgMaterialOptionalRequest.php");
      require("extend/Taobao/top/request/TbkTpwdCreateRequest.php");
      $c = new \TopClient;
      $msg = $postArr->Content;
      $toUserName = $postArr->ToUserName;
      $fromUserName = $postArr->FromUserName;
      $temText =config('wechat.text');
      preg_match('/https:\/\/[A-Za-z0-9?_=.\/]+(\s?)/',$msg,$urlArr);
      $resStr = "该宝贝暂无内部券!\n【📢温馨提示:想获取更多福利输入框发送[福利]🤑】";
      if ($urlArr[0] == '') {
        //查不到
         $info = sprintf($temText,$fromUserName,$toUserName,$resStr.'1');
        return $info;
      }
      $Data = file_get_contents($urlArr[0]);
      preg_match("/\/i(.*?).htm/",$Data,$id);
      $c->appkey = '28302403';
      $c->secretKey = 'a86a06d7f43020bd4a1a16efdf5494a8';
      $TbkItemInfoGetRequest = new \TbkItemInfoGetRequest;
      $TbkItemInfoGetRequest->setNumIids($id[1]);
      $TbkItemInfoGetRequest->setPlatform("2");
      $TbkItemInfoGetRequestObj = $c->execute($TbkItemInfoGetRequest);
      if (!isset($TbkItemInfoGetRequestObj->results)) {
      //没有优惠券
        $info = sprintf($temText,$fromUserName,$toUserName,$resStr.'2');
        return $info;
      }
      $title = $TbkItemInfoGetRequestObj->results->n_tbk_item->title;
      $goodsRes = $this->getTbkDgMaterialOptionalRequest($c,$id[1],$title);
      if (!isset($goodsRes) || $goodsRes == 1001|| $goodsRes == 1002|| $goodsRes == 1003|| $goodsRes == 1004) {
      //没有优惠券
      $info = sprintf($temText,$fromUserName,$toUserName,$goodsRes);
        return $info;
      }
      // $this->TbkTpwdCreateRequest($goodsRes->url,$goodsRes->pict_url);
      $TbkTpwdCreateRequest = new \TbkTpwdCreateRequest;
      $TbkTpwdCreateRequest->setUserId("123");
      $TbkTpwdCreateRequest->setText("快领优惠券啦!");
      $TbkTpwdCreateRequest->setUrl("https:".$goodsRes['coupon_share_url']);
      $TbkTpwdCreateRequest->setLogo("https:".$goodsRes['pict_url']);
      $TbkTpwdCreateRequest->setExt("{}");
      $res = $c->execute($TbkTpwdCreateRequest);
      $modelRes = $this->xml2arr($res);  
      //  商品信息-佣金比率。1550表示15.5%
      $commission      = bcdiv($goodsRes['commission_rate'],10000,2);
      $price           = bcsub($goodsRes['zk_final_price'],$goodsRes['coupon_amount'],2);
      $commission_rate = bcmul($price,$commission,2);//返利：{$commission_rate}元❤
      $price_rate = bcmul($commission_rate,0.5,2);//返利：\n返利：{$price_rate}元💰下单成功后请把订单号发给我领取返利红包\n,谢谢!!!💚 vx:13172261236💗
      $info = sprintf($temText,$fromUserName,$toUserName,"✨{$goodsRes['title']}✨\n原价：{$goodsRes['zk_final_price']}元\n优惠券：{$goodsRes['coupon_amount']}元\n实付：{$price}元\n復制❤口令：{$modelRes['data']['model']}\n【📢温馨提示:😍促销时间很快结束，看中尽快下单哦！想获取更多福利输入框发送[福利]🤑】");
      return $info;
        // 不带任何参数 自动定位当前操作的模板文件
    }
    function getTbkDgMaterialOptionalRequest($c,$id,$title,$PageNo=1){
        $TbkDgMaterialOptionalRequest = new \TbkDgMaterialOptionalRequest;
        $TbkDgMaterialOptionalRequest->setAdzoneId("109946850339");
        $TbkDgMaterialOptionalRequest->setPlatform("2");
        $TbkDgMaterialOptionalRequest->setPageSize("100");
        $TbkDgMaterialOptionalRequest->setQ($title);
        $TbkDgMaterialOptionalRequest->setPageNo($PageNo);
        $getData = $c->execute($TbkDgMaterialOptionalRequest);
      if (!isset($getData->result_list->map_data)) {
            return 1001;
          }
           $total_results = ceil($getData->total_results/100);//商品数量
          $getData = $this->xml2arr($getData);
          if (isset($getData['result_list']['map_data'][0])) {
            foreach ($getData['result_list']['map_data'] as $k => $v) {
              if (in_array($id,$v)) {
                $goodsRes = $v;
              }
            }
          }elseif ($getData['result_list']['map_data']['category_id']) {
            if ($id == $getData['result_list']['map_data']['item_id']) {
              $goodsRes = $getData['result_list']['map_data'];
            }
          } else {
           return 1002;
         }
         $PageNo++;
         if (isset($goodsRes)) {
            return $goodsRes;
        }elseif($total_results >= $PageNo){
          return $this->getTbkDgMaterialOptionalRequest($c,$id,$title,$PageNo);
        }else{
         return 1003;
        }
      }
    function xml2arr($simxml){
    $simxml = (array)$simxml;//强转
    foreach($simxml as $k => $v){
      if(is_array($v) || is_object($v)){
        $simxml[$k] = $this->xml2arr($v);
      }
    }
    return $simxml;
  }
  }
