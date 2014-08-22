<?php

/*
 * NotFound view
 * @author Jake Josol
 * @description Page not found view
 */
 
 class NotFoundView extends View
 {
	 public function Render()
	 {
		$view = static::GetDefaultViewFile(null, "not_found");
		return $view;
	 }
 }

?>