<template>
  <div class="api-key-card">
    <div class="api-key-card__header">
      <span class="api-key-card__title">{{ title }}</span>
    </div>

    <div class="api-key-card__main">
      <span class="product-card__description">{{ description }}</span>
    </div>

    <div class="api-key-card__copyKey">
      <span class="api-key-card__key">{{ apiKey }}</span>
      <button class="api-key-card__copyBtn" @click="handleCopy">
        Копировать
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "ApiKeyCard",

  props: {
    apiKey: {
      type: String,
      default: "",
    },
    title: {
      type: String,
      default: "",
    },
    description: {
      type: String,
      default: "",
    },
  },

  methods: {
    handleCopy() {
      if (navigator.clipboard) {
        navigator.clipboard.writeText(this.apiKey);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../assets/scss/index.scss";

$dark: #262c40;
$blue: #0066cc;

.api-key-card {
  width: 460px;
  height: 210px;
  padding: 24px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  background: #ffffff;
  box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.15);

  &__title {
    font-size: $font-size-medium;
    font-weight: bold;
    color: $blue;
  }

  &__description {
    font-size: $font-size-medium;
    color: $dark;
    overflow-y: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
  }

  &__copyKey {
    background-color: #f0f1f4;
    border-radius: 2px;
    padding: 16px;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  &__key {
    font-size: $font-size-medium;
    color: $color-black;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  &__copyBtn {
    font-size: $font-size-medium;
    outline: none;
    border: none;
    background-color: transparent;
    color: $blue;
  }
}
</style>
