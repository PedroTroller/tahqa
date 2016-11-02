<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    /**
     * @var string
     */
    private $cacheDir;

    /**
     * @var string
     */
    private $logsDir;

    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new AppBundle\AppBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');

        $loader->load(function ($container) {
            $dist = Yaml::parse(file_get_contents(sprintf('%s/config/parameters.yml.dist', $this->getRootDir())));
            $container->getParameterBag()->add($dist['parameters']);
        });

        if (file_exists($parameters = sprintf('%s/config/parameters.yml', $this->getRootDir()))) {
            $loader->load($parameters);
        }

        $loader->load(function ($container) {
            $dist = Yaml::parse(file_get_contents(sprintf('%s/config/parameters.yml.dist', $this->getRootDir())));

            foreach ($dist['parameters'] as $name => $value) {
                if (strtoupper($name) !== $name) {
                    continue;
                }

                if (false !== $env = getenv($name)) {
                    $container->getParameterBag()->set($name, $env);
                }
            }
        });

        $loader->load(function ($container) {
            $container->getParameterBag()->add($this->getEnvParameters());
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getRootDir()
    {
        return __DIR__;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        return sprintf('%s/%s', getenv('SYMFONY_CACHE_DIR') ?: dirname(__DIR__) . '/app/cache', $this->getEnvironment());
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        return getenv('SYMFONY_LOGS_DIR') ?: dirname(__DIR__) . '/app/logs';
    }
}
