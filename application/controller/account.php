<?php

	namespace Example\Controller;
	use Example\Component\Auth;

	class Account extends Base {

		function mainAction() {
			$expertise = $this->usingDb( function( $db ) {
				$expertises = $db->mentorExpertise->quantity( 1000 )->fetch();
				$parents = [];
				foreach( $expertises as $expertise ) {
					$parts = explode( '/', $expertise->slug );
					if( count( $parts ) > 1 ) {
						$expertise->parentId = $parents[ $parts[ 0 ] ]->id;
						$expertise->save();
					} else {
						$parents[ $expertise->slug ] = $expertise;
					}
				}
			});

			die( 'done' );
			if( $this->getUser() ) {
				$this->redirect( 'home/main' );
			} else {
			    return $this->view();
			}
		}

		function mainPostAction( $user ) {
			try {
				Auth::getInstance()->login( $user );
				$this->redirect( 'home/main' );
			} catch( \Exception $ex ) {
				return $this->view( $ex->getMessage() );
			}
		}
	}