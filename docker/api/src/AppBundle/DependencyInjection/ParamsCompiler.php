<?php

namespace AppBundle\DependencyInjection;

class ParamsCompiler
{
    /**
     * @param array  $configs
     * @param string $prefix
     *
     * @return array
     */
    public static function compile($configs, $prefix)
    {
        $parameters = [];

        foreach ($configs as $name => $value) {
            $parameterName              = sprintf('%s.%s', $prefix, $name);
            $parameters[$parameterName] = $value;

            if (is_array($value)) {
                $parameters = array_merge($parameters, self::compile($value, $parameterName));
            }
        }

        return $parameters;
    }
}
