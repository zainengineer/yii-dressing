<?php
/**
 * YdMenuController
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-dressing/master/license.txt
 *
 * @package dressing.controllers
 */
class YdSiteMenuController extends YdWebController
{

    /**
     * Access Control
     * @return array
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index', 'view', 'log', 'create', 'update', 'delete', 'order'),
                'roles' => array('admin'),
            ),
            array('deny', 'users' => array('*')),
        );
    }

    /**
     * @param string $view the view to be rendered
     * @return bool
     */
    public function beforeRender($view)
    {
        $this->addBreadcrumb(Yii::t('dressing', 'Tools'), array('/tool/index'));
        if (in_array($view, array('view', 'update'))) {
            $this->addBreadcrumb(Yii::t('dressing', 'Site Menus'), Yii::app()->user->getState('index.siteMenu', array('/siteMenu/index')));
        }
        return parent::beforeRender($view);
    }

    /**
     * Index
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('t.parent_id', 0);
        $menus = YdSiteMenu::model()->findAll($criteria);
        $this->render('index', array(
            'menus' => $menus,
        ));
    }

    /**
     * View
     * @param $id
     */
    public function actionView($id)
    {
        /** @var $menu YdSiteMenu */
        $menu = $this->loadModel($id, 'YdSiteMenu');

        // check for deleted YdSiteMenu
        if ($menu->deleted) {
            Yii::app()->user->addFlash('THIS RECORD IS DELETED', 'warning');
        }

        $this->render('view', array(
            'menu' => $menu,
        ));
    }

    /**
     * Log
     * @param $id
     */
    public function actionLog($id)
    {
        /** @var $menu YdSiteMenu */
        $menu = $this->loadModel($id, 'YdSiteMenu');

        $this->render('log', array(
            'menu' => $menu,
        ));
    }

    /**
     * Create
     */
    public function actionCreate()
    {
        $menu = new YdSiteMenu('create');

        if (isset($_POST['YdSiteMenu'])) {
            $menu->attributes = $_POST['YdSiteMenu'];
            if ($menu->save()) {
                Yii::app()->user->addFlash('Menu has been created.', 'success');
                $this->redirect(Yii::app()->returnUrl->getUrl($menu->getUrl()));
            }
        }
        else {
            $menu->enabled = 1;
            if (isset($_GET['YdSiteMenu'])) {
                $menu->attributes = $_GET['YdSiteMenu'];
            }
        }

        $this->render('create', array(
            'menu' => $menu,
        ));
    }

    /**
     * Update
     * @param $id
     */
    public function actionUpdate($id)
    {
        /** @var $menu YdSiteMenu */
        $menu = $this->loadModel($id, 'YdSiteMenu');

        if (isset($_POST['YdSiteMenu'])) {
            $menu->attributes = $_POST['YdSiteMenu'];
            if ($menu->save()) {
                Yii::app()->user->addFlash(Yii::t('dressing', 'Menu has been updated'), 'success');
                $this->redirect(Yii::app()->returnUrl->getUrl($menu->getUrl()));
            }
        }

        $this->render('update', array(
            'menu' => $menu,
        ));
    }

    /**
     * Delete
     * @param $id
     */
    public function actionDelete($id = null)
    {
        $task = YdHelper::getSubmittedField('task', 'YdSiteMenu') == 'undelete' ? 'undelete' : 'delete';
        if (YdHelper::getSubmittedField('confirm', 'YdSiteMenu')) {
            foreach (YdHelper::getGridIds($id) as $_id) {
                $menu = YdSiteMenu::model()->findByPk($_id);
                if (!$menu) {
                    continue;
                }
                call_user_func(array($menu, $task));
                Yii::app()->user->addFlash(strtr('Lookup :name has been :tasked.', array(
                    ':name' => $menu->getName(),
                    ':tasked' => $task . 'd',
                )), 'success');
            }
            $this->redirect(Yii::app()->returnUrl->getUrl(Yii::app()->user->getState('index.siteMenu', array('/menu/index'))));
        }

        $this->render('delete', array(
            'id' => $id,
            'task' => $task,
        ));
    }

    /**
     * Handle ordering.
     */
    public function actionOrder()
    {
        if (isset($_POST['Order'])) {
            $menus = explode(',', $_POST['Order']);
            foreach ($menus as $k => $menu_id) {
                if ($menu = YdSiteMenu::model()->findbyPk($menu_id)) {
                    $menu->sort_order = $k;
                    $menu->save(false);
                }
            }
        }
    }


}
