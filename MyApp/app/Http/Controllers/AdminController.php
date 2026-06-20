<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $totalAnnonces = Annonce::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        return view("admin.dashboard", compact("totalAnnonces","totalCategories","totalUsers"));
    }
    
    public function annonces (){
        $annonces = Annonce::with(["user","category","photos"])->latest()->paginate(10);
        return view("admin.annonces", compact("annonces"));
    }

    public function users () {
         $users = User::latest()->paginate(10);
         return view("admin.users", compact("users"));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function isAdmin($id)
    {
        //
        $user = User::findOrFail($id);
        $user->update(['role'=>'admin']);
        return redirect()->route('admin.users')->with('success','User set to admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function removeAdmin($id)
    {
        //
        $user = User::findOrFail($id);
        $user->update(['role'=> 'user']);
        return redirect()->route('admin.users')->with('success','remove admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //pour supprimer un utilisateur
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route("admin.dashboard")->with("success","user deleted");

    }
    public function destroyAnnonce(string $id)
    {
        //pour supprimer une annonce
        $annonce = Annonce::findOrFail($id);
        foreach($annonce->photos as $photo) {
            Storage::disk("public")->delete($photo->path);    
        }
        $annonce->delete();

        return redirect()->route("admin.dashboard")->with("success","annonce deleted");
    }
}
