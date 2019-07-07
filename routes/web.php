<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('drop', function() {
//     Schema::dropIfExists('category');
// });
Route::get('auth/facebook', 'FacebookAuthController@redirectToProvider')->name('facebook.login') ;
Route::get('auth/facebook/callback', 'FacebookAuthController@handleProviderCallback');
Route::group(['middleware' => 'locale'], function() {
    Route::get('swich-lang/{id}', 'IndexController@getSwichLang');
    Route::get('/', 'IndexController@getHome');
    Route::get('/gioi-thieu', 'IndexController@getAbout');
    Route::get('/why-organic', 'IndexController@getWhyOrganic');
    Route::get('/album', 'IndexController@getAlbum');
    Route::get('/tin-tuc', 'IndexController@getCatPost');
    Route::get('/san-pham', 'IndexController@getProduct');
    Route::get('/san-pham/{slug}-{id}', 'IndexController@getDetalProduct');
    Route::get('/danh-muc/{slug}-{id}', 'IndexController@getProductByCat');
    Route::get('/tin-tuc/{slug}-{id}', 'IndexController@getSinglePost');
    Route::get('lien-he', 'IndexController@getContact');
    Route::get('/gio-hang', 'IndexController@getCart');
    Route::get('/cart/{id}', 'IndexController@deleteCart');
    Route::get('upDateCart', 'IndexController@getUpDateCart');
    Route::get('thanh-toan', 'IndexController@getCheckOut');
    Route::get('tang-qua', 'IndexController@getCheckOutGift');
    Route::post('tang-qua', 'IndexController@postCheckOutGift');
    Route::post('thanh-toan', 'IndexController@postSaveOrder');
    Route::get('addMutiProduct/{id}', 'IndexController@addMutiCart');
    Route::get('addGift/{id}', 'IndexController@getAddGift');
    Route::get('province', 'IndexController@getProvince');
    Route::get('dang-ky', 'IndexController@getRegister');
    Route::get('account', 'IndexController@getAccount');
    Route::post('account', 'IndexController@postEditUser');
    Route::post('dang-ky', 'IndexController@postRegister');
    Route::get('dang-nhap', 'IndexController@getLogin');
    Route::get('dang-xuat', 'IndexController@getLogout');
    Route::get('add-wishlist/{id}', 'IndexController@addWishlist');
    Route::get('remove-wishlist/{id}', 'IndexController@getRemoveWishlist');
    Route::post('dang-nhap', 'IndexController@postLogin');
    Route::post('/gio-hang/{id}', 'IndexController@postCart');
    Route::get('tim-kiem', 'IndexController@getSearch');
    Route::get('sale', 'IndexController@getProductSale');
    Route::get('sale/{id}.html', 'IndexController@getProductSaleByValue');
    Route::post('news-letter', 'IndexController@postAddNewsLetter');
    Route::post('lien-he', 'IndexController@postContact');
    Route::get('vi-tri', 'IndexController@getPosition');
    Route::get('quen-mat-khau', 'IndexController@getResetPassword');
    Route::post('quen-mat-khau', 'IndexController@postResetPassword');
    Route::get('reset-password/{token}', 'IndexController@getChangePassword');
    Route::post('reset-password/{token}', 'IndexController@postChangePassword');
});

Route::group([ 'namespace' => "Admin"], function() {
    Route::group(['prefix' => 'login', 'middleware' => 'CheckLogedIn'], function() {
    	Route::get('/', 'LoginController@getLogin');
    	Route::post('/', 'LoginController@postLogin');
	});
	Route::get('logout', 'IndexController@getLogout');
	Route::group(['prefix' => 'backend', 'middleware' => 'CheckLogedOut'], function() {
        Route::group(['middleware' => 'CheckAdmin'], function() {
        	Route::get('/', 'IndexController@getHome');
        	Route::group(['prefix' => 'user'], function() {
    	        Route::get('/', 'UserController@getListUser');
				Route::get('list-user', 'UserController@getListUserMember');
    	        Route::get('/add', 'UserController@getAddUser');
    	        Route::post('/add', 'UserController@postAddUser');
    	       	Route::get('/edit', 'UserController@getEditUser');
    	       	Route::post('/edit', 'UserController@postEditUser');
    	       	Route::get('/delete', 'UserController@getDeleteUser');
        	});
            Route::group(['prefix' => 'about'], function () {
                Route::get('', ['as' => 'backend.about', 'uses' => 'AboutController@getList']);
                Route::post('', ['as' => 'backend.about.postAbout', 'uses' => 'AboutController@postAbout']);
                Route::group(['prefix' => 'agency'], function() {
                    Route::get('', ['as' => 'backend.about.agency.getListAgency', 'uses' => 'AboutController@getListAgency']);
                    Route::get('/add', ['as' => 'backend.about.agency.add', 'uses' => 'AboutController@getAddAgency']);
                    Route::post('/add', ['as' => 'backend.about.agency.postadd', 'uses' => 'AboutController@postAddAgency']);
                    Route::get('/edit/{id}', ['as' => 'backend.about.agency.edit', 'uses' => 'AboutController@getEditAgency']);
                    Route::post('/edit/{id}', ['as' => 'backend.about.agency.postedit', 'uses' => 'AboutController@postEditAgency']);
                    Route::get('/delete/{id}', ['as' => 'backend.about.agency.delele', 'uses' => 'AboutController@getDeleteAgency']);
                     Route::post('/delete-muti', ['as' => 'backend.about.agency.postDeleteMuti', 'uses' => 'AboutController@postDeleteMuti']);
                });
            });
            Route::group(['prefix' => 'product'], function() {
                Route::get('', ['as' => 'backend.product', 'uses' => 'ProductController@getList']);
                Route::get('add', ['as' => 'backend.product.getAdd', 'uses' => 'ProductController@getAdd']);
                Route::post('add', ['as' => 'backend.product.postAdd', 'uses' => 'ProductController@postAdd']);
                Route::get('edit/{id}', ['as' => 'backend.product.getEdit', 'uses' => 'ProductController@getEdit']);
                Route::post('edit/{id}', ['as' => 'backend.product.postEdit', 'uses' => 'ProductController@postEdit']);
                Route::get('delete/{id}', ['as' => 'backend.product.getDelete', 'uses' => 'ProductController@getDelete']);
                Route::post('postMultiDel', ['as' => 'backend.product.postMultiDel', 'uses' => 'ProductController@getDeleteMuti']);
                Route::get('export', ['as' => 'backend.product.export', 'uses' => 'ProductController@getExport']);
                Route::group(['prefix' => 'category'], function () {
                    Route::get('', ['as' => 'backend.product.category', 'uses' => 'CategoryController@getList']);
                    Route::get('add', ['as' => 'backend.product.category.getAdd', 'uses' => 'CategoryController@getAdd']);
                    Route::post('add', ['as' => 'backend.product.category.postAdd', 'uses' => 'CategoryController@postAdd']);
                    Route::get('edit/{id}', ['as' => 'backend.product.category.getEdit', 'uses' => 'CategoryController@getEdit']);
                    Route::post('edit/{id}', ['as' => 'backend.product.category.postEdit', 'uses' => 'CategoryController@postEdit']);
                    Route::get('delete/{id}', ['as' => 'backend.product.category.getDelete', 'uses' => 'CategoryController@getDelete']);
                    Route::post('postMultiDel', ['as' => 'backend.product.category.postMultiDel', 'uses' => 'CategoryController@postMultiDel']);      
                });
            });
            
        	Route::group(['prefix' => 'config'], function() {
        	    Route::get('general', 'ConfigController@getGeneral');
        	    Route::post('general', 'ConfigController@postGeneral');
                Route::get('social','ConfigController@getSocial');
                Route::post('social','ConfigController@postSocial');
                Route::get('other',  'ConfigController@getOther');
                Route::post('other','ConfigController@postOther');
                Route::group(['prefix' => 'service'], function() {
                    Route::get('/', 'SeviceController@getList');
                    Route::get('add', 'SeviceController@getAdd');
                    Route::post('add', 'SeviceController@postAdd');
                });
                Route::group(['prefix' => 'policy'], function () {
                    Route::get('', ['as' => 'backend.config.policy', 'uses' => 'PolicyController@getPolicy']);
                    Route::post('', ['as' => 'backend.config.postPolicy', 'uses' => 'PolicyController@postPolicy']);
                    
                    // Route::get('add', ['as' => 'backend.config.policy.getAdd', 'uses' => 'PolicyController@getAdd']);
                    // Route::post('add', ['as' => 'backend.config.policy.postAdd', 'uses' => 'PolicyController@postAdd']);
                    // Route::get('edit/{id}', ['as' => 'backend.config.policy.getEdit', 'uses' => 'PolicyController@getEdit']);
                    // Route::post('edit/{id}', ['as' => 'backend.config.policy.postEdit', 'uses' => 'PolicyController@postEdit']);
                    // Route::get('delete/{id}', ['as' => 'backend.config.policy.getDelete', 'uses' => 'PolicyController@getDelete']);
                    // Route::post('postMultiDel', ['as' => 'backend.config.policy.postMultiDel', 'uses' => 'PolicyController@postMultiDel']);
                });
                Route::group(['prefix' => 'customer'], function () {
                    Route::get('', ['as' => 'backend.config.customer', 'uses' => 'CustomerController@getList']);
                    Route::get('add', ['as' => 'backend.config.customer.getAdd', 'uses' => 'CustomerController@getAdd']);
                    Route::post('add', ['as' => 'backend.config.customer.postAdd', 'uses' => 'CustomerController@postAdd']);
                    Route::get('edit/{id}', ['as' => 'backend.config.customer.getEdit', 'uses' => 'CustomerController@getEdit']);
                    Route::post('edit/{id}', ['as' => 'backend.config.customer.postEdit', 'uses' => 'CustomerController@postEdit']);
                    Route::get('delete/{id}', ['as' => 'backend.config.customer.getDelete', 'uses' => 'CustomerController@getDelete']);
                    Route::post('postMultiDel', ['as' => 'backend.config.customer.postMultiDel', 'uses' => 'CustomerController@postMultiDel']);
                });
                Route::group(['prefix' => 'slider'], function() {
                    Route::get('/', 'SilderController@getListSlider');
                    Route::get('/add', 'SilderController@getAdd');
                    Route::post('/add', 'SilderController@postAdd');
                    Route::get('/edit/{id}', 'SilderController@getEdit');
                    Route::post('/edit/{id}', 'SilderController@postEdit');
                    Route::get('/delete/{id}', 'SilderController@getDelete');
                    Route::post('/deleteMuti', 'SilderController@getDeleteMuti');
                });
                Route::group(['prefix' => 'settinghome'], function() {
                    Route::get('/', 'ConfigController@getSettingHome');
                    Route::post('/', 'ConfigController@postSettingHome');
                });
                Route::group(['prefix' => 'reviews'], function() {
                    Route::get('', ['as' => 'backend.config.reviews', 'uses' => 'ReviewsController@getList']);
                    Route::get('add', ['as' => 'backend.config.reviews.getAdd', 'uses' => 'ReviewsController@getAdd']);
                    Route::post('add', ['as' => 'backend.config.reviews.postAdd', 'uses' => 'ReviewsController@postAdd']);
                    Route::get('edit/{id}', ['as' => 'backend.config.reviews.getEdit', 'uses' => 'ReviewsController@getEdit']);
                    Route::post('edit/{id}', ['as' => 'backend.config.reviews.postEdit', 'uses' => 'ReviewsController@postEdit']);
                    Route::get('delete/{id}', ['as' => 'backend.config.reviews.getDelete', 'uses' => 'ReviewsController@getDelete']);
                    Route::post('muti-delete', ['as' => 'backend.config.reviews.postDeleteMuti', 'uses' => 'ReviewsController@getDeleteMuti']);
                });
                Route::group(['prefix' => 'menu'], function() {
                    Route::get('/', ['as' => 'backend.config.menu.getMenuGroup', 'uses' => 'MenuController@getMenuGroup']);
                });
        	});
            
            Route::group(['prefix' => 'contact'], function () {
                Route::get('', ['as' => 'backend.contact', 'uses' => 'ContactController@getList']);
                Route::get('add', ['as' => 'backend.contact.getAdd', 'uses' => 'ContactController@getAdd']);
                Route::post('add', ['as' => 'backend.contact.postAdd', 'uses' => 'ContactController@postAdd']);
                Route::get('edit/{id}', ['as' => 'backend.contact.getEdit', 'uses' => 'ContactController@getEdit']);
                Route::post('edit/{id}', ['as' => 'backend.contact.postEdit', 'uses' => 'ContactController@postEdit']);
                Route::get('delete/{id}', ['as' => 'backend.contact.getDelete', 'uses' => 'ContactController@getDelete']);
                Route::post('postMultiDel', ['as' => 'backend.contact.postMultiDel', 'uses' => 'ContactController@postMultiDel']);
                Route::get('export', ['as' => 'backend.contact.export', 'uses' => 'ContactController@getExport']);
            });

            
            Route::group(['prefix' => 'blog'], function () {
                Route::group(['prefix' => 'cat'], function() {
                    Route::get('', ['as' => 'backend.blog.cat', 'uses' => 'CategoryBolgController@getList']);
                    Route::get('add', ['as' => 'backend.blog.cat.getAdd', 'uses' => 'CategoryBolgController@getAdd']);
                    Route::post('add', ['as' => 'backend.blog.cat.postAdd', 'uses' => 'CategoryBolgController@postAdd']);
                    Route::get('edit/{id}', ['as' => 'backend.blog.cat.getEdit', 'uses' => 'CategoryBolgController@getEdit']);
                    Route::post('edit/{id}', ['as' => 'backend.blog.cat.postEdit', 'uses' => 'CategoryBolgController@postEdit']);
                    Route::get('delete/{id}', ['as' => 'backend.blog.cat.getDelete', 'uses' => 'CategoryBolgController@getDelete']);
                    Route::post('postMultiDel', ['as' => 'backend.blog.cat.postMultiDel', 'uses' => 'BlogController@postMultiDel']);
                });
                Route::get('', ['as' => 'backend.blog', 'uses' => 'BlogController@getList']);
                Route::get('add', ['as' => 'backend.blog.getAdd', 'uses' => 'BlogController@getAdd']);
                Route::post('add', ['as' => 'backend.blog.postAdd', 'uses' => 'BlogController@postAdd']);
                Route::get('edit/{id}', ['as' => 'backend.blog.getEdit', 'uses' => 'BlogController@getEdit']);
                Route::post('edit/{id}', ['as' => 'backend.blog.postEdit', 'uses' => 'BlogController@postEdit']);
                Route::get('delete/{id}', ['as' => 'backend.blog.getDelete', 'uses' => 'BlogController@getDelete']);
                Route::post('postMultiDel', ['as' => 'backend.blog.postMultiDel', 'uses' => 'BlogController@postMultiDel']);
            });
            Route::group(['prefix' => 'homesetting'], function () {
                Route::get('', ['as' => 'backend.homesetting', 'uses' => 'SettingHomeController@getList']);
                Route::get('add', ['as' => 'backend.homesetting.getAdd', 'uses' => 'SettingHomeController@getAdd']);
                Route::post('add', ['as' => 'backend.homesetting.postAdd', 'uses' => 'SettingHomeController@postAdd']);
                Route::get('edit/{id}', ['as' => 'backend.homesetting.getEdit', 'uses' => 'SettingHomeController@getEdit']);
                Route::post('edit/{id}', ['as' => 'backend.homesetting.postEdit', 'uses' => 'SettingHomeController@postEdit']);
                Route::get('delete/{id}', ['as' => 'backend.homesetting.getDelete', 'uses' => 'SettingHomeController@getDelete']);
                Route::post('postMultiDel', ['as' => 'backend.homesetting.postMultiDel', 'uses' => 'SettingHomeController@postMultiDel']);
            });
            Route::group(['prefix' => 'deals'], function() {
                Route::get('', ['as' => 'backend.deal.list', 'uses' => 'DealController@getList']);
                Route::get('add', ['as' => 'backend.deal.add', 'uses' => 'DealController@getAdd']);
                Route::post('add', ['as' => 'backend.deal.postAdd', 'uses' => 'DealController@postAdd']);
                Route::get('edit/{id}', ['as' => 'backend.deal.edit', 'uses' => 'DealController@getEdit']);
                Route::post('edit/{id}', ['as' => 'backend.deal.postEdit', 'uses' => 'DealController@postEdit']);
                Route::get('delete/{id}', ['as' => 'backend.deal.delete', 'uses' => 'DealController@getDelete']);
                Route::post('muti-delete', ['as' => 'backend.deal.mutidelete', 'uses' => 'DealController@postMutiDelete']);
            });
        });
    });
});