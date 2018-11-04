<?php $__env->startSection('content'); ?>
    
        <div class="row">
     <div class="col-12">
	  
	<router-view name="filmsIndex"></router-view>
	
    <router-view></router-view>
    
      
    </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>