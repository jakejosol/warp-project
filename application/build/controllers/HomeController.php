<?php

/*
 * Home controller
 * @author Jake Josol
 * @description Home controller
 */

class HomeController extends Controller
{
	public function IndexAction($parameters)
	{
		$homeView = new HomeView;
		return $homeView->Render();
	}
}

?>