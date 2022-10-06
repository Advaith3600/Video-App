<?php

namespace B2buy\Buyer\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use App\Http\Requests\User\UserRequest;
use App\Interfaces\User\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Ebuy\Order\Interfaces\OrderRepositoryInterface;
use Ebuy\Product\Interfaces\BrandRepositoryInterface;
use Ebuy\Product\Interfaces\CategoryRepositoryInterface;
use Ebuy\Product\Interfaces\ProductRepositoryInterface;
use Ebuy\Product\Models\Brand;
use Ebuy\Product\Models\Category;
use Ebuy\Product\Models\Product;
use B2buy\Buyer\Models\CreditApp;
use B2buy\Buyer\Models\PaymentTerm;
use B2buy\Buyer\Models\RoleManagement;
use B2buy\TravisPay\CreditPayment;
use Illuminate\Support\Str;
use Litepie\Roles\Interfaces\PermissionRepositoryInterface;
use Litepie\Roles\Interfaces\RoleRepositoryInterface;
use B2buy\Shipping\Interfaces\ShippingRepositoryInterface;
use Mail;
use App\Mail\PasswordReset;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use B2buy\AssemblyPay\Payment;
use DB;
use Carbon\Carbon;
use App\Mail\OrderConfirm;
use App\Mail\ApprovalSuccess;
use App\Mail\RejectOrder;


/**
 * Resource controller class for user.
 */
