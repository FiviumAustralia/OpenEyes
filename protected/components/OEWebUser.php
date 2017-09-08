<?php
/**
 * OpenEyes.
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.openeyes.org.uk
 *
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
class OEWebUser extends CWebUser
{
    protected function changeIdentity($id, $name, $states)
    {
        //force regeneration of session id to avoid bug in CWebUser where empty phpsessionid will not be regenerated
        session_regenerate_id(true);
        parent::changeIdentity($id, $name, $states);
    }

    /**
     * Is the current user a surgeon.
     *
     * @return bool
     */
    public function isSurgeon()
    {
        $user = User::model()->findByPk($this->getId());
        if ($user) {
            return (bool) $user->is_surgeon;
        } else {
            return false;
        }

    }

    /*Get the roles of current user*/
    public function getRole($id){
        $roles = array();
        $query = "SELECT itemname FROM authassignment
                  WHERE userid = $id;";
        $command = Yii::app()->db->createCommand($query);
        $command->prepare();
        $result = $command->queryAll();
        foreach ($result as $item=>$value)
        {
            array_push($roles, $value['itemname']);
        }
        return $roles;

    }
}
