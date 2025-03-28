<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use Illuminate\View\View;

class ForumController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        return view('forum.index');
    }

    /**
     * @param ForumPost $postId
     * @return View
     */
    public function show(ForumPost $postId): View
    {
        return view('forum.show', ['forumPost' => $postId]);
    }
}
