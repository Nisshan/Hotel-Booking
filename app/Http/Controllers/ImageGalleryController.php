<?php

namespace App\Http\Controllers;

use App\ImageGallery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImageGalleryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig|FileCannotBeAdded
     */
    public function store(Request $request): RedirectResponse
    {
        $cover = $request->file('cover');
        $gallery = $request->gallery_image;
        $imagegallery = new ImageGallery();
        $imagegallery->title = $request->title;
        $imagegallery->description = $request->description;
        $imagegallery->photo_by = $request->photo_by;
        if ($cover) {
            $imagegallery->addMediaFromRequest('cover')
                ->usingName($request->imagename ?: 'image')
                ->withResponsiveImages()
                ->toMediaCollection('posts');
        }
        if ($gallery) {
            $imagegallery->addMediaFromUrl($gallery)
                ->usingName($request->imagename ?: 'image')
                ->withResponsiveImages()
                ->toMediaCollection('posts');
        }
        $imagegallery->save();

        return redirect()->action('ImageGalleryController@create');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        return view('admin.galleries.view', [
            'gallery' => ImageGallery::with('media')->find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        return view('admin.galleries.edit', [
            'gallery' => ImageGallery::with('media')->find($id),
        ]);
    }

    /**
     * @param string $searchTerm
     * @return JsonResponse
     */
    public function searchImage(string $searchTerm): JsonResponse
    {
        $images = Media::where('name', 'LIKE', '%' . $searchTerm . '%')->get();

        $imageurl = [];
        foreach ($images as $image) {
            $imageurl[] = $image->getURL();
        }

        return response()->json($imageurl);
    }

    /**
     * @return Response
     */
    public function getLatestImage(): Response
    {
        $images = Media::latest()->take(10)->get();
        $imageurl = [];
        foreach ($images as $image) {
            $imageurl[] = $image->getUrl();
        }

        return response($imageurl);
    }
}
