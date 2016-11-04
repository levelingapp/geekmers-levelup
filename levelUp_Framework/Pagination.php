<?php
/**
* @author Luis Vazquez
* Date : 07/01/2011
* Pagination class: 	This class helps for pagination
* @version 1.0
* @copyright Copyright (c) 2011, Luis Vazquez (leveling app)
*/
class Pagination{
	private $current_page;
	private $per_page;
	private $total_count;
	
	function __construct($page = null, $per_page = null, $total_count = null){
		$this->current_page = $page;
		$this->per_page = $per_page;
		$this->total_count = $total_count;
	}
	
	public function setPagination($page = null, $per_page = null, $total_count = null){
		$this->current_page = $page;
		$this->per_page = $per_page;
		$this->total_count = $total_count;
	}	
		
	public function total_pages(){
		return ceil($this->total_count / $this->per_page);
	}
	
	public function previous_page(){
		return $this->current_page - 1;
	}
	
	public function next_page(){
		return $this->current_page + 1;
	}
	
	public function has_previous_page(){
		return $this->previous_page() >= 1 ?true :false;
	}
	
	public function has_next_page(){
		return $this->next_page() <= $this->total_pages() ?true :false;
	}
	
	public function offset(){
		return ($this->current_page - 1) * $this->per_page;
	}

}

?>