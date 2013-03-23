<?php

/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */
class Date extends Controller {

    function __construct() {
        parent::Controller();
        User_Current::is_signed_in();
        require_once('./FirePHPCore/fb.php');
    }

    function View($date) {
        $data['main_content'] = 'date_view';
        $data['date'] = $date;

        $e = new Expense();
        $data['expenses'] = $e->GetExpensesByDate($date);

        $this->load->view('shared/home_master', $data);

        fb($data['expenses']);
    }

    function Add($date) {
        $data['main_content'] = 'date_view_add';
        $data['date'] = $date;

        $e = new Expense();
        $data['expense'] = $e->toArray();

        $c = new Category();
        $data['categories'] = $c->GetAllCategories();

        $this->load->view('shared/home_master', $data);

        fb($data);
    }

    function Add_Post() {
        $this->form_validation->set_rules('amount', 'Amount',
                'trim|required|is_natural');
        $inputDate = $this->input->post('date');
        $inputHour = $this->input->post('hour');
        $inputMinute = $this->input->post('minute');
        $inputDateTime = $inputDate . " " . $inputHour . ":" . $inputMinute;

        if ($this->form_validation->run()) {
            $e = new Expense();
            $e->AddExpense(
                    $this->input->post('amount') * -1,
                    $inputDateTime,
                    $this->input->post('category')
            );
            redirect(base_url() . 'date/view/' . $inputDate);
        } else {
            $this->Add($inputDate);
        }
    }

    function Edit($id) {
        $data['main_content'] = 'date_view_add';

        $e = new Expense();
        $data['expense'] = $e->GetExpenseById($id);
        $data['expense']['amount'] *= -1;
        $data['date'] = $data['expense']['edate'];

        $c = new Category();
        $data['categories'] = $c->GetAllCategories();

        $this->load->view('shared/home_master', $data);

        fb($data);
    }

    function Edit_Post($id) {
        $this->form_validation->set_rules('amount', 'Amount',
                'trim|required|is_natural');
        $inputDate = $this->input->post('date');
        $inputHour = $this->input->post('hour');
        $inputMinute = $this->input->post('minute');
        $inputDateTime = $inputDate . " " . $inputHour . ":" . $inputMinute;

        if ($this->form_validation->run()) {
            $e = new Expense();
            $e->EditExpense(
                    $id,
                    $this->input->post('amount') * -1,
                    $inputDateTime,
                    $this->input->post('category')
            );
            redirect(base_url() . 'date/view/' . $inputDate);
        } else {
            $this->Edit($id);
        }
    }

    function Delete_Post($id) {

        $e = new Expense();
        $expense = $e->GetExpenseById($id);
        $returnDate = $expense['edate'];
        $e->DeleteExpense($id);

        redirect(base_url() . 'date/view/' . $returnDate);
    }

}