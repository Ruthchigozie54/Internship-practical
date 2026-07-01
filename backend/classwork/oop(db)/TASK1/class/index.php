<?php

class Animal{
    public string $chain;

    // function __construct($chain){
    // $this->chain = $chain;
    // }
// private, protected public
    private function mate(){
        echo "Mating without chains";
    }

    public function run(){
        echo "Running without chains";
    }

    public function eat(){
        echo "Eating without chains";
    }
}


// $a = new Animal(2);
// constructor
// instantiation, instance of a class

// $a->mate();


