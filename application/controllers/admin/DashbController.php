<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class DashbController extends CI_Controller{
    public function index(){
        $this->load->view('admin/dashboardView');
    }
}
?>