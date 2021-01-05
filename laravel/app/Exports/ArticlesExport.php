<?php 

namespace App\Exports;

// Only Data
//use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Article;
use App\Category;
use App\User;

use Auth;

// Only Data
// class UsersExport implements FromCollection
// {
//     public function collection()
//     {
//         return User::all();
//     }
// }
// With View
class ArticlesExport implements FromView
{
    public function view(): View
    {
		if(Auth::user()->role == 'admin') {
            $articles = Article::paginate(8);            
        } else if (Auth::user()->role == 'editar') {
            $articles = Article::where('user_id', Auth::user()->id)->take(8)->get();            
        }

        return view('articles.excel', [
			'users' => User::all(),
			'categories' => Category::all(),
            'articles' => $articles
        ]);
    }
}
