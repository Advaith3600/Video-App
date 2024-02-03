<?php

namespace Ebuy\Product\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use B2buy\AssemblyPay\Payment;
use B2buy\Search\Interfaces\SearchRepositoryInterface;
use B2buy\Search\Models\Search;
use DB;
use Ebuy\Address\Models\Address;
use Ebuy\Discount\Interfaces\DiscountRepositoryInterface;
use Ebuy\Order\Interfaces\OrderRepositoryInterface;
use Ebuy\Order\Models\Order;
use Ebuy\Order\Models\OrderProduct;
use Ebuy\Product\Interfaces\BrandRepositoryInterface;
use Ebuy\Product\Interfaces\CategoryRepositoryInterface;
use Ebuy\Product\Interfaces\ProductRepositoryInterface;
use Ebuy\Product\Interfaces\UnspscRepositoryInterface;
use Ebuy\Product\Models\Category;
use Ebuy\Product\Models\Product;
use Ebuy\Product\Models\ProductView;
use Ebuy\Product\Models\Recommendation;
use Exception;
use Illuminate\Http\Request;
use App\Mail\Welcome;
use Ebuy\Product\Models\Import;
use Illuminate\Support\Facades\Mail;
use Litepie\Master\Interfaces\MasterRepositoryInterface;
use Ebuy\Product\Interfaces\ProductUnspscRepositoryInterface;
use Ebuy\Address\Interfaces\AddressRepositoryInterface;
use Ebuy\Cart\Models\Shipping;
use B2buy\Customprice\Models\Customprice;
use App\Mail\OrderConfirm;
use App\Mail\ApproveOrder;


class ProductPublicController extends BaseController
{
    // use ProductWorkflow;

    /**
     * Constructor.
     *
     * @param type \Ebuy\Product\Interfaces\ProductRepositoryInterface $product
     *
     * @return type
     */
    public function __construct(ProductRepositoryInterface $product, CategoryRepositoryInterface $category,
        BrandRepositoryInterface $brand, DiscountRepositoryInterface $discount, SearchRepositoryInterface $search, 
        MasterRepositoryInterface $master, OrderRepositoryInterface $order,UnspscRepositoryInterface $unspsc,
        ProductUnspscRepositoryInterface $product_unspsc, AddressRepositoryInterface $address)
    {
        $this->repository = $product;
        $this->category = $category;
        $this->brand = $brand;
        $this->discount = $discount;
        $this->search = $search;
        $this->master = $master;
        $this->order = $order;
        $this->address = $address;
        $this->unspsc=$unspsc;
        $this->product_unspsc=$product_unspsc ;      
        parent::__construct();

        if (!empty(app('auth')->getDefaultDriver())) {
            $this->middleware('auth:' . app('auth')->getDefaultDriver(), ['only' => ['index']]);
        }
    }

