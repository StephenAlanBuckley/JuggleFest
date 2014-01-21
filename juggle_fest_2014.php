<?php
require_once 'circuit.php';
require_once 'juggler.php';

$juggling_filename = 'fake_fest.txt';

$lines = file($juggling_filename);
$all_jugglers = array();
$all_circuits = array();

foreach ($lines as $line) {
  if ($line[0] === "C") {
    $circuit = create_circuit_from_line($line);
    $all_circuits[] = $circuit;
  } else {
    $juggler = create_juggler_from_line($line);
    $all_jugglers[] = $juggler;
  }
}
$all_circuits = sort_circuits_by_index($all_circuits);

$num_cir = count($all_circuits);
$num_jug = count($all_jugglers);

$max = $num_jug/$num_cir;

foreach ($all_circuits as $circuit) {
  $circuit->set_max_jugglers($max);
}

evaluate_all_juggler_preferences($all_jugglers, $all_circuits);
sort_all_jugglers($all_jugglers, $all_circuits);

function sort_all_jugglers($juggler_array, $circuits_array) {
  $leftovers = array();

  foreach ($juggler_array as $juggler) {
    echo memory_get_usage() . "\n";
    $dq_juggler = $juggler->sort_into_circuit($circuits_array);
    if ($dq_juggler !== null) {
      $leftovers[] = $dq_juggler;
    }
    echo memory_get_usage() . "\n";
  }

  if (count($leftovers) > 0) {
    sort_all_jugglers($leftovers, $circuits_array);
  }
}

function evaluate_all_juggler_preferences($juggler_array, $circuits_array) {
  foreach ($juggler_array as $juggler) {
    $juggler->evaluate_preferences($circuits_array);
  }
}

function create_circuit_from_line($line) {
  $replace = array('C', 'H', 'E', 'P', ':');
  $line = str_replace($replace, '', $line);
  $line = trim($line);
  $parts = explode(' ', $line);
  $circuit = new Circuit($parts[0], $parts[1], $parts[2], $parts[3]);
  return $circuit;
}

function create_juggler_from_line($line) {
  $replace = array('C', 'H', 'E', 'P', 'J', ':');
  $line = str_replace($replace, '', $line);
  $line = str_replace(',', ' ', $line);
  $line = trim($line);
  $parts = explode(' ', $line);
  $juggler = new Juggler($parts[0], $parts[1], $parts[2], $parts[3], array_slice($parts, 4));
  return $juggler;
}

function sort_circuits_by_index($all_circuits) {
  usort($all_circuits, 'index_compare');
  return $all_circuits;
}

function index_compare($cir_a, $cir_b) {
  if ($cir_a->index === $cir_b) {
    return 0;
  } 
  return ($cir_a < $cir_b) ? -1 : 1;
}
