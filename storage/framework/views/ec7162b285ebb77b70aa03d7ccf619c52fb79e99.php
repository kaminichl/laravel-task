<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		 <?php echo $__env->yieldContent('title'); ?>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="all,follow">
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<!-- Bootstrap CSS-->
		<link rel="stylesheet" href="template/vendor/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome CSS-->
		<link rel="stylesheet" href="template/vendor/font-awesome/css/font-awesome.min.css">
		<!-- Custom Font Icons CSS-->
		<link rel="stylesheet" href="template/css/landy-iconfont.css">
		<!-- Google fonts - Open Sans-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800">
		<!-- owl carousel-->
		<link rel="stylesheet" href="template/vendor/owl.carousel/assets/owl.carousel.css">
		<link rel="stylesheet" href="template/vendor/owl.carousel/assets/owl.theme.default.css">
		<!-- theme stylesheet-->
		<link rel="stylesheet" href="template/css/style.default.css" id="theme-stylesheet">
		<!-- Custom stylesheet - for your changes-->
		<link rel="stylesheet" href="template/css/custom.css">
		
		
		<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
		<!-- Favicon-->
		<link rel="shortcut icon" href="template/favicon.png">
		
		
		 <?php echo $__env->yieldContent('head'); ?>
		
		
        
    </head>
	 <body>
	 <div id="wrapper">
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg fixed-top"><a href="index.html" class="navbar-brand">
	  <h5>Welcome!</h5>
	  </a>
        <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><span></span><span></span><span></span></button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto align-items-start align-items-lg-center">
            
			<li class="nav-item"> <router-link :to="{name: 'index'}" class="nav-link link-scroll">Film</router-link></li>
			<li class="nav-item"> <router-link :to="{name: 'createFilm'}" class="nav-link link-scroll">Create film</router-link></li>
            
            
          </ul>
          <div class="navbar-text"> 
				
			<?php if(Auth::guest()): ?>
				<a href="<?php echo e(url('/register')); ?>" class="btn btn-primary navbar-btn btn-shadow btn-gradient">Register</a>
				<a href="<?php echo e(url('/login')); ?>" class="btn btn-success navbar-btn btn-shadow btn-gradient">Login</a>
			<?php else: ?> 
				<?php if(Auth::user()->isAdmin()): ?> 
					<a href="<?php echo e(url('/backend')); ?>" class="btn btn-dangerbtn-shadow btn-gradient">Backend</a>
				<?php endif; ?>
				<a href="<?php echo e(url('/logout')); ?>" class="btn btn-dangerbtn-shadow btn-gradient">Logout</a>
			<?php endif; ?>
				
			
          </div>
        </div>
      </nav>
    </header>
    <!-- Modal-->
    <div id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Login</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
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
 
  
    <section id="about-us" class="about-us bg-gray">
	
      <div class="container">
	  <?php echo $__env->yieldContent('content'); ?>
       
    </section>
   
   </div>
    <div id="scrollTop">
      <div class="d-flex align-items-center justify-content-end"><i class="fa fa-long-arrow-up"></i>To Top</div>
    </div>
    <footer class="main-footer">
      
      <div class="">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <p>&copy; 2018 All rights reserved.                        </p>
            </div>
            <div class="col-md-5 text-right">
              <p>Template By <a href="https://bootstrapious.com/" class="external">Bootstrapious</a>  </p>
              <!-- Please do not remove the backlink to Bootstrapious unless you support us at http://bootstrapious.com/donate. It is part of the license conditions. Thanks for understanding :) -->
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"> </script>
    <script src="template/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo e(asset('js/app.js')); ?>"></script>
	
	
  
	
    <script src="template/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="template/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="template/js/front.js"></script>
	<?php echo $__env->yieldContent('before-scripts-end'); ?>
	
		<s
		
        <?php echo $__env->yieldContent('after-scripts-end'); ?>
   
  </body>
  
</html>
