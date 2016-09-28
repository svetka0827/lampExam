<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model 
{

	public function add_user($data)
	{
		$query="INSERT INTO users
						(name,
						alias,
						email,
						password,
						dob)
						VALUES (?,?,?,?,?)";

		$values=array(
			$data['name'],
			$data['alias'],
			$data['email'],
			$data['password'],
			$data['dob']
			);

		$this->db->query($query,$values);
	}


public function log_in($data)
	{
		$query="SELECT * FROM users WHERE users.password=? AND users.email=?";
		
		$values=array(
			$data['password'],
			$data['email']

			);

		return $this->db->query($query,$values)->row_array();

	}


	public function add_quote($data)
	{
		$query="INSERT INTO quotes
						(quote,
						user_id)
						VALUES (?,?)";

		$values=array(
			$data['quote'],
			$data['user_id']
			);

		$this->db->query($query,$values);
	}


	public function add_favorite($data)
	{
		$query="INSERT INTO favorites
						(quote_id,
						user_id)
						VALUES (?,?)";

		$values=array(
			$data['quote_id'],
			$data['user_id']
			);

		$this->db->query($query,$values);
	}

	public function all_quotes()
	{
		$query="SELECT quotes.quote, users.alias, quotes.id as quote_id
				FROM quotes
				JOIN users ON users.id=quotes.user_id
				WHERE quotes.id NOT IN (SELECT favorites.quote_id from favorites)";

		return $this->db->query($query)->result_array();
	}


	public function all_favorites($user_id)
	{
		$query="SELECT favorites.id as favorites_id, favorites.user_id as favorites_user_id, quotes.id as quote_id, quotes.quote, users.name as posted_user_name,users.id as posted_user_id

			from favorites
			join quotes on quotes.id=favorites.quote_id
			join users on quotes.user_id=users.id
			WHERE favorites.user_id=" . $user_id;

		return $this->db->query($query)->result_array();
	}


	public function delete_favorite($favorite_id)
	{
		$query="DELETE FROM favorites WHERE id=?";

		$this->db->query($query,$favorite_id);
	}


	public function user_quotes($user_id){

		$query="SELECT users.name, quotes.quote, users.id
			from quotes
			left join users on users.id=quotes.user_id
			WHERE users.id=". $user_id;

			return $this->db->query($query)->result_array();
	}


	public function user_quote_count($user_id)
	{
		$query="SELECT users.name, quotes.quote, users.id, COUNT(users.id) as count
			from quotes
			left join users on users.id=quotes.user_id
			WHERE users.id=". $user_id;

			return $this->db->query($query)->row_array();
	}

}