<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Tinderbox Rendering Library
//
// All write-out functions go here, period.
// No other controller, model or library should echo back to the browser,
// except for the Json library, which is just this library with json_encode() 
// wrapping all echoes.
//
// NO ECHOING ELSEWHERE! << beh

class Render {

    protected $ci; 
    
    public $js;
    public $css;
    
    public $header;
    public $content;
    public $footer;
    
    function Render(){
        
        $this->ci =& get_instance();
        
        $this->js = $this->ci->load->view('core/js', '', true);
        $this->css = $this->ci->load->view('core/css', '', true);
        $this->header = $this->ci->load->view('core/header', '', true);
        $this->footer = $this->ci->load->view('core/footer', '', true);
        
    }

    function simple($content){
        
        $this->content = $this->ci->load->view($content, '', true);
        $_array = $this->build();
        $_page = $this->assemble($_array);
        
        echo $_page;
        
    }
    
    function wordpress($tag){
        
        $data = array('tag' => $tag);
        $this->content = $this->ci->load->view('core/wp', $data, true);
        $_array = $this->build();
        $_page = $this->assemble($_array);
        
        echo $_page;
        
    }

    private function build(){
        
        $_array = array('js' => $this->js, 'css' => $this->css, 'header' => $this->header, 'content' => $this->content, 'footer' => $this->footer);
        
        return $_array;
    }
    
    private function assemble($data){
        
        $page = $this->ci->load->view('core/shell', $data, true);
        
        return $page;
        
    }
    
}

?>