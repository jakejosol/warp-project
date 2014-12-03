<?php

/*
 * User view
 * @author Jake Josol
 * @description User view
 */

use Warp\Utils\Traits\View\Crudable;
 
 class UserView extends View
 {
 	use Crudable; 
 	protected static $page = "user";
 }

?>