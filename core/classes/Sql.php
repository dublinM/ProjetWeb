<?php

class Sql
{

	private static $instance = NULL;

	public static function query()
	{
		self::$instance = new self();

		return self::$instance;
	}

	public function get()
	{
		$array = ( array )$this;
		$string = implode( ' ', $array );

		return $string;
	}


	public function and( string $options )
	{
		$query_part = 'AND ' . $options;
		$this->and = $query_part;

		return $this;
	}


	public function as( string $options )
	{
		$query_part = 'AS ' . $options;
		$this->as = $query_part;

		return $this;
	}


	public function delete()
	{
		$query_part = 'DELETE';
		$this->delete = $query_part;

		return $this;
	}


	public function from( string $options )
	{
		$query_part = 'FROM ' . $options;
		$this->from = $query_part;

		return $this;
	}


	public function innerJoin( string $options )
	{
		$query_part = 'INNER JOIN ' . $options;
		$this->innerJoin = $query_part;

		return $this;
	}


	public function insertInto( string $options )
	{
		$query_part = 'INSERT INTO ' . $options;
		$this->insertInto = $query_part;

		return $this;
	}


	public function limit( string $options )
	{
		$query_part = 'LIMIT ' . $options;
		$this->limit = $query_part;

		return $this;
	}


	public function on( string $options )
	{
		$query_part = 'ON ' . $options;
		$this->on = $query_part;

		return $this;
	}


	public function or( string $options )
	{
		$query_part = 'OR ' . $options;
		$this->or = $query_part;

		return $this;
	}

	public function orderBy( string $options )
	{
		$query_part = 'ORDER BY ' . $options;
		$this->orderBy = $query_part;

		return $this;
	}


	public function select( string $options = '*' )
	{
		$query_part = 'SELECT ' . $options;
		$this->select = $query_part;

		return $this;
	}


	public function set( string $options )
	{
		$query_part = 'SET ' . $options;
		$this->set = $query_part;

		return $this;
	}


	public function update( string $options )
	{
		$query_part = 'UPDATE ' . $options;
		$this->update = $query_part;

		return $this;
	}

	public function values( string $options )
	{
		$query_part = 'VALUES ' . $options;
		$this->values = $query_part;

		return $this;
	}


	public function where( string $options )
	{
		$query_part = 'WHERE ' . $options;
		$this->where = $query_part;

		return $this;
	}

}
