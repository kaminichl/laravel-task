<?php $__env->startSection('content'); ?>
     <h2 class="text-center">Register</h2>
        <div class="row">
     <div class="col-12">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Please fill your details</h5>
          </div>
          <div class="modal-body">
		  <?php echo e(Form::open(['name' => 'regsiter', 'id' =>'signupform' , 'url' => '/register', 'method' => 'POST'])); ?>


			
			<?php if(count($errors) > 0): ?>
			  <div class="alert alert-danger">
				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<span><?php echo e($message); ?></span>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			<?php endif; ?>	
			

			<div class="form-group">
				
				<?php echo e(Form::label('name')); ?>

				<?php echo e(Form::text('name')); ?>

			</div>
			
			<div class="form-group">
				
				<?php echo e(Form::label('email', 'Email address')); ?>

				<?php echo e(Form::email('email')); ?>

			</div>
			
			<div class="form-group">
				
				<?php echo e(Form::label('password', 'Password')); ?>

				<?php echo e(Form::password('password')); ?>

			</div>
			
			<div class="form-group">
				
				<?php echo e(Form::label('password_confirmation', 'Password confirmation')); ?>

				<?php echo e(Form::password('password_confirmation')); ?>

			</div>
			
			
             <div class="form-group"> 
				
				<?php echo e(Form::submit('Register',['class'=>"submit btn btn-primary btn-shadow btn-gradient"])); ?>

			</div>
			

		<?php echo e(Form::close()); ?>

           
          </div>
        </div>
      </div>
    </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>