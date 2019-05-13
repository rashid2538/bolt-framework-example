<?php

	namespace Example\Controller;

	class Home extends Secure {

		function mainAction() {
			$this->htmlJs( 'js/app' );
			return $this->view( $this->getUser()->todoList->fetch() );
		}

		function logoutAction() {
			\Example\Component\Auth::getInstance()->logout();
			$this->redirect( 'account/main' );
		}

		function addTodoItemPostAction( $newItem ) {
			$found = false;
			foreach( $this->getUser()->todoList->fetch() as $list ) {
				if( $newItem[ 'todoListId' ] == $list->id ) {
					$found = true;
					break;
				}
			}
			return $this->json( $found ? $this->usingDb( function( $db ) use( $newItem ) {
				$item = $db->todoListItem->add( $newItem );
				$item->save();
				return $item;
			}) : false );
		}
	}