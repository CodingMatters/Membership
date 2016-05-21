<?php

/**
 * The MIT License
 *
 * Copyright 2016 Coding Matters, Inc.
 * Author  Gab Amba <gamba@gabbydgab.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace CodingMatters\Membership\Middleware;

use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;

class Authentication implements MiddlewareInterface
{
    /** @var AuthenticationServiceInterface */
    private $service;

    public function __construct(AuthenticationServiceInterface $service)
    {
        $this->service = $service;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $registration   = $this->service->registrationPath();
        $logout         = $this->service->logoutPath();
        $login          = $this->service->loginPath();
        $base           = $this->service->basePath();
        $uri            = $request->getUri();
        $path           = $uri->getPath();

        if ($path === $logout) {
            $this->service->clearIdentity(); // including the user session
            return $this->redirectTo($uri->withPath($login));
        }

        // Disallow to render the view (by default) if not authenticated
        if (!$this->service->hasIdentity()) {
            switch ($path) {
                case $login:
                    return $next($request, $response);
                case $registration:
                    return $next($request, $response);
                default:
                    return $this->redirectTo($uri->withPath($login));
            }
        }

        switch ($path) {
            case $login:
                return $this->redirectTo($uri->withPath($base));
            case $registration:
                return $this->redirectTo($uri->withPath($base));
        }

        return $next($request, $response);
    }

    protected function redirectTo($path)
    {
        return new RedirectResponse($path);
    }
}
