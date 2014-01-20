<?php
/*
 * The purpose of this class is to prevent passing a lot of arrays around.
 * Passing a handful of variables from post to pillar is antithetical to Object Oriented Programming techniques
 * and should be avoided.
 * This is a module; its functpion is contain a list of public variables and to be handed to new instances
 * of the core classes as necessary. Obviously if a class doesn't need any of the module's information then it
 * can forego having the module.
 */

class Global_Module {
  public $circuits_array = array[];
  public $jugglers_array = array[];

  public function read_file_into_arrays($filename) {
    //Write this last!
  }

  public function write_file_from_arrays($filename) {
    //Well, ok, write this last, but you get the idea.
  }
}
?>
