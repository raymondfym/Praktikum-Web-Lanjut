<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PostController extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Blog - Post',
			'nama' => 'Raymond Faraz'
		];
		echo view('layout/header',$data);
		echo view('layout/navbar');
		echo view('v_post.php');
		echo view('layout/footer');
	}
}
