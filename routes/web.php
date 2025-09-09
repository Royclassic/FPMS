<?php
use Illuminate\Http\Request;
Route::get('/ComingSoon', "Soon@index");

//Route::get('/', function () {
//    return redirect('ComingSoon');
//});

 Route::get('/', function () {
     return redirect(route('login'));
 });


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    // Coordinator routes
    Route::group(
        ['namespace' => 'Admin', 'prefix' => 'coordinator', 'as' => 'admin.', 'middleware' => ['role:coordinator']], function () {
        // password
        Route::get('/profile/password/update', 'AdminDashboardController@Password')->name('password.change');
        Route::post('/profile/password/change', 'AdminDashboardController@ChangePassword')->name('password');

        Route::get('dashboard', 'AdminDashboardController@index')->name('dashboard');
        Route::get('supervisors/assign/students', 'CoordinatorController@assignStudents')->name('students.assign');
        Route::post('/assign/students', 'CoordinatorController@assign')->name('assign');
        Route::get('/supervisor/get', 'CoordinatorController@showSupervisorInfor')->name('showSupervisorInfo');
        Route::get('students/export', ['uses' => 'ManageStudentsController@export'])->name('students.export');
        Route::get('students/data', ['uses' => 'ManageStudentsController@data'])->name('students.data');
        Route::get('students/supervisor/{id}', ['uses' => 'ManageStudentsController@showstudent'])->name('students.supervisor');
        Route::post('/supervisor/remove/student', "CoordinatorController@removeStudent")->name('removeStudent');
        //proporsals
        Route::get('/students/proposals', 'CoordinatorController@viewProposals')->name('students.proposals');
        Route::get('/students/proposals/view/{id}', 'CoordinatorController@viewProposal')->name('proposals.view');
        Route::get('/students/project/logs', 'CoodinatorProjectsController@logs')->name('project.logs');
        Route::get('/students/project/logs/{id}', 'CoodinatorProjectsController@viewLog')->name('logs.view');
        Route::get('/project/progress-logs/print/{id}','CoodinatorProjectsController@printLog' )->name('logs.print');
        Route::get('/students/project/documentations', 'CoodinatorProjectsController@documentations')->name('documentation.all');
        Route::resource('students', 'ManageStudentsController');
        Route::post('/faculty/add', 'ManageStudentsController@addFaculty')->name('addfaculty');
        Route::post('/courses/add', 'ManageStudentsController@addCourse')->name('addCourse');
        Route::get('/courses/get','ManageStudentsController@getCourses')->name('getCourses');

        //reports
        Route::get('/reports/students','ReportsController@students')->name('reports.students');
        Route::post('/reports/students/generate', 'ReportsController@studentgenerate')->name('reports.students.generate');
        Route::get('/reports/supervisors','ReportsController@supervisors')->name('reports.supervisors');
        Route::post('/reports/supervisors/all', 'ReportsController@supervisorgenerate')->name('reports.supervisors.generate');
        Route::get('/reports/proposals','ReportsController@proposals')->name('reports.proposals');
        Route::post('/reports/proposals/all', 'ReportsController@proposalgenerate')->name('reports.proposals.generate');
        Route::get('/reports/documentations','ReportsController@documentations')->name('reports.documentations');
        Route::post('/reports/documentations/all', 'ReportsController@documentationgenerate')->name('reports.documentations.generate');

        Route::get('supervisors/data', ['uses' => 'ManageSupervisorsController@data'])->name('supervisors.data');
        Route::get('supervisors/export', ['uses' => 'ManageSupervisorsController@export'])->name('supervisors.export');
        Route::resource('supervisors', 'ManageSupervisorsController');

        Route::get('notices/data', ['uses' => 'ManageNoticesController@data'])->name('notices.data');
        Route::resource('notices', 'ManageNoticesController');

        Route::group(
            ['prefix' => 'supervisor'], function() {
            Route::get('/student/{id}', ['uses' => 'CoordinatorController@showStudents'])->name('students.projects');
        });

        Route::resource('sticky-note', 'ManageStickyNotesController');

        Route::resource('search', 'AdminSearchController');
        // User message
        Route::post('message-submit', ['as' => 'user-chat.message-submit', 'uses' => 'AdminChatController@postChatMessage']);
        Route::get('user-search', ['as' => 'user-chat.user-search', 'uses' => 'AdminChatController@getUserSearch']);
        Route::resource('user-chat', 'AdminChatController');
        //project codes
        Route::get('/project/codes', 'ProjectCodeController@index')->name('project.codes');
        Route::get('/project/codes/find/{id}', 'ProjectCodeController@codes')->name('codes.find');
        Route::get('project/files/download/{id}', ['uses' => 'ProjectCodeController@download'])->name('files.download');

    }
    );

    // Supervisor routes
    Route::group(
        ['namespace' => 'Supervisor', 'prefix' => 'supervisor', 'as' => 'supervisor.', 'middleware' => ['role:supervisor']], function () {

        Route::get('dashboard', ['uses' => 'SupervisorDashboardController@index'])->name('dashboard');
        Route::get('/profile/updatepassword', 'SupervisorDashboardController@updatePassword')->name('updatePassword');
        Route::post('/profile/password/update', 'SupervisorDashboardController@firstLogin')->name('firstLogin');
        Route::resource('profile', 'SupervisorProfileController');
        //profile
        Route::get('/profile/password/update', 'SupervisorProfileController@Password')->name('password');
        Route::post('/profile/password/change', 'SupervisorProfileController@ChangePassword')->name('changePassword');
        Route::get('/profile/updatepassword', 'SupervisorProfileController@updatePassword')->name('updatePassword');
        Route::post('/profile/password/update', 'SupervisorProfileController@firstLogin')->name('firstLogin');
        Route::get('/profile', 'SupervisorProfileController@profile')->name('profile');
        Route::post('/update/basic', 'SupervisorProfileController@updateBasic')->name('updateBasic');
        Route::post('/update/contact', 'SupervisorProfileController@updateContact')->name('updateContact');
        Route::post('/update/photo', 'SupervisorProfileController@updatephoto')->name('updatephoto');
        //
        Route::get('/students/view', 'SupervisorController@viewStudents')->name('students.view');
        Route::get('/students/view/profile/{id}', 'SupervisorController@studentProfile')->name('students.profile');
        Route::get('/proposals/titles', 'ProposalsController@titles')->name('proposals.titles');
        Route::get('/proposals/title/view/{id}', 'ProposalsController@viewTitle')->name('proposal.viewTitle');
        Route::post('/proposals/title/review/{id}', 'ProposalsController@reviewTitle')->name('title.review');
        Route::get('/proposals/title/approve/{id}', 'ProposalsController@approveTitle')->name('title.approve');
        Route::get('/proposals/title/disapprove/{id}', 'ProposalsController@disapprove')->name('title.disapprove');

        Route::get('/proposals/problems/all', 'ProposalsController@problems')->name('proposals.problems');
        Route::get('/proposals/problem/view/{id}', 'ProposalsController@viewProblem')->name('proposal.viewProblem');
        Route::post('/proposals/problem/review/{id}', 'ProposalsController@reviewProblem')->name('problem.review');
        Route::get('/proposals/title/approve/{id}', 'ProposalsController@approveTitle')->name('title.approve');
        Route::get('/proposals/problem/approve/{id}', 'ProposalsController@approveProblem')->name('problem.approve');
        Route::get('/proposals/problem/disapprove/{id}', 'ProposalsController@disapproveProbem')->name('problem.disapprove');
        Route::get('/proposals/objectives', 'ProposalsController@objectives')->name('proposals.objectives');
        Route::get('/proposals/objectives/view/{id}', 'ProposalsController@viewObjective')->name('objectives.view');
        Route::post('/proposals/objective/review/{id}', 'ProposalsController@reviewObjective')->name('objective.review');
        Route::get('/proposals/objective/approve/{id}', 'ProposalsController@approveObjective')->name('objective.approve');
        Route::get('/proposals/objective/disapprove/{id}', 'ProposalsController@disapproveObjective')->name('objective.disapprove');
        Route::get('/proposals', 'ProposalsController@viewProposals')->name('proposals');
        Route::get('/proposals/view/{id}', 'ProposalsController@viewProposal')->name('proposal.view');
        Route::post('/proposals/review/{id}', 'ProposalsController@reviewProposal')->name('proposal.review');
        Route::get('/proposals/approve/{id}', 'ProposalsController@approveProposal')->name('proposal.approve');
        Route::get('/proposals/disapprove/{id}', 'ProposalsController@disapproveProposal')->name('proposal.disapprove');
        Route::get('/proposals/assessment', 'ProposalsController@proposalsAssessment')->name('proposals.assessment');
        Route::get('proposals/assessment/{id}', 'ProposalsController@proposalAssessment')->name('proposal.assessment');
        Route::post('proposals/remarks/{id}', 'ProposalsController@remark')->name('proposal.remark');
        Route::get('add/supervision-areas', 'SupervisorController@supervisionarea')->name('supervision.area');
        Route::post('save/supervision-areas', 'SupervisorController@saveArea')->name('supervision.add');
        //logs
        Route::get('/project/progress-logs', 'SuperVisorStudentLogsController@logs')->name('project.logs');
        Route::get('/project/progress-logs/view/{id}', 'SuperVisorStudentLogsController@viewlog')->name('project.log.view');
        Route::post('/project/progress-logs/save/additionaltask', 'SuperVisorStudentLogsController@saveAdditionalTask')->name('log.additionaltask.save');
        Route::get('/project/progress-logs/approve/{id}', 'SuperVisorStudentLogsController@approveLog')->name('log.approve');
        Route::post('/project/progress-logs/save/comments', 'SuperVisorStudentLogsController@saveComments')->name('log.comments.save');
        Route::get('/project/milestone/assessment/edit/{id}', 'SuperVisorStudentLogsController@fetchComment');
        Route::post('/project/progress-logs/update/comments', 'SuperVisorStudentLogsController@updateComments')->name('log.comments.update');
        Route::post('/project/progress-logs/delete/comments', 'SuperVisorStudentLogsController@deleteComments')->name('log.comments.delete');
        Route::get('/project/progress-logs/print/{id}','SuperVisorStudentLogsController@printLog' )->name('logs.print');
        Route::post('/project/logs/deadline', 'SuperVisorStudentLogsController@deadline')->name('project.deadline');
        //documentations
        Route::get('project/documentations/view', 'DocumentationController@documentations')->name('documentation.all');
        Route::get('project/documentations/view/{id}', 'DocumentationController@viewDocumentation')->name('documentation.view');
        Route::post('/project/docs/chapterone/assessment', 'DocumentationController@assessChapterOne')->name('docs.chapterone.assessment');
        Route::post('/project/docs/chapterone/delete-comment/{id}', 'DocumentationController@deleteChapterOneAssessment')->name('docs.chapterone.delete');
        Route::get('project/doc/chapterOne/assessment/edit/{id}', 'DocumentationController@fetchChapterOne');
        Route::post('/project/docs/chaptertwo/assessment', 'DocumentationController@assessChapterTwo')->name('docs.chaptertwo.assessment');
        Route::post('/project/docs/chaptertwo/delete-comment/{id}', 'DocumentationController@deleteChapterTwoAssessment')->name('docs.chaptertwo.delete');
        Route::get('project/doc/chapterTwo/assessment/edit/{id}', 'DocumentationController@fetchChapterTwo');
        Route::post('/project/docs/chapterthree/assessment', 'DocumentationController@assessChapterThree')->name('docs.chapterthree.assessment');
        Route::post('/project/docs/chapterthree/delete-comment/{id}', 'DocumentationController@deleteChapterThreeAssessment')->name('docs.chapterthree.delete');
        Route::get('project/doc/chapterThree/assessment/edit/{id}', 'DocumentationController@fetchChapterThree');
        Route::post('/project/docs/final/assessment', 'DocumentationController@assessFinal')->name('docs.final.assessment');
        Route::post('/project/docs/final/delete-comment/{id}', 'DocumentationController@deleteFinalAssessment')->name('docs.final.delete');
        Route::get('project/doc/final/assessment/edit/{id}', 'DocumentationController@fetchFinal');

        //sticky note
        Route::resource('sticky-note', 'SupervisorStickyNoteController');

        // User message
        Route::post('message-submit', ['as' => 'user-chat.message-submit', 'uses' => 'SupervisorChatController@postChatMessage']);
        Route::get('user-search', ['as' => 'user-chat.user-search', 'uses' => 'SupervisorChatController@getUserSearch']);
        Route::resource('user-chat', 'SupervisorChatController');

        //Notice
        Route::resource('notices', 'SupervisorNoticesController');
        //schedules
        Route::get('/projects/schedules', 'ProjectSchedulesController@index')->name('schedules.view');
        Route::get('/project/schedule/view/{id}', 'ProjectSchedulesController@schedule')->name('schedule.find');
        Route::get('/project/schedule/gantt/{id}', 'ProjectSchedulesController@gantt')->name('schedule.gantt');
        //project codes
        Route::get('/project/codes', 'ProjectCodeController@index')->name('project.codes');
        Route::get('/project/codes/find/{id}', 'ProjectCodeController@codes')->name('codes.find');
        Route::get('project/files/download/{id}', ['uses' => 'ProjectCodeController@download'])->name('files.download');
        //plagiarism
        Route::get('plagiarism/check/{proposal}', 'PlagiarismController@proposals')->name('plagiarism.check');
        Route::get('plagiarism/documentation/check/{documentation}', 'PlagiarismController@documentations')->name('documentation.check');

    });

    // Student routes
    Route::group(
        ['namespace' => 'Student', 'prefix' => 'student', 'as' => 'student.', 'middleware' => ['role:student']], function () {
        //dashboard
        Route::resource('dashboard', 'StudentDashboardController');
        Route::get('/profile/updatepassword', 'StudentDashboardController@updatePassword')->name('updatePassword');
        Route::get('/supervisor/details', 'StudentDashboardController@supervisor')->name('supervisor.show');
        Route::post('/profile/password/update', 'StudentDashboardController@firstLogin')->name('firstLogin');
        Route::resource('profile', 'StudentProfileController');
        //Proposal
        Route::get('/proposal/title', 'StudentProposalsController@title')->name('proposal.title');
        Route::post('/proposal/title/save','StudentProposalsController@saveTitle' )->name('proposal.saveTitle');
        Route::post('/proposal/title/reply','StudentProposalsController@replyTitle' )->name('title.reply');
        Route::get('/proposal/title/edit/{id}', 'StudentProposalsController@editTitle');
        Route::post('/proposal/title/edit', 'StudentProposalsController@reProposeTitle')->name('title.edit');
        //problem statement
        Route::get('/proposal/problem-statement', 'StudentProposalsController@problemStatement')->name('proposal.problem');
        Route::post('/proposal/problem-statement/save', 'StudentProposalsController@saveProblem')->name('problem.save');
        Route::get('/proposal/problem/edit/{id}', 'StudentProposalsController@editProblem');
        Route::post('/proposal/problem/update', 'StudentProposalsController@updateProblem')->name('problem.update');
        Route::post('/proposal/problem/reply','StudentProposalsController@replyProblem' )->name('problem.reply');
        //objectives
        Route::get('/proposal/objectives', 'StudentProposalsController@objectives')->name('proposal.objectives');
        Route::post('/proposal/objectives/save', 'StudentProposalsController@saveObjectives')->name('objectives.save');
        Route::post('/proposal/objective/reply','StudentProposalsController@replyObjective' )->name('objective.reply');
        Route::get('/proposal/objectives/edit/{id}', 'StudentProposalsController@editObjectives');
        Route::post('/proposal/objective/update', 'StudentProposalsController@updateObjective')->name('objective.update');
        //file
        Route::get('/proposal/upload/', 'StudentProposalsController@uploadProposal')->name('proposal.upload');
        Route::post('/proposal/save/file', 'StudentProposalsController@saveProposal')->name('proposal.save');
        Route::post('/proposal/reply','StudentProposalsController@replyProposal' )->name('proposal.reply');
        Route::post('/proposal/update/file', 'StudentProposalsController@updateProposal')->name('proposal.update');

        //logs
        Route::get('/project/log', 'StudentLogsController@index')->name('logs.index');
        Route::post('/project/log/save', 'StudentLogsController@save')->name('logs.save');
        Route::get('project/milestone/edit/{id}', 'StudentLogsController@fetchMilestone');
        Route::post('project/milestone/update', 'StudentLogsController@updateMilestone')->name('log.milestone.update');
        Route::post('project/milestone/delete', 'StudentLogsController@deleteMilestone')->name('log.milestone.delete');
        Route::get('/project/progress-logs/print/{id}','StudentLogsController@printLog' )->name('logs.print');

        //documentation
        Route::get('/project/documentation/chapter-one', 'DocumentationController@chapterone')->name('documentation.chapterone');
        Route::post('project/documentation/save/chapterone', 'DocumentationController@saveChapterOne')->name('chapterOne.save');
        Route::get('/project/documentation/chapter-two', 'DocumentationController@chaptertwo')->name('documentation.chaptertwo');
        Route::post('project/documentation/save/chaptertwo', 'DocumentationController@saveChapterTwo')->name('chapterTwo.save');
        Route::get('/project/documentation/chapter-three', 'DocumentationController@chapterthree')->name('documentation.chapterthree');
        Route::post('project/documentation/save/chapterthree', 'DocumentationController@saveChapterThree')->name('chapterThree.save');
        Route::get('/project/documentation/final', 'DocumentationController@finalDoc')->name('documentation.final');
        Route::post('/project/documentation/final/save', 'DocumentationController@savefinal')->name('final.save');

        //gantt chart
        Route::get('/project/schedule/gantt/charts', 'ProjectScheduleController@ganttChart')->name('gantt');
        Route::get('/project/schedule/create', 'ProjectScheduleController@schedule')->name('schedule');
        Route::post('/project/schedule/save', 'ProjectScheduleController@saveSchedule')->name('schedules.save');
        Route::get('/project/schedule/{id}', 'ProjectScheduleController@show')->name('schedule.show');
        Route::post('/project/schedule/update/{id}', 'ProjectScheduleController@update')->name('schedules.update');
        Route::post('/project/schedule/delete/{id}', 'ProjectScheduleController@delete')->name('schedule.delete');
        //profiles
        Route::get('/profile/password/update', 'StudentProfileController@Password')->name('password');
        Route::post('/profile/password/change', 'StudentProfileController@ChangePassword')->name('changePassword');
        Route::get('/profile/updatepassword', 'StudentProfileController@updatePassword')->name('updatePassword');
       // Route::post('/profile/password/update', 'StudentProfileController@firstLogin')->name('firstLogin');
        Route::get('/profile', 'StudentProfileController@profile')->name('profile');
        Route::post('/update/basic', 'StudentProfileController@updateBasic')->name('updateBasic');
        Route::post('/update/contact', 'StudentProfileController@updateContact')->name('updateContact');
        Route::post('/update/photo', 'StudentProfileController@updatephoto')->name('updatephoto');


        //user-message
        Route::post('student-message-submit', ['as' => 'user-chat.message-submit', 'uses' => 'StudentChatController@postChatMessage']);
        Route::get('student-user-search', ['as' => 'user-chat.user-search', 'uses' => 'StudentChatController@getUserSearch']);
        Route::resource('user-chat', 'StudentChatController');
        //sticky note
        Route::resource('sticky-note', 'StudentStickyNoteController');

        Route::resource('notices', 'StudentNoticesController');

        ##project files
        Route::get('project/files', 'ProjectCodesController@index')->name('files.index');
        Route::get('project/overview', 'ProjectCodesController@overview')->name('files.overview');
        Route::post('project/files', 'ProjectCodesController@store')->name('files.store');
        Route::get('project/files/download/{id}', ['uses' => 'ProjectCodesController@download'])->name('files.download');
        Route::resource('files', 'ProjectCodesController');


    });


    // Mark all notifications as read
    Route::post('mark-notification-read', ['uses' => 'NotificationController@markAllRead'])->name('mark-notification-read');
    Route::get('show-all-member-notifications', ['uses' => 'NotificationController@showAllMemberNotifications'])->name('show-all-member-notifications');
    Route::get('show-all-client-notifications', ['uses' => 'NotificationController@showAllClientNotifications'])->name('show-all-client-notifications');
    Route::get('show-all-admin-notifications', ['uses' => 'NotificationController@showAllAdminNotifications'])->name('show-all-admin-notifications');



});
Route::get('/plagiarisms', function(){
    return view('plagiarism');
});
Route::get('plagiarism', 'PlagiarismController@form');
Route::post('plagiarism/test', 'PlagiarismController@test')->name('plagiarism.test');
Route::get('/plagiarisms', function(){
    return view('plagiarism');
});

Route::post('plagiarism/callback','PlagiarismController@callback' );
Route::post('/copyleaks/callback','PlagiarismController@getCallback' );
##password resets links
Route::get('/forgot/passoword/reset', 'ForgotPasswordController@emailForm')->name('password.reset.form');
Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.getemail');
Route::post('/password/reset','ResetPasswordController@reset')->name('password.request');
Route::get('student/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('student.reset');
Route::get('coordinator/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.reset');
Route::get('supervisor/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('supervisor.reset');