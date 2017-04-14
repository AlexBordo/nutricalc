<?php

namespace NutriCalc\Component\Router;

use NutriCalc\Component\Router\Exception\RouterException;

class RoutesParser
{
    const INT = '[0-9]';

    const STR = '[a-zA-Z]';

    const MIX = '[0-9a-zA-Z]';

    const PARAM_MAX_LEN = '100';

    const FIND_PARAM_REGEX = '~{([^,]+?)}~s';

    const DEFAULT_PARAM_REGEX = '(' . self::MIX . '{1,' . self::PARAM_MAX_LEN . '})';

    const PARAMETERS = [
        'INT' => self::INT,
        'STR' => self::STR,
        'MIX' => self::MIX
    ];

    /**
     * @var string
     */
    private $routesPath;

    /**
     * @var array
     */
    private $routesRaw;

    /**
     * @var array
     */
    private $routes = [];

    public function __construct($routesPath)
    {
        $this->routesPath = $routesPath;

        if (!file_exists($routesPath)) {
            throw new RouterException("Routes File Not Found in '{$routesPath}'");
        }

        $this->routesRaw = include($routesPath);
    }

    /**
     * Transforms routes configuration file to
     *
     * @return $this
     */
    public function parseRoutes()
    {
        foreach ($this->routesRaw as $url => $routeParams) {

            $innerPath = preg_replace('~:~', '/', array_shift($routeParams));

            $originalUrl = $url;

            foreach ($routeParams as $param => $rule) {

                if (strpos($rule, ':')) {
                    list($rules['type'], $rules['len']) = explode(':', $rule);
                } else {
                    $rules['type'] = $rule;
                    $rules['len'] = self::PARAM_MAX_LEN;
                }

                if (array_key_exists($rules['type'], self::PARAMETERS)) {
                    $routeParams[$param] = '(' . self::PARAMETERS[$rules['type']] . '{1,' . $rules['len'] . '})';

                    // replace parameter's placeholder (e.g. '{param1}') by regex
                    $url = preg_replace("~{{$param}}~", $routeParams[$param], $url);
                }
            }

            // replace not configured parameters placeholders by default regex
            $url = preg_replace(self::FIND_PARAM_REGEX, self::DEFAULT_PARAM_REGEX, $url);

            // find parameters quantity from url
            preg_match_all(self::FIND_PARAM_REGEX, $originalUrl, $out);
            $paramsQuantity = count($out[0]);

            // append inner path with placeholders for each parameter
            for ($i = 1; $i <= $paramsQuantity; $i++) {
                $innerPath .= "/\${$i}";
            }

            $this->routes[$url] = $innerPath;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}