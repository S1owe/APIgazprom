<template>
  <div class="team-detail">
    <div class="team-detail__container">
      <div class="team-detail__header">
        <div class="team-detail__main">
          <h2 class="team-detail__title">{{ team }}</h2>

          <button class="team-detail__removeBtn">Удалить команду</button>
        </div>

        <div class="team-detail__owner">
          <span class="team-detail__owner-label">Владелец:</span>
          <span class="team-detail__owner-name">{{ owner }}</span>
        </div>
      </div>

      <div class="team-detail__content">
        <h3 class="team-detail__subTitle">Приложения команды:</h3>

        <div class="team-detail__table">
          <span class="team-detail__tableTitle">{{ teamApp }}</span>

          <div class="team-detail__tableInfo">
            <div class="team-detail__owner">
              <span class="team-detail__owner-label">Владелец:</span>
              <span class="team-detail__owner-name">{{ owner }}</span>
            </div>

            <div class="team-detail__date">
              <span class="team-detail__date-label">Создано:</span>
              <span class="team-detail__date">{{ validateDate }}</span>
            </div>
          </div>

          <div class="team-detail__members-label">Участники</div>

          <div class="team-detail__tableHeader">
            <div class="team-detail__tableCol1 bold">Фамилия Имя</div>
            <div class="team-detail__tableCol2 bold">Email</div>
            <div class="team-detail__tableCol3 bold">Исключить участника</div>
          </div>

          <div
            class="team-detail__tableRow"
            v-for="(item, i) in members"
            :key="i"
          >
            <div class="team-detail__tableCol1">{{ item.name }}</div>
            <div class="team-detail__tableCol2">{{ item.email }}}</div>
            <div class="team-detail__tableCol3">
              <button class="team-detail__delBtn" @click="() => handleDelete(i)">исключить</button>
            </div>
          </div>

          <div class="team-detail__invite">
            <base-button theme="default" size="medium">
              Пригласить участника
            </base-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BaseButton from "./elements/BaseButton";

export default {
  name: "TeamDetail",

  components: { BaseButton },

  data() {
    return {
      team: "API для банкоматов",
      owner: "Зиновьев Ярослав",
      teamApp: "Мое приложение 1",
      createdDate: new Date('September 17, 2019 03:24:00'),
      members: [
        {
          name: "Туркин Илья",
          email: "IlyaT@bk.ru",
        },
        {
          name: "Яшин Михаил",
          email: "MishaYashin@bk.ru",
        },
        {
          name: "Зиновьев Ярослав",
          email: "yaroslavvv_1@bk.ru",
        },
      ],
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
    validateDate() {
      const day = this.createdDate.getDate();
      const month = this.months[this.createdDate.getMonth()];
      const year = this.createdDate.getFullYear();

      return `${day} ${month} ${year}`;
    },
  },

  methods: {
    handleDelete(index) {
      const tmp = [...this.members];
      tmp.splice(index, 1);
      this.members = tmp;
    }
  }
};
</script>

<style lang="scss" scoped>
$dark: #262c40;
$blue: #0066cc;

.team-detail {
  width: 100%;

  &__container {
    max-width: 1080px;
    padding-left: 95px;
    padding-top: 57px;
    box-sizing: border-box;
    min-height: calc(100vh - 346px);
  }

  &__header {
    display: flex;
    flex-direction: column;
    margin-bottom: 34px;
  }

  &__main {
    display: flex;
    justify-content: space-between;
    margin-bottom: 9px;
  }

  &__owner {
    display: flex;
  }

  &__owner-name {
    font-size: 18px;
    color: $dark;
  }

  &__owner-label {
    font-size: 18px;
    color: $blue;
    margin-right: 10px;
  }

  &__removeBtn {
    font-size: 18px;
    color: #262c40;
    outline: none;
    border: none;
    background-color: transparent;
  }

  &__subTitle {
    font-size: 28px;
    font-weight: bold;
    color: $dark;
  }

  &__tableTitle {
    display: block;
    font-size: 24px;
    font-weight: bold;
    color: $blue;
    margin-bottom: 10px;
  }

  &__table {
    background-color: #f0f1f4;
    padding: 24px;
    box-sizing: border-box;
  }

  &__tableInfo {
    display: flex;
    margin-bottom: 20px;
  }

  &__owner {
    margin-right: 80px;
  }

  &__owner-name,
  &__date {
    font-size: 18px;
    color: $dark;
  }

  &__date-label,
  &__owner-label {
    font-size: 18px;
    color: $blue;
    margin-right: 10px;
  }

  &__members-label {
    width: 100%;
    height: 48px;
    background-color: #d7dee9;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    border-radius: 2px;
    box-sizing: border-box;
    margin-bottom: 10px;
  }

  &__tableHeader {
    display: flex;
    margin-bottom: 10px;
  }

  &__tableRow {
    display: flex;
    margin-bottom: 15px;
  }

  &__tableCol1 {
    width: 25%;
    display: flex;
    justify-content: center;
    font-size: 18px;
  }

  &__tableCol2 {
    width: 50%;
    display: flex;
    justify-content: flex-start;
    font-size: 18px;
  }

  &__tableCol3 {
    width: 25%;
    display: flex;
    justify-content: center;
    font-size: 18px;
  }

  &__delBtn {
    font-size: 18px;
    color: #d00000;
    outline: none;
    border: none;
    background-color: transparent;
  }

  &__invite {
    display: flex;
    justify-content: center;
    margin-top: 30px;
  }
}

.bold {
  font-weight: bold;
}
</style>