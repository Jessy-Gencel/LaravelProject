<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class NewsController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        $newsItems = News::all();
        return view('news.index', compact('newsItems'));
    }

    public function show($id)
    {
        $newsItem = News::findOrFail($id);
        return view('news.show', compact('newsItem'));
    }

    public function create()
    {
        if (!$this->authService->isAuthenticated() || !$this->authService->isAdmin()) {
            return redirect()->route('news.index')->with('error', 'Unauthorized action.');
        }

        return view('news.create');
    }

    public function store(Request $request)
    {
        if (!$this->authService->isAuthenticated() || !$this->authService->isAdmin()) {
            return redirect()->route('news.index')->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news_images', 'public');
        }

        News::create($data);

        return redirect()->route('news.index')->with('success', 'News article created successfully.');
    }

    public function edit($id)
    {
        if (!$this->authService->isAuthenticated() || !$this->authService->isAdmin()) {
            return redirect()->route('news.index')->with('error', 'Unauthorized action.');
        }

        $newsItem = News::findOrFail($id);
        return view('news.edit', compact('newsItem'));
    }

    public function update(Request $request)
    {
        if (!$this->authService->isAuthenticated() || !$this->authService->isAdmin()) {
            return redirect()->route('news.index')->with('error', 'Unauthorized action.');
        }

        $newsItem = News::find($request -> input('id'));
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $newsItem->title = $request->input('title');
        $newsItem->content = $request->input('content');

        if ($request->hasFile('image')) {
            if ($newsItem->image) {
                Storage::disk('public')->delete($newsItem->image);
            }
            $newsItem->image = $request->file('image')->store('news_images', 'public');
        }

        $newsItem->save();

        return redirect()->route('news.index')->with('success', 'News article updated successfully.');
    }

    public function destroy($id)
    {
        if (!$this->authService->isAuthenticated() || !$this->authService->isAdmin()) {
            return redirect()->route('news.index')->with('error', 'Unauthorized action.');
        }

        $newsItem = News::findOrFail($id);
        if ($newsItem->image) {
            Storage::disk('public')->delete($newsItem->image);
        }
        $newsItem->delete();
        return redirect()->route('news.index')->with('success', 'News article deleted successfully.');
    }
    public function storeComment(Request $request)
    {
        Log::info($request -> all());
        if (!$this->authService->isAuthenticated()) {
            return redirect()->route('news.index')->with('error', 'Unauthorized action.');
        }
        $request->validate([
            'news_id' => 'required|exists:news,id',
            'comment' => 'required|string',
        ]);

        Comment::create([
            'news_id' => $request->input('news_id'),
            'user_id' => Auth::id(),
            'content' => $request->input('comment'),
        ]);

        return redirect()->route('news.index')->with('success', 'Comment posted successfully.');
    }
    public function destroyComment($id)
    {
        if (!$this->authService->isAuthenticated()) {
            return redirect()->route('news.index')->with('error', 'Unauthorized action.');
        }

        $comment = Comment::find($id);

        if ($comment->user_id !== Auth::id() && !$this->authService->isAdmin()) {
            return redirect()->route('news.index')->with('error', 'Unauthorized action.');
        }

        $comment->delete();
        return redirect()->route('news.index')->with('success', 'Comment deleted successfully.');
    }
    public function updateComment(Request $request,$id)
    {
        if (!$this->authService->isAuthenticated()) {
            return redirect()->route('news.index')->with('error', 'Unauthorized action.');
        }

        $comment = Comment::find($id);

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('news.index')->with('success', 'Comment updated successfully.');
    }
}