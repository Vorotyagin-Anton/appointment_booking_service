<template>
  <q-splitter
    v-model="splitterModel"
  >

    <template v-slot:before>
      <q-tab-panels
        v-model="date"
        animated
        transition-prev="jump-up"
        transition-next="jump-up"
      >

          <q-tab-panel v-for="item in workerFreeTime" :name="formatDate(item.date)" :key="item.date">
            <div class="text-h4 q-mb-md"> {{ dateToString(item.date) }} </div>

            <div class="q-pa-md">
              <q-chip v-for="time in item.timeArray" :key="time.id"
                      clickable
                      @click="selectTime(item.date, time.id)"
                      :color="selectedTime === time.id ? 'secondary':'primary'"
                      text-color="white"
                      icon="watch_later">
                {{ formatTime(time.value) }}
              </q-chip>
            </div>

          </q-tab-panel>

      </q-tab-panels>
    </template>

    <template v-slot:after>
      <div class="q-pa-md">
        <q-date
          v-model="date"
          :events="availableDate"
          :options="availableDate"
          :event-color="'green'"
        ></q-date>
      </div>
    </template>

  </q-splitter>

</template>

<script>
import {onMounted, onUpdated, ref,watch} from 'vue';
import useMaster from "src/hooks/useMaster";
export default {
  name: "OrderStepperTime",

  setup(){
    const {master, mountMaster} = useMaster();

    const nowDate = () => {
      const date = new Date()
      return date.getFullYear() + '/' + ('0' + (date.getMonth() + 1).toString().slice(-2)) + '/' + ('0' + date.getDate().toString()).slice(-2)
    }
    const date = ref(nowDate()) //текущая дата
    const selectedDate = ref() //выбранная дата
    const selectedTime = ref() //выбранное время
    const availableDate = []; //маркеры возможных дат
    const { workerFreeTime } = master.value;

    mountMaster();

    const formatTime = (int) => {
      return ('0' + (Math.trunc(int/60)).toString()).slice(-2) + ':' + ('0' + (int % 60).toString()).slice(-2);
    };

    const formatDate = (date) => {
      if (typeof date !== "undefined"){
        return date.replace(/-/g, '/')
      }
    }

    const dateToString = (string) => {
      const date = new Date(string)
      return date.getDate() + ' ' + date.toLocaleString('en-EN', { month: 'long' }) + ' ' + date.getFullYear()
    }

    //извлечение массива разрешенных дат
    const getAvailableDate = () => {
      workerFreeTime.forEach(item=> {
        availableDate.push(formatDate(item.date));
      })
    }

    getAvailableDate()

    const selectTime = (date, time) => {
      selectedDate.value = date
      selectedTime.value = time
    }

    watch(selectedTime, (selectedTime, prevSelectedTime) => {
      console.log('записать в сторедж ид времени', selectedTime)
      const dateObject = workerFreeTime.find(d => d.date === selectedDate.value)
      console.log('записать в сторедж объект времени', dateObject.timeArray.find(t => t.id === selectedTime))
    })

    // console.log('master.workerFreeTime', master.value.workerFreeTime) //пришло
    // console.log('workerFreeTime', workerFreeTime) //пришло
    // console.log('availableDate', availableDate)

    return{
      selectedTime,
      availableDate,
      workerFreeTime,
      formatTime,
      formatDate,
      date,
      selectTime,
      dateToString,

      splitterModel: ref(60),
    }
  }
}
</script>

<style lang="scss">
.block{
//цвет доступных дат
}

.q-date__event{
  bottom: unset;
  height: 30px;
  width: 30px;
  //border-radius: 50%;
  z-index: -1;
}

.time{
  width: 50px;
  height: 20px;
  background-color: #21BA45;
  margin-right: 5px;
}

</style>
