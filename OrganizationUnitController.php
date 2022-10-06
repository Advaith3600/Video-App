<?php

namespace B2buy\Buyer\Http\Controllers;

use AbnLookup;
use App\Http\Controllers\ResourceController as BaseController;
use App\Mail\Approvalmail;
use B2buy\AssemblyPay\Payment;
use B2buy\Buyer\Http\Requests\OrganizationUnitRequest;
use B2buy\Buyer\Interfaces\OrganizationUnitRepositoryInterface;
use B2buy\Buyer\Models\OrganizationUnit;
use Ebuy\Address\Interfaces\AddressRepositoryInterface;
use Ebuy\Address\Models\Address;
use Exception;
use Form;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Litepie\Roles\Interfaces\RoleRepositoryInterface;
use B2buy\Buyer\Models\CreditApp;

/**
 * Resource controller class for buyer.
 */
class OrganizationUnitController extends BaseController
{

    /**
     * Initialize buyer resource controller.
     *
     * @param type BuyerRepositoryInterface $buyer
     *
     * @return null
     */
    public function __construct(OrganizationUnitRepositoryInterface $organizationunit, RoleRepositoryInterface $roles, AddressRepositoryInterface $address)
    {
        parent::__construct();
        $this->repository = $organizationunit;
        $this->roles = $roles;
        $this->address = $address;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\B2buy\Buyer\Repositories\Criteria\OrganizationUnitResourceCriteria::class);
   
        }

    /**
     * Display a list of buyer.
     *
     * @return Response
     */
    public function index(OrganizationUnitRequest $request)
    {

        $pageLimit = $request->input('pageLimit', 10);
        $data = $this->repository
            ->setPresenter(\B2buy\Buyer\Repositories\Presenter\OrganizationUnitPresenter::class)
            ->paginate($pageLimit);

        extract($data);
        
        $view = 'buyer::organizationunit.buyer.index';
        if ($request->ajax()) {
            $view = 'buyer::organizationunit.buyer.more';
        }
        return $this->response->setMetaTitle(trans('buyer::buyer.names'))
            ->view($view)
            ->data(compact('data', 'meta'))
            ->output();
    }

    /**
     * Display buyer.
     *
     * @param Request $request
     * @param Model   $buyer
     *
     * @return Response
     */
    public function show(OrganizationUnitRequest $request, OrganizationUnit $organizationunit)
    {

        if ($organizationunit->exists) {
            $view = 'buyer::organizationunit.buyer.show';
        } else {
            $view = 'buyer::organizationunit.buyer.new';
        }

        return $this->response->setMetaTitle(trans('app.view') . ' ' . trans('buyer::buyer.name'))
            ->data(compact('organizationunit'))
            ->view($view, true)
            ->output();
    }

    /**
     * Show the form for creating a new buyer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(OrganizationUnitRequest $request)
    {

        $buyer = $this->repository->newInstance([]);
        $roles = $this->roles->all();
        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('buyer::buyer.name'))
            ->view('buyer::organizationunit.buyer.create', true)
            ->data(compact('buyer'))
            ->output();
    }

    /**
     * Create new buyer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(OrganizationUnitRequest $request)
    {

        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $attributes['user_type'] = user_type();
            $attributes['parent_id'] = user_id();
            
           
           
            $organizationunit = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('buyer::buyer.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('organizationunit/organizationunit/' . $organizationunit->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/organizationunit/organizationunit'))
                ->redirect();
        }

    }

    /**
     * Show buyer for editing.
     *
     * @param Request $request
     * @param Model   $buyer
     *
     * @return Response
     */
    public function edit(OrganizationUnitRequest $request,  OrganizationUnit $organizationunit)
    {
        // $add = DB::table('users')
        //     ->join('address', 'users.id', '=', 'address.user_id')
        //     ->select('users.*', 'address.address1', 'address.user_id')
        //     ->get();

        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('buyer::buyer.name'))
            ->view('buyer::organizationunit.buyer.edit', true)
            ->data(compact('organizationunit'))
            ->output();
    }

    /**
     * Update the buyer.
     *
     * @param Request $request
     * @param Model   $buyer
     *
     * @return Response
     */
    public function update(OrganizationUnitRequest $request, OrganizationUnit $organizationunit)
    {
        try {
            $attributes = $request->except(['_method','_token']);

            
          
            OrganizationUnit::where('id',$organizationunit->id)->update($attributes);
            //$this->repository->update($attributes);
           
            
               
            return $this->response->message(trans('messages.success.updated', ['Module' => trans('buyer::buyer.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('organizationunit/organizationunit/' . $organizationunit->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('organizationunit/organizationunit/' . $organizationunit->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove the buyer.
     *
     * @param Model   $buyer
     *
     * @return Response
     */
    public function destroy(OrganizationUnitRequest $request, Buyer $buyer)
    {
        try {

            $buyer->delete();
            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('buyer::buyer.name')]))
                ->code(202)
                ->status('success')
                ->url(guard_url('buyer/buyer/0'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('buyer/buyer/' . $buyer->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove multiple buyer.
     *
     * @param Model   $buyer
     *
     * @return Response
     */
    public function delete(OrganizationUnitRequest $request, $type)
    {
       
        try {
            $ids = hashids_decode($request->input('ids'));

            if ($type == 'purge') {
                $this->repository->purge($ids);
            } else {
                $this->repository->delete($ids);
            }

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('buyer::buyer.name')]))
                ->status("success")
                ->code(202)
                ->url(guard_url('organizationunit/organizationunit'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('/organizationunit/organizationunit'))
                ->redirect();
        }

    }

    /**
     * Restore deleted buyers.
     *
     * @param Model   $buyer
     *
     * @return Response
     */
    public function restore(OrganizationUnitRequest $request)
    {
        try {
            $ids = hashids_decode($request->input('ids'));
            $this->repository->restore($ids);

            return $this->response->message(trans('messages.success.restore', ['Module' => trans('buyer::buyer.name')]))
                ->status("success")
                ->code(202)
                ->url(guard_url('/buyer/buyer'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('/buyer/buyer/'))
                ->redirect();
        }

    }

    public function mailFunction(Buyer $buyer)
    {
        // Mail::to($buyer->email)->send(new Welcomemail());

        // return new Welcomemail();
    }
  
}
