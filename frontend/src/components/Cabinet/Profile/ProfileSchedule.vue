<template>
  <div class="profile-schedule">
    <h3 class="profile-schedule__h3">Business Hours</h3>

    <p class="profile-schedule__p">Let your clients know when you’re open.</p>

    <account-select
      class="profile-schedule__timezone"
      label="Time Zone"
      v-model="timezone"
      :options="timezoneMap"
    />

    <schedule-calendar
      v-if="!loading"
      class="profile-schedule__calendar"
      :schedule="schedule"
    />
  </div>
</template>

<script>
import {onMounted} from "vue";
import useAuth from "src/hooks/auth/useAuth";
import useAppTime from "src/hooks/common/useAppTime";
import useSchedule from "src/hooks/auth/useSchedule";
import AccountSelect from "components/Cabinet/Common/AccountSelect";
import ScheduleCalendar from "components/Cabinet/Schedule/ScheduleCalendar";

export default {
  name: "ProfileSchedule",

  components: {
    AccountSelect,
    ScheduleCalendar,
  },

  setup() {
    const {timezone, timezoneMap} = useAppTime();

    const {user} = useAuth();

    const {loading, schedule, getScheduleFromApi} = useSchedule();

    onMounted(() => {
      if (schedule.value.length === 0) {
        getScheduleFromApi(user.id);
      }
    });

    return {
      loading,
      schedule,
      timezone,
      timezoneMap,
    }
  },
}
</script>

<style lang="scss">
.profile-schedule {
  width: 800px;

  &__h3 {
    padding: 35px 0 10px;
    font-size: 18px;
    font-weight: 700;
  }

  &__p {
    width: 100%;
  }

  &__timezone {
    border: 1px solid $grey-4;
  }

  &__calendar {
    margin-top: 35px;
    height: 485px;
  }
}
</style>
