<template>
    <div id="analytic">
        <h2>{{title}}</h2>
        <div class="title_border-bottom"></div>
        <div class="chart_header">
            <div class="chart_header_item">
                <div class="chart_header_item_a">Запросы:</div>
                <div class="chart_header_item_count">{{query}} шт.</div>
            </div>
            <div class="chart_header_item">
                <div class="chart_header_item_a">Ошибки:</div>
                <div class="chart_header_item_count">{{error}} шт.</div>
            </div>
        </div>

        <div class="chart_container">
            <div class="chart">
                <div class="chart_header">Трафик</div>
                <div class="chart_header_bottom"></div>
                <div class="chart_item">
                    <div class="random">
                        <trend-chart :datasets="datasetsT" :grid="gridT" :labels="labelsT" :min="0" :interactive="true" class="random-chart"></trend-chart>
                    </div>
                </div>
            </div>

            <div class="chart">
                <div class="chart_header">Ошибки</div>
                <div class="chart_header_bottom"></div>
                <div class="chart_item">
                    <div class="random">
                        <trend-chart :datasets="datasetsE" :grid="gridE" :labels="labelsE" :min="0" :interactive="true" class="random-chart"></trend-chart>
                    </div>
                </div>
            </div>
        </div>

        <div class="chart_bottom_line"></div>

        <div class="container">
            <h4>Визуальная форма:</h4>

            <div class="visual_form_info">
                <div class="visual_form_info-forClient">
                    <b>Для клиента:</b> позволяет быстро оставить заявку на получение кредита и получить одобрение в минимальные сроки.
                </div>
                <div class="visual_form_info-forCompany">
                    <b>Для компании:</b> получение скидки на тарифный план по использованию API за счет привлечения новых клиентов.
                </div>
            </div>

            <div class="modal">
                <div class="modal_header">
                    <div class="logo">
                        <svg width="227" height="48" viewBox="0 0 227 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M47.4794 24.0591C47.4794 37.0916 36.9445 47.6674 23.9658 47.6674C10.9861 47.6674 0.451172 37.0916 0.451172 24.0591C0.451172 11.0271 10.9861 0.452637 23.9658 0.452637C36.9445 0.452637 47.4794 11.0271 47.4794 24.0591Z" fill="#F0F1F4"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.942816 23.8547C0.942816 11.0523 11.3094 0.640805 24.0639 0.640805C36.7899 0.640805 47.1565 11.0518 47.1565 23.8547C47.1565 36.6318 36.7899 47.0373 24.0639 47.0373C11.3094 47.0373 0.942816 36.6318 0.942816 23.8547ZM0.125977 23.8547C0.125977 37.0832 10.8595 47.8556 24.0639 47.8556C37.2371 47.8556 47.9688 37.0832 47.9688 23.8547C47.9688 10.5967 37.2375 -0.173828 24.0639 -0.173828C10.8595 -0.173828 0.125977 10.5967 0.125977 23.8547Z" fill="#1E3262"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M39.2907 21.4012C39.094 21.5701 38.8976 21.7096 38.7027 21.8822C37.3799 22.8933 35.2724 23.7138 32.3805 24.4778C26.3698 26.1111 22.0103 26.3335 17.0646 27.552C16.083 27.8038 15.0717 28.1135 14.147 28.5084C15.0717 28.9893 16.083 29.4114 17.0948 29.8076C19.1161 29.2166 20.0756 28.9617 22.9932 28.4822C24.1174 28.2806 27.5454 27.6616 30.0176 27.159C34.4876 26.1958 41.0332 24.1083 39.2907 21.4012ZM36.3984 15.759C35.4389 15.3383 34.2593 14.9126 32.9988 14.5771C32.4324 15.0286 31.7907 15.4212 30.8308 15.792C32.4085 16.0692 33.5886 16.5206 34.933 16.8897C35.1582 17.0034 36.2255 16.0194 36.3984 15.759ZM14.5103 21.768C20.3549 20.0464 26.4803 19.5125 32.6897 17.8492C30.2734 17.2012 28.9205 16.9169 26.3698 17.2289C22.6588 17.6803 18.5565 18.466 15.0464 19.512C13.6668 19.9363 6.44792 21.9935 8.52973 24.8699C8.52928 24.8994 9.76131 23.1523 14.5103 21.768ZM10.4924 31.6379C10.464 32.1759 10.8033 32.6545 11.506 33.2477C11.5886 32.9629 11.7312 32.741 11.928 32.4584C11.4482 32.2012 10.9699 31.9499 10.4924 31.6379ZM13.2196 31.388C13.6668 31.1036 14.1989 30.8486 14.7892 30.624C13.9759 30.2554 13.1054 29.8936 12.2619 29.4974C11.8684 29.751 11.5056 30.0041 11.2249 30.2554C11.8973 30.6521 12.5458 31.0175 13.2196 31.388ZM35.6641 18.9215C34.4881 19.4853 32.8025 20.0468 30.3858 20.6414C28.3911 21.1477 23.5582 21.8527 18.362 22.9798C16.732 23.3471 12.2624 24.389 10.0709 26.2506C10.6892 26.7628 11.0822 26.8728 11.7565 27.2677C12.6554 26.6745 13.892 26.1111 15.7206 25.6284C18.8914 24.7862 21.2823 24.4207 24.1499 23.9434C26.9862 23.5137 32.3503 22.3884 35.3008 21.3148C36.286 20.9788 37.1832 20.5273 37.8281 19.9875C37.6304 19.7656 35.7205 18.8351 35.6641 18.9215ZM37.3799 17.8751C37.968 18.1581 38.5059 18.356 39.0096 18.7232C39.3729 18.0163 39.1477 17.5649 38.3931 16.9173C38.0826 17.2859 37.7432 17.5943 37.3799 17.8751ZM10.2131 28.4514C9.67692 28.1724 9.3407 27.9465 8.89031 27.6621C8.66512 28.1724 9.11912 28.7321 9.56635 28.9893C9.76131 28.791 10.0167 28.6221 10.2131 28.4514ZM35.0459 12.2659C34.933 12.6607 34.5165 13.1398 34.2326 13.4518C35.1045 13.6778 36.0035 14.0115 36.8443 14.3235C36.7332 13.5342 35.8343 12.7726 35.0459 12.2659ZM7.56983 17.2529C13.6952 13.2499 20.4673 10.882 31.9288 12.8862C32.5471 12.5172 32.9108 12.1504 33.0832 11.4177C30.2148 10.3753 27.0986 10.008 23.0826 10.0628C19.4835 10.1765 12.993 11.5277 9.5131 13.5908L10.5768 12.2654C12.993 10.8227 19.3134 8.93574 24.0641 8.8497C27.405 8.76728 29.119 8.962 33.1098 10.0338C32.7425 9.36185 31.9292 9.02041 30.7207 8.45709C26.8739 6.73543 19.7087 6.56472 13.8383 9.18751C14.5662 8.68079 15.2973 8.22751 16.255 7.8109C18.1896 6.90615 21.3667 6.03038 25.3264 6.11506C28.5039 6.17166 32.2686 7.27159 34.5706 9.55657C34.9619 10.0339 35.1889 10.5129 35.2729 10.882C37.0997 11.8126 38.1652 12.6861 38.755 13.7013C39.01 14.2375 39.0944 14.8008 38.9802 15.4488C39.7384 15.8985 40.1062 16.2951 40.5015 16.8073C40.7502 17.2293 40.947 17.7048 41.0056 18.1345C41.0878 18.6942 41.1437 19.344 40.5539 20.1062C41.1722 20.4182 41.6762 21.288 41.7367 21.6589C42.044 23.0355 41.1442 24.3899 39.9943 25.4364C38.6436 26.6183 35.6655 28.0302 33.2488 28.6524C28.4759 29.8624 24.2315 30.3727 20.8636 30.9931C22.379 31.3585 24.4297 31.8408 27.7737 31.8408C34.9344 31.8408 41.2561 28.4527 41.2561 28.4527C41.2561 28.4527 41.118 28.8802 40.9754 29.2751C36.4241 32.0373 29.2066 33.1916 26.1134 33.0508C22.9946 32.9077 20.3558 32.4304 17.7708 31.6393C16.9833 31.8666 16.1967 32.1215 15.4404 32.4304C19.3743 34.2345 22.3506 34.6307 25.6946 34.8825C29.1199 35.1392 34.7981 34.3173 39.5705 32.573C39.3458 32.8008 39.2338 33.1368 39.0109 33.3351C36.5645 34.6307 31.3985 35.9289 28.7851 36.0408C26.1978 36.1545 23.0532 36.0408 20.299 35.5323C17.9392 35.055 15.9982 34.3173 13.9768 33.4198C13.614 33.6969 13.4457 34.0402 13.3586 34.4346C21.2566 38.5794 28.614 38.6636 37.0176 36.0408L36.2549 36.7748C27.0124 40.5546 19.7931 39.0861 14.2002 36.3804C14.0053 36.2944 13.7805 36.2079 13.614 36.096C14.1483 37.0008 18.4148 40.1303 23.1913 40.5247C26.4812 40.8073 30.4973 40.2421 32.8855 39.2862L31.4825 40.0166C30.3281 40.5818 27.2678 41.8814 22.9946 41.5984C17.2929 41.2022 14.0878 38.6636 12.6563 37.3404C11.9803 36.716 11.6748 36.0132 11.4762 35.1397C10.1837 34.4622 9.36914 33.7554 8.69671 32.6835C8.30319 32.0926 8.38577 31.3898 8.47016 30.7929L8.64301 30.2903C8.02293 29.8352 7.37623 29.3561 7.12396 28.8806C6.55984 27.864 6.90057 26.9865 7.29229 26.3108C6.95292 25.9164 6.64378 25.5216 6.50749 25.1271C6.33916 24.6757 6.31073 24.2201 6.36308 23.7157C6.47545 22.8711 6.9272 22.0823 7.51749 21.4031C8.75132 19.9658 10.7226 18.8369 14.0617 17.7374C17.3516 16.6361 18.6725 16.4654 21.1447 15.8998C24.037 15.2265 27.493 15.0023 30.3872 13.9871C22.3208 12.5774 13.952 13.8734 7.12441 18.5797L7.56983 17.2529Z" fill="#1E3262"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M78.1168 19.654L79.0442 26.0842H77.1876L78.1168 19.654ZM70.8975 34.3474H75.8129L76.4312 30.7076H79.8308L80.4211 34.3474H85.3365L81.1774 13.3071H75.0543L70.8975 34.3474Z" fill="#1E3262"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M89.9992 21.4599C90.784 21.4599 92.2191 20.9513 92.2191 19.4004C92.2191 17.5687 90.5619 17.4528 90.0818 17.4528C89.5222 17.4528 88.4549 17.5388 87.4146 18.0473L87.3587 13.4751C89.0158 13.0526 90.1959 12.939 91.599 12.939C95.5916 12.939 97.3611 15.7325 97.3611 18.4658C97.3611 21.1198 95.8421 22.7242 94.3546 23.3464V23.5429C95.7879 23.998 97.6964 25.3768 97.6964 28.5924C97.6964 32.5714 94.9444 34.769 91.404 34.769C89.5217 34.7432 88.2852 34.4901 86.7959 33.6713L86.8803 29.2975C88.2576 29.892 89.1841 29.9473 90.112 29.9473C91.6861 29.9473 92.3017 28.7889 92.3017 27.9462C92.3017 26.7607 91.5453 25.9714 89.8868 25.9714H87.9205V21.4599H89.9992Z" fill="#1E3262"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M99.9722 13.3066H113.232V34.3474H108.372V18.3838H104.833V34.3474H99.9722V13.3066Z" fill="#1E3262"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M120.874 17.9323H122.027C123.124 17.9323 123.826 18.6098 123.826 20.3591C123.826 22.6151 122.645 22.7822 122.027 22.7822H120.874V17.9323ZM116.014 34.3474H120.874V27.411H122.506C127.308 27.411 128.798 23.0665 128.798 20.2984C128.798 17.5927 127.082 13.3071 122.506 13.3071H116.014V34.3474Z" fill="#1E3262"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M137.787 29.496C136.071 29.496 135.204 27.4954 135.204 23.8003C135.204 20.1034 136.071 18.1028 137.787 18.1028C139.503 18.1028 140.37 20.1034 140.37 23.8003C140.37 27.4954 139.503 29.496 137.787 29.496ZM137.787 34.6022C143.548 34.6022 145.483 29.1854 145.483 23.8003C145.483 18.4153 143.548 12.9985 137.787 12.9985C132.029 12.9985 130.091 18.4153 130.091 23.8003C130.091 29.1854 132.029 34.6022 137.787 34.6022Z" fill="#1E3262"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M171.417 30.1163V25.3512H172.12C172.709 25.3512 174.228 25.3792 174.228 27.5501C174.228 29.7527 172.709 30.1163 172.12 30.1163H171.417ZM166.668 34.3471H172.456C173.719 34.3471 178.974 33.8091 179.001 27.4342C179.001 22.0822 174.929 21.1498 172.288 21.1498H171.417V18.3563H177.851V13.3086H166.668V34.3471Z" fill="#1E3262"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M196.479 13.3066H201.226V20.8947H204.626V13.3066H209.371V34.3474H204.626V25.9152H201.226V34.3474H196.479V13.3066Z" fill="#1E3262"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M212.572 13.3066H217.35L217.321 20.8653H218.36L221.086 13.3066H226.255L222.545 23.2938L226.789 34.3474H221.197L218.446 25.8854H217.321L217.35 34.3474H212.572V13.3066Z" fill="#1E3262"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M61.4863 13.3066H71.4549V18.5527H66.4289V34.3474H61.4863V13.3066Z" fill="#1E3262"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M147.819 13.3066H151.95L155.597 18.2719L159.281 13.3066H163.383V34.3474H158.519V21.5133L155.597 25.1803L152.678 21.5133V34.3474H147.819V13.3066Z" fill="#1E3262"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M187.178 19.7088L188.076 26.1113H186.249L187.178 19.7088ZM179.93 34.3746H184.875L185.466 30.737H188.863L189.454 34.3746H194.398L190.24 13.3379H184.114L179.93 34.3746Z" fill="#1E3262"/>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="227" height="48" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>

                    </div>
                    <div class="title">
                        {{title}}
                    </div>
                </div>

                <div class="modal_block_container">
                    <div class="modal_block_credit">
                        <a>Сумма кредита</a>
                        <input type="text" placeholder="Введите сумму кредита">
                        <div class="dopInfo">От 10 000 до 5 000 000 р.</div>
                    </div>

                    <div class="modal_block_credit">
                        <a>Срок кредита</a>
                        <input type="text" placeholder="Введите срок кредита">
                        <div class="dopInfo">От 12 до 64 месяцев</div>
                    </div>
                </div>

                <div class="modal_fio">
                    <input type="text" placeholder="Введите фамилию, имя, отчество">
                </div>

                <div class="modal_block_container">
                    <div class="modal_block_credit">
                        <a>Мобильный телефон</a>
                        <input type="text" placeholder="+7 987 430 11 22">
                    </div>

                    <div class="modal_block_credit">
                        <a>Email</a>
                        <input type="text" placeholder="testemail@gmail.com">
                    </div>
                </div>

                <div class="conditions">Нажимая кнопку «Далее», я соглашаюсь <a>c условиями предоставления услуги</a></div>

                <div class="modal_btn">
                    Далее
                </div>

                <div class="modal_step">
                    Шаг 1 из 5
                </div>
            </div>

            <h5>Инструкция по интегрированию визуальной формы:</h5>

            <div class="inst">
                <div class="inst_container">
                    <div class="inst_header">1. Подключить .css файл перед закрывающим тегом &lt;/head&gt;
                    </div>
                    <div class="inst_description">&lt;link rel=&quot;stylesheet&quot; href=&quot;https://creativityprojectcenter.ru/forms/css/form_partner.css&quot;&gt;&lt;/link&gt;</div>
                </div>

                <div class="inst_container">
                    <div class="inst_header">2. Добавьте следующий &lt;div&gt; элемент, в место, необходимое для отображения формы
                    </div>
                    <div class="inst_description">&lt;div id=&quot;form_credit_1&quot; data-id-app=&quot;{appId}&quot; data-client-id=&quot;{dataClient}&quot;&gt;&lt;/div&gt;</div>
                </div>

                <div class="inst_container">
                    <div class="inst_header">3. Подключите .js файл перед закрывающим тегом &lt;/body&gt;
                    </div>
                    <div class="inst_description">&lt;script async src=&quot;https://creativityprojectcenter.ru/forms/js/form_partner.js&quot; type=&quot;text/javascript&quot;&gt;&lt;/script&gt;</div>
                </div>
            </div>

            <h5>Параметры:</h5>

        </div>
    </div>
