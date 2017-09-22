<?php include __DIR__ . '/_message.php' ?>

<?php if (!empty($row)) { ?>

    <form method="post" action="">
        <?php foreach ($row as $key => $value) { ?>
            <div class="form-group">
                <label><?php echo e($key) ?></label><br>
                <textarea name="<?php echo e($key) ?>" cols="60" rows="2"><?php echo e($value) ?></textarea>
            </div>
        <?php } ?>

        <button type="submit" class="btn btn-default">Submit</button>
    </form>

<?php } ?>