<?php
class Database {
    public function selectValue($q) { return 0; }
    public function selectRows($q) { return []; }
    public function selectSingleRow($q) { return []; }
}
$database = new Database();
