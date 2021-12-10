<?php

class UsersController extends Controller
{

	public function index() : void
	{
		$this->model( 'UsersModel' );

		$pagination = $this->UsersModel->pagination( 'users', ( int )$_GET['page'], 5 );
		$sort       = $this->UsersModel->sort( 'user_', ( string )$_GET['sort'], array( 'name', 'email', 'role', 'time' ) );

		$users = $this->UsersModel->readUsers( $pagination, $sort );

		$data = array(
			'title'      => 'Utilisateurs',
			'users'      => $users,
			'pagination' => $pagination,
		);
		
		$this->view( 'users/users', $data );
	}


	public function user( $user_id = 0 ) : void
	{
		$this->model( 'UsersModel' );

		$user = $this->UsersModel->readUser( ( int )$user_id );

		$data = array(
			'title' => '@' . $user['user_name'],
			'user'  => $user,
		);

		$this->view( 'users/user', $data );
	}


	public function sign_up() : void
	{
		$this->model( 'UsersModel' );

		if ( User::login() ) {
			Site::redirect( GENERAL_CONFIG['url'] );
		}

		$role = file_exists( 'install.php' ) ? 'admin' : 'user';

		if ( isset( $_POST['sign-up'] ) ) {
			try {
				$this->UsersModel->signUp( array(
					'name'     => $_POST['user-name'],
					'email'    => $_POST['user-email'],
					'password' => $_POST['user-password'],
					'role'     => $role,
				) );
			} catch ( ValidationException $e ) {
				$errors = $e->getError();
			}
		}

		$data = array(
			'title'  => 'Inscription',
			'errors' => $errors,
		);

		$this->view( 'users/sign-up', $data );
	}


	public function sign_in() : void
	{
		$this->model( 'UsersModel' );

		if ( User::login() ) {
			Site::redirect( GENERAL_CONFIG['url'] );
		}

		if ( isset( $_POST['sign-in'] ) ) {
			try {
				$this->UsersModel->signIn( array(
					'name'     => $_POST['user-name'],
					'password' => $_POST['user-password'],
				) );
			} catch ( ValidationException $e ) {
				$errors = $e->getError();
			}
		}

		$data = array(
			'title'  => 'Connexion',
			'errors' => $errors,
		);

		$this->view( 'users/sign-in', $data );
	}

	public function sign_out() : void
	{
		$this->model( 'UsersModel' );

		if ( User::login() ) {
			$this->UsersModel->signOut();
		}
	}


	public function edit( $user_id = 0 ) : void
	{
		$this->model( 'UsersModel' );

		$user = $this->UsersModel->readUser( ( int )$user_id );

		if ( ! User::author( ( int )$user_id ) && ! User::role( array( 'admin' ) ) ) {
			Site::redirect( GENERAL_CONFIG['url'] );
		}

		if ( isset( $_POST['user-edit'] ) ) {
			try {
				$this->UsersModel->editUser( array(
					'id'    => ( int )$user_id,
					'name'  => $_POST['user-name'],
					'email' => $_POST['user-email'],
					'role'  => $_POST['user-role'],
				) );
			} catch ( ValidationException $e ) {
				$errors = $e->getError();
			}
		}

		if ( ! User::author( $user_id ) ) {
			if ( isset( $_POST['user-change-role'] ) ) {
				try {
					$this->UsersModel->changeUserRole( array(
						'id'    => ( int )$user_id,
						'role'  => $_POST['user-role'],
					) );
				} catch ( ValidationException $e ) {
					$errors = $e->getError();
				}
			}
		}

		if ( isset( $_POST['user-change-password'] ) ) {
			try {
				$this->UsersModel->changeUserPassword( array(
					'id'                   => ( int )$user_id,
					'old-password'         => $_POST['old-password'],
					'new-password'         => $_POST['new-password'],
					'confirm-new-password' => $_POST['confirm-new-password'],
				) );
			} catch ( ValidationException $e ) {
				$errors = $e->getError();
			}
		}

		$data = array(
			'title'  => 'Edition @' . $user['user_name'],
			'user'   => $user,
			'errors' => $errors,
		);

		$this->view( 'users/edit', $data );
	}

	public function delete( $user_id = 0 ) : void
	{
		$this->model( 'UsersModel' );

		if ( User::author( ( int )$user_id ) || User::role( array( 'admin' ) ) ) {
			$this->UsersModel->deleteUser( ( int )$user_id );
		}
	}

}

class_alias( 'UsersController', 'Users' );
