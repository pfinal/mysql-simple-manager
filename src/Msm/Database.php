<?php

namespace Msm;

class Database
{
    /**
     * @return array
     */
    public static function all()
    {
        $return = array();
        $all = db()->findAllBySql('SHOW DATABASES');
        foreach ($all as $item) {
            $return[] = current($item);
        }
        return $return;
    }
}