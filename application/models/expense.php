<?php

class Expense extends Doctrine_Record {

    public function SetTableDefinition() {
        $this->setTableName('expense');
        $this->hasColumn('amount', 'integer');
        $this->hasColumn('datetime', 'timestamp');
        $this->hasColumn('edate', 'date');
        $this->hasColumn('cat_id', 'integer');
        $this->hasColumn('user_id', 'integer', 20, array(
            'notnull' => true
        ));
    }

    public function SetUp() {
        $this->hasOne('Category', array(
            'local' => 'cat_id',
            'foreign' => 'id'
                )
        );

        $this->hasOne('User', array(
            'local' => 'user_id',
            'foreign' => 'id'
                )
        );
    }

    public function GetAllExpenses() {
        $q = Doctrine_Query::create()
                        ->select('e.*')
                        ->from('Expense e')
                        ->where('e.datetime LIKE ?', date("Y-m-d", strtotime("0 day")) . '%')
                        ->addWhere('e.user_id = ?', User_Current::user()->id)
                        ->orderBy('e.datetime DESC')
        ;
        $result = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

        return $result;
    }

    public function GetExpenseById($id) {
        $q = Doctrine_Query::create()
                        ->select('e.*, c.*')
                        ->from('Expense e, e.Category c')
                        ->where('e.id = ?', $id)
        ;
        $result = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

        return $result[0];
    }

    public function GetExpensesByDate($date) {
        $q = Doctrine_Query::create()
                        ->select('e.*, c.*')
                        ->from('Expense e, e.Category c')
                        ->where('e.datetime LIKE ?', date($date, strtotime("0 day")) . '%')
                        ->addWhere('e.user_id = ?', User_Current::user()->id)
                        ->orderBy('e.datetime DESC')
        ;
        $result = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

        return $result;
    }

    public function GetSumAmountByDate($date) {
        $q = Doctrine_Query::create()
                        ->select('SUM(e.amount)')
                        ->from('Expense e')
                        ->where('e.datetime LIKE ?', date($date, strtotime("0 day")) . '%')
                        ->addWhere('e.user_id = ?', User_Current::user()->id)
                        ->groupBy('e.edate')
        ;
        $result = $q->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);

        return $result;
    }

    public function AddExpense($amount, $datetime, $cat_id) {
        $e = new Expense();
        $e->amount = $amount;
        $e->datetime = $datetime;
        $e->edate = $datetime;
        $e->cat_id = $cat_id;
        $e->user_id = User_Current::user()->id;
        $e->save();
    }

    public function EditExpense($id, $amount, $datetime, $cat_id) {
        $e = Doctrine::getTable('Expense')->find($id);
        $e->amount = $amount;
        $e->datetime = $datetime;
        $e->cat_id = $cat_id;
        $e->save();
    }

    public function DeleteExpense($id) {
        $e = Doctrine::getTable('Expense')->find($id);
        $e->delete();
    }

}