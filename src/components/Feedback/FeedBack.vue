<template>
  <Loading v-if="!is_show" />
  <div id="feedback" v-else>
    <h1>Обратная связь</h1>
    <div class="card d-flex flex-column chat_content">
      <div class="d-flex justify-content-end header-text p-2 pr-4">
        <span>{{select_chat.name}}</span>
      </div>
      <div class="row m-0 content">
        <div class="col-3 chats d-flex flex-column justify-content-between align-items-end p-0">
          <div class="d-flex flex-column w-100">
            <button v-for="chat in chats" :key="chat.id" :class="{active: chat.id === select_chat.id}"
                    @click="select_chat = chat"
                    class="btn text-left chat d-flex justify-content-between p-2 pl-3 pr-3">
              <div class="d-flex flex-column">
                <span class="name">{{chat.name}}</span>
                <span class="description">{{chat.description}}</span>
              </div>
              <div class="d-flex flex-column">
                <span class="time">{{chat.time}}</span>
              </div>
            </button>
          </div>
          <button class="btn d-flex justify-content-center align-items-center add-chat"
                  @click="() => {is_show_modal = true; select_api = apis[0].value;}">
            <span>+</span>
          </button>
        </div>
        <div class="col-9 messages pl-5 pr-0">
          <transition name="global" mode="out-in" appear>
            <FeedbackMessages :key="select_chat.id" :select_chat="select_chat" />
          </transition>
        </div>
      </div>
    </div>

    <b-modal title="Новая заявка" v-model="is_show_modal" size="md" modal-class="custom_modal">
      <template v-slot:default>
        <div class="d-flex align-items-center">
          <span class="mr-2">API: </span>
          <b-select :options="apis" v-model="select_api" />
        </div>
      </template>

      <template v-slot:modal-footer="{ok}">
        <button class="btn cancel" @click="ok()">Отмена</button>
        <button class="btn ok" @click="() => {add_chat(); ok();}">Добавить</button>
      </template>
    </b-modal>
  </div>
</template>

<script>
import Loading from "@/components/Loading";
import FeedbackMessages from "@/components/Feedback/FeedbackMessages";
export default {
  name: "FeedBack",
  components: {FeedbackMessages, Loading},
  data: function () {
    return {
      is_show: false,
      select_chat: {},
      chats: [],
      local_id: 0,
      is_show_modal: false,
      apis: [
        {value: 1, text: 'Мгновенная отчетность'},
        {value: 2, text: 'Корпоративная выплата'},
        {value: 3, text: 'Лидогенерация'},
        {value: 4, text: 'Открытые справочники'},
        {value: 5, text: 'API Zindex'}
      ],
      select_api: 0
    }
  },
  methods: {
    add_chat: function () {
      this.chats.push({
        name: this.apis.find(a => a.value === this.select_api).text,
        description: 'Менеджер Газпромбанка',
        time: '1 ноя.',
        id: ++this.local_id
      });
    }
  },
  created() {
    this.chats = [
      {
        name: 'API Zindex',
        description: 'Менеджер Газпромбанка',
        time: '13 окт.',
        id: 1
      },
      {
        name: 'API Zindex',
        description: 'Менеджер Газпромбанка',
        time: '13 окт.',
        id: 2
      },
      {
        name: 'API Zindex',
        description: 'Менеджер Газпромбанка',
        time: '13 окт.',
        id: 3
      },
      {
        name: 'API Zindex',
        description: 'Менеджер Газпромбанка',
        time: '13 окт.',
        id: 4
      }
    ];
    this.select_chat = this.chats.length > 0 ? this.chats[0] : {};
    this.local_id = this.chats.reduce((val, c) => {
      return c.id > val ? c.id : val;
    }, 0);
    this.$nextTick(() => {
      this.is_show = true;
    })
  }
}
</script>

<style lang="scss" scoped>
  #feedback {
    padding: 57px 0 0 65px;
  }

  .chat_content {
    height: 700px;
    width: 1077px;
    border: 0;

    .content {
      border: 2px #F0F1F4 solid;
      border-top: 0;
      border-radius: 0px 0px 6px 6px;
      height: 100%;
    }
  }

  .header-text {
    span {
      color: white;
    }
    background-color: #0066CC;
    border-radius: 6px 6px 0px 0px;
  }

  .chats {
    border-right: 2px #F0F1F4 solid;

    .chat.active {
      background-color: rgba(0,102,204,0.1);
    }

    .chat {
      border-radius: 0;
      border-bottom: 1px #F5F5F5 solid;

      .description, .time {
        font-size: 14px;
        color: #93989D;
      }
    }

    .add-chat {
      border-radius: 100%;
      background-color: #0066CC;
      width: 50px;
      height: 50px;
      margin-right: 29px;
      margin-bottom: 29px;

      span {
        color: white;
        font-size: 3rem;
      }
    }
  }
</style>
