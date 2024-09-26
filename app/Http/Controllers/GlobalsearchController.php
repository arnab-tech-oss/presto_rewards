<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class GlobalsearchController extends Controller
{
    public    $search_data = array();
    public $search_query;

    
    


    protected $all_table = ['customers','companies','products','coupons'];
    protected $all_route = ['customers' => 'admin.customerlist', 'companies' => 'admin.company','products' => 'admin.product', 'coupons' =>'coupon.search'];
    protected $show_column = ['customers' => ['first_name'], 'companies' => ['company_name'], 'products' => ['product_name'], 'coupons' => ['coupon_code']];
    protected $lable = ['customers' => 'name' , 'companies' => 'company_name' , 'products' => 'PRODUCT' , 'coupons' => 'Coupon No'];

    public function index(Request $request, $search)
    {
       
        // here i have assingin the search query data into the instance variable
        $this->search_query = $search;




        // getting the all table from the database
        // $tables = DB::select('SHOW TABLES');
        // foreach ($tables as $table) {
        //     $table = array_values((array)$table)[0];
        //     self::search($table, self::getColumn($table));
        // }
        if (strlen($this->search_query) > 0) {
            foreach ($this->all_table as $table) {
                self::search($table, self::getColumn($table));
            }
        }
        return view('admin.global_search.index', ['datas' => $this->search_data, 'all_route' => $this->all_route, 'show_column' => $this->show_column, 'lable' => $this->lable]);
  
   }
    // getting the column name of the particular  table 
    private static function getColumn(string $table)
    {
        return Schema::getColumnListing($table);
    }

    // doing the sarch operation here 
    public  function search(string $table, array $columns)
    {
        $table_data =   DB::table($table);
        if (count($table_data->get()) > 0) {
            foreach ($columns as $column) {
                $table_data = $table_data->orWhere($column, 'LIKE', '%' . $this->search_query . '%');
            }
            $table_data = $table_data->limit(20)->get();
            if (count($table_data) > 0) {
                $final_data['table'] = $table;
                $final_data['data'] = $table_data;
                array_push($this->search_data, $final_data);
            }
        }
    }
}
