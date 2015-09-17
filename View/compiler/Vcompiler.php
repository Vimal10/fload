<?php

$config = [
    'original_file_extention' => '.php',
    'cache_file_extention' => '.cache',
    //
    'original_file_path' => './original',
    'cache_file_path' => './cache',
        //
];

class Vicompiler {

    protected $originalExtention;
    protected $cacheExtention;
    ///
    protected $originalPath;
    protected $cachePath;
    //
    private $fileName;
    private $cacheFileName;

    //

    public function __construct($config)
    {
        $this->originalExtention = $config['original_file_extention'];
        $this->cacheExtention = $config['cache_file_extention'];
        //
        $this->originalPath = $config['original_file_path'];
        $this->cachePath = $config['cache_file_path'];
    }

    public function render($fileName)
    {

        $this->makeName($fileName);
        //check if original file exist
        if (!file_exists($this->fileName))
        {
            //if original file not exist show error file not found
            return 'file not found ' . $this->fileName;
        }
        else
        {
            //if original file exist
            //check cache file exist or not
            if (!file_exists($this->cacheFileName))
            {
                //recompile and return from cache
                if ($this->compile($this->fileName))
                {
                    $this->log('new compiled and return from cache');
                    return file_get_contents($this->cacheFileName);
                }
                else
                {
                    $this->log('comilation failed for new file');
                    return 'compilation fail';
                }
            }
            else
            {
                //if cache file exist
                $original_time = filemtime($this->fileName);
                $cache_time = filemtime($this->cacheFileName);
                if ($original_time > $cache_time)
                {
                    if ($this->compile($this->fileName))
                    {
                        $this->log('override cache file and return from cache');
                        return file_get_contents($this->cacheFileName);
                    }
                    else
                    {
                        $this->log('override comilation fail');
                        return 'compilation fail';
                    }
                }
                else
                {
                    //return directly from cache
                    $this->log('return directly from cache');
                    return file_get_contents($this->cacheFileName);
                }
            }
        }
    }

    private function compile($filename)
    {
        $originalContent = file_get_contents($filename);
        $compiledContent = $this->compileProcess($originalContent);
        return file_put_contents($this->cacheFileName, $compiledContent);
    }

    private function compileProcess($data)
    {
        return $data;
    }

    private function makeName($filename)
    {
        $this->fileName = $this->originalPath . '/' . $filename . $this->originalExtention;
        $this->cacheFileName = $this->cachePath . '/' . $this->cacheFileName($filename) . $this->cacheExtention;
        return $this;
    }

    //cache filename
    private function cacheFileName($originalName)
    {
        return md5($originalName);
    }

    private function log($message)
    {
        file_put_contents('./log.txt', $message);
    }

}

$view = new Vicompiler($config);
echo $view->render('hi');
