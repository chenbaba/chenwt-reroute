<?php

namespace Illuminate\Routing\Matching;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class UriValidator implements ValidatorInterface
{
    /**
     * Validate a given rule against a route and request.
     *
     * @param \Illuminate\Routing\Route $route
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public function matches(Route $route, Request $request)
    {
        if (true === config('reroute.enabled')) {
            $path = rtrim($request->get(config('reroute.route_params')), '/') ?: '/';
        } else {
            $path = rtrim($request->getPathInfo(), '/') ?: '/';
        }
        return preg_match($route->getCompiled()->getRegex(), rawurldecode($path));
    }
}
