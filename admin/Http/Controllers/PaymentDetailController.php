<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 11/04/2018
 * Time: 8:41 AM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Repositories\PaymentDetailRepository;

class PaymentDetailController extends Controller
{
    private  $repository;
    public function __construct(PaymentDetailRepository $repository)
    {
        $this->repository=$repository;
    }
}