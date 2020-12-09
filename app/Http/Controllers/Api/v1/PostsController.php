<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make(
            [
                'search' => $request->search,
                'cat_id' => $request->cat_id,
                'user_id' => $request->user_id
            ],
            [
                'cat_id' => 'nullable|numeric|exists:cats,id',
                'user_id' => 'nullable|numeric|exists:users,id'
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->errors();
            $fields = ['search', 'user_id', 'cat_id'];
            $alert = [];
            foreach ($fields as $field) {
                if ($messages->first($field) != '') {
                    $alert[] = $messages->first($field);
                }
            }
            return response()->json($alert);
        }

        $user_id = $request->user_id;
        $cat_id = $request->cat_id;
        $search = $request->search;
        $data = DB::table('posts');

        if ($user_id && $user_id != '') {
            $data = $data->where('user_id', $user_id);
        }
        if ($cat_id && $cat_id != '') {
            $data = $data->where('cat_id', $cat_id);
        }
        if ($search && $search != '') {
            $data = $data->where('content', 'like', "%$search%");
        }
        $data = $data->get();

        if ($data->count() == 0) {
            return response()->json(['message' => 'No result founded!']);
        }
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            [
                'title' => $request->title,
                'text' => $request->text,
                'cat_id' => $request->cat_id
            ],
            [
                'title' => 'required',
                'text' => 'required',
                'cat_id' => 'required|numeric|exists:cats,id'
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->errors();
            $fields = ['title', 'text', 'cat_id'];
            $alert = [];
            foreach ($fields as $field) {
                if ($messages->first($field) != '') {
                    $alert[] = $messages->first($field);
                }
            }
            return response()->json($alert);
        }

        $title = $request->title;
        $text = $request->text;
        $cat_id = $request->cat_id;
        $user_id = Auth::id();

        $post_data = ['title' => $title, 'content' => $text, 'cat_id' => $cat_id, 'user_id' => $user_id];
        $new_post = Post::create($post_data);
        if ($new_post && $new_post instanceof Post) {
            return response()->json(['message' => 'Post added successfully', 'status_code' => 200]);
        }
        return response()->json(['message' => 'Post did not add successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            [
                'title' => $request->title,
                'text' => $request->text,
                'cat_id' => $request->cat_id
            ],
            [
                'title' => 'required',
                'text' => 'required',
                'cat_id' => 'required|numeric|exists:cats,id'
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->errors();
            $fields = ['title', 'text', 'cat_id'];
            $alert = [];
            foreach ($fields as $field) {
                if ($messages->first($field) != '') {
                    $alert[] = $messages->first($field);
                }
            }
            return response()->json($alert);
        }

        $title = $request->title;
        $text = $request->text;
        $cat_id = $request->cat_id;
        $current_user_id = Auth::id();

        $post_data = ['title' => $title, 'content' => $text, 'cat_id' => $cat_id];
        $postItem = Post::find($id);
        if ($postItem && $postItem instanceof Post) {
            if ($postItem->user_id == $current_user_id) {
                $postItem->update($post_data);
                return response()->json(['message' => 'Post updated successfully', 'status_code' => 200]);
            } else {
                return response()->json(['message' => 'You do not have permission to edit other author posts', 'status_code' => 403]);
            }
        }
        return response()->json(['message' => 'Post did not update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
