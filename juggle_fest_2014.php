<?php
require_once 'circuit.php';
require_once 'juggler.php';
require_once 'global_module.php';

public function sort_all_jugglers($juggler_array, $circuits_array){
  foreach ($juggler_array as $juggler) {
    $juggler->sort_into_circuit($circuits_array);
  }
}

public function evaluate_all_juggler_preferences($juggler_array, $circuits_array) {
  foreach ($juggler_array as $juggler) {
    $juggler->evaluate_preferences($circuits_array);
  }
}

