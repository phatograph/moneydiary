<?php

/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */
class Authen extends Controller {

    function __construct() {
        parent::Controller();
        require_once('./FirePHPCore/fb.php');
    }

    function Index() {
        $data['main_content'] = 'authen_view';

        $this->load->view('shared/home_master', $data);

        //fb(User_Current::user());
        //fb($data['funcs']);
    }

    function SignIn() {
        $this->form_validation->set_rules('username', 'Username',
                'trim|required|callback_authenticate');
        $this->form_validation->set_rules('password', 'Password',
                'trim|required');
        $this->form_validation->set_message('authenticate', 'Invalid login. Please try again.');

        if ($this->form_validation->run($this)) {
            redirect(base_url());
        } else {
            $data['main_content'] = 'authen_view';
            $this->load->view('shared/home_master', $data);
        }
    }

    function authenticate() {
        return User_Current::signin(
                $this->input->post('username'),
                $this->input->post('password')
        );
    }

    function Register() {
        $data['main_content'] = 'authen_view_register';

        $this->load->view('shared/home_master', $data);
    }

    function Register_Post() {
        $this->form_validation->set_rules('username', 'Username',
                'trim|required|alpha_numeric|min_length[4]|max_length[12]|unique[User.username]');
        $this->form_validation->set_rules('email', 'Email',
                'trim|required|valid_email|unique[User.email]');
        $this->form_validation->set_rules('password', 'Password',
                'trim|required|alpha_numeric|min_length[6]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password',
                'trim|required|alpha_numeric|matches[password]');

        /*
          $rules['username'] = 'trim|required|alpha_numeric|min_length[4]|max_length[12]|unique[User.username]';
          $rules['email'] = 'trim|required|valid_email|unique[User.email]';
          $rules['password'] = 'trim|required|alpha_numeric|min_length[6]|max_length[12]';
          $rules['cpassword'] = 'trim|required|alpha_numeric|matches[password]';

          $this->form_validation->set_rules($rules);

          $fields['username'] = 'Username';
          $fields['email'] = 'Email';
          $fields['password'] = 'Password';
          $fields['cpassword'] = 'Password Confirmation';

          $this->form_validation->set_fields($fields);
         */

        if ($this->form_validation->run()) {
            $u = new User();
            $u->Register(
                    $this->input->post('username'),
                    $this->input->post('email'),
                    $this->input->post('password')
            );
            unset($u);
            User_Current::signin($this->input->post('username'), $this->input->post('password'));
            redirect(base_url());
        } else {
            $this->Register();
        }
    }

    function SignOut() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

}