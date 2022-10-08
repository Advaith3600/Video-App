<?php

namespace Ebuy\Product\Http\Controllers;

use App\Http\Controllers\APIController as BaseController;
use Ebuy\Product\Http\Requests\ProductRequest;
use Ebuy\Product\Interfaces\ProductRepositoryInterface;
use Ebuy\Product\Models\Product;
use Ebuy\Product\Forms\Product as Form;

/**
 * APIController  class for product.
 */
class ProductAPIController extends BaseController
{

    /**
     * Initialize product resource controller.
     *
     * @param type ProductRepositoryInterface $product
     *
     * @return null
     */
    public function __construct(ProductRepositoryInterface $product)
    {
        parent::__construct();
        $this->repository = $product;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Ebuy\Product\Repositories\Criteria\ProductResourceCriteria::class);
    }

    /**
     * Display a list of product.
     *
     * @return Response
     */
    public function index(ProductRequest $request)
    {
        return $this->repository
            ->setPresenter(\Ebuy\Product\Repositories\Presenter\ProductPresenter::class)
            ->paginate();
    }

    /**
     * Display product.
     *
     * @param Request $request
     * @param Model   $product
     *
     * @return Response
     */
    public function show(ProductRequest $request, Product $product)
    {
        return $product->setPresenter(\Ebuy\Product\Repositories\Presenter\ProductListPresenter::class);
        ;
    }

    /**
     * Create new product.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $data              = $request->all();
            $data['user_id']   = user_id();
            $data['user_type'] = user_type();
            $data              = $this->repository->create($data);
            $message           = trans('messages.success.created', ['Module' => trans('product::product.name')]);
            $code              = 204;
            $status            = 'success';
            $url               = guard_url('product/product/' . $product->getRouteKey());
        } catch (Exception $e) {
            $message = $e->getMessage();
            $code    = 400;
            $status  = 'error';
            $url     = guard_url('product/product');
        }
        return compact('data', 'message', 'code', 'status', 'url');
    }

    /**
     * Update the product.
     *
     * @param Request $request
     * @param Model   $product
     *
     * @return Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $data = $request->all();

            $product->update($data);
            $message = trans('messages.success.updated', ['Module' => trans('product::product.name')]);
            $code    = 204;
            $status  = 'success';
            $url     = guard_url('product/product/' . $product->getRouteKey());
        } catch (Exception $e) {
            $message = $e->getMessage();
            $code    = 400;
            $status  = 'error';
            $url     = guard_url('product/product/' . $product->getRouteKey());
        }
        return compact('data', 'message', 'code', 'status', 'url');
    }

    /**
     * Remove the product.
     *
     * @param Model   $product
     *
     * @return Response
     */
    public function destroy(ProductRequest $request, Product $product)
    {
        try {
            $product->delete();
            $message = trans('messages.success.deleted', ['Module' => trans('product::product.name')]);
            $code    = 202;
            $status  = 'success';
            $url     = guard_url('product/product/0');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $code    = 400;
            $status  = 'error';
            $url     = guard_url('product/product/' . $product->getRouteKey());
        }
        return compact('message', 'code', 'status', 'url');
    }

    /**
     * Return the form elements as json.
     *
     * @param String   $element
     *
     * @return json
     */
    public function form($element = 'fields')
    {
        $form = new Form();
        return $form->form($element, true);
    }

}
