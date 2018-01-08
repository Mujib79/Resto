<canvas id="lineChart" height="80px"></canvas>

<?php if(count($datas) > 0): ?>
    <script type="text/javascript">
        var val = new Array(12);
        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            val[parseInt((<?php echo e($val->tanggal); ?>-1))] = <?php echo e($val->total); ?>;
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        var tahun = <?php echo e($val->tahun); ?>;
        addChart(val, tahun);
    </script>
<?php endif; ?>
