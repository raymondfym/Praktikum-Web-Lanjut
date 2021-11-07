<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminPostsController extends BaseController
{
    public function index()
    {
        $PostModel = model("PostModel");
        $data = [
            "posts" => $PostModel->findAll()
        ];
        return view("posts/index",$data);
    }

    public function create()
    {
        $data = [
            'validation'=>\Config\Services::validation(),
        ];
        return view("posts/create",$data);
    }

    public function store()
    {
        $valid=$this->validate([
            "judul"=>[
                "label" => "Judul",
                "rules" => "required",
                "errors" => [
                    "required" => "{field} harus diisi",
                ]
            ],
            "slug"=>[
                "label" => "Slug",
                "rules" => "required|is_unique[posts.slug]",
                "errors" => [
                    "required" => "{field} harus diisi",
                    "is_unique" => "{field} sudah ada",
                ]
            ],
            "kategori"=>[
                "label" => "Kategori",
                "rules" => "required",
                "errors" => [
                    "required" => "{field} harus diisi",
                ]
            ],
            "author"=>[
                "label" => "Author",
                "rules" => "required",
                "errors" => [
                    "required" => "{field} harus diisi",
                ]
            ],
            "deskripsi"=>[
                "label" => "Deskripsi",
                "rules" => "required|is_unique[posts.slug]",
                "errors" => [
                    "required" => "{field} harus diisi",
                ]
            ],
        ]);
        
        if($valid){
        $data = [
            'judul' => $this->request->getVar("judul"),
            'slug' => $this->request->getVar("slug"),
            'kategori' => $this->request->getVar("kategori"),
            'author' => $this->request->getVar("author"),
            'deskripsi' => $this->request->getVar("deskripsi"),
        ];

        $PostModel = model("PostModel");
        $PostModel -> insert($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('admin/posts/'));
        }else{
            $validation = \Config\Services::validation();
            return redirect()->to('admin/posts/create')->withInput()->with('validation', $validation);
        }
    }
    public function delete($slug)
    {
        $PostModel = model("PostModel");
        $PostModel->where('slug', $slug)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('admin/posts/'));
    }

    public function edit($slug)
    {
        session();
        $PostModel = model("PostModel");
        $data = [
            'validation'=>\Config\Services::validation(),
            'post' => $PostModel->where('slug', $slug)->first()
            
        ];
        return view("posts/edit",$data);
    }

    public function update($post_id)
	{
        $PostModel = model("PostModel");
        $data = [
            'judul' => $this->request->getVar("judul"),
            'slug' => $this->request->getVar("slug"),
            'kategori' => $this->request->getVar("kategori"),
            'author' => $this->request->getVar("author"),
            'deskripsi' => $this->request->getVar("deskripsi"),
        ];
		$PostModel->update($post_id, $data);
		return redirect()->to(base_url('/admin/posts/'));
	}
}