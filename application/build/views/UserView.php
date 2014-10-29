<?php

/*
 * User view
 * @author Jake Josol
 * @description User view
 */

use Warp\Utils\Traits\CrudViewTrait;
 
 class UserView extends View
 {
 	use CrudViewTrait;

	protected static $model = "UserModel";
	protected static $layout = "default.php";
	protected static $path = "user";
 }

?>