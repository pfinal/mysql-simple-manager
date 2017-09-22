<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MySQL Simple Manager</title>

    <!-- Bootstrap -->
    <link href="static/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="css/layout.css" rel="stylesheet">

    <style>
        body {
            background-color: #fafafa;
        }

        .center {
            width: auto;
            display: table;
            margin-left: auto;
            margin-right: auto;
        }

        .text-center {
            text-align: center;
        }

        .browser-icon {
            font-size: 48px;
            color: #3c763d;
        }
    </style>

</head>
<body>

<div id="ie-low" style="display:none;">
    <div class="input-group">
        <span class="help-tiaokuan"><strong style="font-size:30px;">很遗憾，您用的是古董级浏览器，为了获得更好的体验，我们建议您下载使用：</strong></span>
    </div>
    <div class="input-group" style="margin-bottom:10px;">
        <div class="pull-left">
            <a target="_blank" href="https://www.baidu.com/s?wd=chrome">
                <span class="fa fa-chrome browser-icon"></span>
                &nbsp;谷歌浏览器</a>&nbsp;&nbsp;
        </div>
        <div class="pull-left">
            <a target="_blank" href="http://chrome.360.cn/">
                <span class="fa fa-bolt browser-icon"></span>
                &nbsp;360极速浏览器</a>&nbsp;&nbsp;
        </div>
        <div class="pull-left">
            <a target="_blank" href="http://www.firefox.com.cn/">
                <span class="fa fa-firefox browser-icon"></span>
                &nbsp;火狐浏览器</a>
            &nbsp;&nbsp;
        </div>
        <div class="pull-left">
            <a target="_blank" href="http://www.microsoft.com/zh-cn/download/internet-explorer.aspx">
                <span class="fa fa-edge browser-icon"></span>
                &nbsp;更高版本的IE浏览器(IE9以上)</a>
            &nbsp;&nbsp;
        </div>

    </div>

    <div class="input-group">
        <a href="javascript:showLoginForm();" style="color: #999;">我想继续使用当前浏览器(不推荐)</a>
    </div>
</div>

<div class="container" id="login-form">
    <div style="padding: 20px;"></div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="view-port">
                <div class="panel">
                    <div class="panel-body">

                        <div class="h-20"></div>

                        <div class="alert alert-success text-center" style="font-size: 18px;">
                            <b>请登录</b>
                        </div>

                        <form method="post" action="<?php echo url('login')?>">
                            <div class="form-group">
                                <label for="username">用户名</label>
                                <input name="username" type="text" class="form-control" id="username" tabindex="10">
                            </div>

                            <div class="form-group">
                                <label for="password">您的密码</label> <!-- <a class="pull-right" href="#" tabindex="60">忘记密码?</a>-->
                                <input name="password" type="password" class="form-control" id="password" tabindex="20">
                            </div>
<!--
                            <div class="form-group">
                                <label for="captcha">验证码</label>
                                <input name="captcha" class="form-control" id="captcha" tabindex="30">
                            </div>

                            <span title="点击更换"
                                  style="cursor:pointer;background-color: #ccc; display: inline-block;width: 80px;height:30px;"></span>
 -->
                            <div class="form-group">
                                <button type="submit" tabindex="40" class="btn btn-primary btn-block js-submit"
                                        data-loading-text="正在登录...">登录
                                </button>
                            </div>

                            <!--<div class="mt15">
                                <label>
                                    <input name="rememberMe" type="checkbox" value="1" tabindex="50"> 记住我
                                </label>
                                &nbsp;&nbsp;
                            </div>
                           -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function hideLoginForm(){
        document.getElementById("login-form").style.display = "none";
        document.getElementById("ie-low").style.display = "block";
    }
    function showLoginForm(){
        document.getElementById("login-form").style.display = "block";
        document.getElementById("ie-low").style.display = "none";
    }
    if (/MSIE (6|7|8)\.0;/.test(navigator.userAgent.toUpperCase())) {
        hideLoginForm();
        //alert("您的浏览器版本过低,请使用Chrome、Firefox、360极速浏览器,或升级至IE9.0以上!");
    }
</script>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="static/jquery/jquery-1.12.4.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="static/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>