<?php

/*
 * PatternList class
 * @author Jake Josol
 * @description A list for holding Regular Expression patterns
 */
 
class PatternList
{
	protected $patterns = array();
	protected $aliases = array();
	protected $match;
		
	public function AddPattern($pattern, $action)
	{
		foreach($this->patterns as $patternItem)
			if($patternItem["pattern"] == $pattern) return $this;
			
		$this->patterns[] = array(
			"pattern" => $pattern,
			"action" => $action
		);

		return $this;
	}

	public function SetDefault($action)
	{
		if(count($this->match) == 0)
			$this->match = array(
				"pattern" => null,
				"action" => $action
			);
		
		return $this;
	}
	
	public function FindMatch($pattern)
	{
		foreach($this->patterns as $patternItem)
		{
			if(preg_match($patternItem["pattern"], $pattern))
			{
				$this->match = $patternItem;
				return $this;
			}
		}
		
		return $this;
	}
	
	public function Execute()
	{
		if(!$this->match) return;
		$action = $this->match["action"];
		return $action();
	}
}
 
?>