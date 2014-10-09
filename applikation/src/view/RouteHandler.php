<?php

namespace view;

/**
 * Handles the routes
 * 
 * @author Svante Arvedson
 */
class RouteHandler {
   
    /**
     * Returns the request in shape of an array
     * 
     * @return array
     */
    public function getRoute() {
        $requestURI = explode('/', $_SERVER['REQUEST_URI']);
        $route = new Route();

        foreach ($requestURI as $key => $value) {
            //TODO: Remove this when publishing, for development reason only 
            if ($key === 0 || $key === 1 || $key === 2) {
                continue;
            }
            
            if ($value === '') {
                continue;
            }
            
            //TODO: Fix when releasing
            if ($key === 3) {
                $route->setIndexFile($value);
            } else if ($key === 4) {
                $route->setAction($value);
            } else {
                $route->addParameter($value);
            }
        }        

        return $route;
    }
    
}
