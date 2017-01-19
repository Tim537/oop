<?php

class Paginate
{
    public $current_page;
    public $items_per_page;
    public $items_total_count;

    public function __construct($page = 1, $items_per_page = 4, $items_total_count = 0) {
        $this->current_page = (int)$page;
        $this->items_per_page = (int)$items_per_page;
        $this->items_total_count = (int)$items_total_count;
    } // __construct()

    // Return next page
    public function next() {
        return $this->current_page + 1;
    } // next()

    // Return previous page
    public function previous() {
        return $this->current_page - 1;
    } // previous()

    // Return total number of pages
    public function page_total() {
        return ceil($this->items_total_count / $this->items_per_page);
    } // page_total()

    // Return bool if previous page
    public function has_previous() {
        return $this->previous() >= 1 ? true : false;
    } // has_previous()

    // Return bool if next page
    public function has_next() {
        return $this->next() <= $this->page_total() ? true : false;
    } // has_next()

    // Returns the offset
    public function offset() {
        return ($this->current_page - 1) * $this->items_per_page;
    } // offset()

} // End Class