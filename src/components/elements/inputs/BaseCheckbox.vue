<template>
  <div class="base-checkbox" :class="classes">
    <div class="base-checkbox__field">
      <input
        :id="id"
        type="checkbox"
        class="base-checkbox__input"
        v-bind="$attrs"
        :value="value"
        :checked="state"
        :disabled="disabled"
        @change="onChange"
      />

      <label :for="id" class="base-checkbox__label">
        <div v-if="label || $slots.default" class="base-checkbox__label-text">
          <slot>{{ label }}</slot>
        </div>
      </label>
    </div>
  </div>
</template>
<script>
export default {
  name: "BaseCheckbox",

  inheritAttrs: false,

  model: {
    prop: "modelValue",
    event: "change",
  },

  props: {
    value: {
      type: [String, Number],
      default: "",
    },
    checked: {
      type: Boolean,
      default: false,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    modelValue: {
      type: [Boolean, String, Array],
      default: undefined,
    },
    label: {
      type: String,
      default: "",
    },
  },

  data() {
    return {
      id: `uid_${(~~(Math.random() * 1e8)).toString(16)}`,
    };
  },

  computed: {
    state() {
      if (typeof this.modelValue === "undefined") {
        return this.checked;
      }
      if (Array.isArray(this.modelValue)) {
        return this.modelValue.indexOf(this.value) > -1;
      }

      return this.modelValue;
    },
    isChecked() {
      return Boolean(this.state);
    },
    classes() {
      const prefix = "base-checkbox";
      return {
        [`${prefix}--checked`]: this.isChecked,
        [`${prefix}--disabled`]: this.disabled,
      };
    },
  },

  watch: {
    checked(newValue) {
      if (newValue !== this.state) {
        this.toggle();
      }
    },
  },

  mounted() {
    if (this.checked && !this.state) {
      this.toggle();
    }
  },
  methods: {
    onChange() {
      this.toggle();
    },
    toggle() {
      let value = null;
      if (Array.isArray(this.modelValue)) {
        value = this.modelValue.slice(0);
        if (this.state) {
          value.splice(value.indexOf(this.value), 1);
        } else {
          value.push(this.value);
        }
      } else {
        value = !this.state;
      }
      this.$emit("change", value);
    },
  },
};
</script>

<style lang="scss">
@import "../../../assets/scss/index.scss";

.base-checkbox {
  display: flex;
  align-items: center;
  cursor: pointer;

  &__field {
    display: flex;
    align-items: center;
  }

  &__input {
    width: 16px; // can bee moved to &--size_{size} selector
    height: 16px; // can bee moved to &--size_{size} selector
    border: 2px solid #d7dee9;
    box-sizing: border-box;
    border-radius: 2px;
    margin-right: 6px;
    cursor: pointer;
  }

  &__label-text {
    font-size: $font-size-small;
    color: $color-gray;
    font-weight: $font-weight-light;
    cursor: pointer;
  }
}
</style>
