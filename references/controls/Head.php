<?php

/*
 * Head control
 * @author Jake Josol
 * @description Head
 */

use Warp\Control;
use Warp\Application;
use Warp\Resource;

class Head extends Control
{
	protected $type = "head";
	protected static $name = "Head";
	
	public function Bootstrap()
	{
		$this
		->AddChild(Title::Create()->SetText(Application::GetInstance()->GetTitle() . " - " . App::GetInstance()->GetSubtitle()))
		->AddChild(Meta::Create()->SetProperty("http-equiv","X-UA-Compatible")->SetContent("IE=edge"))
		->AddChild(Meta::Create()->SetName("charset")->SetContent("utf-8"))
		->AddChild(Meta::Create()->SetName("viewport")->SetContent("width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"))
		->AddChild(Meta::Create()->SetName("description")->SetContent(Application::GetInstance()->GetDescription()))
		->AddChild(Text::Create(Resource::Render()));
	}
}
		

?>