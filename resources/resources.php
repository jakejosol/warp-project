<?php

/*
 * Resource Manager
 * @author Jake Josol
 * @description Determines the resources used by the app
 */
 
/****************************************
RESOURCES
****************************************/
// Styles
Resource::ImportStyle("http://fonts.googleapis.com/css?family=Source+Sans+Pro", true);
Resource::ImportStyle("jquery/jquery.chosen.css");
Resource::ImportStyle("jquery/jquery.typeahead.css");
Resource::ImportStyle("bootstrap.css");
Resource::ImportStyle("bootstrap/bootstrap.chosen.css");
Resource::ImportStyle("bootstrap/bootstrap.theme.css");
Resource::ImportStyle("bootstrap/bootstrap.datepicker.css");
Resource::ImportStyle("fontawesome.css");
Resource::ImportStyle("mediaelementplayer.css");

// Scripts
Resource::ImportScript("jquery.js");
Resource::ImportScript("jquery/jquery.chosen.js");
Resource::ImportScript("jquery/jquery.typeahead.js");
Resource::ImportScript("jquery/jquery.scrollto.js");
Resource::ImportScript("bootstrap.js");
Resource::ImportScript("bootstrap/bootstrap.datepicker.js");
Resource::ImportScript("mediaelement-and-player.min.js");

?>