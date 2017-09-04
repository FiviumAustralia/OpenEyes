<?php

class m170904_025440_add_ethnic_role extends CDbMigration
{
    const MANAGE_ETHNIC_ROLE = 'Manage Ethnic';
    const VIEW_ETHNIC_ROLE = 'View Ethnic';
    const MANAGE_ETHNIC_TASK = 'TaskManageEthnic';
    const VIEW_ETHNIC_TASK = 'TaskViewEthnic';
	/*
    public function up()
	{
	}

	public function down()
	{
		echo "m170904_025440_add_ethnic_role does not support migration down.\n";
		return false;
	}
    */

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	    $this->insert('authitem',array('name'=>self::MANAGE_ETHNIC_ROLE, 'type'=>2));
	    $this->insert('authitem',array('name'=>self::VIEW_ETHNIC_ROLE,'type'=>2));

	    $this->insert('authitem',array('name'=>self::MANAGE_ETHNIC_TASK,'type'=>1));
	    $this->insert('authitem', array('name'=>self::VIEW_ETHNIC_TASK, 'type'=>1));

	    $this->insert('authitemchild',
            array('parent'=>self::MANAGE_ETHNIC_ROLE, 'child'=>self::MANAGE_ETHNIC_TASK));
	    $this->insert('authitemchild',
            array('parent'=>self::MANAGE_ETHNIC_ROLE,'child'=>self::VIEW_ETHNIC_TASK));

	    $this->insert('authitemchild',
            array('parent'=>self::VIEW_ETHNIC_ROLE, 'child'=>self::VIEW_ETHNIC_TASK));

	}

	public function safeDown()
	{
	    $this->delete('authassignment','itemname="'.self::MANAGE_ETHNIC_ROLE.'"');
	    $this->delete('authassignment','itemname="'.self::VIEW_ETHNIC_ROLE.'"');

	    $this->delete('authitemchild',
            'parent="'.self::MANAGE_ETHNIC_ROLE.'"AND child = "'.self::MANAGE_ETHNIC_TASK.'"');
	    $this->delete('authitem','name="'.self::MANAGE_ETHNIC_TASK.'"');
	    $this->delete('authitem','name="'.self::MANAGE_ETHNIC_ROLE.'"');

	    $this->delete('authitemchild',
            'parent="'.self::VIEW_ETHNIC_ROLE.'"AND child = "'.self::VIEW_ETHNIC_TASK.'"');
	    $this->delete('authitem','name="'.self::VIEW_ETHNIC_TASK.'"');
	    $this->delete('authitem','name="'.self::VIEW_ETHNIC_ROLE.'"');
	}

}