<template>
  <div class="logo" :class="classes">
    <div v-if="isPrimary" class="logo__iconWrap">
      <logo-icon />
    </div>
    <div v-if="isSecondary" class="logo__mainSecondary">
      <span class="logo__secondaryName">Газпромбанк</span>
      <div class="logo__rectangle"></div>
      <span class="logo__secondaryTagline">для разработчиков</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "Logo",

  props: {
    viewType: {
      type: String,
      default: "primary",
      validator: (value) => ["primary", "secondary"].includes(value),
    },
  },

  computed: {
    classes() {
      const prefix = "logo";
      return {
        [`${prefix}--viewType_${this.viewType}`]: this.viewType,
      };
    },
    isPrimary() {
      return this.viewType === "primary";
    },
    isSecondary() {
      return this.viewType === "secondary";
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../assets/scss/index.scss";

.logo {
  display: flex;
  align-items: center;
  cursor: pointer;

  &__mainSecondary {
    display: flex;
    align-items: center;
  }

  &__secondaryName {
    color: $color-dark;
    font-size: $font-size-medium;
    font-weight: $font-weight-bold;
  }

  &__rectangle {
    width: 3px;
    height: 30px;
    background-color: $color-dark;
    margin: 0px 10px;
  }

  &__secondaryTagline {
    color: $color-dark;
    font-size: $font-size-medium;
  }

  &--viewType {
    &_primary {
      max-width: 500px;
    }

    &_secondary {
      max-width: 320px;
    }
  }
}
</style>
