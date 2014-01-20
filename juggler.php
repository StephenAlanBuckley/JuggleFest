<?php

class Juggler {
  public $hand_eye_coordination;
  public $endurance;
  public $pizzazz;

  public $preferences = array[];

  public function set_preference_fit($index, $fit) {
    foreach($this->preferences as $preference) {
      if ($preference['index'] === $index) {
        $preference['fit'] = $fit;
        return true;
      }
    }
    return false;
  }

  public function get_preference_fit($index) {
    foreach($this->preferences as $preference) {
      if ($preference['index'] === $index) {
        return $preference['fit'];
      }
    }
    return null;
  }

  public function sort_into_circuit($circuits_array) {
    foreach ($this->preferences as $preference) {
      $current_circuit = $circuits_array[$preference['index']];
      if ($current_circuit->does_juggler_qualify($this) {
        $current_circuit->make_room_for($this, $circuits_array);
        return;
      }
    }
  }

  public function evaluate_preferences($circuits_array) {
    foreach($this->preferences as $preference) {
      $current_circuit = $circuits_array[$preference['index']];
      $fit = $current_circuit->juggler_evaluation($this);
      $this->set_preference_fit($preference['index'], $fit);
    }
  }
}
