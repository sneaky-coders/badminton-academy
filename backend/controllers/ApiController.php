<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    /**
     * Set the response format to JSON for all actions in this controller.
     */
    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    /**
     * Login action.
     * POST /api/login
     */
    public function actionLogin()
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        // Perform authentication check against your MySQL database
        // Example query: SELECT * FROM users WHERE username = :username AND password = :password;
        $user = Yii::$app->db->createCommand('SELECT * FROM users WHERE username = :username AND password = :password')
            ->bindValues([':username' => $username, ':password' => $password])
            ->queryOne();

        if ($user) {
            return ['success' => true, 'user' => $user];
        } else {
            Yii::$app->response->statusCode = 401;
            return ['error' => 'Invalid credentials'];
        }
    }

    /**
     * Customer action.
     * GET /api/customer
     */
    public function actionCustomer()
    {
        $customers = Yii::$app->db->createCommand('SELECT * FROM court')->queryAll();

        return ['success' => true, 'customers' => $customers];
    }

    // Add other actions for '/graph', '/payments', '/totalBookings', '/totalCustomers', '/totalRevenue', '/totalPaid'
    // following a similar structure.

    // ...

}
