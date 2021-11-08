<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::paginate(10);
        return CommentResource::collection($comments);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $comments = new Comment();
        $comments->user = $request->user;
        $comments->text = $request->text;
        if($comments->save())
        {
            return new CommentResource($comments);
        }
    }

    public function show($id)
    {
        $comments = Comment::findOrFail($id);
        return new CommentResource($comments);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $comments = Comment::findOrFail($id);
        $comments->user = $request->user;
        $comments->text = $request->text;
        if($comments->save())
        {
            return new CommentResource($comments);
        }
    }

    public function destroy($id)
    {
        $comments = Comment::findOrFail($id);
        if($comments->delete())
        {
            return new CommentResource($comments);
        }
    }
}
