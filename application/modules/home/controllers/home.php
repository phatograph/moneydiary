<?php

/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */
class Home extends Controller {

    function __construct() {
        parent::Controller();
        User_Current::is_signed_in();
        require_once('./FirePHPCore/fb.php');
    }

    function Index() {
        $data['main_content'] = 'home_view';

        $this->load->view('shared/home_master', $data);

        //fb($data['funcs']);
    }

}