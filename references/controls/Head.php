<?php

/*
 * Head control
 * @author Jake Josol
 * @description Head
 */

use Warp\UI\Control;

class Head extends Control
{
	protected $type = "head";
	protected static $name = "Head";
	
	public function Bootstrap()
	{
		$this
		->AddChild(Title::Create()->SetText(App::Meta()->Title() . " - " . App::Meta()->Subtitle()))
		->AddChild(Meta::Create()->SetProperty("http-equiv","X-UA-Compatible")->SetContent("IE=edge"))
		->AddChild(Meta::Create()->SetName("charset")->SetContent("utf-8"))
		->AddChild(Meta::Create()->SetName("viewport")->SetContent("width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"))
		->AddChild(Meta::Create()->SetName("description")->SetContent(App::Meta()->Description()))
		->AddChild(Text::Create(Resource::Render()));
	}
}
		

?>