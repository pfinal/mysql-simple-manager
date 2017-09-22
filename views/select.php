<?php

$table = $_GET[GET_PREFIX_TABLE];

$page = new Pagination(db()->table($table)->where(array())->count());

$data = \Msm\Data::findAll($table, array(), $page->currentPage, $page->limit);

$titles = array();
$defaultValue = db()->table($table)->loadDefaultValues();
$titles = array_keys($defaultValue);
?>
<?php include __DIR__ . '/_message.php' ?>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <?php foreach ($titles as $title) { ?>
                <th><?php echo e($title) ?></th>
            <?php } ?>
            <th width="80">操作</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($data as $value) { ?>
            <tr>
                <?php foreach ($titles as $title) { ?>
                    <td><?php echo e(\Msm\Data::cutString($value[$title])) ?></td>
                <?php } ?>
                <td>
                    <?php
                    $params = \Msm\Data::getPrimaryKeyValues($table, $value);
                    $params[GET_PREFIX_DATABASE] = $_GET[GET_PREFIX_DATABASE];
                    $params[GET_PREFIX_TABLE] = $table;
                    ?>
                    <a href="<?php echo url('data-edit', $params) ?>">编辑</a>
                    <a onclick="return confirm('确定要删除吗?')" href="<?php echo url('data-delete', $params) ?>">删除</a>
                </td>
            </tr>

        <?php } ?>

        </tbody>

    </table>

    <!--分页-->
    <style>
        <?php echo $page->getDefaultCss();?>
    </style>
    <div class="pull-right">
        <?php echo $page->createLinks() ?>
    </div>
    <!--分页end-->


</div>