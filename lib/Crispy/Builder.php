<?php

namespace Crispy;

class Builder {

    protected $ignore;
    protected $source;
    protected $destination;

    protected $filters = [];

    function __construct() {

        $this->addFilter('**', new Filter\Copy());
        $this->addFilter('*.md', new Filter\Markdown());

    }

    function setConfig(array $config) {

        $this->ignore = $config['ignore'];
        $this->source = $config['source'];
        $this->destination = $config['destination']; 

    }
    
    function buildAsset($path) { 

        $filters = $this->getFilters($path);
        echo $path;
        foreach($filters as $filter) {
            echo " [" . $filter->getFilterName() . "]";
        }
        echo "\n";

    }

    function buildAll() {

        $tree = new \RecursiveDirectoryIterator($this->source,  \FilesystemIterator::SKIP_DOTS );
        $assets = [];

        $iterate = null;
        $iterate = function($it) use (&$assets, &$iterate) {

            foreach($it as $item) {

                $pathName = $it->getSubPathName();
                foreach($this->ignore as $ignore) {
                    if (fnmatch($ignore, $pathName)) {
                        continue 2;
                    }
                }
                if (!$item->isDir()) {
                    $assets[] = $pathName;
                } 

                if ($it->hasChildren()) {
                    $iterate($it->getChildren());
                }

            }

        };

        $iterate($tree);
        foreach($assets as $asset) {
            $this->buildAsset($asset);
        }

    }

    function addFilter($pattern, Filter\Filter $filter) {

        $this->filters[] = [$pattern, $filter];

    } 

    function getFilters($path) {

        foreach(array_reverse($this->filters) as $filter) {

            if (fnmatch($filter[0], $path)) {
                return is_array($filter[1]) ? $filter[1] : [$filter[1]];
            }

        }

    }

}
