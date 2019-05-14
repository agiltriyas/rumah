<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Mahasiswa extends REST_Controller 
{

    public function __CONSTRUCT()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mhs');

        $this->methods['index_get']['limit'] =100;
    }


    public function index_get()
    {
        $id = $this->get('id');

        if($id === NULL){
            $mahasiswa = $this->mhs->getMahasiswa();
        }else{
            $mahasiswa = $this->mhs->getMahasiswa($id);
        }

        
        if($mahasiswa){
            $this->response([
                'status' => true,
                'data' => $mahasiswa
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'Message' => 'ID NOT FOUND'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if($id === null){
            $this->response([
                'status' => false,
                'Message' => 'Provide a nID'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }else{
            if($this->mhs->deleteMahasiswa($id) > 0){
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'Message' => 'Deleted'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'Message' => 'ID NOT FOUND'
                ], REST_Controller::HTTP_BAD_REQUEST); 
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')
        ];

        if ($this->mhs->createMahasiswa($data) > 0)
        {
            $this->response([
                'status' => true,
                'Message' => 'Data Mahasiswa Added'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => false,
                'Message' => 'Failed Add Data'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nrp' => $this->put('nrp'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jurusan' => $this->put('jurusan')
        ];

        if ($this->mhs->updateMahasiswa($data,$id) > 0)
        {
            $this->response([
                'status' => true,
                'Message' => 'Data Mahasiswa Updated'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'Message' => 'Failed Update Data'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }
}