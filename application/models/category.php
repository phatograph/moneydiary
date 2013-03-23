<?php

class Category extends Doctrine_Record {

    public function SetTableDefinition() {
        $this->setTableName('category');
        $this->hasColumn('name', 'string');
        $this->hasColumn('user_id', 'integer', 20, array(
            'notnull' => true
        ));
    }

    public function SetUp() {
        $this->hasMany('Expense as Expenses', array(
            'local' => 'id',
            'foreign' => 'cat_id'
                )
        );
        $this->hasOne('User', array(
            'local' => 'user_id',
            'foreign' => 'id'
                )
        );
    }

    public function GetAllCategories() {
        $q = Doctrine_Query::create()
                        ->select('c.*')
                        ->from('Category c')
                        ->where('c.user_id = ?', User_Current::user()->id)
                        ->orWhere('c.user_id = ?', 1);
        ;
        $result = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

        return $result;
    }

    public function GetAllCustomCategories() {
        $q = Doctrine_Query::create()
                        ->select('c.*')
                        ->from('Category c')
                        ->where('c.user_id = ?', User_Current::user()->id)
        ;
        $result = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

        return $result;
    }

    public function GetAllDefaultCategories() {
        $q = Doctrine_Query::create()
                        ->select('c.*')
                        ->from('Category c')
                        ->where('c.user_id = ?', 1)
        ;
        $result = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

        return $result;
    }

    public function GetCategoryeById($id) {
        $q = Doctrine_Query::create()
                        ->select('c.*')
                        ->from('Category c')
                        ->where('c.id = ?', $id)
        ;
        $result = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

        return $result[0];
    }

    public function AddCategory($name) {
        $c = new Category();
        $c->name = $name;
        $c->user_id = User_Current::user()->id;
        $c->save();
    }

    public function EditCategory($id, $name) {
        $c = Doctrine::getTable('Category')->find($id);
        $c->name = $name;
        $c->save();
    }

    public function DeleteCategory($id) {
        $c = Doctrine::getTable('Category')->find($id);
        $c->delete();
    }

}