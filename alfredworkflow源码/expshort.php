<?php

require_once('workflows.php');

class Expshort{

	private $url = "https://www.expshort.com/api.php?short=";
	
	function __construct() {
		$this->workflows = new Workflows();
	}

	public function get($query){
		if (!empty($query)) {
			$api = $this->url.$query;
			$res = $this->workflows->request($api);
			$res = json_decode( $res );
			if ($res->error == 0) {
				if (empty($res->data)) {
					$this->workflows->result(	
						'',
						'',
			  			'没查到呀',
			  			'',
			  			'icon.png' 
			  		);
				} else {
					$data = $res->data;
					$this->workflows->result( 
						'',
						$query,
						$data->full,//title
						$data->desc,//subtitle
						"icon.png"//icon
					);
				}
			}else{
				$this->workflows->result(	
					'',
					'',
		  			'查询出错了',
		  			'',
		  			'icon.png' 
		  		);
			}

			echo $this->workflows->toxml();
		}
	}
}
// $expshort = new Expshort();
// $expshort->get('aaa');