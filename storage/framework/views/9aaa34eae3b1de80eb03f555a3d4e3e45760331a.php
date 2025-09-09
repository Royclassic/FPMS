<?php $__env->startSection('content'); ?>

    <form class="form-horizontal form-material" id="loginform" action="<?php echo e(route('login')); ?>" method="POST">
        <?php echo e(csrf_field()); ?>



        <?php if(session('message')): ?>
            <div class="alert alert-danger m-t-10">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?>

        <div class="form-group m-t-40 <?php echo e($errors->has('admission_staff_no') ? 'has-error' : ''); ?>">
            <div class="col-xs-12">
                <input class="form-control" id="admission_staff_no" type="text" name="admission_staff_no" value="<?php echo e(old('admission_staff_no')); ?>" autofocus required="" placeholder="Username">
                <?php if($errors->has('admission_staff_no')): ?>
                    <div class="help-block with-errors"><?php echo e($errors->first('admission_staff_no')); ?></div>
                <?php endif; ?>

            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" id="password" type="password" name="password" required="" placeholder="Password">
                <?php if($errors->has('password')): ?>
                    <div class="help-block with-errors"><?php echo e($errors->first('password')); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="checkbox checkbox-primary pull-left p-t-0">
                    <input id="checkbox-signup" type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label for="checkbox-signup"> Remember me </label>
                </div>
                <a href="<?php echo e(route('password.reset.form')); ?>"  class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a> </div>
        </div>
        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
            </div>
        </div>

        
            
                
            
        
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>