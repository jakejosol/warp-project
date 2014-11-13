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
		return HomeView::Make()->Render();
	}
}

?>