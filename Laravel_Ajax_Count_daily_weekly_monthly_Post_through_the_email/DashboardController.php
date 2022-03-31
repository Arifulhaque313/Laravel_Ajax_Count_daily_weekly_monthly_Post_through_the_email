<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;

class DashboardController extends Controller
{
    //
    public function index()
    {   
        return view('dashboard.index');
    } 

    public function emailsearch(Request $request)
    {   
        if($request->ajax()){
            $users = User::where('email', $request->email )->first();
                            
            $output =  '';
            $daily_count  =  $weekly_count  =  $monthly_count  =  $yearly_count  =   0;  



            if(isset($users->id)){
                $data = Post::where('user_id',$users->id)->get();
                $daily_count = Post::where('user_id',$users->id)->where('user_id',$users->id)->where('created_at','>=',Carbon::today())->count();
                $weekly_count = Post::where('user_id',$users->id)-> where('created_at','>=',Carbon::today()->subDays(7))->count();
                $monthly_count = Post::where('user_id',$users->id)-> where('created_at','>=',Carbon::today()->subDays(30))->count();
                $yearly_count = Post::where('user_id',$users->id)-> where('created_at','>=',Carbon::today()->subDays(365))->count();

                if(count($data)>0){
                    $output ='
                    <table class="table">
                    <tr>
                    <th>Post  ID</th>
                    <th>Title</th>
                    <th>Published</th>
                    <th>Date  Time(when Created)</th>     
                </tr>
                    <tbody>';

                        foreach($data as $row){
                            $output .='
                            <tr>
                            <td>'.$row->id.'</td>
                            <td>'.$row->title.'</td>
                            <td>'.$row->published.'</td>
                            <td>'.$row->created_at.'</td>
                            </tr>
                            ';
                        }
                $output .= '
                    </tbody>
                    </table>';
                }
                else{
                    $output.='No result';
                }
                // return $output;
                
                }

                else{
                    $nodata="No result";
                    $output ='
                    <tr>
                    <td>'.$nodata.'</td>
                    
                    </tr>
                    ';
                }
                
            return json_encode(['details'  =>  $output, 'daily_count' => $daily_count,'weekly_count' => $weekly_count,'monthly_count' => $monthly_count,'yearly_count'=>$yearly_count ]); 
            }
    } 
}
