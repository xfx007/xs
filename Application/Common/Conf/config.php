<?php
return array(
	//'配置项'=>'配置值'
	
	 /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'xx_cese',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    
    'DEFAULT_MODULE'        =>  'Xiaoshuo',     //默认模块
        'DB_CHARSET'            =>  'utf8mb4',      // 数据库编码默认采用utf8
    'URL_ROUTER_ON'         =>  true,
    //'DEFAULT_CONTROLLER' => 'Login', // 默认控制器名称
    //'DEFAULT_ACTION' => 'login', // 默认操作名称
      // 视图输出字符串内容替换
    'TMPL_PARSE_STRING'  =>array(
        '__UPLOAD__'=> "/Static/wx/img",
        '__STATICWX__'=> "/Static/wx",
        //小说
        '__STATICXS__'=> "/Static/xs",
        '__XSURL__'=>'https://www.xsbiquge.com',


    ),
    //'配置项'=>'配置值'
        'COPY_FROM' => array(
        'XSURL' => "https://www.xsbiquge.com",
        'MEURL' => "blog.duyoli.com",
        'TITLE' => "小飞侠小说",
         ),


);