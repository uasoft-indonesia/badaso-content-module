<?php

namespace Uasoft\Badaso\Module\Content\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\Content\Models\Content;
use Uasoft\Badaso\Traits\FileHandler;

class ContentController extends Controller
{
    use FileHandler;

    public function browse()
    {
        try {
            $content = Content::all()->toArray();

            return ApiResponse::success($content);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function read(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|exists:Uasoft\Badaso\Module\Content\Models\Content',
            ]);

            $content = Content::where('id', $request->id)->first();

            $data = [
                'id' => $content->id,
                'slug' => $content->slug,
                'label' => $content->label,
                'value' => json_decode($content->value),
            ];

            return ApiResponse::success(['content' => $data]);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function fetch(Request $request)
    {
        try {
            $request->validate([
                'slug' => 'required|string|exists:Uasoft\Badaso\Module\Content\Models\Content',
            ]);

            $data = Content::where('slug', $request->slug)->first();

            $data->value = json_decode($data->value);

            return ApiResponse::success($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function fetchMultiple(Request $request)
    {
        try {
            $request->validate([
                'slug' => 'required|string',
            ]);

            $slugs = explode(',', $request->slug);

            $items = Content::whereIn('slug', $slugs)->get();
            $data = [];

            foreach ($items as $key => $item) {
                $data[] = json_decode($item->value);
            }

            return ApiResponse::success($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function add(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'slug' => 'required|string|unique:Uasoft\Badaso\Module\Content\Models\Content',
                'label' => 'required|string',
                'value' => 'required',
            ]);

            Content::create([
                'slug' => $request->slug,
                'label' => $request->label,
                'value' => $request->value,
            ]);

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function edit(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'id' => 'required|exists:Uasoft\Badaso\Module\Content\Models\Content',
                'slug' => 'required|string|exists:Uasoft\Badaso\Module\Content\Models\Content',
                'label' => 'required|string',
                'value' => 'required',
            ]);

            $content = Content::where('id', $request->id)->firstOrFail();
            $content->slug = $request->slug;
            $content->label = $request->label;
            $content->value = $request->value;
            $content->save();

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function fill(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'id' => 'required|exists:Uasoft\Badaso\Module\Content\Models\Content,id',
                'slug' => 'required|string|exists:Uasoft\Badaso\Module\Content\Models\Content,slug',
                'label' => 'required|string',
                'value' => 'required',
            ]);
            $collected = collect($request->value);
            $modifiedContent = (object) [];

            foreach ($collected as $key => $value) {
                if ($value['type'] === 'group') {
                    $value['data'] = $this->handleGroupTypeContent($value['data']);
                }
                $modifiedContent->{$value['name']} = (object) $value;
            }

            $content = Content::where('id', $request->id)->firstOrFail();

            $content->slug = $request->slug;
            $content->label = $request->label;
            $content->value = json_encode($modifiedContent);
            $content->save();

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'id' => 'required|exists:Uasoft\Badaso\Module\Content\Models\Content,id',
            ]);

            $content = Content::where('id', $request->id)->firstOrFail();
            $content->delete();

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function deleteMultiple(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'ids' => 'required',
            ]);

            $ids = $request->ids;
            $id_list = explode(',', $ids);
            foreach ($id_list as $id) {
                $content = Content::where('id', $id)->firstOrFail();
                $content->delete();
            }

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function handleGroupTypeContent($data)
    {
        $group = (object) [];
        foreach ($data as $groupKey => $groupValue) {
            if ($groupValue['type'] === 'group') {
                $groupValue['data'] = $this->handleGroupTypeContent($groupValue['data']);
            }

            $group->{$groupValue['name']} = (object) $groupValue;
        }

        return $group;
    }
}
