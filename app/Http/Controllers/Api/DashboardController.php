<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Salary;

class DashboardController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $data = [];
        $monthList = [];

        $supplier_count = User::supplier()->count();
        $customer_count = User::customer()->count();

        $data['supplier_count'] = $supplier_count;
        $data['customer_count'] = $customer_count;


        return $this->ResponseSuccess($data);
    }
}
