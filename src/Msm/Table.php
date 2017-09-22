<?php

namespace Msm;

class Table
{
    /**
     * 返回表名
     * @return array 例如 ['users','orders']
     */
    public static function all()
    {
        $return = array();
        $arr = db()->findAllBySql('SHOW TABLES');
        foreach ($arr as $item) {
            foreach ($item as $name) {
                $return[] = $name;
            }
        }
        return $return;
    }

    /**
     * 查询主键字段
     * @param string $table
     * @return array 例如 ['id']
     */
    public static function getPrimaryKeyFields($table)
    {
        $fields = static::getSchema($table);

        $primary = [];
        foreach ($fields as $field) {
            if ($field['Key'] === 'PRI') {
                $primary[] = $field['Field'];
            }
        }
        return $primary;
    }

    protected static $schemas = [];

    /**
     * @param $tableName
     * @return array
     */
    public static function getSchema($tableName)
    {
        if (!array_key_exists($tableName, static::$schemas)) {
            static::$schemas[$tableName] = db()->findAllBySql('SHOW FULL FIELDS FROM ' . $tableName);
        }

        return static::$schemas[$tableName];
    }
}