<?php

/*
 * Storage interface
 * @author Jake Josol
 * @description Interface for all vendors using file storage
 */

interface IStorage
{
	public function Initialize();
	public function Get($name);
	public function GetURL($name);
	public function Put($name, $temporaryName, $contentType);
}

?>