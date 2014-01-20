<?php

class Circuit {
  public $hand_eye_coordination;
  public $endurance;
  public $pizzazz;

  public $minumum_entry = 0;

  private $juggler_stack = array();
  private $maximum_jugglers;

  public function does_juggler_qualify($juggler) {
  }

  public function juggler_evaluation($juggler) {
    $H = $juggler->hand_eye_coordination * $this->hand_eye_coordination;
    $E = $juggler->endurance * $this->endurance;
    $P = $juggler->pizzazz * $this->pizzazz;

    return $H + $E + $P;
  }
    
  public function set_max_jugglers($max) {
    $this->maximum_jugglers = $max;
  }

  public make_room_for($juggler) {
    if (count($this->juggler_stack) < $this->maximum_jugglers)) {
      $this->juggler_stack[] = $juggler;
      $this->sort_jugglers_by_fit();
    } else {
      
