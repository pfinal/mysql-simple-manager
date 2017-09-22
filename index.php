<?php

require __DIR__ . '/_init.php';

define('GET_PREFIX_TABLE', '__table__');
define('GET_PREFIX_DATABASE', '__database__');

$route = trim(isset($_GET['r']) ? $_GET['r'] : '', '/');
$route = empty($route) ? 'default' : $route;

if (!preg_match('/^[\w\-\/]+$/', $route)) {
    die('route error.');
}

//检测数据库名是否存在
if (isset($_GET[GET_PREFIX_DATABASE]) && !empty($_GET[GET_PREFIX_DATABASE])) {
    if (!in_array($_GET[GET_PREFIX_DATABASE], \Msm\Database::all())) {
        die('database not exist.');
    }
    db()->getConnection()->getPdo()->exec('use ' . $_GET[GET_PREFIX_DATABASE]);
}

//检测表名是否存在
if (isset($_GET[GET_PREFIX_TABLE]) && !empty($_GET[GET_PREFIX_TABLE])) {
    if (!in_array($_GET[GET_PREFIX_TABLE], \Msm\Table::all())) {
        die('table name error.');
    }
}


if ($route !== 'login') {
    if (null == session()->get('username')) {
        header('Location: ' . url('login'));
        exit;
    }
}

switch ($route) {
    case 'login':

        if (!empty($_POST)) {
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $user = config('user');
            if (strlen($user['password']) == 0) {
                die('please set your password in "_config.php"');
            }

            if ($username === $user['username'] && $password === $user['password']) {
                session()->set('username', $username);
                header('Location: ' . url(''));
                exit;
            }
        }

        echo view('login');
        exit;
    case 'logout':
        session()->remove('username');
        back();
        exit;
    case 'data-edit':

        $table = $_GET[GET_PREFIX_TABLE];

        $pkArr = \Msm\Table::getPrimaryKeyFields($table);
        if (empty($pkArr)) {
            $defaultValues = db()->table($table)->loadDefaultValues();
            $pkArr = array_keys($defaultValues);
        }

        $where = array();
        foreach ($pkArr as $key) {
            $where[$key] = $_GET[$key];
        }

        $message = '';
        if (!empty($_POST)) {
            $rowCount = db()->table($table)->where($where)->update($_POST);
            session()->setFlash('message', $rowCount > 0 ? "成功更新{$rowCount}条数据" : '未更新数据');
            back();
        }

        $row = \Msm\Data::findOne($table, $where);

        $content = view($route, array('row' => $row));
        break;

    case 'data-delete':

        $table = $_GET[GET_PREFIX_TABLE];

        $pkArr = \Msm\Table::getPrimaryKeyFields($table);
        if (empty($pkArr)) {
            $defaultValues = db()->table($table)->loadDefaultValues();
            $pkArr = array_keys($defaultValues);
        }

        $where = array();
        foreach ($pkArr as $key) {
            $where[$key] = $_GET[$key];
        }

        $rowCount = db()->table($table)->where($where)->delete();
        session()->setFlash('message', $rowCount > 0 ? "成功删除{$rowCount}条数据" : '未删除数据');
        back();
        break;
    default:
        $content = view($route);
}

echo view('index', array('content' => $content));

