<?php

/**
 * API Class
 * @author Jason Josol
 */
 
class API
{
	const STATUS_SUCCESS = 200;
	const STATUS_UNKNOWN = 404;
	const STATUS_INVALID = 405;
	const MESSAGE_SUCCESS = "Success";
	const MESSAGE_UNKNOWN = "Unknown request";
	const MESSAGE_INVALID = "Invalid request";
	protected static $REQUEST_TYPE = array(
		"REST" => "JSON",
		"SOAP" => "XML"
	);
	
	public static function Request($requestParams, $requestType = "JSON")
	{
		$response = "";
		$controllerName = $requestParams["class"] . "Controller";
		
		switch($requestType)
		{
			case static::$REQUEST_TYPE["REST"]:
				if (class_exists($controllerName) && count($requestParams) > 0) 
				{    
					// Retrieve Array
					$controller = new $controllerName();    
					$actionName = $requestParams["action"] . "Action";
					
					if(method_exists($controller, $actionName))
					{
						$results =  $controller->$actionName(Router::GetURL(), $requestParams["parameters"]);
										
						if($results)
							$response = static::createResponseObject(self::STATUS_SUCCESS, self::MESSAGE_SUCCESS, json_decode($results));
						else
							$response = static::createResponseObject(self::STATUS_INVALID, self::MESSAGE_INVALID, array());	
					}
					else $response = static::createResponseObject(self::STATUS_UNKNOWN, self::MESSAGE_UNKNOWN, array());
				} 
				else
				{    
					$response = static::createResponseObject(self::STATUS_UNKNOWN, self::MESSAGE_UNKNOWN, array());
				}
			break;
			
			case static::$REQUEST_TYPE["SOAP"]:
				if (class_exists($controllerName) && count($requestParams) > 0) 
				{    
					// Retrieve JSON
					$controller = new $controllerName();    
					$actionName = $requestParams["action"] . "Action";
					
					// Convert into an array/object
					$jsonData = json_decode($controller->$actionName(Router::GetURL(), $requestParams["parameters"]));
					
					// Convert into an XML Object
					header("Content-type: text/xml"); 
					$xmlstr = "<?xml version='1.0' encoding='utf-8'?><Start />";
					$responseXML = new SimpleXMLElement($xmlstr);
					static::arrayToXML($jsonData, $responseXML);
										
					$response = $responseXML->asXML();				
				} 
				else 
				{    
					header('HTTP/1.0 400 Bad Request');    
					$response = Debugger::WriteError("Invalid Request. ({$requestParams["class"]})");  
				}
			break;
		}
		
		return $response;
	}
	
	private static function createResponseObject($status, $message, $result)
	{
		$objectResult = array(
			"status" => $status,
			"message" => $message,
			"result" => $result	
		);
		
		return json_encode($objectResult);
	}
	
	private static function arrayToXML($fromArray, $toXML)
	{
		foreach($fromArray as $key => $value) 
		{
			if(is_array($value) || is_object($value)) 
			{
				if(is_object($value))
				{
					$value = (array) $value;
				}
								
				if(!is_numeric($key))
				{
					$subnode = $toXML->addChild("$key");
					static::arrayToXML($value, $subnode);
				}
				else
				{
					$subnode = $toXML->addChild("ITEM");
					$subnode["id"] = $key;
					static::arrayToXML($value, $subnode);
				}
			}
			else 
			{
				$toXML->addChild("$key",htmlspecialchars("$value"));
			}
		}
	}
}

?>