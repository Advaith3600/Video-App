<?php

namespace Ebuy\Product\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Ebuy\Product\Interfaces\BrandRepositoryInterface;

class BrandPublicController extends BaseController
{
    // use BrandWorkflow;

    /**
     * Constructor.
     *
     * @param type \Ebuy\Brand\Interfaces\BrandRepositoryInterface $brand
     *
     * @return type
     */
    public function __construct(BrandRepositoryInterface $brand)
    {
        $this->repository = $brand;
        parent::__construct();
    }

    /**
     * Show brand's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $brands = $this->repository
        ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
        ->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();


        return $this->response->setMetaTitle(trans('$product::brand.names'))
            ->view('product::brand.index')
            ->data(compact('brands'))
            ->output();
    }


    /**
     * Show brand.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $brand = $this->repository->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        return $this->response->setMetaTitle($$brand->name . trans('product::brand.name'))
            ->view('product::brand.show')
            ->data(compact('brand'))
            ->output();
    }

}