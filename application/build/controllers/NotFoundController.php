<?php

/*
 * Not Found controller
 * @author Jake Josol
 * @description Not Found controller
 */

class NotFoundController extends Controller
{
	public function IndexAction($parameters=null)
	{
		return NotFoundView::Make()->Render();
	}
}

?>