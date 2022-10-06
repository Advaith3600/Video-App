<?php

namespace B2buy\Buyer\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use App\Http\Requests\User\UserRequest;
use App\Interfaces\User\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Litepie\Roles\Interfaces\PermissionRepositoryInterface;
use Litepie\Roles\Interfaces\RoleRepositoryInterface;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use B2buy\AssemblyPay\Payment;
use DB;
use Carbon\Carbon;
use B2buy\Buyer\Models\RoleManagement;

/**
 * Resource controller class for user.
 */
class RuleManagementController extends BaseController
{
    /**
     * @var Permissions
     */
    protected $permission;

    /**
     * @var roles
     */
    protected $roles;

    /**
     * Initialize user resource controller.
     *
     * @param type UserRepositoryInterface $user
     *
     * @return null
     */
    public function __construct(
        UserRepositoryInterface $user,
        PermissionRepositoryInterface $permissions,
        RoleRepositoryInterface $roles
        
    ) {
        parent::__construct();

        $this->permissions = $permissions;
        $this->roles = $roles;
        $this->repository = $user;
       
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\App\Repositories\User\Criteria\UserResourceCriteria::class);

    }

    /**
     * Display a list of user.
     *
     * @return Response
     */
    public function index(UserRequest $request)
    {
        $view = $this->response->theme->listView();
        $pageLimit = 10;
        if($request->all()&&array_key_exists('pageLimit',$request->all()))
        $pageLimit = $request->pageLimit;
        $search = $request->except('pageLimit');
        
        $id=user_id();
        $data = $this->repository->scopeQuery(function ($query) use ($request,$id) {
            if ($id) {
                $query = $query
                    ->where('parent_id' ,$id );
            }
           
            return $query->orderBy('id');

        })->paginate($pageLimit);
        $master=RoleManagement::where('user_id',$id)->where('type','subuser')->paginate();
        $view = 'buyer::rolemanagement.index';
        if ($request->ajax()) {
            $view = 'buyer::rolemanagement.more';
        }
        return $this->response->setMetaTitle(trans('user::user.names'))
            ->view($view)
            ->data(compact('data','pageLimit','search','master'))
            ->output();
    }

    /**
     * Display user.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return Response
     */
    public function show(UserRequest $request, User $user)
    {

        if ($user->exists) {
            $view = 'user::user.show';
        } else {
            $view = 'user::user.new';
        }

        $roles = $this->roles->all();
        $permissions = $this->permissions->groupedPermissions();

        return $this->response->setMetaTitle(trans('app.view') . ' ' . trans('user::user.name'))
            ->data(compact('user', 'roles', 'permissions'))
            ->view($view)
            ->output();
    }

    /**
     * Show the form for creating a new user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(UserRequest $request)
    {
        $user = $this->repository->newInstance([]);
        $roles = $this->roles->all();
        $permissions = $this->permissions->groupedPermissions();

        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('user::user.name'))
            ->view('user::user.create')
            ->data(compact('user', 'roles', 'permissions'))
            ->output();
    }


    /**
     * Create new user.
     *
     * @param Request $request
     *
     * @return Response
     */
    // 
    public function createRule(UserRequest $request){
        $attributes = $request->except('_token','parent_id');
    
        $attributes['user_id'] = user_id();
        $attributes['user_type'] = user_type();
        $attributes['type'] = 'subuser';
        
        $role_count = RoleManagement::where('user_id', user_id())->where('type','subuser')->count();

     

        if ($role_count == 0) {

            $attributes['parent_id']=1;
            //$role->update($attributes);
        
        } else {

        $attributes['parent_id']=$role_count+1;
            //
        
        }
        $role = RoleManagement::create($attributes);
       // RoleManagement::updateOrCreate($attributes,['master_id'=>$request->master_id]);

       //$role= DB::table('master_buyer')->insert($attributes);
        
       return response()->json(['id' => $request->master_id]);
        // return redirect()->back()->with('verification-success',' ');
    }

    
    /**
     * Show user for editing.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return Response
     */
    public function editRule(UserRequest $request)
    {
        
        $id=$request->id;
        $buyer= DB::table('master_buyer')->where('id',$id)->first();
        //$level= DB::table('masters')->where('type','buyer.level')->get();
        $level= DB::table('organization_unit')->select('name','id')->where('parent_id',user_id())->get();
       $user= $this->repository->findbyfield('id',$id)->first();
      $role_user= DB::table('role_user')->where('user_id',$id)->first();
     
     
        
      
      $html = '';
     
      $html .= '<option value="">Select department</option>';
      foreach(@$level as $opt):
        $class="";
       if($id!=$opt->id){
           if($buyer->ou_id==$opt->id)
           {
               $class="selected";
           }
        $html .= '<option value="'.$opt->id.' "'.$class.' >'.$opt->name.'</option>';
       }  
      endforeach;
      if(count($level)==0):
          $html = '<option value="">Department not found</option>';
      endif;
       
        $permissions = $this->permissions->groupedPermissions();
      
        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('user::user.name'))
            ->view('user::user.edit')
            ->data(compact('user',  'permissions','html','level','buyer'))
            ->output();
    }

    /**
     * Update the user.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return Response
     */
    public function update(UserRequest $request, User $user)
    {
        $atributes=$request->except(['_token','roles']);
    
        $id=$request->id;
        
      
        DB::table('master_buyer')->where('id',$id)->update($atributes);

        return response()->json(['id' => $id]);
    }
    public function delete(UserRequest $request)
    {
        $id=$request->id;
       
         RoleManagement::where('id',$id)->forceDelete();
        //$roles = $this->roles->all();
        //$permissions = $this->permissions->groupedPermissions();

        return response()->json(['id' => $id]);
    }
    
   

   

    /**
     * Remove the user.
     *
     * @param Model $user
     *
     * @return Response
     */
    public function destroy(UserRequest $request, User $user)
    {
        try {
            $user->delete();

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('user::user.name')]))
                ->code(202)
                ->status('success')
                ->url(guard_url('user/user/' . $user->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('user/user/' . $user->getRouteKey()))
                ->redirect();
        }
    }

    /**
     * Change the default team.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return Response
     */
    function switch (UserRequest $request) {
            try {
                $attributes = $request->all();
                $user = $this->repository->switch($attributes);
                return $this->response->message(trans('messages.success.detached', ['Module' => trans('user::team.name')]))
                    ->code(204)
                    ->status('success')
                    ->url(guard_url('user/user/' . $user->getRouteKey()))
                    ->redirect();
            } catch (Exception $e) {
                return $this->response->message($e->getMessage())
                    ->code(400)
                    ->status('error')
                    ->url(guard_url('user/user/' . $user->getRouteKey()))
                    ->redirect();
            }
    }

      public function getSubuser(UserRequest $request){
        $id=$request->id;
       
        $user = $this->repository->findbyfield('parent_id',$id);
        foreach(@$user as $titlekey => $value)
            {
                    $userdata['Id']=$id;
                    $userdata['parent_id']=$value['parent_id'];
                    $userdata['childNodeType']='leaf';
                    $userdata['childData']=$value['name'];
                    $userarray[]=$userdata;
            }
            $uservalue[$id]=$userarray;
       
        
        return response()->json(['nodeID'=>$userarray]);

      }
     


    
}
