<?php

	namespace Example\Component;

	use Bolt\IAuth;
	use Bolt\Component;

	class Auth extends Component implements IAuth {

		private static $_instance;
		private $_user = null;
		private $_userRoles = null;
		
		public static function getInstance() {
			if( !self::$_instance ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		private function __construct() {
			@session_start();
		}

		function getUser() {
			if( $this->_user === null ) {
				if( isset( $_SESSION[ 'u' ] ) && isset( $_SESSION[ 't' ] ) ) {
					$user = $this->usingDb( function( $db ) {
						return $db->user->where( 'id', $_SESSION[ 'u' ] )->first();
					});
					if( $user && md5( $user->password ) == $_SESSION[ 't' ] ) {
						$this->_user = $user;
						return $this->_user;
					}
				}
				$this->_user = false;
			}
			return $this->_user ? $this->_user : null;
		}

		function getUserRoles() {
			if( $this->_userRoles === null && $this->_user ) {
				return array_map( function( $userRole ) {
					return $userRole->role->name;
				}, $this->_user->userRole->toArray() );
			}
			return [];
		}

		function login( $data ) {
			$user = $this->usingDb( function( $db ) use( $data ) {
				return $db->user->where( 'login', $data[ 'login' ] )->first();
			});
			if( $user && $user->password == md5( $data[ 'password' ] ) ) {
				$this->saveSession( $user );
				return $user;
			} else {
				throw new \Exception( 'User login and password does not match!' );
			}
		}

		function logout() {
			unset( $_SESSION[ 'u' ], $_SESSION[ 't' ] );
			$_SESSION = [];
			session_destroy();
		}

		private function saveSession( $user ) {
			$this->_user = $user;
			$_SESSION[ 'u' ] = $user->id;
			$_SESSION[ 't' ] = md5( $user->password );
		}
	}