<?php

use console\controllers\CustomerRule;
use yii\db\Migration;

/**
 * Class m201013_082030_create_rbac_migration
 */
class m201013_082030_create_rbac_migration extends Migration
{

    public function up()
    {
        Yii::$app->runAction('migrate/up', [
          'migrationPath' => '@yii/rbac/migrations/',
          'interactive' => false
        ]);
        $auth = Yii::$app->authManager;

        $rule = new CustomerRule();
        $auth->add($rule);

        // добавляем разрешение "createTask"
        $createTask = $auth->createPermission('createTask');
        $createTask->description = 'Create a task';
        $auth->add($createTask);

        // добавляем разрешение "completeTask"
        $completeTask = $auth->createPermission('completeTask');
        $completeTask->description = 'Complete the task';
        $auth->add($completeTask);

        // добавляем разрешение "cancelTask"
        $cancelTask = $auth->createPermission('cancelTask');
        $cancelTask->description = 'Cancel task';
        $auth->add($cancelTask);

        // добавляем разрешение "acceptTask"
        $acceptTask = $auth->createPermission('acceptTask');
        $acceptTask->description = 'Accept the task';
        $auth->add($acceptTask);

        // добавляем разрешение "respondTask"
        $respondTask = $auth->createPermission('respondTaskTask');
        $respondTask->description = 'Respond to the task';
        $auth->add($respondTask);

        // добавляем разрешение "giveUpTask"
        $giveUpTask = $auth->createPermission('giveUpTask');
        $giveUpTask->description = 'Give up the task';
        $auth->add($giveUpTask);

        // добавляем разрешение "updateTask"
        $updateTask = $auth->createPermission('updateTask');
        $updateTask->description = 'Update task';
        $auth->add($updateTask);

        // добавляем разрешение "updateOwnTask"
        $updateOwnTask = $auth->createPermission('updateOwnTask');
        $updateOwnTask->description = 'Update own task';
        $updateOwnTask->ruleName = $rule->name;
        $auth->add($updateOwnTask);

        $auth->addChild($updateOwnTask, $updateTask);

        // добавляем роль "customer" и даём роли разрешение "createTask", "completeTask",
        //"cancelTask", "acceptTask"
        $customer = $auth->createRole('customer');
        $auth->add($customer);
        $auth->addChild($customer, $createTask);
        $auth->addChild($customer, $completeTask);
        $auth->addChild($customer, $cancelTask);
        $auth->addChild($customer, $acceptTask);
        $auth->addChild($customer, $updateOwnTask);

        // добавляем роль "Executor" и даём роли разрешение "createTask", "completeTask",
        //"cancelTask", "acceptTask"
        $executor = $auth->createRole('executor');
        $auth->add($executor);
        $auth->addChild($executor, $respondTask);
        $auth->addChild($executor, $giveUpTask);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "customer" и "executor"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateTask);
        $auth->addChild($admin, $customer);
        $auth->addChild($admin, $executor);
    }

    public function down()
    {
        return false;
    }
}
