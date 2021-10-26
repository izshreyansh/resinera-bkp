<?php

use Illuminate\Support\Facades\Route;

Route::get('orders', [
    'as' => 'admin.orders.index',
    'uses' => 'OrderController@index',
    'middleware' => 'can:admin.orders.index',
]);

Route::get('orders/{id?}', [
    'as' => 'admin.orders.show',
    'uses' => 'OrderController@show',
    'middleware' => 'can:admin.orders.show',
]);

Route::put('orders/{order}/status', [
    'as' => 'admin.orders.status.update',
    'uses' => 'OrderStatusController@update',
    'middleware' => 'can:admin.orders.edit',
]);

Route::post('orders/{order}/email', [
    'as' => 'admin.orders.email.store',
    'uses' => 'OrderEmailController@store',
    'middleware' => 'can:admin.orders.show',
]);

Route::get('orders/{order}/print', [
    'as' => 'admin.orders.print.show',
    'uses' => 'OrderPrintController@show',
    'middleware' => 'can:admin.orders.show',
]);

Route::get('generate-picklist', [
    'as' => 'admin.orders.picklist',
    'uses' => 'PickListController@index',
    'middleware' => 'can:admin.orders.index',
]);

Route::any('processing-orders', [
    'as' => 'admin.orders.processing',
    'uses' => 'OrderController@getProcessingOrders',
    'middleware' => 'can:admin.orders.index',
]);


Route::any('shipped-orders', [
    'as' => 'admin.orders.shipped',
    'uses' => 'OrderController@getShippedOrders',
    'middleware' => 'can:admin.orders.index',
]);


Route::post('mark-as-shipped', [
    'as' => 'admin.orders.mark.shipped',
    'uses' => 'OrderController@markOrderAsShipped',
    'middleware' => 'can:admin.orders.index',
]);

Route::get('mark-as-delivered', [
    'as' => 'admin.orders.mark.delivered',
    'uses' => 'OrderController@markOrderAsDelivered',
    'middleware' => 'can:admin.orders.index',
]);


Route::any('delivered-orders', [
    'as' => 'admin.orders.delivered',
    'uses' => 'OrderController@getDeliveredOrders',
    'middleware' => 'can:admin.orders.index',
]);


Route::get('get-delivery-slip/{id}', [
    'as' => 'admin.orders.delivery.slip',
    'uses' => 'OrderController@getDeliverySlip',
    'middleware' => 'can:admin.orders.index',
]);




