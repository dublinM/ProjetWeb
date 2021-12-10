<?php


class MainController extends Controller
{

	public function index()
	{
		Site::redirect( GENERAL_CONFIG['url'].'/posts' );
	}

}
