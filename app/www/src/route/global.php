<?php 

use Cradle\Framework\App;
use Cradle\Framework\Flow;

return App::i()

//add routes here
->get('/', 'Hello World')
->get('/foo/bar', 'something awesome')

//add flows here
->flow(
	'Hello World',
	Flow::www()->template->body('home'),
	Flow::www()->template->page('hello')
)

->flow(
	'something awesome',
	Flow::www()->foobar->foobar,
	function($req, $res) {
		$res->setContent('awesome');
	},
	Flow::www()->template->body('display'),
	Flow::www()->template->page('hello')	
);