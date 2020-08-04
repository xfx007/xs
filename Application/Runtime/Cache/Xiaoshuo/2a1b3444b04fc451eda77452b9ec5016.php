<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="" />
        <meta name="description" content=""
        />
        <link rel="canonical" href="70159.html" />
        <title>
            小飞侠小说
        </title>
        <link href="../favicon.png" rel="apple-touch-icon-precomposed" />
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1,user-scalable=no">
        <link rel="stylesheet" href="/Static/xs/css/style.css">
    </head>
    
    <body>
        <script type="text/javascript">
            var ks_host = "../3g";
            var ks_uid = 0;
        </script>
        </script>
        <div class="header">
            <span class="nav_left">
                <a href="javascript:history.go(-1)">
                    返回
                </a>
            </span>
            <span class="nav_right">
                <a rel="internal" href="/Xiaoshuo/Lst/delSession?id=<?php echo ($id); ?>"  >
                    更新
                </a>
                </h1>
            </span>
            <h1>
                作品简介
            </h1>
        </div>
        <div class="wrap clearfix">
            <div class="section bindex">
                <div class="btitle">
                    <?php echo ($data["1"]); ?>
                    <span>
                        (<?php echo ($data["9"]); ?>)
                    </span>
                </div>
                <div class="blist">
                    <ul>
                        <li>
                            <div class="bookwrap clearfix">
                                <div class="bcover fl">
                                    <img src="__AURL__/<?php echo ($data["3"]); ?>" onerror="this.src='https://www.xsbiquge.com<?php echo ($data["3"]); ?>';this.onerror='';"
                                    height="110" width="75">
                                </div>
                                <div class="bintro b_i pl10">
                                    <p>
                                        分类：
                                        <b class="tname">
                                            <a href="#" class="ye">
                                                <?php echo ($data["4"]); ?>
                                            </a>
                                        </b>
                                        <br/>
                                        作者： <?php echo ($data["5"]); ?>
                                        <br/>
                                        75.3万字 共300章
                                        <br/>
                                        收藏： 917 &nbsp;&nbsp; 评论: 114
                                        <br/>
                                        <b class="tname">
                                        阅读到：
                                        <a href="#" class="ye">
                                            <?php if(is_array($reading)): echo ($reading["reading_name"]); ?>
                                            <?php else: ?>
                                                未阅读<?php endif; ?>
                                        </a>
                                        </b>
                                        <br/>
                                          更新时间： (<?php echo ($data["10"]); ?>更新)
                                    </p>
                                </div>
                            </div>
                            <div class="blink gyb bl3 mt5">
                                <?php if(is_array($reading)): ?><a href='/Xiaoshuo/Read/read.html?id=<?php echo ($reading['son']); ?>' class="cur">
                                        继续阅读
                                    </a>
                                <?php else: ?>
                                    <a href='/Xiaoshuo/Read/read.html?id=<?php echo ($data["0"]); ?>' class="cur">
                                        马上阅读
                                    </a><?php endif; ?>
                                <!-- 
                             <a href="javascript:;" class="book_fav" id="btn_fav">
                                    收藏
                                </a> -->
                                <a href="/Xiaoshuo/Lst/catalogue.html?id=<?php echo ($data["8"]); ?>" class="last">
                                    查看目录
                                </a>
                            </div>

                        </li>

                        <li>
                        <?php foreach($newLst['name'] as $k=>$v): ?>
                         <?php if($k==0): ?>最新章节：降序<?php endif; ?> 
                            <span class="bname">
                                <a href="/Xiaoshuo/Read/read.html?id=<?php echo ($newLst['url'][$k]); ?>">
                                    <b class="ye">
                                        <?php echo ($v); ?>
                                    </b>
                                </a>
                            </span>
                        <?php endforeach; ?>
                        </li>
                        <li>
                            <div class="intro">
                                <p>
                                    <b>
                                        简介：
                                    </b>
                                    <?php echo ($data["2"]); ?>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        <div class="search">
            <div class="searchbox mt10 clearfix">
                <form action="/Xiaoshuo/Search/search.html" method="get">
                    <!-- <input type="hidden" name="sid" value="-jlfcT4pLcKDMWGdK6tas1" /> -->
                    <input name="keyword" type="text" class="t_i"  id="keyword" placeholder="输入小说名字" autocomplete="off"/>
                    <!-- <input type="hidden" name="search" value="aname" /> -->
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
                     <a href="/Xiaoshuo/Index/index.html" >
                        首页
                    </a>
                </div>
                <p class="edition mt20">
                    <span>
                      <a href="javascript:;">
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