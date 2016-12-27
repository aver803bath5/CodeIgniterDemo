<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 ?>
 <div class="container">
 	<div class="row">
 		<div class="col-md-5 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title"><?=$title?></h1>
				</div>
				<div class="panel-body">
					<?=form_open('Management/UpdateUser/'.$user->id)?>
		 				<div class="form-group">
		 					<?php 
		 					echo form_input(array(
		 						'type' => 'text',
		 						'name' => 'email',
		 						'class' => 'form-control',
		 						'placeholder' => 'Email',
		 						'value' => $user->email
	 						));
		 					 ?>
		 				</div>
		 				<div class="form-group">
		 					<?php 
		 					echo form_input(array(
		 						'type' => 'password',
		 						'name' => 'password',
		 						'class' => 'form-control',
		 						'placeholder' => 'Password',
		 						'value' => $user->password
	 						));
		 					 ?>
		 				</div>
		 				<button type='submit' class="btn btn-success">註冊</button>
		 			</form>
				</div>
			</div>
			<?=validation_errors()?>
 		</div>
 	</div>
 </div>