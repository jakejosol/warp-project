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
		return View::Make()->Layout("public.php")->Page("home")->Render();
	 }
 }

?>