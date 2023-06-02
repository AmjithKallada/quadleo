<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::get();
        $tags = Tag::get();
        if ($request->ajax()) {
            $data = Book::leftJoin('categories','categories.id','=','books.category_id')
                        ->leftJoin('tags','tags.book_id','=','books.id');
                        if ($request->has('searchKey') && $request->filled('searchKey')) {
                            $data = $data->where('books.name','LIKE','%'.$request->searchKey.'%');
                        }

                        if ($request->has('category') && $request->filled('category')) {
                            $data = $data->where('category_id','=',$request->category);
                        }

                        if ($request->has('tag') && $request->filled('tag')) {
                            $data = $data->whereIn('id','=',$request->tag);
                        }
                        $data = $data->select('books.name as book','books.category_id','categories.name as category','tags.tag')
                        ->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('book-name',function($row){
                        return $row->book;
                    })
                    ->addColumn('category',function($row){
                        return $row->category;
                    })
                    ->addColumn('tag',function($row){
                        return $row->tag;
                    })
                    ->addColumn('status',function($row){
                        if($row->status == 1)
                        {
                            $btn = '<label style="color:green;">Available</label>';
                        }else{
                            $btn = '<label style="color:green;">Available</label>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['status'])
                    ->make(true);
        }

        return view('index',compact('categories','tags'));
    }
}
