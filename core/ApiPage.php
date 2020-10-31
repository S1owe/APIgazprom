<?php
require_once 'DB.php';

class ApiPage
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function getAllApi(){
        $sql = "SELECT id, title FROM categories WHERE is_deleted=0";
        $categories = $this->db->getAllData($sql);
        foreach ($categories as &$category){
            $sql = sprintf("SELECT a.id, a.title, a.description, a.is_premium FROM api a
                    RIGHT JOIN api_categories ac ON ac.id_api=a.id AND ac.id_category=%d AND ac.is_deleted=0
                    WHERE a.is_deleted=0", $category['id']);
            $category['api']=$this->db->getAllData($sql);
        }
        return $categories;
    }

    public function getAllProducts(){
        $sql = "SELECT a.id, a.title, a.description, a.is_premium FROM api a
                    WHERE a.is_deleted=0";
        $category['api']=$this->db->getAllData($sql);
    }

    public function getApiDocumentation($apiId){
        $data = ["points"=>[
            [
                "is_parse_header"=>true,
                "headers"=>[],
                "is_sandbox"=>false
            ],
            [
                "is_parse_header"=>true,
                "headers"=>[],
                "is_sandbox"=>true,
                "sandbox"=>[
                    "params"=>[
                        "token" =>[
                            "type"=>"text",
                            "value" => "test1"
                        ],
                        "device_model"=>[
                            "type"=>"text",
                            "value"=>"test2"
                        ],
                        "device_year"=>[
                            "type"=>"text",
                            "value"=>"test3"
                        ],
                        "sandbox"=>[
                            "type"=>"text",
                            "value"=>"test4"
                        ],
                        "test_bool"=>[
                            "type"=>"bool",
                            "value"=>true
                        ]
                    ]],
            ],
            [
                "is_parse_header"=>true,
                "headers"=>[],
                "is_sandbox"=> false
            ],
            [
                "is_parse_header"=>true,
                "headers"=>[],
                "is_sandbox"=> false
            ],
            [
                "is_parse_header"=> true,
                "headers"=>[],
                "is_sandbox"=>false
            ],
            [
                "is_parse_header"=> false,
                "headers"=>[],
                "is_sandbox"=> false
            ]
        ]
        ];
        $sql = sprintf("SELECT href, title FROM doc_caterories WHERE id_api=%d", $apiId);
        $categories = $this->db->getAllData($sql);
        foreach ($data['points'] as $key=>&$dat){
            $dat['text']=$categories[$key]['title'];
            $dat['href']=$categories[$key]['href'];
        }
        return $data;
    }

    public function getProducts(){
        $sql = "SELECT id, title, description, is_premium FROM categories WHERE is_deleted=0";
        return $this->db->getAllData($sql);
    }
}