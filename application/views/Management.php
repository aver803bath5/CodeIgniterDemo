<?php
defined('BASEPATH') OR exit("DON'T");

echo "<a href='Management/AddUser' class='btn btn-success'>新增</a>";

$this->table->set_template(array(
	'table_open' => "<table class='table'>"
));
$this->table->set_heading('id', 'email', 'password');

foreach ($users as $user) {
	$updateButton = "<a class='btn btn-primary' href='Management/UpdateUser/". $user->id . "'>修改</a>";
	$deleteButton = "<a class='btn btn-danger' href='Management/DeleteUser/". $user->id . "'>刪除</a>";
	$this->table->add_row($user->id, $user->email, $user->password, $updateButton, $deleteButton);
}
echo $this->table->generate();
// var_dump($users);
?>
