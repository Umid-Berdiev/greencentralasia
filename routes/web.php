<?php

use App\Http\Controllers\Admin\DocumentCategoryController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GcaInfoController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LinksController;
use App\Http\Controllers\Admin\PageCategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PhotoCategoryController;
use App\Http\Controllers\Admin\PhotoController as AdminPhotoController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RaxbariyatController;
use App\Http\Controllers\Admin\SorovnomaatterController;
use App\Http\Controllers\Admin\SorovnomaController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\TendercategoryController;
use App\Http\Controllers\Admin\TenderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoalbumController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\YearsController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  return view('welcome');
});

require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::match(['get', 'post'], 'register', function () {
//   return redirect('/');
// });

Route::post('/contact_post', [FormController::class, 'contact_post']);
Route::post('/send_post', [FormController::class, 'store']);
Route::post('/check', [FormController::class, 'check']);
Route::post('/cv_form_post', [CvController::class, 'store']);
Route::post('/obuna', [FormController::class, 'obuna']);

// Download Route
Route::get('download/{filename}', function ($filename) {
  // Check if file exists in app/storage/file folder
  $file_path = '/storage/app/' . $filename;
  if (file_exists($file_path)) {
    // Send Download
    return Response::download($file_path, $filename, [
      'Content-Length: ' . filesize($file_path)
    ]);
  } else {
    // Error
    exit('Requested file does not exist on our server!');
  }
})->where('filename', '[A-Za-z0-9\-\_\.]+');

#### front ##
Route::get('/', function () {
  return redirect("/en");
});

Route::get('locale/{locale}', function ($locale) {
  // app()->setLocale($locale);
  session()->put('locale', $locale);
  return redirect()->back();
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

### admin routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
  Route::get('/', function () {
    return redirect(route('posts.index'));
  })->name('post');

  // MenuBuilder::routes();

  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
  Route::resource('documents', DocumentController::class);
  Route::resource('photos', AdminPhotoController::class);
  Route::resource('video', AdminVideoController::class);
  Route::resource('videoalbum', VideoalbumController::class);
  Route::resource('event-categories', EventCategoryController::class);
  Route::resource('photo-categories', PhotoCategoryController::class);
  Route::resource('events', EventController::class);
  Route::resource('page-categories', PageCategoryController::class);
  Route::resource('pages', PageController::class);
  Route::resource('languages', LanguageController::class);
  Route::resource('post-categories', PostCategoryController::class);
  Route::resource('posts', PostController::class);
  Route::resource('document-categories', DocumentCategoryController::class);
  Route::resource('statistics', StatisticsController::class);

  Route::get('tendercategory', [TendercategoryController::class, 'index'])->name('tendercategory');
  Route::post('tendercategory/edit', [TendercategoryController::class, 'Update']);
  Route::get('tendercategory/edit', [TendercategoryController::class, 'UpdateShow'])->name('tendercategory_edit');
  Route::get('tendercategory/delete', [TendercategoryController::class, 'Delete'])->name('tendercategory_delete');
  Route::get('tendercategory/create', [TendercategoryController::class, 'InsertShow'])->name('tendercategory_create');
  Route::post('tendercategory/insert', [TendercategoryController::class, 'Insert']);

  Route::get('tender', [TenderController::class, 'index'])->name('tender');
  Route::post('tender/edit', [TenderController::class, 'Update']);
  Route::get('tender/edit', [TenderController::class, 'UpdateShow'])->name('tender_edit');
  Route::get('tender/delete', [TenderController::class, 'Delete'])->name('tender_delete');
  Route::get('tender/create', [TenderController::class, 'InsertShow'])->name('tender_create');
  Route::post('tender/insert', [TenderController::class, 'Insert']);

  Route::get('sorov', [SorovnomaController::class, 'index'])->name('sorov');
  Route::post('sorov/edit', [SorovnomaController::class, 'Update']);
  Route::get('sorov/edit', [SorovnomaController::class, 'UpdateShow'])->name('sorov_edit');
  Route::get('sorov/delete', [SorovnomaController::class, 'Delete'])->name('sorov_delete');
  Route::get('sorov/create', [SorovnomaController::class, 'InsertShow'])->name('sorov_create');
  Route::post('sorov/insert', [SorovnomaController::class, 'Insert']);

  Route::get('sorovatter', [SorovnomaatterController::class, 'index']);
  Route::post('sorovatter/edit', [SorovnomaatterController::class, 'Update']);
  Route::get('sorovatter/edit', [SorovnomaatterController::class, 'UpdateShow']);
  Route::get('sorovatter/delete', [SorovnomaatterController::class, 'Delete']);
  Route::get('sorovatter/create', [SorovnomaatterController::class, 'InsertShow']);
  Route::post('sorovatter/insert', [SorovnomaatterController::class, 'Insert']);

  Route::get('contact/delete/{id}', [FormController::class, 'destroy'])->name('contact.destroy');
  Route::get('contact/delete', [FormController::class, 'delete'])->name('contact.delete');
  Route::get('contact', [FormController::class, 'indexContact']);
  Route::post('contact/search', [FormController::class, 'ContactSearch']);
  Route::get('cv', [FormController::class, 'indexCV'])->name('cv');
  Route::get('cv/search', [FormController::class, 'CvSearch'])->name('cv_search');
  Route::get('murojat/search', [FormController::class, 'murojatSearch'])->name('murojat_search');
  Route::get('cv/{id}', [FormController::class, 'indexCVedit'])->name('cv_edit');
  Route::post('cv_update', [FormController::class, 'cvSave']);
  Route::post('murojat_update', [FormController::class, 'murojat_update']);
  Route::get('murojat', [FormController::class, 'indexMurojat'])->name('murojat');
  Route::get('murojat/{id}', [FormController::class, 'Murojat_edit']);

  // menu
  Route::get('menu', [MenuController::class, 'index'])->name('menu');
  Route::get('menu/edit', [MenuController::class, 'editshow'])->name('menu_edit');
  Route::get('menu/edits', [MenuController::class, 'edits'])->name('menu_edits');
  Route::get('menu/{id}', [MenuController::class, 'indexx'])->name('menu_id');
  Route::get('menuchange', [MenuController::class, 'orderchange'])->name('menu_change');
  Route::get('menudelete', [MenuController::class, 'destroy'])->name('menu_destroy');
  Route::post('menubuilder/insert', [MenuController::class, 'Insert']);
  Route::put('menubuilder', [MenuController::class, 'update']);

  // user
  Route::get('users', [UserController::class, 'getUsers'])->name('users');
  Route::get('users/create', [UserController::class, 'create'])->name('users_create');
  Route::get('users/show', [UserController::class, 'Show'])->name('users_edit');
  Route::post('users/store', [UserController::class, 'Store']);
  Route::post('users/update', [UserController::class, 'Update']);
  Route::post('users/profile_update', [UserController::class, 'profile_update']);
  Route::get('users/delete', [UserController::class, 'destroy']);
  Route::get('users/profile', [UserController::class, 'Profile']);

  Route::post('raxbariyat/store', [RaxbariyatController::class, 'store']);
  Route::get('raxbariyat', [RaxbariyatController::class, 'index'])->name('raxbariyat');
  Route::get('raxbariyat/create', [RaxbariyatController::class, 'create'])->name('raxbariyat_create');
  Route::get('raxbariyat/edit', [RaxbariyatController::class, 'edit'])->name('raxbariyat_edit');
  Route::post('raxbariyat/update', [RaxbariyatController::class, 'update']);
  Route::get('raxbariyat/delete', [RaxbariyatController::class, 'destroy']);

  Route::get('links/categories', [LinksController::class, 'indexCategories'])->name('links_categories');
  Route::get('links/categories/create', [LinksController::class, 'createCategories'])->name('links_categories_create');
  Route::get('links/categories/edit', [LinksController::class, 'editCategories'])->name('links_categories_edit');
  Route::get('links/categories/delete', [LinksController::class, 'categories_destroy']);
  Route::post('links/categories/store', [LinksController::class, 'categories_store']);
  Route::post('links/categories/update', [LinksController::class, 'categories_update']);

  Route::get('links', [LinksController::class, 'index'])->name('links');
  Route::get('links/create', [LinksController::class, 'create'])->name('links_create');
  Route::post('links/store', [LinksController::class, 'store']);
  Route::get('links/edit', [LinksController::class, 'edit'])->name('links_edit');
  Route::post('links/update', [LinksController::class, 'update']);
  Route::get('links/delete', [LinksController::class, 'destroy']);

  Route::get('years', [YearsController::class, 'index'])->name('years');
  Route::get('years/create', [YearsController::class, 'create'])->name('years_create');
  Route::get('years/edit', [YearsController::class, 'edit'])->name('years_edit');
  Route::post('years/store', [YearsController::class, 'store']);
  Route::post('years/update', [YearsController::class, 'update']);
  Route::get('years/delete', [YearsController::class, 'destroy']);

  Route::prefix('gcainfo')->group(function () {
    Route::get('/', [GcaInfoController::class, 'index'])->name('gca.info.index');
    Route::get('edit/{id}', [GcaInfoController::class, 'edit'])->name('gca.info.edit');
    // Route::get('get', [GcaInfoController::class, 'get'])->name('gca.info.get');
    Route::post('update', [GcaInfoController::class, 'update'])->name('gca.info.update');
  });

  Route::get('translate', function () {
    return view('admin/translate');
  })->name('translate');
  Route::post('translate', [SitemapController::class, 'translate']);
  Route::post('translate_footer', [SitemapController::class, 'translate_footer'])->name('murojat_xxx');
  Route::post('translate_svg', [SitemapController::class, 'translate_svg'])->name('murojat_xx');
});
### end admin routes

Route::post('/vote', [SorovnomaController::class, 'vote'])->name('vote');

Route::group(['prefix' => '{locale}', 'middleware' => ['locale']], function () {
  Route::get('/', [FrontController::class, 'index'])->name('front_index');
  Route::post('/new-obuna', [MailController::class, 'newObuna'])->name('new-obuna');
  // pssword forgot routes
  Route::any('forgot-password', [UserController::class, 'forgotPassword'])->name('forgot-password');
  Route::any('send-password', [UserController::class, 'sendPassword'])->name('send-password');

  Route::get('get', [GcaInfoController::class, 'get'])->name('gca.info.get');
  Route::get('/rss/{str}', [SitemapController::class, 'index']);
  Route::get('/map', function () {
    return view('map');
  });
  Route::get('/page/{category_id}/{id}', [FrontController::class, 'page'])->name('front_page');
  Route::get('/page/{category_id}', [FrontController::class, 'pages']);
  Route::get('/post/{category_id}/{id}', [FrontController::class, 'pages']);
  Route::get('/tenders/filter', [SearchController::class, 'TenderFilter']);
  Route::get('/events/filter', [SearchController::class, 'EventFilter']);

  Route::post('/postf/filter', [NewsController::class, 'PostsFilter']);
  Route::get('/postf/filter', [NewsController::class, 'PostsFilter']);
  Route::get('/search', [SearchController::class, 'index'])->name('search');
  Route::get('/posts/{id}', [NewsController::class, 'index'])->name('news');
  Route::get('/posts/{id}/{title}', [NewsController::class, 'indexin'])->name('newsin');
  Route::get('/news/images/{id}', [NewsController::class, 'download'])->name('nimage');

  Route::get('/{page}/{id}', [SearchController::class, 'allin'])->name('pagesall');
  Route::get('/{page}/{id}/{ids}', [SearchController::class, 'allinin'])->name('pagesallin');
  Route::get('/downloads', [SearchController::class, 'download']);
  Route::get('/statistics', [FrontController::class, 'getStatistika']);
  Route::get('/raxbariyat', [FrontController::class, 'getRaxbariyat']);
  Route::get('/cv_form', [CvController::class, 'index']);
  Route::get('/send', [FormController::class, 'index']);
  Route::get('/getsorov', [SearchController::class, 'sorov'])->name('jsonsorov');
  Route::get('/contact', [FormController::class, 'contact']);
  Route::get('/video', [VideoController::class, 'ViewVideo']);
  Route::get('/photo', [PhotoController::class, 'ViewPhoto']);
  Route::get('/obuna/delete', [FormController::class, 'deleteObune']);
  Route::post('/errorpage', [FormController::class, 'orpho']);

  Route::get('events', [EventController::class, 'getEvents']);
  Route::get('event', [EventController::class, 'getEvent']);
});
### end front ###
