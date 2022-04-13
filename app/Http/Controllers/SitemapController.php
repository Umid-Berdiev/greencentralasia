<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
  public function translate(Request $request)
  {
    $myarr = [
      'title' => $request->title,
      'description' => $request->description,
      'tb_one_uz' => $request->tb_one_uz,
      'tb_two_uz' => $request->tb_two_uz,
      'tb_three_uz' => $request->tb_three_uz,
      'tb_four_uz' => $request->tb_four_uz,
      'tb_one_en' => $request->tb_one_en,
      'tb_two_en' => $request->tb_two_en,
      'tb_three_en' => $request->tb_three_en,
      'tb_four_en' => $request->tb_four_en,
      'tb_one_ru' => $request->tb_one_ru,
      'tb_two_ru' => $request->tb_two_ru,
      'tb_three_ru' => $request->tb_three_ru,
      'tb_four_ru' => $request->tb_four_ru,
      'map_target' => $request->map_target,
      'bottom_title' => $request->bottom_title,
      'bottom_table_tb_one_uz' => $request->bottom_table_tb_one_uz,
      'bottom_table_tb_two_uz' => $request->bottom_table_tb_two_uz,
      'bottom_table_tb_three_uz' => $request->bottom_table_tb_three_uz,
      'bottom_table_tb_four_uz' => $request->bottom_table_tb_four_uz,
      'bottom_table_tb_one_ru' => $request->bottom_table_tb_one_ru,
      'bottom_table_tb_two_ru' => $request->bottom_table_tb_two_ru,
      'bottom_table_tb_three_ru' => $request->bottom_table_tb_three_ru,
      'bottom_table_tb_four_ru' => $request->bottom_table_tb_four_ru,
      'bottom_table_tb_one_en' => $request->bottom_table_tb_one_en,
      'bottom_table_tb_two_en' => $request->bottom_table_tb_two_en,
      'bottom_table_tb_three_en' => $request->bottom_table_tb_three_en,
      'bottom_table_tb_four_en' => $request->bottom_table_tb_four_en,
      'rahbar' => $request->rahbar,
      'lavozim' => $request->lavozim,
      'kun' => $request->kun,
      'soat' => $request->soat,
    ];

    DB::table('translate')->insert(
      ['type' => 'contact', 'jsons' => json_encode($myarr)]
    );

    return redirect("/admin/translate");
  }

  public function translate_footer(Request $request)
  {
    $myarr = [
      'telephone' => $request->telephone,
      'devonxona' => $request->devonxona,
      'fax' => $request->fax,
      'manzil' => $request->manzil,
      'obuna' => $request->obuna,
      'email' => $request->email
    ];

    DB::table('translate')->insert(
      ['type' => 'footer', 'jsons' => json_encode($myarr)]
    );

    return redirect("/admin/translate");
  }

  public function translate_svg(Request $request)
  {
    $myarr = array();

    foreach ($request->code as $key => $val) {
      array_push($myarr, [$val => [
        'rahbar_uz' => $request->rahbar_uz[$key],
        'rahbar_ru' => $request->rahbar_ru[$key],
        'rahbar_en' => $request->rahbar_en[$key],
        'telefon' => $request->telefon[$key],
        'email' => $request->email[$key]
      ]]);
    }

    DB::table('translate')->insert(
      ['type' => 'svg', 'jsons' => json_encode($myarr)]
    );

    return redirect("/admin/translate");
  }

  public function index($lang, $type)
  {
    $lang_id = current_language()->id;
    $toreturn = array();
    $title = "";

    switch ($type) {
      case "post":
        $model = DB::table("posts")
          ->select(['posts.*', 'languages.language_name'])

          ->leftJoin("languages", "languages.id", "=", "posts.language_id")
          ->where("posts.language_id", $lang_id)

          ->orderBy('posts.id', 'desc')
          ->limit(20)->get();


        foreach ($model as $value) {
          array_push(
            $toreturn,
            [
              'title' => $value->title,
              'description' => $value->decription,
              'link' => URL(App::getLocale() . '/posts/' . $value->category_group_id . '/' . $value->group)
            ]
          );
        }

        $title = "POST";
        break;
      case "event":
        $model = DB::table("events")
          ->select(['events.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "events.language_id")
          ->where("events.language_id", $lang_id)
          ->orderBy('events.id', 'desc')
          ->limit(20)->get();

        foreach ($model as $value) {
          array_push(
            $toreturn,
            [
              'title' => $value->title,
              'description' => $value->description,
              'link' => URL(App::getLocale() . '/event/' . $value->event_category_id . '/' . $value->group)
            ]
          );
        }

        $title = "EVENT";
        break;
      case "tender":

        $model = DB::table("tenders")
          ->select(['tenders.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
          ->where("tenders.language_id", $lang_id)
          ->orderBy('tenders.id', 'desc')
          ->limit(20)->get();

        foreach ($model as $value) {
          array_push(
            $toreturn,
            [
              'title' => $value->title,
              'description' => $value->deadline,
              'link' => URL(App::getLocale() . '/event/' . $value->tender_category_id . '/' . $value->group)
            ]
          );
        }

        $title = "TENDER";
        break;
      case "photo":
        $model = DB::table("photogalleries")
          ->select(['photogalleries.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "photogalleries.language_id")
          ->where("photogalleries.language_id", $lang_id)
          ->orderBy('photogalleries.id', 'desc')
          ->limit(20)->get();

        foreach ($model as $value) {
          array_push(
            $toreturn,
            [
              'title' => $value->name,
              'description' => $value->description,
              'link' => URL(App::getLocale() . '/photo/' . $value->category_id . '/' . $value->group)
            ]
          );
        }

        $title = "PHOTO GALLERY";
        break;
      case "video":
        $model = DB::table("videogalleries")
          ->select(['videogalleries.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "videogalleries.language_id")
          ->where("videogalleries.language_id", $lang_id)
          ->orderBy('videogalleries.id', 'desc')
          ->limit(20)->get();

        foreach ($model as $value) {
          array_push(
            $toreturn,
            [
              'title' => $value->name,
              'description' => $value->description,
              'link' => URL(App::getLocale() . '/photo/' . $value->category_id . '/' . $value->group)
            ]
          );
        }

        $title = "VIDEO GALLERY";
        break;
      case "doc":
        $model = DB::table("docs")
          ->select(['docs.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "docs.language_id")
          ->where("docs.language_id", $lang_id)
          ->orderBy('docs.id', 'desc')
          ->limit(20)->get();

        foreach ($model as $value) {
          array_push(
            $toreturn,
            [
              'title' => $value->title,
              'description' => $value->link,
              'link' => URL(App::getLocale() . '/photo/' . $value->doc_category_id . '/' . $value->group)
            ]
          );
        }

        $title = "DOC";
        break;
    }

    return response()->view('ress', [
      'table' => $toreturn,
      'title' => $title,
    ])->header('Content-Type', 'text/xml');
  }
}
