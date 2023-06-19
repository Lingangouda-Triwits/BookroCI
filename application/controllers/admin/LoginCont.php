<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class LoginCont extends CI_Controller{
    public function index(){
        // echo password_hash('Appleiphone@6',PASSWORD_DEFAULT);
        $this->load->library('form_validation');
        $this->load->view('admin/LoginView');

    }

    public function authenticate(){
        $this->load->library('form_validation');
        $this->load->model('admin/LoginModel','loginModel');

        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');

        if($this->form_validation->run() == true){
            // success
            $username = $this->input->post('username');
            $admin = $this->loginModel->getByUsername($username);
            // print_r($admin);
            if(!empty($admin)){
            $password = $this->input->post('password');
                if(password_verify($password, $admin['password']) == true){
                    $adminArray['username'] = $admin['username'];
                    $this->session->set_userdata('admin',$adminArray);
                    redirect(base_url().'index.php/admin/dashbController/index');
                }else{
                    $this->session->set_flashdata('msg','Password is incorrect');
                    redirect(base_url().'index.php/admin/LoginCont/index');
                }
            }else{
                $this->session->set_flashdata('msg','Either Username or Password is incorrect');
                redirect(base_url().'index.php/admin/LoginCont/index');
            }

        }else{
            // error
            $this->load->view('admin/LoginView');

        }
    }
}
?>