<?php

class HomeController extends Controller
{
	public function IndexAction()
	{
		$homeView = new HomeView;
		return $homeView->Render();
	}
}

?>