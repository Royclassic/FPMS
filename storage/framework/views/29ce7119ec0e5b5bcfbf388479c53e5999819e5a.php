

<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo e($pageTitle); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                <li class="active">Search Results</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">Search Here</h3>
                <form class="form-group" action="<?php echo e(route('admin.search.store')); ?>" novalidate method="POST" role="search">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <div class="input-group">
                        <input type="text"  name="search_key" class="form-control" placeholder="<?php echo app('translator')->getFromJson('app.search'); ?>" value="<?php echo e($searchKey); ?>">
                        <span class="input-group-btn"><button type="button" class="btn waves-effect waves-light btn-info"><i class="fa fa-search"></i></button></span>
                    </div>
                </form>
                <h2 class="m-t-40">Search Result For "<?php echo e($searchKey); ?>"</h2>
                <small>About <?php echo e(count($searchResults)); ?> result </small>
                <hr>
                <ul class="search-listing">
                    <?php $__empty_1 = true; $__currentLoopData = $searchResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li>
                        <h3><a href="<?php echo e(route($result->route_name, $result->searchable_id)); ?>"><?php echo e($result->title); ?></a></h3>
                        <a href="<?php echo e(route($result->route_name, $result->searchable_id)); ?>" class="search-links"><?php echo e(route($result->route_name, $result->searchable_id)); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li>
                            No result found
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </div>
    <!-- /.row -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>