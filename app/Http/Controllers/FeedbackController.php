<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function list(Request $request, $locale = 'vi')
    {
        $query = Feedback::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('topic')) {
            $query->where('topic', $request->topic);
        }

        $feedbacks = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('Admin.Feedback.list', compact('feedbacks'));
    }

    public function detail(Request $request, $locale = 'vi', $id = null)
    {
        $targetId = $id ?: $locale;
        $feedback = Feedback::where('_id', $targetId)->firstOrFail();
        return view('Admin.Feedback.detail', compact('feedback'));
    }

    public function update(Request $request, $locale = 'vi', $id = null)
    {
        $targetId = $id ?: $locale;
        $feedback = Feedback::where('_id', $targetId)->firstOrFail();

        $validated = $request->validate([
            'status'           => 'required|in:pending,assigned,responded',
            'assigned_to'      => 'nullable|string|max:255',
            'responder_name'   => 'nullable|string|max:255',
            'response_content' => 'nullable|string',
            'is_published'     => 'nullable|boolean',
        ]);

        $feedback->status = $validated['status'];
        $feedback->assigned_to = $validated['assigned_to'] ?? $feedback->assigned_to;
        $feedback->responder_name = $validated['responder_name'] ?? $feedback->responder_name;
        $feedback->response_content = $validated['response_content'] ?? null;
        $feedback->is_published = $request->has('is_published');

        if ($validated['status'] === 'assigned' && !$feedback->assigned_at) {
            $feedback->assigned_at = now();
        }

        if ($validated['status'] === 'responded') {
            $feedback->responded_at = now();
            if ($feedback->is_published && !$feedback->published_at) {
                $feedback->published_at = now();
            }
        }

        $feedback->save();

        return redirect()->route('admin-feedback', ['locale' => app()->getLocale()])->with('success', 'Đã cập nhật trạng thái phản hồi thành công!');
    }

    public function delete(Request $request, $locale = 'vi', $id = null)
    {
        $targetId = $id ?: $locale;
        $feedback = Feedback::where('_id', $targetId)->firstOrFail();
        $feedback->delete();

        return redirect()->route('admin-feedback', ['locale' => app()->getLocale()])->with('success', 'Đã xóa ý kiến đóng góp!');
    }
}
