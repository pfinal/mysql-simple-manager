<?php

namespace Msm;

class Data
{
    public static function findAll($table, array $where = array(), $page = 1, $pageSize = 20)
    {
        return db()->table($table)->where($where)->offset(($page - 1) * $pageSize)->limit($pageSize)->findAll();
    }

    public static function findOne($table, array $where)
    {
        return db()->table($table)->where($where)->findOne();
    }

    /**
     * 返回主键和对应的值
     *
     * @param $table
     * @param $row
     * @return array 例如 ['id'=>1]
     */
    public static function getPrimaryKeyValues($table, $row)
    {
        $pk = Table::getPrimaryKeyFields($table);
        if (empty($pk)) {
            return $row;
        }

        $values = array();
        foreach ($pk as $field) {
            $values[$field] = $row[$field];
        }
        return $values;
    }

    public static function cutString($str, $length = 100)
    {
        if (mb_strlen($str) <= $length) {
            return $str;
        }

        return mb_substr($str, 0, $length, 'UTF-8') . '...';
    }

}