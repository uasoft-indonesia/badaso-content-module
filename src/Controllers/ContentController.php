<?php

namespace Uasoft\Badaso\Module\Content\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
                'id'    => $content->id,
                'slug'  => $content->slug,
                'label' => $content->label,
                'value' => $content->value,
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
                'slug' => 'required|string|exists:Uasoft\Badaso\Module\Content\Models\Content',
            ]);

            $slugs = explode(',', $request->slug);

            $items = Content::whereIn('slug', $slugs)->get();

            $data = [];

            foreach ($items as $key => $item) {
                $data = $item;
                $data->value = json_decode($item->value);
            }

            return ApiResponse::success($data->toArray());
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function add(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'slug'  => 'required|string|unique:Uasoft\Badaso\Module\Content\Models\Content',
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
                'id'    => 'required|exists:Uasoft\Badaso\Module\Content\Models\Content',
                'slug'  => 'required|string|unique:Uasoft\Badaso\Module\Content\Models\Content',
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
                'id'    => 'required|exists:Uasoft\Badaso\Module\Content\Models\Content,id',
                'slug'  => 'required|string|exists:Uasoft\Badaso\Module\Content\Models\Content,slug',
                'label' => 'required|string',
                'value' => 'required',
            ]);
            $collected = collect($request->value);
            $modifiedContent = (object) [];

            foreach ($collected as $key => $value) {
                if ($value['type'] === 'image') {
                    if (isset($value['data']) && is_array($value['data']) && ! empty($value['data'])) {
                        $fileName = $this->handleUploadFiles($value['data']);
                        $value['data'] = $fileName;
                    }
                }
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

    /**
     * @param $data = [
     *      name,
     *      base64
     * ];
     *
     * @return string $fileName
     */
    public function handleUploadFiles(array $data)
    {
        try {
            /*
             * Separate the base64 from its file type.
             */
            @[$type, $file_data] = explode(';', $data['base64']);

            /*
             * Separate the base64 from the base64 label.
             */
            @[, $file_data] = explode(',', $file_data);

            /**
             * Get storage/app/public path.
             */
            $destinationPath = storage_path('app/public/');

            /**
             * Get timestamp for unique file name.
             */
            $timestamp = explode('.', Carbon::now()->getPreciseTimestamp(3))[0];

            /**
             * Join the timestamp with modified file name (lowercase, remove whitespace
             * and replace with underscore).
             */
            $fileName = $timestamp.'_'.strtolower(str_replace(' ', '_', $data['name']));

            /*
             * Put the file to destination path with defined filename and with base64 content.
             */

            if (config('badaso.storage.disk') == 's3') {
                Storage::disk('s3')->put(''.$fileName, base64_decode($file_data), 'public');
            }

            if (config('badaso.storage.disk') == 'public') {
                file_put_contents($destinationPath.$fileName, base64_decode($file_data));
            }

            return $fileName;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function handleGroupTypeContent($data)
    {
        $group = (object) [];
        foreach ($data as $groupKey => $groupValue) {
            if ($groupValue['type'] === 'image') {
                if (isset($groupValue['data']) && is_array($groupValue['data']) && ! empty($groupValue['data'])) {
                    $fileName = $this->handleUploadFiles($groupValue['data']);
                    $groupValue['data'] = $fileName;
                }
            }

            if ($groupValue['type'] === 'group') {
                $groupValue['data'] = $this->handleGroupTypeContent($groupValue['data']);
            }

            $group->{$groupValue['name']} = (object) $groupValue;
        }

        return $group;
    }
}
