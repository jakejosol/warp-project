<?php

/*
 * Home controller
 * @author Jake Josol
 * @description Home controller
 */

class HomeController extends Controller
{
	public function IndexAction($parameters=null)
	{
		return HomeView::Make()->Render();
	}
}

?>