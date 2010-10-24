<?php 

// Tinderbox Bog-Standard Site Model
//
// Contains get/set methods and sitewide variables for a site, based on the
// requested URL.  Allows for multiple Tinderbox sites to be run from the same
// codebase. << beh
//
// All models descend from tb_Model, allowing for pre-model hooks.

class Site extends tb_Model {
    
    public $current_site = array();
    protected $current_url;

    function Site()
    {
        parent::tb_Model();
        $this->current_url = rtrim(ltrim($this->url->current_url(), 'http://'), $this->url->uri_string());
        $this->current_site = $this->config->load($this->current_url);
        
    }
}

?>