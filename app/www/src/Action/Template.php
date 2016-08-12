<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\App\Www\Action;

use Cradle\Framework\App;
use Cradle\Http\Request;
use Cradle\Http\Response;

/**
 * Factory for model related flows
 *
 * @vendor   Cradle
 * @package  Framework
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Template
{
    protected $app;

    /**
     * Sets the app and model
     */
    public function __construct(App $app)
    {
    	$this->app = $app;
    }

    public function body(Request $request, Response $response, $template) {
    	$handlebars = $this->app->package('global')->handlebars();

    	$file = __DIR__.'/../template/'.strtolower($template).'.html';

    	if(!file_exists($file)) {
    		return $this;
    	}

    	$template = $handlebars->compile(file_get_contents($file));

    	$response->setContent($template(array(
    		'results' => $response->getResults(),
    		'content' => $response->getContent()
    	)));
    }

    public function page(Request $request, Response $response, $title) {
    	$handlebars = $this->app->package('global')->handlebars();

    	$file = __DIR__.'/../template/_page.html';

    	if(!file_exists($file)) {
    		return $this;
    	}

    	$template = $handlebars->compile(file_get_contents($file));

    	$response->setContent($template(array(
    		'title'	=> $title,
    		'results' => $response->getResults(),
    		'content' => $response->getContent()
    	)));	
    }
}
