<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;

Route::get('/visits/calendar', [VisitController::class, 'calendarPage'])->name('visits.calendar');

Route::prefix('maintenance-dashboard')->name('maintenance_dashboard.')->group(function(){
    Route::group(['namespace' => 'Maintenance_Dashboard'], function () {
        //-----------------------Start Home Routes--------------------------
        Route::prefix('home')->name('home.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'HomeController@index'
            ));
        });

        //------------------------Start customer_requests Routes----------------------
        Route::prefix('customer_requests')->name('customer_request.')->group(function () {
            Route::get('/{status?}', array(
                'as' => 'index',
                'uses' => 'CustomerRequestController@index'
            ))->middleware('dashboardCustomerRequestIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'CustomerRequestController@archived'
            ))->middleware('dashboardCustomerRequestArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'CustomerRequestController@create'
            ))->middleware('dashboardCustomerRequestCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'CustomerRequestController@store'
            ))->middleware('dashboardCustomerRequestCreate');

            Route::get('/show/{customer_request}', array(
                        'as' => 'show',
                        'uses' => 'CustomerRequestController@show'
            ))->middleware('dashboardCustomerRequestShow');

            Route::get('/preview/{customer_request}', array(
                        'as' => 'preview',
                        'uses' => 'CustomerRequestController@preview'
            ))->middleware('dashboardCustomerRequestPreview');

            Route::get('/edit/{customer_request}', array(
                        'as' => 'edit',
                        'uses' => 'CustomerRequestController@edit'
            ))->middleware('dashboardCustomerRequestEdit');

            Route::put('/edit/{customer_request}', array(
                        'as' => 'update',
                        'uses' => 'CustomerRequestController@update'
            ))->middleware('dashboardCustomerRequestEdit');

            Route::get('/delete/{customer_request}', array(
                'as' => 'delete',
                'uses' => 'CustomerRequestController@destroy'
            ))->middleware('dashboardCustomerRequestDelete');

            Route::get('/restore/{customer_request}', array(
                'as' => 'restore',
                'uses' => 'CustomerRequestController@restore'
            ))->middleware('dashboardCustomerRequestRestore');

            Route::get('/delete-permanently/{customer_request}', array(
                'as' => 'delete_permanently',
                'uses' => 'CustomerRequestController@destroyPermanently'
            ))->middleware('dashboardCustomerRequestDeletePermanently');
        });

        //------------------------Start customer_request_places Routes----------------------
        Route::prefix('customer_request_places')->name('customer_request_place.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'CustomerRequestPlaceController@index'
            ))->middleware('dashboardCustomerRequestPlaceIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'CustomerRequestPlaceController@archived'
            ))->middleware('dashboardCustomerRequestPlaceArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'CustomerRequestPlaceController@create'
            ))->middleware('dashboardCustomerRequestPlaceCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'CustomerRequestPlaceController@store'
            ))->middleware('dashboardCustomerRequestPlaceCreate');

            Route::get('/show/{customer_request_place}', array(
                        'as' => 'show',
                        'uses' => 'CustomerRequestPlaceController@show'
            ))->middleware('dashboardCustomerRequestPlaceShow');

            Route::get('/edit/{customer_request_place}', array(
                        'as' => 'edit',
                        'uses' => 'CustomerRequestPlaceController@edit'
            ))->middleware('dashboardCustomerRequestPlaceEdit');

            Route::put('/edit/{customer_request_place}', array(
                        'as' => 'update',
                        'uses' => 'CustomerRequestPlaceController@update'
            ))->middleware('dashboardCustomerRequestPlaceEdit');

            Route::get('/delete/{customer_request_place}', array(
                'as' => 'delete',
                'uses' => 'CustomerRequestPlaceController@destroy'
            ))->middleware('dashboardCustomerRequestPlaceDelete');

            Route::get('/restore/{customer_request_place}', array(
                'as' => 'restore',
                'uses' => 'CustomerRequestPlaceController@restore'
            ))->middleware('dashboardCustomerRequestPlaceRestore');

            Route::get('/delete-permanently/{customer_request_place}', array(
                'as' => 'delete_permanently',
                'uses' => 'CustomerRequestPlaceController@destroyPermanently'
            ))->middleware('dashboardCustomerRequestPlaceDeletePermanently');

            //------------------------All Ajax Requests------------------
            Route::post('/place-approval/ajax', array(
                'as' => 'place_approval.ajax',
                'uses' => 'CustomerRequestPlaceController@ajaxPlaceApproval'
            ));
            Route::post('/place-reject/ajax', array(
                'as' => 'place_reject.ajax',
                'uses' => 'CustomerRequestPlaceController@ajaxPlaceReject'
            ));
        });

        //------------------------Start operations Routes----------------------
        Route::prefix('operations')->name('request_operations.')->group(function(){
            Route::group(['namespace' => 'Operations'], function () {
                //------------------------Start request_places Routes----------------------
                Route::name('operation.')->group(function () {
                    Route::get('/', array(
                        'as' => 'index',
                        'uses' => 'OperationController@index'
                    ))->middleware('dashboardOperationIndex');

                    Route::get('/archived', array(
                        'as' => 'archived',
                        'uses' => 'OperationController@archived'
                    ))->middleware('dashboardOperationArchived');

                    Route::get('/create', array(
                        'as' => 'create',
                        'uses' => 'OperationController@create'
                    ))->middleware('dashboardOperationCreate');

                    Route::post('/store', array(
                                'as' => 'store',
                                'uses' => 'OperationController@store'
                    ))->middleware('dashboardOperationCreate');

                    Route::get('/show/{operation}', array(
                                'as' => 'show',
                                'uses' => 'OperationController@show'
                    ))->middleware('dashboardOperationShow');

                    Route::get('/edit/{operation}', array(
                                'as' => 'edit',
                                'uses' => 'OperationController@edit'
                    ))->middleware('dashboardOperationEdit');

                    Route::put('/edit/{operation}', array(
                                'as' => 'update',
                                'uses' => 'OperationController@update'
                    ))->middleware('dashboardOperationEdit');

                    Route::get('/delete/{operation}', array(
                        'as' => 'delete',
                        'uses' => 'OperationController@destroy'
                    ))->middleware('dashboardOperationDelete');

                    Route::get('/restore/{operation}', array(
                        'as' => 'restore',
                        'uses' => 'OperationController@restore'
                    ))->middleware('dashboardOperationRestore');

                    Route::get('/delete-permanently/{operation}', array(
                        'as' => 'delete_permanently',
                        'uses' => 'OperationController@destroyPermanently'
                    ))->middleware('dashboardOperationDeletePermanently');

                    Route::get('/show-tasks/{operation}', array(
                        'as' => 'show_tasks',
                        'uses' => 'OperationController@showTasks'
                    ))->middleware('dashboardOperationShowTasks');

                    Route::get('/procedures/{operation}', array(
                        'as' => 'procedures',
                        'uses' => 'OperationController@proceduresOperation'
                    ))->middleware('dashboardOperationProcedures');

                    //------------------------All Ajax Requests------------------
                    Route::post('/new_price_offer/ajax', array(
                        'as' => 'new_price_offer.ajax',
                        'uses' => 'OperationController@ajaxNewPriceOffer'
                    ));

                    Route::post('/select_logistic_specializations/ajax', array(
                        'as' => 'select_logistic_specializations.ajax',
                        'uses' => 'OperationController@ajaxSelectLogisticSpecializations'
                    ));

                    Route::post('/assign_employee_place/ajax', array(
                        'as' => 'assign_employee_place.ajax',
                        'uses' => 'OperationController@ajaxAssignEmployeePlace'
                    ));

                    Route::post('/new_visit/ajax', array(
                        'as' => 'new_visit.ajax',
                        'uses' => 'OperationController@ajaxNewVisit'
                    ));

                    Route::post('/new_employee/ajax', array(
                        'as' => 'new_employee.ajax',
                        'uses' => 'OperationController@ajaxNewEmployee'
                    ));
                });
                //------------------------Start tasks_operations Routes----------------------
                Route::prefix('tasks-operations')->name('task_operation.')->group(function () {
                    Route::get('/{employee?}', array(
                        'as' => 'index',
                        'uses' => 'TaskOperationController@index'
                    ))->middleware('dashboardMaintMap_custReq___Task_EmployeeIndex');

                    Route::get('/archived', array(
                        'as' => 'archived',
                        'uses' => 'TaskOperationController@archived'
                    ))->middleware('dashboardMaintMap_custReq___Task_EmployeeArchived');

                    Route::get('/create', array(
                        'as' => 'create',
                        'uses' => 'TaskOperationController@create'
                    ))->middleware('dashboardMaintMap_custReq___Task_EmployeeCreate');

                    Route::post('/store', array(
                                'as' => 'store',
                                'uses' => 'TaskOperationController@store'
                    ))->middleware('dashboardMaintMap_custReq___Task_EmployeeCreate');

                    Route::get('/show/{task_operation}', array(
                                'as' => 'show',
                                'uses' => 'TaskOperationController@show'
                    ))->middleware('dashboardMaintMap_custReq___Task_EmployeeShow');

                    Route::get('/edit/{task_operation}', array(
                                'as' => 'edit',
                                'uses' => 'TaskOperationController@edit'
                    ))->middleware('dashboardMaintMap_custReq___Task_EmployeeEdit');

                    Route::put('/edit/{task_operation}', array(
                                'as' => 'update',
                                'uses' => 'TaskOperationController@update'
                    ))->middleware('dashboardMaintMap_custReq___Task_EmployeeEdit');

                    Route::get('/delete/{task_operation}', array(
                        'as' => 'delete',
                        'uses' => 'TaskOperationController@destroy'
                    ))->middleware('dashboardMaintMap_custReq___Task_EmployeeDelete');

                    Route::get('/restore/{task_operation}', array(
                        'as' => 'restore',
                        'uses' => 'TaskOperationController@restore'
                    ))->middleware('dashboardMaintMap_custReq___Task_EmployeeRestore');

                    Route::get('/delete-permanently/{task_operation}', array(
                        'as' => 'delete_permanently',
                        'uses' => 'TaskOperationController@destroyPermanently'
                    ))->middleware('dashboardMaintMap_custReq___Task_EmployeeDeletePermanently');

                    // Route::get('/complete-task/{task_operation}', array(
                    //     'as' => 'complete_task',
                    //     'uses' => 'TaskOperationController@getCompleteTask'
                    // ))->middleware('dashboardMaintMap_custReq___Task_EmployeeCompleteTask');

                    // Route::put('/complete-task/{task_operation}', array(
                    //     'as' => 'post_complete_task',
                    //     'uses' => 'TaskOperationController@postCompleteTask'
                    // ))->middleware('dashboardMaintMap_custReq___Task_EmployeeCompleteTask');

                    // Route::post('/assign-executor-task', array(
                    //     'as' => 'assign_executor_task',
                    //     'uses' => 'TaskOperationController@assignExecutorTask'
                    // ))->middleware('dashboardMaintMap_custReq___Task_EmployeeAssignExecutorTask');

                    // Route::get('/add-notes-to-completed-task/{task_operation}', array(
                    //     'as' => 'add_notes_to_completed_task',
                    //     'uses' => 'TaskOperationController@getAddNotesToCompleteTask'
                    // ))->middleware('dashboardMaintMap_custReq___Task_EmployeeAddNotesToCompleteTask');

                    // Route::put('/add-notes-to-completed-task/{task_operation}', array(
                    //     'as' => 'post_add_notes_to_complete_task',
                    //     'uses' => 'TaskOperationController@postAddNotesToCompletedTask'
                    // ))->middleware('dashboardMaintMap_custReq___Task_EmployeeAddNotesToCompleteTask');
                });

                Route::group(['namespace' => 'MaintMap_CustReq'], function () {
                    //------------------------Start maintMap_custReq___price_offers Routes----------------------
                    Route::prefix('maintMap_custReq___price_offers')->name('maintMap_custReq___price_offer.')->group(function () {
                        Route::get('/', array(
                            'as' => 'index',
                            'uses' => 'PriceOfferController@index'
                        ))->middleware('dashboardMaintMap_custReq___PriceOfferIndex');

                        Route::get('/archived', array(
                            'as' => 'archived',
                            'uses' => 'PriceOfferController@archived'
                        ))->middleware('dashboardMaintMap_custReq___PriceOfferArchived');

                        Route::get('/create', array(
                            'as' => 'create',
                            'uses' => 'PriceOfferController@create'
                        ))->middleware('dashboardMaintMap_custReq___PriceOfferCreate');

                        Route::post('/store', array(
                                    'as' => 'store',
                                    'uses' => 'PriceOfferController@store'
                        ))->middleware('dashboardMaintMap_custReq___PriceOfferCreate');

                        Route::get('/show/{maintMap_custReq___price_offer}', array(
                                    'as' => 'show',
                                    'uses' => 'PriceOfferController@show'
                        ))->middleware('dashboardMaintMap_custReq___PriceOfferShow');

                        Route::get('/edit/{maintMap_custReq___price_offer}', array(
                                    'as' => 'edit',
                                    'uses' => 'PriceOfferController@edit'
                        ))->middleware('dashboardMaintMap_custReq___PriceOfferEdit');

                        Route::put('/edit/{maintMap_custReq___price_offer}', array(
                                    'as' => 'update',
                                    'uses' => 'PriceOfferController@update'
                        ))->middleware('dashboardMaintMap_custReq___PriceOfferEdit');

                        Route::get('/delete/{maintMap_custReq___price_offer}', array(
                            'as' => 'delete',
                            'uses' => 'PriceOfferController@destroy'
                        ))->middleware('dashboardMaintMap_custReq___PriceOfferDelete');

                        Route::get('/restore/{maintMap_custReq___price_offer}', array(
                            'as' => 'restore',
                            'uses' => 'PriceOfferController@restore'
                        ))->middleware('dashboardMaintMap_custReq___PriceOfferRestore');

                        Route::get('/delete-permanently/{maintMap_custReq___price_offer}', array(
                            'as' => 'delete_permanently',
                            'uses' => 'PriceOfferController@destroyPermanently'
                        ))->middleware('dashboardMaintMap_custReq___PriceOfferDeletePermanently');
                    });
                    //------------------------Start maintMap_custReq___visits Routes----------------------
                    Route::prefix('maintMap_custReq___visits')->name('maintMap_custReq___visit.')->group(function () {
                        Route::get('/', array(
                            'as' => 'index',
                            'uses' => 'VisitController@index'
                        ))->middleware('dashboardMaintMap_custReq___VisitIndex');

                        Route::get('/archived', array(
                            'as' => 'archived',
                            'uses' => 'VisitController@archived'
                        ))->middleware('dashboardMaintMap_custReq___VisitArchived');

                        Route::get('/create', array(
                            'as' => 'create',
                            'uses' => 'VisitController@create'
                        ))->middleware('dashboardMaintMap_custReq___VisitCreate');

                        Route::post('/store', array(
                                    'as' => 'store',
                                    'uses' => 'VisitController@store'
                        ))->middleware('dashboardMaintMap_custReq___VisitCreate');

                        Route::get('/show/{maintMap_custReq___visit}', array(
                                    'as' => 'show',
                                    'uses' => 'VisitController@show'
                        ))->middleware('dashboardMaintMap_custReq___VisitShow');

                        Route::get('/timetable', array(
                                    'as' => 'timetable',
                                    'uses' => 'VisitController@timetable'
                        ))->middleware('dashboardMaintMap_custReq___VisitTimetable');


                        Route::get('/edit/{maintMap_custReq___visit}', array(
                                    'as' => 'edit',
                                    'uses' => 'VisitController@edit'
                        ))->middleware('dashboardMaintMap_custReq___VisitEdit');

                        Route::put('/edit/{maintMap_custReq___visit}', array(
                                    'as' => 'update',
                                    'uses' => 'VisitController@update'
                        ))->middleware('dashboardMaintMap_custReq___VisitEdit');

                        Route::get('/delete/{maintMap_custReq___visit}', array(
                            'as' => 'delete',
                            'uses' => 'VisitController@destroy'
                        ))->middleware('dashboardMaintMap_custReq___VisitDelete');

                        Route::get('/restore/{maintMap_custReq___visit}', array(
                            'as' => 'restore',
                            'uses' => 'VisitController@restore'
                        ))->middleware('dashboardMaintMap_custReq___VisitRestore');

                        Route::get('/delete-permanently/{maintMap_custReq___visit}', array(
                            'as' => 'delete_permanently',
                            'uses' => 'VisitController@destroyPermanently'
                        ))->middleware('dashboardMaintMap_custReq___VisitDeletePermanently');

                        Route::get('/manage-visit/{maintMap_custReq___visit}', array(
                                    'as' => 'manage_visit',
                                    'uses' => 'VisitController@manageVisit'
                        ))->middleware('dashboardMaintMap_custReq___VisitManageVisit');

                    });
                    //------------------------Start maintMap_custReq___task_employees Routes----------------------
                    // Route::prefix('maintMap_custReq___task_employees')->name('maintMap_custReq___task_employee.')->group(function () {
                    //     Route::get('/', array(
                    //         'as' => 'index',
                    //         'uses' => 'TaskEmployeeController@index'
                    //     ))->middleware('dashboardMaintMap_custReq___Task_EmployeeIndex');
                    //     Route::get('/archived', array(
                    //         'as' => 'archived',
                    //         'uses' => 'TaskEmployeeController@archived'
                    //     ))->middleware('dashboardMaintMap_custReq___Task_EmployeeArchived');
                    //     Route::get('/create', array(
                    //         'as' => 'create',
                    //         'uses' => 'TaskEmployeeController@create'
                    //     ))->middleware('dashboardMaintMap_custReq___Task_EmployeeCreate');
                    //     Route::post('/store', array(
                    //                 'as' => 'store',
                    //                 'uses' => 'TaskEmployeeController@store'
                    //     ))->middleware('dashboardMaintMap_custReq___Task_EmployeeCreate');
                    //     Route::get('/show/{maintMap_custReq___task_employee}', array(
                    //                 'as' => 'show',
                    //                 'uses' => 'TaskEmployeeController@show'
                    //     ))->middleware('dashboardMaintMap_custReq___Task_EmployeeShow');
                    //     Route::get('/edit/{maintMap_custReq___task_employee}', array(
                    //                 'as' => 'edit',
                    //                 'uses' => 'TaskEmployeeController@edit'
                    //     ))->middleware('dashboardMaintMap_custReq___Task_EmployeeEdit');
                    //     Route::put('/edit/{maintMap_custReq___task_employee}', array(
                    //                 'as' => 'update',
                    //                 'uses' => 'TaskEmployeeController@update'
                    //     ))->middleware('dashboardMaintMap_custReq___Task_EmployeeEdit');
                    //     Route::get('/delete/{maintMap_custReq___task_employee}', array(
                    //         'as' => 'delete',
                    //         'uses' => 'TaskEmployeeController@destroy'
                    //     ))->middleware('dashboardMaintMap_custReq___Task_EmployeeDelete');
                    //     Route::get('/restore/{maintMap_custReq___task_employee}', array(
                    //         'as' => 'restore',
                    //         'uses' => 'TaskEmployeeController@restore'
                    //     ))->middleware('dashboardMaintMap_custReq___Task_EmployeeRestore');
                    //     Route::get('/delete-permanently/{maintMap_custReq___task_employee}', array(
                    //         'as' => 'delete_permanently',
                    //         'uses' => 'TaskEmployeeController@destroyPermanently'
                    //     ))->middleware('dashboardMaintMap_custReq___Task_EmployeeDeletePermanently');
                    // });
                });


                //------------------------Start maintMap_custReq___employees Routes----------------------
                Route::prefix('maintMap_custReq___employees')->name('maintMap_custReq___employee.')->group(function () {
                    Route::get('/', array(
                        'as' => 'index',
                        'uses' => 'EmployeeController@index'
                    ))->middleware('dashboardMaintMap_custReq___EmployeeIndex');

                    Route::get('/archived', array(
                        'as' => 'archived',
                        'uses' => 'EmployeeController@archived'
                    ))->middleware('dashboardMaintMap_custReq___EmployeeArchived');

                    Route::get('/create', array(
                        'as' => 'create',
                        'uses' => 'EmployeeController@create'
                    ))->middleware('dashboardMaintMap_custReq___EmployeeCreate');

                    Route::post('/store', array(
                                'as' => 'store',
                                'uses' => 'EmployeeController@store'
                    ))->middleware('dashboardMaintMap_custReq___EmployeeCreate');

                    Route::get('/show/{maintMap_custReq___employee}', array(
                                'as' => 'show',
                                'uses' => 'EmployeeController@show'
                    ))->middleware('dashboardMaintMap_custReq___EmployeeShow');

                    Route::get('/edit/{maintMap_custReq___employee}', array(
                                'as' => 'edit',
                                'uses' => 'EmployeeController@edit'
                    ))->middleware('dashboardMaintMap_custReq___EmployeeEdit');

                    Route::put('/edit/{maintMap_custReq___employee}', array(
                                'as' => 'update',
                                'uses' => 'EmployeeController@update'
                    ))->middleware('dashboardMaintMap_custReq___EmployeeEdit');

                    Route::get('/delete/{maintMap_custReq___employee}', array(
                        'as' => 'delete',
                        'uses' => 'EmployeeController@destroy'
                    ))->middleware('dashboardMaintMap_custReq___EmployeeDelete');

                    Route::get('/restore/{maintMap_custReq___employee}', array(
                        'as' => 'restore',
                        'uses' => 'EmployeeController@restore'
                    ))->middleware('dashboardMaintMap_custReq___EmployeeRestore');

                    Route::get('/delete-permanently/{maintMap_custReq___employee}', array(
                        'as' => 'delete_permanently',
                        'uses' => 'EmployeeController@destroyPermanently'
                    ))->middleware('dashboardMaintMap_custReq___EmployeeDeletePermanently');
                });
            });
        });

        //------------------------Start logistic_specializations Routes----------------------
        Route::prefix('logistic_specializations')->name('logistic_specialization.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'LogisticSpecializationController@index'
            ))->middleware('dashboardLogisticSpecializationIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'LogisticSpecializationController@archived'
            ))->middleware('dashboardLogisticSpecializationArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'LogisticSpecializationController@create'
            ))->middleware('dashboardLogisticSpecializationCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'LogisticSpecializationController@store'
            ))->middleware('dashboardLogisticSpecializationCreate');

            Route::get('/show/{logistic_specialization}', array(
                        'as' => 'show',
                        'uses' => 'LogisticSpecializationController@show'
            ))->middleware('dashboardLogisticSpecializationShow');

            Route::get('/edit/{logistic_specialization}', array(
                        'as' => 'edit',
                        'uses' => 'LogisticSpecializationController@edit'
            ))->middleware('dashboardLogisticSpecializationEdit');

            Route::put('/edit/{logistic_specialization}', array(
                        'as' => 'update',
                        'uses' => 'LogisticSpecializationController@update'
            ))->middleware('dashboardLogisticSpecializationEdit');

            Route::get('/delete/{logistic_specialization}', array(
                'as' => 'delete',
                'uses' => 'LogisticSpecializationController@destroy'
            ))->middleware('dashboardLogisticSpecializationDelete');

            Route::get('/restore/{logistic_specialization}', array(
                'as' => 'restore',
                'uses' => 'LogisticSpecializationController@restore'
            ))->middleware('dashboardLogisticSpecializationRestore');

            Route::get('/delete-permanently/{logistic_specialization}', array(
                'as' => 'delete_permanently',
                'uses' => 'LogisticSpecializationController@destroyPermanently'
            ))->middleware('dashboardLogisticSpecializationDeletePermanently');
        });
    });
});
