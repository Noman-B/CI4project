<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PModel;
use CodeIgniter\Files\File;

class Pcontroller extends BaseController
{
    public function index()
    {
        return view('index');
    }
    // handle add new product ajax request
    public function add() {
        
        $allfiles='';
        if ($imagefile = $this->request->getFiles()) {
            foreach ($imagefile['images'] as $img) {
                if ($img->isValid() && ! $img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move('../public/uploads/avatar/', $newName);
                    if($allfiles ==''){
                        $allfiles = $newName;
                    }else{
                        $allfiles = $allfiles.','.$newName;
                    }
                    }
                   
                }
            }

       
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'product_price' => $this->request->getPost('product_price'),
            'product_descrip' => $this->request->getPost('product_descrip'),
            'product_image' => $allfiles,
            'created_at' => date('Y-m-d H:i:s')
        ];

            $pModel = new PModel();
            $pModel->save($data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Product added Successfully !'
            ]);
        
    }

    // handle fetch all products ajax request
    public function fetch() {
        $pModel = new PModel();
        $products = $pModel->findAll();
        $data = '';

        if ($products) {
            foreach ($products as $product) {
                $images = explode(",", $product['product_image']);
                $allimgs='';
                $x=1;
                foreach ($images as $img) {
                    $allimgs= $allimgs. ' <div class="col-md-3"><a href="#" id="' . $product['id'] . '" data-bs-toggle="modal" data-bs-target="#" class="post_detail_btn"><img src="/uploads/avatar/' . $img. '" class="img-fluid card-img-top"></a></div>';
                    $x = $x+1;
                    }

                $data .= '<div class="col-md-12">
               <div class="row">' . $allimgs . '</div>
                <div class="card shadow-sm">
                
                    <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="card-title fs-5 fw-bold">' . $product['product_name'] . '</div>
                      <div class="badge bg-dark">Price = ' . $product['product_price'] . '</div>
                    </div>
                    <p>
                      ' . substr($product['product_descrip'], 0, 80) . '...
                    </p>
                  </div>
                  <div class="card-footer d-flex justify-content-between align-items-center">
                    <div class="fst-italic">' . date('d F Y', strtotime($product['created_at'])) . '</div>
                    <div>
                      <a href="#" id="' . $product['id'] . '" data-bs-toggle="modal" data-bs-target="#edit_post_modal" class="btn btn-success btn-sm post_edit_btn">Edit</a>

                      <a href="#" id="' . $product['id'] . '" class="btn btn-danger btn-sm post_delete_btn">Delete</a>
                    </div>
                  </div>
                </div>
              </div>';
            }
            return $this->response->setJSON([
                'error' => false,
                'message' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'error' => false,
                'message' => '<div class="text-secondary text-center fw-bold my-5">No products found in the database!</div>'
            ]);
        }
    }

    // handle edit product ajax request
    public function edit($id = null) {
        $pModel = new PModel();
        $product = $pModel->find($id);
        return $this->response->setJSON([
            'error' => false,
            'message' => $product
        ]);
    }

    // handle update product ajax request
    public function update() {
        $id = $this->request->getPost('id');
        $allfiles='';
        if ($imagefile = $this->request->getFiles()) {
            foreach ($imagefile['images'] as $img) {
                if ($img->isValid() && ! $img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move('../public/uploads/avatar/', $newName);
                    if($allfiles ==''){
                        $allfiles = $newName;
                    }else{
                        $allfiles = $allfiles.','.$newName;
                    }
                    }

                /*    if ($this->request->getPost('old_image') != '') {
                        unlink('uploads/avatar/' . $this->request->getPost('old_image'));
                    } */
                   
                }
            }else {
                $allfiles = $this->request->getPost('old_image');
            }

       

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'product_price' => $this->request->getPost('product_price'),
            'product_descrip' => $this->request->getPost('product_descrip'),
            'product_image' => $allfiles,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $pModel = new PModel();
        $pModel->update($id, $data);
        return $this->response->setJSON([
            'error' => false,
            'message' => 'Product updated successfully!'
        ]);
    }

    // handle delete product ajax request
    public function delete($id = null) {
        $pModel = new PModel();
        $product = $pModel->find($id);
        $pModel->delete($id);
        $images = explode(",", $product['product_image']);
                $allimgs='';
                $x=1;
                foreach ($images as $img) {
                    unlink('uploads/avatar/' . $img);
                    $x = $x+1;
                    }

        return $this->response->setJSON([
            'error' => false,
            'message' => 'Product deleted successfully!'
        ]);
    }

    // handle fetch product detail ajax request
    public function detail($id = null) {
        $pModel = new PModel();
        $product = $pModel->find($id);
        return $this->response->setJSON([
            'error' => false,
            'message' => $product
        ]);
    }
}
