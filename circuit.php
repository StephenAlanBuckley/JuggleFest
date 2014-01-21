<?php

class Circuit {
  public $index;

  public $hand_eye_coordination;
  public $endurance;
  public $pizzazz;

  public $minimum_entry = 0;

  public $juggler_stack = array();
  public $maximum_jugglers;

  public function __construct($id, $hand, $endu, $pizza) {
    $this->index = $id;
    $this->hand_eye_coordination = $hand;
    $this->endurance = $endu;
    $this->pizzazz = $pizza;
  }

  public function juggler_evaluation($juggler) {
    $H = $juggler->hand_eye_coordination * $this->hand_eye_coordination;
    $E = $juggler->endurance * $this->endurance;
    $P = $juggler->pizzazz * $this->pizzazz;

    return $H + $E + $P;
  }

  public function does_juggler_qualify($juggler) {
    if ($this->is_room_left()) {
      return true;
    }
    $fitness = $juggler->get_preference_fit($this->index);
    if ($fitness > $minimum_entry) {
      return true;
    } else {
      return false;
    }
  }

  public function is_room_left() {
    return (count($this->juggler_stack) < $this->maximum_jugglers);
  }

  public function set_max_jugglers($max) {
    $this->maximum_jugglers = $max;
  }

  public function make_room_for($juggler, $circuits_array) {
    if ($this->is_room_left()) {
      $this->juggler_stack[] = $juggler;
      $this->sort_jugglers_by_fit();
      return null;
    } else {
      $disqualified_juggler = array_shift($this->juggler_stack);
      $this->juggler_stack[] = $juggler;
      $this->sort_jugglers_by_fit();
      return $disqualified_juggler;
    }
  }

  public function sort_jugglers_by_fit() {
    usort($this->juggler_stack, array("Circuit", "compare_fitness"));
    $this->minimum_entry = $this->juggler_stack[0]->get_preference_fit($this->index);
  }

  public function compare_fitness($juggler_a, $juggler_b) {
    $fit_a = $juggler_a->get_preference_fit($this->index);
    $fit_b = $juggler_b->get_preference_fit($this->index);

    if ($fit_a === $fit_b) {
      return 0;
    }

    return ($fit_a < $fit_b) ? -1 : 1;
  }
}
