<template>
  <component
    :is="tag"
    class="base-button"
    :class="classes"
    :disabled="disabled"
    v-on="$listeners"
    :to="to"
  >
    <div class="base-button__inner">
      <span v-if="$slots.default || title" class="base-button__text">
        <slot>{{ title }}</slot>
      </span>
    </div>
  </component>
</template>

<script>
export default {
  name: "BaseButton",

  props: {
    title: {
      type: String,
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    to: {
      type: Object,
      default: null,
      validator: (value) => !value || value.name || value.path,
    },
    theme: {
      type: String,
      default: "default",
      validator: (value) => ["default", "outline", "plain"].includes(value),
    },
    size: {
      type: String,
      default: "base",
      validator: (value) => ["small", "base", "medium", "big"].includes(value),
    },
    underline: {
      type: Boolean,
      default: false,
    },
  },

  computed: {
    tag() {
      let tag = "button";
      if (this.to) {
        tag = "router-link"; // may be use vue-routes...
      } else if (this.$attrs.href) {
        tag = "a";
      }
      return tag;
    },
    classes() {
      const prefix = "base-button";
      return {
        [`${prefix}--theme_${this.theme}`]: this.theme,
        [`${prefix}--size_${this.size}`]: this.size,
        [`${prefix}--underline`]: this.underline,
      };
    },
  },

  methods: {},
};
</script>

<style lang="scss" scoped>
@import "../../assets/scss/index.scss";

.base-button {
  position: relative;
  display: block;
  box-shadow: none;
  text-decoration: none;
  border: 1px solid transparent;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;

  &__inner {
    display: flex;
    justify-content: center;
    align-items: center;
    pointer-events: none;
    transition: inherit;
  }

  &__text {
    font-family: $font-family;
    font-weight: $font-weight-bold;
    transition: inherit;
  }

  &--size_small {
    padding: 0px;

    .base-button__text {
      font-size: $font-size-small;
      font-weight: $font-weight-light;
    }
  }

  &--size_base {
    padding: 14px 32px;

    .base-button__text {
      font-size: $font-size-small;
    }
  }

  &--size_medium {
    padding: 16px 40px;

    .base-button__text {
      font-size: $font-size-medium;
    }
  }

  &--size_big {
    padding: 14px 92px;

    .base-button__text {
      font-size: $font-size-medium-x;
    }
  }

  &--theme_default {
    background-color: #0066CC;

    .base-button__text {
      color: $color-white;
    }

    &:hover {
      background-color: #1e8aff;
    }

    &:active {
      background-color: #0066ff;
    }
  }

  &--theme_outline {
    border: 2px solid #449dff;
    background-color: transparent;

    .base-button__text {
      color: #449dff;
    }

    &:hover {
      border: 2px solid #1e8aff;

      .base-button__text {
        color: #1e8aff;
      }
    }

    &:active {
      border: 2px solid #0066ff;

      .base-button__text {
        color: #0066ff;
      }
    }
  }

  &--theme_plain {
    background-color: transparent;

    .base-button__text {
      color: #449dff;
    }

    &:hover {
      .base-button__text {
        color: #1e8aff;
      }
    }

    &:active {
      .base-button__text {
        color: #0066ff;
      }
    }
  }

  &--underline {
    .base-button__text {
      text-decoration: underline;
    }
  }
}
</style>
