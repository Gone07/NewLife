<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use http\Env\Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'])->only(['destroy']);
    }

    public function index()
    {
        $comments = Comment::paginate(10);
        return CommentResource::collection($comments);
    }

    public function store(CommentRequest $request)
    {
        $comment = Comment::create([
            'user_id' =>  auth()->user()->id,
            'item_id' => $request->item_id,
            'text' => $request->text
        ]);

            return response()->json($comment, 201);

    }

    public function show($id)
    {
        $comments = Comment::findOrFail($id);
        return new CommentResource($comments);
    }

    public function update(CommentRequest $request, $id)
    {
        $comments = Comment::findOrFail($id);
        $comments->update([
            'item_id' => $request->item_id,
            'text' => $request->text
        ]);
    }

    public function destroy($id)
    {
        $comments = Comment::findOrFail($id);
        if($comments->delete())
        {
            return response()->json($comments, 204);
        }
    }
}
