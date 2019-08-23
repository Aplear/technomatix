<?php
namespace console\controllers;

use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * Rbac init
     */
    public function actionInit()
    {

        $authManager = \Yii::$app->authManager;
        $authManager->removeAll();

        // Create roles
        foreach (\Yii::$app->params['rolesArray'] as $key => $role) {
            // Add roles in Yii::$app->authManager
            ${"$role"}  = $authManager->createRole('administrator');
            $authManager->add(${"$role"});
        }

        $administratorRole  = $authManager->createRole('administrator');
        $managerRole  = $authManager->createRole('manager');
        $employeeRole  = $authManager->createRole('employee');

        $userRegister  = $authManager->createPermission('userRegister');
        $createProduct = $authManager->createPermission('createProduct');
        $createProfit  = $authManager->createPermission('createProfit');
        $createExpenses  = $authManager->createPermission('createExpenses');
        $operationsHistory = $authManager->createPermission('operationsHistory');
        $viewBalances = $authManager->createPermission('viewBalances');

        // Add permissions in Yii::$app->authManager
        $authManager->add($userRegister);
        $authManager->add($createProduct);
        $authManager->add($createProfit);
        $authManager->add($createExpenses);
        $authManager->add($operationsHistory);
        $authManager->add($viewBalances);

        // Add roles in Yii::$app->authManager
        $authManager->add($administratorRole);
        $authManager->add($managerRole);
        $authManager->add($employeeRole);

        // Add permission-per-role in Yii::$app->authManager
        /** @var $administratorRole \yii\rbac\Role */
        $authManager->addChild($administratorRole, $userRegister);
        $authManager->addChild($administratorRole, $createProduct);
        $authManager->addChild($administratorRole, $createProfit);
        $authManager->addChild($administratorRole, $createExpenses);
        $authManager->addChild($administratorRole, $operationsHistory);
        $authManager->addChild($administratorRole, $viewBalances);

        // Manager
        /** @var $managerRole \yii\rbac\Role */
        $authManager->addChild($managerRole, $createProduct);
        $authManager->addChild($managerRole, $createProfit);
        $authManager->addChild($managerRole, $createExpenses);
        $authManager->addChild($managerRole, $operationsHistory);
        $authManager->addChild($managerRole, $viewBalances);

        // Employee
        /** @var $employeeRole \yii\rbac\Role */
        $authManager->addChild($employeeRole, $createProfit);
        $authManager->addChild($employeeRole, $createExpenses);
        $authManager->addChild($employeeRole, $viewBalances);

        //id=1 user set as administrator
        $authManager->assign($administratorRole, 1);
    }
}
