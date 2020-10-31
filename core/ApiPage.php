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

    public function getSandbox($payload){
      if($payload['token']==""){
        $data = [
              "httpCode" => 401,
              "httpMessage" => "Unauthorized",
              "moreInformation" => "Client token missing."
        ];
      }else{
        $data = [
          'token' => $payload['token'],
          'operationType' => 'payment',
          'channel' => 'mobile',
          'sberbankIdInvoice' => [
            'merchantInvoiceId' => '6e87c0651a8c7927b5',
            'desc' => 'Описание заявки',
            'printDesc' => 'Ваша заявка на оплату заказа №*** ...',
            'initiatorType' => 'client',
            'orderCreationDate' => '2018-08-28T15:51:20',
            'orderLifeTime' => 3600,
            'amount' => [
              'value' => 10000000,
              'currency'=> 'RUB'
            ],
            'language' => 'ru',
            'client' => [
              'clientId' => '123123',
              'clientEmail' => 'client@gazbank.ru',
              'clientContact' => 'почта',
              'mobilePhoneNumber' => '89160000000',
              'deliveryInfo' => [
                'deliveryType' => 'Курьерская доставка',
                'deliveryCountry' => 'RU',
                'deliveryCity' => 'Москва',
                'postAddress' => '117997'
              ]
            ],
            'itemList' => [
              [
                'id' => '2343rwer324',
                'itemPositionId' => 1,
                'name' => 'Фотоаппарат',
                'description' => 'Хороший современный фотоаппарат',
                'price' => [
                  'value' => 10000000,
                  'currency' => 'RUB'
                ],
                'count' => 100,
                'quantityMeasure' => 'кг',
                'taxType' => 0,
                'taxSum' => 123,
                'itemDetails'=> '0KLQvtCy0LDRgNC90LDRjyDQv9C+0LfQuNGG0LjRjw=='
              ]
            ],
            'merchantInfo' => [
              'taxSystem' => 0
            ]
          ]
        ];
      }
      return $data;
    }
}
