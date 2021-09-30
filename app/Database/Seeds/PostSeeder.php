<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PostSeeder extends Seeder
{
	public function run()
	{
		$model = model('PostModel');

		$kategori = ['nature', 'moon', 'forest', 'cars', 'olympic', 'galaxy'];

		for ($i=0; $i <6 ; $i++) { 
			$model->insert([
				'judul'			=> static::faker()->sentence(3),
				'deskripsi'		=> static::faker()->text(),
				'author'		=> static::faker()->name(3),
				'kategori'		=> $kategori[$i],
				'slug'			=> static::faker()->unique()->slug(3),
			]);
		}


	}

}
