<?php

class User extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('user');
        $this->hasColumn('username', 'string', 255, array(
            'unique' => true
                )
        );
        $this->hasColumn('email', 'string', 255, array(
            'unique' => true
                )
        );
        $this->hasColumn('password', 'string', 32);
        $this->hasColumn('activated', 'int', 1, array(
            'default' => 0
                )
        );
    }

    public function setUp() {
        $this->hasMutator('password', '_encrypt_password');

        $this->hasMany('Expense as Expenses', array(
            'local' => 'id',
            'foreign' => 'user_id'
                )
        );

        $this->hasMany('Category as Categories', array(
            'local' => 'id',
            'foreign' => 'user_id'
                )
        );
    }

    public function Register($username, $email, $password) {
        $u = new User();
        $u->username = $username;
        $u->email = $email;
        $u->password = $password;
        $u->save();
    }

    protected function _encrypt_password($value) {
        $salt = '#*seCrEt!@-*%';
        $this->_set('password', md5($salt . $value));
    }

}