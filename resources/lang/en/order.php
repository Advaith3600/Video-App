<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Language files for order in order package
    |--------------------------------------------------------------------------
    |
    | The following language lines are  for  order module in order package
    | and it is used by the template/view files in this module
    |
     */

    /**
     * Singlular and plural name of the module
     */
    'name' => 'Order',
    'names' => 'Orders',

    /**
     * Singlular and plural name of the module
     */
    'title' => [
        'main' => 'Orders',
        'sub' => 'Orders',
        'list' => 'List of orders',
        'edit' => 'Edit order',
        'create' => 'Create new order',
    ],

    /**
     * Options for select/radio/check.
     */
    'options' => [
        'payment_mode' => ['Direct payment', 'Check payment', 'card payment'],
        'payment_status' => ['Payed' => 'Payed', 'Not Payed' => 'Not Payed'],
        'status' => ['Pending', 'Confirmed', 'Dispatched', 'Completed'],
        'payment_status1' => ['Paid' => 'Paid', 'Not Paid' => 'Not Paid','Pending'=>'Pending','Bank Processing'=>'Bank Processing','Batched'=>'Batched','Failed'=>'Failed'],

    ],

    /**
     * Placeholder for inputs
     */
    'placeholder' => [
        'id' => 'Please enter id',
        'f_name' => 'Please enter full name',
        'l_name' => '',
        'company_name' => '',
        'country_id' => 'Country',
        'state_id' => 'State',
        'sreet_address' => 'Street address',
        'apartment' => 'Apartment,suite,unit etc.(optional)',
        'zip_code' => 'Postcode/zip',
        'json_data' => 'Please enter json data',
        'subtotal' => 'Please enter subtotal',
        'total' => 'Please enter total',
        'payment_mode' => 'Please enter payment method',
        'payment_status' => 'Please select payment status',
        'status' => 'Please select status',
        'created_at' => 'Please select created at',
        'deleted_at' => 'Please select deleted at',
        'updated_at' => 'Please select updated at',
        'order_id' => 'order_id',
        'email' => 'Please enter email',
        'telephone' => 'Please enter telephone number',
        'pay_tracking_id' => 'Please enter payment tracking id',
        'bank_ref_no' => 'Please enter bank reference number',
        'card_name' => 'Please enter card name',
        'txn_amount' => 'Please enter transaction amount',
        'payment_currency' => 'Please enter payment currency',
        'shipping_code' => 'Please enter shipping code',
        'shipping_method' => 'Please enter shipping method',
        'shipping_address' => 'Please enter shipping address',
        'order_code'  => 'Please enter order code',
    ],

    /**
     * Labels for inputs.
     */
    'label' => [
        'id' => 'Id',
        'f_name' => 'First Name',
        'l_name' => 'Last Name',
        'name' => 'Name',
        'email' => 'Email',
        'user' => 'User',
        'company_name' => 'Company Name',
        'country_id' => 'Country',
        'state_id' => 'State/County',
        'sreet_address' => 'Sreet Address',
        'apartment' => 'Apartment',
        'zip_code' => 'Postcode/Zip',
        'json_data' => 'Json data',
        'subtotal' => 'Subtotal',
        'total' => 'Total',
        'payment_mode' => 'Payment mode',
        'payment_status' => 'Payment status',
        'status' => 'Delivery Status',
        'created_at' => 'Created at',
        'deleted_at' => 'Deleted at',
        'updated_at' => 'Updated at',
        'order_code' => 'Order No',
    ],

    /**
     * Columns array for show hide checkbox.
     */
    'cloumns' => [
        'f_name' => ['name' => 'F name', 'data-column' => 1, 'checked'],
        'l_name' => ['name' => 'L name', 'data-column' => 2, 'checked'],
        'total' => ['name' => 'Total', 'data-column' => 3, 'checked'],
        'payment_mode' => ['name' => 'Payment mode', 'data-column' => 4, 'checked'],
        'payment_status' => ['name' => 'Payment status', 'data-column' => 5, 'checked'],
    ],

    /**
     * Tab labels
     */
    'tab' => [
        'name' => 'Orders',
    ],

    /**
     * Texts  for the module
     */
    'text' => [
        'preview' => 'Click on the below list for preview',
    ],
];