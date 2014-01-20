<?php

public function sort_all_jugglers($juggler_array, $circuits_array){
  foreach ($juggler_array as $juggler) {
    sort_juggler($juggler, $circuits_array);
    }
}

public function sort_juggler($juggler, $circuits_array) {
  foreach ($juggler->preferences as $preference) {
    $current_circuit = $circuits_array[$preference];
    if ($current_circuit->does_juggler_qualify($juggler) {
      $current_circuit->make_room_for($juggler);
      return;
    }
  }
}

public function evaluate_all_juggler_preferences($juggler_array, $circuit_array) {
  foreach ($juggler_array as $juggler) {
    evaluate_jugglers_preferences($juggler, $circuits_array);
  }
}

public function evaluate_jugglers_preferences($juggler, $circuits_array) {
  foreach($juggler->preferences as $preference) {
    $current_circuit = $circuits_array[$preference];
    $fit = $current_circuit->juggler_evaluation($juggler);
    $juggler->set_preference_fit($preference, $fit);
  } 
}
