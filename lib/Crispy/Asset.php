<?php

namespace Crispy;

class Asset {

    /**
     * Source path 
     * 
     * @var string 
     */
    protected $source;

    /**
     * Ouput path
     * 
     * @var string 
     */
    protected $destination;

    public function __construct($source, $destination) {

        $this->source = $source;
        $this->destination = $destination;

    }

}
