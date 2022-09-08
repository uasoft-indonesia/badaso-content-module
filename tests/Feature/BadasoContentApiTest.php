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

    public function test_add()
    {
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
                },
                "array":{
                    "name":"this is array",
                    "label":"this is array",
                    "type":"array",
                    "data":[
                            {
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
                            },"grup":{
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
                        }                                 
                    ]
                }
            }',
            ];

            $response = $this->withHeader('Authorization', "Bearer $token")->json('POST', $this->getContentApiV1('/content/add'), $request_data);
            $response->assertSuccessful();
            $this->assertTrue($response['message'] == 'Request was successful');
        }
    }

    public function test_browse()
    {
        $token = CallHelperTest::login($this);

        $response = $this->withHeader('Authorization', "Bearer $token")->json('GET', $this->getContentApiV1('/content'));
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

        $response = $this->withHeader('Authorization', "Bearer $token")->json('GET', $this->getContentApiV1('/content/read'), $request_data);

        $response->assertSuccessful();

        $response = $response->json('data.content');
        $table = Content::find($response['id']);
        $this->assertTrue($response['id'] == $table->id);
        $this->assertTrue($response['slug'] == $table->slug);
        $this->assertTrue($response['label'] == $table->label);
        foreach ($response['value'] as $key => $values) {
            $data = json_decode($table->value, true);
            $data_array = $data[$key];
            if ($values['type'] == 'array') {
                foreach ($values['data'][0] as $key => $value) {
                    $array_data = $values['data'][0][$key];
                    $this->assertTrue($array_data['name'] == $value['name']);
                    $this->assertTrue($array_data['label'] == $value['label']);
                    $this->assertTrue($array_data['type'] == $value['type']);
                    if ($value['type'] == 'url') {
                        $this->assertTrue($array_data['data']['url'] == $value['data']['url']);
                        $this->assertTrue($array_data['data']['text'] == $value['data']['text']);
                    }
                }
            } else {
                $this->assertTrue($data_array['name'] == $values['name']);
                $this->assertTrue($data_array['label'] == $values['label']);
                $this->assertTrue($data_array['type'] == $values['type']);
                $this->assertTrue($data_array['data']['url'] == $values['data']['url']);
                $this->assertTrue($data_array['data']['text'] == $values['data']['text']);
            }
        }
    }

    public function test_fetch()
    {
        $request_data = Content::latest()->first();
        $request_data = ['slug'=>$request_data->slug];
        $response = $this->json('GET', $this->getContentApiV1('/content/fetch'), $request_data);
        $response->assertSuccessful();

        $response = $response->json('data');
        $table = Content::latest()->first();
        foreach ($response['value'] as $key => $value) {
            $data = json_decode($table->value, true);
            $data_array = $data[$key];
            $this->assertTrue($data_array['name'] == $value['name']);
            $this->assertTrue($data_array['label'] == $value['label']);
            $this->assertTrue($data_array['type'] == $value['type']);
            if ($value['type'] == 'url') {
                $this->assertTrue($data_array['data']['url'] == $value['data']['url']);
                $this->assertTrue($data_array['data']['text'] == $value['data']['text']);
            }
        }
    }

    public function test_edit()
    {
        $token = CallHelperTest::login($this);
        $table = Content::latest()->orderBy('id', 'asc')->first();
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
                },
                "arrayedit":{
                    "name":"arrayedit",
                    "label":"arrayedit",
                    "type":"array",
                    "data":[
                            {
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
                            },"grup":{
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
                        }                                       
                    ]
                }
            }',
        ];
        $response = $this->withHeader('Authorization', "Bearer $token")->json('PUT', $this->getContentApiV1('/content/edit'), $request_data);
        $response->assertSuccessful();

        $table = Content::latest()->orderBy('id', 'asc')->first();
        $table = json_decode($table->value, true);
        $request_data = json_decode($request_data['value'], true);
        foreach ($request_data as $key => $values) {
            $data = $table;
            $data_array = $data[$key];
            if ($values['type'] == 'array') {
                foreach ($values['data'][0] as $key => $value) {
                    $array_data = $values['data'][0][$key];
                    $this->assertTrue($array_data['name'] == $value['name']);
                    $this->assertTrue($array_data['label'] == $value['label']);
                    $this->assertTrue($array_data['type'] == $value['type']);
                    if ($value['type'] == 'url') {
                        $this->assertTrue($array_data['data']['url'] == $value['data']['url']);
                        $this->assertTrue($array_data['data']['text'] == $value['data']['text']);
                    }
                }
            } else {
                $this->assertTrue($data_array['name'] == $values['name']);
                $this->assertTrue($data_array['label'] == $values['label']);
                $this->assertTrue($data_array['type'] == $values['type']);
                if ($data_array['type'] == 'url') {
                    $this->assertTrue($data_array['data']['url'] == $values['data']['url']);
                    $this->assertTrue($data_array['data']['text'] == $values['data']['text']);
                }
            }
        }

        $this->assertTrue($response['message'] == 'Request was successful');
    }

    public function test_fill()
    {
        $token = CallHelperTest::login($this);
        $table = Content::orderBy('id', 'asc')->latest()->first();
        $request_data = [
            'id' => $table->id,
            'slug' => $table->slug,
            'label' => $table->label,
            'value' => [
                'textedit' => [
                    'name' =>'textedit',
                    'label' =>'texteditlabel',
                    'type' =>'text',
                    'data' => 'this is value text',
                ],
                'imageedit'=>[
                    'name'=>'imageedit',
                    'label'=>'imageeditlabel',
                    'type'=>'image',
                    'data' => 'News baru (1).jpg',
                ],
                'urledit'=>[
                    'name'=>'urledit',
                    'label'=>'urleditlabel',
                    'type'=>'url',
                    'data'=>[
                        'url' => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/405',
                        'text' => '405 not permission',
                    ],
                ],
                'groupedit'=>[
                    'name'=>'groupedit',
                    'label'=>'groupeditlabel',
                    'type'=>'group',
                    'data'=>[
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
                            'image'=>[
                                'name'=>'img',
                                'label'=>'img',
                                'type'=>'image',
                                'data'=>'News baru (1).jpg',
                            ],
                        ],
                    ],
                ],
                'arrayedit'=>[
                    'name'=> 'arrayedit',
                    'label'=> 'arrayedit',
                    'type'=>'array',
                    'data'=>[
                        [
                            'text'=>[
                                'name'=>'text',
                                'label'=>'text',
                                'type'=>'text',
                                'data'=>'data array text',
                            ],
                            'url'=>[
                                'name'=>'url',
                                'label'=>'url',
                                'type'=>'url',
                                'data'=>[
                                    'url'=> 'url array data',
                                    'text'=> 'data array text',
                                ],
                            ], 'img'=>[
                                'name'=>'img',
                                'label'=>'img',
                                'type'=>'image',
                                'data'=> 'data array image',
                            ], 'grup'=>[
                                'name'=>'this is group',
                                'label'=>'this is group',
                                'type'=>'group',
                                'data'=>[
                                    'text'=>[
                                        'name'=>'text',
                                        'label'=>'text',
                                        'type'=>'text',
                                        'data'=> 'data group array text',
                                    ],
                                    'url'=>[
                                        'name'=>'url',
                                        'label'=>'url',
                                        'type'=>'url',
                                        'data'=>[
                                            'url'=> 'data group url array',
                                            'text'=> 'data group url array text',
                                        ],
                                    ], 'img'=>[
                                        'name'=>'img',
                                        'label'=>'img',
                                        'type'=>'image',
                                        'data'=> 'data group array image',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'text'=>[
                                'name'=>'text',
                                'label'=>'text',
                                'type'=>'text',
                                'data'=>'data second text',
                            ],
                            'url'=>[
                                'name'=>'url',
                                'label'=>'url',
                                'type'=>'url',
                                'data'=>[
                                    'url'=> 'data url second data',
                                    'text'=> 'data url second text',
                                ],
                            ], 'img'=>[
                                'name'=>'img',
                                'label'=>'img',
                                'type'=>'image',
                                'data'=> 'data second image',
                            ], 'grup'=>[
                                'name'=>'this is group',
                                'label'=>'this is group',
                                'type'=>'group',
                                'data'=>[
                                    'text'=>[
                                        'name'=>'text',
                                        'label'=>'text',
                                        'type'=>'text',
                                        'data'=> 'data group second text',
                                    ],
                                    'url'=>[
                                        'name'=>'url',
                                        'label'=>'url',
                                        'type'=>'url',
                                        'data'=>[
                                            'url'=> 'data group url second data',
                                            'text'=> 'data group url second text',
                                        ],
                                    ], 'img'=>[
                                        'name'=>'img',
                                        'label'=>'img',
                                        'type'=>'image',
                                        'data'=> 'data group second image',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'text'=>[
                                'name'=>'text',
                                'label'=>'text',
                                'type'=>'text',
                                'data'=>'data third text',
                            ],
                            'url'=>[
                                'name'=>'url',
                                'label'=>'url',
                                'type'=>'url',
                                'data'=>[
                                    'url'=> 'data url third data',
                                    'text'=> 'data url third text',
                                ],
                            ], 'img'=>[
                                'name'=>'img',
                                'label'=>'img',
                                'type'=>'image',
                                'data'=> 'data third image',
                            ], 'grup'=>[
                                'name'=>'this is group',
                                'label'=>'this is group',
                                'type'=>'group',
                                'data'=>[
                                    'text'=>[
                                        'name'=>'text',
                                        'label'=>'text',
                                        'type'=>'text',
                                        'data'=> 'data group third text',
                                    ],
                                    'url'=>[
                                        'name'=>'url',
                                        'label'=>'url',
                                        'type'=>'url',
                                        'data'=>[
                                            'url'=> 'data group url third data',
                                            'text'=> 'data group url third text',
                                        ],
                                    ], 'img'=>[
                                        'name'=>'img',
                                        'label'=>'img',
                                        'type'=>'image',
                                        'data'=> 'data group third image',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $response = $this->withHeader('Authorization', "Bearer $token")->json('PUT', $this->getContentApiV1('/content/fill'), $request_data);
        $response->assertSuccessful();

        $table = Content::orderBy('id', 'asc')->latest()->first();
        $table_data_value = json_decode($table->value, true);
        foreach ($table_data_value as $key => $tab) {
            if ($tab['type'] == 'group') {
                if ($request_data['value'][$key]['data']) {
                    foreach ($request_data['value'][$key]['data'] as $keys => $value) {
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
            } elseif ($tab['type'] == 'array') {
                foreach ($tab['data'] as $item => $data_response) {
                    $value_data_request = $request_data['value'][$key]['data'];
                    if ($value_data_request) {
                        foreach ($data_response as $key_data_response => $value_data_response) {
                            if ($value_data_request[$item][$key_data_response]['type'] == 'group') {
                                foreach ($value_data_response['data'] as $key_group_value_data_response => $value_group_value_data_response) {
                                    $this->assertTrue($value_data_request[$item][$key_data_response]['data'][$key_group_value_data_response]['data'] == $value_group_value_data_response['data']);
                                }
                            }
                            $this->assertTrue($value_data_request[$item][$key_data_response]['data'] == $value_data_response['data']);
                        }
                    }
                }
            } else {
                $request_data_array = $request_data['value'][$key];
                if (isset($request_data_array['data']) && $request_data_array['type'] != 'group') {
                    if (isset($request_data_array['data']['url'])) {
                        $this->assertTrue($request_data_array['data']['url'] == $tab['data']['url']);
                        $this->assertTrue($request_data_array['data']['text'] == $tab['data']['text']);
                    } elseif ($request_data_array['type'] == 'image') {
                        if ($request_data_array['data'] == $tab['data']) {
                            $this->assertTrue($request_data_array['data'] == $tab['data']);
                        }
                    } else {
                        $this->assertTrue($request_data_array['data'] == $tab['data']);
                    }
                }
            }
        }
    }

    public function test_fetch_multiple()
    {
        $table = Content::orderBy('id', 'asc')->latest()->limit(2)->get();
        $slug = [];
        foreach ($table as $key => $value) {
            $slug[] = $value->slug;
        }

        $request_data = ['slug'=>join(',', $slug)];
        $response = $this->json('GET', $this->getContentApiV1('/content/fetch-multiple'), $request_data);
        $response->assertSuccessful();

        $response = $response->json('data');
        $table = Content::orderBy('id', 'asc')->latest()->limit(2)->get();
        foreach ($response as $index => $value) {
            $str_slug = $slug[$index];
            $table_data = $table->where('slug', $str_slug)->first();
            $table_data_value = json_decode($table_data->value, true);
            foreach ($table_data_value as $key_tab => $tab) {
                if ($tab['type'] == 'group') {
                    if ($table_data_value[$key_tab]['data']) {
                        foreach ($table_data_value[$key_tab]['data'] as $key_table_data_value => $value_table_data_value) {
                            if ($tab['data'][$value_table_data_value['name']]) {
                                if ($value_table_data_value['type'] == 'url') {
                                    $this->assertTrue($value_table_data_value['data']['url'] == $value[$key_tab]['data'][$key_table_data_value]['data']['url']);
                                    $this->assertTrue($value_table_data_value['data']['text'] == $value[$key_tab]['data'][$key_table_data_value]['data']['text']);
                                } elseif ($value_table_data_value['type'] == 'image') {
                                    $this->assertTrue($value_table_data_value['data'] == $value[$key_tab]['data'][$key_table_data_value]['data']);
                                } else {
                                    $this->assertTrue($value_table_data_value['data'] == $value[$key_tab]['data'][$key_table_data_value]['data']);
                                }
                            }
                        }
                    }
                } elseif ($tab['type'] == 'array') {
                    $table_data_value_array = $table_data_value[$key_tab]['data'];
                    foreach ($table_data_value_array as $key_table_data_value_array => $value_table_data_value_array) {
                        foreach ($value_table_data_value_array as $key_value_table_data_value_array => $value_value_table_data_value_array) {
                            $value_data = $value[$key_tab]['data'][$key_table_data_value_array][$key_value_table_data_value_array];
                            if ($value_data['type'] == 'group') {
                                foreach ($value_data['data'] as $key_value_data => $value_value_data) {
                                    $this->assertTrue($value_value_data['data'] == $value_value_table_data_value_array['data'][$key_value_data]['data']);
                                }
                            }
                            $this->assertTrue($value_data['data'] == $value_value_table_data_value_array['data']);
                        }
                    }
                } else {
                    $respon_data_array = $table_data_value[$key_tab];
                    if (isset($respon_data_array['data'])) {
                        if (isset($respon_data_array['data']['url']) && isset($tab['data']['url'])) {
                            $this->assertTrue($respon_data_array['data']['url'] == $tab['data']['url']);
                            if (isset($tab['data']['text'])) {
                                $this->assertTrue($respon_data_array['data']['text'] == $tab['data']['text']);
                            }
                        } elseif ($respon_data_array['type'] == 'image' && $tab['type'] == 'image') {
                            $this->assertTrue($respon_data_array['data'] == $tab['data']);
                        } else {
                            if ($respon_data_array['data'] == $tab['data']) {
                                $this->assertTrue($respon_data_array['data'] == $tab['data']);
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
        $response = $this->withHeader('Authorization', "Bearer $token")->json('DELETE', $this->getContentApiV1('/content/delete'), $request_data);
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

        $response = $this->withHeader('Authorization', "Bearer $token")->json('DELETE', $this->getContentApiV1('/content/delete-multiple'), $request_data);
        $response->assertSuccessful();
        $table = Content::whereIn('id', $ids)->get();
        $table_count = $table->count();
        $this->assertTrue($table_count == 0);
    }
}
