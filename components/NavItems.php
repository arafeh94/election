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
        $itemsRef[] = ['label' => \Yii::t('app', 'Home'), 'url' => ['/site/index']];
        if (!\Yii::$app->user->isGuest) {
            switch ($module) {
                case 'admin':
                    $itemsRef[] = ['label' => \Yii::t('app', 'ElectorLists Votes'), 'url' => ['/admin/elector-list']];
                    $itemsRef[] = ['label' => \Yii::t('app', 'Candidates Votes'), 'url' => ['/admin/candidate']];
                    $itemsRef[] = ['label' => \Yii::t('app', 'Voted Electors'), 'url' => ['/admin/voted']];
                    break;
                default:
                    $itemsRef[] = ['label' => \Yii::t('app', 'Add Votes'), 'url' => ['/site/add-vote']];
                    $itemsRef[] = ['label' => \Yii::t('app', 'Add Results'), 'url' => ['/site/add-result']];
            }
        }
        $itemsRef[] = \Yii::$app->user->isGuest ? ['label' => \Yii::t('app', 'Login'), 'url' => ['/site/login']]
            : ['label' => \Yii::t('app', 'Logout'), 'url' => ['/site/logout']];

    }

}