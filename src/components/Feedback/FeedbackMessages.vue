<template>
  <Loading v-if="!is_show" />
  <div class="d-flex flex-column justify-content-between h-100" v-else>
    <div class="chat clearfix pt-4 pr-4">
      <template v-for="msg in messages">
        <div class="action text-center" v-if="msg.type === 'action'" :key="msg.id">
          <span class="text">{{msg.text}}</span> <br />
          <span class="time">{{msg.time}}</span>
        </div>
        <div class="msg msg-moder float-left" v-else-if="msg.is_moder" :key="msg.id">
          <span class="name">Менеджер Газпромбанка</span> <br />
          <span class="text">{{msg.text}}</span>
          <span class="time float-right">{{msg.time}}</span>
        </div>
        <div class="msg float-right" v-else :key="msg.id">
          <span class="text">{{msg.text}}</span>
          <span class="time float-right">{{msg.time}}</span>
        </div>
      </template>
    </div>
    <div class="form_msg pb-3 mr-4">
      <input class="text-msg w-100" type="text" placeholder="Введите сообщение..." @keydown.enter="send"
             v-model="message" />
      <button class="btn" @click="send">
        <svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0L1.1375 5.73949L1.78063 5.85538L1.1375 5.97128L0 11.7108L16.2466 5.85538L0 0ZM2.62897 4.76994L2.0998 2.09994L12.5199 5.8554L2.0998 9.61086L2.62897 6.94086L8.6525 5.8554L2.62897 4.76994Z" fill="#D7DEE9"/>
        </svg>
      </button>
    </div>
  </div>
</template>

<script>
import Loading from "@/components/Loading";
export default {
  name: "FeedbackMessages",
  components: {Loading},
  props: ['select_chat'],
  data: function () {
    return {
      is_show: false,
      messages: [],
      message: '',
      local_id: 0
    }
  },
  methods: {
    send: function () {
      let date = new Date();
      this.messages.push({
        type: 'message',
        is_moder: false,
        text: this.message,
        time: ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2),
        id: ++this.local_id
      });
      this.message = '';
    }
  },
  created() {
    setTimeout(() => {
      this.messages = [
        {
          type: 'action',
          text: 'Чат создан',
          time: '13 октября 2020 г.',
          id: 1
        },
        {
          type: 'message',
          is_moder: true,
          text: "Здравствуйте, можете задавать любые вопросы, возникающие по теме API",
          time: "20:27",
          id: 2
        },
        {
          type: 'message',
          is_moder: false,
          text: "Здравствуйте, интересует возможность интеграции вашего API (получение кредитов) в наш интернет магазин: ",
          time: "20:27",
          id: 3
        }
      ];
      this.local_id = this.messages.reduce((val, m) => {
        return m.id > val ? m.id : val;
      }, 0);
      this.is_show = true;
    }, 300);
  }
}
</script>

<style scoped lang="scss">
.form_msg {
  position: relative;

  input {
    border: 2px solid #D7DEE9;
    border-radius: 2px;
    padding: 4px;
    padding-right: 47px;
  }

  button {
    position: absolute;
    right: 0;
    top: 0;
  }
}

.chat {
  overflow-y: auto;
  max-height: 600px;

  .action {
    .text {
      color: #93989D;
      font-size: 14px;
      background: #F0F0F0;
      border-radius: 6px;
      padding: 0.4rem;
    }

    .time {
      color: #93989D;
      font-size: 16px;
      line-height: 2.5rem;
    }
  }

  .msg {
    position: relative;
    border-radius: 12px 12px 0px 12px;
    width: 60%;
    background-color: rgba(0,102,204,0.1);
    margin-top: 8px;
    padding: 18px;

    .name {
      font-size: 16px;
      color: #0066CC;
    }

    .text {
      font-size: 14px;
      color: #7C8793;
    }

    .time {
      position: relative;
      bottom: -6px;
      right: 0;
      font-size: 12px;
      color: #7C8793;
    }
  }

  .msg.msg-moder {
    background-color: #F0F0F0;
    border-radius: 12px 12px 12px 0px;
  }
}
</style>
