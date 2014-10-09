<?php

namespace view;

class Route {
    
    private $indexFile = '';
    private $action = '';
    private $parameters = array();
    
    public function setIndexFile($indexFileToSet) {
        $this->indexFile = $indexFileToSet;
    }
    
    public function setAction($actionToSet) {
        $this->action = $actionToSet;
    }
    
    public function addParameter($parameterToAdd) {
        $this->parameters[] = $parameterToAdd;
    }
    
    public function getIndexFile() {
        return $this->indexFile;
    }
    
    public function getAction()
    {
        return $this->action;    
    }
    
    public function getParameters() {
        return $this->parameters;
    }
}