    /**
     * Show product's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function indexOld(Request $request)
    {
        $attributes = $request->all();
        $search = $request->search;
        $search_query = @$search['name'];
        $search_category = $request->category_id;
        $products = "test";
        $brand_id = null;
        $price[0] = $price[1] = null;
        if (is_array($search) && array_key_exists('price', $search)) {
            $price = explode(';', $search['price']);
        }

        // dd($attributes);
        if ($search != null && array_key_exists('category_id', $search) && $search['category_id'] != null) {
            $categories = Category::where('parent_id', $search['category_id'])->get();
            foreach ($categories as $key => $category) {
                $parent_categories[] = $category->id;
            }
        }

        if ($search != null) {
            if ($search_query != "") {
                $builder = Product::query();
                $builder->where('name', 'LIKE', "%$search_query%");
                $products = $builder->paginate(1);
            }
            if (array_key_exists('category_id', $search) && $search_query != "" && $search['category_id'] != null) {
                $builder = Product::query();
                $builder->where('name', 'LIKE', "%$search_query%");
                $category_id = $search['category_id'];
                if ($category_id != 0 && $category_id != null) {
                    if (is_array($parent_categories)) {
                        $builder->whereIn('category_id', @$parent_categories)
                            ->orWhere('category_id', $category_id);
                    } else {
                        $builder->orWhere('category_id', $category_id);
                    }

                    $products = $builder->paginate(1);
                }
                $products = $builder->paginate(1);
            }
            if (array_key_exists('category_id', $search)) {

                if ($search_query == "") {
                    $category_id = $search['category_id'];
                    $builder = Product::query();
                    if (is_array(@$parent_categories)) {
                        $builder->whereIn('category_id', @$parent_categories)
                            ->orWhere('category_id', $category_id);
                    } else {
                        $builder->orWhere('category_id', $search['category_id']);
                    }

                    $products = $builder->paginate(1);
                }
            }
            if (array_key_exists('price', $search) && $search_query != '') {
                $builder = Product::query();
                $builder = $builder->where('name', 'LIKE', "%$search_query%")
                    ->whereBetween('price', [$price[0], $price[1]]);
                $products = $builder->paginate(1);

            }
            if (array_key_exists('price', $search) && $search_query == '') {
                $builder = Product::query();
                $builder = $builder->whereBetween('price', [$price[0], $price[1]]);
                $products = $builder->paginate(1);

            }
        }
        if (is_numeric($search_category) && $search_query != "") {
            $builder = Product::query();
            $builder->where('name', 'LIKE', "%$search_query%");
            if ($search_category != 0) {
                if (is_array($parent_categories)) {
                    $builder->whereIn('category_id', @$parent_categories)
                        ->orWhere('category_id', $search_category);
                } else {
                    $builder->orWhere('category_id', $search_category);
                }

                $builder->orwhere('category_id', $search_category);
            }
            $products = $builder->paginate(1);
        }
        if (is_numeric($search_category)) {
            if ($search_query == "") {
                $builder = Product::query();
                if (is_array(@$parent_categories)) {
                    $builder->whereIn('category_id', @$parent_categories)
                        ->orWhere('category_id', $search_category);
                } else {
                    $builder->orWhere('category_id', $search_category);
                }

                $products = $builder->paginate(1);
            }
        }
        if ($products == "test") {
            $builder = Product::query();
            $products = $builder->paginate(1);
        }
        if (is_array($search) && array_key_exists('brand_id', $search)) {
            $brand_id = $search['brand_id'];
            $builder = Product::query();
            $builder->where('brand_id', $search['brand_id']);
            $products = $builder->paginate(1);
        }
        if (array_key_exists('order_by', $attributes)) {
            return $this->sort($attributes['order_by'], $products);
        }
        $view = 'index';
        if ($request->ajax()) {

            $view = 'list';
        }
        return $this->response->setMetaTitle('Shop Ebuy')
            ->view('product::public.product.' . $view)
            ->data(compact('products', 'price', 'brand_id'))
            ->output();
    }

    /**
     * Show product.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($id)
    {
        $product = $this->repository->scopeQuery(function ($query) use ($id) {
            return $query->orderBy('created_at', 'DESC')
                ->where('id', hashids_decode($id));
        })->first(['*']);

        if($product){
            $customdata = Customprice::whereRaw('FIND_IN_SET('.$product->id.',product_id)')
                            ->orWhere('product_id', 'like', "%[".$product->id."%")
                            ->orWhere('product_id', 'like', "%".$product->id."%]")
                            ->where('buyer_id',user_id())
                            ->first();
            if($customdata&&@$customdata->custom_price[$product->id]!=null)  
                $customprice= @$customdata->custom_price[$product->id];
            elseif($customdata&&@$customdata->cost_price[$product->id]!=null)  
                $customprice= @$customdata->cost_price[$product->id];
                $product->original_price = $product->online_price;
            if($customdata)
                $product->online_price = $customprice;
            ProductView::createProductLog($product);
            return $this->response->setMetaTitle($product->name . trans('product::product.name'))
                ->view('product::public.product.show')
                ->data(compact('product'))
                ->output();
            
        }
    }
    public function options($id)
    {
        $category = $this->category->parentCategory($id);
        return view('product::category.partial.optioncategory', compact('category'));

    }
    public function addFavourite($id, Request $request)
    {
        $userId = user_id();
        $data = DB::table('favourites')
            ->where('user_id', $userId)
            ->where('product_id', $id)
            ->first(['*']);
        if ($data != null) {
            DB::table('favourites')
                ->where('user_id', $userId)
                ->where('product_id', $id)
                ->where('id', $data->id)
                ->delete();
            // return redirect('/')->with('success', 'Product Removed from favouritess!');
            $count = DB::table('favourites')
                ->where('user_id', $userId)
                ->count();
            session()->put('fav_count', $count);
            if ($request->ajax()) {
                return response()->json(['count' => $count, 'status' => 'removed', 'id' => $id]);
            } else {
                return redirect()->back()->with('success', 'Product removed from favourites!');
            }
        } else {
            $value = ['product_id' => $id, 'user_id' => $userId];
            $list = DB::table('favourites')
                ->insert($value);
            // return redirect('products');
            // return redirect('/')->with('success', 'Product added to favouritess!');
            $count = DB::table('favourites')
                ->where('user_id', $userId)
                ->count();
            session()->put('fav_count', $count);
            if ($request->ajax()) {
                return response()->json(['count' => $count, 'status' => 'added']);
            } else {
                return redirect()->back()->with('success', 'Product added to favouritess!');
            }

        }

    }
    public function sort($order, $items)
    {

        foreach ($items as $item) {
            $products[] = Product::leftJoin('discount', 'discount.product_id', '=', 'products.id')
                ->select('products.*',
                    'discount.name as d_name',
                    'discount.discount_price',
                    'discount.category_id as d_category_id',
                    'discount.parent_id as d_parent_id',
                    'discount.subcategory_id as d_subcategory_id',
                    'discount.product_id as d_product_id')
                ->get()
                ->where('id', $item->id)
                ->first();
        }
        $products = collect(@$products);
        foreach ($products as $product) {
            if ($product->discount_price == null) {
                $product->discount_price = $product->price;
            }

        }
        if ($order == 'price_asc') {
            $products = $products->sortBy('discount_price');
        } elseif ($order == 'price_desc') {
            $products = $products->sortByDesc('discount_price');
        } elseif ($order == 'asc') {
            $products = $products->sortByDesc('created_at');
        } else {
            $products = $products->sortBy('created_at');
        }

        return $this->response->setMetaTitle(trans('product::product.names'))
            ->view('product::public.product.index')
            ->data(compact('products'))
            ->output();

    }
    public function addToCart($id, Request $request)
    {

        if ($request->quantity == null) {
            $quantity = 1;
        } else {
            $quantity = $request->quantity;

        }

        if (strpos($id, 'product_id=') !== false) {
            // echo 'true';
            $array = [];
            parse_str($id, $array);
            $id = $array['product_id'];
            $quantity = $array['quantity'];

        }

        $product = Product::select('products.*', 'products.product_id as product_code', 'discount.product_id', 'discount.discount_price', 'discount.discount')
            ->leftjoin('discount', 'discount.product_id', '=', 'products.id')
            ->where('products.id', $id)->first();
            $customdata = Customprice::whereRaw('FIND_IN_SET('.$product->id.',product_id)')
            ->orWhere('product_id', 'like', "%[".$product->id."%")
            ->orWhere('product_id', 'like', "%".$product->id."%]")
            ->where('buyer_id',user_id())
            ->first();     
            if($customdata&&@$customdata->custom_price[$product->id]!=null)  
                $customprice= @$customdata->custom_price[$product->id];
            elseif($customdata&&@$customdata->cost_price[$product->id]!=null)  
                $customprice= @$customdata->cost_price[$product->id];
            $product->original_price = $product->online_price;
        if($customdata)
            $product->online_price = $customprice;
            $cart = session()->get('cart');

        // if cart is empty then this the first product
        $subTotal = 0;
        if (!$cart) {
            if (($this->discount->discountDate($product->id))->count() != 0) {
                $cart = [
                    $id => [ //
                        "name" => $product->name,
                        "quantity" => $quantity,
                        "slug" => $product->slug,
                        "seller_price" => $product->price,
                        "online_price" => $product->online_price,
                        "price" => $product->discount_price,
                        "tax_rate" => @$product->tax_rate,
                        "tax_amount" => @$product->tax_amount,
                        "total" => @$product->total,
                        "photo" => $product->images,
                        "subtotal" => $quantity * $product->discount_price,
                        "discount_price" => $product->discount_price,
                        "discount" => $product->discount,
                        "product_id" => $id,
                        "seller_id" => $product->seller_id,
                        "weight" => $product->weight,

                    ],
                ];
            } else {
                $cart = [
                    $id => [
                        "name" => $product->name,
                        "quantity" => $quantity,
                        "slug" => $product->slug,
                        "price" => $product->online_price,
                        "seller_price" => $product->price,
                        "online_price" => $product->online_price,
                        "margin" => $product->blanket_margin,
                        "tax_rate" => @$product->tax_rate,
                        "tax_amount" => @$product->tax_amount,
                        "total" => @$product->total,
                        "photo" => $product->images,
                        "subtotal" => $quantity * $product->price,
                        "discount_price" => $product->discount_price,
                        "discount" => $product->discount,
                        "product_id" => $id,
                        "seller_id" => $product->seller_id,
                        "weight" => $product->weight,


                    ],
                ];
            }

            session()->put('cart', $cart);
            $count = count(session('cart'));
            if ($request->ajax()) {
                return $this->response->setMetaTitle(trans('product::product.name'))
                    ->view('cart::public.cart.cart-header')
                    ->output();
            } else {
                return redirect('listing')->with('success', 'Product added to cart successfully!');
            }
        }
        //if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {
            
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $quantity;
            $cart[$id]['online_price'] = $cart[$id]['price'] * $cart[$id]['quantity'];
           
            if (($this->discount->discountDate($product->id))->count() != 0) {
                $cart[$id]['subtotal'] = $cart[$id]['subtotal'] + $quantity * $product->discount_price;
            } else {
                $cart[$id]['subtotal'] = $cart[$id]['subtotal'] + $quantity * $product->price;
            }

            

            session()->put('cart', $cart);

            $count = count(session('cart'));
            if ($request->ajax()) {
                return $this->response->setMetaTitle(trans('product::product.name'))
                    ->view('cart::public.cart.cart-header')
                    ->output();
            } else {
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }

        }
        // if item not exist in cart then add to cart with quantity = 1
        if (($this->discount->discountDate($product->id))->count() != 0) {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->discount_price,
                "seller_price" => $product->price,
                "online_price" => $product->online_price,
                "tax_rate" => @$product->tax_rate,
                "tax_amount" => @$product->tax_amount,
                "total" => @$product->total,
                "photo" => $product->images,
                "subtotal" => $quantity * $product->discount_price,
                "discount_price" => $product->discount_price,
                "discount" => $product->discount,
                "slug" => $product->slug,
                "product_id" => $id,
                "seller_id" => $product->seller_id,
                "weight" => $product->weight,



            ];
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->online_price,
                "seller_price" => $product->price,
                "online_price" => $product->online_price,
                "tax_rate" => @$product->tax_rate,
                "tax_amount" => @$product->tax_amount,
                "total" => @$product->total,
                "photo" => $product->images,
                "subtotal" => $quantity * $product->price,
                "discount_price" => $product->discount_price,
                "discount" => $product->discount,
                "slug" => $product->slug,
                "product_id" => $id,
                "seller_id" => $product->seller_id,
                "weight" => $product->weight,


            ];
        }
        session()->put('cart', $cart);
        $count = count(session('cart'));
        $response['quantity'] = session('cart')[$id]['quantity'];
        $response['view'] = 'cart::public.cart.cart-header';
        // $subtotal = 0 ;
        // if(session('cart')!=null){

        //     foreach(session('cart') as $key=>$cartitem) {
        //         $subtotal = $subtotal+($cartitem['price']*$cartitem['quantity']);

        //     }
        // }

        if ($request->ajax()) {
            return $this->response->setMetaTitle(trans('product::product.name'))
                ->view('cart::public.cart.cart-header')
                ->output();
        } else {
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }
    public function update(Request $request)
    {
        $cart = session()->get('cart');
        // echo $request->id;die;
        if ($request->quantity && $request->id) {

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
        $quantity = session('cart')[$request->id]['quantity'];
        if (array_key_exists('discount_price', session('cart')[$request->id])) {
            $total = session('cart')[$request->id]['discount_price'];
        } else {
            $total = @session('cart')[$request->id]['price'];
        }
        if ($request->ajax()) {
            if (url()->previous() == trans_url('carts')) {
                return ['quantity' => $quantity, 'total' => $total, 'product_id' => @session('cart')[$request->id]['product_id']];
            } else {
                return $this->response->setMetaTitle(trans('product::product.name'))
                    ->view('cart::public.cart.cart-header')
                    ->output();
            }

        } else {
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }

    }
    public function remove($product_id)
    {
        if ($product_id == 'all') {
            session()->forget('cart');
            session()->forget('tmp_cart');
        }

        if ($product_id) {
            $cart = session()->get('cart');
            if (isset($cart[$product_id])) {
                unset($cart[$product_id]);
                session()->put('cart', $cart);
            }

        }
        if (session()->get('cart') != null && count(session()->get('cart')) == 0) {
            return redirect()->back()->with(['success' => 'Product removed successfully!', 'view' => 'cart::public.cart.cart-list']);
        } else {
            return redirect()->back()->with(['success' => 'Product removed successfully!', 'view' => 'cart::public.cart.cart-list']);
        }
    }
    protected function searchSuggestions(Request $request)
    {

        $name = $request->get('name');

        $names = $this->repository->scopeQuery(function ($query) use ($name) {
            return $query->orderBy('name', 'ASC')
                ->where('name', 'like', '%' . $name . '%')
                ->take(10);
        })->get();
        return view('product::public.product.name_suggestions', compact('names'));
    }
    public function productoptions($id)
    {
        $product = $this->repository->findByField('category_id', $id)->pluck('name', 'id');
        return view('product::product.partial.optionproduct', compact('product'));

    }
    public function priceoptions($id)
    {
        $price = $this->repository->findByField('id', $id)->pluck('price')->first();
        return view('product::product.partial.optionprice', compact('price'));
    }
    public function productSort($id)
    {
        $products = $this->repository
            ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
            ->scopeQuery(function ($query) {
                return $query
                    ->orderBy('created_at', 'DESC');
            })->paginate($id);
        return $this->response->setMetaTitle('Shop Ebuy')
            ->view('product::public.product.list')
            ->data(compact('products'))
            ->layout('list')
            ->output();
    }
    public function recommend($product_id, $status)
    {

        $attributes['product_id'] = $product_id;
        $attributes['status'] = $status;
        $attributes['user_id'] = user_id();
        $data = Recommendation::where('product_id', $product_id)
            ->where('user_id', user_id())
            ->first();
        if ($data == null) {
            Recommendation::create($attributes);
        } else {
            Recommendation::where('id', $data->id)->update($attributes);
        }

        $product = Product::where('id', $product_id)->first();
        $val['recommended'] = $product->recommended()->count();
        $val['persantage'] = ($val['recommended'] / $product->recommendations()->count()) * 100;

        return $val;
    }
    protected function index(Request $request)
    {

        DB::enableQueryLog();
        $attributes = $request->all();

        // print_r($attributes);
        $search = $request->search;
        $unspscs = null;
        $price[0] = 0;
        $price[1] = 10000;
        $brands = null;
        $filter_categories = null;
        $custom_results = null;
        $pagelimit = 25;
        if (array_key_exists('pagelimit', $attributes)) {
            $pagelimit = $attributes['pagelimit'];
        }

        if ($search != null && array_key_exists('category_id', $search) && $search['category_id'] != null) {
            $categories = Category::where('parent_id', $search['category_id'])->get();
            foreach ($categories as $key => $category) {
                $parent_categories[] = $category->id;
            }
        }
        // $builder = Product::query();
        $builder = Product::whereHas('seller', function ($query) {
            return $query->where(['store_status'=>'Active','verify_account'=>1]);
        });
        $builder = $builder->where('status', '=','show');
        $builder = $builder->whereBetween('online_price', [$price[0], $price[1]]);
        if ($search) {
            //die;
            if (is_array($search) && array_key_exists('price', $search)) {
                $price = explode(';', $search['price']);
            }

            if (is_array($search) && array_key_exists('name', $search)) {
                $search_query = $search['name'];
            }

            // $builder = Product::query();
            $builder = Product::whereHas('seller', function ($query) {
                return $query->where(['store_status'=>'Active','verify_account'=>1]);
            });
            $builder = $builder->where('status', '=','show');
            if ($search && array_key_exists('custom', $search) && $search['custom'] != null) {
                $products = $builder->get();
                $search['custom'] = preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s", '', $search['custom']);
                $search['custom']=str_replace(')', '', $search['custom']);
                $search['custom']=str_replace('(', '', $search['custom']);
                $search['custom']=str_replace('%', '', $search['custom']);

                if($search['custom']!=""){
                    $custom_results = $this->customSearch($search, $products, $builder)[0];
                    $builder = $this->customSearch($search, $products, $builder)[1];
                    $keywords = explode(" ",$search['custom']);
                
                    foreach($keywords as $keyword){
                        $builder = $builder->where('name', 'rlike', $keyword);
                    // $builder = $builder->where('name', 'rlike', "\\b".$keyword."\\b");
                    }
                }
            }
          

            if (array_key_exists('category_id', $search) && $search['category_id'] != '' && $search['category_id'] != null) {
                if (is_array($search['category_id'])) {
                    if ($search['category_id'] != 0 && $search['category_id'] != null) {
                        if (is_array(@$parent_categories)) {
                            $builder = $builder->whereIn('category_id', @$parent_categories)
                                ->whereIn('category_id', $search['category_id']);
                        } else {
                            $builder = $builder->whereIn('category_id', $search['category_id']);
                        }

                    }
                } else {
                    $builder = $builder->where('category_id', $search['category_id']);
                }
                $data = $builder;
            }

            if (array_key_exists('brand_id', $search)) {
                $builder = $builder->whereIn('brand_id', $search['brand_id']);
            }
            if (is_array($search) && array_key_exists('name', $search) && $search_query != '') {
                foreach($search_query as $keyword){
                    $builder = $builder->orWhere('name', 'RLIKE', "\\b".$search_query."\\b");
                }
            }
            if (array_key_exists('price', $search)) {
                $builder = $builder->whereBetween('online_price', [$price[0], $price[1]]);
            }
            if (array_key_exists('unspsc', $search)&&array_filter($search['unspsc'])!=[]) {
                $unspsc_products = $this->product_unspsc
                                ->get_unspsc($search['unspsc']);
                $builder = $builder->whereIn('id',$unspsc_products);

            }
           
            if ($search && array_key_exists('brand_id', $search)) {
                $brands = $this->get_brands($builder);
            }

            $filter_categories = $this->get_categories($builder);
            $unspscs = $this->get_unspsc($builder,$search);
        }
        if ($search && array_key_exists('order_by', $search)) {
            if ($search['order_by'] == 'price_asc') {
                $builder = $builder->orderBy('online_price', 'ASC');
            } elseif ($search['order_by'] == 'price_desc') {
                $builder = $builder->orderBy('online_price', 'DESC');
            } elseif ($search['order_by'] == 'asc') {
                $builder = $builder->orderBy('created_at', 'ASC');
            } else {
                $builder = $builder->orderBy('created_at', 'DESC');
            }
        } else {
            $builder = $builder->orderBy('created_at', 'DESC');
            
        }

        
        $products = $builder->paginate($pagelimit);

           // dd(B::getQueryLog());
    
        $view = 'index';
        if ($request->ajax()) {
            $view = 'list';
        }
        return $this->response->setMetaTitle('Shop B2buy')
            ->view('product::public.product.' . $view)
            ->nest('product::public.product.unspsc-filter')
            ->data(compact('products', 'unspscs', 'custom_results', 'price', 'brands', 'filter_categories','search'))
            ->output();
    }
    public function payment(){

        $address = [];
        if (user_id() != null) {
            $userId = user_id();
            $address = $this->address->findByField('user_id',$userId)->first();
        }
        $delivery_type = $this->master->get_master_type('post.delivery_type');
        
        $view = 'cart::public.cart.payment';
    
       
        return $this->response->setMetaTitle(trans('cart::cart.name'))
            ->view($view)
            ->data(compact('address','delivery_type'))
            ->output();

    }

    public function proceed_payment(Request $request){
        $payment = new Payment(); 
        $userId = user_id();
        $user = user();

        $payment_section = session()->get('payment_section');
        $order_id = $payment_section['order_id'];
        $order_list = $this->order->findByField('id', $order_id)->first();
       
        if($payment_section){
            $payment_method  = $request->payment_method;
            $saved_card_id  = $account_id = $seller_account_id  = null;
         
            if(!$payment_method){
                return redirect('payment')->with('warning', 'Payment method invalid');
            }
            $cart_total = $payment_section['cart_total'];
            if($cart_total == 0){
                return redirect('payment')->with('warning', 'Can not make payment with amount zero');
            }
           
            
            if($payment_method == 'direct_debit' || $payment_method == 'direct_debit_delayed'){

                $seller_bank_accounts  = json_decode($order_list->seller->bank_accounts,TRUE);
                if(!$seller_bank_accounts){
                    return redirect('payment')->with('warning', "Can't make payment, if Seller not ready to make payment");
                }

                if($user->direct_debit_agreement !== 1){
                    return redirect('payment')->with('warning', 'Direct Debit Method not enabled');
                }

                if($user->direct_debit_account_id  == null){
                    return redirect('payment')->with('warning', 'No bank account found');
                }else{
                    $direct_debit_accounts  = json_decode($user->direct_debit_account_id,TRUE);
                    if($direct_debit_accounts){
                        $account_id = key($direct_debit_accounts);
                    }
                }

                if($account_id == null){
                    return redirect('payment')->with('warning', 'No bank account found');
                }
              
            }else if($request->card_acccount ){
                $account_id  = $request->card_acccount;
            }
        }

        $master = $this->master->findWhere(['code' => 'SA', 'type' => 'supplier.agreement'])->first();
        if ($master) {
            $margin = $master->amount;
        }
        $trans_charge_master  = $this->master->findWhere(['type'=>'transaction.charge','status'=>'Show'])->pluck('amount','code')->toArray();
        

        $cartInfo = session()->get('cart');
        if ($cartInfo) {
            
            $product_data = array();
            $b2buy_total_charge = $amount = $item_amount = $transaction_charge = 0;
            $b2buy_total_charge = (($margin * $cart_total) / 100);
                
                if($payment_method == 'direct_debit'){
                    $payment_mode = "Direct Debit";
                }else if($payment_method == 'credit_card_saved'){
                    $payment_mode = "Card Payment";
                }else{
                    $payment_mode = "Card Payment";
                }
                $shipping_cost = ($order_list->shipping_charge) ? $order_list->shipping_charge : 0;
                $subtotal =  $cart_total + $shipping_cost;
                $tax_percentage = 10;
                $taxable_amount = $subtotal  * ($tax_percentage/100);
                $net_total  = $subtotal  + $taxable_amount;
                $amount   = $net_total - $b2buy_total_charge;

                if($account_id != null && $payment_method == 'direct_debit'){

                    $direct_debit  = $payment->direct_debit_authorities(array(
                        "account_id"=>$account_id,
                        "amount"=>$net_total
                    ));
    
                    if(!isset($direct_debit['direct_debit_authorities']['id'])){
                        return redirect('payment')->with('warning', 'error in direct debit authorities');
                    }
                }
                
                if( $payment_mode == "Card Payment" && @$trans_charge_master['CC'] != null && @$trans_charge_master['CC'] != 0){
                    $transaction_charge = $net_total  * ($trans_charge_master['CC']/100);
                }
               
                $order_list->update(array(
                    'transaction_charge'=>$transaction_charge,
                    'payment_mode' =>$payment_mode,
                    'account_id' =>$account_id,
                    'payment_status'=>'Processing'
                    )
                );

                $items =  $payment->create_item( array(
                        "id"              => $order_list->id,
                        "name"            => $order_list->order_code,
                        'amount'          => $net_total,
                        "payment_type"    => 2,
                        "buyer_id"        => $userId,
                        "seller_id"       => $order_list->seller_id,
                        "description"     => 'Description'
                ));
                // 
                    sleep(6);
                    $eror = "Something Went Worng";
                    if(!isset($items['items']['id'])){
                        if(@$items['errors'] && @key($items['errors']) && @$items['errors'][key($items['errors'])]){
                            $eror = implode(', ' ,$items['errors'][key($items['errors'])]);
                        }

                        if($eror == 'a legal entity missing'){
                            $eror == "Can't make payment, if Seller not ready to make payment";
                        }
                        if($eror == 'a user is missing'){
                            $eror == "Can't make payment, if Seller or Buyer not found in the payment system";
                        }
                       
                    }
                    $item_id_exist = true;
                    if(@$items['errors']['base'][0] =="item with this id already exists"){
                        $item_id_exist = false;
                    }
                    if( $item_id_exist == true){
                            if($payment_method != 'credit_card_delayed' && $payment_method != 'direct_debit_delayed'){

                                $make_paymet = $payment->make_paymet($userId,$items['items']['id'],$account_id);
                            
                                if(!isset($make_paymet['items']['id'])){
                                    if(@$make_paymet['errors'] && @key($make_paymet['errors']) && @$make_paymet['errors'][key($make_paymet['errors'])]){
                                        $eror = implode(', ' ,$make_paymet['errors'][key($make_paymet['errors'])]);
                                    }                    
                                    return redirect('payment')->with('warning', $eror);
                
                                }
                            }else{
                                Import::create([
                                    'order_id'=>$order_list->id,
                                    'type'=>'order.payment',
                                    'status'=>'Pending',
                                    'user_id'=>$order_list->user_id,
                                ]);
                            }
                        }
                   
                        // $items =  $payment->create_item( array(
                        //     "id"              => "B2B-".$order_list->id,
                        //     "name"            => $order_list->order_code ." b2buy charge",
                        //     'amount'          => ($b2buy_total_charge + $transaction_charge),
                        //     "payment_type"    => 2,
                        //     "buyer_id"        => $userId,
                        //     "seller_id"       => 1,
                        //     "description"     => 'Description'
                        // ));
                      
                        // sleep(6);
                        // $eror = "Something Went Worng";
                        // if(!isset($items['items']['id'])){

                        //     if(@$items['errors'] && @key($items['errors']) && @$items['errors'][key($items['errors'])]){
                        //         $eror = implode(', ' ,$items['errors'][key($items['errors'])]);
                        //     }                    
                        //     return redirect('payment')->with('warning', $eror);
    
                        // }

                        // if($payment_method != 'credit_card_delayed' && $payment_method != 'direct_debit_delayed'){

                        //     $make_paymet = $payment->make_paymet($userId,$items['items']['id'],$account_id);
                        //     if(!isset($make_paymet['items']['id'])){
                        //         if(@$make_paymet['errors'] && @key($make_paymet['errors']) && @$make_paymet['errors'][key($make_paymet['errors'])]){
                        //             $eror =implode(', ' ,$make_paymet['errors'][key($make_paymet['errors'])]);
                        //         }
                        //         return redirect('payment')->with('warning', $eror);
                        //     }
                        // }
                      
                
                    
                sleep(10);
                $payment->export_transaction();

                session()->forget('payment_section');
                session()->forget('cart');
                return redirect(guard_url('invoice/invoice'))->with('success', 'Your payment has been received and is getting processed!');

        }

       
    }

    

    public function proceed_checkout(Request $request)
    {

        // try{
            $userId = user_id();

            $coupaInfo = session()->get('coupa');
        
            if($coupaInfo != null){
                return redirect('punchout');
            }

                $master = $this->master->findWhere(['code' => 'SA', 'type' => 'supplier.agreement'])->first();
                $margin = ($master) ? $master->amount : 0;
                $cartInfo = session()->get('cart');
                $shipping_data = session()->get('shipping_data');
                $address = Address::where('user_id',$userId)->first();
                if (!$address) {
                    return redirect('checkout')->with('warning',  'please add address before make payment');
                }
                

                $number = 1000000000;
                if ($cartInfo) {
                    
                    $attributes['f_name'] = $address['f_name'];
                    $attributes['l_name'] = $address['l_name'];
                    $attributes['bill_address_to'] =$address['f_name'] .' '. $address['l_name'];
                    $attributes['zip_code'] = $address['postal_code'];
                    $attributes['country'] = $address['country'];
                    $attributes['state'] = $address['state'];
                    $attributes['sreet_address'] = $address['address1'] . ' ,' . $address['address2'];
                    $attributes['bill_zip_code'] = $address['billing_address_postalcode'];
                    $attributes['bill_state'] =  $address['billing_address_state'];
                    $attributes['bill_sreet_address'] = $address['billing_address_address1'];
                    $attributes['bill_country'] = $address['billing_address_country'];
                    $attributes['status'] = 'Pending';
                    $attributes['payment_status'] = 'Not Paid';
                    $attributes['user_id'] = $userId;
                    $attributes['apartment'] = '';
                    
                    $productInfo = $this->array_combine_custom($cartInfo);
                    $sellerInfo = array_unique(array_column($cartInfo, 'seller_id'));
                    $b2buy_total_charge = 0;
                    $errors = $order_ids =  $product_data =array();
                    foreach ($sellerInfo as $value) {
                        $attributes['seller_id'] = $value;
                    
                        $orders =  $this->order->create($attributes);
                        $unique_number = $number + $orders->id;
                        $order_ids[] = "B2B-". $orders->id;
                        $b2buy_charge = $item_amount = 0;
                        foreach ($productInfo[$value] as $product) {
                            // $customdata = Customprice::whereRaw('FIND_IN_SET(4287,product_id)')
                            // ->where('buyer_id',user_id())
                            // ->first();
                            // if($customdata&&@$customdata->custom_margin[$product->id]!=null)  
                            //     $custom_margin= @$customdata->custom_margin[$product->id];
                            // elseif($customdata&&@$customdata->custom_blanket_margin[$product->id]!=null)  
                            //     $custom_margin= @$customdata->custom_blanket_margin[$product->id];
                            $unit_price = $product['online_price']/$product['quantity'];
                            $item_amount += $unit_price;
                            OrderProduct::create( array(
                                'order_id' => $orders->id,
                                'product_id' => $product['product_id'],
                                'quantity' => $product['quantity'],
                                'seller_id' => $value,
                                'user_id' => $userId,
                                'unit_price' => $unit_price,
                                )
                            );
                        }
                        
                        $shipping_cost = 0;
                        
                        if(isset($shipping_data['master_data'][$value])){
                           $shipping_master = $shipping_data['master_data'][$value];
                           
                            if($shipping_master['minimum_order_amount'] > $shipping_master['purchase_cost']){

                                $shipping_cost =  $shipping_master['base_cost'] +  $shipping_master['sur_charge']; 
                                if($shipping_master['weight'] != 0 && $shipping_master['base_cost_per_kg']  < $shipping_master['weight']){
                                    $additional_weight = $shipping_master['weight'] -  $shipping_master['base_cost_per_kg'];
                                    $shipping_cost +=  $shipping_master['additional_cost'] * $additional_weight/$shipping_master['additional_cost_per_kg'];
                                }
                            }
                        }

                        $b2buy_charge = (($margin * $item_amount) / 100);
                        $amount     = $item_amount - $b2buy_charge;
                        $b2buy_total_charge += $b2buy_charge;
                        $subtotal = $item_amount + $shipping_cost;
                        $tax_percentage = 10;
                        $tax_amount = $subtotal * ($tax_percentage / 100);
                        $net_total = $subtotal + $tax_amount;
                        $purchase_limit=$this->repository->get_endprice();

                        if($subtotal>$purchase_limit && user()->parent_id !=0)
                        {
                            $manager_id=user()->manager_id;
                            $manager=DB::table('users')->where('id',$manager_id)->first();
                            $manager_email=$manager->email;
                           
                            $status="Approve";
                            $msg="Order  exceeded purchase limit.Waiting for approval..!";
                        }
                        else{
                            $manager_email="";
                            $status="Pending";
                            $msg="Your order has been placed successfully!";
                        }

                        $orders->update(array(
                            'order_code'=> "ORD-".$unique_number,
                            'invoice_number'=> "INV-".$unique_number,
                            'subtotal'=> $subtotal,
                            'total'=> $net_total,
                            'amount'=> $amount,
                            'status'=>$status,
                            'commision_amount'=>$b2buy_charge,
                            'admin_item_reference'=> $order_ids[0],
                            'shipping_charge' => $shipping_cost,
                            'delivery_type' => @$shipping_data['delivery_type'],
                            )
                        );
                        $order_email = $orders->seller->order_email!=null ? $orders->seller->order_email:  ($orders->seller->work_email !=null ? $orders->seller->work_email : $orders->seller->email);
                        if($manager_email=="")
                        {
                         Mail::to($order_email)->send(new OrderConfirm($orders));
 
                        }
                    }
                    session()->forget('shipping_data');
                    session()->forget('cart');

                    if($manager_email)
                    {
                        $orders['manager_name']=$manager->name;

                        Mail::to($manager_email)->send(new ApproveOrder($orders));
                        return redirect('listing')->with('approve', $msg);
                    }else{
                        return redirect('listing')->with('success', $msg);
                    }
                    
                   
                }
        // }catch (Exception $e)
        // {
        //     return redirect('checkout')->with('warning',  'server error');
        // }
       

    }
    public function set_payment_method(Request $request)
    {
       
        $payment_method = null;
        $shipping_cost = 0;
        if($request->payment_method){
            $payment_method = $request->payment_method;
        }
        if($request->ship_cost){
            $shipping_cost = $request->ship_cost;
        }

        $payment  = session()->get('payment_section');
        $payment['payment_method'] = $payment_method;
        $payment['shipping_cost'] = $shipping_cost;
        session()->put('payment_section', $payment);

    }
    

    public function array_combine_custom($cartInfo)
    {
        $new_keys = (range(0, count($cartInfo) - 1));
        $keys = array_column($cartInfo, 'seller_id');
        $values = array_combine($new_keys, $cartInfo);
        $result = array();
        foreach ($keys as $i => $k) {

            $result[$k][] = $values[$i];
        }
        return $result;
    }

    public function assembly_user_webhook(Request $request)
    {

        
        $data['subject'] ="User ";
        $data['data'] = $request->all();
        Mail::to('linto.tom@renfos.com')->send(new Welcome($data));

    }

    

    public function assembly_item_webhook(Request $request)
    {
       
        $payment = new Payment(); 
        if(@$request->items['state'] =="pending" && @$request->items['status'] =='22000' && $request->items['name'] !="b2buy charge"){
            $order_id = $request->items['id'];
            $get_order =  $this->order->findWhere(['id'=> $order_id])->first();
            if($get_order){
                   
                $attributes['payment_status'] = "Pending";
                $get_order->update($attributes);
            }
        }

        if(@$request->items['state'] =="completed" && @$request->items['status'] =='22500'){
            
        }

        if(@$request->items['state'] =="refund_pending" && @$request->items['status'] =='22610' && $request->items['name'] !="b2buy charge"){

            $order_id = $request->items['id'];
            $get_order =  $this->order->findWhere(['id'=> $order_id])->first();
                if($get_order){
                   
                    $attributes['refund_status'] = "Pending";
                    $get_order->update($attributes);
                
                }
        }
   

    }
    public function assembly_transaction_webhook(Request $request)
    {

        
        if(@$request->transactions['state'] =="successful" && @$request->transactions['type'] =='payment' && $request->transactions['item_name'] !="b2buy charge"){
        
                $order_id = $request->transactions['account_id'];
                $get_order =  $this->order->findWhere(['id'=> $order_id])->first();
                if($get_order){
                   
                    $attributes['payment_status'] = "Paid";
                    $get_order->update($attributes);
                
                }
        }
        if(@$request->transactions['state'] =="successful" && @$request->transactions['type'] =='return'){
            
            $transactions =  $request->transactions['related']['transactions'];
            foreach ($transactions as $value) {

                $order_id = $value['account_id'];
                $get_order =  $this->order->findWhere(['id'=> $order_id])->first();
                
                if($get_order){
                    $amount  = $request->transactions['amount']/100;
                    $attributes['refund_amount'] = $amount;
                    $attributes['amount'] = $get_order->amount - $amount;
                    $attributes['refund_status'] = "Refunded";
                    $get_order->update($attributes);
                
                }
            }
        }
    }
   
    public function assembly_batchtransaction_webhook(Request $request)
    {
        $payment = new Payment(); 

        // $data['subject'] ="Batch Transaction Webhook";
        // $data['data'] = $request->all();
        // Mail::to('jasonroy@b2buy.com')->send(new Welcome($data));
        
        if(@$request->batch_transactions['state'] =="successful" && @$request->batch_transactions['status'] =='12000'){

        }
        
    }

    public function assembly_make_payment_callback(Request $request)
    {

        
        $data['subject'] ="Make Payment";
        $data['data'] = $request->all();
        Mail::to('jasonroy@b2buy.com')->send(new Welcome($data));

    }
    
    public function assembly_item_callback(Request $request)
    {

        
        // $data['subject'] ="Item Webhook";
        // $data['data'] = $request->all();
        // Mail::to('jasonroy@b2buy.com')->send(new Welcome($data));
        
        // print_r($request->all());

    }
    public function assembly_transaction_callback(Request $request)
    {
        // $data['subject'] ="Transaction Webhook";
        // $data['data'] = $request->all();
        // Mail::to("jasonroy@b2buy.com")->send(new Welcome($data));

    }
    public function assembly_batchtransaction_callback(Request $request)
    {

    }
    public function assemblytest()
    {
        $payment = new Payment();

        $payment->test();

        // print_r($getList);die;

    }

    
    public function customSearch($search, $products, $builder)
    {
        $split_words = explode(" ", $search['custom']);
        $custom_results = [];
        $custom_searchs = $this->check_multiple($split_words);
        foreach ($split_words as $word) {
            $custom_search_category = $this->categorySearch($word, $products);
            $custom_search_brand = $this->brandSearch($word, $products);
            if ($custom_search_brand->count() > 0) {
                $builder = $builder->whereIn('brand_id', $custom_search_brand);
            }

            if ($custom_search_category->count() > 0) {
                $builder = $builder->whereIn('category_id', $custom_search_category);
            }

            if ($custom_searchs && $custom_searchs != null) {
                foreach ($custom_searchs as $k => $custom_search) {
                foreach ($products as $key => $product) {
                    if (array_key_exists($product->name, $custom_search->products) && $custom_search->products[$product->name] != "") {
                        $custom_results[$custom_search->products[$product->name]] = $product;
                    }
                }
                }
            }
            $products = $builder->paginate();

        }
        $custom_results[0] = call_user_func(function (array $custom_results) {ksort($custom_results);return $custom_results;}, $custom_results);
        $custom_results[1] = $builder;
        return $custom_results;
    }

    public function unpsc_filter_load()
    {
        return view('product::public.product.unspsc_filter');
    }
    public function get_unspsc($builder,$search)
    {
        $product_ids = $builder
            ->pluck('id');
        $unspscs = $this->product_unspsc->aside_unspsc($product_ids);
        return $unspscs;
    }
    public function get_brands($builder)
    {
        $brand_ids = $builder
            ->groupBy('brand_id', 'id')
            ->pluck('brand_id');
        $brands = $this->brand->get_brands($brand_ids);
        return $brands;
    }
    public function get_categories($builder)
    {
        $category_ids = $builder
            ->groupBy('category_id', 'id')
            ->pluck('category_id');
        $categories = $this->category->get_categories($category_ids);
        return $categories;
    }
    public function categorySearch($keyword, $products)
    {
        $category_ids = $this->category
            ->custom_categories($keyword);
        return $category_ids;
    }
    public function brandSearch($keyword, $products)
    {
        $brand_ids = $this->brand
            ->findByField('name', $keyword)
            ->pluck('id');
        return $brand_ids;
    }
    public function check_multiple($words)
    {
        $merge_results = [];
        $status = false;
        $keyword_values = [];
        $merged = [];
        foreach ($words as $word) {
            $results[$word] = $this->search->productListing($word);

            foreach ($results[$word] as $value) {
                $merged[] = $value;

            }
        }
        if ($merged != []) {

            foreach ($merged as $val) {

                $flag = 0;
                $no[$val->id] = count($val->search_tag);

                foreach ($words as $word) {

                    if (is_numeric(array_search(strtolower($word), array_map('strtolower', $val->search_tag)))) {
                        $flag = $flag + 1;
                    }
                }

                if ($flag == count($words) && $no[$val->id] == $flag) {

                    $status = true;
                    $keyword_values[$val->id] = $val;
                } elseif ($flag == count($words)) {

                    $status = true;
                    $keyword_values[$val->id] = $val;

                }

            }
        }
        return $keyword_values;
    }
   
    public function unspsc_dropdown(Request $request){
        $page = $request->page;
        $resultCount = 10;
        $offset = ($page - 1) * $resultCount;
        $result['result'] = [];
        $data = [];
        $search= $request->search;
        $unspscs = $this->product_unspsc->get_family_title($search);
        $data[0]['text']='All';
        $data[0]['id']='';
        foreach($unspscs as $key=>$val){
            $data[$key]['text']=$data[$key]['id']=$val;
        }
        $data = array_slice($data, $offset, $resultCount);
        foreach($data as $key=>$value){
            array_push($result['result'],$value);
        }
        $result['count_filtered'] = $unspscs->count();
        $result['page'] = $request->page;
        return $result;
    }
    public function product_dropdown(Request $request){
        $page = $request->page;
        $resultCount = 10;
        $offset = ($page - 1) * $resultCount;
        $result['result'] = [];
        $data = [];
        $search= $request->search;
        $products = $this->repository->findByField('seller_id',$request->supplier_id)->pluck('name','id');
        if($products->count()>0){
            $data[0]['text']='All';
            $data[0]['id']='';
        }
        foreach($products as $key=>$val){
            $data[$key]['text']=$val;
            $data[$key]['id'] = $key;
        }
        $data = array_slice($data, $offset, $resultCount);
        foreach($data as $key=>$value){
            array_push($result['result'],$value);
        }
        $result['count_filtered'] = $products->count();
        $result['page'] = $request->page;
        return $result;
    }
}
