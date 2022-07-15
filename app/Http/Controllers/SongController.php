<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static $wrap = 'song';
    public function index()
    {
       $songs = Song::all();
       $mySongs = array();
       foreach($songs as $song){
           array_push($mySongs, new SongResource($song));
       }
      
       return $mySongs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'=>'required|String|max:255',
            'author_id'=>'required',
            'category_id'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $song = new Song;
        $song->title = $request->title;
        $song->author_id = $request->author_id;
        $song->category_id = $request->category_id;
        $song->user_id = Auth::user()->id;

        $song->save();

        return response()->json(['Song is created!', new SongResource($song)]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $songs)
    {
         
          return new SongResource($songs);
    }

    public function getByAuthor($author_id){
        $songs = Song::get()->where('author_id', $author_id);
        
        if(count($songs) == 0){
            return response()->json('There is no songs with this author!');
        }

        $mySongs = array();
        foreach($songs as $song){
            array_push($mySongs, new SongResource($song));
        }

        return $mySongs;
    }

    public function mySongs(Request $request){
        $songs = Song::get()->where('user_id', Auth::user()->id);
        if(count($songs) == 0){
            return 'There are no songs in your library!';
        }

        $mySongs = array();
        foreach($songs as $song){
            array_push($mySongs, new SongResource($song));
        }

        return $mySongs;
    }

    public function getByCategory($category_id){
        $songs = Song::get()->where('category_id', $category_id);
        if(count($songs) == 0){
            return response()->json('There is no songs with this category!');
        }

        $mySongs = array();
        foreach($songs as $song){
            array_push($mySongs, new SongResource($song));
        }

        return $mySongs;
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */

   
    public function update(Request $request, Song $songs)
    {
        $validator = Validator::make($request->all(),[
            'title'=>'required|String|max:255',
            'author_id'=>'required',
            'category_id'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $songs->title = $request->title;
        $songs->author_id = $request->author_id;
        $songs->category_id = $request->category_id;
        $songs->user_id = Auth::user()->id;

        $result = $songs->update();

        if($result == false){
            return response()->json('Error updating song!');
        }

        return response()->json(['Song is updated!', new SongResource($songs)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Songs  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $songs)
    {
        // print($songs);
        $songs->delete();

        return response()->json('Song '.$songs->title .'is deleted!');
    }
}
