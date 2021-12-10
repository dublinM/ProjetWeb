<?php


abstract class Controller
{

	private $route  = [];
	private $args   = 0;
	private $params = [];

	function __construct()
	{

		$this->route = explode( '/', URI );

		$this->args  = count( $this->route );

		$this->router();
	}

	/**
	 * Index
	 */
	abstract function index();

	/**
	 * Router
	 */
	private function router() : void
	{
		if ( class_exists( $this->route[1] ) ) {
			if ( $this->args >= 3 ) {
				if ( method_exists( $this, $this->route[2] ) ) {
					$this->uriCaller( 2, 3 );
				} else {
					$this->uriCaller( 0, 2 );
				}
			} else {
				$this->uriCaller( 0, 2 );
			}
		} else {
			if ( $this->args >= 2 ) {
				if ( method_exists( $this, $this->route[1] ) ) {
					$this->uriCaller( 1, 2 );
				} else {
					$this->uriCaller( 0, 1 );
				}
			} else {
				$this->uriCaller( 0, 1 );
			}
		}
	}

	private function uriCaller( int $method, int $param ) : void
	{
		for ( $i = $param; $i < $this->args; $i++ ) {
			$this->params[$i] = $this->route[$i];
		}

		if ( $method === 0 ) {
			call_user_func_array( array( $this, 'index' ), $this->params );
		} else {
			call_user_func_array( array( $this, $this->route[$method] ), $this->params );
		}
	}


	public function model( string $path ) : void
	{
		$class = explode( '/', $path );
		$class = $class[count( $class ) - 1];
		$path  = strtolower( $path );

		require('./app/models/' . $path . '.php' );

		$this->$class = new $class;
	}

	public function view( string $path, array $data = [] ) : void
	{
		if ( is_array( $data ) ) {
			extract( $data );
		}

		require( './app/views/header.php' );
		require('./app/views/' . $path . '.php' );
		require('./app/views/footer.php' );
	}

}
