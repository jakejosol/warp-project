<?php

/*
 * Routes
 * @author Jake Josol
 * @description Determines the routes used by the app
 */

/****************************************
IMPORTED ROUTES
****************************************/

Router::Import("api");
Router::Import("engine");

/****************************************
GENERAL ROUTES
****************************************/

Router::Home("HomeController");
Router::None("NotFoundController");