<?php

declare(strict_types=1);

namespace Mad\Yaml;

use Mad\Base\Exception\BaseException;
use Symfony\Component\Yaml\Yaml;

class YamlConfig
{

    /**
     * A method to check if the specified yaml configuration file exists
     * within the specified directory else throw an exception
     *
     * @param string $fileName
     * @return boolean
     * @throws BaseException
     */
    private function isFileExists(string $fileName)
    {
        if (!file_exists($fileName)) {
            throw new BaseException($fileName . ' does not exist.');
        }
    }


    /**
     * A method to load yaml configuration
     *
     * @param string $yamlFile
     * @return void
     * @throws ParseException
     */
    public function getYaml(string $yamlFile)
    {
        foreach (glob(CONFIG_PATH . DS . '*.yaml') as $file) {
            $this->isFileExists($file);
            $parts = parse_url($file);
            $path = $parts['path'];
            if (strpos($path, $yamlFile) !== false) {
                return Yaml::parseFile($yamlFile);
            }
        }
    }


    /**
     * A method to load yaml configuration into yaml parser
     *
     * @param string $yamlFile
     * @return void
     */
    public static function file(string $yamlFile)
    {
        return (new YamlConfig)->getYaml($yamlFile);
    }

}
