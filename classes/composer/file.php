<?php

namespace mageekguy\atoum\standard_edition\composer;

class file
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return is_file($this->path);
    }

    /**
     * @return array
     */
    protected function load()
    {
        if (false === ($content = file_get_contents($this->getPath()))) {
            return [];
        }

        $decodedContent = json_decode($content, true);

        if (!is_array($decodedContent)) {
            return [];
        }

        return $decodedContent;
    }

    /**
     * @return array
     */
    public function listAbsoluteAutoloadPaths()
    {
        $lister = new autoloadPathsLister();
        $baseDir = dirname($this->getPath());
        $watchedPaths = [];
        foreach ($lister->listPaths($this->load()) as $path) {
            $watchedPath = $baseDir . DIRECTORY_SEPARATOR . $path;
            if (file_exists($watchedPath)) {
                $watchedPaths[] = $watchedPath;
            }
        }

        return $watchedPaths;
    }
}
