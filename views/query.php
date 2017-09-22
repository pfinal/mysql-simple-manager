<?php
$dataAll = array();
$titles = array();
$rowCount = array();
$sql = trim(isset($_POST['sql']) ? $_POST['sql'] : '');
$sqlDefault = '';
$fields = array();
if (!empty($sql)) {

    $parser = new \PhpMyAdmin\SqlParser\Parser($sql);

    if (count($parser->errors) > 0) {
        $messageArr = '';
        foreach ($parser->errors as $error) {
            $messageArr[] = $error->getMessage();
        }
        session()->setFlash('message', join(" ", $messageArr));

    } else {

        foreach ($parser->statements as $statement) {

            $sqlOne = $statement->build();
            //SELECT，SHOW，DESCRIBE, EXPLAIN
            //INSERT, UPDATE, DELETE, DROP

            try {

                if (preg_match('/(SELECT|SHOW|DESCRIBE|EXPLAIN|DESC)\b/is', $sqlOne)) {

                    $data = db()->findAllBySql($sqlOne);
                    if (count($data) > 0) {
                        $titles[] = array_keys($data[0]);
                        $dataAll[] = $data;
                    }
                } else {

                    $rowCount[] = db()->getConnection()->execute($sqlOne);
                }
            } catch (\Exception $ex) {
                session()->setFlash('message', $ex->getMessage());
            }

        }
    }


} else {

    $table = isset($_GET[GET_PREFIX_TABLE]) ? $_GET[GET_PREFIX_TABLE] : '';
    if (!empty($table)) {
        $defaultValue = db()->table($table)->loadDefaultValues();
        $fields = array_keys($defaultValue);
        $sqlDefault = 'SELECT * FROM `' . $table . '` LIMIT 100';
    }
}
?>

<?php if (count($fields) > 0) { ?>
    <div>
        <span class="label label-primary"><?php echo e($table) ?></span>
        <?php foreach ($titles as $val) { ?>
            <span class="label label-default"><?php echo e($val) ?></span>
        <?php } ?>
    </div>
<?php } ?>
    <br>
    <form action="" method="post">

        <textarea class="form-control" name="sql" rows="5"
                  placeholder=""><?php echo e($sql ? $sql : $sqlDefault) ?></textarea>
        <br>
        <button class="btn btn-default">Query</button>
    </form>

    <br>
<?php include __DIR__ . '/_message.php' ?>

<?php if (!empty($sql)) { ?>

    <?php foreach ($rowCount as $rowCountOne) { ?>

        <div class="alert alert-warning">受影响行数 <?php echo $rowCountOne ?></div>
    <?php }
    foreach ($dataAll as $index => $data) {
        ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <?php foreach ($titles[$index] as $title) { ?>
                        <th><?php echo e($title) ?></th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $value) { ?>
                    <tr>
                        <?php foreach ($titles[$index] as $title) { ?>
                            <td><?php echo e(\Msm\Data::cutString($value[$title])) ?></td>
                        <?php } ?>

                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    <?php } ?>
<?php } ?>