<?php

class Landing extends Controller {

	function Landing()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->render->simple('landing/front');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

?>