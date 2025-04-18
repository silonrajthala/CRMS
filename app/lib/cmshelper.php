<?php 
use Illuminate\Support\Facades\DB;
// use App\Models\User;



  function testhelper() {
        return 'from helper';
    }

     function getMessageText($type,$issuccess=true)
    {
        if($type=='insert' && $issuccess===true)
        {
            return 'Data Successfully Inserted';
        }
        else if($type=='insert' && $issuccess===false)
        {
            return 'Couldnot insert a data';
        }
        else if($type=='update' && $issuccess===true)
        {
            return 'Data Successfully Updated';
        }
        else if($type=='update' && $issuccess===false)
        {
            return 'Couldnot update a data';
        }
        else if($type=='delete' && $issuccess===true)
        {
            return 'Data Successfully deleted';
        }
        else if($type=='delete' && $issuccess===false)
        {
            return 'Couldnot delete a data';
        }
        else if($type=='fetch' && $issuccess===true)
        {
            return 'Data Successfully fetched';
        }
        else if($type=='passwordupdate' && $issuccess===true)
        {
            return 'Password succesfully changed';
        }
        else if($type=='passwordupdate' && $issuccess===false)
        {
            return 'Couldnot update a password';
        }
        else
        {
            return 'Couldnot fetch data';
        }
    }

    
    function getUserDetail()
    {
       // $users = User::find(Auth::guard('admin')->id());
       $users=DB::table('users')
              ->join('usertype','users.usertype','=','usertype.id')
              ->select('users.id','fname','lname','mobilenumber','countrycode','email','typename','usertype')
              ->where('users.id',Auth::guard('admin')->id())
              ->get();
        return $users[0];

    }
    function getSideMenu()
    {
        $userdata=getUserDetail();
        $menu=DB::select(DB::raw("select m.id,m.modulename,m.url,m.icon
        from modules m
         join module_permission mp on m.id=mp.modulesid and parentmoduleid =0
          where
         mp.usertypeid =?
         group by m.id,m.modulename,m.url,m.icon 
         order by m.orderby"),[$userdata->usertype]);
        return $menu;

    }
    function getSideSubMenu($menuid)
    {
        $userdata=getUserDetail();
        $menu=DB::select(DB::raw("select m.id,m.modulename,m.url,m.icon
        from modules m
         join module_permission mp on m.id=mp.modulesid
          where m.parentmoduleid=? and
         mp.usertypeid =?
         group by m.id,m.modulename,m.url,m.icon 
         order by m.orderby"),[$menuid,$userdata->usertype]);
        return $menu;

    }

    function checkmenupermission()
    {
        $userdata=getUserDetail();
        $path=Request::path();

        
         $explode=explode('admin/',$path);
         $url=$explode[1];

         $notcheck_url=['apply','changepassword'];
         if(in_array($url,$notcheck_url))
         {
            return 1;
         }
         else
         {
            $menuCount = DB::table('modules')
            ->join('module_permission', 'modules.id', '=', 'module_permission.modulesid')
            ->where('modules.url', $url)
            ->where('module_permission.usertypeid', $userdata->usertype)
            ->count();
            return $menuCount;

         }
        
        

    }

    function checkAccessPrivileges($form)
    {
        $userdata=getUserDetail();

       $access=DB::table('form_permission')
              ->select('isinsert','isedit','isupdate','isdelete')
              ->where('usertypeid',$userdata->usertype)
              ->where('slug',$form)
              ->get();
       if(count($access) > 0)
       {
        return (array)$access[0];

       }
       else
       {
        return array('isinsert'=>'N','isedit'=>'N','isupdate'=>'N','isdelete'=>'N');
       }

    }




?>