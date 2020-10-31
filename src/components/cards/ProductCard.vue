<template>
  <div class="product-card" :class="classes">
    <div class="product-card__status" v-if="status">
      <span class="product-card__status-text">{{ status }}</span>
    </div>

    <div class="product-card__header">
      <div class="product-card__icon">
        <slot></slot>
      </div>

      <span class="product-card__title">{{ title }}</span>
    </div>

    <div class="product-card__main">
      <span class="product-card__description">{{ description }}</span>
    </div>

    <div class="product-card__footer">
      <a class="product-card__footer-link" :href="linkUrl">{{ linkText }}</a>

      <button class="product-card__unsubBtn" v-if="showCtrlBtns" @click="handleSub">
        {{`${viewType === 'unsub' ? 'Отключить API' : 'Подключить API'}`}}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProductCard",

  props: {
    title: {
      type: String,
      default: null,
    },
    description: {
      type: String,
      default: null,
    },
    status: {
      type: String,
      default: "",
    },
    linkText: {
      type: String,
      default: "",
    },
    linkUrl: {
      type: String,
      default: null,
    },
    viewType: {
      type: String,
      default: "default",
      validator: (value) => ["default", "sub", "unsub"].includes(value),
    },
  },

  computed: {
    classes() {
      const prefix = "product-card";

      return {
        [`${prefix}--viewType_${this.viewType}`]: !!this.viewType,
      };
    },
    showCtrlBtns() {
      return ["sub", "unsub"].includes(this.viewType);
    },
  },

  methods: {
    handleSub() {
      this.$emit('handle-sub', this.viewType);
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../../assets/scss/index.scss";

$dark: #262c40;
$blue: #0066cc;

.product-card {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 460px;
  height: 250px;
  padding: 24px;
  box-sizing: border-box;
  background-color: $color-white;
  box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.15);

  &__status {
    padding: 3px 10px;
    box-sizing: border-box;
    border: 1px solid rgba(38, 44, 64, 0.5);
    border-radius: 2px;
    font-size: 16px;
    max-width: 90px;
  }

  &__status-text {
    font-size: $font-size-base;
    color: rgba(38, 44, 64, 0.5);
  }

  &__header {
    display: flex;
    align-items: center;
  }

  &__icon {
    margin-right: 12px;
  }

  &__title {
    font-size: $font-size-medium;
    font-weight: bold;
    color: $dark;
  }

  &__description {
    font-size: $font-size-medium;
    color: $dark;
    overflow-y: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    line-height: 1.2;
  }

  &__footer {
    display: flex;
    justify-content: space-between;
  }

  &__docBtn,
  &__unsubBtn {
    font-size: 18px;
    outline: none;
    border: none;
    background-color: transparent;
  }

  &__docBtn {
    color: $blue;
  }

  &--viewType_sub {
    .product-card__unsubBtn {
      color: #02c271;
    }
  }

  &--viewType_unsub {
    .product-card__unsubBtn {
      color: #d00000;
    }
  }

  &__footer-link {
    font-size: $font-size-medium;
    color: $blue;
    cursor: pointer;
    text-decoration: underline;

    &:hover {
      text-decoration: underline;
    }
  }
}
</style>