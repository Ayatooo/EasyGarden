<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumReply;
use App\Models\Plant;
use App\Models\Task;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        if (auth()->user()->email !== 'louisreynard919@gmail.com' && auth()->user()->email !== 'matdinville@gmail.com') {
            return view('dashboard');
        }

        $users = User::count();
        $plants = Plant::count();
        $tasks = Task::count();
        $forumPosts = ForumPost::count();
        $replies = ForumReply::count();

        return view('admin.index', [
            'users' => $users,
            'plants' => $plants,
            'tasks' => $tasks,
            'forumPosts' => $forumPosts,
            'replies' => $replies,
        ]);
    }
}
