<template>
  <div class="point mt-4 mr-2 ml-4">
    <b-button variant="white"
              @click="is_active = !is_active"
              :class="{'not-collapsed': is_active, collapsed: !is_active}"
              class="d-flex flex-column align-items-centertext-left collapse-btn p-0">
      <div class="w-100 d-flex text-left">
        <span class="icon mr-2" v-if="point.is_parse_header">
          <svg width="6" height="12" viewBox="0 0 6 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 6L0.75 11.1962L0.75 0.803848L6 6Z" fill="#262C40"/>
          </svg>
        </span>
        <span>{{point.text}}</span>
      </div>
    </b-button>
    <b-collapse v-if="point.is_parse_header" v-model="is_active">
      <div class="w-100 ml-4">
        <ul class="list-items m-0 p-0">
          <li class="list-item pl-3" :class="{active: head.is_active}" v-for="head in point.headers" :key="head.value">
            <a :href="'#' + head.value" @click="teleport"><span>{{head.text}}</span></a>
          </li>
        </ul>
      </div>
    </b-collapse>
  </div>
</template>

<script>
export default {
  name: "DocPunct",
  props: ['point', 'active_module'],
  methods: {
    teleport: function () {
      setTimeout(() => {
        document.querySelector('body').scrollTo(0, 0);
      }, 1000);
    }
  },
  computed: {
    is_active: {
      get: function () {
        return this.active_module === this.point.href;
      },
      set: function (val) {
        if (val)
          this.$emit('click');
      }
    }
  }
}
</script>

<style scoped>
.list-item {
  border-left: 3px #D7DEE9 solid;
}

.list-item.active {
  border-left: 3px #0066CC solid;
}
</style>
