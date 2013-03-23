<?php

/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */
class Timeline extends Controller {

    function __construct() {
        parent::Controller();
        User_Current::is_signed_in();
        require_once('./FirePHPCore/fb.php');
    }

    function Index($week = 0) {
        $data['main_content'] = 'timeline_view';
        $data['page'] = $week;

        $start = $week * 7;
        $e = new Expense();
        $count = $amount = 0;
        for ($i = $start; $i < $start + 7; $i++) {
            $date = date("Y-m-d", strtotime("-" . $i . "day"));
            $amount = $e->GetSumAmountByDate($date);
            $dateimg = "";
            $dateweek = date("w", strtotime("-" . $i . "day"));
            switch ($dateweek) {
                case 0: $dateimg = "red";
                    break;
                case 1: $dateimg = "yellow";
                    break;
                case 2: $dateimg = "pink";
                    break;
                case 3: $dateimg = "green";
                    break;
                case 4: $dateimg = "orange";
                    break;
                case 5: $dateimg = "blue";
                    break;
                case 6: $dateimg = "purple";
                    break;
                default: $dateimg = "red";
                    break;
            }

            $data['timeline'][$count]['date'] = $date;
            $data['timeline'][$count]['amount'] = ($amount ? $amount : 0);
            $data['timeline'][$count]['dateimg'] = $dateimg;

            $count++;
        }

        $this->load->view('shared/home_master', $data);

        fb($data);
    }

    function Week($week) {
        $this->Index($week);
    }

    function FindWeek($date) {

        $dateDiff = abs(abs(strtotime(date('Y-m-d', time()))) - abs(strtotime($date)));
        $fullDays = floor($dateDiff/(60*60*24));

        /*
        $date1 = new DateTime();
        $date2 = new DateTime($date);
        $interval = $date1->diff($date2);
        */
        
        $weeks = floor(($fullDays) / 7);

        if ($weeks == 0)
            redirect(base_url() . 'timeline');
        redirect(base_url() . 'timeline/week/' . $weeks);
    }

}