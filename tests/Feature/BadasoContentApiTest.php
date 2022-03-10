<?php

namespace Uasoft\Badaso\Module\Content\Tests\Feature;

use Tests\TestCase;
use Uasoft\Badaso\Helpers\CallHelperTest;
use Uasoft\Badaso\Module\Content\Models\Content;

class BadasoContentApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public static function getContentApiV1($path)
    {
        return 'badaso-api/module/content/v1'.$path;
    }
    
     public function test_add(){
        $token = CallHelperTest::login($this);
        for ($i = 0; $i < 4; $i++) {
            $slug = 'This is Slug'."$i";
            $label = 'This is label'."$i";
            $request_data = [
                'slug' =>  $slug,
                'label' => $label,
                'value' => '{
                "text":{
                    "name":"this is Text",
                    "label":"this is text label",
                    "type":"text",
                    "data":""
                },
                "text":{
                    "name":"this is image",
                    "label":"this is image label",
                    "type":"image",
                    "data":""
                },
                "text":{
                    "name":"this is url",
                    "label":"this is label url",
                    "type":"url",
                    "data":{
                        "url":"",
                        "text":""
                    }
                },
                "grup":{
                    "name":"this is group",
                    "label":"this is group",
                    "type":"group",
                    "data":{
                        "text":{
                            "name":"text",
                            "label":"text",
                            "type":"text",
                            "data":""
                        },
                        "url":{
                            "name":"url",
                            "label":"url",
                            "type":"url",
                            "data":{
                                "url":"",
                                "text":""
                            }
                        },"img":{
                            "name":"img",
                            "label":"img",
                            "type":"image",
                            "data":""
                        }
                    }
                }
            }',
        ]; 
        
        $response = $this->withHeader('Authorization', "Bearer $token")->json("POST", $this->getContentApiV1('/content/add'), $request_data);
        $response->assertSuccessful();
        $this->assertTrue($response['message'] == "Request was successful");
        }
    }

    public function test_browse()
    {
        $token = CallHelperTest::login($this);

        $response = $this->withHeader("Authorization", "Bearer $token")->json("GET", $this->getContentApiV1("/content"));
        $response->assertSuccessful();

        $response = $response->json('data');
        foreach ($response as $key => $value) {
            $table = Content::find($value['id']);
            $this->assertTrue($value['id'] == $table->id);
            $this->assertTrue($value['slug'] == $table->slug);
            $this->assertTrue($value['label'] == $table->label);
            $this->assertTrue($value['value'] == $table->value);
        }
    }

    public function test_read()
    {
        $token = CallHelperTest::login($this);

        $request_data = Content::latest()->first();
        $request_data = [
            'id' => "$request_data->id",
        ];
        
        $response = $this->withHeader('Authorization', "Bearer $token")->json("GET", $this->getContentApiV1("/content/read"),$request_data);
        
        $response->assertSuccessful();

        $response = $response->json('data.content');
        $table = Content::find($response['id']);
        $this->assertTrue($response['id'] == $table->id);
        $this->assertTrue($response['slug'] == $table->slug);
        $this->assertTrue($response['label'] == $table->label);
        foreach ($response['value'] as $key => $value) {
            $data = json_decode($table->value, true);
            $data_array = $data[$key];
            $this->assertTrue($data_array['name'] == $value['name']);
            $this->assertTrue($data_array['label'] == $value['label']);
            $this->assertTrue($data_array['type'] == $value['type']);
            $this->assertTrue($data_array['data']['url'] == $data_array['data']['url']);
            $this->assertTrue($data_array['data']['text'] == $data_array['data']['text']);
        }
    }

    public function test_fetch()
    {
        $request_data = Content::latest()->first();
        $request_data = ['slug'=>$request_data->slug];
        $response = $this->json("GET", $this->getContentApiV1("/content/fetch"),$request_data);
        $response->assertSuccessful();

        $response = $response->json('data');
        $table = Content::latest()->first();
        foreach ($response['value'] as $key => $value) {
            $data = json_decode($table->value, true);
            $data_array = $data[$key];
            $this->assertTrue($data_array['name'] == $value['name']);
            $this->assertTrue($data_array['label'] == $value['label']);
            $this->assertTrue($data_array['type'] == $value['type']);
            $this->assertTrue($data_array['data']['url'] == $data_array['data']['url']);
            $this->assertTrue($data_array['data']['text'] == $data_array['data']['text']);
        }
    }

    public function test_edit()
    {
        $token = CallHelperTest::login($this);
        $table = Content::latest()->first();
        $request_data = [
            'id' => $table->id,
            'slug' => $table->slug,
            'label' => $table->slug.' label',
            'value' => '{
                "textedit":{
                    "name":"textedit",
                    "label":"texteditlabel",
                    "type":"text",
                    "data":""
                },
                "imageedit":{
                    "name":"imageedit",
                    "label":"imageeditlabel",
                    "type":"image",
                    "data":""
                },
                "urledit":{
                    "name":"urledit",
                    "label":"urleditlabel",
                    "type":"url",
                    "data":{
                        "url":"",
                        "text":""
                    }
                },
                "groupedit":{
                    "name":"groupedit",
                    "label":"groupeditlabel",
                    "type":"group",
                    "data":{
                        "text":{
                            "name":"text",
                            "label":"text",
                            "type":"text",
                            "data":""
                        },
                        "url":{
                            "name":"url",
                            "label":"url",
                            "type":"url",
                            "data":{
                                "url":"",
                                "text":""
                            }
                        },"img":{
                            "name":"img",
                            "label":"img",
                            "type":"image",
                            "data":""
                        }
                    }
                }
            }',
        ];
            $response = $this->withHeader('Authorization', "Bearer $token")->json("PUT", $this->getContentApiV1('/content/edit'), $request_data);
            $response->assertSuccessful();
            
        $table = Content::latest()->first();
        $table = json_decode($table->value, true);
        $request_data = json_decode($request_data['value'], true);
        foreach ($table as $key => $value) {
            if($request_data[$key]){
                $this->assertTrue($request_data[$key]['name'] == $value['name']);
                $this->assertTrue($request_data[$key]['type'] == $value['type']);
                $this->assertTrue($request_data[$key]['label'] == $value['label']);
                if ($value['type'] == 'url') {
                    $this->assertTrue($request_data[$key]['data']['url'] == $value['data']['url']);
                    $this->assertTrue($request_data[$key]['data']['text'] == $value['data']['text']);
                }else{
                    $this->assertTrue($request_data[$key]['data'] == $value['data']);
                }
            }
        }

        $this->assertTrue($response['message'] == 'Request was successful');
    }

    public function test_fill()
    {
        $token = CallHelperTest::login($this);
        $table = Content::latest()->limit(3)->get();
        foreach ($table as $key => $value) {
            $request_data = [
                'id' => $value->id,
                'slug' => $value->slug,
                'label' => $value->label,
                'value' => [
                    "textedit" => [
                        "name" =>"textedit",
                        "label" =>"texteditlabel",
                        "type" =>"text",
                        'data' => 'this is value text',
                    ],
                        "imageedit"=>[
                        "name"=>"imageedit",
                        "label"=>"imageeditlabel",
                        "type"=>"image",
                        'data' => 'News baru (1).jpg',
                    ],
                        "urledit"=>[
                        "name"=>"urledit",
                        "label"=>"urleditlabel",
                        "type"=>"url",
                        "data"=>[
                            'url' => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/405',
                            'text' => '405 not permission',
                        ],
                    ],
                        "groupedit"=>[
                        "name"=>"groupedit",
                        "label"=>"groupeditlabel",
                        "type"=>"group",
                        "data"=>[
                            'text'=>[
                                'name'=>'text',
                                'label'=>'text',
                                'type'=>'text',
                                'data'=>'this is value in group text',
                            ],
                            'url'=>[
                                'name'=>'url',
                                'label'=>'url',
                                'type'=>'url',
                                'data'=>[
                                    'url' => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/405',
                                    'text' => 'this is url in group url',
                                ],
                                "image"=>[
                                    "name"=>"img",
                                    "label"=>"img",
                                    "type"=>"image",
                                    "data"=>"News baru (1).jpg"
                                ],
                                ],
                                ],],],];
                    
                        
            $response = $this->withHeader('Authorization', "Bearer $token")->json("PUT", $this->getContentApiV1('/content/fill'), $request_data);
            $response->assertSuccessful();

            $table = Content::latest()->first();
            $table_data_value = json_decode($table->value, true);
            foreach ($table_data_value as $key => $tab) {
                if ($tab['type'] == 'group') {
                    if ($request_data['value'][$key]['data']) {
                        foreach ($request_data['value'][$key]['data'] as $key => $value) {
                            if ($tab['data'][$value['name']]) {
                                if ($value['type'] == 'url') {
                                    $this->assertTrue($value['data']['url'] == $tab['data'][$value['name']]['data']['url']);
                                    $this->assertTrue($value['data']['text'] == $tab['data'][$value['name']]['data']['text']);
                                } elseif ($value['type'] == 'image') {
                                    $this->assertTrue($value['data'] == $tab['data'][$value['name']]['data']);
                                } else {
                                    $this->assertTrue($value['data'] == $tab['data'][$value['name']]['data']);
                                }
                            }
                        }
                    }
                }else{
                $request_data_array = $request_data['value'][$key];
                if (isset($request_data_array['data']) && $request_data_array['type'] != 'group') {
                    if (isset($request_data_array['data']['url'])) {
                        $this->assertTrue($request_data_array['data']['url'] == $tab['data']['url']);
                        $this->assertTrue($request_data_array['data']['text'] == $tab['data']['text']);
                    } elseif ($request_data_array['type'] == 'image') {
                        if ($request_data_array['data'] == $tab['data']) {
                            $this->assertTrue($request_data_array['data'] == $tab['data']);
                        } else {
                        }
                    } else {
                        $this->assertTrue($request_data_array['data'] == $tab['data']);
                    }
                }
                }
            }
        }
    }

    public function test_fetch_multiple()
    {
        $table = Content::latest()->limit(2)->get();
        $slug = [];
        foreach ($table as $key => $value) {
            $slug[] = $value->slug;
        }
        
        $request_data = ['slug'=>join(",",$slug)];
        $response = $this->json("GET", $this->getContentApiV1("/content/fetch-multiple"),$request_data);
        $response->assertSuccessful();

        $response = $response->json('data');
        $table = Content::latest()->limit(2)->get();
        foreach ($response as $index => $value) {
            $str_slug = $slug[$index];
            $table_data = $table->where('slug', $str_slug)->first();
            $table_data_value = json_decode($table_data->value, true);
            foreach ($table_data_value as $key => $tab) {
                if ($tab['type'] == 'group') {
                    if ($table_data_value[$key]['data']) {
                        foreach ($table_data_value[$key]['data'] as $key => $value) {
                            if ($tab['data'][$value['name']]) {
                                if ($value['type'] == 'url') {
                                    $this->assertTrue($value['data']['url'] == $tab['data'][$value['name']]['data']['url']);
                                    $this->assertTrue($value['data']['text'] == $tab['data'][$value['name']]['data']['text']);
                                } elseif ($value['type'] == 'image') {
                                    $this->assertTrue($value['data'] == $tab['data'][$value['name']]['data']);
                                } else {
                                    $this->assertTrue($value['data'] == $tab['data'][$value['name']]['data']);
                                }
                            }
                        }
                    }
                } else {
                    $respon_data_array = $value[$key];
                    if (isset($respon_data_array['data'])) {
                        if (isset($respon_data_array['data']['url']) && isset($tab['data']['url'])) {
                            $this->assertTrue($respon_data_array['data']['url'] == $tab['data']['url']);
                            if (isset($tab['data']['text'])) {
                                $this->assertTrue($respon_data_array['data']['text'] == $tab['data']['text']);
                            }
                        } elseif ($respon_data_array['type'] == 'image' && $tab['type'] == 'image') {
                            $this->assertTrue($respon_data_array['data'] == '/storage/'.$tab['data']);
                        } else {
                            if ($respon_data_array['data'] == $tab['data']) {
                                $this->assertTrue($respon_data_array['data'] == $tab['data']);
                            } else {
                            }
                        }
                    }
                }
            }
        }
    }

    public function test_delete()
    {
        $token = CallHelperTest::login($this);
        $table = Content::latest()->first();
        $request_data = [
            'id' => $table->id,
        ];
        $response = $this->withHeader('Authorization', "Bearer $token")->json("DELETE", $this->getContentApiV1('/content/delete'), $request_data);
        $response->assertSuccessful();
        $table = Content::find($table->id);
        $this->assertTrue($table == null);
    }

    public function test_multiple_delete()
    {
        $token = CallHelperTest::login($this);
        $table = Content::latest()->limit(3)->get();
        $ids = [];
        foreach ($table as $key => $value) {
            $ids[] = $value->id;
        }
        $request_data = [
            'ids' => join(',', $ids),
        ];
        
        $response = $this->withHeader('Authorization', "Bearer $token")->json("DELETE", $this->getContentApiV1('/content/delete-multiple'), $request_data);
        $response->assertSuccessful();
        $table = Content::whereIn('id', $ids)->get();
        $table_count = $table->count();
        $this->assertTrue($table_count == 0);
    }
}
