<?php

/*
 * Home controller
 * @author Jake Josol
 * @description Home controller
 */

class HomeController extends Controller
{
	public function IndexAction()
	{
		$homeView = new HomeView;
		return $homeView->Render();
	}
}

?>