<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\Usertype;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends BaseController
{

    public function __construct(){

        $this->folder='user';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //check button access
        $access=checkAccessPrivileges('users');
        if ($request->ajax()) {
            $users = User::join('usertype', 'usertype.id', '=', 'users.usertype')
            ->get(['users.*','usertype.typename']);
            return Datatables::of($users)
           
            ->addIndexColumn()
            ->addColumn('action', function($row) use($access){
     
                    $btn='';
                    if($access['isedit']=='Y' && $row->id != 1)
                     {
                     $btn = "<a href='javascript:void(0)' class='edit btn btn-primary btn-sm editData' data-pid='".$row->id."' data-url=".route('user.show',"$row->id")."><i class='fas fa-edit'></i> Edit</a>";
                     }
                     if($access['isdelete']=='Y' && $row->id != 1)
                     {
                     $btn .= "&nbsp;<a href='javascript:void(0)' class='edit btn btn-danger btn-sm deleteData' data-pid='".$row->id."' data-url=".route('user.destroy',"$row->id")."><i class='fas fa-trash'></i> Delete</a>";
                     }
                    return $btn;
                    })
                    ->addColumn('username', function($row) {
                        return $row->fname.' '.$row->lname;
                    })
                   
            ->rawColumns(['action'])
            ->make(true);
         }
         else
         {
            $title='Users List';
            $form_title='Add User';
            $folder=$this->folder;
            $usertype = Usertype::all();

           return view($this->folder.'.list',compact('title','form_title','folder','usertype','access'));

         }

         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        
         $savedata = $request->except('id');
         $savedata['password']=bcrypt($savedata['password']);


         // Begin database transaction
         DB::beginTransaction();
         $data_save=User::create($savedata);

         

          // Check database transaction
          $transactionStatus = DB::transactionLevel();

          if ($transactionStatus > 0) {
              // Database transaction success
              DB::commit();
              return $this->sendResponse(true,getMessageText('insert'));
            } else {
              // Throw error
              DB::rollback();

              return $this->sendError(getMessageText('insert',false));
            }
       
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        if(isset($user->id))
      {
      
         
        return $this->sendResponse($user,getMessageText('fetch'));

      }
      else
      {
        return $this->sendError(getMessageText('fetch',false));


      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        
           $savedata= $request->validated();
           if(isset($request['password']) && $request['password'] !='')
           {
            $savedata['password']=bcrypt($request['password']);
           }
          // Begin database transaction
          DB::beginTransaction();
          $data_save=$user->update($savedata);
 
         
 
           // Check database transaction
           $transactionStatus = DB::transactionLevel();
 
           if ($transactionStatus > 0) {
               // Database transaction success
               DB::commit();
               return $this->sendResponse(true,getMessageText('insert'));
             } else {
               // Throw error
               DB::rollback();
 
               return $this->sendError(getMessageText('insert',false));
             }
       
       
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $isdel=$user->delete();
        if($isdel)
        {
            return $this->sendResponse(true,getMessageText('delete'));

        }
        else
        {
           return $this->sendError(getMessageText('delete',false));

        }
    }


    public function changepassword()
    {
        $title='Change Password';
        $form_title=$title;
        $folder=$this->folder;
       return view($this->folder.'.changepassword',compact('title','form_title','folder'));

    }

    public function submitnewpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'repassword' => 'required|string|same:password',
          
        ]);
    
        if ($validator->fails()) {
            
            return $this->sendError($validator->errors()->all()[0],$validator->errors());

        }
        else
        {
        $userinfo=getUserDetail();

        $savedata['id']=$userinfo->id;
        $savedata['password']=bcrypt($request->password);

        $user = User::find($userinfo->id);

         $data_save=$user->update($savedata);
       
        if($data_save)
        {
            return $this->sendResponse(true,getMessageText('passwordupdate'));

        }
        else
        {
           return $this->sendError(getMessageText('update',false));

        }
       }

    }
}
