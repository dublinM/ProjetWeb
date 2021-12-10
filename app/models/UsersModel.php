<?php

class UsersModel extends Model
{


	public function readUsers( array $pagination, array $sort ) : array
	{
		$sql = Sql::query()
			->select( 'user_id, user_created, user_updated, user_name, user_email, user_role' )
			->from( 'users' )
			->orderBy( $sort['by'] . ' ' . $sort['order'] )
			->limit( $pagination['start'] . ', ' . $pagination['perpage'] )
			->get();

		$stmt = $this->db->prepare( $sql );
		$stmt->execute();

		return $stmt->fetchAll( PDO::FETCH_ASSOC );
	}


	public function readUser( int $user_id )
	{
		$sql = Sql::query()
			->select( 'user_id, user_created, user_updated, user_name, user_email, user_role' )
			->from( 'users' )
			->where( 'user_id = :id' )
			->get();

		$data = array(
			'id' => $user_id,
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		return $stmt->fetch( PDO::FETCH_ASSOC );
	}


	public function signUp( array $user ) : void
	{
		Str::validate( $user['name'], true, 255 );
		Email::validate( $user['email'] );
		Str::validate( $user['password'], true, 255 );

		$user_name     = Str::clean( $user['name'] );
		$user_email    = Str::clean( $user['email'] );
		$user_password = password_hash( $user['password'], PASSWORD_DEFAULT );
		$user_role     = in_array( $user['role'], array( 'admin', 'editor', 'user' ) ) ? $user['role'] : 'user';

		if ( ! empty( $user_name ) && ! empty( $user_email ) ) {
			$sql = Sql::query()
				->select( 'user_name, user_email' )
				->from( 'users' )
				->where( 'user_name = :name' )
				->or( 'user_email = :email' )
				->get();

			$data = array(
				'name'  => $user_name,
				'email' => $user_email,
			);

			$stmt = $this->db->prepare( $sql );
			$this->bind( $stmt, $data );
			$stmt->execute();

	 		if ( ! empty( $stmt->fetch( PDO::FETCH_ASSOC ) ) ) {
				$errors[] = 'Nom ou Email déjà existant !';
				throw new ValidationException( $errors );
			}
		}

		$sql = Sql::query()
			->insertInto( 'users ( user_name, user_email, user_password, user_role )' )
			->values( '( :name, :email, :password, :role )' )
			->get();

		$data = array(
			'name'     => $user_name,
			'email'    => $user_email,
			'password' => $user_password,
			'role'     => $user_role,
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		if ( file_exists( 'install.php' ) ) {
			unlink( 'install.php' );
		}

		Site::redirect( GENERAL_CONFIG['url'].'/users/sign_in' );
	}


	public function signIn( array $user ) : void
	{
		Str::validate( $user['name'], true, 255 );
		Str::validate( $user['password'], true, 255 );

		$user_name     = Str::clean( $user['name'] );
		$user_password = Str::clean( $user['password'] );

		$sql = Sql::query()
			->select( 'user_id, user_name, user_email, user_password, user_role' )
			->from( 'users' )
			->where( 'user_name = :name' )
			->get();

		$data = array(
			'name' => $user_name,
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		$user = $stmt->fetch( PDO::FETCH_ASSOC );

		if ( ! empty( $user ) ) {
			if ( password_verify( $user_password, $user['user_password'] ) ) {
				$_SESSION['user']['id']    = $user['user_id'];
				$_SESSION['user']['name']  = $user['user_name'];
				$_SESSION['user']['email'] = $user['user_email'];
				$_SESSION['user']['role']  = $user['user_role'];

				Site::redirect( GENERAL_CONFIG['url'] );
			} else {
				$errors[] = 'Mot de passe invalid !';
			}
		} else {
			$errors[] = 'L\'utilisateur n\'existe pas !';
		}

		if ( ! empty( $errors ) ) {
			throw new ValidationException( $errors );
		}
	}

	public function signOut( $redirect = GENERAL_CONFIG['url'] ) : void
	{
		$_SESSION = [];
		session_unset();

		Site::redirect( $redirect );
	}


	public function editUser( array $user ) : void
	{
		Str::validate( $user['name'], true, 255 );
		Email::validate( $user['email'] );

		$user_id    = ( int )$user['id'];
		$user_name  = Str::clean( $user['name'] );
		$user_email = Str::clean( $user['email'] );

		if ( ! empty( $user_name ) && ! empty( $user_email ) ) {
			$sql = Sql::query()
				->select( 'user_name, user_email' )
				->from( 'users' )
				->where( 'user_name = :name' )
				->or( 'user_email = :email' )
				->get();

			$data = array(
				'name'  => $user_name,
				'email' => $user_email,
			);

			$stmt = $this->db->prepare( $sql );
			$this->bind( $stmt, $data );
			$stmt->execute();

	 		if ( ! empty( $stmt->fetch( PDO::FETCH_ASSOC ) ) ) {
				$errors[] = 'Nom d\'utilisateur ou email déjà utilisé !';
				throw new ValidationException( $errors );
			}
		}

		if ( User::author( $user['id'] ) ) {
			$_SESSION['user']['name']  = $user_name;
			$_SESSION['user']['email'] = $user_email;
		}

		$sql = Sql::query()
			->update( 'users' )
			->set( 'user_name = :name, user_email = :email' )
			->where( 'user_id = :id' )
			->get();

		$data = array(
			'id'    => $user_id,
			'name'  => $user_name,
			'email' => $user_email,
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		Site::redirect( GENERAL_CONFIG['url'].'/users/edit/' . $user_id );
	}


	public function changeUserRole( array $user ) : void
	{
		Str::validate( $user['role'], true, 20 );

		$user_id   = ( int )$user['id'];
		$user_role = in_array( $user['role'], array( 'admin', 'editor', 'user' ) ) ? $user['role'] : 'user';

		$sql = Sql::query()
			->update( 'users' )
			->set( 'user_role = :role' )
			->where( 'user_id = :id' )
			->get();

		$data = array(
			'id'    => $user_id,
			'role'  => $user_role,
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		Site::redirect( GENERAL_CONFIG['url'].'/users/edit/' . $user_id );
	}


	public function changeUserPassword( array $user ) : void
	{
		Str::validate( $user['old-password'], true, 255 );
		Str::validate( $user['new-password'], true, 255 );
		Str::validate( $user['confirm-new-password'], true, 255 );

		$user_id                   = ( int )$user['id'];
		$user_old_password         = Str::clean( $user['old-password'] );
		$user_new_password         = Str::clean( $user['new-password'] );
		$user_confirm_new_password = Str::clean( $user['confirm-new-password'] );

		$sql = Sql::query()
			->select( 'user_password' )
			->from( 'users' )
			->where( 'user_id = :id' )
			->get();

		$data = array(
			'id' => $user_id,
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		$user = $stmt->fetch( PDO::FETCH_ASSOC );

		if ( password_verify( $user_old_password, $user['user_password'] ) ) {
			if ( $user_new_password == $user_confirm_new_password ) {
				$user_password = password_hash( $user_new_password, PASSWORD_DEFAULT );

				$sql = Sql::query()
					->update( 'users' )
					->set( 'user_password = :password' )
					->where( 'user_id = :id' )
					->get();

				$data = array(
					'id'       => $user_id,
					'password' => $user_password,
				);

				$stmt = $this->db->prepare( $sql );
				$this->bind( $stmt, $data );
				$stmt->execute();

				$this->signOut( GENERAL_CONFIG['url'].'/users/sign_in' );
			} else {
				$errors[] = 'Les mots de passes ne correspondent pas !';
			}
		} else {
			$errors[] = 'Ancien mot de passe érroné !';
		}

		if ( ! empty( $errors ) ) {
			throw new ValidationException( $errors );
		}
	}


	public function deleteUser( int $user_id ) : void
	{
		$sql = Sql::query()
			->delete()
			->from( 'users' )
			->where( 'user_id = :id' )
			->get();

		$data = array(
			'id' => $user_id,
		);

		$stmt = $this->db->prepare( $sql );
		$this->bind( $stmt, $data );
		$stmt->execute();

		if ( User::author( $user_id ) ) {
			$this->signOut();
		} elseif ( User::role( array( 'admin' ) ) ) {
			Site::redirect( GENERAL_CONFIG['url'].'/users' );
		}
	}

}
