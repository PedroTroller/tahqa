<?php

namespace Sanitizer;

use Exception;
use Symfony\Component\Yaml\Yaml;

class Compose
{
    /**
     * @param string $file
     */
    public function fix($file)
    {
        if (false === file_exists($file)) {
            throw new Exception(sprintf('File %s not found', $file));
        }

        $content = file_get_contents($file);
        $data = Yaml::parse($content);

        if (false === array_key_exists('version', $data) || '2' !== $data['version']) {
            throw new Exception('The version 2 of docker compose is the only supported version');
        }

        if (false === array_key_exists('services', $data)) {
            return;
        }

        foreach ($data['services'] as $name => $service) {
            if (array_key_exists('ports', $service)) {
                unset($service['ports']);
            }

            $data['services'][$name] = $service;

            if (isset($service['extends']['file'])) {
                $directory = dirname($file);

                $this->fix(sprintf('%s/%s', $directory, $service['extends']['file']));
            }
        }

        file_put_contents($file, Yaml::dump($data, 6));
    }
}
