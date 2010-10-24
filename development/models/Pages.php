<?

class Pages extends HM_Model {
    
    private $title;
    private $id;
    private $uri_1;
    private $uri_2;
    private $js;
    private $css;
    
    function Pages(){
        
        parent::HM_Model();
        $this->uri_1 = $this->uri->segment(1, '@');
        $this->uri_2 = $this->uri->segment(2, '@');

    }
    
    function get_id(){
        
        $query = $this->db->get_where('pages', array('uri-1' => $this->uri_1, 'uri-2' => $this->uri_2), 1);
        $result = $query->row();
        $this->id = $result->id;
        return $result->id;
        
    }
    
    function fetch_tags(){
        
        $this->get_id();
        
        $sql = sprintf('SELECT * FROM `pages-tags` AS pt LEFT JOIN tags AS t ON pt.tag_id=t.id WHERE pt.page_id=%s', $this->id);
        $query = $this->db->query($sql);
        $result = $query->result_array();
        echo '<pre>' . print_r($result, TRUE) . '</pre>';
        $ret = $this->sort_tags($result);
        echo '<pre>' . print_r($ret, TRUE) . '</pre>';
        return $ret;
    }
    
    function sort_tags($array = array()){
        
        $_array = array();
        
        foreach ($array as $row){
            
            switch ($row['type']){
                
                case 'title':
                $_array['title'][] = '<title>' . $row['value'] . '</title>';
                break;
                
                case 'meta':
                $_array['meta'][] = '<meta name="' . $row['value'] . '" content="' . $row['data'] . '" />';
                break;
                
                case 'js':
                $_array['js'][] = '<script type="text/javascript" src="' . $row['value'] . '" ' . $row['data'] . '></script>';
                break;
                
                case 'css':
                $_array['css'][] = '<link rel="stylesheet" type="text/css" href="' . $row['value'] . '" ' . $row['data'] . '/>';
                break;
            
            }
        }
    
        return $_array;
    }
}

?>