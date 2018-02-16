<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 1/22/2018
 * Time: 9:49 PM
 */

namespace app\components;

use yii\base\Component;
use yii\db\Connection;
use yii\helpers\Json;

class NavItems extends Component
{
    static function set($module, &$itemsRef)
    {
        switch ($module) {
            case 'admin':
                $itemsRef[] = ['label' => 'ElectorLists Votes', 'url' => ['/admin/elector-list']];
                $itemsRef[] = ['label' => 'Candidates Votes', 'url' => ['/admin/candidate']];
                $itemsRef[] = ['label' => 'Voted Electors', 'url' => ['/admin/voted']];
                break;
            default:
                $itemsRef[] = ['label' => 'Add Vote', 'url' => ['/site/add-vote']];
                $itemsRef[] = ['label' => 'Add Result', 'url' => ['/site/add-result']];
        }
    }

}