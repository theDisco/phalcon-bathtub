<?php

namespace Bathtub;

interface RouteAware
{
    /**
     * Adds a route to the router that only match if the HTTP method is GET
     *
     * @param string $pattern
     * @param mixed
     * @return void
     */
    public function addGet($pattern, $paths = null);


    /**
     * Adds a route to the router that only match if the HTTP method is POST
     *
     * @param string $pattern
     * @param mixed
     * @return void
     */
    public function addPost($pattern, $paths = null);


    /**
     * Adds a route to the router that only match if the HTTP method is PUT
     *
     * @param string $pattern
     * @param mixed
     * @return void
     */
    public function addPut($pattern, $paths = null);


    /**
     * Adds a route to the router that only match if the HTTP method is DELETE
     *
     * @param string $pattern
     * @param mixed
     * @return void
     */
    public function addDelete($pattern, $paths = null);


    /**
     * Add a route to the router that only match if the HTTP method is OPTIONS
     *
     * @param string $pattern
     * @param mixed
     * @return void
     */
    public function addOptions($pattern, $paths = null);


    /**
     * Add a route to the router that only match if the HTTP method is PATCH
     *
     * @param string $pattern
     * @param mixed
     * @return void
     */
    public function addPatch($pattern, $paths = null);


    /**
     * Adds a route to the router that only match if the HTTP method is HEAD
     *
     * @param string $pattern
     * @param mixed
     * @return void
     */
    public function addHead($pattern, $paths = null);
}
