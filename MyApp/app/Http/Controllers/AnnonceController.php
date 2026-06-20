<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //permet d'afficher touttes les annonces
        $query = Annonce::with(['user','category','photos']);
          if($request->search){
            $query->where('title','like','%'. $request->search .'%');
          }
        if ($request->min_price){
            $query->where('price','>=', $request->min_price);
           }

           if ($request->max_price){
            $query->where('price','<=', $request->max_price);
           }
             
           if($request->location){
            $query->where('location', $request->location);
           }
            if($request->category_id){
            $query->where('category_id', $request->category_id);
           }
        $annonces= $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();
        $locations = Annonce::distinct()->pluck('location');
        return view('annonces.index', compact('annonces','categories', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //permet d'afficher le formulaire de create
        $categories = Category::all();
        return view('annonces.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //sauvegarder
        $request->validate([
            'title'=> 'required|min:4',
            'description'=> 'required|min:20',
            'price'=> 'required|numeric|min:0',
            'location'=> 'required',
            'condition'=> 'required',
            'category_id'=> 'required',
            'photos'=> 'required',
            'photos.*'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $annonce = Annonce::create([
            'title'=> $request->title,
            'description'=> $request->description,
            'price'=> $request->price,
            'location'=> $request->location,
            'condition'=> $request->condition,
            'category_id'=> $request->category_id,
            'user_id'=>auth()->id()

        ]);

        if($request->hasFile('photos')){
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('annonces','public');
                Photo::create(
                    [
                        'annonce_id'=> $annonce->id,
                        'path'=> $path,
                    ]
                );
        }
        }
        return redirect()->route('annonces.show', $annonce->id);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $annonce = Annonce::with('user','category','photos')->findOrFail(intval($id));
        return view('annonces.show', compact('annonce'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $annonce = Annonce::with('user','category','photos')->findOrFail(intval($id));
        $categories = Category::all();
        return view('annonces.edit', compact('annonce','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        
        $request->validate([
            'title'=> 'required| min:4',
            'description'=> 'required | min:20',
            'price'=> 'required | numeric | min:0',
            'location'=> 'required',
            'condition'=> 'required',
            'category_id'=> 'required'

        ]);
        $annonce = Annonce::findOrFail($id);
        $annonce->update([
            'title'=> $request->title,
            'description'=> $request->description,
            'price'=> $request->price,
            'location'=> $request->location,
            'condition'=> $request->condition,
            'category_id'=> $request->category_id,

        ]);
        //si une image existe sur l'annonce
        if($request->hasFile('photos')){
            foreach ($annonce->photos as $photo){
                Storage::disk('public')->delete( $photo->path);
                $photo->delete();
            }

            //sauvegarder la nouvelle photo
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('annonces','public');
                Photo::create(
                    [
                        'annonce_id'=> $annonce->id,
                        'path'=> $path,
                    ]
                );
             }
        }

        

        return redirect()->route('annonces.show', $annonce->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();
        return redirect()->route('annonces.index');
    }
}
