<template>
  <div class="loading" :style="{height: height}" v-if="is_show">
    <div class="spinner-border text-info" :style="{height: _size, width: _size}" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Loading",
    props: ['height', 'times', 'size'],
    data: function () {
      return {
        is_show: (typeof this.times === 'undefined')
      }
    },
    computed: {
      _size: function () {
        return (this.size) ? this.size : '3rem';
      }
    },
    created: function () {
      if (typeof this.times !== 'undefined') {
        setTimeout(() => {
          this.is_show = true;
        }, Number.parseFloat(this.times));
      }
    }
  }
</script>

<style scoped>
  .loading {
    display: flex;
    justify-content: center;
    height: 50vh;
    align-items: center;
  }
</style>