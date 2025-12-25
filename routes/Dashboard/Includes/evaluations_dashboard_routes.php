<?php
use Illuminate\Support\Facades\Route;

Route::prefix('evaluations-dashboard')->name('evaluations_dashboard.')->group(function(){
    Route::group(['namespace' => 'Evaluations_Dashboard'], function () {
        //-----------------------Start Home Routes--------------------------
        Route::prefix('home')->name('home.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'HomeController@index'
            ));
        });
        //------------------------Start evaluations___strategic_goals Routes----------------------
        Route::prefix('strategic_goals')->name('strategic_goal.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'StrategicGoalController@index'
            ))->middleware('dashboardEvaluationStrategicGoalIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'StrategicGoalController@archived'
            ))->middleware('dashboardEvaluationStrategicGoalArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'StrategicGoalController@create'
            ))->middleware('dashboardEvaluationStrategicGoalCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'StrategicGoalController@store'
            ))->middleware('dashboardEvaluationStrategicGoalCreate');

            Route::get('/show/{strategic_goal}', array(
                        'as' => 'show',
                        'uses' => 'StrategicGoalController@show'
            ))->middleware('dashboardEvaluationStrategicGoalShow');

            Route::get('/edit/{strategic_goal}', array(
                        'as' => 'edit',
                        'uses' => 'StrategicGoalController@edit'
            ))->middleware('dashboardEvaluationStrategicGoalEdit');

            Route::put('/edit/{strategic_goal}', array(
                        'as' => 'update',
                        'uses' => 'StrategicGoalController@update'
            ))->middleware('dashboardEvaluationStrategicGoalEdit');

            Route::get('/delete/{strategic_goal}', array(
                'as' => 'delete',
                'uses' => 'StrategicGoalController@destroy'
            ))->middleware('dashboardEvaluationStrategicGoalDelete');

            Route::get('/restore/{strategic_goal}', array(
                'as' => 'restore',
                'uses' => 'StrategicGoalController@restore'
            ))->middleware('dashboardEvaluationStrategicGoalRestore');

            Route::get('/delete-permanently/{strategic_goal}', array(
                'as' => 'delete_permanently',
                'uses' => 'StrategicGoalController@destroyPermanently'
            ))->middleware('dashboardEvaluationStrategicGoalDeletePermanently');

            //------------------------Ajax Routes------------------
            Route::post('/new_strategic_goal/ajax', array(
                'as' => 'new_strategic_goal.ajax',
                'uses' => 'StrategicGoalController@ajaxNewStrategicGoal'
            ));
        });
        //------------------------Start operational_goals Routes----------------------
        Route::prefix('operational_goals')->name('operational_goal.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'OperationalGoalController@index'
            ))->middleware('dashboardEvaluationOperationalGoalIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'OperationalGoalController@archived'
            ))->middleware('dashboardEvaluationOperationalGoalArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'OperationalGoalController@create'
            ))->middleware('dashboardEvaluationOperationalGoalCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'OperationalGoalController@store'
            ))->middleware('dashboardEvaluationOperationalGoalCreate');

            Route::get('/show/{operational_goal}', array(
                        'as' => 'show',
                        'uses' => 'OperationalGoalController@show'
            ))->middleware('dashboardEvaluationOperationalGoalShow');

            Route::get('/edit/{operational_goal}', array(
                        'as' => 'edit',
                        'uses' => 'OperationalGoalController@edit'
            ))->middleware('dashboardEvaluationOperationalGoalEdit');

            Route::put('/edit/{operational_goal}', array(
                        'as' => 'update',
                        'uses' => 'OperationalGoalController@update'
            ))->middleware('dashboardEvaluationOperationalGoalEdit');

            Route::get('/delete/{operational_goal}', array(
                'as' => 'delete',
                'uses' => 'OperationalGoalController@destroy'
            ))->middleware('dashboardEvaluationOperationalGoalDelete');

            Route::get('/restore/{operational_goal}', array(
                'as' => 'restore',
                'uses' => 'OperationalGoalController@restore'
            ))->middleware('dashboardEvaluationOperationalGoalRestore');

            Route::get('/delete-permanently/{operational_goal}', array(
                'as' => 'delete_permanently',
                'uses' => 'OperationalGoalController@destroyPermanently'
            ))->middleware('dashboardEvaluationOperationalGoalDeletePermanently');
            //------------------------Ajax Routes------------------
            Route::post('/new_operational_goal/ajax', array(
                'as' => 'new_operational_goal.ajax',
                'uses' => 'OperationalGoalController@ajaxNewOperationalGoal'
            ));
        });
        //------------------------Start initiatives Routes----------------------
        Route::prefix('initiatives')->name('initiative.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'InitiativeController@index'
            ))->middleware('dashboardEvaluationInitiativeIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'InitiativeController@archived'
            ))->middleware('dashboardEvaluationInitiativeArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'InitiativeController@create'
            ))->middleware('dashboardEvaluationInitiativeCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'InitiativeController@store'
            ))->middleware('dashboardEvaluationInitiativeCreate');

            Route::get('/show/{initiative}', array(
                        'as' => 'show',
                        'uses' => 'InitiativeController@show'
            ))->middleware('dashboardEvaluationInitiativeShow');

            Route::get('/edit/{initiative}', array(
                        'as' => 'edit',
                        'uses' => 'InitiativeController@edit'
            ))->middleware('dashboardEvaluationInitiativeEdit');

            Route::put('/edit/{initiative}', array(
                        'as' => 'update',
                        'uses' => 'InitiativeController@update'
            ))->middleware('dashboardEvaluationInitiativeEdit');

            Route::get('/delete/{initiative}', array(
                'as' => 'delete',
                'uses' => 'InitiativeController@destroy'
            ))->middleware('dashboardEvaluationInitiativeDelete');

            Route::get('/restore/{initiative}', array(
                'as' => 'restore',
                'uses' => 'InitiativeController@restore'
            ))->middleware('dashboardEvaluationInitiativeRestore');

            Route::get('/delete-permanently/{initiative}', array(
                'as' => 'delete_permanently',
                'uses' => 'InitiativeController@destroyPermanently'
            ))->middleware('dashboardEvaluationInitiativeDeletePermanently');

            //------------------------Ajax Routes------------------
            Route::post('/new_initiative/ajax', array(
                'as' => 'new_initiative.ajax',
                'uses' => 'InitiativeController@ajaxNewInitiative'
            ));
        });
        //------------------------Start task_definitions Routes----------------------
        Route::prefix('task-definitions')->name('task_definition.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'TaskDefinitionController@index'
            ))->middleware('dashboardTaskDefinitionIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'TaskDefinitionController@archived'
            ))->middleware('dashboardTaskDefinitionArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'TaskDefinitionController@create'
            ))->middleware('dashboardTaskDefinitionCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'TaskDefinitionController@store'
            ))->middleware('dashboardTaskDefinitionCreate');

            Route::get('/show/{task}', array(
                        'as' => 'show',
                        'uses' => 'TaskDefinitionController@show'
            ))->middleware('dashboardTaskDefinitionShow');

            Route::get('/edit/{task}', array(
                        'as' => 'edit',
                        'uses' => 'TaskDefinitionController@edit'
            ))->middleware('dashboardTaskDefinitionEdit');

            Route::put('/edit/{task}', array(
                        'as' => 'update',
                        'uses' => 'TaskDefinitionController@update'
            ))->middleware('dashboardTaskDefinitionEdit');

            Route::get('/delete/{task}', array(
                'as' => 'delete',
                'uses' => 'TaskDefinitionController@destroy'
            ))->middleware('dashboardTaskDefinitionDelete');

            Route::get('/restore/{task}', array(
                'as' => 'restore',
                'uses' => 'TaskDefinitionController@restore'
            ))->middleware('dashboardTaskDefinitionRestore');

            Route::get('/delete-permanently/{task}', array(
                'as' => 'delete_permanently',
                'uses' => 'TaskDefinitionController@destroyPermanently'
            ))->middleware('dashboardTaskDefinitionDeletePermanently');

            //------------------------Ajax Routes------------------
            Route::post('/new_task/ajax', array(
                'as' => 'new_task.ajax',
                'uses' => 'TaskDefinitionController@ajaxNewTask'
            ));
        });
        //------------------------Start task_details Routes----------------------
        Route::prefix('task_details')->name('task_detail.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'TaskDetailController@index'
            ))->middleware('dashboardTaskDetailIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'TaskDetailController@archived'
            ))->middleware('dashboardTaskDetailArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'TaskDetailController@create'
            ))->middleware('dashboardTaskDetailCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'TaskDetailController@store'
            ))->middleware('dashboardTaskDetailCreate');

            Route::get('/show/{task_detail}', array(
                        'as' => 'show',
                        'uses' => 'TaskDetailController@show'
            ))->middleware('dashboardTaskDetailShow');

            Route::get('/edit/{task_detail}', array(
                        'as' => 'edit',
                        'uses' => 'TaskDetailController@edit'
            ))->middleware('dashboardTaskDetailEdit');

            Route::put('/edit/{task_detail}', array(
                        'as' => 'update',
                        'uses' => 'TaskDetailController@update'
            ))->middleware('dashboardTaskDetailEdit');

            Route::get('/delete/{task_detail}', array(
                'as' => 'delete',
                'uses' => 'TaskDetailController@destroy'
            ))->middleware('dashboardTaskDetailDelete');

            Route::get('/restore/{task_detail}', array(
                'as' => 'restore',
                'uses' => 'TaskDetailController@restore'
            ))->middleware('dashboardTaskDetailRestore');

            Route::get('/delete-permanently/{task_detail}', array(
                'as' => 'delete_permanently',
                'uses' => 'TaskDetailController@destroyPermanently'
            ))->middleware('dashboardTaskDetailDeletePermanently');

            Route::get('/complete_task/{task_detail}', array(
                'as' => 'complete_task',
                'uses' => 'TaskDetailController@completeTask'
            ))->middleware('dashboardTaskDetailCompleteTask');

            Route::put('/complete_task/{task_detail}', array(
                'as' => 'send_task',
                'uses' => 'TaskDetailController@sendTask'
            ))->middleware('dashboardTaskDetailCompleteTask');

        });
        //------------------------Start quarters Routes----------------------
        Route::prefix('quarters')->name('quarter.')->group(function () {
            Route::get('/', array(
                'as' => 'index',
                'uses' => 'QuarterController@index'
            ))->middleware('dashboardQuarterIndex');

            Route::get('/archived', array(
                'as' => 'archived',
                'uses' => 'QuarterController@archived'
            ))->middleware('dashboardQuarterArchived');

            Route::get('/create', array(
                'as' => 'create',
                'uses' => 'QuarterController@create'
            ))->middleware('dashboardQuarterCreate');

            Route::post('/store', array(
                        'as' => 'store',
                        'uses' => 'QuarterController@store'
            ))->middleware('dashboardQuarterCreate');

            Route::get('/show/{quarter}', array(
                        'as' => 'show',
                        'uses' => 'QuarterController@show'
            ))->middleware('dashboardQuarterShow');

            Route::get('/edit/{quarter}', array(
                        'as' => 'edit',
                        'uses' => 'QuarterController@edit'
            ))->middleware('dashboardQuarterEdit');

            Route::put('/edit/{quarter}', array(
                        'as' => 'update',
                        'uses' => 'QuarterController@update'
            ))->middleware('dashboardQuarterEdit');

            Route::get('/delete/{quarter}', array(
                'as' => 'delete',
                'uses' => 'QuarterController@destroy'
            ))->middleware('dashboardQuarterDelete');

            Route::get('/restore/{quarter}', array(
                'as' => 'restore',
                'uses' => 'QuarterController@restore'
            ))->middleware('dashboardQuarterRestore');

            Route::get('/delete-permanently/{quarter}', array(
                'as' => 'delete_permanently',
                'uses' => 'QuarterController@destroyPermanently'
            ))->middleware('dashboardQuarterDeletePermanently');
        });
    });
});
