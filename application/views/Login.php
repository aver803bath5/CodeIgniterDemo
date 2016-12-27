<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 ?>
 <div class="container">
 	<div class="row">
 		<div class="col-md-5 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">Login</h1>
				</div>
				<div class="panel-body">
					<?=form_open('Login')?>
					<!-- <form action="Login" method="post"> -->
		 				<div class="form-group">
		 					<!-- <input type="text" name="email" class="form-control" placeholder="Email"> -->
		 					<?php 
		 					echo form_input(array(
		 						'type' => 'text',
		 						'name' => 'email',
		 						'class' => 'form-control',
		 						'placeholder' => 'Email',
		 						// 'required' => 'required'
	 						));
		 					 ?>
		 				</div>
		 				<div class="form-group">
		 					<!-- <input type="password" name="password" class="form-control" placeholder="Password" required=required> -->
		 					<?php 
		 					echo form_input(array(
		 						'type' => 'password',
		 						'name' => 'password',
		 						'class' => 'form-control',
		 						'placeholder' => 'Password',
		 						// 'required' => 'required'
	 						));
		 					 ?>
		 				</div>
		 				<button type='submit' class="btn btn-success">登入</button>
		 				<a href='Register' class="btn btn-primary">註冊</a>
		 			</form>
				</div>
			</div>
			<?=validation_errors()?>
			<?php 
			if (isset($this->session->Err)) {
					echo $this->session->Err;
			}
			if (isset($this->session->success)) {
					echo $this->session->success;
			}
			?>
 		</div>
 	</div>
 </div>