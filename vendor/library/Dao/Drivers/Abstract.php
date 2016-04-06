<?php

abstract class Abstract {

	abstract public function fetchOne( $query );

	abstract public function fetchAll( $query );

	abstract public function insert( $data );

	abstract public function delete( $query );
}