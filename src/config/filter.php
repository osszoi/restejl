<?php
  class Filter {
    private $field;
    private $operator;
    private $value;

    public function __construct($s) {
      preg_match_all('/^([A-Za-z\.\_]+)([\<\>\:\%]{1,2})(.+)/', $s, $matches);

      $this->field = $matches[1][0];
      $this->operator = str_replace(':', '=', $matches[2][0]);
      $this->value = $matches[3][0];
    }

    public function getField() {
      return $this->field;
    }

    public function getOperator() {
      return $this->operator;
    }

    public function getValue() {
      return $this->value;
    }

    public static function extractFilters($s) {
      $filters = [];
      
      // TODO: Fix the case when there's a comma or a colon in any of the fields
      foreach (explode(',', $s) as $filter) {
        $filters[] = new Filter($filter);
      }

      return $filters;
    }
  }
?>