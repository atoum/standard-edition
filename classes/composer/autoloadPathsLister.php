<?php

namespace mageekguy\atoum\standard_edition\composer;

class autoloadPathsLister
{
    /**
     * @param array $composerContent
     *
     * @return array
     */
    public function listPaths(array $composerContent)
    {
        $paths = [];

        if (isset($composerContent['autoload']['psr-0'])) {
            $paths = array_merge($paths, $this->getPsrPaths($composerContent['autoload']['psr-0']));
        }

        if (isset($composerContent['autoload']['classmap'])) {
            $paths = array_merge($paths, array_values($composerContent['autoload']['classmap']));
        }

        if (isset($composerContent['autoload']['files'])) {
            $paths = array_merge($paths, array_values($composerContent['autoload']['files']));
        }

        if (isset($composerContent['autoload']['psr-4'])) {
            $paths = array_merge($paths, $this->getPsrPaths($composerContent['autoload']['psr-4']));
        }

        return array_values(array_unique($paths));
    }

    /**
     * @param array $psr
     *
     * @return array
     */
    protected function getPsrPaths(array $psr)
    {
        $paths = [];
        foreach ($psr as $item) {
            if (is_array($item)) {
                $paths = array_merge($paths, $item);
            } else {
                $paths[] = $item;
            }
        }

        return $paths;
    }

}
