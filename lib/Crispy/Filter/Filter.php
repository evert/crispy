<?php

namespace Crispy\Filter;

abstract class Filter {

    /**
     * Should return a human-readable name for the filter. 
     * 
     * @return string 
     */
    abstract function getFilterName();

}
