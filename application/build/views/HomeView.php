<?php

/*
 * Home view
 * @author Jake Josol
 * @description Home view
 */
 
 class HomeView extends View
 {
	 public function Render()
	 {
		$view = static::GetDefaultViewFile(null, "home");
		return $view;
	 }
 }

?>