class UserManagementController extends BaseController
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
        RoleRepositoryInterface $roles,
        ProductRepositoryInterface $product,
        BrandRepositoryInterface $brand,
        CategoryRepositoryInterface $category,
        OrderRepositoryInterface $order,
        ShippingRepositoryInterface $shipping
    ) {
        parent::__construct();

        $this->permissions = $permissions;
        $this->roles = $roles;
        $this->repository = $user;
        $this->product = $product;
        $this->brand = $brand;
        $this->category = $category;
        $this->order = $order;
        $this->shipping = $shipping;
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
                    // ->orWhere('id',$id);
            }
           
            return $query->orderBy('id');

        })->paginate($pageLimit);
        
        $view = 'buyer::usermanagement.index';
        if ($request->ajax()) {
            $view = 'buyer::usermanagement.more';
        }
        return $this->response->setMetaTitle(trans('user::user.names'))
            ->view($view)
            ->data(compact('data','pageLimit','search'))
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
    public function createSubuser(UserRequest $request){
        $attributes = $request->all();
      
        $attributes['user_id'] = user_id();
        $attributes['parent_id'] = user_id();
        $attributes['user_type'] = user_type();
        $attributes['user_mode'] = 'buyer';
        $attributes['api_token'] = Str::random(60);
        $manager_id=$request->manager_id;
       
        $current_timestamp = Carbon::now()->timestamp;
        $attributes['password']=Hash::make($current_timestamp);
        $role=$this->roles->findbyfield('slug','buyer')->first();
        $user = $this->repository->create($attributes);
        
       // $leveldata=DB::table('role_user')->where('user_id',@$manager_id)->first();
        
        // if(user_id()==$manager_id)
        // {
        //     $level=2;
        // }else{
        //     $level=@$leveldata->level+1;
        // }
        
      
        $data['role_id']=$role->id;
        $data['user_id']=$user->id;
        //$data['level']=$level;
        
        DB::table('role_user')->insert($data);
        DB::table('password_resets')->insert([
            'email' => $user->email, 
            'token' => $attributes['api_token'], 
            'created_at' => Carbon::now()
          ]);
        Mail::to($user->email)->send(new PasswordReset($user));
        
        

       
        
        return $this->response->setMetaTitle(__('Dashboard'))
                    ->view('user.verification-success')
                    ->data(compact('user'))
                    ->layout('custom')
                    ->output();
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
    public function editSubuser(UserRequest $request)
    {
       
        
        $id=$request->id;
       $user= $this->repository->findbyfield('id',$id)->first();

      //$role_user= DB::table('role_user')->where('user_id',$id)->first();
      $role_id = $user->role_id;
      $role=RoleManagement::where('id',$role_id)->first();
      $role_id=RoleManagement::where('user_id',user_id())->where('type','subuser')->where('parent_id','<',$role->parent_id)->pluck('id');
      
      $role_id=$role_id->Toarray();
      
      
      $users = User::where('id',user_id())->orWhereIn('role_id',$role_id)->get();
     
      //$users = User::where('id',$user->parent_id)->orWhere('parent_id', '=', $user->parent_id)->get();
        
      
      $html = '';
     
      $html .= '<option value="">Select Manager</option>';
      foreach($users as $opt):
        
        $class="";
       if($id!=$opt->id){
           if($user->manager_id==$opt->id)
           {
               $class="selected";
           }
        $html .= '<option value="'.$opt->id.' "'.$class.' >'.$opt->name.'</option>';
       }  
      endforeach;
      if(count($users)==0):
          $html = '<option value="">Manager not found</option>';
      endif;
       
        $permissions = $this->permissions->groupedPermissions();
      
        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('user::user.name'))
            ->view('user::user.edit')
            ->data(compact('user',  'permissions','html'))
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
        User::where('id',$id)->update($atributes);
       $user= $this->repository->findbyfield('id',$id)->first();
      

        // $leveldata=DB::table('role_user')->where('user_id',$user->manager_id)->first();
        // $level=$leveldata->level+1;
      
       
        // $data['level']=$level;
        
       
        // DB::table('role_user')->where('user_id',$id)->update($data);
       
        $permissions = $this->permissions->groupedPermissions();

        return $this->response->message(trans('messages.success.created', ['Module' => trans('user::user.name')]))
        ->code(204)
        ->status('success')
        ->url(guard_url('usermanagement/usermanagement/' . $user->getRouteKey()))
        ->redirect();
    }
    public function delete(UserRequest $request)
    {
        $id=$request->id;
        User::where('id',$id)->delete();
         DB::table('role_user')->where('user_id',$id)->delete();
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
        foreach($user as $titlekey => $value)
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
      public function getManagers(UserRequest $request)
    {
        

        $role_id = $request->input('role_id');
       
        $role=RoleManagement::where('id',$role_id)->first();
        $role_id=RoleManagement::where('user_id',user_id())->where('type','subuser')->where('parent_id','<',$role->parent_id)->pluck('id');
        
        $role_id=$role_id->Toarray();
        
        
        $users = User::where('id',user_id())->orWhereIn('role_id',$role_id)->get();
        
       
        $html = '';
       
        $html .= '<option value="">Select Manager</option>';
        foreach($users as $opt):
            $html .= '<option value="'.$opt->id.'">'.$opt->name.'</option>';
        endforeach;
        if(count($users)==0):
            $html = '<option value="">Manager not found</option>';
        endif;
        return response()->json(['data'=>$html],200);
    }
    public function getUpdateManagers(UserRequest $request)
    {
       
        
        $role_id = $request->input('role_id');
       $user_id=$request->user_id;
        $role=RoleManagement::where('id',$role_id)->first();
        $role_id=RoleManagement::where('user_id',user_id())->where('type','subuser')->where('parent_id','<',$role->parent_id)->pluck('id');
        
        $role_id=$role_id->Toarray();
        
        
        $users = User::where('id',user_id())->orWhereIn('role_id',$role_id)->get();
        
       
        $html = '';
       
        $html .= '<option value="">Select Manager</option>';
        foreach($users as $opt):
            if($opt->id!=$user_id){
                $html .= '<option value="'.$opt->id.'">'.$opt->name.'</option>';

            }
        endforeach;
        if(count($users)==0):
            $html = '<option value="">Manager not found</option>';
        endif;
        return response()->json(['data'=>$html],200);
    }
    public function getOrders(UserRequest $request)
    {
        
        
        $pageLimit = 10;
        if(user()->parent_id=='')
        {
            $id = user_id();
        }else{
            $id =user()->parent_id;
        }
      
        //$data = User::Where('id', '=', $id)->first();
        $user_id = User::Where('parent_id', '=', $id)->where('id','!=',user_id())->pluck('id');
        $user_id=$user_id->toArray();
       
     
       $orders =$this->order->scopeQuery(function ($query) use ($user_id){

        return $query->whereIn('user_id',$user_id)->where('status','Approve');
    })->paginate($pageLimit);
    
    
    $view = 'buyer::approveorder.index';
    if ($request->ajax()) {
        $view = 'buyer::approveorder.more';
    }
    return $this->response->setMetaTitle(trans('user::user.names'))
        ->view($view)
        ->data(compact('pageLimit','orders'))
        ->output();
    
       
       
       
    }
    public function orderApprove(UserRequest $request)
    {
        
        $id=$request->id;
        
       $orders= $this->order->findByField('id',$id)->first();
      
       $data['status']="Pending";
       DB::table('orders')->where('id',$id)->update($data);
      
       $buyer=$this->repository->findByField('id', $orders->user_id)->first();
       $order_email = $orders->seller->order_email!=null ? $orders->seller->order_email:$orders->seller->work_email;
       Mail::to($buyer->email)->send(new ApprovalSuccess($orders));
        
       
       Mail::to($order_email)->send(new OrderConfirm($orders));
        return response()->json(['id' => $id]);
    }
    public function orderReject(UserRequest $request)
    {
       
        $id=$request->id;
        
       $orders= $this->order->findByField('id',$id)->first();
       $orders['rejected_by']=user()->name;
       $data['status']="Cancelled";
       DB::table('orders')->where('id',$id)->update($data);
      
       $buyer=$this->repository->findByField('id', $orders->user_id)->first();
       Mail::to($buyer->email)->send(new RejectOrder($orders));
        
       
     
        return response()->json(['id' => $id]);
    }
    public function orderAccept(UserRequest $request)
    {
       
        $id=$request->id;
        
       $orders= $this->order->findByField('id',$id)->first();

       $user_id=$orders->user_id;
      
       $user=User::where('id',$user_id)->first();
      
       $data['manager_id']=user()->manager_id;
       $user->update($data);
      
       
        
       
     
        return response()->json(['id' => $id]);
    }
    

    
}
