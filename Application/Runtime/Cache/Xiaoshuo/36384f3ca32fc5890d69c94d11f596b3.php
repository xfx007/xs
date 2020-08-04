<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="canonical" href="index" />
        <title>
           小飞侠小说
        </title>
        <link href="favicon.png" rel="apple-touch-icon-precomposed" />
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1,user-scalable=no">
        <link rel="stylesheet" href="/Static/xs/css/style.css">
        <script src="/Static/xs/js/jquery-1.9.1.min.js"></script>
    </head>
    <body>
        </script>
        <div class="top">
            <!-- <h1 class="fl">
            小飞侠小说
                </h1> -->
            <img height="50px" src="/web.png">
            <p class="fr">
          <a href="javascript:;" class="icon_user"
                title="个人中心">
                    个人中心
                </a>
            </p>
        </div>
        <div class="search">
            <div class="searchbox mt10 clearfix">
                <form action="/Xiaoshuo/Search/search.html" method="get">
                    <input name="keyword" type="text" class="t_i"  id="keyword" placeholder="输入小说名字" autocomplete="off"/>
                    <div class="searchbtn">
                        <span class="t_b">
                        </span>
                        <span class="t_t">
                            搜索
                        </span>
                        <input type="submit" value="" />
                    </div>
                </form>
            </div>
        </div>
                <div class="section">
            <h3 class="title">
                <span class="b_l">
                    最近阅读
                </span>
            </h3>
            <div class="box tab-pane clearfix">
                <div class="blist tab-content active">
                    <ul>
                    <?php foreach($readings as $k=>$v): ?>
                        <li>
                            <a href="/Xiaoshuo/Lst/lst.html?id=<?=$v[father]?>" >
                                <div class="bcover fl">
                                    <img src="<?=$v[img]?>" alt=""
                                    onerror="this.src='http://img.kanshu.com/articleInfo/images/nopic.jpg';this.onerror='';"
                                    height="130" width="85" />
                                </div>
                                <div class="bintro pl10">
                                    <h4>
                                        <?=$v['aname']?>
                                    </h4>
                                    <p>
                                        觉得喜欢就收藏<br/>
                                      欢迎大家反馈意见！
                                        
                                    </p>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section">
            <h3 class="title">
                <span class="b_l">
                    热门小说
                </span>
            </h3>
            <div class="box tab-pane clearfix">
                <div class="blist tab-content active">
                    <ul>
                    <?php foreach($titlename as $k=>$v): ?>
                        <li>
                            <a href="/Xiaoshuo/Lst/lst.html?id=<?=$titleurl[$k]?>" >
                                <div class="bcover fl">
                                    <img src="<?=$titleimg[$k]?>" alt=""
                                    onerror="this.src='http://img.kanshu.com/articleInfo/images/nopic.jpg';this.onerror='';"
                                    height="130" width="85" />
                                </div>
                                <div class="bintro pl10">
                                    <h4>
                                        <?=$v?>
                                    </h4>
                                    <p>
                                    <?=$desc[$k]?>
                                    </p>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    <?php foreach($article[0]['name'] as $k=>$v): ?>
                        <li>
                            <a href='/Xiaoshuo/Lst/lst.html?id=<?=$article[0]["url"][$k]?>'>
                                <div class="bintro">
                                    <h4>
                                        <?=$v?>
                                    </h4>
                                    <p>
                                      
                                    </p>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; ?>
                        <li class="item_more">
                            <a href="javascript:;" class="more">
                                更多作品&gt;
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
  <div class="search">
            <div class="searchbox mt10 clearfix">
                <form action="/Xiaoshuo/Search/search.html" method="get">
                    <input name="keyword" type="text" class="t_i"  id="keyword" placeholder="输入小说名字" autocomplete="off"/>
                    <div class="searchbtn">
                        <span class="t_b">
                        </span>
                        <span class="t_t">
                            搜索
                        </span>
                        <input type="submit" value="" />
                    </div>
                </form>
            </div>
        </div>
        <div class="footer home-bg">
            <div class="footer_nav clearfix">
                <a href="/Xiaoshuo" >
                    首页
                </a>
            </div>
            <p class="edition mt20">
                <span>
                  <a href="javascript:;" >
                        普通版
                    </a>
                    |
                    <a href="javascript:;" class="select">
                        触屏版
                    </a>
                </span>
            </p>
            <p class="copyright mt20">
                <b>
                    小飞侠小说
                </b>
          
            </p>
            <span id="gotop" class="icons icon-gotop">
            </span>
        </div>
        </script>
        </script>
        <div class="pop_cover">
        </div>
        <div class="pop_tip">
            <div class="pop_inner">
                <div class="pop_cont">
                </div>
            </div>
        </div>
    </body>

</html>
 <script type="text/javascript">
  function article(url) {
        $.ajax({
            type: "post",
            url: "/Xiaoshuo/Lst/lst.html",
            data: {url:url},
            dataType: "json",
            success: function (data) {
              if(data.sta=='0'){
              alert(data.msg);
          }else if(data.sta=='1'){
              alert(data.msg);
          }else if(data.sta=='2'){
              alert(data.msg);
          }else if(data.sta=='3'){
              alert(data.msg);
          }
            }
        });

}
</script>