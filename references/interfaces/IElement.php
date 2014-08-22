<?php

/*
 * Element interface
 * @author Jake Josol
 * @description Interface for creating UI elements
 */

interface IElement
{	
	public function Initialize($id, $parameters);
	public function Render();
}

?>