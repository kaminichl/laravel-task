<?php $__env->startSection('content'); ?>
    
    
	  
	<router-view name="BackendFilmsIndex"></router-view>
	
    <router-view></router-view>
    
 
      
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>