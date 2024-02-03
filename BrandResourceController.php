<?php

namespace Ebuy\Product\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use Form;
use Ebuy\Product\Http\Requests\BrandRequest;
use Ebuy\Product\Interfaces\BrandRepositoryInterface;
use Ebuy\Product\Models\Brand;
use Illuminate\Support\Str;

/**
 * Resource controller class for brand.
 */
class BrandResourceController extends BaseController
{

    /**
     * Initialize brand resource controller.
     *
     * @param type BrandRepositoryInterface $brand
     *
     * @return null
     */
    public function __construct(BrandRepositoryInterface $brand)
    {
        parent::__construct();
        $this->repository = $brand;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Ebuy\Product\Repositories\Criteria\BrandResourceCriteria::class);
            if (! function_exists('camel_case')) {
                /**
                 * Convert a value to camel case.
                 *
                 * @param  string  $value
                 * @return string
                 */
                function camel_case($value)  {
                    return Str::camel($value);
                }
            }
    }

    /**
     * Display a list of brand.
     *
     * @return Response
     */
    public function index(BrandRequest $request)
    {
        $pageLimit = $request->input('pageLimit', 10);
        $data = $this->repository
            ->setPresenter(\Ebuy\Product\Repositories\Presenter\BrandPresenter::class)
            ->paginate($pageLimit);
        extract($data);
        $mode =  (user()->user_mode == "supplier") ? 'default' :'admin';

        $view = "product::$mode.brand.index";
        if ($request->ajax()) {
            $view = "product::$mode.brand.more";
        }
        return $this->response->setMetaTitle(trans('product::brand.names'))
            ->view($view)
            ->data(compact('data', 'meta'))
            ->output();

    }

    /**
     * Display brand.
     *
     * @param Request $request
     * @param Model   $brand
     *
     * @return Response
     */
    public function show(BrandRequest $request, Brand $brand)
    {

        $mode =  (user()->user_mode == "supplier") ? 'default' :'admin';
        $view = $brand->exists ? "product::$mode.brand.show" : "product::$mode.brand.new";

        return $this->response->setMetaTitle(trans('app.view') . ' ' . trans('product::brand.name'))
            ->data(compact('brand'))
            ->view($view)
            ->output();

    }

    /**
     * Show the form for creating a new brand.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(BrandRequest $request)
    {

        $mode =  (user()->user_mode == "supplier") ? 'default' :'admin';
        $brand = $this->repository->newInstance([]);
        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('product::brand.name')) 
            ->view("product::$mode.brand.create", true)
            ->data(compact('brand'))
            ->output();
    }

    /**
     * Create new brand.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(BrandRequest $request)
    {
        try {
            $attributes              = $request->all();
            $attributes['user_id']   = user_id();
            $attributes['user_type'] = user_type();
            $brand                 = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('product::brand.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('product/brand/' . $brand->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/product/brand'))
                ->redirect();
        }

    }

    /**
     * Show brand for editing.
     *
     * @param Request $request
     * @param Model   $brand
     *
     * @return Response
     */
    public function edit(BrandRequest $request, Brand $brand)
    {
        $mode =  (user()->user_mode == "supplier") ? 'default' :'admin';
        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('product::brand.name'))
            ->view("product::$mode.brand.edit", true)
            ->data(compact('brand'))
            ->output();
    }

    /**
     * Update the brand.
     *
     * @param Request $request
     * @param Model   $brand
     *
     * @return Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        try {
            $attributes = $request->all();

            $brand->update($attributes);
            return $this->response->message(trans('messages.success.updated', ['Module' => trans('product::brand.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('product/brand/' . $brand->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('product/brand/' . $brand->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove the brand.
     *
     * @param Model   $brand
     *
     * @return Response
     */
    public function destroy(BrandRequest $request, Brand $brand)
    {
        try {

            $brand->delete();
            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('product::brand.name')]))
                ->code(202)
                ->status('success')
                ->url(guard_url('product/brand/0'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('product/brand/' . $brand->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove multiple brand.
     *
     * @param Model   $brand
     *
     * @return Response
     */
    public function delete(BrandRequest $request, $type)
    {
        try {
            $ids = hashids_decode($request->input('ids'));

            if ($type == 'purge') {
                $this->repository->purge($ids);
            } else {
                $this->repository->delete($ids);
            }

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('product::brand.name')]))
                ->status("success")
                ->code(202)
                ->url(guard_url('product/brand'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('/product/brand'))
                ->redirect();
        }

    }

    /**
     * Restore deleted brands.
     *
     * @param Model   $brand
     *
     * @return Response
     */
    public function restore(BrandRequest $request)
    {
        try {
            $ids = hashids_decode($request->input('ids'));
            $this->repository->restore($ids);

            return $this->response->message(trans('messages.success.restore', ['Module' => trans('product::brand.name')]))
                ->status("success")
                ->code(202)
                ->url(guard_url('/product/brand'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('/product/brand/'))
                ->redirect();
        }

    }

}
