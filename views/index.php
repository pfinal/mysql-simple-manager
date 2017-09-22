<!DOCTYPE html>
<html lang="zh-CN">
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
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo url('/') ?>">MySQL Simple Manager</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
                <li>
                    <a href="<?php echo url('query', array(GET_PREFIX_DATABASE => isset($_GET[GET_PREFIX_DATABASE]) ? $_GET[GET_PREFIX_DATABASE] : '',GET_PREFIX_TABLE => isset($_GET[GET_PREFIX_TABLE]) ? $_GET[GET_PREFIX_TABLE] : '')) ?>">Query</a>
                </li>
                <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                 </li>-->
            </ul>
            <!--<form class="navbar-form navbar-left" role="search">
               <div class="form-group">
                   <input type="text" class="form-control" placeholder="Search">
               </div>
               <button type="submit" class="btn btn-default">Submit</button>
           </form>-->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?php echo e(session()->get('username')) ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo url('logout') ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="container-fluid">
    <div class="row">

        <!-- tables -->
        <div class="col-md-2" style="word-break:break-all;">
            <?php if (isset($_GET[GET_PREFIX_DATABASE]) && !empty($_GET[GET_PREFIX_DATABASE])) { ?>
                <div><?php echo e($_GET[GET_PREFIX_DATABASE]) ?></div>
                <ul>
                    <?php $allTables = \Msm\Table::all();
                    foreach ($allTables as $tableName) { ?>
                        <li>
                            <a href="<?php echo url('select', array(GET_PREFIX_TABLE => $tableName, GET_PREFIX_DATABASE => $_GET[GET_PREFIX_DATABASE])); ?>"><?php echo e($tableName); ?></a>
                        </li>
                    <?php } ?>
                </ul>
                <?php if (count($allTables) == 0) { ?>
                    (empty)
                <?php } ?>
            <?php } else { ?>
                <ul>
                    <?php
                    foreach (\Msm\Database::all() as $dbName) { ?>
                        <li>
                            <a href="<?php echo url('/', array(GET_PREFIX_DATABASE => $dbName)); ?>"><?php echo e($dbName); ?></a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
        <!-- tables end -->

        <!-- main start -->
        <div class="col-md-10"><?php echo $content; ?></div>
        <!-- main end -->
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="static/jquery/jquery-1.12.4.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="static/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>