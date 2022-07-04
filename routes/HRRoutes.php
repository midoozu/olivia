<?php

////////////////////////////////// ????? ???????? ////////////////////////////////////////////
Route::resource('hrDepartment','HR\AdminHrDepartmentController');
Route::DELETE('hrDepartment/delete/bulk','HR\AdminHrDepartmentController@delete_all')
    ->name('hrDepartment.delete.bulk');


////////////////////////////////////// ???????? ///////////////////////////////
Route::resource('hrVacations','HR\AdminHrVacationsController');
Route::DELETE('hrVacations/delete/bulk','HR\AdminHrVacationsController@delete_all')
    ->name('hrVacations.delete.bulk');



////////////////////////////////////// ???????? ///////////////////////////////
Route::resource('hrSentence','HR\AdminHrSentencesController');
Route::DELETE('hrSentence/delete/bulk','HR\AdminHrSentencesController@delete_all')
    ->name('hrSentence.delete.bulk');






////////////////////////////////////// ???????? ///////////////////////////////
Route::resource('hrShifts','HR\AdminHrShiftsController');
Route::DELETE('hrShifts/delete/bulk','HR\AdminHrShiftsController@delete_all')
    ->name('hrShifts.delete.bulk');



////////////////////////////////////// ?????? ??????? ///////////////////////////////
Route::resource('hrShiftsTimes','HR\AdminHrShiftsTimesController');
Route::DELETE('hrShiftsTimes/delete/bulk','HR\AdminHrShiftsTimesController@delete_all')
    ->name('hrShiftsTimes.delete.bulk');



Route::group(['namespace'=>'HR'], function(){
    //index page
    Route::get('HRIndex', 'HRController@index')->name('HRIndex');
    //jobs
    Route::resource('HRJobs', 'JobsController');

    //employee
    Route::resource('HREmployee', 'EmployeesController');

    //allowances
    Route::resource('HRAllowances', 'AllowanceController');
    Route::post('update_allowance', 'AllowanceController@updateAllowanceValue')->name('update_allowance');

    //vacations
    Route::resource('HREmployeeVacations', 'EmployeeVacationsController');

    //sanction
    Route::resource('HREmployeeSanctions', 'EmployeeSanctionController');

    //Evaluations
    Route::resource('HREmployeeEvaluations', 'EvaluationsController');

    //Bonus
    Route::resource('HREmployeeBonus', 'EmployeeBonusController');

    //Salary advances
    Route::resource('HREmployeeAdvances', 'EmployeeSalaryAdvance');

    ///////////////////////////// السلف المنتظمة والغير منتظمة /////////////////////////////
    Route::resource('hrPredecessor','HR\AdminHrPredecessorController');

});




