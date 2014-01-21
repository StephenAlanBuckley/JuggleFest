<?php

class Juggler {
  public $name;

  public $hand_eye_coordination;
  public $endurance;
  public $pizzazz;

  public $preferences = array();

  public function __construct($id, $hand, $endu, $pizza, $prefs) {
    $this->name = $id;
    $this->hand_eye_coordination = $hand;
    $this->endurance = $endu;
    $this->pizzazz = $pizza;
    foreach ($prefs as $pref) {
      $preference = array("index" => $pref,
                          "fit"   => 0); 
      $this->preferences[] = $preference;
    }
  }

  public function set_preference_fit($index, $fit) {
    foreach($this->preferences as &$preference) {
      if ($preference['index'] == $index) {
        $preference['fit'] = $fit;
        return true;
      }
    }
    return false;
  }

  public function get_preference_fit($index) {
    foreach($this->preferences as &$preference) {
      if ($preference['index'] === $index) {
        return $preference['fit'];
      }
    }
    return null;
  }

  public function sort_into_circuit($circuits_array) {
    foreach ($this->preferences as &$preference) {
      $current_circuit = $circuits_array[$preference['index']];
      if ($current_circuit->does_juggler_qualify($this)) {
        return $current_circuit->make_room_for($this, $circuits_array);
      }
    }
  }

  public function evaluate_preferences($circuits_array) {
    foreach($this->preferences as &$preference) {
      $test = $preference['index'];
      $current_circuit = $circuits_array[$test];
      $fit =  $current_circuit->juggler_evaluation($this);
      $this->set_preference_fit($test, $fit);
    }
  }
}
