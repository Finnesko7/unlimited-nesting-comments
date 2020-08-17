<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentRepository
{
    const LIMIT = 10;

    public function getMainByPostId(int $id)
    {
        return Comment::where('post_id', $id)->where('main', 1)->paginate(self::LIMIT);
    }

    public function getCountSubComments(array $ids): array
    {
        return Comment::select(DB::raw('count(*) as count'), 'main_id')->whereIn('main_id', $ids)
            ->groupBy('main_id')->get()->keyBy('main_id')->toArray();
    }

    public function getSubCommentsByMainId(int $id): array
    {
        return Comment::where('main_id', $id)->get()->toArray();
    }

    public function deleteById(int $id): bool
    {
        return Comment::where('id', $id)->delete();
    }

    public function deleteByMainId(int $id): bool
    {
        return Comment::where('main_id', $id)->delete();
    }

    public function create(array $data): Comment
    {
        return Comment::create($data);
    }

    public function getById($id): ?Comment
    {
        return Comment::find($id);
    }

    public function updateParentId(int $oldId, int $newId)
    {
        return Comment::where('parent_id', $oldId)->update([
           'parent_id' => $newId
        ]);
    }
}
