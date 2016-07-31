<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Model 
{

	public function add_student($data)
	{
		$query="INSERT INTO students
						(first_name,
						last_name,
						email,
						password,
						created_at,
						updated_at)
						VALUES (?,?,?,?,NOW(),NOW())";

		$values=array(
			$data['first_name'],
			$data['last_name'],
			$data['email'],
			$data['password']
			);

		$this->db->query($query,$values);
	}


public function log_in($data)
	{
		$query="SELECT * FROM students WHERE students.password=? AND students.email=?";
		
		$values=array(
			$data['password'],
			$data['email']
			);

		return $this->db->query($query,$values)->row_array();

	}



}