<?php $__env->startSection('content'); ?>
     <h2 class="text-center">Login</h2>
        <div class="row">
     <div class="col-12">
	  
      <div role="document" class="modal-dialog">
        <div class="modal-content">
         
          <div class="modal-body">
		  <?php if(count($errors) > 0): ?>
		  <div class="alert alert-danger">
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<span><?php echo e($message); ?></span>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		 <?php endif; ?>	
			
            <?php echo e(Form::open(['name' => 'regsiter', 'id' =>'loginform' , 'url' => '/login', 'method' => 'POST'])); ?>

             <div class="form-group">
				
				<?php echo e(Form::label('email')); ?>

				<?php echo e(Form::text('email')); ?>

			</div>
			<div class="form-group">
				
				<?php echo e(Form::label('password', 'Password')); ?>

				<?php echo e(Form::password('password')); ?>

			</div>
             
           
              <div class="form-group">
                <button type="submit" class="submit btn btn-primary btn-shadow btn-gradient">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    
      
    </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>