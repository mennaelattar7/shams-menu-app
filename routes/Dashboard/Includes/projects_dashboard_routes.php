<?php
use Illuminate\Support\Facades\Route;

Route::prefix('projects-dashboard')->name('projects_dashboard.')->group(function(){
    Route::group(['namespace' => 'Projects_Dashboard'], function () {
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
            ))->middleware('dashboardCustomerRequestIndex')
            ->where('status', 'inspected|in_progress|completed|rejected|not_opened|on_hold');

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

        Route::group(['namespace' => 'InstProjectPlan_custReq'], function () {
            //------------------------Start instProjectPlan_custReq___stages Routes----------------------
            Route::prefix('instProjectPlan_custReq___stages')->name('instProjectPlan_custReq___stage.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'StageController@index'
                ))->middleware('dashboardInstProjectPlan_custReq___StageIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'StageController@archived'
                ))->middleware('dashboardInstProjectPlan_custReq___StageArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'StageController@create'
                ))->middleware('dashboardInstProjectPlan_custReq___StageCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'StageController@store'
                ))->middleware('dashboardInstProjectPlan_custReq___StageCreate');

                Route::get('/show/{instProjectPlan_custReq___stage}', array(
                            'as' => 'show',
                            'uses' => 'StageController@show'
                ))->middleware('dashboardInstProjectPlan_custReq___StageShow');

                Route::get('/edit/{instProjectPlan_custReq___stage}', array(
                            'as' => 'edit',
                            'uses' => 'StageController@edit'
                ))->middleware('dashboardInstProjectPlan_custReq___StageEdit');

                Route::put('/edit/{instProjectPlan_custReq___stage}', array(
                            'as' => 'update',
                            'uses' => 'StageController@update'
                ))->middleware('dashboardInstProjectPlan_custReq___StageEdit');

                Route::get('/delete/{instProjectPlan_custReq___stage}', array(
                    'as' => 'delete',
                    'uses' => 'StageController@destroy'
                ))->middleware('dashboardInstProjectPlan_custReq___StageDelete');

                Route::get('/restore/{instProjectPlan_custReq___stage}', array(
                    'as' => 'restore',
                    'uses' => 'StageController@restore'
                ))->middleware('dashboardInstProjectPlan_custReq___StageRestore');

                Route::get('/delete-permanently/{instProjectPlan_custReq___stage}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'StageController@destroyPermanently'
                ))->middleware('dashboardInstProjectPlan_custReq___StageDeletePermanently');
            });
            //------------------------Start instProjectPlan_custReq___phases Routes----------------------
            Route::prefix('instProjectPlan_custReq___phases')->name('instProjectPlan_custReq___phase.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'PhaseController@index'
                ))->middleware('dashboardInstProjectPlan_custReq___PhaseIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'PhaseController@archived'
                ))->middleware('dashboardInstProjectPlan_custReq___PhaseArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'PhaseController@create'
                ))->middleware('dashboardInstProjectPlan_custReq___PhaseCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'PhaseController@store'
                ))->middleware('dashboardInstProjectPlan_custReq___PhaseCreate');

                Route::get('/show/{instProjectPlan_custReq___phase}', array(
                            'as' => 'show',
                            'uses' => 'PhaseController@show'
                ))->middleware('dashboardInstProjectPlan_custReq___PhaseShow');

                Route::get('/edit/{instProjectPlan_custReq___phase}', array(
                            'as' => 'edit',
                            'uses' => 'PhaseController@edit'
                ))->middleware('dashboardInstProjectPlan_custReq___PhaseEdit');

                Route::put('/edit/{instProjectPlan_custReq___phase}', array(
                            'as' => 'update',
                            'uses' => 'PhaseController@update'
                ))->middleware('dashboardInstProjectPlan_custReq___PhaseEdit');

                Route::get('/delete/{instProjectPlan_custReq___phase}', array(
                    'as' => 'delete',
                    'uses' => 'PhaseController@destroy'
                ))->middleware('dashboardInstProjectPlan_custReq___PhaseDelete');

                Route::get('/restore/{instProjectPlan_custReq___phase}', array(
                    'as' => 'restore',
                    'uses' => 'PhaseController@restore'
                ))->middleware('dashboardInstProjectPlan_custReq___PhaseRestore');

                Route::get('/delete-permanently/{instProjectPlan_custReq___phase}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'PhaseController@destroyPermanently'
                ))->middleware('dashboardInstProjectPlan_custReq___PhaseDeletePermanently');
            });
            //------------------------Start instProjectPlan_custReq___main_tasks Routes----------------------
            Route::prefix('instProjectPlan_custReq___main_tasks')->name('instProjectPlan_custReq___main_task.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'MainTaskController@index'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'MainTaskController@archived'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'MainTaskController@create'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'MainTaskController@store'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskCreate');

                Route::get('/show/{instProjectPlan_custReq___MT}', array(
                            'as' => 'show',
                            'uses' => 'MainTaskController@show'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskShow');

                Route::get('/edit/{instProjectPlan_custReq___MT}', array(
                            'as' => 'edit',
                            'uses' => 'MainTaskController@edit'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskEdit');

                Route::put('/edit/{instProjectPlan_custReq___MT}', array(
                            'as' => 'update',
                            'uses' => 'MainTaskController@update'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskEdit');

                Route::get('/delete/{instProjectPlan_custReq___MT}', array(
                    'as' => 'delete',
                    'uses' => 'MainTaskController@destroy'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskDelete');

                Route::get('/restore/{instProjectPlan_custReq___MT}', array(
                    'as' => 'restore',
                    'uses' => 'MainTaskController@restore'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskRestore');

                Route::get('/delete-permanently/{instProjectPlan_custReq___MT}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'MainTaskController@destroyPermanently'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskDeletePermanently');

                //------------------------All Ajax Requests------------------
                Route::post('/new_main_task_responsible/ajax', array(
                    'as' => 'new_main_task_responsible.ajax',
                    'uses' => 'MainTaskController@ajaxNewMainTaskResponsible'
                ));
                Route::post('/new_main_task_sub_task/ajax', array(
                    'as' => 'new_main_task_sub_task.ajax',
                    'uses' => 'MainTaskController@ajaxNewMainTaskSubTask'
                ));
            });
            //------------------------Start instProjectPlan_custReq___main_task_responsibles Routes----------------------
            Route::prefix('instProjectPlan_custReq___main_task_responsibles')->name('instProjectPlan_custReq___main_task_responsible.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'MainTaskResponsibleController@index'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskResponsibleIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'MainTaskResponsibleController@archived'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskResponsibleArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'MainTaskResponsibleController@create'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskResponsibleCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'MainTaskResponsibleController@store'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskResponsibleCreate');

                Route::get('/show/{instProjectPlan_custReq___MTR}', array(
                            'as' => 'show',
                            'uses' => 'MainTaskResponsibleController@show'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskResponsibleShow');

                Route::get('/edit/{instProjectPlan_custReq___MTR}', array(
                            'as' => 'edit',
                            'uses' => 'MainTaskResponsibleController@edit'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskResponsibleEdit');

                Route::put('/edit/{instProjectPlan_custReq___MTR}', array(
                            'as' => 'update',
                            'uses' => 'MainTaskResponsibleController@update'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskResponsibleEdit');

                Route::get('/delete/{instProjectPlan_custReq___MTR}', array(
                    'as' => 'delete',
                    'uses' => 'MainTaskResponsibleController@destroy'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskResponsibleDelete');

                Route::get('/restore/{instProjectPlan_custReq___MTR}', array(
                    'as' => 'restore',
                    'uses' => 'MainTaskResponsibleController@restore'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskResponsibleRestore');

                Route::get('/delete-permanently/{instProjectPlan_custReq___MTR}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'MainTaskResponsibleController@destroyPermanently'
                ))->middleware('dashboardInstProjectPlan_custReq___MainTaskResponsibleDeletePermanently');
            });
            //------------------------Start instProjectPlan_custReq___sub_tasks Routes----------------------
            Route::prefix('instProjectPlan_custReq___sub_tasks')->name('instProjectPlan_custReq___sub_task.')->group(function () {
                Route::get('/', array(
                    'as' => 'index',
                    'uses' => 'SubTaskController@index'
                ))->middleware('dashboardInstProjectPlan_custReq___SubTaskIndex');

                Route::get('/archived', array(
                    'as' => 'archived',
                    'uses' => 'SubTaskController@archived'
                ))->middleware('dashboardInstProjectPlan_custReq___SubTaskArchived');

                Route::get('/create', array(
                    'as' => 'create',
                    'uses' => 'SubTaskController@create'
                ))->middleware('dashboardInstProjectPlan_custReq___SubTaskCreate');

                Route::post('/store', array(
                            'as' => 'store',
                            'uses' => 'SubTaskController@store'
                ))->middleware('dashboardInstProjectPlan_custReq___SubTaskCreate');

                Route::get('/show/{instProjectPlan_custReq___ST}', array(
                            'as' => 'show',
                            'uses' => 'SubTaskController@show'
                ))->middleware('dashboardInstProjectPlan_custReq___SubTaskShow');

                Route::get('/edit/{instProjectPlan_custReq___ST}', array(
                            'as' => 'edit',
                            'uses' => 'SubTaskController@edit'
                ))->middleware('dashboardInstProjectPlan_custReq___SubTaskEdit');

                Route::put('/edit/{instProjectPlan_custReq___ST}', array(
                            'as' => 'update',
                            'uses' => 'SubTaskController@update'
                ))->middleware('dashboardInstProjectPlan_custReq___SubTaskEdit');

                Route::get('/delete/{instProjectPlan_custReq___ST}', array(
                    'as' => 'delete',
                    'uses' => 'SubTaskController@destroy'
                ))->middleware('dashboardInstProjectPlan_custReq___SubTaskDelete');

                Route::get('/restore/{instProjectPlan_custReq___ST}', array(
                    'as' => 'restore',
                    'uses' => 'SubTaskController@restore'
                ))->middleware('dashboardInstProjectPlan_custReq___SubTaskRestore');

                Route::get('/delete-permanently/{instProjectPlan_custReq___ST}', array(
                    'as' => 'delete_permanently',
                    'uses' => 'SubTaskController@destroyPermanently'
                ))->middleware('dashboardInstProjectPlan_custReq___SubTaskDeletePermanently');

                //------------------------All Ajax Requests------------------
                Route::post('/new_sub_task_required_data_type/ajax', array(
                    'as' => 'new_sub_task_required_data_type.ajax',
                    'uses' => 'SubTaskController@ajaxNewSubTaskRequiredDataType'
                ));
            });
        });
        //------------------------Start required_data_types Routes----------------------
        Route::prefix('required_data_types')->name('required_data_type.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'RequiredDataTypeController@index'
            ))->middleware('dashboardRequiredDataTypeIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'RequiredDataTypeController@archived'
            ))->middleware('dashboardRequiredDataTypeArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'RequiredDataTypeController@create'
            ))->middleware('dashboardRequiredDataTypeCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'RequiredDataTypeController@store'
            ))->middleware('dashboardRequiredDataTypeCreate');

            Route::get('/show/{instProjectPlan_custReq___STRDT}', array(
                        'as' => 'show',
                        'uses' => 'RequiredDataTypeController@show'
            ))->middleware('dashboardRequiredDataTypeShow');

            Route::get('/edit/{instProjectPlan_custReq___STRDT}', array(
                        'as' => 'edit',
                        'uses' => 'RequiredDataTypeController@edit'
            ))->middleware('dashboardRequiredDataTypeEdit');

            Route::put('/edit/{instProjectPlan_custReq___STRDT}', array(
                        'as' => 'update',
                        'uses' => 'RequiredDataTypeController@update'
            ))->middleware('dashboardRequiredDataTypeEdit');

            Route::get('/delete/{instProjectPlan_custReq___STRDT}', array(
                'as' => 'delete',
                'uses' => 'RequiredDataTypeController@destroy'
            ))->middleware('dashboardRequiredDataTypeDelete');

            Route::get('/restore/{instProjectPlan_custReq___STRDT}', array(
                'as' => 'restore',
                'uses' => 'RequiredDataTypeController@restore'
            ))->middleware('dashboardRequiredDataTypeRestore');

            Route::get('/delete-permanently/{instProjectPlan_custReq___STRDT}', array(
                'as' => 'delete_permanently',
                'uses' => 'RequiredDataTypeController@destroyPermanently'
            ))->middleware('dashboardRequiredDataTypeDeletePermanently');
        });

        Route::prefix('operations')->name('request_operations.')->group(function(){
            Route::group(['namespace' => 'Operations'], function () {
                //------------------------Start request_places Routes----------------------
                Route::prefix('operations')->name('operation.')->group(function () {
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
                    Route::get('/procedures/{operation}', array(
                        'as' => 'procedures',
                        'uses' => 'OperationController@proceduresOperation'
                    ))->middleware('dashboardOperationProcedures');

                    Route::post('/change-status-phase/ajax', array(
                        'as' => 'change_status_phase.ajax',
                        'uses' => 'OperationController@ajaxChangeStatusPhase'
                    ))->middleware('dashboardOperationChangeStatusPhase');

                    Route::get('/show-tasks/{operation}', array(
                        'as' => 'show_tasks',
                        'uses' => 'OperationController@showTasks'
                    ))->middleware('dashboardOperationShowTasks');

                });
                //------------------------Start tasks_operations Routes----------------------
                Route::prefix('tasks-operations')->name('task_operation.')->group(function () {
                    Route::get('/{employee?}', array(
                        'as' => 'index',
                        'uses' => 'TaskOperationController@index'
                    ))->middleware('dashboardTaskOperationIndex');

                    Route::get('/archived', array(
                        'as' => 'archived',
                        'uses' => 'TaskOperationController@archived'
                    ))->middleware('dashboardTaskOperationArchived');

                    Route::get('/create', array(
                        'as' => 'create',
                        'uses' => 'TaskOperationController@create'
                    ))->middleware('dashboardTaskOperationCreate');

                    Route::post('/store', array(
                                'as' => 'store',
                                'uses' => 'TaskOperationController@store'
                    ))->middleware('dashboardTaskOperationCreate');

                    Route::get('/show/{task_operation}', array(
                                'as' => 'show',
                                'uses' => 'TaskOperationController@show'
                    ))->middleware('dashboardTaskOperationShow');

                    Route::get('/edit/{task_operation}', array(
                                'as' => 'edit',
                                'uses' => 'TaskOperationController@edit'
                    ))->middleware('dashboardTaskOperationEdit');

                    Route::put('/edit/{task_operation}', array(
                                'as' => 'update',
                                'uses' => 'TaskOperationController@update'
                    ))->middleware('dashboardTaskOperationEdit');

                    Route::get('/delete/{task_operation}', array(
                        'as' => 'delete',
                        'uses' => 'TaskOperationController@destroy'
                    ))->middleware('dashboardTaskOperationDelete');

                    Route::get('/restore/{task_operation}', array(
                        'as' => 'restore',
                        'uses' => 'TaskOperationController@restore'
                    ))->middleware('dashboardTaskOperationRestore');

                    Route::get('/delete-permanently/{task_operation}', array(
                        'as' => 'delete_permanently',
                        'uses' => 'TaskOperationController@destroyPermanently'
                    ))->middleware('dashboardTaskOperationDeletePermanently');

                    // Route::get('/complete-task/{task_operation}', array(
                    //     'as' => 'complete_task',
                    //     'uses' => 'TaskOperationController@getCompleteTask'
                    // ))->middleware('dashboardTaskOperationCompleteTask');


                    // Route::put('/complete-task/{task_operation}', array(
                    //     'as' => 'post_complete_task',
                    //     'uses' => 'TaskOperationController@postCompleteTask'
                    // ))->middleware('dashboardTaskOperationCompleteTask');

                    Route::post('/complete-task', array(
                        'as' => 'complete_task',
                        'uses' => 'TaskOperationController@completeTask'
                    ))->middleware('dashboardTaskOperationCompleteTask');

                    Route::post('/assign-executor-task', array(
                        'as' => 'assign_executor_task',
                        'uses' => 'TaskOperationController@assignExecutorTask'
                    ))->middleware('dashboardTaskOperationAssignExecutorTask');

                    Route::get('/add-notes-to-completed-task/{task_operation}', array(
                        'as' => 'add_notes_to_completed_task',
                        'uses' => 'TaskOperationController@getAddNotesToCompleteTask'
                    ))->middleware('dashboardTaskOperationAddNotesToCompleteTask');

                    Route::put('/add-notes-to-completed-task/{task_operation}', array(
                        'as' => 'post_add_notes_to_complete_task',
                        'uses' => 'TaskOperationController@postAddNotesToCompletedTask'
                    ))->middleware('dashboardTaskOperationAddNotesToCompleteTask');

                });

                //------------------------Start risks Routes----------------------
                Route::prefix('risks')->name('risk.')->group(function () {
                    Route::get('/', array(
                        'as' => 'index',
                        'uses' => 'RiskController@index'
                    ))->middleware('dashboardRiskIndex');

                    Route::get('/archived', array(
                        'as' => 'archived',
                        'uses' => 'RiskController@archived'
                    ))->middleware('dashboardRiskArchived');

                    Route::get('/create', array(
                        'as' => 'create',
                        'uses' => 'RiskController@create'
                    ))->middleware('dashboardRiskCreate');

                    Route::post('/store', array(
                                'as' => 'store',
                                'uses' => 'RiskController@store'
                    ))->middleware('dashboardRiskCreate');

                    Route::get('/show/{risk}', array(
                                'as' => 'show',
                                'uses' => 'RiskController@show'
                    ))->middleware('dashboardRiskShow');

                    Route::get('/edit/{risk}', array(
                                'as' => 'edit',
                                'uses' => 'RiskController@edit'
                    ))->middleware('dashboardRiskEdit');

                    Route::put('/edit/{risk}', array(
                                'as' => 'update',
                                'uses' => 'RiskController@update'
                    ))->middleware('dashboardRiskEdit');

                    Route::get('/delete/{risk}', array(
                        'as' => 'delete',
                        'uses' => 'RiskController@destroy'
                    ))->middleware('dashboardRiskDelete');

                    Route::get('/restore/{risk}', array(
                        'as' => 'restore',
                        'uses' => 'RiskController@restore'
                    ))->middleware('dashboardRiskRestore');

                    Route::get('/delete-permanently/{risk}', array(
                        'as' => 'delete_permanently',
                        'uses' => 'RiskController@destroyPermanently'
                    ))->middleware('dashboardRiskDeletePermanently');
                });
                //------------------------Start resources Routes----------------------
                Route::prefix('resources')->name('resource.')->group(function () {
                    Route::get('/', array(
                        'as' => 'index',
                        'uses' => 'ResourceController@index'
                    ))->middleware('dashboardResourceIndex');

                    Route::get('/archived', array(
                        'as' => 'archived',
                        'uses' => 'ResourceController@archived'
                    ))->middleware('dashboardResourceArchived');

                    Route::get('/create', array(
                        'as' => 'create',
                        'uses' => 'ResourceController@create'
                    ))->middleware('dashboardResourceCreate');

                    Route::post('/store', array(
                                'as' => 'store',
                                'uses' => 'ResourceController@store'
                    ))->middleware('dashboardResourceCreate');

                    Route::get('/show/{resource}', array(
                                'as' => 'show',
                                'uses' => 'ResourceController@show'
                    ))->middleware('dashboardResourceShow');

                    Route::get('/edit/{resource}', array(
                                'as' => 'edit',
                                'uses' => 'ResourceController@edit'
                    ))->middleware('dashboardResourceEdit');

                    Route::put('/edit/{resource}', array(
                                'as' => 'update',
                                'uses' => 'ResourceController@update'
                    ))->middleware('dashboardResourceEdit');

                    Route::get('/delete/{resource}', array(
                        'as' => 'delete',
                        'uses' => 'ResourceController@destroy'
                    ))->middleware('dashboardResourceDelete');

                    Route::get('/restore/{resource}', array(
                        'as' => 'restore',
                        'uses' => 'ResourceController@restore'
                    ))->middleware('dashboardResourceRestore');

                    Route::get('/delete-permanently/{resource}', array(
                        'as' => 'delete_permanently',
                        'uses' => 'ResourceController@destroyPermanently'
                    ))->middleware('dashboardResourceDeletePermanently');
                });
            });
        });

    });
});
