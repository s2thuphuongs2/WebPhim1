<?php
//Location: app\Http\Controllers\IndexController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Genre;
use App\Country;
use App\Movie;
use App\Episode;

class IndexController extends Controller
{
    public function home()
    {
        $category = Category::orderBy('id', 'desc')->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        return view('pages.home', compact('category', 'genre', 'country'));
    }
    public function category()
    {

        return view('pages.category');
    }
    public function genre()
    {
        return view('pages.genre');
    }
    public function country()
    {
        return view('pages.country');
    }
    public function movie()
    {
        return view('pages.movie');
    }
    public function watch()
    {
        return view('pages.watch');
    }
    public function episode()
    {
        return view('pages.episode');
    }

}
