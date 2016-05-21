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

namespace CodingMatters\Membership\Service;

use Zend\Authentication\AuthenticationServiceInterface;
use CodingMatters\Membership\Option\RoutingConfigOptionInterface;

final class AuthenticationService implements AuthenticationServiceInterface
{
    /** @var RoutingConfigOptionInterface  */
    private $router;

    private $identity = false;

    public function __construct(RoutingConfigOptionInterface $router)
    {
        $this->router = $router;
    }

    public function loginPath()
    {
        return $this->router->getLoginRedirectPath();
    }

    public function basePath()
    {
        return $this->router->getBaseRedirectPath();
    }

    public function registrationPath()
    {
        return $this->router->getRegistrationRedirectPath();
    }

    public function logoutPath()
    {
        return $this->router->getLogoutRedirectPath();
    }

    public function hasIdentity()
    {
        $this->authenticate();
        return $this->getIdentity();
    }

    public function getIdentity()
    {
        return $this->identity;
    }

    public function clearIdentity()
    {
        unset($this->indentity);
        return $this->getIdentity();
    }

    public function authenticate()
    {
        $this->identity = true;
    }
}
