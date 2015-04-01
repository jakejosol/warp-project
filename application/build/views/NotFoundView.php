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
		return View::Make()->Layout("public.php")->Page("not_found")->Render();
	 }
 }

?>