<?php

include_once __DIR__ . '/vendor/autoload.php';

/**
 * @return \PFinal\Database\Builder
 */
function db()
{
    static $conn;
    if ($conn == null) {
        $conn = new \PFinal\Database\Connection(config('db'));
    }
    $db = new \PFinal\Database\Builder();
    $db->setConnection($conn);
    return $db;
}

function session()
{
    return new \PFinal\Session\NativeSession(array(
        'keyPrefix' => 'msm.session.',
    ));
}

function e($html)
{
    return htmlentities($html, ENT_QUOTES, 'UTF-8', false);
}

function view($template, $data = array())
{
    $view = new \View;
    $view->path = './views';
    return $view->render($template, $data);
}

function url($path, array $params = array())
{
    if (count($params) > 0) {
        $append = '&' . http_build_query($params);
    } else {
        $append = '';
    }
    return 'index.php?r=' . urlencode($path) . $append;
}

function back()
{
    $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] :
        ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    header('Location: ' . $url);
    exit;
}

function config($name)
{
    $config = require __DIR__ . '/_config.php';
    if (array_key_exists($name, $config)) {
        return $config[$name];
    }
    return null;
}


if (!function_exists('array_column')) { // PHP < 5.5
    function array_column(array $input, $columnKey, $indexKey = null)
    {
        $result = array();
        foreach ($input as $key => $row) {
            if (!is_array($row)) {
                continue;
            }
            $value = is_null($columnKey) ? $row : $row[$columnKey];
            if (is_null($indexKey)) {
                $result[] = $value;
            } else {
                $result[$row[$indexKey]] = $value;
            }
        }
        return $result;
    }
}
