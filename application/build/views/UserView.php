<?php

/*
 * User view
 * @author Jake Josol
 * @description User view
 */
 
 class UserView extends CrudView
 {
	 protected static $model = "UserModel";
	 protected static $layout = "default.php";
	 protected static $path = "user";
 }

?>