<?php

/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */
class Categories extends Controller {

    function __construct() {
        parent::Controller();
        User_Current::is_signed_in();
        require_once('./FirePHPCore/fb.php');
    }

    function Index() {
        $data['main_content'] = 'categories_view';

        $c = new Category();
        $data['defaultCategories'] = $c->GetAllDefaultCategories();
        $data['customCategories'] = $c->GetAllCustomCategories();

        $this->load->view('shared/home_master', $data);

        fb($data);
    }

    function Add() {
        $data['main_content'] = 'categories_view_add';
        $c = new Category();
        $data['category'] = $c->toArray();

        $this->load->view('shared/home_master', $data);

        fb($data);
    }

    function Add_Post() {
        $this->form_validation->set_rules('name', 'Name',
                'trim|required|alpha_dash');

        if ($this->form_validation->run()) {
            $c = new Category();
            $c->AddCategory(
                    $this->input->post('name')
            );
            redirect(base_url() . 'categories');
        } else {
            $this->Add();
        }
    }

    function Edit($id) {
        $data['main_content'] = 'categories_view_add';
        $c = new Category();
        $data['category'] = $c->GetCategoryeById($id);

        $this->load->view('shared/home_master', $data);

        fb($data);
    }

    function Edit_Post($id) {
        $this->form_validation->set_rules('name', 'Name',
                'trim|required|alpha_dash');

        if ($this->form_validation->run()) {
            $c = new Category();
            $c->EditCategory(
                    $id,
                    $this->input->post('name')
            );
            redirect(base_url() . 'categories');
        } else {
            $this->Edit($id);
        }
    }

    function Delete_Post($id) {
        $c = new Category();
        $c->DeleteCategory($id);

        redirect(base_url() . 'categories');
    }

}