<?php
class Pagination {
    private $page_number;
    private $records_per_page;
    private $total_rows;
    
    public function __construct($page_number, $records_per_page, $total_rows) {
        $this->page_number = $page_number;
        $this->records_per_page = $records_per_page;
        $this->total_rows = $total_rows;
    }
    
    public function page_number() {
        return $this->page_number;
    }
    
    public function total_pages() {
        return ceil($this->total_rows / $this->records_per_page);
    }
    
    public function has_previous_page() {
        return $this->page_number > 1;
    }
    
    public function has_next_page() {
        return $this->page_number < $this->total_pages();
    }
    
    public function previous_page() {
        return $this->page_number - 1;
    }
    
    public function next_page() {
        return $this->page_number + 1;
    }
}
