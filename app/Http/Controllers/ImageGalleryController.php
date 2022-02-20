<?php

namespace App\Http\Controllers;

use App\ImageGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\Models\Media;

class ImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cover = $request->file('cover');
        $gallery = $request->gallery_image;
        $imagegallery = new ImageGallery();
        $imagegallery->title = $request->title;
        $imagegallery->description = $request->description;
        $imagegallery->photo_by = $request->photo_by;
        if ($cover) {
            $imagegallery->addMediaFromRequest('cover')
                ->usingName($request->imagename ? $request->imagename : 'image')
                ->withResponsiveImages()
                ->toMediaCollection('posts');
        }
        if ($gallery) {
            $imagegallery->addMediaFromUrl($gallery)
                ->usingName($request->imagename ? $request->imagename : 'image')
                ->withResponsiveImages()
                ->toMediaCollection('posts');
        }
        $imagegallery->save();

        return redirect()->action('ImageGalleryController@create');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ImageGallery $imageGallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = ImageGallery::with('media')->find($id);
//        dd($gallery->getFirstMedia('posts'));
//       $images = $gallery->getFirstMedia('posts');
//       dd($images, $media, $gallery);
        return view('admin.galleries.view', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ImageGallery $imageGallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = ImageGallery::with('media')->find($id);
//        dd($gallery->getFirstMedia('posts'));
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ImageGallery $imageGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageGallery $imageGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ImageGallery $imageGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageGallery $imageGallery)
    {
        //
    }

    /**
     * @param Request $request
     * @param $searchTerm
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchImage(Request $request, $searchTerm)
    {
        $images = Media::where('name', 'LIKE', '%' . $searchTerm . '%')->get();
        ////        $images = \DB::table('media')->select('')->where('cover_keyword', 'LIKE', '%' . $searchTerm . '%')->groupBy('cover')->take(10)->get();
        ////        $images = $images->map(function ($image) {
        ////            return asset(Storage::url('images/' . $image->cover));
        ////        });
        $imageurl = [];
        foreach ($images as $image) {
            $imageurl[] = $image->getURL();
        }

        return response()->json($imageurl);
    }

    public function getLatestImage()
    {
        $images = Media::latest()->take(10)->get();
        $imageurl = [];
        foreach ($images as $image) {
            $imageurl[] = $image->getUrl();
        }

        return response($imageurl);
    }
}
