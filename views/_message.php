<?php if(session()->hasFlash('message')){?>
    <div class="alert alert-warning"><?php echo e(session()->getFlash('message'))?></div>
<?php } ?>