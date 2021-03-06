<?php

/**
 * Net\Faett\AtChurch\Actions\AbstractAction
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category   Net
 * @package    Faett
 * @subpackage AtChurch
 * @author     Tim Wagner <wagner_tim78@hotmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/faett-net/at-church
 */

namespace Net\Faett\AtChurch\Actions;

use AppserverIo\Routlt\DispatchAction;
use AppserverIo\Psr\Servlet\Http\HttpServletRequest;
use AppserverIo\Psr\Servlet\Http\HttpServletResponse;

/**
 * Abstract example implementation that provides some kind of basic MVC functionality
 * to handle requests by subclasses action methods.
 *
 * @category   Net
 * @package    Faett
 * @subpackage AtChurch
 * @author     Tim Wagner <wagner_tim78@hotmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/faett-net/at-church
 */
abstract class AbstractAction extends DispatchAction
{

    /**
     * The applications base URL.
     *
     * @var string
     */
    const BASE_URL = '/';

    /**
     * The servlet request instance.
     *
     * @var \AppserverIo\Psr\Servlet\Http\HttpServletRequest
     */
    protected $servletRequest;

    /**
     * The servlet response instance.
     *
     * @var \AppserverIo\Psr\Servlet\Http\HttpServletResponse
     */
    protected $servletResponse;

    /**
     * This method implements the functionality to invoke a method implemented in its subclass.
     *
     * The method that should be invoked has to be specified by a HTTPServletRequest parameter
     * which name is specified in the configuration file as parameter for the ActionMapping.
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequest  $servletRequest  The request instance
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletResponse $servletResponse The response instance
     *
     * @return void
     */
    public function perform(HttpServletRequest $servletRequest, HttpServletResponse $servletResponse)
    {

        // set servlet request/response
        $this->setServletRequest($servletRequest);
        $this->setServletResponse($servletResponse);

        // call parent method
        parent::perform($servletRequest, $servletResponse);
    }

    /**
     * Sets the servlet request instance.
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequest $servletRequest The request instance
     *
     * @return void
     */
    public function setServletRequest(HttpServletRequest $servletRequest)
    {
        $this->servletRequest = $servletRequest;
    }

    /**
     * Sets the servlet response instance.
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletResponse $servletResponse The request instance
     *
     * @return void
     */
    public function setServletResponse(HttpServletResponse $servletResponse)
    {
        $this->servletResponse = $servletResponse;
    }

    /**
     * Returns the servlet response instance.
     *
     * @return \AppserverIo\Psr\Servlet\Http\HttpServletRequest The request instance
     */
    public function getServletRequest()
    {
        return $this->servletRequest;
    }

    /**
     * Returns the servlet request instance.
     *
     * @return \AppserverIo\Psr\Servlet\Http\HttpServletResponse The response instance
     */
    public function getServletResponse()
    {
        return $this->servletResponse;
    }

    /**
     * Attaches the passed data under the also passed key in the servlet context.
     *
     * @param string $key   The key to attach the data under
     * @param mixed  $value The data to be attached
     *
     * @return void
     */
    public function setAttribute($key, $value)
    {
        $this->context->setAttribute($key, $value);
    }

    /**
     * Returns the data for the passed key.
     *
     * @param string $key The key to return the data for
     *
     * @return mixed The requested data
     */
    public function getAttribute($key)
    {
        return $this->context->getAttribute($key);
    }

    /**
     * Returns base URL for the html base tag.
     *
     * @return string The base URL depending on the vhost
     */
    public function getBaseUrl()
    {

        // if we ARE in a virtual host, return the base URL
        if ($this->getServletRequest()->getContext()->isVhostOf($this->getServletRequest()->getServerName())) {
            return AbstractAction::BASE_URL;
        }

        // if not, prepend it with the context path
        return $this->getServletRequest()->getContextPath() . AbstractAction::BASE_URL;
    }
}