</template>

<script>
    import TrendChart from "vue-trend-chart";

    export default {
        name: "АnalyticComponent",
        data() {
            return {
                title: 'Заявка на персональный кредит',
                query: 1023,
                error: 3,

                datasetsT: [
                    {
                        data: [70, 100, 400, 180, 100, 300, 500],
                        smooth: true,
                        showPoints: true,
                        fill: true,
                        className: "curve1"
                    },
                ],
                gridT: {
                    verticalLines: true,
                    horizontalLines: true
                },
                labelsT: {
                    xLabels: ["26 окт.", "27 окт.", "28 окт.", "29 окт.", "30 окт.", "31 окт.", "1 ноя."],
                    yLabels: 5,
                   
                },

                datasetsE: [
                    {
                        data: [0, 1, 0, 0, 2, 0, 0],
                        smooth: true,
                        showPoints: true,
                        fill: true,
                        className: "curve1"
                    },
                ],
                gridE: {
                    verticalLines: true,
                    horizontalLines: true
                },
                labelsE: {
                    xLabels: ["26 окт.", "27 окт.", "28 окт.", "29 окт.", "30 окт.", "31 окт.", "1 ноя."],
                    yLabels: 5,

                },

                instruction: [
                    '&lt;link rel=&quot;stylesheet&quot; href=&quot;https://creativityprojectcenter.ru/forms/css/form_partner.css&quot;&gt;&lt;/link&gt;',
                    '&lt;div id=&quot;form_credit_1&quot; data-id-app=&quot;{appId}&quot; data-client-id=&quot;{dataClient}&quot;&gt;&lt;/div&gt;',
                    '&lt;script async src=&quot;https://creativityprojectcenter.ru/forms/js/form_partner.js&quot; type=&quot;text/javascript&quot;&gt;&lt;/script&gt;'
                ],

                param: [
                    {key: 'data-id-app', description: 'ключ ID приложения'},
                    {key: 'data-client-id', description: 'ключ клиента'},
                ]
                
            };

        },

        beforeCreate() {

        },

        created() {

        },

        mounted() {

        },

        watch: {

        },

        methods: {

        },

        components: {
            TrendChart
        }
    }
