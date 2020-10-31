const { template } = require("babel-core");

<template>
  <div class="base-input" :class="classes">
    <div class="base-input__field">
      <component
        :is="tag"
        ref="input"
        :type="type"
        :readonly="readonly"
        :disabled="disabled"
        class="base-input__input"
        :value="value"
        :placeholder="placeholder"
        v-on="inputListeners"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "BaseInput",

  props: {
    type: {
      type: String,
      default: "text",
      validator: (value) =>
        [
          "text",
          "url",
          "email",
          "tel",
          "password",
          "number",
          "date",
          "textarea",
        ].includes(value),
    },
    value: {
      type: [String, Number],
      default: null,
    },
    placeholder: {
      type: String,
      default: null,
    },
    readonly: {
      type: Boolean,
      default: false,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },

  watch: {
    value: function (value) {
      if (!value) this.$refs.input.value = value;
    },
  },

  computed: {
    classes() {
      const prefix = "base-input";

      return {
        [`${prefix}--filled`]: this.value.length,
        [`${prefix}--disabled`]: this.disabled,
      };
    },
    tag() {
      return this.type === "textarea" ? "textarea" : "input";
    },
    inputListeners() {
      const vm = this;
      return Object.assign({}, this.$listeners, {
        input: function (event) {
          vm.onInput(event);
        },
        change: function (event) {
          vm.onChange(event);
        },
      });
    },
  },

  methods: {
    onInput(event) {
      this.$emit("input", event.target.value);
    },
    onChange(event) {
      this.$emit("change", event);
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../../assets/scss/index.scss";

.base-input {
  max-width: 100%;

  &__input {
    display: block;
    width: 100%;
    font-size: $font-size-medium;
    line-height: $line-height-base;
    color: $color-gray;
    border: 2px solid #cccccc;
    border-radius: 4px;
    padding: 14px;
    box-sizing: border-box;

    &[type="date"]::-webkit-clear-button,
    &[type="date"]::-webkit-inner-spin-button {
      display: none;
    }
    &[type="number"]::-webkit-inner-spin-button {
      display: none;
    }

    &::placeholder {
      transition: inherit;
      color: #cccccc;
    }

    &:disabled {
      background-color: #f2f2f2;
    }

    &:hover {
      border: 2px solid #acacac;

      &::placeholder {
        color: #acacac;
      }
    }

    &:focus,
    &:active {
      border: 2px solid $color-blue--light;
    }

    transition: all 0.3s ease;
  }
}
</style>
