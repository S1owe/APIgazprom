<template>
  <div class="application-card" :class="classes">
    <div class="application-card__header">
      <span class="application-card__title">{{ title }}</span>
    </div>

    <div class="application-card__date">
      <span class="application-card__date-text"
        >Создано: {{ validateDate }}</span
      >
    </div>

    <div class="application-card__main">
      <div class="application-card__left" v-if="owner">
        <span class="application-card__owner-label">Владелец:</span>
        <span class="application-card__owner-name">{{ owner }}</span>
      </div>

      <div class="application-card__right" v-if="team">
        <span class="application-card__team-label">Команда:</span>
        <span class="application-card__team-name">{{ team }}</span>
      </div>

      <div class="application-card__members" v-if="isShowMembers">
        <span class="application-card__members-label">Участники:</span>

        <div class="application-card__membersWrap">
          <span class="application-card__members-list">{{ getMembers }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ApplicationCard",

  props: {
    title: {
      type: String,
      default: "",
    },
    createdDate: {
      type: Date,
      default: null,
    },
    owner: {
      type: String,
      default: "",
    },
    team: {
      type: String,
      default: "",
    },
    viewType: {
      type: String,
      default: "application",
      validator: (value) => ["application", "team"].includes(value),
    },
    members: {
      type: Array,
      default: () => [],
    },
  },

  data() {
    return {
      months: [
        "января",
        "февраля",
        "марта",
        "апреля",
        "мая",
        "июня",
        "июля",
        "августа",
        "сентября",
        "октября",
        "ноября",
        "декабря",
      ],
    };
  },

  computed: {
    classes() {
      const prefix = "application-card";

      return {
        [`${prefix}--viewType_${this.viewType}`]: !!this.viewType,
      };
    },
    validateDate() {
      const day = this.createdDate.getDate();
      const month = this.months[this.createdDate.getMonth()];
      const year = this.createdDate.getFullYear();

      return `${day} ${month} ${year}`;
    },
    isShowMembers() {
      return this.members.length && this.viewType === "team";
    },
    getMembers() {
      return this.members.join(", ");
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../assets/scss/index.scss";

$dark: #262c40;
$blue: #0066cc;

.application-card {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 30px 24px;
  width: 480px;
  height: 245px;
  box-sizing: border-box;
  background: #ffffff;
  box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.15);

  &__title {
    font-size: 24px;
    color: $blue;
    font-weight: bold;
  }

  &__date-text {
    font-size: 18px;
    color: $dark;
  }

  &--viewType_application {
    .application-card__owner-label,
    .application-card__owner-name,
    .application-card__team-label,
    .application-card__team-name {
      display: block;
      font-size: 18px;
      color: $dark;
    }

    .application-card__main {
      display: flex;
    }

    .application-card__left,
    .application-card__right {
      width: 50%;
    }
  }

  &--viewType_team {
    .application-card__owner-label,
    .application-card__owner-name {
      font-size: 18px;
    }

    .application-card__owner-label {
      color: $blue;
      margin-right: 10px;
    }

    .application-card__owner-name {
      color: $dark;
    }

    .application-card__members-label {
      color: $blue;
      margin-right: 10px;
      font-size: 18px;
    }

    .application-card__main {
      display: flex;
      flex-direction: column;
    }

    .application-card__left,
    .application-card__right {
      width: 100%;
    }

    .application-card__left {
      margin-bottom: 15px;
    }

    .application-card__members {
      display: flex;
    }
  }
}
</style>