</script>

<style lang="scss" >

    @import "../styles_fonts";

    $blue: #0066CC;
    $dark: #262C40;

    $font_ProximaNova-Regular: ProximaNova-Regular, 'ProximaNova-Regular';
    $font_ProximaNova-Light: ProximaNova-Light, 'ProximaNova-Light';
    

    .random {
        width: 100%;
        .vtc {
            height: 250px;
            font-size: 12px;
            @media (min-width: 699px) {
                height: 320px;
            }
        }
    }

    .curve {
        path:nth-child(1) {
            fill: rgba(0, 102, 204, 0.2);
        }
    }

    #analytic {
        padding: calc(110px + 57px) 0 0 65px;
        width: 1170px;

        h2 {
            margin: 0;
            color: $dark;
            font-size: 38px;
            font-family: $font_ProximaNova-Regular;
            font-weight: 700;
        }

        .title_border-bottom {
            background-color: #EBEBEB;
            margin: 6px 0 12px 0;
            width: 100%;
            height: 2px;
        }

        .chart_header {
            display: flex;
            flex-direction: row;

            .chart_header_item {
                width: calc((100% / 2));
                display: flex;
                flex-direction: row;
                font-size: 18px;
                font-family: $font_ProximaNova-Regular;
                font-weight: 400;

                .chart_header_item_a {
                    color: $blue;
                    margin-right: 10px;
                }

                .chart_header_item_count {
                    color: $dark;
                }
            }

            .chart_header_item:nth-child(1) {
                margin-right: 32px;
            }
        }

        .chart_container {
            display: flex;
            flex-direction: row;
            margin-top: 16px;

            .chart {
                background-color: white;
                box-shadow: 0px 0px 13px 0px rgba(34, 60, 80, 0.1);
                padding: 20px;
                width: calc(100% / 2);
                display: flex;
                flex-direction: column;
            }

            .chart:nth-child(1) {
                margin-right: 32px;
            }

            .chart_header {
                color: $blue;
                font-size: 24px;
                font-family: $font_ProximaNova-Regular;
                font-weight: 700;
                margin-bottom: 2px;
                margin-left: 26px;
            }

            .chart_header_bottom {
                width: 100%;    //#EBEBEB
                height: 2px;
                background-color: #EBEBEB;
                margin-bottom: 20px;
            }
        }
    }

    .chart_bottom_line {
        width: 100%;    //#EBEBEB
        height: 2px;
        background-color: #EBEBEB;
        margin: 32px 0 30px 0;
    }

    .container {
        padding: 0 !important;
        color: $dark;

        h4 {
            margin: 0 0 24px 0;
            font-family: $font_ProximaNova-Regular;
            font-weight: 700;
            font-size: 32px;
            color: $dark;
        }

        .visual_form_info {
            padding: 40px;
            width: 100%;
            background-color: #D7DEE9;
            font-family: $font_ProximaNova-Regular;
            font-weight: 400;
            font-size: 20px;
            margin-bottom: 56px;
        }

        .visual_form_info-forCompany {
            margin-top: 16px;
        }

        .modal {
            display: flex;
            flex-direction: column;
            width: 800px;

            
        }

    }


</style>